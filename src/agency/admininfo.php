<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;

$auth = new Agency($db);
$auth->validate();

include dirname(__FILE__) . '/header.php' ?>

<div class="detail-box">
        <p>田中太郎</p>
        <p>メールアドレス： taro.tanaka@gmail.com</p>
        <p>電話番号： 090-9999-999</p>
    </div>
    <button class="edit-button">編集</button>
    <!-- <p class="edit-button"><a href="">編集</a></p> -->
    <div class="list-box">
        <p>個人担当者一覧</p>
        <ul>
            <li class="menu-list">AA BB：aa.bb@gmail.com</li>
            <li class="menu-list">CC DD：cc.dd@gmail.com</li>
            <li class="menu-list">EE FF：ee.ff@gmail.com</li>
        </ul>
    </div>
<!-- 
    オーバーレイ
        <div id="overlay" class="overlay"></div>
    モーダルウィンドウ
        <div class="modal-window">
            閉じるボタン
            <button class="js-close button-close">Close</button>
        </div>
    モーダルを開くボタン -->
    <button class="js-open button-add">追加</button>


<?php include dirname(__FILE__) . '/footer.php' ?>