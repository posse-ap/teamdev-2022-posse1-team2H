<?php

namespace cruds;

class User
{
    public function __construct($db)
    {
        $this->db = $db;
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
        INTO users (name, email, password, tel, univercity, undergraduate, department, school_year, graduation_year, gender, address, address_num) VALUES
        (:name, :email, :password, :tel, :univercity, :undergraduate, :department, :school_year, :graduation_year, :gender, :address, :address_num)
        ');
        $stmt->vindValue(':name', $user->name);
        $stmt->vindValue(':email', $user->email);
        $stmt->vindValue(':password', sha1($user->password));
        $stmt->vindValue(':tel', $user->tel);
        $stmt->vindValue(':univercity', $user->univercity);
        $stmt->vindValue(':undergraduate', $user->undergraduate);
        $stmt->vindValue(':department', $user->department);
        $stmt->vindValue(':school_year', $user->school_year);
        $stmt->vindValue(':graduation_year', $user->graduation_year);
        $stmt->vindValue(':gender', $user->gender);
        $stmt->vindValue(':address', $user->address);
        $stmt->vindValue('address_num', $user->address_num);
        $user_success = $stmt->execute();

        if ($user_success) {
            $user_id = $this->db->lastInsertId();

            foreach ($agencies as $agency) {
                $agencies_stmt = $this->db->prepare('INSERT INTO users_agencies (user_id, agency_id) VALUES (:user_id, :agency_id)');
                $agencies_stmt->bindValue(':user_id', $user_id);
                $agencies_stmt->bindValue(':agency_id', $agency);
                $success = $agencies_stmt->execute();
                if (!$success) {
                    exit;
                }
            }
        }

        return true;
    }
}
`
