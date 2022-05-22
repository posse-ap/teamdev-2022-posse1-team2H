<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

use cruds\User;

$user_cruds = new User($db);


include dirname(__FILE__) . "/header.php";
?>
<main class="user_likelist" id="fav_page">
  <div class="user_likelist_topbar">
    <a href="./index.php" class="user_likelist_topbar_top">TOP画面へ</a>

    <button class="user_likelist_topbar_inquiry">
      <a href="./contact.php">まとめて問い合わせる</a>
    </button>
  </div>
  <div class="user_likelist_frame">
    <div class="user_likelist_number">
      <h3 class="user_likelist_number"><span class="user_likelist_number_Z">4</span>件</h3>
    </div>
    <div class="user_likelist_inner">
      <div class="user_likelist_inquiry">
      </div>
      <div id="fav_target">
        
      </div>

        </div>

      </div>
    </div>

  </div>

</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
