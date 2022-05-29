<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use cruds\Admin;

$crud = new Admin($db);

$contract_id = $_GET['contract_id'];
$year = $_GET['year'];
$month = $_GET['month'];

$users = $crud->getUsersFromContract($contract_id, $year, $month);
echo $users;
exit();
