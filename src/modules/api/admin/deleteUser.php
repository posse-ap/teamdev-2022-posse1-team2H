<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use cruds\Admin;

$user_ids= $_GET['user_ids'];
$user_ids = explode(',', $user_ids);
$contract_id = $_GET['contract_id'];
$year = $_GET['year'];
$month = $_GET['month'];

$crud = new Admin($db);
$value = array();
foreach ($user_ids as $id) {
    $crud->deleteUserFromContract($id, $contract_id);
}

$items = $crud->getAgencyContractsDetail($contract_id, $year, $month);
echo $items;
exit();
