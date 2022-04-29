<?php

namespace cruds;

class Agency
{
    public function __construct($db, $agency_id)
    {
        $this->db = $db;
        $this->agency_id = $agency_id;
    }

    public function getUsers()
    {
        $stmt = $this->db->prepare('SELECT * FROM users
        WHERE id IN (
            SELECT user_id FROM users_agencies WHERE agency_id = :agency_id
        )');
        $stmt->bindValue(':agency_id', $this->agency_id);
        $stmt->execute();

        $num = $stmt->rowCount();

        if ($num > 0) {
            $values = array();
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    'id' => $id,
                    'name' => $name,
                    'email' => $email,
                    'tel' => $tel,
                    'univercity' => $univercity,
                    'undergraduate' => $undergraduate,
                    'department' => $department,
                    'school_year' => $school_year,
                    'graduation_year' => $graduation_year,
                    'gender' => $gender,
                    'address' => $address,
                    'address_num' => $address_num
                );
                array_push($values, $item);
            }
            return json_encode($values, JSON_UNESCAPED_UNICODE);
        }
        return json_encode(array());
    }
}
