<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Admin as Auth;
use cruds\Admin as Cruds;
use modules\utils\Utils;
use modules\auth\Token;
use models\Agency;
use models\Article;

$auth = new Auth($db);
$crud = new Cruds($db);

$auth->validate();

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    Token::validate();
    if (!isset($_POST['agency_id'])) {
        $error['agency_id'] = 'blank';
    }
    if (!isset($_POST['name'])) {
        $error['name'] = 'blank';
    }
    if (!isset($_POST['email'])) {
        $error['email'] = 'blank';
    }
    if (!isset($_POST['email_for_notification'])) {
        $error['email_for_notification'] = 'blank';
    }
    if (!isset($_POST['tel'])) {
        $error['tel'] = 'blank';
    }
    if (!isset($_POST['url'])) {
        $error['url'] = 'blank';
    }
    if (!isset($_POST['representative'])) {
        $error['representative'] = 'blank';
    }
    if (!isset($_POST['contactor'])) {
        $error['contactor'] = 'blank';
    }
    if (!isset($_POST['address'])) {
        $error['address'] = 'blank';
    }
    if (!isset($_POST['address_num'])) {
        $error['address_num'] = 'blank';
    }
    if (!isset($_POST['title'])) {
        $error['title'] = 'blank';
    }
    if (!isset($_POST['sentenses'])) {
        $error['sentenses'] = 'blank';
    }
    if (!isset($_POST['eyecatch'])) {
        $error['eyecatch'] = 'blank';
    }

    if (empty($error)) {
        $agency = new Agency(
            $_POST['agency_id'],
            $_POST['name'],
            $_POST['email'],
            $_POST['email_for_notification'],
            $_POST['tel'],
            $_POST['url'],
            $_POST['representative'],
            $_POST['contactor'],
            $_POST['address'],
            $_POST['address_num']
        );
        $article = new Article(
            $_POST['agency_id'],
            $_POST['title'],
            $_POST['sentenses'],
            $_POST['eyecatch']
        );
        $crud->updateAgency($agency);
        $crud->updateArticle($article);
        $id = $agency->agency_id;
    }
}

if (!isset($id)) {
    header('Location: index.php');
    exit();
}

$agency = $crud->getAgencyDetail($id, $contract_mode = false);

$agency = json_decode($agency);

include dirname(__FILE__) . '/header.php';
?>

<body>
    <header>
        <div class="inside_header">
            <div class="page_name">管理画面</div>
            <div class="title_name">編集・掲載</div>
            <a href="./agencyInfo.php">基本情報・掲載情報へ</a>
            <a href="./agencies.php">企業一覧へ</a>
        </div>
    </header>
    <main>
        <div id="displayed_content" class="displayed_content">○○○○株式会社の基本情報と掲載情報</div>
        <form action="" method="POST">
            <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']) ?>">
            <input type="hidden" name="agency_id" value="<?= Utils::h($agency->agency_id) ?>">
            <div class="agency_info_wrapper">
                <ul class"basic_info">
                    <li id="name">企業名：<label><input type="text" name="name" value="<?= Utils::h($agency->name) ?>"></label></li>
                    <li id="email">Email：<label><input type="text" name="email" value="<?= Utils::h($agency->email) ?>"></label></li>
                    <li id="email_for_notification">通知用Email：<label><input type="text" name="email_for_notification" value="<?= Utils::h($agency->email_for_notification) ?>"></label></li>
                    <li id="tel">電話番号：<label><input type="text" name="tel" value="<?= Utils::h($agency->tel) ?>"></label></li>
                    <li id="url">url：<label><input type="text" name="url" value="<?= Utils::h($agency->url) ?>"></label></li>
                    <li id="representative">代表者：<label><input type="text" name="representative" value="<?= Utils::h($agency->representative) ?>"></label></li>
                    <li id="contactor">契約担当者：<label><input type="text" name="contactor" value="<?= Utils::h($agency->contactor) ?>"></label></li>
                    <li id="address">住所：<label><input type="text" name="address" value="<?= Utils::h($agency->address) ?>"></label></li>
                    <li id="address_num">郵便番号： <label><input type="text" name="address_num" value="<?= Utils::h($agency->address_num) ?>"></label></li>
                </ul>
                <ul class="info_for_post">
                    <li id="title">タイトル：<label><input type="text" name="title" value="<?= Utils::h($agency->title) ?>"></label></li>
                    <li id="sentenses">文章：<label><textarea type="text" name="sentenses">
    <?= Utils::h($agency->sentenses) ?>
    </textarea></label></li>
                    <li id="eyecatch">画像：  <label><input type="text" name="eyecatch" value="<?= Utils::h($agency->eyecatch) ?>"></label></li>
                </ul>
                <input type="submit" value="submit">
            </div>
        </form>
    </main>









    <?php include dirname(__FILE__) . '/footer.php' ?>
