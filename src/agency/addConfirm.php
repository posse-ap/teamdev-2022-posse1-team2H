<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Agency;
use cruds\Agency as Crud;
use models\Manager;
use modules\utils\Utils;

$crud = new Crud($db);
$auth = new Agency($db);
$auth->validate();

// $form_name = $_SESSION['manager_add']['name'];
// $form_email = $_SESSION['manager_add']['email'];
// $form_password = $_SESSION['manager_add']['password'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_name = $_SESSION['manager_add']['name'];
    $form_email = $_SESSION['manager_add']['email'];
    $form_password = $_SESSION['manager_add']['password'];
    $new_manager = new Manager(
        $form_name,
        $form_email,
        $form_password,
        false,
        $_SESSION['agency']['id']
    );
    if ($crud->addManager($new_manager)) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/agency/admininfo.php');
        exit();
    }
}

include dirname(__FILE__) . '/header.php' ?>

<div>
    <h2 class="inquary_header_title">個人情報追加確認画面</h2>
</div>
<p class="inquary_header_prompt">下記内容に間違いがないか最終確認してください</p>
<main class="inquary_content">
    <form class="agency_inquary_after_content_inner" method="POST" action="">
        <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']) ?>">
        <div class="agency_inquary_after_content_innerFrame">
            <dl class="agency_inquary_after_content_inner_name">
                <dt class="agency_inquary_after_content_inner_name_title">お名前</dt>
                <dt class="agency_inquary_after_content_inner_name_text"><?= Utils::h($_SESSION['manager_add']['name']) ?></dt>
            </dl>
            <dl class="agency_inquary_after_content_inner_mail">
                <dt class="agency_inquary_after_content_inner_mail_title">Email</dt>
                <dt class="agency_inquary_after_content_inner_mail_text"><?= Utils::h($_SESSION['manager_add']['email']) ?></dt>
            </dl>
            <p class="add inquary_content_inner_submit">
                <input type="submit" class="inquary_content_inner_submit_button" value="追加する">
            </p>
        </div>
        </div>
    </form>
</main>

<?php include dirname(__FILE__) . '/footer.php' ?>
