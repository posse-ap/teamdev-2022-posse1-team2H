<?php

namespace cruds;

use models\Agency;
use models\Article;

class Admin
{
    // 学生単価
    private const STUDENT_UNIT_PRICE = 1000;

    public function __construct($db)
    {
        $this->db = $db;
    }

    private function getContract($db, $contract_id)
    {
        $contract_stmt = $db->prepare("SELECT
        contracts.id contract_id,
        DATE_FORMAT(contracts.contract_year_month, '%Y%m') contract_year_month,
        DATE_FORMAT(contracts.claim_year_month, '%Y%m') claim_year_month,
        contracts.request_amounts request_amounts,
        contracts.student_unit_price student_unit_price,
        contracts.paied paied,
        agencies.id agency_id,
        agencies.name name
        FROM contracts
        LEFT JOIN agencies
        ON contracts.agency_id = agencies.id
        WHERE contracts.id = :contract_id");
        $contract_stmt->bindValue(":contract_id", $contract_id, \PDO::PARAM_INT);
        $contract_stmt->execute();

        $contract = $contract_stmt->fetch();
        return $contract;
    }

    private function getUsersInfo($db, $agency_id, $year_month)
    {
        $stmt = $db->prepare("SELECT
        user_id FROM users_agencies
        WHERE agency_id = :agency_id
        AND DATE_FORMAT(created_at, '%Y%m') = :year_month");

        $stmt->bindValue(':agency_id', $agency_id, \PDO::PARAM_INT);
        $stmt->bindValue(':year_month', $year_month, \PDO::PARAM_INT);
        $stmt->execute();
        $ids = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (!empty($ids)) {
            $ids = array_column($ids, 'user_id');

            $inclause = substr(str_repeat(',?', count($ids)), 1);

            $query = sprintf("SELECT
            id,
            name,
            age,
            gender,
            created_at
            FROM users
            WHERE id IN (
                %s
            )
            ", $inclause);
            $stmt = $db->prepare($query);
            $stmt->execute($ids);
            $num = $stmt->rowCount();
        } else {
            $num = 0;
        }

        if ($num > 0) {
            $values = array();

            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    "id" => $id,
                    "name" => $name,
                    "age" => $age,
                    "gender" => $gender,
                    "created_at" => $created_at
                );
                array_push($values, $item);
            }
            return json_encode($values, JSON_UNESCAPED_UNICODE);
        }
        return json_encode(array());
    }

    private function getContractsByAgencyId($agency_id)
    {
        $stmt = $this->db->prepare("SELECT
        id contract_id,
        contract_year_month,
        claim_year_month,
        request_amounts
        FROM contracts
        WHERE agency_id = :id
        ");
        $stmt->bindValue(':id', $agency_id, \PDO::PARAM_INT);
        $stmt->execute();

        $num = $stmt->rowCount();
        if ($num > 0) {
            $values = array();
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    "contract_id" => $contract_id,
                    "contract_year_month" => $contract_year_month,
                    "claim_year_month" => $claim_year_month,
                    "request_amounts" => $request_amounts
                );
                array_push($values, $item);
            }
            return $values;
        }
        return null;
    }

    public function createContract()
    {
        $year_month = date("Y-m", strtotime('last month'));
        $stmt = $this->db->prepare("SELECT
        agency_id,
        COUNT(*)
        users_count
        FROM users_agenciees
        WHERE user_id IN (
            SELECT id FROM users
            WHERE DATE_FORMAT(updated_at, '%Y%m') = :year_month
        ) GROUP BY agency_id");

        $stmt->bindValue(":year_month", $year_month, \PDO::PARAM_INT);
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $request_amounts = self::STUDENT_UNIT_PRICE * $user_count;
                $claim = date('Y-m-d', strtotime('last day of next month', $year_month));
                $create_stmt = $this->db->prepare("INSERT INTO contracts
                (agency_id,
                contract_year_month,
                claim_year_month,
                request_amounts,
                student_unit_price)
                VALUES
                (:agency_id,
                :contract_year_month,
                :claim_year_month,
                :request_amounts,
                :student_unit_price)
                ");
                $create_stmt->bindValue(":agency_id", $agency_id, \PDO::PARAM_INT);
                $create_stmt->bindValue(":contract_year_month", $year_month, \PDO::PARAM_INT);
                $create_stmt->bindValue(":claim_year_month", $claim);
                $create_stmt->bindValue(":request_amounts", $request_amounts, \PDO::PARAM_INT);
                $create_stmt->bindValue(":student_unit_price", self::STUDENT_UNIT_PRICE, \PDO::PARAM_INT);
                $create_stmt->execute();
            }
        }
        return;
    }

