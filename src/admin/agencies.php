<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use cruds\Admin as Crud;
use modules\auth\Admin as Auth;

$auth = new Auth($db);
$auth->validate();

$crud = new Crud($db);

$agencies = json_decode($crud->getAgencies());

include dirname(__FILE__) . '/header.php';
?>

<body>
    <header>
        <div class="header_inner">
            <div class="page_name">管理画面</div>
            <a href="./index.php">初期画面へ</a>
        </div>
    </header>
    <main>
        <div id="displayed_content" class="displayed_content">企業一覧</div>
        <div class="agency_list_wrapper">
            <ul class="agency_list_inner">
                <?php foreach ($agencies as $agency) : ?>
                    <ol>
                        <a href="./agency.php?id=<?= $agency->id ?>"><?= $agency->name ?></a>
                    </ol>
                <?php endforeach; ?>
            </ul>

        </div>
    </main>

    <?php include dirname(__FILE__) . '/footer.php' ?>
