<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use cruds\Admin;

$user_ids= $_GET['user_ids'];
$agency_id = $_GET['agency_id'];

$crud = new Admin($db);
$value = array();
foreach ($user_ids as $id) {
    $item = $crud->deleteUserFromContract($user_id, $contract_id);
    array_push($value, $item);
}
echo $value;
exit();
