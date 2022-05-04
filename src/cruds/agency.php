<?php

namespace cruds;

class Agency
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUsers($agency_id, $mode = true)
    {
        if ($mode === true) {
            $sort = "DESC";
        } else {
            $sort = "ASC";
        }
        $stmt = $this->db->prepare('SELECT * FROM users
        WHERE id IN (
            SELECT user_id FROM users_agencies WHERE agency_id = :agency_id
            OEDER BY updated_at %s
        )', $sort);
        $stmt->bindValue(':agency_id', $agency_id);
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

    public function getManager($manager_id)
    {
        $stmt = $this->db->prepare('SELECT
         *
         FROM managers
         WHERE id = :manager_id');
        $stmt->bindValue(':manager_id', $manager_id, \PDO::PARAM_INT);
        $success = $stmt->execute();

        if ($success) {
            $manager = $stmt->fetch(\PDO::FETCH_ASSOC);
            extract($manager);
            $result = array(
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'is_representative' => $is_representative,
                'agency_id' => $agency_id
            );
            return json_encode($result);
        }
        return null;
    }

    public function loginManager($email, $password)
    {
        $stmt = $this->db->prepare('SELECT
         *
         FROM managers
         WHERE email = :email
         and password = :password');
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', sha1($password));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
