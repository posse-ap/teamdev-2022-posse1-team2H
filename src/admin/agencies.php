<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include dirname(__FILE__) . '/header.php';
?>

<body>
    <header>
        <div class="header_inner">
            <div class="page_name">管理画面</div>
        </div>
    </header>
    <main>
        <div id="displayed_content" class="displayed_content">企業一覧</div>
        <div class="agency_list_wrapper">
            <ul class="agency_list_inner">
                <ol>
                    <a href="./agencyInfo.php">○○○○llllllllllllll株式会社</a>
                    <div>編集・掲載依頼 4/1</div>
                </ol>

                <ol>
                    <a href="./agencyInfo.php">○○○○llllllllllllll株式会社</a>
                    <div>基本情報変更 4/1</div>
                </ol>

                <ol>
                    <a href="./agencyInfo.php">○○○○llllllllllllll株式会社</a>
                    <div>基本情報変更 4/13 　編集・掲載依頼4/5</div>
                </ol>

            </ul>

        </div>
    </main>

    <?php include dirname(__FILE__) . '/footer.php' ?>