<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use cruds\Admin as Crud;
use modules\auth\Admin as Auth;

$auth = new Auth($db);
$crud = new Crud($db);

$auth->validate();

$id = $_GET['id'];
if (!isset($id)) {
    header('Location: index.php');
}

$agency = json_decode($crud->getAgencyContractsDetail($id));

include dirname(__FILE__) . '/header.php'
?>

<header>
    <div class="header_inner">
        <div class="page_name">管理画面</div>
        <div id="header_content" class="header_content">
            <a href="./index.php">初期画面へ</a>
        </div>
    </div>
</header>
<main id="agency">
    <div id="displayed_content" class="displayed_content">
        <input id="date_today" class="date_today" type="month">
        <div class="got_information">総情報獲得数：6件</div>
        <div class="total_amount">合計金額：2000</div>
        <button onclick="select()">選択</button>
        <button onclick="handleUserDelete(id)">消去</button>
    </div>
    <div class="agency_list_wrapper">
        <div class="the_agency_info">
            <a href="./agencyDetail.php">○○○○llllllllllllll株式会社</a>
            <div>情報獲得数　2件</div>
            <div>期限　4/30</div>
            <div>金額xxxx</div>
        </div>
        <?php for ($i = 1; $i < 6; $i++) : ?>
            <ul class="agency_list_inner">
                <ol>
                    <div>情報登録日時:　2022年3月5日</div>
                    <a href="./userDetail.php">加茂竜之介</a>
                    <div>男性</div>
                    <div>21歳</div>
                    <input id="checkbox<?php echo $i ?>" class="checkbox" type="hidden" name="contract_id" value=""></input><label id="label<?php echo $i ?>" for="checkbox<?php echo $i ?>"></label>

                </ol>

            </ul>
        <?php endfor ?>
    </div>
</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
