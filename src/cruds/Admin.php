<?php

namespace cruds;

class Admin
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    # TODO: update contract claim function
    private function createContract() {
        $stmt = $this->db->prepare("");
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

    public function getAgencies($sort = true)
    {
        if ($sort) {
            $sort_mode = "DESC";
        } else {
            $sort_mode = "ASC";
        }
        $stmt = $this->db->prepare(sprintf("SELECT
        agencies.id agency_id,
        agencies.name agency_name,
        contracts.claim_year_month claim,
        COUNT(users_agencies.user_id) user_count
        FROM agencies
        LEFT JOIN contracts
        ON agencies.id = contracts.agency_id
        LEFT JOIN users_agencies
        ON agencies.id = users_agencies.agency_id
        WHERE users_agencies.user_id IN (
            SELECT id FROM users
            WHERE DATE_FORMAT(updated_at, '%Y%m') = DATE_FORMAT(now(), '%Y%m')
        )
        ORDER BY agencies.updated_at %s
        ", $sort_mode));

        $stmt->execute();

        $num = $stmt->rowCount();

        if ($num > 0) {
            $values = array();
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    'id' => $id,
                    'name' => $name,
                    'claim' => $claim,
                    'user_count' => $user_count,
                );
                array_push($values, $item);
            }
            return json_encode($values, JSON_UNESCAPED_UNICODE);
        }
        return json_encode(array());
    }
}
