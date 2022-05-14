<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';



include dirname(__FILE__) . '/headerAgencyInfo.php';
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
</main>

<?php include dirname(__FILE__) . '/footerAgencyInfo.php' ?>