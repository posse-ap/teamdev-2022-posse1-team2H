<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;

$auth = new Agency($db);
$auth->validate();

include dirname(__FILE__) . '/header.php' ?>

<main class="agency_thankyou">
<div class="agency_thankyou_inner">
    <div class="agency_thankyou_inner_box">
        <h2>送信が完了しました</h2>
        <a href="./index.php" class="agency_thankyou_inner_top">
           <i class="fa fa-caret-right">TOP画面へ</i>
        </a>
    </div>
</div>


</main>

<?php include dirname(__FILE__) . '/footer.php' ?>