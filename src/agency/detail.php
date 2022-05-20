<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;

$auth = new Agency($db);
$auth->validate();

include dirname(__FILE__) . '/header.php' ?>

<div class="subtitle span">
        <p>田中太郎さん 詳細情報</p>
    </div>
    <div class="detail_box">
        <p>氏名： 田中太郎</p>
        <p>性別： 男</p>
        <p>年齢： 21歳</p>
        <p>メールアドレス： taro.tanaka@gmail.com</p>
        <p>電話番号： 090-9999-999</p>
        <p>大学名： ◯〇大学</p>
        <p>学部・学科： 経済学部経済学科</p>
        <p>卒業予定年： 2024年</p>
        <p class="button"><a href="index.php">戻る</a></p>
    </div>

<?php include dirname(__FILE__) . '/footer.php' ?>
