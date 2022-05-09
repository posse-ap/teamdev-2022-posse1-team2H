<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency as Auth;
use cruds\Agency as Crud;

$crud = new Crud($db);
$auth = new Auth($db);
$auth->validate();
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

$results = $crud->getManagerWithAgency($_SESSION['agency_manager']['id']);
echo $results;
exit;
