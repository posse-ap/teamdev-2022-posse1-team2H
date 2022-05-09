<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Agency as Auth;
use cruds\Agency as Crud;
use models\Manager;

$crud = new Crud($db);
$auth = new Auth($db);

// Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];
$representative = $_POST['representative'];
$agency_id = $_SESSION['agency']['id'];

if ($password === $confirm) {
    $manager = new Manager(
        $name,
        $email,
        $password,
        $representative,
        $agency_id
    );
    $success = $crud->addManager($manager);
    if ($success) {
        echo json_encode(array(
            "message" => "successed"
        ), JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(array(
            "message" => "failed"
        ), JSON_UNESCAPED_UNICODE);
    }
}
exit();