    public function getUsersFromContract($contract_id, $year, $month)
    {
        $date_format = (string)$year . sprintf('%02d', $month);
        $contract = self::getContract($this->db, $contract_id);
        extract($contract);
        $users = self::getUsersInfo($this->db, $agency_id, $date_format);

        return $users;
    }

    public function insertAdmins()
    {
        $stmt = $this->db->prepare("INSERT INTO
        administorators
        (name, email, password)
        VALUES
        ('代表脩真', 'admin@example.com', ?)");
        $stmt->execute(array(
            password_hash('admin', PASSWORD_DEFAULT)
        ));
        return true;
    }

    public function loginAdmin($email)
    {
        $stmt = $this->db->prepare("SELECT
         *
        FROM
        administorators
        WHERE email = :email");
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function deleteUserFromContract($user_id, $contract_id)
    {
        $contract = self::getContract($this->db, $contract_id);
        extract($contract);

        $stmt = $this->db->prepare("DELETE
        FROM users_agencies
        WHERE user_id = :user_id
        AND DATE_FORMAT(updated_at, '%Y%m') = :contract_year_month");
        $stmt->bindValue(':user_id', $user_id, \PDO::PARAM_INT);
        $stmt->bindValue(':contract_year_month', $contract_year_month, \PDO::PARAM_STR);
        $success = $stmt->execute();

        if ($success) {
            $count_stmt = $this->db->prepare("SELECT
            *
            FROM users_agencies
            WHERE agency_id = :agency_id
            AND DATE_FORMAT(updated_at, '%Y%m') = :contract_year_month");
            $count_stmt->bindValue(":agency_id", $agency_id, \PDO::PARAM_INT);
            $count_stmt->bindValue(":contract_year_month", $contract_year_month, \PDO::PARAM_STR);
            $count_stmt->execute();
            $count = $count_stmt->rowCount();

            $new_amounts = $student_unit_price * (int)$count;
            $update = $this->db->prepare("UPDATE contracts
            SET
            request_amounts = :amounts
            WHERE id = :contract_id
            ");
            $update->bindValue(":amounts", $new_amounts, \PDO::PARAM_INT);
            $update->bindValue(":contract_id", $contract_id, \PDO::PARAM_INT);
            $update->execute();

            return $contract;
        }
        return false;
    }

    public function getUserDetail($user_id)
    {
        $stmt = $this->db->prepare("SELECT
        id,
        name,
        age,
        email,
        tel,
        university,
        undergraduate,
        department,
        school_year,
        graduation_year,
        gender,
        address,
        address_num
        FROM users
        WHERE id = :user_id
        ");
        $stmt->bindValue(":user_id", $user_id, \PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        $count_stmt = $this->db->prepare("SELECT * FROM users_agencies
        WHERE user_id = :user_id
        ");
        $count_stmt->bindValue(":user_id", $user_id, \PDO::PARAM_INT);
        $count_stmt->execute();

        $count = $count_stmt->rowcount();
        extract($user);
        $item = array(
            "id" => $id,
            "name" => $name,
            "age" => $age,
            "email" => $email,
            "tel" => $tel,
            "university" => $university,
            "undergraduate" => $undergraduate,
            "department" => $department,
            "school_year" => $school_year,
            "graduation_year" => $graduation_year,
            "gender" => $gender,
            "address" => $address,
            "address_num" => $address_num,
            "count" => $count,
        );
        return json_encode($item, JSON_UNESCAPED_UNICODE);
    }

    public function getContracts($year, $month, $sort = true)
    {
        $date_format = (string)$year . sprintf('%02d', $month);
        if ($sort) {
            $sort_mode = "DESC";
        } else {
            $sort_mode = "ASC";
        }
        $query = "SELECT
        contracts.id contract_id,
        DATE_FORMAT(contracts.contract_year_month, '%Y%m') contract_year_month,
        contracts.claim_year_month claim,
        contracts.request_amounts amounts,
        agencies.id agency_id,
        agencies.name agency_name
        FROM contracts
        LEFT JOIN agencies
        ON contracts.agency_id = agencies.id
        WHERE DATE_FORMAT(contracts.contract_year_month, '%Y%m') = :year_month
        ORDER BY agencies.updated_at " . $sort_mode . "";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":year_month", $date_format, \PDO::PARAM_STMT);
        $stmt->execute();

        $num = $stmt->rowCount();

        if ($num > 0) {
            $values = array();
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $count_stmt = $this->db->prepare("SELECT
                COUNT(*)
                FROM users_agencies
                WHERE agency_id = :agency_id
                AND DATE_FORMAT(created_at, '%Y%m') = :year_month
                GROUP BY agency_id");

                $count_stmt->bindValue(":agency_id", $agency_id . \PDO::PARAM_INT);
                $count_stmt->bindValue(":year_month", $contract_year_month, \PDO::PARAM_STR);
                $count_stmt->execute();
                $count = $count_stmt->fetch(\PDO::FETCH_ASSOC);
                if ($count == false) {
                    $count = 0;
                }
                $item = array(
                    'agency_id' => $agency_id,
                    'agency_name' => $agency_name,
                    'contract_id' => $contract_id,
                    'contract_year_month' => $contract_year_month,
                    'claim' => $claim,
                    'amounts' => $amounts,
                    'user_count' => $count
                );
                array_push($values, $item);
            }
            return json_encode($values, JSON_UNESCAPED_UNICODE);
        }
        return json_encode(array());
    }

    public function getAgencyContractsDetail($agency_id, $year, $month)
    {
        $date_format = (string)$year . sprintf('%02d', $month);
        $stmt = $this->db->prepare("SELECT
        agencies.id agency_id,
        agencies.name agency_name,
        agencies.email agency_email,
        contracts.id contract_id,
        contracts.contract_year_month contract_year_month,
        contracts.claim_year_month claim_year_month,
        contracts.request_amounts amounts
        FROM agencies
        LEFT JOIN contracts
        ON agencies.id = contracts.agency_id
        WHERE agencies.id = :agency_id
        AND DATE_FORMAT(contracts.contract_year_month, '%Y%m') = :year_month
        ");
        $stmt->bindValue(':agency_id', $agency_id, \PDO::PARAM_INT);
        $stmt->bindValue(':year_month', $date_format, \PDO::PARAM_STR);
        $stmt->execute();

        $values = array();
        while ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            extract($data);
            $users = json_decode(self::getUsersInfo($this->db, $agency_id, $date_format));
            $value = array(
                'agency_id' => $agency_id,
                'agency_name' => $agency_name,
                'agency_email' => $agency_email,
                'contract_id' => $contract_id,
                'contract_year_month' => $contract_year_month,
                'claim_year_month' => $claim_year_month,
                'amounts' => $amounts,
                'users' => $users
            );
            array_push($values, $value);
        }
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getAgencyDetail($agency_id, $contract_mode = true)
    {
        $stmt = $this->db->prepare("SELECT
        agencies.id agency_id,
        agencies.name name,
        agencies.email email,
        agencies.email_for_notification email_for_notification,
        agencies.tel tel,
        agencies.url url,
        agencies.representative representative,
        agencies.contactor contactor,
        agencies.address address,
        agencies.address_num address_num,
        agency_articles.title title,
        agency_articles.sentenses sentenses,
        agency_articles.eyecatch_url eyecatch
        FROM agencies
        LEFT JOIN agency_articles
        ON agencies.id = agency_articles.agency_id
        WHERE agencies.id = :id
        ");
        $stmt->bindValue(":id", $agency_id, \PDO::PARAM_INT);
        $success = $stmt->execute();
        if (!$success) {
            return json_encode(array(), JSON_UNESCAPED_UNICODE);
        }
        $agency = $stmt->fetch();

        extract($agency);
        $res = array(
            "agency_id" => $agency_id,
            "name" => $name,
            "email" => $email,
            "email_for_notification" => $email_for_notification,
            "tel" => $tel,
            "url" => $url,
            "representative" => $representative,
            "contactor" => $contactor,
            "address" => $address,
            "address_num" => $address_num,
            "title" => $title,
            "sentenses" => $sentenses,
            "eyecatch" => $eyecatch
        );

        if ($contract_mode) {
            $contracts = self::getContractsByAgencyId($agency_id);
            $res['contracts'] = $contracts;
        }
        return json_encode($res, JSON_UNESCAPED_UNICODE);
    }

    public function updateAgency(Agency $agency)
    {
        $stmt = $this->db->prepare("UPDATE agencies
        SET
        name = :name,
        email = :email,
        email_for_notification = :email_for_notification,
        tel = :tel,
        url = :url,
        representative = :representative,
        contactor = :contactor,
        address = :address,
        address_num = :address_num
        WHERE id = :id
        ");
        $stmt->bindValue(":name", $agency->name, \PDO::PARAM_STR);
        $stmt->bindValue(":email", $agency->email, \PDO::PARAM_STR);
        $stmt->bindValue(":email_for_notification", $agency->email_for_notification, \PDO::PARAM_STR);
        $stmt->bindValue(":tel", $agency->tel, \PDO::PARAM_STR);
        $stmt->bindValue(":url", $agency->url, \PDO::PARAM_STR);
        $stmt->bindValue(":representative", $agency->representative, \PDO::PARAM_STR);
        $stmt->bindValue(":contactor", $agency->contactor, \PDO::PARAM_STR);
        $stmt->bindValue(":address", $agency->address, \PDO::PARAM_STR);
        $stmt->bindValue(":address_num", $agency->address_num, \PDO::PARAM_STR);
        $stmt->bindValue(":id", $agency->agency_id, \PDO::PARAM_INT);

        $stmt->execute();
        return $agency;
    }

    public function updateArticle(Article $article)
    {
        $stmt = $this->db->prepare("UPDATE agency_articles
        SET
        title = :title,
        sentenses = :sentenses,
        eyecatch_url = :eyecatch_url
        WHERE agency_id = :agency_id
        ");
        $stmt->bindValue(":title", $article->title, \PDO::PARAM_STR);
        $stmt->bindValue(":sentenses", $article->sentenses, \PDO::PARAM_STR);
        $stmt->bindValue(":eyecatch_url", $article->eyecatch_url, \PDO::PARAM_STR);
        $stmt->bindValue(":agency_id", $article->agency_id, \PDO::PARAM_INT);

        $stmt->execute();

        return $article;
    }

    public function getAgencies()
    {
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

        $num = $stmt->rowCount();
        if ($num > 0) {
            $values = array();
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    'id' => $id,
                    'name' => $name,
                    'title' => $title,
                    'sentenses' => $sentenses,
                    'eyecatch_url' => $eyecatch_url
                );
                array_push($values, $item);
            }
            return json_encode($values, JSON_UNESCAPED_UNICODE);
        }
        return json_encode(array(), JSON_UNESCAPED_UNICODE);
    }
}
