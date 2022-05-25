<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use cruds\Admin;

$crud = new Admin($db);




if (!isset($_GET['year'])) {
    $year = date("Y");
} else {
    $year = $_GET['year'];
}
if (!isset($_GET['month'])) {
    $month = date("m");  //TODO 先月にする
} else {
    $month = $_GET['month'];
}

$results = $crud->getContracts($year, $month);
echo $results;
exit;
