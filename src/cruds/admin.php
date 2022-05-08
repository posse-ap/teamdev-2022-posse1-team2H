<?php

namespace Cruds;

class Admin 
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAgencies()
    {
        $stmt = $this->db->prepare('SELECT*from agencies');
        $stmt->execute();
        
        $num = $stmt->rowcount();
        
        if($num > 0){
            $values = array();
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    'id' => $id,
                    'name' => $name,                   
                    // '' => ,                   
                    // '' => ,                   
                    // '' => ,                   
                );
                array_push($values, $item);
            }
            return json_encode($values, JSON_UNESCAPED_UNICODE);
        }
        return json_encode(array());
    }
    
    public function loginAdministrator($email)
    {
        $stmt = $this->db->prepare('SELECT
        *
        FROM administorators
        WHERE email = :email');
       $stmt->bindValue(':email', $email);
       $stmt->execute();

       return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function insertManagers() {
        $stmt = $this->db->prepare("INSERT INTO administorators(name, email, password) VALUES
        ('福場脩真', 'fukuba@example.com', ?),
        ('加茂竜之介', 'kamochan@example.com', ?),
        ('ぬのっち', 'fuse@example.com', ?),
        ('美玲', 'kubota@example.com', ?)");
        $stmt->execute(array(
            password_hash('fukuba', PASSWORD_DEFAULT),
            password_hash('kamo', PASSWORD_DEFAULT),
            password_hash('nuno', PASSWORD_DEFAULT),
            password_hash('mirei', PASSWORD_DEFAULT)
        ));
        return true;
    }

}
