<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Admin as Auth;
use cruds\Admin as Crud;

$auth = new Auth($db);
$crud = new Crud($db);

$auth->validate();

$id = $_GET['id'];

if (!isset($id)) {
    header('Location: index.php');
}

$user = $crud->getUserDetail($id);
$user = json_decode($user);

include dirname(__FILE__) . '/header.php';
?>

<body>
    <header>
        <div class="header_inner">
            <a href="./index.php">初期画面へ</a>
        </div>
    </header>
    <main>
        <div class="content_wrapper">
            <ul class="content_inner">
                <li id="name">氏名: <?= $user->name ?></li>
                <li id="age">年齢: <?= $user->age ?></li>
                <li id="email">Email: <?= $user->email ?></li>
                <li id="tel">電話番号: <?= $user->tel ?></li>
                <li id="univercity">大学名: <?= $user->university ?></li>
                <li id="undergraduate">学部: <?= $user->undergraduate ?></li>
                <li id="department">学科: <?= $user->department ?></li>
                <li id="school_year">学年: <?= $user->school_year ?></li>
                <li id="graduation_year">卒業年: <?= $user->graduation_year ?>年</li>
                <li id="gender">性別:
                    <?php if ($user->gender == 0): ?>
                        男性
                    <?php else: ?>
                        女性
                    <?php endif ?>
                </li>
                <li id="address">住所: <?= $user->address ?></li>
                <li id="address_num">郵便番号: <?= $user->address_num ?></li>
            </ul>
            <div class="num_sent_infromation">企業に応募した件数：<?= $user->count ?>件</div>

        </div>
    </main>


    <?php include dirname(__FILE__) . '/footer.php' ?>
