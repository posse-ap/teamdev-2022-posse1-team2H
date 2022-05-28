<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency as Auth;

$auth = new Auth($db);

$auth->validate();


include dirname(__FILE__) . '/header.php';
?>
<main >
    <div class="container">

    </div>
</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
