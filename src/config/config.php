<?php
session_start();
define('DSN', 'mysql:host=craft_db_dev;dbname=shukatsu;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASS', 'password');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

use Craft\Database;

spl_autoload_register(function ($class) {
    $prefix = 'MyApp\\';
    if (strpos($class, $prefix) === 0) {
        $file_name = sprintf(__DIR__ . '/%s.php', substr($class, strlen($prefix)));
        if (file_exists($file_name)) {
            require($file_name);
        } else {
            echo 'File not found ' . $file_name;
            exit;
        }
    }
});

$db = Database::getInstance();
