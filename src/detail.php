<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use cruds\User;

$id = $_GET['id'];

if (empty($id)) {
    header('Location: index.php');
    exit;
}

$cruds = new User($db);

$agency = $cruds->getAgency($id);
$agency = json_decode($agency);

include dirname(__FILE__) . '/header.php';
?>
<main>

</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
