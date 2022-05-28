<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;

$auth = new Agency($db);
$auth->validate();

include dirname(__FILE__) . '/header.php' ?>

<main class="content" id="agency_top">
    <p class="private_small_box"><a href="detail.php">2022/01/22 22:39 田中太郎 男 21歳 taro.tanaka@gmail.com</a></p>
    <p class="private_small_box"><a href="">2022/01/22 21:35 山田桜 女 22歳 sakura.yamada@gmail.com</a></p>
    <p class="private_small_box"><a href="">2022/01/20 23:59 鈴木誠也 男 22歳 seiya.suzuki@gmail.com</a></p>
</main>

<?php include dirname(__FILE__) . '/footer.php' ?>
