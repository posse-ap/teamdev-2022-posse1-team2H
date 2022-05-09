<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Agency;
use cruds\Agency as Crud;

$crud = new Crud($db);
$auth = new Agency($db);
$auth->validate();

$manager_id = $_SESSION['agency_manager']['id'];
$manager = $crud->getManager($manager_id);
$manager = json_decode($manager);

include dirname(__FILE__) . '/header.php';
?>
<main>
    <p>名前: <?= $manager->name ?></p>
    <p>メールアドレス: <?= $manager->email ?></p>
    <p>代表者?<?= $manager->is_representative ?></p>
    <p>エージェンシーid: <?= $manager->agency_id ?></p>
</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
