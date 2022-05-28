<?php

namespace cruds;

use models\Article;
use modules\email\Email;

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
                    'age' => $age,
                    'email' => $email,
                    'tel' => $tel,
                    'university' => $university,
                    'undergraduate' => $undergraduate,
                    'department' => $department,
                    'school_year' => $school_year,
                    'graduation_year' => $graduation_year,
                    'gender' => $gender,
                    'address' => $address,
                    'address_num' => $address_num,
                    "updated_at" => $updated_at
                );
                array_push($values, $item);
            }
            return json_encode($values, JSON_UNESCAPED_UNICODE);
        }
        return json_encode(array());
    }

    public function getUser($user_id)
    {
        $stmt = $this->db->prepare("SELECT
        *
        FROM users
        WHERE id = :id
        ");
        $stmt->bindValue(':id', $user_id, \PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch();
        return $user;
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

    public function getManagerWithAgency($manager_id)
    {
        $stmt = $this->db->prepare("SELECT
            managers.id manager_id,
            managers.name manager_name,
            managers.email manager_email,
            managers.is_representative manager_representative,
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
            WHERE managers.id = :manager_id
        ");
        $stmt->bindValue(':manager_id', $manager_id, \PDO::PARAM_INT);
        $success = $stmt->execute();

        if ($success) {
            $manager = $stmt->fetch(\PDO::FETCH_ASSOC);
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

    public function getManagers($agency_id)
    {
        $stmt = $this->db->prepare("SELECT
        id,
        name,
        email,
        is_representative
        FROM managers
        WHERE agency_id = ?
        ");
        $stmt->execute(array($agency_id));
        $num = $stmt->rowCount();

        if ($num > 0) {
            $values = array();
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    'id' => $id,
                    'name' => $name,
                    'email' => $email,
                    'is_representative' => $is_representative
                );
                array_push($values, $item);
            }
            return json_encode($values, JSON_UNESCAPED_UNICODE);
        }
        return json_encode(array());
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

    public function insertManagers()
    {
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

    public function addManager($manager)
    {
        $stmt = $this->db->prepare('INSERT INTO managers (name, email, password, is_representative, agency_id)
        VALUES
        (:name, :email, :password, :representative, :agency_id)');
        $stmt->bindValue(':name', $manager->name, \PDO::PARAM_STR);
        $stmt->bindValue(':email', $manager->email, \PDO::PARAM_STR);
        $stmt->bindValue(':password', password_hash($manager->password, PASSWORD_DEFAULT), \PDO::PARAM_STR);
        $stmt->bindValue(':representative', $manager->is_representative, \PDO::PARAM_BOOL);
        $stmt->bindValue(':agency_id', $manager->agency_id, \PDO::PARAM_INT);
        $success = $stmt->execute();

        return $success;
    }

    public function updateManager($manager)
    {
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

    public function deleteManager($manager_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM managers WHERE id = ?");
        $stmt->execute(array($manager_id));
        $manager = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!($manager['agency_id'] == $_SESSION['agency']['id'])) {
            throw new \Exception();
        }
        if (!$manager['is_representative']) {

            try {
                $stmt = $this->db->prepare("DELETE FROM managers
            WHERE id = :manager_id");
                $stmt->bindValue(':manager_id', $manager_id, \PDO::PARAM_INT);
                $stmt->execute();
            } catch (\Exception $e) {
                throw $e;
            }
        }
        return $manager_id;
    }

    public function sendEditRequest(Article $article)
    {
        $text = '
        以下の内容で掲載記事の編集を依頼します。

        タイトル:';
        $text .= $article->title;
        $text .= '本文: ';
        $text .=  $article->sentenses;
        $text .= '
        アイキャッチ: ';
        $text .= $article->eyecatch;
        $agency = json_decode(
            self::getManagerWithAgency($_SESSION['agency_manager']['id'])
        );
        $to = Email::BOOZER_EMAIL_FOR_NOTICE;
        Email::sendMail($to, $agency->agency_email, '掲載記事の編集依頼', $text);
    }

    public function sendContact($content)
    {
        $agency = json_decode(
            self::getManagerWithAgency($_SESSION['agency_manager']['id'])
        );
        $to = Email::BOOZER_EMAIL_FOR_NOTICE;
        $from = $agency->agency_email;
        $title = 'お問い合わせ';
        $message = $agency->name;
        $message .= 'からお問い合わせです。
        お問い合わせ内容: ';
        $message .= $content;
        Email::sendMail($to, $from, $title, $message);
    }
}
