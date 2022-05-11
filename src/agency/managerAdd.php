<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Agency as Auth;
use cruds\Agency as Crud;
use models\Manager;
use modules\utils\Utils;
use modules\auth\Token;

$auth = new Auth($db);
$crud = new Crud($db);

$auth->validate();
$manager = $crud->getManager($_SESSION['agency_manager']['id']);

$manager = json_decode($manager);

$auth->validateRepreserntative($manager);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    Token::validate();
    if (!isset($_REQUEST['name'])) {
        $error['name'] = 'required';
    }
    if (!isset($_REQUEST['email'])) {
        $error['email'] = 'required';
    }
    if (!isset($_REQUEST['password'])) {
        $error['password'] = 'required';
    }
    if (!isset($_REQUEST['confirm_password'])) {
        $error['confirm_password'] = 'required';
    }
    if ($_REQUEST['password'] !== $_REQUEST['confirm_password']) {
        $error['password'] = 'failed';
    }
    if (empty($error)) {
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $confirm = $_REQUEST['confirm_password'];
        $agency_id = $_SESSION['agency']['id'];
        $representative = false;
        $manager = new Manager(
            $name,
            $email,
            $password,
            $representative,
            $agency_id
        );
        $success = $crud->addManager($manager);
    }
}

include dirname(__FILE__) . '/header.php';
?>

<main id="manager_add">
    <form name="manager_add" method="POST" action="">
        <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']) ?>">
        <input type="text" name="name" placeholder="name">
        <input type="text" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="password" name="confirm_password" placeholder="confirm password">
        <input type="submit" value="submit">
    </form>
</main>

<?php include dirname(__FILE__) . '/footer.php' ?>
