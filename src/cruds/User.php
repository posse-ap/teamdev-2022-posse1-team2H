<?php

namespace cruds;

use modules\email\Email;

class User
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    private function getIndustriesWithAgency($db, $agency_id)
    {
        $stmt = $db->prepare("SELECT
        industry
        FROM industries
        WHERE id IN (
            SELECT industry_id FROM agencies_industries
            WHERE agency_id = :agency_id
        )
        ");
        $stmt->bindValue(":agency_id", $agency_id, \PDO::PARAM_INT);
        $stmt->execute();
        $industries = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $industries;
    }

    private function getTypesWithAgency($db, $agency_id)
    {
        $stmt = $db->prepare("SELECT
        agency_type
        FROM agency_type
        WHERE id IN (
            SELECT type_id FROM agencies_types
            WHERE agency_id = :agency_id
        )
        ");
        $stmt->bindValue(":agency_id", $agency_id, \PDO::PARAM_INT);
        $stmt->execute();
        $types = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $types;
    }

    private function getuser($db, $user_id) {
        $stmt = $db->prepare("SELECT
        *
        FROM users
        WHERE id = :user_id
        ");
        $stmt->bindValue(":user_id", $user_id, \PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch();
        return $user;
    }

    public function getAgencies($types = null, $industries = null)
    {
        if ($types === null && $industries === null) {
            $stmt = $this->db->prepare('SELECT
                agency.id,
                agency.name,
                article.title,
                article.sentenses,
                article.eyecatch_url
                FROM agencies as agency
                LEFT JOIN agency_articles as article
                ON agency.id = article.agency_id
                ORDER BY article.updated_at DESC
            ');
            $stmt->execute();
        } else if ($types !== null && $industries === null) {
            // TODO
            $inclause = substr(str_repeat(',?', count($types)), 1);
            $stmt = $this->db->prepare(sprintf('SELECT
                agency.id,
                agency.name,
                article.title,
                article.sentenses,
                article.eyecatch_url
                FROM agencies as agency
                LEFT JOIN agency_articles as article
                ON agency.id = article.agency_id
                WHERE agency.id IN (
                    SELECT agency_id FROM agencies_types WHERE type_id IN (%s)
                )
                ORDER BY article.updated_at DESC
            ', $inclause));
            $stmt->execute($types);
        } else if ($types === null && $industries !== null) {
            $inclause = substr(str_repeat(',?', count($industries)), 1);
            $stmt = $this->db->prepare(sprintf('SELECT
                agency.id,
                agency.name,
                article.title,
                article.sentenses,
                article.eyecatch_url
                FROM agencies as agency
                LEFT JOIN agency_articles as article
                ON agency.id = article.agency_id
                WHERE agency.id IN (
                    SELECT agency_id FROM agencies_industries WHERE industry_id IN (%s)
                )
                ORDER BY article.updated_at DESC
            ', $inclause));
            $stmt->execute($industries);
        } else {
            $type_in_clause = substr(str_repeat(',?', count($types)), 1);
            $industry_in_clause = substr(str_repeat(',?', count($industries)), 1);
            $stmt = $this->db->prepare(sprintf('SELECT
                agency.id,
                agency.name,
                article.title,
                article.sentenses,
                article.eyecatch_url
                FROM agencies as agency
                LEFT JOIN agency_articles as article
                ON agency.id = article.agency_id
                WHERE agency.id IN (
                    SELECT agency_id FROM agencies_types WHERE type_id IN (%s)
                )
                AND agency.id IN (
                    SELECT agency_id FROM agencies_industries WHERE industry_id IN (%s)
                )
                ORDER BY article.updated_at DESC
            ', $type_in_clause, $industry_in_clause));
            $stmt->execute(array_merge($types, $industries));
        }

        $num = $stmt->rowCount();

        if ($num > 0) {
            $values = array();

            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $typestmt = $this->db->prepare('SELECT type.agency_type FROM agency_type as type WHERE type.id IN (
                    SELECT type_id FROM agencies_types WHERE agency_id=:agency_id
                    )
                ');
                $typestmt->bindValue(':agency_id', $id, \PDO::PARAM_INT);
                $typestmt->execute();

                $types = $typestmt->fetchAll(\PDO::FETCH_ASSOC);

                $industry_stmt = $this->db->prepare('SELECT industry FROM industries WHERE id IN (
                    SELECT industry_id FROM agencies_industries WHERE agency_id=:agency_id
                    )
                ');
                $industry_stmt->bindValue(':agency_id', $id, \PDO::PARAM_INT);
                $industry_stmt->execute();

                $industries = $industry_stmt->fetchAll(\PDO::FETCH_ASSOC);

                $item = array(
                    'id' => $id,
                    'name' => $name,
                    'title' => $title,
                    'sentenses' => $sentenses,
                    'eyecatch_url' => $eyecatch_url,
                    'types' => $types,
                    'industries' => $industries,
                );
                array_push($values, $item);
            }
            return json_encode($values, JSON_UNESCAPED_UNICODE);
        }
        return json_encode(array());
    }

    public function getAgency($id)
    {
        $stmt = $this->db->prepare('SELECT
        agencies.id id,
        agencies.name name,
        agencies.email email,
        agencies.email_for_notification email_for_notice,
        agencies.tel tel,
        agencies.url url,
        agencies.representative representative,
        agencies.contactor contactor,
        agencies.address address,
        agencies.address_num address_num,
        article.title title,
        article.sentenses sentenses,
        article.eyecatch_url eyecatch
        FROM agencies
        LEFT JOIN agency_articles as article
        ON agencies.id = article.agency_id
        WHERE agencies.id = :id');
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        $agency = $stmt->fetch(\PDO::FETCH_ASSOC);
        extract($agency);
        $industries = self::getIndustriesWithAgency($this->db, $id);
        $result = array(
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'email_for_notification' => $email_for_notice,
            'tel' => $tel,
            'url' => $url,
            'representative' => $representative,
            'contactor' => $contactor,
            'address' => $address,
            'address_num' => $address_num,
            'title' => $title,
            'sentenses' => $sentenses,
            'eyecatch' => $eyecatch,
            'industries' => $industries
        );
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function getType()
    {
        $stmt = $this->db->prepare('SELECT id, agency_type FROM agency_type LIMIT 20
        ');
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getIndustries()
    {
        $stmt = $this->db->prepare('SELECT id, industry FROM industries LIMIT 20
        ');
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function insertUser($user, $agencies)
    {
        // $agencies = array(id);
        $stmt = $this->db->prepare('INSERT
        INTO
        users(name, age, email, tel, university, undergraduate, department, school_year, graduation_year, gender, address, address_num)
        VALUES
        (:name, :age, :email, :tel, :university, :undergraduate, :department, :school_year, :graduation_year, :gender, :address, :address_num)
        ');
        $stmt->bindValue(':name', $user->name, \PDO::PARAM_STR);
        $stmt->bindValue(':age', $user->age, \PDO::PARAM_INT);
        $stmt->bindValue(':email', $user->email, \PDO::PARAM_STR);
        $stmt->bindValue(':tel', $user->tel, \PDO::PARAM_STR);
        $stmt->bindValue(':university', $user->university, \PDO::PARAM_STR);
        $stmt->bindValue(':undergraduate', $user->undergraduate, \PDO::PARAM_STR);
        $stmt->bindValue(':department', $user->department, \PDO::PARAM_STR);
        $stmt->bindValue(':school_year', $user->school_year, \PDO::PARAM_INT);
        $stmt->bindValue(':graduation_year', $user->graduation_year, \PDO::PARAM_INT);
        $stmt->bindValue(':gender', $user->gender, \PDO::PARAM_BOOL);
        $stmt->bindValue(':address', $user->address, \PDO::PARAM_STR);
        $stmt->bindValue('address_num', $user->address_num, \PDO::PARAM_STR);
        $user_success = $stmt->execute();

        if ($user_success) {
            $user_id = $this->db->lastInsertId();
            $user = self::getUser($this->db, $user_id);
            foreach ($agencies as $agency) {
                $agencies_stmt = $this->db->prepare('INSERT INTO users_agencies (user_id, agency_id) VALUES (:user_id, :agency_id)');

                $agencies_stmt->bindValue(':user_id', $user_id);
                $agencies_stmt->bindValue(':agency_id', $agency);

                $success = $agencies_stmt->execute();
                if (!$success) {
                    return false;
                }
            }
            // send email to user
            Email::sendMail($user->email, "boozer@example.com", "お問い合わせを完了しました", "sample message");
            //send email to each agencies
            $inclause = substr(str_repeat(',?', count($agencies)), 1);
            $stmt = $this->db->prepare(sprintf(
                'SELECT email_for_notification FROM agencies WHERE id IN (%s)',
                $inclause
            ));
            $stmt->execute($agencies);
            $agencies_emails = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($agencies_emails as $email) {
                Email::sendMail($email['email_for_notification'], "boozer@example.com", "学生からお問い合わせが来ました", "sample message");
            }
        }

        return true;
    }

    public function getFav($agency_ids)
    {
        $inclause = substr(str_repeat(',?', count($agency_ids)), 1);
        $query = sprintf(
            "SELECT
            agencies.id id,
            agencies.name name,
            agencies.email email,
            agencies.email_for_notification email_for_notice,
            agencies.tel tel,
            agencies.url url,
            agencies.representative representative,
            agencies.contactor contactor,
            agencies.address address,
            agencies.address_num address_num,
            article.title title,
            article.sentenses sentenses,
            article.eyecatch_url eyecatch
            FROM agencies
            LEFT JOIN agency_articles as article
            ON agencies.id = article.agency_id
            WHERE agencies.id IN (%s)",
            $inclause
        );
        $stmt = $this->db->prepare($query);
        $stmt->execute($agency_ids);

        $num = $stmt->rowCount();

        if ($num > 0) {
            $values = array();
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $industries = self::getIndustriesWithAgency($this->db, $id);
                $types = self::getTypesWithAgency($this->db, $id);
                $item = array(
                    'id' => $id,
                    'name' => $name,
                    'email' => $email,
                    'email_for_notification' => $email_for_notice,
                    'tel' => $tel,
                    'url' => $url,
                    'representative' => $representative,
                    'contactor' => $contactor,
                    'address' => $address,
                    'address_num' => $address_num,
                    'title' => $title,
                    'sentenses' => $sentenses,
                    'eyecatch' => $eyecatch,
                    "industries" => $industries,
                    "types" => $types
                );
                array_push($values, $item);
            }
            return json_encode($values, JSON_UNESCAPED_UNICODE);
        }
        return json_encode(array());
    }
}
