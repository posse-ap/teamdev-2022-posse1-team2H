<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use cruds\User;

$user_cruds = new User($db);
$results = $user_cruds->getAgencies();
echo $results;
exit;
