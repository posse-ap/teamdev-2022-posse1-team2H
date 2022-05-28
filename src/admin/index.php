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
            <div class="page_name">Craft For Administrator</div>
            <nav>
                <ul class="for_transition">
                    <li><a href="./agencies.php">エージェンシー情報編集</a></li>
                </ul>
            </nav>
            <a href="./logout.php">logout</a>
        </div>
    </header>
    <main id="top_page">
        <div id="displayed_content" class="displayed_content">
            <input id="date_today" class="date_today" type="month" name="yearmonth" onchange="handleSearch()">
            <div class="got_information">総情報獲得数: 6件</div>
            <div class="total_amount">合計金額: 2000</div>
        </div>
        <div class="agency_list_wrapper">
                <ul class="agency_list_inner" id="contracts_target">
                    <!-- jsで描画されます -->
                </ul>
        </div>
    </main>

    <?php include dirname(__FILE__) . '/footer.php' ?>
