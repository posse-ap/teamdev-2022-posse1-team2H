<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Admin as Auth;
use cruds\Admin as Cruds;

$auth = new Auth($db);
$cruds = new Cruds($db);

$auth->validate();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ログイン</title>
</head>

<body>
    <div>
        <h1>管理者ページ</h1>
        <form action="/admin/index.php" method="POST">
            イベント名：<input type="text" name="title" required>
            <input type="submit" value="登録する">
        </form>
        <a href="/index.php">イベント一覧</a>
    </div>
</body>

</html>
