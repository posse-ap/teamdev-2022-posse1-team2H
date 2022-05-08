<?php

namespace modules\auth;
use Cruds\Admin as Cruds;

class Admin
{
    public function __construct($db)
    {
        $this->crud = new Cruds($db);
    }

    public function login($email, $password) {
        $administrator = $this->crud->loginAdministrator($email);
        if (password_verify($password, $administrator['password'])) {
            return $administrator;
        } else {
            return null;
        }
    }
}