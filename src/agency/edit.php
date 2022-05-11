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
                header('Location: index.php');
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
    <form action="" method="POST">
        <input type="text" name="name" placeholder="name" value="<?= Utils::h($manager->name) ?>">
        <input type="text" name="email" placeholder="email" value="<?= Utils::h($manager->email) ?>">
        <input type="password" name="password" placeholder="confirm password">
        <input type="submit" value="submit">
    </form>
</main>
<?php include dirname(__FILE__) . '/footer.php' ?>