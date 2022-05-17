<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

use cruds\User;

$user_cruds = new User($db);

$agencies = $user_cruds->getAgencies();

$types = $user_cruds->getType();
$industries = $user_cruds->getIndustries();

include dirname(__FILE__) . "/header.php";
?>
<main class="user_likeList">
  <div class="user_likeList_topBar">

    <button class="user_likeList_topBar_top">TOP画面へ</button>
    <button class="user_likeList_topBar_inquiry">まとめてお問合せ</button>
  </div>
  <div class="user_likeList_frame">
    <div class="user_likeList_inner">
      <div class="user_likeList_inquiry">
      </div>
        <div class="user_likeList_inner1Box">
          <div class="user_likeList_inner1">
            <div class="user_likeList_inner1_header">
                <p class="user_likeList_inner1_header_title">株式会社武田鉄</p>
                <div class="user_likeList_inner1_trash">
                    <a href="https://posse-ap.com/" class="user_likeList_inner1_trash_text">削除する</a>
                </div>
            </div>
            <div class="user_likeList_inner1_body">
                
                    <img src="https://reashu.com/wp-content/uploads/2022/01/1b6d9abbd870d9cc7205edfd07ed96ba.png" alt="" class="user_likeList_inner1_body_img">
           
                <div class="user_likeList_inner1_body_right">
                    <p class="user_likeList_inner1_body_text">とにかく文系に強い！！！！<br>#機械系#パワー型</p>

                    <div class="user_likeList_inner1_body_under">
                        <button class="user_likeList_inner1_body_under_contact">
                          お問合せる
                        </button>
                        <button class="user_likeList_inner1_body_under_detail">
                          エージェンシーの詳細ページへ
                        </button>
                    </div>
                </div>
            </div>

          </div>

        </div>
    </div>

  </div>
    </main>
<?php include dirname(__FILE__) . '/footer.php' ?>