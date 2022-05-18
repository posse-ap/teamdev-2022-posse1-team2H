<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use cruds\User;

$cruds = new User($db);

$agency_ids = $_GET['agency_ids'];
$agency_ids = explode(",", $agency_ids);

$favs = $cruds->getFav($agency_ids);
echo $favs;
exit();
