<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

use cruds\User;

$user_cruds = new User($db);

$agencies = $user_cruds->getAgencies();

$types = $user_cruds->getType();
$industries = $user_cruds->getIndustries();

include dirname(__FILE__) . "/header.php";
?>
<main id="user_top" class="content">
    <!-- エージェント一覧 -->
    <div class="agency_list">
        <div class="new_agency_wrapper">
            <h1 class="title">新着</h1>
            <div class="new_agency_inner">
                <?php for ($i = 0; $i < 6; $i++) : ?>
                    <article class="new_agency_card">
                        <div class="agency_img">
                            <a href="https://posse-ap.com/">
                                <img src="https://www.asahicom.jp/articles/images/AS20180803001882_comm.jpg" alt="">
                            </a>
                        </div>
                        <div class="agency_card_content">
                            <div class="agency_infromation">
                                <div class="name_and_favorite">
                                    <div class="agency_name_wrapper"><span id="agency_name<?php echo $i ?>" class="agency_name">三菱ufj信託銀行</span></div>
                                    <div id="star<?php echo $i ?>" class="star<?php echo $i ?>" onclick="changingColor(this)"><i class="fa-solid fa-star"></i></div>

                                </div>
                                <div class="agency_slogan_wrapper"><span class="slogan">面接対策,ES添削で内定サポート！ 就活エージェントおすすめ15選</span></div>
                            </div>
                            <div class="agency_tags_wrapper">
                                <i class="fa-solid fa-tags" style="color: #9E9E9E"></i>
                                <a href=""><span class="filling"></span>#広告</a>
                                <a href=""><span class="filling"></span>#コンサル</a>
                                <a href=""><span class="filling"></span>#文系に強い</a>
                                <a href=""><span class="filling"></span>#ベンチャーが多い</a>
                            </div>
                        </div>

                    </article>
                <?php endfor ?>
            </div>
        </div>

        <div class="popular_agency_wrapper">
            <h1 class="title">人気</h1>
            <div class="popular_agency_inner">
                <?php for ($i = 6; $i < 12; $i++) : ?>
                    <article class="popular_agency_card">
                        <div class="agency_img">
                            <a href="https://posse-ap.com/">
                                <img src="https://www.ntt-f.co.jp/architect/shared/inpex-naoetsu/d-01.jpg" alt="">
                            </a>
                        </div>
                        <div class="agency_card_content">
                            <div class="agency_infromation">
                                <div id="name_and_favorite" class="name_and_favorite">
                                    <div class="agency_name_wrapper"><span id="agency_name<?php echo $i ?>" class="agency_name">国際石油開発帝石ホールディングス</span></div>
                                    <div id="star<?php echo $i ?>" class="star<?php echo $i?>" onclick="changingColor(this)"><i class="fa-solid fa-star"></i></div>
                                </div>
                                <div class="agency_slogan_wrapper"><span class="slogan">面接対策,ES添削で内定サポート！ 就活エージェントおすすめ15選</span></div>
                            </div>
                            <div class="agency_tags_wrapper">
                                <i class="fa-solid fa-tags" style="color: #9E9E9E"></i>
                                <a href="">#広告</a>
                                <a href="">#コンサル</a>
                                <a href="">#文系に強い</a>
                                <a href="">#ベンチャーが多い</a>
                            </div>
                        </div>

                    </article>

                <?php endfor ?>
            </div>

        </div>
    </div>
    <!-- サイドバー -->
    <div id="sidebar_wrapper" class="sidebar_wrapper">
        <aside id="sidebar_inner" class="sidebar_inner">
            <div class="sidebar_favorite_area">
                <div class="sidebar_favorite">
                    <h2 onclick="savingData()">後で見る</h2>
                </div>
                <div class="favorite_content"></div>
            </div><br>
            <div class="sidebar_search_area">
                <form name="searchForm" method="" action="" onsubmit="return false">
                    <div class="sidebar_search">
                        <h2 onclick="appearSidebar()">検索</h2>
                        <div id="serach_content" class="serach_content">
                            <div id="business_type_wrapper" class="business_type_wrapper">
                                <p onclick="appearIndustryTypes()"><i class="fa-solid fa-building"></i>業種</p>
                                <div id="business_type_items" class="business_type_inner">
                                    <?php foreach ($industries as $industry) : ?>
                                        <label>
                                            <input class="business_type_tag" type="checkbox" name="industries" value="<?= $industry['id'] ?>" onclick="handleSearch()"><?= $industry['industry'] ?>
                                        </label>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="business_features_wrapper">
                                <p onclick="appearTypes()"><i class="fa-solid fa-glasses"></i>特徴</p>
                                <div id="business_features" class="business_type_inner">
                                    <?php foreach ($types as $type) : ?>
                                        <label>
                                            <input class="business_type_tag" type="checkbox" name="types" value="<?= $type['id'] ?>" onclick="handleSearch()"><?= $type['agency_type'] ?>
                                        </label>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </aside>
    </div>

</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
