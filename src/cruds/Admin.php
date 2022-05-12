<?php

namespace cruds;

class Admin
{
    public function __construct($db)
    {
        $this->db = $db;
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
}
