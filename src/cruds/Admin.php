<?php

namespace cruds;

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
        id contract_id,
        contract_year_month,
        claim_year_month,
        request_amounts,
        student_unit_price,
        paied
        FROM contracts WHERE id = :contract_id");
        $contract_stmt->bindValue(":contract_id", $contract_id, \PDO::PARAM_INT);
        $contract_stmt->execute();

        $contract = $contract_stmt->fetch(\PDO::FETCH_ASSOC);
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
        $inclause = substr(str_repeat(',?', count($ids)), 1);

        $query = sprintf("SELECT
        id
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

        $num = $stmt->rowCount();

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

    public function createContract()
    {
        $year_month = date("Y-m", strtotime('last month'));
        $stmt = $this->db->prepare("SELECT agency_id, COUNT(*) users_count FROM users_agenciees WHERE user_id IN (
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
                (agency_id, contract_year_month, claim_year_month, request_amounts, student_unit_price)
                VALUES
                (:agency_id, :contract_year_month, :claim_year_month, :request_amounts, :student_unit_price)
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

    public function getUsersFromContract($contract_id)
    {
        $contract = self::getContract($this->db, $contract_id);
        extract($contract);

        $users = self::getUsersInfo($this->db, $agency_id, $claim_year_month);

        return $users;
    }

    public function insertAdmins()
    {
        $stmt = $this->db->prepare("INSERT INTO administorators(name, email, password) VALUES
        ('代表脩真', 'admin@example.com', ?)");
        $stmt->execute(array(
            password_hash('admin', PASSWORD_DEFAULT)
        ));
        return true;
    }

    public function loginAdmin($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM administorators WHERE email = :email");
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function deleteUserFromContract($user_id, $contract_id)
    {
        $contract = self::getContract($this->db, $contract_id);
        extract($contract);

        $stmt = $this->db->prepare("DELETE FROM users_agencies WHERE user_id = :user_id AND DATE_FORMAT(update_at, '%Y%m') = :claim_year_month");
        $stmt->bindValue(':user_id', $user_id, $claim_year_month);

        if ($stmt->execute()) {
            $count_stmt = $this->db->prepare("SELECT
            COUNT(user_id)
            FROM users_agencies
            WHERE agency_id = :agency_id
            AND DATE_FORMAT(update_at, '%Y%m') = :claim_year_month
            GROUP BY agency_id");
            $count_stmt->bindValue(":agency_id", $agency_id, \PDO::PARAM_INT);
            $count_stmt->bindValue(":claim_year_month", $claim_year_month, \PDO::PARAM_STR);
            $count_stmt->execute();
            $count = $count->fetch(\PDO::FETCH_ASSOC);

            $new_amounts = $student_unit_price * (int)$count;
            $update = $this->db->prepare("UPDATE contracts
            SET
            request_amounts = :amounts
            WHERE id = :contract_id
            ");
            $update->bindValue(":amounts", $new_amounts, \PDO::PARAM_INT);
            $update->bindValue(":contract_id", $contract_id, \PDO::PARAM_INT);
            $update->execute();

            return true;
        }
        return false;
    }

    public function getAgencies($year, $month, $sort = true)
    {
        $date_format = (string)$year . sprintf('%02d', $month);
        if ($sort) {
            $sort_mode = "DESC";
        } else {
            $sort_mode = "ASC";
        }
        $query = "SELECT
        agencies.id agency_id,
        agencies.name agency_name,
        contracts.claim_year_month claim,
        contracts.request_amounts amounts
        FROM agencies
        LEFT JOIN contracts
        ON agencies.id = contracts.agency_id
        LEFT JOIN users_agencies
        ON agencies.id = users_agencies.agency_id
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
                $count_stmt = $this->db->prepare("SELECT COUNT(*) FROM users_agencies
                WHERE agency_id = :agency_id
                AND DATE_FORMAT(updated_at, '%Y%m') = :year_month
                GROUP BY agency_id");
                $count_stmt->bindValue(":agency_id", $agency_id . \PDO::PARAM_INT);
                $count_stmt->bindValue(":year_month", $year_month, \PDO::PARAM_STR);
                $count_stmt->execute();
                $count = $count_stmt->fetch(\PDO::FETCH_ASSOC);
                $item = array(
                    'agency_id' => $agency_id,
                    'agency_name' => $agency_name,
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

        while ($data = $stmt->fetch()) {
            extract($data);
            $users = self::getUsersInfo($this->db, $agency_id, $date_format);
            $value = array(
                'agency_id' => $agency_id,
                'agency_name' => $agency_name,
                'agency_email' => $agency_email,
                'contract_year_month' => $contract_year_month,
                'claim_year_month' => $claim_year_month,
                'amounts' => $amounts,
                'users' => $users
            );
            return json_encode($value, JSON_UNESCAPED_UNICODE);
        }
    }
}
