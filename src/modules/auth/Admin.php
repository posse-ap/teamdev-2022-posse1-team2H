<?php

namespace modules\auth;

use cruds\Admin as Cruds;


class Admin
{
    public function __construct($db)
    {
        $this->crud = new Cruds($db);
    }

    public function validate()
    {
        if (isset($_SESSION['admin']['id']) && $_SESSION['admin']['time'] + 3600 > time()) {
            $_SESION['admin']['time'] = time();
        } else {
            header('Location: login.php');
            exit();
        }
    }


    public function login($email, $password)
    {
        $admin = $this->crud->loginAdmin($email);
        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                return $admin;
            } else {
                return null;
            }
        }
        return null;
    }
}
