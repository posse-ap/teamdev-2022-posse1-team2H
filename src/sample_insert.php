<?php

use cruds\User as Crud;
use models\User as Model;
use modules\utils\Utils;
use modules\auth\Token;

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

// validate


include dirname(__FILE__) . '/header.php';
?>
<form action="" method="POST">

    <input type="text" name="name" placeholder="name">
    <input type="text" name="email" placeholder="email">
    <input type="text" name="tel" placeholder="tel">
    <input type="text" name="univercity" placeholder="univercity">
    <input type="text" name="age" placeholder="age">
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
