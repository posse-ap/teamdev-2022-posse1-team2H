<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;
use cruds\Agency as Crud;

$crud = new Crud($db);
$auth = new Agency($db);
$auth->validate();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if (empty($name)) {
        $error['name'] = 'blank';
    }
    if (empty($email)) {
        $error['email'] = 'blank';
    }
    if (empty($password)) {
        $error['password'] = 'blank';
    }
    if (empty($confirm_password)) {
        $error['confirm_password'] = 'blank';
    }
    if ($password !== $confirm_password) {
        $error['password'] = 'failed';
    }
    if (empty($error)) {
        $_SESSION['manager_add']['name'] = $name;
        $_SESSION['manager_add']['email'] = $email;
        $_SESSION['manager_add']['password'] = $password;
        header('Location:http://' . $_SERVER['HTTP_HOST'] . '/agency/addConfirm.php');
        exit();
    }
}
$agency_id = $_SESSION['agency']['id'];
$manager_id = $_SESSION['agency_manager']['id'];

$agency_info = json_decode($crud->getManagerWithAgency($manager_id));

include dirname(__FILE__) . '/header.php' ?>

<main id="managers">
    <input type="hidden" name="agency_id" value="<?= $agency_id ?>">
    <div class="detail_box">
        <p>名前: <?= $agency_info->name ?></p>
        <p>メールアドレス： <?= $agency_info->email ?></p>
        <p>電話番号： <?= $agency_info->agency_tel ?></p>
    </div>
    <a class="edit_button" href="./edit.php">編集</a>
    <div class="list_box">
        <p>個人担当者一覧</p>
        <div id="managers_target"></div>
        <div class="open_modal" onclick="addAgencyManager()">追加</div>
    </div>
</main>
<div id="overlay" class="overlay"></div>
<div id="modal" class="modal">
    <div onclick="closingBtn()" id="close_btn" class="close_btn"></div>
    <form action="" method="POST" id="modal_inner" class="modal_inner">
        <h1 class="modal_title">個人担当者追加</h1>
        <dl class="add_box">
            <dt>お名前</dt>
            <dd class="name_box inquary_content_inner_name_enter">
                <span class="inquary_content_inner_name_enter_box">
                    <input type="text" name="name"size="40" class="inquary_content_inner_name_enter_text" placeholder="※">
                </span>
            </dd>
        </dl>
        <dl class="add_box">
            <dt>Email</dt>
            <dd class="email_box inquary_content_inner_mail_enter">
                <span class="inquary_content_inner_mail_enter_box">
                    <input type="text" name="email" size="40" class="inquary_content_inner_mail_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角英数字">
                </span>
            </dd>
        </dl>
        <dl class="add_box">
            <dt>パスワード</dt>
            <dd class="password_box inquary_content_inner_mail_enter">
                <span class="inquary_content_inner_mail_enter_box">
                    <input type="password" name="password" size="40" class="inquary_content_inner_mail_enter_text" aria-required="true" aria-invalid="false" placeholder="※">
                </span>
            </dd>
        </dl>
        <dl class="add_box">
            <dt>パスワード確認</dt>
            <dd class="password_confirm_box inquary_content_inner_mail_enter">
                <span class="inquary_content_inner_mail_enter_box">
                    <input type="password" name="confirm_password" size="40" class="inquary_content_inner_mail_enter_text" aria-required="true" aria-invalid="false" placeholder="※">
                </span>
            </dd>
        </dl>
        <input class="confirm_button" type="submit" value="確認">
    </form>
</div>

<?php include dirname(__FILE__) . '/footer.php' ?>
