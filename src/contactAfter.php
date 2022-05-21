
<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

use cruds\User;

$user_cruds = new User($db);



include dirname(__FILE__) . "/header.php";
?>
<main class="user_inquaryAfter">


  <div class="user_inquaryAfter_header">
    <div class="user_inquaryAfter_header_title">

      <h1 class="user_inquaryAfter_header_English">CONTACT</h1>
      <h2 class="user_inquaryAfter_header_jp">お問合せ</h2>
      <p class="user_inquaryAfter_header_prompt"></p>
    </div>
  </div>
  <div class="user_inquaryAfter_content">

    <div class="user_inquaryAfter_content_innerframe">
      <form class="user_inquaryAfter_content_inner">
        <dl class="user_inquaryAfter_content_inner_box">

          <dt class="user_inquaryAfter_content_inner_title">お名前 ※
          </dt>
          <dt class="user_inquaryAfter_content_inner_text">布施陸斗
          </dt>
        
          <!-- <dd class="user_inquaryAfter_contet_inner_name_enter">
            <span class="user_inquaryAfter_content_inner_name_enter_box">
              <input type="text" value size="40 " class="user_inquaryAfter_content_inner_name_enter_text">
            </span>
          </dd> -->

        </dl>
        <dl class="user_inquaryAfter_content_inner_box">
          <dt class="user_inquaryAfter_content_inner_title">年齢
          </dt>
          <dt class="user_inquaryAfter_content_inner_text">20歳
          </dt>
        
        </dl>
        <dl class="user_inquaryAfter_content_inner_box">

          <dt class="user_inquaryAfter_content_inner_title">Email ※
          </dt>
          <dt class="user_inquaryAfter_content_inner_text">onakasuitana-.icloud
          </dt>
         
        </dl>
        <dl class="user_inquaryAfter_content_inner_box">

          <dt class="user_inquaryAfter_content_inner_title">電話番号 ※
          </dt>
          <dt class="user_inquaryAfter_content_inner_title">110
          </dt>
       
        </dl>
        <dl class="user_inquaryAfter_content_inner_box">

          <dt class="user_inquaryAfter_content_inner_title">大学名
          </dt>
      
          <dt class="user_inquaryAfter_content_inner_text">立教大学
          </dt>
      
        </dl>
        <dl class="user_inquaryAfter_content_inner_box">
          <dt class="user_inquaryAfter_content_inner_title">学部
          </dt>
          <dt class="user_inquaryAfter_content_inner_text">経営学部
          </dt>
          
        </dl>
        <dl class="user_inquaryAfter_content_inner_box">

          <dt class="user_inquaryAfter_content_inner_title">学科
          </dt>
          <dt class="user_inquaryAfter_content_inner_text">経営学科
          </dt>
        
        </dl>
        <dl class="user_inquaryAfter_content_inner_box">
          <dt class="user_inquaryAfter_content_inner_title">何回生
          </dt>
          <dt class="user_inquaryAfter_content_inner_text">3年生
          </dt>
         
        </dl>
        <dl class="user_inquaryAfter_content_inner_box">

          <dt class="user_inquaryAfter_content_inner_title">卒業予定日
          </dt>
          <dt class="user_inquaryAfter_content_inner_text">24年卒
          </dt>
        
        </dl>
          <dl class="user_inquaryAfter_content_inner_box">
          <dt class="user_inquaryAfter_content_inner_title">性別
          </dt>
          <dt class="user_inquaryAfter_content_inner_text">男
          </dt>
        
        </dl>
        <dl class="user_inquaryAfter_content_inner_box">
          <dt class="user_inquaryAfter_content_inner_title">郵便番号
          </dt>
          <dt class="user_inquaryAfter_content_inner_text">111-1111
          </dt>
         
        </dl>
        <dl class="user_inquaryAfter_content_inner_box">
          <dt class="user_inquaryAfter_content_inner_title">住所
          </dt>
          <dt class="user_inquaryAfter_content_inner_text">東京都渋谷区2-2-2
          </dt>
         
        </dl>
   
        </dl> 
        <p class="user_inquaryAfter_content_inner_submit">
          <a href="https://spectron.tech/jp/" class="user_inquaryAfter_content_inner_submit_button">内容送信</a>
        </p>
      </form>
    </div>
  </div>


</main>
<?php include dirname(__FILE__) . '/footer.php' ?>