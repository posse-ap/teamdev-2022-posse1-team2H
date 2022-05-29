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
            <div class="content_detail_catchcopy_imgbig">
                <div class="content_detail_catchcopy">
                    <h1 class="content_detail_catchcopy_title"><?= Utils::h($agency->name) ?></h1>
                    <div class="content_detail_catchcopy_subtitle">
                        <ul class="content_detail_catchcopy_subtitle_items">
                        <?php foreach ($agency->industries as $industry) : ?>
                            <li class="content_detail_catchcopy_subtitle_item">
                            <a href="" class="content_detail_catchcopy_subtitle_item_text">#<?= Utils::h($industry->industry) ?></a>
                        </li>
                        <?php endforeach ?>
                        </ul>
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
                    <!-- <div class="content_detail_left_subcontent"> -->
                    <div class="content_detail_subcontent_left_agentstudent">
                        <ul class="content_detail_subcontent_left_agentstudent_table">
                            <li class="content_detail_subcontent_left_agentstudent_table_top">
                                <a href="./index.php" class="content_detail_subcontent_left_agentstudent_table_toptext">TOP画面</a>
                            </li>
                            <li class="content_detail_subcontent_left_agentstudent_table_detail">詳細ページ</li>
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
                            <a href="./contact.php?ids=<?= Utils::h($agency->id) ?>" class="content_detail_subcontent_right_serch_inquirytext">お問合せ</a>
                        </div>
                        <div class="content_detail_subcontent_right_serch_seelaterfield">
                            <div class="content_detail_subcontent_right_serch_seelaterfield_add">

                                <div class="content_detail_subcontent_right_serch_seelaterfield_add_box" onclick="handleSaveFav(<?= Utils::h( $agency->id) ?>)">
                                    <p class="content_detail_subcontent_right_serch_seelaterfield_add_box_text">「後で見る」へ追加</p>
                                </div>
                                <div class="content_detail_subcontent_right_serch_seelaterfield_seelaterbox">
                                    <a href="./seeLater.php" class="content_detail_subcontent_right_serch_seelaterfield_seelaterbox_text">後で見るリスト</a>
                                </div>
                            </div>
                        </div>
                        <div class="content_detail_subcontent_right_serch_information">
                            <div onclick="diplayingCompanyInfo()" class="content_detail_subcontent_right_serch_information_box" id="content_detail_subcontent_right_serch_information_box">
                                <p class="content_detail_subcontent_right_serch_information_title">会社情報</p>
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
         <div class="content_detail_underrequest">
             <div class="content_detail_action_bar">
                <div class="content_detail_underrequest_seelaterbox">
                    <h4 class="content_detail_underrequest_seelaterText" onclick="handleSaveFav(<?= Utils::h($agency->id) ?>)">後で見るリストに追加
                    </h4>
                </div>

                <a href="./seeLater.php" class="content_detail_underrequest_likelistbox">
                    <h4 class="content_detail_underrequest_likelisttext">後で見るリストへ
                    </h4>
                </a>
                <a href="contact.php?ids=<?= $agency->id ?>" class="content_detail_underrequest_inquirybox">
                    <h4 class="content_detail_underrequest_inquirytext">お問合せ
                    </h4>
                </a>
            </div>
        </div>
        </div>


        <!-- 一番下に固定しておく後で見るに追加とお問合せ -->

    </div>

<!-- <div class="detail_blank"></div> -->


</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
