<?php

namespace modules\email;

use modules\utils\Utils;

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
        $agencies_text = "";
        foreach($agencies as $agency){
            $agencies_text .= $agency . "\n";
        }

        $text = "お問い合わせありがとうございます。\n
        " . $agencies_text . "に以下の内容で〇〇様のお問い合わせ内容を送信しました。

        氏名: " . $user->name ."
        年齢: " . $user->age . "
        email: " . $user->email . "
        電話番号: " . $user->tel . "
        大学: " . $user->university . "
        学部: " . $user->undergraduate . "
        学科: " . $user->department . "
        学年: " . $user->school_year . "
        卒業予定年: " . $user->graduation_year . "
        性別: " . $user->gender  . "
        住所: " . $user->address . "
        郵便番号: " . $user->address_num . "
        "; // TODO filter gender using Utils::gender()
        return $text;
    }
}
