<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include dirname(__FILE__) . '/header.php';
?>

<body>
    <header>
        <div class="header_inner">
            <div class="page_name">管理画面</div>
            <a>基本情報・掲載情報</a>
            <div style="font-weight:bold ;">編集・掲載</div>
        </div>
    </header>
    <main>
        <div id="displayed_content" class="displayed_content">○○○○株式会社の基本情報と掲載情報</div>
        <div class="agency_info_wrapper">
            <input class="" type="text">
        </div>
    </main>

    <?php include dirname(__FILE__) . '/footer.php' ?>