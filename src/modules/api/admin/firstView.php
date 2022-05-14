<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use cruds\Admin;

$crud = new Admin($db);
$results = $crud->getAgencies($year=date('Y'), $month=date('m'));  //TODO 先月にする
echo $results;
exit;
