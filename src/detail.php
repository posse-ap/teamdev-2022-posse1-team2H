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
                    <h2 class="content_detail_catchcopy_title"><?= Utils::h($agency->title) ?></h2>
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
                        <div class="content_detail_subcontent_left_agentStudent_agent">
                            <h1 class="content_detail_subcontent_left_agentrequest_agent_title">どんなエージェント企業か</h1>
                            <p class="content_detail_subcontent_left_agentrequest_agent_text">
                                アリスは川辺でおねえさんのよこにすわって、なんにもすることがないのでとても退屈（たいくつ）しはじめていました。 一、二回はおねえさんの読んでいる本をのぞいてみたけれど、そこには絵も会話もないのです。 「絵や会話のない本なんて、なんの役にもたたないじゃないの」とアリスは思いました。 そこでアリスは、頭のなかで、ひなぎくのくさりをつくったら楽しいだろうけれど、 起きあがってひなぎくをつむのもめんどくさいし、どうしようかと考えていました （といっても、昼間で暑いし、とってもねむくて頭もまわらなかったので、
                                これもたいへんだったのですが）。 そこへいきなり、ピンクの目をした白うさぎが近くを走ってきたのです。 それだけなら、そんなにめずらしいことでもありませんでした。 さらにアリスとしては、そのうさぎが 「どうしよう！ どうしよう！ ちこくしちゃうぞ！」 とつぶやくのを聞いたときも、 それがそんなにへんてこだとは思いませんでした （あとから考えてみたら、これも不思議に思うべきだったのですけれど、 でもこのときには、それがごく自然なことに思えたのです）。
                            </p>
                        </div>
                        <div class="borderline">
                            <hr>
                        </div>
                        <div class="content_detail_subcontent_left_agentStudent_Student">
                            <h1 class="content_detail_subcontent_left_agentStudent_Student_title">どんな学生にオススメか</h1>
                            <p class="content_detail_subcontent_left_agentStudent_Student_text">
                                アリスは川辺でおねえさんのよこにすわって、なんにもすることがないのでとても退屈（たいくつ）しはじめていました。 一、二回はおねえさんの読んでいる本をのぞいてみたけれど、そこには絵も会話もないのです。 「絵や会話のない本なんて、なんの役にもたたないじゃないの」とアリスは思いました。 そこでアリスは、頭のなかで、ひなぎくのくさりをつくったら楽しいだろうけれど、 起きあがってひなぎくをつむのもめんどくさいし、どうしようかと考えていました （といっても、昼間で暑いし、とってもねむくて頭もまわらなかったので、
                                これもたいへんだったのですが）。 そこへいきなり、ピンクの目をした白うさぎが近くを走ってきたのです。 それだけなら、そんなにめずらしいことでもありませんでした。 さらにアリスとしては、そのうさぎが 「どうしよう！どうしよう！ ちこくしちゃうぞ！」 とつぶやくのを聞いたときも、 それがそんなにへんてこだとは思いませんでした （あとから考えてみたら、これも不思議に思うべきだったのですけれど、 でもこのときには、それがごく自然なことに思えたのです）。</p>
                        </div>
                        <div class="borderline">
                            <hr>
                        </div>
                        <div class="content_detail_subcontent_left_company_information">
                            <h1 class="content_detail_subcontent_left_agentStudent_Student_title">会社情報</h1>
                            <p class="content_detail_subcontent_left_agentStudent_Student_text">
                                <a href="https://google.com" class="company_name">株式会社武田鉄也</a>
                                <br>2020年に創業
                                <br>15000のメンバー
                                <br>東京都港区表参道Harbors
                            </p>
                        </div>
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
                                <div class="content_detail_subcontent_right_serch_seelaterField_seelaterbox">
                                    <a href="seeLater.php" class="content_detail_subcontent_right_serch_seelaterField_seelaterbox_text">後で見る
                                    </a>

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

                                    <a href="https://google.com" class="company_name">株式会社武田鉄</a>
                                </div>
                                <p class="content_detail_subcontent_right_serch_information_details_found">2020年に創業</p>
                                <p class="content_detail_subcontent_right_serch_information_details_member">15000のメンバー</p>
                                <p class="content_detail_subcontent_right_serch_information_details_address">東京都港区表参道Harbors</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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