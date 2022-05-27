<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Admin as Auth;
use cruds\Admin as Cruds;

$auth = new Auth($db);
$cruds = new Cruds($db);

$auth->validate();

$agency_id = $_GET['agency_id'];

if (!isset($agency_id)) {
    header('Location: agencies.php');
    exit;
}

$agency = $cruds->getAgencyDetail($agency_id);

$agency = json_decode($agency);

include dirname(__FILE__) . '/header.php';
?>

<body>
    <header>
        <div class="header_inner">
            <div class="page_name"><?= $agency->name ?>の詳細情報</div>
            <a href="./index.php">TOP画面へ</a>
        </div>
    </header>
    <main>
        <div class="content_wrapper">
            <ul class="content_inner">
                <li id="name">企業名：<?= $agency->name ?></li>
                <li id="email">Email：<?= $agency->email ?></li>
                <li id="email_for_notification">通知用Email：<?= $agency->email_for_notice ?></li>
                <li id="tel">電話番号：<?= $agency->tel ?></li>
                <li id="url">url：<?= $agency->url ?></li>
                <li id="representative">代表者：<?= $agency->representative ?></li>
                <li id="contactor">契約担当者：<?= $agency->contactor ?></li>
                <li id="address">住所：<?= $agency->address ?></li>
                <li id="address_num">郵便番号：<?= $agency->address_num ?></li>
            </ul>
        </div>
    </main>
    <?php include dirname(__FILE__) . '/footer.php' ?>
