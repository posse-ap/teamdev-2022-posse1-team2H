<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency as Auth;
use cruds\Agency as Cruds;

$auth = new Auth($db);
$cruds = new Cruds($db);
// seed
//1回データ消した時には必要
// $cruds->insertManagers();

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

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/sanitize.css">
    <script src="https://kit.fontawesome.com/727d59e43e.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="../static/css/sanitize.css">
    <link rel="stylesheet" href="../static/css/agency.css">
    <script src="../static/js/agencyApi.js"></script>
    <title>CRAFT for Agencies</title>
</head>
<body>
    <div class="login_whole">
        <h1 class="login_title">エージェント様ログイン画面</h1>
        <form action="" method="POST">
            <div class="form_box">
                <input class="form_small_box" type="text" name="email" placeholder="Email">
                <input class="form_small_box" type="password" name="password" placeholder="Password">
                <input class="login_box" type="submit" value="Log in">
            </div>
        </form>
        <p class="password">Forgot your password? Click here!</p>
    </div>

<?php include dirname(__FILE__) . '/footer.php' ?>
