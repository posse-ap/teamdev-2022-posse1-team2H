<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;
use cruds\Agency as Crud;

$crud = new Crud($db);
$auth = new Agency($db);
$auth->validate();

$agency_id = $_SESSION['agency']['id'];
$manager_id = $_SESSION['agency_manager']['id'];

$agency_info = json_decode($crud->getManagerWithAgency($manager_id));

include dirname(__FILE__) . '/header.php' ?>

<main id="managers">
    <input type="hidden" name="agency_id" value="<?= $agency_id ?>">
    <div class="detail_box">
        <p><?= $agency_info->name ?>メールアドレス： <?= $agency_info->email ?></p>
        <p>電話番号： <?= $agency_info->agency_tel ?></p>
    </div>
    <a class="edit_button" href="">編集</a>
    <div class="list_box">
        <p>個人担当者一覧</p>
        <div id="managers_target"></div>
        <a class="open_modal" href="#" onclick="addAgencyManager()">追加</a>
    </div>
</main>
<div id="overlay" class="overlay"></div>
<div id="modal" class="modal">
    <div onclick="closingBtn()" id="close_btn" class="close_btn"></div>
    <div id="modal_inner" class="modal_inner">
        <h1 class="modal_title">個人担当者追加</h1>
        <dl class="add_box">
            <dt>お名前</dt>
            <dd class="name_box inquary_content_inner_name_enter">
                <span class="inquary_content_inner_name_enter_box">
                    <input type="text" value size="40" class="inquary_content_inner_name_enter_text">
                </span>
            </dd>
        </dl>
        <dl class="add_box">
            <dt>Email</dt>
            <dd class="email_box inquary_content_inner_mail_enter">
                <span class="inquary_content_inner_mail_enter_box">
                    <input type="text" value size="40" class="inquary_content_inner_mail_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字">
                </span>
            </dd>
        </dl>
        <dl class="add_box">
            <dt>パスワード</dt>
            <dd class="password_box inquary_content_inner_mail_enter">
                <span class="inquary_content_inner_mail_enter_box">
                    <input type="password" value size="40" class="inquary_content_inner_mail_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字">
                </span>
            </dd>
        </dl>
        <dl class="add_box">
            <dt>パスワード確認</dt>
            <dd class="password_confirm_box inquary_content_inner_mail_enter">
                <span class="inquary_content_inner_mail_enter_box">
                    <input type="password" value size="40" class="inquary_content_inner_mail_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字">
                </span>
            </dd>
        </dl>
        <a class="confirm_button" href="addConfirm.php">確認</a>
    </div>
</div>

<?php include dirname(__FILE__) . '/footer.php' ?>
