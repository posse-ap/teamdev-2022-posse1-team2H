<?php
session_start();
define('DSN', 'mysql:host=craft_db_dev;dbname=shukatsu;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASS', 'password');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

use database\Database;
use modules\auth\Token;

// クラスを自動ロードする関数
spl_autoload_register(function ($classname){
    //クラス名を\で分割した配列を作成。
    $classNameArray = explode("\\", $classname);  // （2）
    //ファイルパス用文字列変数を用意。
    $filepath = "";
    //分割されたクラス名配列をループさせながらファイルパスを生成。
    for($i = 0; $i < count($classNameArray); $i++) {  // （3）
        $filepath .= "/".$classNameArray[$i];
    }
    //ファイルパスの前にドキュメントルートのパス、後に拡張子を追加。
    $filepath = $_SERVER["DOCUMENT_ROOT"].$filepath.".php";  // （4）
    //ファイルパスの先が正常ファイルかどうかを判定。
    if(is_file($filepath)) {  // （5）
        //正常パスなら読込。
        require_once  $filepath;  // （6）
    }
});

Token::create();

$db = Database::getInstance();
