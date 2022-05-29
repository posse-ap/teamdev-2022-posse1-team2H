<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;
use cruds\Agency as Crud;
use modules\utils\Utils;

$crud = new Crud($db);

$auth = new Agency($db);
$auth->validate();

$id = $_GET['id'];
if (!isset($id)) {
    header('Location: index.php');
    exit;
}

$user = $crud->getUser($id);

include dirname(__FILE__) . '/header.php' ?>

<main>
    <div class="detail_title">
        <p><?= Utils::h($user['name']) ?>さん 詳細情報</p>
    </div>
    <div class="detail_box">
        <p>氏名：<?= Utils::h($user['name']) ?></p>
        <p>性別： <?= Utils::gender($user['gender']) ?></p>
        <p>年齢： <?= Utils::h($user['age']) ?>歳</p>
        <p>メールアドレス： <?= Utils::h($user['email']) ?></p>
        <p>電話番号： <?= Utils::h($user['tel']) ?></p>
        <p>大学名： <?= Utils::h($user['university']) ?></p>
        <p>学部・学科： <?= Utils::h($user['undergraduate']) ?><?= Utils::h($user['department']) ?></p>
        <p>学年: <?= Utils::h($user['school_year']) ?></p>
        <p>卒業予定年： <?= Utils::h($user['graduation_year']) ?>年</p>
        <p class="button"><a href="index.php">戻る</a></p>
    </div>
</main>

<?php include dirname(__FILE__) . '/footer.php' ?>
