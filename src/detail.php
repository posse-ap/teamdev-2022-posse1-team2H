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
                    <h1 class="content_detail_catchcopy_title"><?= Utils::h($agency->title) ?></h1>
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
                            <h2 class="content_detail_subcontent_left_agentrequest_agent_title">どんなエージェント企業か</h2>
                            <p class="content_detail_subcontent_left_agentrequest_agent_text">
                                アリスは川辺でおねえさんのよこにすわって、なんにもすることがないのでとても退屈（たいくつ）しはじめていました。 一、二回はおねえさんの読んでいる本をのぞいてみたけれど、そこには絵も会話もないのです。 「絵や会話のない本なんて、なんの役にもたたないじゃないの」とアリスは思いました。 そこでアリスは、頭のなかで、ひなぎくのくさりをつくったら楽しいだろうけれど、 起きあがってひなぎくをつむのもめんどくさいし、どうしようかと考えていました （といっても、昼間で暑いし、とってもねむくて頭もまわらなかったので、
                                これもたいへんだったのですが）。 そこへいきなり、ピンクの目をした白うさぎが近くを走ってきたのです。 それだけなら、そんなにめずらしいことでもありませんでした。 さらにアリスとしては、そのうさぎが 「どうしよう！ どうしよう！ ちこくしちゃうぞ！」 とつぶやくのを聞いたときも、 それがそんなにへんてこだとは思いませんでした （あとから考えてみたら、これも不思議に思うべきだったのですけれど、 でもこのときには、それがごく自然なことに思えたのです）。
                            </p>
                        </div>
                        <div class="borderline">
                            <hr>
                        </div>
                        <div class="content_detail_subcontent_left_agentstudent_student">
                            <h2 class="content_detail_subcontent_left_agentstudent_student_title">どんな学生にオススメか</h2>
                            <p class="content_detail_subcontent_left_agentstudent_student_text">
                                アリスは川辺でおねえさんのよこにすわって、なんにもすることがないのでとても退屈（たいくつ）しはじめていました。 一、二回はおねえさんの読んでいる本をのぞいてみたけれど、そこには絵も会話もないのです。 「絵や会話のない本なんて、なんの役にもたたないじゃないの」とアリスは思いました。 そこでアリスは、頭のなかで、ひなぎくのくさりをつくったら楽しいだろうけれど、 起きあがってひなぎくをつむのもめんどくさいし、どうしようかと考えていました （といっても、昼間で暑いし、とってもねむくて頭もまわらなかったので、
                                これもたいへんだったのですが）。 そこへいきなり、ピンクの目をした白うさぎが近くを走ってきたのです。 それだけなら、そんなにめずらしいことでもありませんでした。 さらにアリスとしては、そのうさぎが 「どうしよう！どうしよう！ ちこくしちゃうぞ！」 とつぶやくのを聞いたときも、 それがそんなにへんてこだとは思いませんでした （あとから考えてみたら、これも不思議に思うべきだったのですけれど、 でもこのときには、それがごく自然なことに思えたのです
                            </p>
                        </div>
                        <div class="content_detail_subcontent_left_responsive_company">
                                <div class="borderline">
                                    <hr>
                                </div>
                                <h2 class="content_detail_subcontent_left_responsive_company_title">会社情報</h2>
                                <div class="content_detail_subcontent_left_responsive_company_text">
                                    <p class="content_detail_subcontent_left_responsive_company_companyname">

                                        <a href="https://google.com" class="company_name">株式会社武田鉄</a>
                                    </p>
                                    <p class="content_detail_subcontent_left_responsive_company_found">2020年に創業</p>
                                    <p class="content_detail_subcontent_left_responsive_company_member">15000のメンバー</p>
                                    <p class="content_detail_subcontent_left_responsive_company_address">東京都港区表参道Harbors</p>
                                </div>
                        </div>
                    </div>
                    <div class="borderline">
                        <hr>
                    </div>
                    <div class="content_detail_recommendedagent">
                        <h2 class="content_detail_recommendedagent_title">あなたにオススメのエージェンシー
                        </h2>
                        <div class="content_detail_recommendedagent_bigbox">
                            <article class="content_detail_recommendedagent_box1">
                                <div class="content_detail_recommendedagent_box1_img"></div>
                                <a href="https://posse-ap.com/">
                                    <img src="https://reashu.com/wp-content/uploads/2022/01/1b6d9abbd870d9cc7205edfd07ed96ba.png" alt="" class="content_detail_recommendedagent_box1_img"></a>

                            </article>
                            <article class="content_detail_recommendedagent_box2">
                                <div class="content_detail_recommendedagent_box2_img"></div>
                                <a href="https://posse-ap.com/">
                                    <img src="https://reashu.com/wp-content/uploads/2022/01/1b6d9abbd870d9cc7205edfd07ed96ba.png" alt="" class="content_detail_recommendedagent_box2_img"></a>
                            </article>
                            <article class="content_detail_recommendedagent_box3">
                                <div class="content_detail_recommendedagent_box3_img"></div>
                                <a href="https://posse-ap.com/">
                                    <img src="https://reashu.com/wp-content/uploads/2022/01/1b6d9abbd870d9cc7205edfd07ed96ba.png" alt="" class="content_detail_recommendedagent_box3_img"></a>
                            </article>

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
                            <a href="./contact.php?ids=<?= Utils::h($agency->id) ?>" class="content_detail_subcontent_right_serch_inquirytext">お問合せ</a>
                        </div>
                        <div class="content_detail_subcontent_right_serch_seelaterfield">
                            <div class="content_detail_subcontent_right_serch_seelaterfield_add">

                                <div class="content_detail_subcontent_right_serch_seelaterfield_add_box" onclick="handleSaveFav(<?= Utils::h( $agency->id) ?>)">
                                    <p class="content_detail_subcontent_right_serch_seelaterfield_add_box_text">「気になる」へ追加</p>
                                </div>
                                <div class="content_detail_subcontent_right_serch_seelaterfield_seelaterbox">
                                    <p class="content_detail_subcontent_right_serch_seelaterfield_seelaterbox_text">気になるリスト</p>

                                </div>
                            </div>
                        </div>
                        <div class="content_detail_subcontent_right_serch_information">
                            <div onclick="diplayingCompanyInfo()" class="content_detail_subcontent_right_serch_information_box" id="content_detail_subcontent_right_serch_information_box">
                                <p class="content_detail_subcontent_right_serch_information_title">会社情報</p>
                            </div>

                            <div class="content_detail_subcontent_right_serch_information_details" id="content_detail_subcontent_right_serch_information_details">
                                <div class="content_detail_subcontent_right_serch_information_details_companyname">

                                    <a href="https://google.com" class="company_name">株式会社武田鉄</a>
                                </div>
                                <p class="content_detail_subcontent_right_serch_information_detail">2020年に創業</p>
                                <p class="content_detail_subcontent_right_serch_information_detail">15000のメンバー</p>
                                <p class="content_detail_subcontent_right_serch_information_detail">東京都港区表参道Harbors</p>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

                <div class="content_detail_underrequest_seelaterbox">
                    <h4 class="content_detail_underrequest_seelaterText" onclick="handleSaveFav(<?= Utils::h($agency->id) ?>)">後で見るリストに追加
                    </h4>
                </div>
                <a href="contact.php?ids=<?= $agency->id ?>" class="content_detail_underrequest_inquirybox">
                    <h4 class="content_detail_underrequest_inquiryText">お問合せ
                    </h4>
                </a>
            </div>
        </div>
        </div>
        </div>
        <div class="detail_blank"></div>
        </div>
    
        <!-- 一番下に固定しておく後で見るに追加とお問合せ -->

    </div>
        
<div class="detail_blank"></div>
        

</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
