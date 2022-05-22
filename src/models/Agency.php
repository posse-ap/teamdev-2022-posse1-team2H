<?php

namespace models;

class Agency
{
    public function __construct(
        $agency_id,
        $name,
        $email,
        $email_for_notice,
        $tel,
        $url,
        $representative,
        $contactor,
        $address,
        $address_num
    )
    {
        $this->agency_id = $agency_id;
        $this->name = $name;
        $this->email = $email;
        $this->email_for_notice = $email_for_notice;
        $this->tel = $tel;
        $this->url = $url;
        $this->representative = $representative;
        $this->contactor = $contactor;
        $this->address = $address;
        $this->address_num = $address_num;

    }
}
