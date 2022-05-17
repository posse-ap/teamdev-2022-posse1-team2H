<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use cruds\Admin;

$user_id = $_GET['user_id'];
$agency_id = $_GET['agency_id'];

$crud = new Admin($db);

echo $crud->deleteUserFromContract($user_id, $contract_id);
exit();
