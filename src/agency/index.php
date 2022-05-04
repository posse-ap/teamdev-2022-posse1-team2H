<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;

Agency::validate();


include dirname(__FILE__) . '/header.php' ?>
<main class="content" id="content">

</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
