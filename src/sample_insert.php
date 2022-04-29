<?php

use cruds\User as Crud;
use models\User as Model;
use modules\utils\Utils;
use modules\auth\Token;

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

// validate
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array();
    Token::validate();
    if (!isset($_REQUEST['name'])) {
        $error['name'] = 'name required';
    }
    if (!isset($_REQUEST['email'])) {
        $error['email'] = 'email required';
    }
    if (!isset($_REQUEST['password']) || strlen($_REQUEST['password']) <= 4) {
        $error['password'] = 'password must be more than 4 length';
    }
    if (!isset($_REQUEST['tel'])) {
        $error['tel'] = 'tel required';
    }
    if (!isset($_REQUEST['univercity'])) {
        $error['univercity'] = 'univercity required';
    }
    if (!isset($_REQUEST['undergraduate'])) {
        $error['undergraduate'] = 'undergraduate required';
    }
    if (!isset($_REQUEST['department'])) {
        $error['department'] = 'department required';
    }
    if (!isset($_REQUEST['school_year'])) {
        $error['school_year'] = 'school year required';
    }
    if (!isset($_REQUEST['graduation_year'])) {
        $error['graduation_year'] = 'graduation_year required';
    }
    if (!isset($_REQUEST['gender'])) {
        $error['gender'] = 'gender required';
    }
    if (!isset($_REQUEST['address'])) {
        $error['address'] = 'address required';
    }
    if (!isset($_REQUEST['address_num'])) {
        $error['address_num'] = 'address_num required';
    }
    if (empty($error)) {
        $crud = new Crud($db);
        $user = new Model(
            $_REQUEST['name'],
            $_REQUEST['email'],
            $_REQUEST['password'],
            $_REQUEST['tel'],
            $_REQUEST['univercity'],
            $_REQUEST['undergraduate'],
            $_REQUEST['department'],
            $_REQUEST['school_year'],
            $_REQUEST['graduation_year'],
            $_REQUEST['gender'],
            $_REQUEST['address'],
            $_REQUEST['address_num']
        );
        $agencies = ['1'];
        $crud->insertUser($user, $agencies);
        header('Location: index.php');
        exit;
    }
}

include dirname(__FILE__) . '/header.php';
?>
<form action="" method="POST">
    <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']) ?>">
    <input type="text" name="name" placeholder="name">
    <input type="text" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <input type="text" name="tel" placeholder="tel">
    <input type="text" name="univercity" placeholder="univercity">
    <input type="text" name="undergraduate" placeholder="undergraduate">
    <input type="text" name="department" placeholder="department">
    <input type="text" name="school_year" placeholder="school_year">
    <input type="text" name="graduation_year" placeholder="graduation year">
    <label><input type="radio" name="gender" value="1">男</label>
    <label><input type="radio" name="gender" value="0">女</label>
    <input type="text" name="address" placeholder="address">
    <input type="text" name="address_num" placeholder="address_num">
    <input type="submit" value="submit">
</form>
<?php include dirname(__FILE__) . '/footer.php' ?>
