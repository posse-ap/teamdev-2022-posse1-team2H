<?php

namespace models;

class User
{
    function __construct(
        $name,
        $email,
        $tel,
        $univercity,
        $undergraduate,
        $department,
        $school_year,
        $graduation_year,
        $gender,
        $address,
        $address_num
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->tel = $tel;
        $this->univercity = $univercity;
        $this->undergraduate = $undergraduate;
        $this->department = $department;
        $this->school_year = $school_year;
        $this->graduation_year = $graduation_year;
        $this->gender = $gender;
        $this->address = $address;
        $this->address_num = $address_num;
    }
}
