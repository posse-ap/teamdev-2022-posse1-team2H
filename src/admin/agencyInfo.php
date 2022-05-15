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
    <div class="agency_list_wrapper">
        <div class="the_agency_info">
            <a href="./agencyInfo.php">○○○○llllllllllllll株式会社</a>
            <div>情報獲得数　2件</div>
            <div>期限　4/30</div>
            <div>金額xxxx</div>
            <input id="checkbox<?php echo $i ?>" class="checkbox" type="hidden"></input><label id="label<?php echo $i ?>" for="checkbox<?php echo $i ?>">支払い済み</label>
        </div>
        <!-- label forとinputのidが同じ値である必要があります -->
        <?php for ($i = 1; $i < 6; $i++) : ?>
            <!-- 仮で、支払い済みと未払いで分けています。どちらか、消してもらって大丈夫です。 -->
            <ul class="agency_list_inner">
                <ol>
                    <div>情報登録日時:　2022年3月5日</div>
                    <a href="">加茂竜之介</a>
                    <div>男性</div>
                    <div>21歳</div>
                    <input id="checkbox<?php echo $i ?>" class="checkbox" type="hidden" value="<?php echo $i ?>"></input><label id="label<?php echo $i ?>" for="checkbox<?php echo $i ?>"></label>
                </ol>

            </ul>
        <?php endfor ?>
    </div>
</main>

<?php include dirname(__FILE__) . '/footerAgencyInfo.php' ?>