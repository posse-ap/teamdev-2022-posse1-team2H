<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Admin as Auth;
use cruds\Admin as Cruds;

$auth = new Auth($db);
$cruds = new Cruds($db);

$auth->validate();

$id = $_GET['id'];

if (!isset($id)) {
    header('Location: index.php');
}

$agency = $cruds->getAgencyDetail($id);

$agency = json_decode($agency);

include dirname(__FILE__) . '/header.php';
?>

<body>
    <header>
        <div class="header_inner">
            <div class="page_name">○○○○株式会社の詳細情報</div>
            <a href="./index.php">初期画面へ</a>
            <a href="./logout.php">logout</a>
        </div>
    </header>
    <main>
        <div class="content_wrapper">
            <ul class="content_inner">
                <li id="name">企業名：</li>
                <li id="email">Email：</li>
                <li id="email_for_notification">通知用Email：</li>
                <li id="tel">電話番号：</li>
                <li id="url">url：</li>
                <li id="representative">代表者：</li>
                <li id="contactor">契約担当者：</li>
                <li id="address">住所：</li>
                <li id="address_num">番地：</li>
            </ul>
        </div>
    </main>

    <!-- <?php var_dump($agency)  // for debug 
    ?> -->
    <?php include dirname(__FILE__) . '/footer.php' ?>