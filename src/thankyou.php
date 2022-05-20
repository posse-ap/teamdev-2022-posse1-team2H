<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

use cruds\User;

$user_cruds = new User($db);

$agencies = $user_cruds->getAgencies();

$types = $user_cruds->getType();
$industries = $user_cruds->getIndustries();

include dirname(__FILE__) . "/header.php";
?>
<main class="user_thankyou">
<div class="user_thankyou_inner">
    <div class="user_thankyou_inner_box">
        <h1 class="user_thankyou_inner_text">Thank you!!</h1>
        <div class="user_thankyou_inner_news">
          <h2 class="user_thankyou_inner_post">送信が完了いたしました</h2>
        </div>
        
        <a href="./index.php" class="user_thankyou_inner_top">
           <i class="fa fa-caret-right">TOP画面へ</i> 
        </a>
    </div>
</div>


</main>
<?php include dirname(__FILE__) . '/footer.php' ?>