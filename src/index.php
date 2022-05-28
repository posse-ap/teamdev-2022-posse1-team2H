<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

use cruds\User;

$cruds = new User($db);

$agencies = $cruds->getAgencies();

$types = $cruds->getType();
$industries = $cruds->getIndustries();

include dirname(__FILE__) . "/header.php";
?>
<main id="user_top" class="content">

    <!-- エージェント一覧 -->
    <div class="agency_list">
        <div class="new_agency_wrapper">
            <div class="title_box">
                <h1 class="title">NEW ARRIVAL</h1>
                <h3 class="subtitle">新着</h3>
            </div>
            <div class="new_agency_inner" id="new_agencies_target"></div>
        </div>
    </div>
    <!-- サイドバー -->
    <div id="sidebar_wrapper" class="sidebar_wrapper">
        <aside id="sidebar_inner" class="sidebar_inner">
            <div class="sidebar_favorite_area">
                <div class="sidebar_favorite">
                    <a href="seeLater.php" class="sidebar_favorite_text">気になるリストへ</a>
                </div>
                <div class="favorite_content"></div>
                <!-- </div><br> -->
                <div class="sidebar_search_area">
                    <form name="searchform" method="" action="" onsubmit="return false">
                        <div class="sidebar_search">
                            <h1 onclick="appearSidebar()" class="sidebar_search_text">検索</h1>
                            <div id="serach_content" class="serach_content">
                                <div id="business_type_wrapper" class="business_type_wrapper">
                                    <h3 onclick="appearIndustryTypes()" class="business_type_wrapper_text"><i class="fa-solid fa-building"> 業種</i></h3>
                                    <div id="business_type_items" class="business_type_inner">
                                        <?php foreach ($industries as $industry) : ?>
                                            <label class="a">
                                                <input class="business_type_tag" type="checkbox" name="industries" value="<?= $industry['id'] ?>" onclick="handleSearch()"><?= $industry['industry'] ?>
                                            </label>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                <div class="business_features_wrapper">
                                    <h3 onclick="appearTypes()" class="business_features_wrapper_text"><i class="fa-solid fa-glasses"></i> 特徴</h3>
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
<div id="overlay" class="overlay"></div>
<div class="bar_for_responsive">
    <div class="bar_for_responsive_inner">
        <a href="" class="back_to_top"><i id="home_icon" class="fa-solid fa-square-caret-up"></i></a>
        <a href="./seeLater.php" class="back_to_top"><i id="book_mark" class="fas fa-bookmark"></i></a>
        <div class="appearing_serach_area" onclick="dispalyingSerachArea()"><i id="serach_icon" class="fa-solid fa-magnifying-glass"></i></div>
    </div>
</div>

<div id="modal" class="modal">
    <div onclick="closingBtn()" id="close_btn" class="close_btn"></div>

    <div id="modal_inner" class="modal_inner">
        <form name="searchform" method="" action="" onsubmit="return false">
            <div class="modal_content">
                <h2><i id="serach_icon_modal" class="fa-solid fa-magnifying-glass">検索</i></h2>
                <div class="modal_main_content">
                    <div class="business_type_items_modal">
                        <p class="business_type_title_modal"><i id="business_type_icon" class="fa-solid fa-building"></i> 業種</p>
                        <div class="business_type_inner_modal">
                            <?php foreach ($industries as $industry) : ?>
                                <label>
                                    <input class="business_type_tag" type="checkbox" name="industries" value="<?= $industry['id'] ?>" onclick="handleSearch()"><?= $industry['industry'] ?>
                                </label>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="business_features_modal">
                        <p class="business_feature_title_modal"><i id="business_feature_icon" class="fa-solid fa-glasses"></i> 特徴</p>
                        <div class="business_type_inner_modal">
                            <?php foreach ($types as $type) : ?>
                                <label>
                                    <input class="business_type_tag" type="checkbox" name="types" value="<?= $type['id'] ?>" onclick="handleSearch()"><?= $type['agency_type'] ?>
                                </label>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="modal_search">
                    <a href="" class="modal_search_text">検索</a>
                </div>
            </div>
        </form>

    </div>
</div>

<?php include dirname(__FILE__) . '/footer.php' ?>