<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Agency as Auth;
use cruds\Agency as Crud;

$auth = new Auth($db);
$crud = new Crud($db);

$auth->validate();
$manager = $crud->getManager($_SESSION['agency_manager']['id']);

$manager = json_decode($manager);

$auth->validateRepreserntative($manager);

include dirname(__FILE__) . '/header.php';
?>

<main id="manager_add">
    <form name="manager_add" method="POST">
        <input type="text" name="name" placeholder="name">
        <input type="text" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="password" name="confirm_password" placeholder="confirm password">
        <input type="checkbox" name="representative">
        <button onclick="handleManagerData()">submit</button>
    </form>
</main>

<?php include dirname(__FILE__) . '/footer.php' ?>
