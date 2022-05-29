<?php

namespace models;

class User
{
    public function __construct(
        $name,
        $email,
        $tel,
        $university,
        $undergraduate,
        $department,
        $age,
        $school_year,
        $graduation_year,
        $gender,
        $address,
        $address_num
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->tel = $tel;
        $this->university = $university;
        $this->undergraduate = $undergraduate;
        $this->department = $department;
        $this->age = $age;
        $this->school_year = $school_year;
        $this->graduation_year = $graduation_year;
        $this->gender = $gender;
        $this->address = $address;
        $this->address_num = $address_num;
    }
}
