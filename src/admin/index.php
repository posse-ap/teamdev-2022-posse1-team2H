<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Admin as Auth;
use cruds\Admin as Cruds;

$auth = new Auth($db);
$cruds = new Cruds($db);

$auth->validate();

include dirname(__FILE__) . '/header.php';
?>

<main>
    <div id="displayed_content" class="displayed_content">
        <form action="">
            <select class="select_content" name="" id="">
                <option value="">date</option>
            </select>
        </form>
        <div class="got_information">総情報獲得数：6件</div>
        <div class="total_amount">合計金額：2000</div>
    </div>
    <div class="agency_list_wrapper">
        <!-- label forとinputのidが同じ値である必要があります -->
        <?php for ($i = 1; $i < 7; $i++) : ?>
            <!-- 仮で、支払い済みと未払いで分けています。どちらか、消してもらって大丈夫です。 -->
            <ul class="agency_list_inner">
                <ol>
                    <a href="./agencyInfo.php">○○○○llllllllllllll株式会社</a>
                    <div>情報獲得数　2件</div>
                    <div>期限　4/30</div>
                    <div>金額xxxx</div>
                    <input id="checkbox<?php echo $i ?>" class="checkbox" type="hidden"></input><label id="label<?php echo $i ?>" for="checkbox<?php echo $i ?>">支払い済み</label>
                </ol>

            </ul>
        <?php endfor ?>
    </div>
</main>

<?php include dirname(__FILE__) . '/footer.php' ?>