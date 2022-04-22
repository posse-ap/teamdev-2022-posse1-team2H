<?php

require(dirname(__FILE__) . "/config.php");

use cruds\User;

$user_cruds = new User($db);

$agencies = $user_cruds->getAgenciesByNew();

include dirname(__FILE__) . "/header.php";
?>
<div id="root"></div>
<main id="content" class="content">
    <!-- エージェント一覧 -->
    <div class="agency_list">
        <div class="new_agency">
            <h1>新着</h1>
            <?php for ($i = 0; $i < 10; $i++) : ?>
                <article class="new_agency_card">
                    <div class="agency_img">
                        <a href="https://posse-ap.com/">
                            <img src="https://reashu.com/wp-content/uploads/2022/01/1b6d9abbd870d9cc7205edfd07ed96ba.png" alt="">
                        </a>
                    </div>
                    <div class="agency_feature">
                        <div>文系に強い</div>
                        <div>カジュアル</div>
                        <div>60エントリー</div>
                    </div>
                    <div class="slogan">
                        <div>とにかく文系に強い！！</div>
                    </div>
                    <div class="name_and_favorite">
                        <div class="agency_name">XXXX株式会社</div>
                        <div id="star" class="star"><i class="fa-solid fa-star"></i></div>
                    </div>
                </article>
            <?php endfor ?>
        </div>
    </div>
    <!-- サイドバー -->
    <div id="sidebar_wrapper" class="sidebar_wrapper">
        <aside id="sidebar_inner" class="sidebar_inner">
            <div class="sidebar_favorite_area">
                <div class="sidebar_favorite">
                    <h2>お気に入り</h2>
                </div>
                <div class="favorite_content"></div>
            </div><br>
            <div class="sidebar_search_area">
                <div class="sidebar_search">
                    <h2>検索</h2>
                </div>
                <div class="serach_content">
                    <div>
                        <h3>地域</h3>
                        <select name="" id="">
                            <option value="">東京</option>
                            <option value="">茨城</option>
                        </select>
                    </div>
                    <div class="business_type_wrapper">
                        <h3>業種</h3>
                        <div class="business_type_inner">

                            <div class="business_type_tag"><a href="https://posse-ap.com/">文系に強い</a></div>
                            <div class="business_type_tag"><a href="https://posse-ap.com/">理系に強い</a></div>
                            <div class="business_type_tag"><a href="https://posse-ap.com/">xxxxx</a></div>
                            <div class="business_type_tag"><a href="https://posse-ap.com/">ttttt</a></div>
                            <div class="business_type_tag"><a href="https://posse-ap.com/">ttttt</a></div>
                            <div class="business_type_tag"><a href="https://posse-ap.com/">ttttt</a></div>

                        </div>
                    </div>
                    <div>
                        <h3>特徴</h3>
                        <select name="" id="">
                            <option value="">東京</option>
                            <option value="">茨城</option>
                        </select>
                    </div>
                </div>
            </div>
        </aside>
    </div>

</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
