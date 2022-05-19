<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use cruds\Agency as Crud;
use modules\auth\Agency as Auth;

$auth = new Auth($db);
$crud = new Crud($db);

$auth->validate();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $crud->sendContact($content);
}

?>
<form action="" method="POST">
    <textarea name="content" id="" cols="30" rows="10"></textarea>
    <input type="submit" value="submit">
</form>
