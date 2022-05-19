<?php

namespace modules\email;

class Email
{

    public const BOOZER_EMAIL_FOR_NOTICE = 'boozer@example.jp';

    public static function sendMail($to, $from, $title, $message)
    {
        mb_language("ja");
        mb_internal_encoding("UTF-8");
        $headers = "From: ";
        $headers .= $from;
        $headers .= "\r\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Transfer-Encoding: BASE64\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\n";

        return mb_send_mail($to, $title, $message, $headers);
    }
}
