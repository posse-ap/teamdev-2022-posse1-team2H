<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use  Cruds\Admin;

$admin_cruds = new admin($db);
$results = $admin_cruds->getAgencies();
echo $results;
exit;