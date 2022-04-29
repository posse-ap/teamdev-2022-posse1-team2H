<?php

namespace modules\email;

class Email
{

    public static function sendMail($to, $from, $title, $message)
    {
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        $headers = "From: ";
        $headers .= $from;
        $headers .= "\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8";

        return mb_send_mail($to, $title, $message, $headers);
    }
}
