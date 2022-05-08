<?php

namespace Craft\Cruds;

class Admin 
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function loginAdministrator($email){
        $stmt = $this->db->prepare('SELECT
        *
        FROM administorators
        WHERE email = :email');
       $stmt->bindValue(':email', $email);
       $stmt->execute();

       return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // public function insertManagers() {
    //     $stmt = $this->db->prepare("INSERT INTO managers(name, email, password, is_representative, agency_id) VALUES
    //     ('福場脩真', 'fukuba@example.com', ?, true, 1),
    //     ('加茂竜之介', 'kamochan@example.com', ?, true, 2),
    //     ('ぬのっち', 'fuse@example.com', ?, true, 4),
    //     ('美玲', 'kubota@example.com', ?, true, 3)");
    //     $stmt->execute(array(
    //         password_hash('fukuba', PASSWORD_DEFAULT),
    //         password_hash('kamo', PASSWORD_DEFAULT),
    //         password_hash('nuno', PASSWORD_DEFAULT),
    //         password_hash('mirei', PASSWORD_DEFAULT)
    //     ));
    //     return true;
    // }

}
