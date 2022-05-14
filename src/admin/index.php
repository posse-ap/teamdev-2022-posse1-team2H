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
        <ul class="agency_list_inner">
            <ol><a href="./agencyInfo.php">○○○○株式会社　情報獲得数 ２件　期限4/30　金額xxxx</a></ol>
            <ol><a href="./agencyInfo.php">○○○○llllllllllllll株式会社　情報獲得数 ２件　期限4/30　金額xxxx</a></ol>
            <ol><a href="./agencyInfo.php">○○○○株式会社　情報獲得数 ２件　期限4/30　金額xxxx</a></ol>
            <ol><a href="./agencyInfo.php">○○○○株式会社　情報獲得数 ２件　期限4/30　金額xxxx</a></ol>
            <ol><a href="./agencyInfo.php">○○○○株式会社　情報獲得数 ２件　期限4/30　金額xxxx</a></ol>
            <ol><a href="./agencyInfo.php">○○○○株式会社　情報獲得数 ２件　期限4/30　金額xxxx</a></ol>
            <ol><a href="./agencyInfo.php">○○○○株式会社　情報獲得数 ２件　期限4/30　金額xxxx</a></ol>
            <ol><a href="./agencyInfo.php">○○○○株式会社　情報獲得数 ２件　期限4/30　金額xxxx</a></ol>
            <ol><a href="./agencyInfo.php">○○○○株式会社　情報獲得数 ２件　期限4/30　金額xxxx</a></ol>
        </ul>
    </div>
</main>

<?php include dirname(__FILE__) . '/footer.php' ?>