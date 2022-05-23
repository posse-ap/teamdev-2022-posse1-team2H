<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

use cruds\User as Crud;
use models\User as Model;
use modules\utils\Utils;
use modules\auth\Token;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array();
    Token::validate();
    if (!isset($_REQUEST['name'])) {
        $error['name'] = 'name required';
    }
    if (!isset($_REQUEST['email'])) {
        $error['email'] = 'email required';
    }
    if (!isset($_REQUEST['tel'])) {
        $error['tel'] = 'tel required';
    }
    if (!isset($_REQUEST['univercity'])) {
        $error['univercity'] = 'univercity required';
    }
    if (!isset($_REQUEST['undergraduate'])) {
        $error['undergraduate'] = 'undergraduate required';
    }
    if (!isset($_REQUEST['age'])) {
        $error['age'] = 'age required';
    }
    if (!isset($_REQUEST['department'])) {
        $error['department'] = 'department required';
    }
    if (!isset($_REQUEST['school_year'])) {
        $error['school_year'] = 'school year required';
    }
    if (!isset($_REQUEST['graduation_year'])) {
        $error['graduation_year'] = 'graduation_year required';
    }
    if (!isset($_REQUEST['gender'])) {
        $error['gender'] = 'gender required';
    }
    if (!isset($_REQUEST['address'])) {
        $error['address'] = 'address required';
    }
    if (!isset($_REQUEST['address_num'])) {
        $error['address_num'] = 'address_num required';
    }
    if (empty($error)) {
        $user = new Model(
            $_REQUEST['name'],
            $_REQUEST['email'],
            $_REQUEST['tel'],
            $_REQUEST['univercity'],
            $_REQUEST['undergraduate'],
            $_REQUEST['department'],
            $_REQUEST['school_year'],
            $_REQUEST['graduation_year'],
            $_REQUEST['gender'],
            $_REQUEST['address'],
            $_REQUEST['address_num']
        );
        $agencies = $_REQUEST['agency_ids'];
        $_SESSION['user_form']['user'] = $user;
        $_SESION['user_form']['agencies'] = $agencies;
        header('Location: contactAfter.php');
        exit;
    }
}
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
        <div class="user_inquary_content_innerframe">
            <form class="user_inquary_content_inner" action="" method="POST">
                <input type="hidden" name="agency_ids" value="<?= Utils::h($_GET['ids']) ?>">
                <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']) ?>">
                <dl class="user_inquary_content_inner_name">

                    <dt class="user_inquary_content_inner_name_title">お名前 ※
                    </dt>

                    <input type="text" value size="40 " class="user_inquary_content_inner_name_enter_text" name="name">

                </dl>
                <dl class="user_inquary_content_inner_age">
                    <dt class="user_inquary_content_inner_age_title">年齢 ※
                    </dt>
                    <select name="age" id="user_inquary_content_inner_age_enter_text" class="user_inquary_content_inner_age_enter_text" aria-invalid="false">
                        <option value="">年齢</option>
                        <option value="18">18歳</option>
                        <option value="19">19歳</option>
                        <option value="20">20歳</option>
                        <option value="21">21歳</option>
                        <option value="22">22歳</option>
                        <!-- <option value="23歳以降">23歳以降</option> -->
                    </select>
                </dl>
                <dl class="user_inquary_content_inner_mail">
                    <dt class="user_inquary_content_inner_mail_title">Email ※
                    </dt>
                    <input type="text" value size="40 " class="user_inquary_content_inner_mail_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字" name="email">
                </dl>
                <dl class="user_inquary_content_inner_phone">
                    <dt class="user_inquary_content_inner_phone_title">電話番号 ※
                    </dt>
                    <input type="text" value size="40" class="user_inquary_content_inner_phone_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字 (ハイフンなし)" name="tel">
                </dl>
                <dl class="user_inquary_content_inner_college">
                    <dt class="user_inquary_content_inner_college_title">大学名 ※
                    </dt>
                    <input type="text" value size="40" class="user_inquary_content_inner_college_enter_text" name="university>
                </dl>
                <dl class="user_inquary_content_inner_undergraduate">
                    <dt class="user_inquary_content_inner_undergraduate_title">学部 ※
                    </dt>
                    <input type="text" value size="40" class="user_inquary_content_inner_undergraduate_enter_text" name="undergraduate">
                </dl>
                <dl class="user_inquary_content_inner_faculty">

                    <dt class="user_inquary_content_inner_faculty_title">学科 ※
                    </dt>
                    <input type="text" value size="40" class="user_inquary_content_inner_faculty_enter_text" name="department">
                </dl>
                <dl class="user_inquary_content_inner_schoolyear">
                    <dt class="user_inquary_content_inner_schoolyear_title">学年 ※
                    </dt>
                    <select name="school_year" id="user_inquary_content_inner_schoolyear_enter_text" class="user_inquary_content_inner_schoolyear_enter_text" aria-invalid="false">
                        <option value="">学年</option>
                        <option value="1">1年生</option>
                        <option value="2">2年生</option>
                        <option value="3">3年生</option>
                        <option value="4">4年生</option>
                    </select>
                </dl>
                <dl class="user_inquary_content_inner_graduation">
                    <dt class="user_inquary_content_inner_graduation_title">卒業予定年 ※
                    </dt>
                    <select name="graduation_year" id="user_inquary_content_inner_mail_enter_text" class="user_inquary_content_inner_mail_enter_text" aria-invalid="false">
                        <option value="">卒業予定年</option>
                        <option value="2023">2023年度</option>
                        <option value="2024">2024年度</option>
                        <option value="2025">2025年度</option>
                        <option value="2026">2026年度</option>
                    </select>
                </dl>
                <dl class="user_inquary_content_inner_gender">
                    <dt class="user_inquary_content_inner_gender_title">性別 ※
                    </dt>
                    <select name="gender" id="user_inquary_content_inner_gender_enter_text" class="user_inquary_content_inner_gender_enter_text" aria-invalid="false">
                        <option value="">性別</option>
                        <option value="0">男</option>
                        <option value="1">女</option>
                    </select>
                </dl>
                <dl class="user_inquary_content_inner_addressnumber">
                    <dt class="user_inquary_content_inner_addressnumber_title">郵便番号 ※
                    </dt>
                    <input type="text" value="" size="25" class="user_inquary_content_inner_addressnumber_enter_text2" name="address_num">
                </dl>
                <dl class="user_inquary_content_inner_address">
                    <dt class="user_inquary_content_inner_address_title">住所 ※
                    </dt>
                    <input type="text" value size="40" class="user_inquary_content_inner_address_enter_text" name="address">
                </dl>

                <dl class="user_inquary_contet_inner_confirmation">
                    <input onclick="allowTransition();" type="checkbox" class="user_inquary_content_inner_confirmation_inner_checkBox" id="user_inquary_content_inner_confirmation_inner_checkBox" value="" name="">
                    プライバシーポリシーに同意します
                </dl>
                <p class="user_inquary_content_inner_submit" id="user_inquary_content_inner_submit">
                    <input type="submit" id="user_inquary_content_inner_submit_button" class="user_inquary_content_inner_submit_button" value="確認画面へ"></in>
                </p>
            </form>
        </div>
    </div>
</main>
<?php include dirname(__FILE__) . '/footer.php' ?>
