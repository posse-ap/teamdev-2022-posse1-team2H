<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Admin as Auth;
use cruds\Admin as Cruds;

$auth = new Auth($db);
$cruds = new Cruds($db);

$auth->validate();

include dirname(__FILE__) . '/header.php';
?>

<body>

    <header>
        <div class="header_inner">
            <div class="page_name">管理画面</div>
            <nav>
                <ul class="for_transition">
                    <li><a href="./agencies.php">掲載・編集関連画面へ</a></li>
                </ul>
            </nav>
            <a href="./logout.php">logout</a>
        </div>
    </header>
    <main>
        <div id="displayed_content" class="displayed_content">
            <input id="date_today" class="date_today" type="month">
            <div class="got_information">総情報獲得数：6件</div>
            <div class="total_amount">合計金額：2000</div>
        </div>
        <div class="agency_list_wrapper">
            <?php for ($i = 1; $i < 7; $i++) : ?>
                <ul class="agency_list_inner">
                    <ol>
                        <a href="./contract.php">○○○○llllllllllllll株式会社</a>
                        <div>情報獲得数　2件</div>
                        <div>期限　4/30</div>
                        <div>金額xxxx</div>
                    </ol>

                </ul>
            <?php endfor ?>
        </div>
    </main>

    <?php include dirname(__FILE__) . '/footer.php' ?>