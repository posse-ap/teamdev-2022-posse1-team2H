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
        $stmt = $this->db->prepare(sprintf(
            'SELECT * FROM users
        WHERE id IN (
            SELECT user_id FROM users_agencies WHERE agency_id = :agency_id
            ORDER BY updated_at %s
        )',
            $sort
        ));
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
            return json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        return null;
    }

    public function loginManager($email)
    {
        $stmt = $this->db->prepare('SELECT
         *
         FROM managers
         WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function insertManagers() {
        $stmt = $this->db->prepare("INSERT INTO managers(name, email, password, is_representative, agency_id) VALUES
        ('福場脩真', 'fukuba@example.com', ?, true, 1),
        ('加茂竜之介', 'kamochan@example.com', ?, true, 2),
        ('ぬのっち', 'fuse@example.com', ?, true, 4),
        ('美玲', 'kubota@example.com', ?, true, 3)");
        $stmt->execute(array(
            password_hash('fukuba', PASSWORD_DEFAULT),
            password_hash('kamo', PASSWORD_DEFAULT),
            password_hash('nuno', PASSWORD_DEFAULT),
            password_hash('mirei', PASSWORD_DEFAULT)
        ));
        return true;
    }

    public function updateManager($manager) {
        $stmt = $this->db->prepare("UPDATE managers
        SET
        name = :name,
        email = :email
        WHERE id = :id
        ");
        $stmt->bindValue(':name', $manager->name, \PDO::PARAM_STR);
        $stmt->bindValue(':email', $manager->email, \PDO::PARAM_STR);
        $stmt->bindValue(':id', $manager->id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
}
