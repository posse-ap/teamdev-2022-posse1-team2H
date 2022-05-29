<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use cruds\Admin;

$crud = new Admin($db);

$id = $_GET['id'];
$year = $_GET['year'];
$month = $_GET['month'];

echo $crud->getAgencyContractsDetail($id, $year, $month);
exit();
