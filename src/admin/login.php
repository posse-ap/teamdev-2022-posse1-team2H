<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Admin as Auth;
use cruds\Admin as Cruds;

$auth = new Auth($db);
$cruds = new Cruds($db);

// seed
// $cruds->insertAdmins();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['email'] !== '' && $_POST['password'] !== '') {
      $admin = $auth->login($_POST['email'], $_POST['password']);
      if ($admin) {
          $_SESSION['admin']['id'] = $admin['id'];
          $_SESSION['admin']['time'] = time();
      }
      if (isset($_SESSION['admin']['id'])) {
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
