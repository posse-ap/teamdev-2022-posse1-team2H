<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use cruds\Agency;

$crud = new Agency($db, $_SESSION['agency_id']);
$results = $crud->getUsers();
echo $results;
exit;
