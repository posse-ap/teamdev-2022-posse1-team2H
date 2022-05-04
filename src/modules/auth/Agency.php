<?php

namespace modules\auth;
use cruds\Agency as Cruds;

class Agency
{
    public function __construct($db)
    {
        $this->crud = new Cruds($db);
    }

    public static function validate()
    {
        if (isset($_SESSION['agency_manager']['id']) && $_SESSION['agency_manager']['time'] + 3600 > time()) {
            $_SESION['agency_manager']['time'] = time();
        } else {
            header('Location: login.php');
            exit();
        }
    }

    public function login($email, $password) {
        $manager = $this->crud->loginManager($email, $password);
        if ($manager) {
            $_SESSION['agency_manager']['id'] = $manager['id'];
            $_SESSION['agency_manager']['time'] = time();
        }

    }
}
