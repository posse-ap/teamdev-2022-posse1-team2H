<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use cruds\User;
use modules\utils\Utils;

$user_cruds = new User($db);
$types = null;
$industries = null;
if (!empty($_GET['types'])) {
    $types = Utils::h($_GET['types']);
    $types = explode(",", $types);
}
if (!empty($_GET['industries'])) {
    $industries = Utils::h($_GET['industries']);
    $industries = explode(",", $industries);
}
$results = $user_cruds->getAgencies($types, $industries);
echo $results;
exit;
