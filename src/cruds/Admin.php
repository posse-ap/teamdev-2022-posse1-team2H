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

    public function createContract() {
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
        ORDER BY agencies.updated_at " . $sort_mode ."";
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
                $count_stmt->bindValue(":agency_id", $agency_id. \PDO::PARAM_INT);
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

    public function getAgencyContractsDetail($year, $month) {
        $stmt = $this->db->prepare("SELECT

         FROM agencies");
    }
}
