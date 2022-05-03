<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;

$auth = new Agency($db);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['email'] !== '' && $_POST['password'] !== '') {
        $manager = $auth->login($_POST['email'], $_POST['password']);
        if (!isset($_SESSION['agency']['id'])) {
            $error['login'] = 'failed';
        } else {
            header('Location: index.php');
        }
    } else {
        $error['login'] = 'blank';
    }

}


include dirname(__FILE__) . '/header.php';
?>

<?php include dirname(__FILE__) . '/footer.php' ?>
