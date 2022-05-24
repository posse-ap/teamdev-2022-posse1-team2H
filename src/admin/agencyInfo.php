<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Admin as Auth;
use cruds\Admin as Cruds;

$auth = new Auth($db);
$cruds = new Cruds($db);

$auth->validate();

$id = $_GET['id'];

if (!isset($id)) {
    header('Location: agencies.php');
}

$agency = $cruds->getAgencyDetail($id);

$agency = json_decode($agency);

include dirname(__FILE__) . '/header.php';
?>

<body>
    <header>
        <div class="inside_header">
            <div class="page_name">管理画面</div>
            <div class="title_name">基本情報・掲載情報</div>
            <a href="./edit.php?id=<?= $agency->agency_id ?>">編集・掲載へ</a>
            <a href="./agencies.php">企業一覧へ</a>
            <a href="./logout.php">logout</a>
        </div>
    </header>
    <main>
        <div id="displayed_content" class="displayed_content"><?= $agency->name ?></div>
        <div class="agency_info_wrapper">
            <div>
                <div class="editable_info">
                    <div class="agency_info_type">エージェンシー編集可能情報</div>
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
                <div class="uneditable_info">
                    <div class="agency_info_type">掲載記事</div>
                    <div class="uneditable_info_content">
                    <?= $agency->sentenses ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include dirname(__FILE__) . '/footer.php' ?>
