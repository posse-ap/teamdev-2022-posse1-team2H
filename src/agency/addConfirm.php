<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;

$auth = new Agency($db);
$auth->validate();

include dirname(__FILE__) . '/header.php' ?>

<div>
    <h2 class="inquary_header_title">個人情報追加確認画面</h2>
</div>
<p class="inquary_header_prompt">下記内容に間違いがないか最終確認してください</p>
<main class="inquary_content">
    <form class="agency_inquary_after_content_inner">
        <div class="agency_inquary_after_content_innerFrame">
            <dl class="agency_inquary_after_content_inner_name">
                <dt class="agency_inquary_after_content_inner_name_title">お名前</dt>
                <dt class="agency_inquary_after_content_inner_name_text">窪田美怜</dt>
            </dl>
            <dl class="agency_inquary_after_content_inner_mail">
                <dt class="agency_inquary_after_content_inner_mail_title">Email</dt>
                <dt class="agency_inquary_after_content_inner_mail_text">mirei.kubota@gmail.com</dt>
            </dl>
            <p class="add inquary_content_inner_submit">
                    <a href="admininfo.php" class="inquary_content_inner_submit_button">追加する</a>
            </p>
        </div>
        </div>
    </form>
</main>

<?php include dirname(__FILE__) . '/footer.php' ?>