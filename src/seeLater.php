<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

use cruds\User;

$user_cruds = new User($db);

$agencies = $user_cruds->getAgencies();

$types = $user_cruds->getType();
$industries = $user_cruds->getIndustries();

include dirname(__FILE__) . "/header.php";
?>
<main class="user_likelist">
  <div class="user_likelist_topbar">
<a href="./index.php" class="user_likelist_topbar_top">TOP画面へ</a>
    
    <button class="user_likelist_topbar_inquiry">まとめてお問合せ
    </button>
  </div>
  <div class="user_likelist_frame">
    <div class="user_likelist_number">
  <h3 class="user_likelist_number"><span class="user_likelist_number_Z">4</span>件</h3>
    </div>
    <div class="user_likelist_inner">
      <div class="user_likelist_inquiry">
      </div>
        <div class="user_likelist_inner1box">
          <div class="user_likelist_inner1">
            <div class="user_likelist_inner1_header">
                <h2 class="user_likelist_inner1_header_title">株式会社武田鉄</h2>
                <div class="user_likelist_inner1_trash">
                    <h3 class="user_likelist_inner1_trash_text">削除する</h3>
                </div>
            </div>
            <div class="user_likelist_inner1_body">
                
                    <img src="https://reashu.com/wp-content/uploads/2022/01/1b6d9abbd870d9cc7205edfd07ed96ba.png" alt="" class="user_likelist_inner1_body_img">
           
                <div class="user_likelist_inner1_body_right">
                <div class="user_likelist_inner1_body_text">
                      <p class="user_likelist_inner1_body_text_catchcopy">とにかく文系に強い！！！！</p>
                      <p class="user_likelist_inner1_body_text_connection">#機械系#パワー型</p>
                    </div>

                    <div class="user_likelist_inner1_body_under">
                        <button class="user_likelist_inner1_body_under_contact">
                          お問合せる
                        </button>
                        <button class="user_likelist_inner1_body_under_detail">
                          詳細ページへ
                        </button>
                    </div>
                </div>
            </div>

          </div>

        </div>
    </div>

  </div>
  <div class="user_likelist_frame">
    <div class="user_likelist_inner">
      <div class="user_likelist_inquiry">
      </div>
        <div class="user_likelist_inner1box">
          <div class="user_likelist_inner1">
            <div class="user_likelist_inner1_header">
                <h2 class="user_likelist_inner1_header_title">株式会社武田鉄</h2>
                <div class="user_likelist_inner1_trash">
                    <h3 class="user_likelist_inner1_trash_text">削除する</h3>
                </div>
            </div>
            <div class="user_likelist_inner1_body">
                
                    <img src="https://reashu.com/wp-content/uploads/2022/01/1b6d9abbd870d9cc7205edfd07ed96ba.png" alt="" class="user_likelist_inner1_body_img">
           
                <div class="user_likelist_inner1_body_right">
                    <div class="user_likelist_inner1_body_text">
                      <p class="user_likelist_inner1_body_text_catchcopy">とにかく文系に強い！！！！</p>
                      <p class="user_likelist_inner1_body_text_connection">#機械系#パワー型</p>
                    </div>

                    <div class="user_likelist_inner1_body_under">
                        <button class="user_likelist_inner1_body_under_contact">
                          お問合せる
                        </button>
                        <button class="user_likelist_inner1_body_under_detail">
                          詳細ページへ
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