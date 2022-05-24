<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');

use cruds\User as Crud;
use modules\utils\Utils;
use modules\auth\Token;

if (!isset($_SESSION['user_form']['user']) || !isset($_SESSION['user_form']['agencies'])) {
  header('Location: contact.php');
  exit;
}

$user = unserialize($_SESSION['user_form']['user']);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

  Token::validate();
  $crud = new Crud($db);
  $agency_ids = explode(',', $_SESSION['user_form']['agencies']);
  $crud->insertUser($user, $agency_ids);
  header('Location: thankyou.php');
  exit;
}

$agency_ids = $_SESSION['user_form']['agencies'];

include dirname(__FILE__) . "/header.php";
?>
<main class="user_inquary_after">


  <div class="user_inquary_after_header">
    <div class="user_inquary_after_header_title">

      <h1 class="user_inquary_after_header_English">CONTACT</h1>
      <h2 class="user_inquary_after_header_jp">お問合せ</h2>
    </div>
  </div>
  <div class="user_inquary_after_content">

    <div class="user_inquary_after_content_innerFrame">
      <form class="user_inquary_after_content_inner" method="POST" action="">
        <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']) ?>">
        <dl class="user_inquary_after_content_inner_name">

          <dt class="user_inquary_after_content_inner_name_title">お名前 ※
          </dt>
          <dt class="user_inquary_after_content_inner_name_text"><?= Utils::h($user->name) ?>
          </dt>


        </dl>
        <dl class="user_inquary_after_content_inner_age">
          <dt class="user_inquary_after_content_inner_age_title">年齢
          </dt>
          <dt class="user_inquary_after_content_inner_age_text"><?= Utils::h($user->age) ?>歳
          </dt>

        </dl>
        <dl class="user_inquary_after_content_inner_mail">

          <dt class="user_inquary_after_content_inner_mail_title">Email ※
          </dt>
          <dt class="user_inquary_after_content_inner_mail_text"><?= Utils::h($user->email) ?>
          </dt>

        </dl>
        <dl class="user_inquary_after_content_inner_phone">

          <dt class="user_inquary_after_content_inner_phone_title">電話番号 ※
          </dt>
          <dt class="user_inquary_after_content_inner_phone_title"><?= Utils::h($user->tel) ?>
          </dt>

        </dl>
        <dl class="user_inquary_after_content_inner_college">

          <dt class="user_inquary_after_content_inner_college_title">大学名
          </dt>

          <dt class="user_inquary_after_content_inner_college_text"><?= Utils::h($user->university) ?>
          </dt>

        </dl>
        <dl class="user_inquary_after_content_inner_undergraduate">
          <dt class="user_inquary_after_content_inner_undergraduate_title">学部
          </dt>
          <dt class="user_inquary_after_content_inner_undergraduate_text"><?= Utils::h($user->undergraduate) ?>
          </dt>

        </dl>
        <dl class="user_inquary_after_content_inner_faculty">

          <dt class="user_inquary_after_content_inner_faculty_title">学科
          </dt>
          <dt class="user_inquary_after_content_inner_faculty_text"><?= Utils::h($user->department) ?>
          </dt>

        </dl>
        <dl class="user_inquary_after_content_inner_schoolYear">
          <dt class="user_inquary_after_content_inner_schoolYear_title">学年
          </dt>
          <dt class="user_inquary_after_content_inner_schoolYear_text"><?= Utils::h($user->school_year) ?>年生
          </dt>

        </dl>
        <dl class="user_inquary_after_content_inner_graduation">

          <dt class="user_inquary_after_content_inner_graduation_title">卒業予定日
          </dt>
          <dt class="user_inquary_after_content_inner_graduation_text"><?= Utils::h($user->graduation_year) ?>年卒
          </dt>

        </dl>
        <dl class="user_inquary_after_content_inner_gender">
          <dt class="user_inquary_after_content_inner_gender_title">性別
          </dt>
          <dt class="user_inquary_after_content_inner_gender_text">
            <?php if ($user->gender == 0) : ?>
              男性
            <?php else : ?>
              女性
            <?php endif ?>
          </dt>

        </dl>
        <dl class="user_inquary_after_content_inner_addressNumber">
          <dt class="user_inquary_after_content_inner_addressNumber_title">郵便番号
          </dt>
          <dt class="user_inquary_after_content_inner_addressNumber_text"><?= Utils::h($user->address_num) ?>
          </dt>

        </dl>
        <dl class="user_inquary_after_content_inner_address">
          <dt class="user_inquary_after_content_inner_address_title">住所
          </dt>
          <dt class="user_inquary_after_content_inner_address_text"><?= Utils::h($user->address) ?>
          </dt>
        </dl>

        <p class="user_inquary_after_content_inner_submit">
          <input type="submit" value="この内容で送信"class="user_inquary_after_content_inner_submit_button">
        </p>
      </form>
    </div>
  </div>


</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
