<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;

$auth = new Agency($db);
$auth->validate();

include dirname(__FILE__) . '/header.php' ?>

<main>
    <div class="detail_box">
        <p>田中太郎</p>
        <p>メールアドレス： taro.tanaka@gmail.com</p>
        <p>電話番号： 090-9999-999</p>
    </div>
    <a class="edit_button" href="">編集</a>
    <div class="list_box">
        <p>個人担当者一覧</p>
        <div class="small_list_box">
            <li class="email">AA BB：aa.bb@gmail.com</li>
            <button type="button" class="trash">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </div>
        <div class="small_list_box">
            <li class="email">CC DD：cc.dd@gmail.com</li>
            <button type="button" class="trash">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </div>
        <div class="small_list_box">
            <li class="email">EE FF：ee.ff@gmail.com</li>
            <button type="button" class="trash">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </div>
    </div>
    <a class="open_modal" href="#" onclick="addStudentInformation()">追加</a>
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
                    <input type="text" value size="40" class="inquary_content_inner_mail_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字">
                </span>
            </dd>
        </dl>
        <a class="confirm_button" href="addConfirm.php">確認</a>
    </div>
</div>

<?php include dirname(__FILE__) . '/footer.php' ?>