<?php

namespace modules\auth;
use Craft\Cruds\Admin as Cruds;

class Admin
{
    public function __construct($db)
    {
        $this->crud = new Cruds($db);
    }

    public function login($email, $password) {
        $manager = $this->crud->loginManager($email);
        if (password_verify($password, $manager['password'])) {
            return $manager;
        } else {
            return null;
        }
    }
}