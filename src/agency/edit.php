<?php

use cruds\Agency as Crud;
use modules\auth\Agency as Auth;
use modules\utils\Utils;

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$auth = new Auth($db);
$auth->validate();

$manager_id = $_SESSION['agency_manager']['id'];
$crud = new Crud($db);

$manager = $crud->getManager($manager_id);
$manager = json_decode($manager);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (password_verify($_POST['password'], $manager->password)) {
        if (!empty($_POST['name']) && !empty($_POST['email'])) {
            $manager->name = $_POST['name'];
            $manager->email = $_POST['email'];
            if ($crud->updateManager($manager)) {
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/agency/admininfo.php');
                exit();
            } else {
                $error = 'failed';
            }
        } else {
            $error = 'blank';
        }
    } else {
        $error = 'password';
    }
}

include dirname(__FILE__) . '/header.php';
?>
<main>
    <form class="admin_information_change" action="" method="POST">
        <h1 class="modal_title">管理者様情報変更</h1>
        <dl class="add_box">
            <dt>お名前</dt>
            <dd class="name_box inquary_content_inner_name_enter">
                <span class="inquary_content_inner_name_enter_box">
                    <input type="text" name="name" placeholder="name" value="<?= Utils::h($manager->name) ?>">
                </span>
            </dd>
        </dl>
        <dl class="add_box">
            <dt>Email</dt>
            <dd class="email_box inquary_content_inner_mail_enter">
                <span class="inquary_content_inner_mail_enter_box">
                    <input type="text" name="email" placeholder="email" value="<?= Utils::h($manager->email) ?>">
                </span>
            </dd>
        </dl>
        <dl class="add_box">
            <dt>パスワード</dt>
            <dd class="password_box inquary_content_inner_mail_enter">
                <span class="inquary_content_inner_mail_enter_box">
                    <input type="password" name="password" placeholder="confirm password">
                </span>
            </dd>
        </dl>
        <input class="confirm_button" type="submit" value="提出">
    </form>
</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
