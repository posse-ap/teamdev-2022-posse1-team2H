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

    public function getManagerWithAgency($manager_id) {
        $stmt = $this->db->prepare("SELECT
            manager.id manager_id,
            manager.name manager_name,
            manager.email manager_email,
            manager.is_representative manager_representative,
            agencies.name agency_name,
            agencies.email agency_email,
            agencies.email_for_notification email_for_notice,
            agencies.tel agency_tel,
            agencies.url agency_url,
            agencies.representative agency_representative,
            agencies.contactor agency_contactor,
            agencies.address agency_address,
            agencies.address_num agency_address_num
            FROM managers
            LEFT JOIN agencies
            ON managers.agency_id = agencies.id
            WHERE manager.id = :manager_id
        ");
        $stmt->bindValue(':manager_id', $manager_id, \PDO::PARAM_INT);
        $success = $stmt->execute();
        $manager = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($success) {
            extract($manager);
            $result = array(
                "id" => $manager_id,
                "name" => $manager_name,
                "email" => $manager_email,
                "manager_representative" => $manager_representative,
                "agency_name" => $agency_name,
                "agency_email" => $agency_email,
                "email_for_notice" => $email_for_notice,
                "agency_tel" => $agency_tel,
                "agency_url" => $agency_url,
                "agency_representative" => $agency_representative,
                "agency_contactor" => $agency_contactor,
                "agency_address" => $agency_address,
                "agency_address_num", $agency_address_num
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

    public function addManager($manager) {
        if ($manager->is_representative == 1) {
            $representative = true;
        } else {
            $representative = false;
        }
        $stmt = $this->db->prepare('INSERT INTO managers (name, email, password, is_representative, agency_id)
        VALUES
        (:name, :email, :password, :representative, :agency_id)');
        $stmt->bindValue(':name', $manager->name, \PDO::PARAM_STR);
        $stmt->bindValue(':email', $manager->email, \PDO::PARAM_STR);
        $stmt->bindValue(':password', password_hash($manager->password, PASSWORD_DEFAULT), \PDO::PARAM_STR);
        $stmt->bindValue(':representative', $representative, \PDO::PARAM_BOOL);
        $stmt->bindValue(':agency_id', $manager->agency_id, \PDO::PARAM_INT);
        $success = $stmt->execute();

        return $success;
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
