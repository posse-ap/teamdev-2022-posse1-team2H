<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;

$auth = new Agency($db);
$auth->validate();

include dirname(__FILE__) . '/header.php' ?>

<main class="content" id="agency_top">
</main>

<?php include dirname(__FILE__) . '/footer.php' ?>
