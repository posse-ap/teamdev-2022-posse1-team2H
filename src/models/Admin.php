<?php

namespace models;

class Admin
{
    public function __construct(
        $id,
        $name,
        $email,
        $password
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}
