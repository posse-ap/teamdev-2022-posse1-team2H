<?php

namespace models;

class Manager
{
    public function __construct(
        $name,
        $email,
        $password,
        $is_representative,
        $agency_id
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->is_representative = $is_representative;
        $this->agency_id = $agency_id;
    }
}
