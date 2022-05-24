<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Admin as Auth;
use cruds\Admin as Cruds;
use modules\utils\Utils;
use modules\auth\Token;
use models\Agency;
use models\Article;

$auth = new Auth($db);
$cruds = new Cruds($db);

$auth->validate();

$id = $_GET['id'];

if ($_SERVER['REQEST_METHOD'] === "POST") {
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
    if (!isset($_POST['email_for_notice'])) {
        $error['email_for_notice'] = 'blank';
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
            $_POST['email_for_notice'],
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

$agency = $cruds->getAgencyDetail($id, $contract_mode = false);

$agency = json_decode($agency);

include dirname(__FILE__) . '/header.php';
?>
<form action="" method="POST">
    <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']) ?>">
    <input type="hidden" name="agency_id" value="<?= Utils::h($agency->agency_id) ?>">
    <label><input type="text" name="name" value="<?= Utils::h($agency->name) ?>"></label>
    <label><input type="text" name="email" value="<?= Utils::h($agency->email) ?>"></label>
    <label><input type="text" name="email_for_notice" value="<?= Utils::h($agency->email_for_notice) ?>"></label>
    <label><input type="text" name="tel" value="<?= Utils::h($agency->tel) ?>"></label>
    <label><input type="text" name="url" value="<?= Utils::h($agency->url) ?>"></label>
    <label><input type="text" name="representative" value="<?= Utils::h($agency->representative) ?>"></label>
    <label><input type="text" name="contactor" value="<?= Utils::h($agency->contactor) ?>"></label>
    <label><input type="text" name="address" value="<?= Utils::h($agency->address) ?>"></label>
    <label><input type="text" name="address_num" value="<?= Utils::h($agency->address_num) ?>"></label>
    <label><input type="text" name="title"></label>
    <label><input type="text" name="sentenses"></label>
    <label><input type="text" name="eyecatch"></label>
    <input type="submit" value="submit">
</form>
<?php include dirname(__FILE__) . '/footer.php' ?>
