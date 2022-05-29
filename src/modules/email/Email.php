<?php

namespace modules\email;

use modules\utils\Utils;

class Email
{
    private static function genarateUserText($user) {
        $text = "
        氏名: " . $user['name'] ."
        年齢: " . $user['age'] . "
        email: " . $user['email'] . "
        電話番号: " . $user['tel'] . "
        大学: " . $user['university'] . "
        学部: " . $user['undergraduate'] . "
        学科: " . $user['department'] . "
        学年: " . $user['school_year'] . "
        卒業予定年: " . $user['graduation_year'] . "
        性別: " . Utils::gender($user['gender'])  . "
        住所: " . $user['address'] . "
        郵便番号: " . $user['address_num'] . "
        ";
        return $text;
    }
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

    public static function generateTextToAgency($user) {
        $user_text = self::genarateUserText($user);
        $text = "
        学生があなたの企業にお問い合わせを送りました。

        --- 送信された個人情報 ---\n
        " . $user_text;
        return $text;
    }

    public static function generateTextToUser($user, $agencies) {
        $user_text = self::genarateUserText($user);
        $agencies_text = "";
        foreach($agencies as $agency){
            $agencies_text .= $agency['name'] . "\n";
        }
        $text = "お問い合わせありがとうございます。\n
        " . $agencies_text . "に以下の内容で" . $user['name'] . "様のお問い合わせ内容を送信しました。


        " . $user_text;
        return $text;
    }
}
