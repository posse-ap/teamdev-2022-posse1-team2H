<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include dirname(__FILE__) . '/header.php';
?>

<body>
    <header>
        <div class="header_inner">
            <div class="page_name">○○○○株式会社の詳細情報</div>
            <a href="./index.php">初期画面へ</a>
        </div>
    </header>
    <main>
        <div class="content_wrapper">
            <ul class="content_inner">
                <li id="name">氏名：加茂竜之介</li>
                <li id="age">年齢：20</li>
                <li id="email">Email：kamo@gamil.com</li>
                <li id="tel">電話番号：090-3751-5188</li>
                <li id="univercity">大学名：早稲田大学</li>
                <li id="undergraduate">学部：教育学部</li>
                <li id="department">学科：教育学科</li>
                <li id="school_year">学年：2年生</li>
                <li id="graduation_year">卒業年：2025年</li>
                <li id="gender">性別：男性</li>
                <li id="address">住所：東京都葛飾区亀有</li>
                <li id="address_num">番地：５丁目３３</li>
            </ul>
            <div class="num_sent_infromation">企業に応募した件数：４件</div>

        </div>
    </main>


    <?php include dirname(__FILE__) . '/footer.php' ?>