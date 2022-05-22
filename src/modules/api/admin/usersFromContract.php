<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use cruds\Admin;

$crud = new Admin($db);

$contract_id = $_GET['contract_id'];

$users = $crud->getUsersFromContract($contract_id);
echo $users;
exit();
