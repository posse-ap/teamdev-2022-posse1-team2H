<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use cruds\Admin as Crud;
use modules\auth\Admin as Auth;

$auth = new Auth($db);
$crud = new Crud($db);

$auth->validate();

include dirname(__FILE__) . '/header.php';
?>

<?php include dirname(__FILE__) . '/footer.php' ?>
