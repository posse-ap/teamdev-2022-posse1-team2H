<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;

$auth = new Agency($db);
$auth->validate();

include dirname(__FILE__) . '/header.php' ?>

<div>
    <div class="inquary_header_bg">
        <h2 class="inquary_header_title">お問合せ確認画面</h2>
    </div>
</div>
<p class="inquary_header_prompt">下記内容に間違いがないか最終確認してください</p>
<main class="inquary_content">
    <form class="agency_inquary_after_content_inner">
        <div class="agency_inquary_after_content_innerFrame">
            <dl>
                <dt class="agency_inquary_after_content_inner_consul_title">ご相談内容</dt>
                <dt class="agency_inquary_after_content_inner_consul_text">掲載情報変更</dt>
            </dl>
            <dl>
                <dt class="agency_inquary_after_content_inner_name_title">お名前 ※</dt>
                <dt class="agency_inquary_after_content_inner_name_text">窪田美怜</dt>
            </dl>
            <dl class="agency_inquary_after_content_inner_mail">
                <dt class="agency_inquary_after_content_inner_mail_title">Email ※</dt>
                <dt class="agency_inquary_after_content_inner_mail_text">mirei.kubota@gmail.com</dt>
            </dl>
            <dl class="agency_inquary_after_content_inner_phone">
                <dt class="agency_inquary_after_content_inner_phone_title">電話番号 ※</dt>
                <dt class="agency_inquary_after_content_inner_phone_text">090-999-9999</dt>
            </dl>
            <dl class="agency_inquary_after_content_inner_edit_change">
                <dt class="agency_inquary_after_content_edit_change_title">タイトル</dt>
                <dt class="agency_inquary_after_content_inner_edit_change_text">掲載情報変更</dt>
            </dl>
            <dl class="agency_inquary_after_content_inner_edit_change_detail">
                <dt class="agency_inquary_after_content_inner_edit_change_detail_title">本文</dt>
                <dt class="agency_inquary_after_content_inner_edit_change_text">
                    桃太郎さん 桃太郎さん<br>
                    お腰につけた黍団子<br>
                    一つわたしに下さいな<br>
                    やりましょう やりましょう<br>
                    これから鬼の征伐に<br>
                    ついて行くならやりましょう<br>
                    行きましょう 行きましょう<br>
                    あなたについて何処までも<br>
                    家来になって行きましょう
                </dt>
            </dl>
            <div class="after_submit">
                <p class="inquary_content_inner_submit">
                    <a href="contact.php" class="inquary_content_inner_submit_button">前の画面に戻る</a>
                </p>
                <p class="inquary_content_inner_submit">
                    <a href="thankyou.php" class="inquary_content_inner_submit_button">送信する</a>
                </p>
            </div>
        </div>
        </div>
    </form>
</main>

<?php include dirname(__FILE__) . '/footer.php' ?>