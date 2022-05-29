<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
 // Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

use cruds\Agency;
use modules\utils\Utils;

$crud = new Agency($db, $_SESSION['agency_id']);
if (!empty($_GET['sortMode'])) {
    $sort = Utils::h($_GET['sortMode']);
}

$results = $crud->getUsers($sort);
echo $results;
exit;
