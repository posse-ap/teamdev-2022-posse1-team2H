<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;

$auth = new Agency($db);
$auth->validate();


include dirname(__FILE__) . '/header.php' ?>
<main class="content" id="agency_top">


<div class="export-button"><a href="">エクスポート</a></div>
<div class="private-big-box">
    <p class="private-small-box"><a href="detail.html">2022/01/22 22:39 田中太郎 男 21歳 taro.tanaka@gmail.com</a></p>
    <p class="private-small-box"><a href="">2022/01/22 21:35 山田桜 女 22歳 sakura.yamada@gmail.com</a></p>
    <p class="private-small-box"><a href="">2022/01/20 23:59 鈴木誠也 男 22歳 seiya.suzuki@gmail.com</a></p>
</div>

</main>

<?php include dirname(__FILE__) . '/footer.php' ?>
