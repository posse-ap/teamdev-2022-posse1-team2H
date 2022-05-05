<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency as Auth;
use cruds\Agency as Cruds;

$auth = new Auth($db);
$cruds = new Cruds($db);
// seed
$cruds->insertManagers();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['email'] !== '' && $_POST['password'] !== '') {
        $manager = $auth->login($_POST['email'], $_POST['password']);
        if ($manager) {
            $_SESSION['agency_manager']['id'] = $manager['id'];
            $_SESSION['agency_manager']['time'] = time();
            $_SESSION['agency']['id'] = $manager['agency_id'];
        }
        if (isset($_SESSION['agency_manager']['id'])) {
            if ($_POST['save'] === 'on') {
                setcookie('email', $_POST['email'], time() + 60 * 60 * 24 * 14);
            }

            header('Location: index.php');
            exit();
        } else {
            $error['login'] = 'failed';
        }
    } else {
        $error['login'] = 'blank';
    }

}


include dirname(__FILE__) . '/header.php';
?>

<h1>ログイン</h1>
<form action="" method="POST">
    <input type="text" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <input type="submit" value="submit">
</form>

<?php include dirname(__FILE__) . '/footer.php' ?>
