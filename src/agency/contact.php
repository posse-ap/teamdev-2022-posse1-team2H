<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

use modules\auth\Agency;
use cruds\Agency as Crud;
use models\Article;

$crud = new Crud($db);
$auth = new Agency($db);
$auth->validate();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch($_POST['form_id']) {
        case "edit_article":
            $title = $_POST['title'];
            $sentenses = $_POST['sentenses'];
            $eyecatch = $_POST['eyecatch_url'];
            $new_article = new Article(
                $_SESSION['agency']['id'],
                $title,
                $sentenses,
                $eyecatch
            );
            $crud->sendEditRequest($new_article);
            break;
        case "delete_user":
            $email = $_POST['user_email'];
            $reason = $_POST['reason'];
            $crud->sendDeleteUser($email, $reason);
            break;
        case "other":
            $content = $_POST['detail'];
            $crud->sendContact($content);
            break;
        default:
            break;
    }
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/agency/thankyou.php');
    exit;
}

include dirname(__FILE__) . '/header.php' ?>
<div>
    <div class="inquary_header_bg">
        <h2 class="inquary_header_title">お問合せはこちら</h2>
    </div>
    <p class="inquary_header_prompt">質問がございましたらお気軽に下記にお問合せください<br>（ご相談内容が複数ある場合は、別々でお送りください）</p>
    <main class="inquary_content">
        <div class="inquary_content_inner">
            <div class="inquary_content_innerFrame">
                <dl class="consul inquary_content_inner_consul">
                    <dt class="inquary_content_inner_consul_title">ご相談内容</dt>
                    <dd class="inquary_content_inner_consul_enter">
                        <input id="radio1" type="radio" name="choice" onclick="radioBoxClick()" />
                        <label for="radio1" class="radio_title">掲載情報変更</label>
                        <input id="radio2" type="radio" name="choice" onclick="radioBoxClick()" />
                        <label for="radio2" class="radio_title">学生個人情報</label>
                        <input id="radio3" type="radio" name="choice" onclick="radioBoxClick()" />
                        <label for="radio3" class="radio_title">その他</label>
                    </dd>
                </dl>
                <!-- 掲載情報変更 -->
                <form id="hidden1" class="radio_box" method="POST" action="">
                    <input type="hidden" name="form_id" value="edit_article">
                    <dl class="inquary_content_inner_edit_change">
                        <dt class="inquary_content_inner_edit_change_title">タイトル</dt>
                        <dd class="title inquary_content_inner_edit_change_enter">
                            <span class="inquary_content_inner_edit_change_enter_box">
                                <input id="edit_change_title" type="text"  name="title" size="40" class="inquary_content_inner_edit_change_enter_text id">
                            </span>
                        </dd>
                    </dl>
                    <dl class="inquary_content_inner_edit_change_detail">
                        <dt class="inquary_content_inner_edit_change_detail_title">本文</dt>
                        <dd class="detail inquary_content_inner_edit_change_detail_enter">
                            <span class="inquary_content_inner_edit_change_detail_enter_box">
                                <textarea id="edit_change_text" name="sentenses" class="inquary_content_inner_edit_change_detail_enter_text" cols="40" rows="10" aria-invalid="false" placeholder="変更内容を含む全文を記入してください。"></textarea>
                            </span>
                        </dd>
                    </dl>
                    <dl class="inquary_content_inner_edit_change">
                        <dt class="inquary_content_inner_edit_change_title">アイキャッチURL</dt>
                        <dd class="detail inquary_content_inner_icatch_enter">
                            <span class="inquary_content_inner_edit_change_enter_box">
                                <input id="edit_change_icatch" type="text" name="eyecatch_url" size="40" class="inquary_content_inner_edit_change_enter_text">
                            </span>
                        </dd>
                    </dl>
                    <input type="submit" value="この内容で送信する" class="inquary_content_inner_submit_button">
                </form>
                <!-- 学生個人情報 -->
                <form id="hidden2" class="radio_box" method="POST" action="">
                    <input type="hidden" name="form_id" value="delete_user">
                    <dl class="inquary_content_inner_student_information_mail">
                        <dt class="inquary_content_inner_student_information_mail_title">学生Email</dt>
                        <dd class="student inquary_content_inner_student_information_mail_enter">
                            <span class="inquary_content_inner_student_information_mail_enter_box">
                                <input id="student_email" type="text" value size="40" class="inquary_content_inner_student_information_mail_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字" name="user_email">
                            </span>
                        </dd>
                    </dl>
                    <dl class="inquary_content_inner_student_information_detail">
                        <dt class="inquary_content_inner_student_information_detail_title">お問い合わせ理由</dt>
                        <dd class="detail inquary_content_inner_student_information_detail_enter">
                            <span class="inquary_content_inner_student_information_detail_enter_box">
                                <textarea id="student_information_contact_reason" name="reason" id="inquary_content_inner_student_information_enter_text" class="inquary_content_inner_student_information_detail_enter_text" cols="40" rows="10" aria-invalid="false" placeholder="個人情報に関するお問い合わせ理由をご記入ください。"></textarea>
                            </span>
                        </dd>
                    </dl>
                    <input type="submit" value="この内容で送信する" class="inquary_content_inner_submit_button">
                </form>
                <!-- その他 -->
                <form id="hidden3" class="radio_box" method="POST" action="">
                    <input type="hidden" name="form_id" value="other">
                    <dl class="inquary_content_inner_message_detail">
                        <dt class="inquary_content_inner_message_detail_title">お問い合わせ詳細</dt>
                        <dd class="detail inquary_content_inner_message_detail_enter">
                            <span class="inquary_content_inner_message_detail_enter_box">
                                <textarea id="other_contact_detail" name="detail" id="inquary_content_inner_message_enter_text" class="inquary_content_inner_message_detail_enter_text" cols="40" rows="10" aria-invalid="false" placeholder="お問い合わせの内容をご記入ください。"></textarea>
                            </span>
                        </dd>
                    </dl>
                    <input type="submit" value="この内容で送信する" class="inquary_content_inner_submit_button">
                </form>
                <p>This site is protected by CAPTCHA and <a class="privacy_policy" href="https://policies.google.com/terms?hl=ja">the Google Privacy Policy</a> and Terms of Service apply.</p>
                <p>＊3営業日以内に返信いたします。</p>
            </div>
        </div>
    </main>
</div>

<?php include dirname(__FILE__) . '/footer.php' ?>
