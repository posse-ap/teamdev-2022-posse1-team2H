<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include dirname(__FILE__) . '/header.php';
?>

<body>
    <header>
        <div class="header_inner">
            <div class="page_name">管理画面</div>
            <div class="title_name">編集・掲載</div>
            <a href="./agencyInfo.php">基本情報・掲載情報へ</a>
            <a href="./agencies.php">企業一覧へ</a>
        </div>
    </header>
    <main>
        <div id="displayed_content" class="displayed_content">○○○○株式会社の基本情報と掲載情報</div>
        <div class="agency_info_wrapper">
            <!-- <ul class"basic_info">
                <li id="name">企業名：<input type="text" name="" id=""></li>
                <li id="email">Email：<input type="text" name="" id=""></li>
                <li id="email_for_notification">通知用Email：<input type="text" name="" id=""></li>
                <li id="tel">電話番号：<input type="text" name="" id=""></li>
                <li id="url">url：<input type="text" name="" id=""></li>
                <li id="representative">代表者：<input type="text" name="" id=""></li>
                <li id="contactor">契約担当者：<input type="text" name="" id=""></li>
                <li id="address">住所：<input type="text" name="" id=""></li>
                <li id="address_num">番地：<input type="text" name="" id=""></li>
            </ul> -->
            <ul class="info_for_post">
                <li id="title">タイトル：<input type="text" name="" id=""></li>
                <li id="sentenses">文章：<input type="text" name="" id=""></li>
                <li id="eyecatch">画像：<input type="text" name="" id=""></li>
            </ul>
        </div>
        <button class="post_btn" onclick="post()">掲載</button>
    </main>

    <?php include dirname(__FILE__) . '/footer.php' ?>