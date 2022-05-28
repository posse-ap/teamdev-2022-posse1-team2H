<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use cruds\User;
use modules\utils\Utils;

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
    <div class="content_detail">
        <div class="content_detail_inner">
            <!-- キャッチコピーと写真 -->
            <div class="content_detail_catchCopy_imgbig">
                <div class="content_detail_catchcopy">
                    <h1 class="content_detail_catchcopy_title"><?= Utils::h($agency->name) ?></h1>
                    <div class="content_detail_catchcopy_subtitle">
                        <?php foreach ($agency->industries as $industry) : ?>
                            <a href="">#<?= Utils::h($industry->industry) ?></a>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="content_detail_agency_img">
                    <a href="<?= $agency->url ?>" class="content_detail_agency_imgbig_">
                        <img src="<?= $agency->eyecatch ?>" alt="<?= Utils::h($agency->name) ?>" class="content_detail_agency_imgbig">
                    </a>
                </div>

            </div>
            <!-- ここからはそれ以外のもの -->
            <div class="content_detail_subcontent">
                <!-- 左側のどんな企業かどんな学生におすすめかと後でみるに追加と請求 -->
                <div class="content_detail_subcontent_left">
                    <div class="content_detail_subcontent_left_agentStudent">
                        <ul class="content_detail_subcontent_left_agentStudent_table">
                            <li class="content_detail_subcontent_left_agentStudent_table_top">
                                <a href="./index.php" class="content_detail_subcontent_left_agentStudent_table_toptext">TOP画面</a>
                            </li>
                            <li class="content_detail_subcontent_left_agentStudent_table_detail">詳細ページ</li>
                        </ul>
                        <div class="content_detail_subcontent_left_agentstudent_agent">
                            <h1 class="content_detail_subcontent_left_agentrequest_agent_title"><?= Utils::h($agency->title) ?></h1>
                            <p class="content_detail_subcontent_left_agentrequest_agent_text">
                            <?= Utils::h($agency->sentenses) ?>
                            </p>
                        </div>
                        <div class="content_detail_subcontent_left_responsive_company">
                                <div class="borderline">
                                    <hr>
                                </div>
                                <h2 class="content_detail_subcontent_left_responsive_company_title">会社情報</h2>
                                <div class="content_detail_subcontent_left_responsive_company_text">
                                    <p class="content_detail_subcontent_left_responsive_company_companyname">

                                        <a href="<?= Utils::h($agency->url) ?>" class="company_name"><?= Utils::h($agency->name) ?></a>
                                    </p>
                                    <p><?= Utils::h($agency->email) ?></p>
                                <p><?= Utils::h($agency->tel) ?></p>
                                <p><?= Utils::h($agency->url) ?></p>
                                    <p class="content_detail_subcontent_left_responsive_company_address"><?= Utils::h($agency->address) ?></p>
                                </div>
                        </div>
                    </div>
                    <div class="borderline">
                        <hr>
                    </div>
                </div>
                <!-- ここからお問い合わとかの右側にある情報 -->
                <div class="content_detail_subcontent_right">
                    <div class="content_detail_subcontent_right_serch">
                        <div class="content_detail_subcontent_right_serch_menu">
                            <div class="content_detail_subcontent_right_serch_menu_text">メニュー</div>
                        </div>
                        <div class="content_detail_subcontent_right_serch_inquirybox">
                            <a href="./contact.php?ids=<?= Utils::h($agency->id) ?>" class="content_detail_subcontent_right_serch_inquiryText">お問合せ</a>
                        </div>
                        <div class="content_detail_subcontent_right_serch_seelaterField">
                            <div class="content_detail_subcontent_right_serch_seelaterField_add">

                                <div class="content_detail_subcontent_right_serch_seelaterField_add_box" onclick="handleSaveFav(<?= Utils::h($agency->id) ?>)">
                                    <h3 class="content_detail_subcontent_right_serch_seelaterField_add_box_text">「後で見る」へ追加</h3>
                                </div>
                                <div class="content_detail_subcontent_right_serch_seelaterfield_seelaterbox">
                                    <a href="./seeLater.php" class="content_detail_subcontent_right_serch_seelaterfield_seelaterbox_text">後で見るリスト</a>
                                </div>
                            </div>
                        </div>
                        <div class="content_detail_subcontent_right_serch_information">
                            <div onclick="diplayingCompanyInfo()" class="content_detail_subcontent_right_serch_information_box" id="content_detail_subcontent_right_serch_information_box">
                                <h3 class="content_detail_subcontent_right_serch_information_title">会社情報
                                </h3>
                            </div>
                            <div class="content_detail_subcontent_right_serch_information_details" id="content_detail_subcontent_right_serch_information_details">
                                <div class="content_detail_subcontent_right_serch_information_details_companyname">

                                    <a href="<?= Utils::h($agency->url) ?>" class="company_name"><?= Utils::h($agency->name) ?></a>
                                </div>
                                <p><?= Utils::h($agency->email) ?></p>
                                <p class="content_detail_subcontent_right_serch_information_detail"><?= Utils::h($agency->tel) ?></p>
                                <p class="content_detail_subcontent_right_serch_information_detail"><?= Utils::h($agency->url) ?></p>
                                <p class="content_detail_subcontent_right_serch_information_detail"><?= Utils::h($agency->address) ?></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>


        <!-- 一番下に固定しておく後で見るに追加とお問合せ -->

    </div>

<!-- <div class="detail_blank"></div> -->


</main>
<div class="bar_for_responsive">
    <div class="bar_for_responsive_inner">
        <a href="./contact.php?ids=<?= Utils::h($agency->id) ?>"><i class="fa-solid fa-file-pen"></i></a>
        <a href="./seeLater.php" class="back_to_top"><i id="book_mark" class="fas fa-bookmark"></i></a>
        <a href=""><i  onclick="handleSaveFav(<?= Utils::h($agency->id) ?>)" class="fa-solid fa-star"></i>
</a>
    </div>
</div>
<?php include dirname(__FILE__) . '/footer.php' ?>