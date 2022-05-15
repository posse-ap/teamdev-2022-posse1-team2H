<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use cruds\Admin as Crud;
use modules\auth\Admin as Auth;

$auth = new Auth($db);
$crud = new Crud($db);

$auth->validate();

$id = $_GET['id'];
$year = $_GET['year'];
$month = $_GET['month'];
if (!isset($id) || !isset($year) || !isset($month)) {
    header('Location: index.php');
}

$agency = json_decode($crud->getAgencyContractsDetail($id, $year, $month));

include dirname(__FILE__) . '/header.php'
?>
<main id="agency">
    <?= $agency ?>
</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
