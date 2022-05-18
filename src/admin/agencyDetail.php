<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include dirname(__FILE__) . '/header.php';
?>

<body>
    <header>
        <div class="header_inner">
            <div class="page_name">○○○○株式会社の詳細情報</div>
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
                <li id="contactor">契約当事者：</li>
                <li id="address">住所：</li>
                <li id="address_num">番地：</li>
            </ul>
        </div>
    </main>


    <?php include dirname(__FILE__) . '/footer.php' ?>