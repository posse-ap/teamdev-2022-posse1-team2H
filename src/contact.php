<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

use cruds\User;

$user_cruds = new User($db);



include dirname(__FILE__) . "/header.php";
?>
<main class="user_inquary">


  <div class="user_inquary_header">
    <div class="user_inquary_header_title">

      <h1 class="user_inquary_header_English">CONTACT</h1>
      <h2 class="user_inquary_header_jp">お問合せ</h2>
      <p class="user_inquary_header_prompt">質問がございましたらお気軽に下記にお問合せください</p>
    </div>
  </div>
  <div class="user_inquary_content">

    <div class="user_inquary_content_innerFrame">
      <form class="user_inquary_content_inner">
        <dl class="user_inquary_content_inner_name">

          <dt class="user_inquary_content_inner_name_title">お名前 ※
          </dt>
          <dd class="user_inquary_contet_inner_name_enter">
            <span class="user_inquary_content_inner_name_enter_box">
              <input type="text" value size="40 " class="user_inquary_content_inner_name_enter_text">
            </span>
          </dd>

        </dl>
        <dl class="user_inquary_content_inner_age">
          <dt class="user_inquary_content_inner_age_title">年齢
          </dt>
          <dd class="user_inquary_contet_inner_age_enter">
            <span class="user_inquary_content_inner_age_enter_box">
              <select name="user_inquary_content_inner_age_enter_text" id="user_inquary_content_inner_age_enter_text" class="user_inquary_content_inner_age_enter_text" aria-invalid="false">
                <option value="年齢">年齢</option>
                <option value="18歳">18歳</option>
                <option value="19歳">19歳</option>
                <option value="20歳">20歳</option>
                <option value="21歳">21歳</option>
                <option value="22歳">22歳</option>
                <option value="23歳以降">23歳以降</option>
              </select>

            </span>
          </dd>
        </dl>
        <dl class="user_inquary_content_inner_mail">

          <dt class="user_inquary_content_inner_mail_title">Email ※
          </dt>
          <dd class="user_inquary_contet_inner_mail_enter">
            <span class="user_inquary_content_inner_mail_enter_box">
              <input type="text" value size="40 " class="user_inquary_content_inner_mail_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字">
            </span>
          </dd>
        </dl>
        <dl class="user_inquary_content_inner_phone">

          <dt class="user_inquary_content_inner_phone_title">電話番号 ※
          </dt>
          <dd class="user_inquary_contet_inner_phone_enter">
            <span class="user_inquary_content_inner_phopne_enter_box">
              <input type="text" value size="40" class="user_inquary_content_inner_phone_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字 (ハイフンなし)">
            </span>
          </dd>
        </dl>
        <dl class="user_inquary_content_inner_college">

          <dt class="user_inquary_content_inner_college_title">大学名
          </dt>
          <dd class="user_inquary_contet_inner_college_enter">
            <span class="user_inquary_content_inner_college_enter_box">
              <input type="text" value size="40" class="user_inquary_content_inner_college_enter_text">
            </span>
          </dd>
        </dl>
        <dl class="user_inquary_content_inner_undergraduate">
          <dt class="user_inquary_content_inner_undergraduate_title">学部
          </dt>
          <dd class="user_inquary_contet_inner_undergraduate_enter">
            <span class="user_inquary_content_inner_undergraduate_enter_box">
              <input type="text" value size="40" class="user_inquary_content_inner_undergraduate_enter_text">
            </span>
          </dd>
        </dl>
        <dl class="user_inquary_content_inner_faculty">

          <dt class="user_inquary_content_inner_faculty_title">学科
          </dt>
          <dd class="user_inquary_contet_inner_faculty_enter">
            <span class="user_inquary_content_inner_faculty_enter_box">
              <input type="text" value size="40" class="user_inquary_content_inner_faculty_enter_text">
            </span>
          </dd>
        </dl>
        <dl class="user_inquary_content_inner_schoolYear">
          <dt class="user_inquary_content_inner_schoolYear_title">何回生
          </dt>
          <dd class="user_inquary_contet_inner_schoolYear_enter">
            <span class="user_inquary_content_inner_schoolYear_enter_box">
              <select name="user_inquary_content_inner_schoolYear_enter_text" id="user_inquary_content_inner_schoolYear_enter_text" class="user_inquary_content_inner_schoolYear_enter_text" aria-invalid="false">
                <option value="何回生">何回生</option>
                <option value="1年生">1回生</option>
                <option value="2年生">2回生</option>
                <option value="3年生">3回生</option>
                <option value="4年生">4回生</option>
                <option value="その他">その他</option>

              </select>

            </span>
          </dd>
        </dl>
        <dl class="user_inquary_content_inner_graduation">

          <dt class="user_inquary_content_inner_graduation_title">卒業予定年
          </dt>
          <dd class="user_inquary_contet_inner_graduation_enter">
            <span class="user_inquary_content_inner_mail_enter_box">
              <select name="user_inquary_content_inner_mail_enter_text" id="user_inquary_content_inner_mail_enter_text" class="user_inquary_content_inner_mail_enter_text" aria-invalid="false">
                <option value="卒業予定年">卒業予定年</option>
                <option value="2023年度">2023年度</option>
                <option value="2024年度">2024年度</option>
                <option value="2025年度">2025年度</option>
                <option value="2026年度">2026年度</option>
              </select>

            </span>
          </dd>
        </dl>
          <dl class="user_inquary_content_inner_gender">
          <dt class="user_inquary_content_inner_gender_title">性別
          </dt>
          <dd class="user_inquary_contet_inner_gender_enter">
            <span class="user_inquary_content_inner_gender_enter_box">
              <select name="user_inquary_content_inner_gender_enter_text" id="user_inquary_content_inner_gender_enter_text" class="user_inquary_content_inner_gender_enter_text" aria-invalid="false">
                <option value="性別">性別</option>
                <option value="男">男</option>
                <option value="女">女</option>
              
                <option value="その他">その他</option>

              </select>

            </span>
          </dd>
        </dl>
        <dl class="user_inquary_content_inner_addressNumber">
          <dt class="user_inquary_content_inner_addressNumber_title">郵便番号
          </dt>
          <dd class="user_inquary_contet_inner_addressNumber_enter">
            <span class="user_inquary_content_inner_addressNumber_enter_box1">
              <input type="text" value size="10" class="user_inquary_content_inner_addressNumber_enter_text1">
            </span>
            <span>-</span>
            <span class="user_inquary_content_inner_addressNumber_enter_box2">
              <input type="text" value size="25" class="user_inquary_content_inner_addressNumber_enter_text2">
            </span>
          </dd>
        </dl>
        <dl class="user_inquary_content_inner_address">
          <dt class="user_inquary_content_inner_address_title">住所
          </dt>
          <dd class="user_inquary_contet_inner_address_enter">
            <span class="user_inquary_content_inner_address_enter_box">
              <input type="text" value size="40" class="user_inquary_content_inner_address_enter_text">
            </span>
          </dd>
        </dl>
        <dl class="user_inquary_content_inner_message">

          <dt class="user_inquary_content_inner_message_title">メッセージ
          </dt>
          <dd class="user_inquary_contet_inner_message_enter">
            <span class="user_inquary_content_inner_message_enter_box">
              <textarea name="user_inquary_content_inner_message_enter_text" id="user_inquary_content_inner_message_enter_text" class="user_inquary_content_inner_message_enter_text" cols="40" rows="10" aria-invalid="false" placeholder="お問い合わせの内容をご記入ください。"></textarea>

            </span>
          </dd>
        </dl>


        <dl class="user_inquary_contet_inner_confirmation">
          <dd class="user_inquary_contet_inner_confirmation_check">
            <span user_inquary_content_inner_confirmaiton_inner_check_box>
              <input type="checkbox" class="user_inquary_content_inner_confirmation_inner_checkBox" id="user_inquary_content_inner_confirmation_inner_checkBox" value="プライバシーポリシーに同意します">
              <span class="user_inquary_content_inner_confirmation_inner_label">
                プライバシーポリシーに同意します
              </span>
            </span>
          </dd>
          <!-- <dd class="user_inquary_content_inner_cofirmation_policy">
            <span class="user_inquary_content_inner_confirmation_policy_text">
              <p>
                &rarr;
                <a href="https://spectron.tech/jp/" class="PRIVACY">PRIVACY POLICY</a>
              </p>
            </span>
          </dd> -->
        </dl>
        <p class="user_inquary_content_inner_submit" id="user_inquary_content_inner_submit">
          <a href="https://spectron.tech/jp/" class="user_inquary_content_inner_submit_button">確認画面へ</a>
        </p>
      </form>
    </div>
  </div>


</main>
<?php include dirname(__FILE__) . '/footer.php' ?>