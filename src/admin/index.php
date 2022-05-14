<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Admin as Auth;
use cruds\Admin as Cruds;

$auth = new Auth($db);
$cruds = new Cruds($db);

$auth->validate();

include dirname(__FILE__) . '/header.php';
?>

<?php include dirname(__FILE__) . '/footer.php' ?>
