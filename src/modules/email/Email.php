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

    public static function generateTextFromUser($user) {


    }

    public static function generatetextToUser($user, $agencies) {
        $text = "お問い合わせありがとうございます。\n
        〇〇に以下の内容で〇〇様のお問い合わせ内容を送信しました。

        氏名:
        年齢:
        email:
        電話番号:
        大学:
        学部:
        学科:
        学年:
        卒業予定年:
        性別:
        住所:
        郵便番号:
        ";
        return $text;
    }
}
