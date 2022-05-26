<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;

$auth = new Agency($db);
$auth->validate();

include dirname(__FILE__) . '/header.php' ?>
<div>
    <div class="inquary_header_bg">
        <h2 class="inquary_header_title">お問合せはこちら</h2>
    </div>
    <p class="inquary_header_prompt">質問がございましたらお気軽に下記にお問合せください<br>（ご相談内容が複数ある場合は、別々でお送りください）</p>
    <main class="inquary_content">
        <form class="inquary_content_inner">
            <div class="inquary_content_innerFrame">
                <dl class="consul inquary_content_inner_consul">
                    <dt class="inquary_content_inner_consul_title">ご相談内容</dt>
                    <dd class="inquary_content_inner_consul_enter">
                        <input id="radio1" type="radio" name="choice" onclick="buttonClick()"/>
                        <label for="edit_change" class="radio_title">掲載情報変更</label>
                        <input id="radio2" type="radio" name="choice" onclick="buttonClick()"/>
                        <label for="student_information" class="radio_title">学生個人情報</label>
                        <input id="radio3" type="radio" name="choice" onclick="buttonClick()"/>
                        <label for="other" class="radio_title">その他</label>
                    </dd>
                </dl>
                <dl class="inquary_content_inner_name">
                    <dt class="inquary_content_inner_name_title">お名前 ※</dt>
                    <dd class="inquary_content_inner_name_enter">
                        <span class="inquary_content_inner_name_enter_box">
                            <input type="text" value size="40" class="inquary_content_inner_name_enter_text">
                        </span>
                    </dd>
                </dl>
                <dl class="inquary_content_inner_mail">
                    <dt class="inquary_content_inner_mail_title">Email ※</dt>
                    <dd class="inquary_content_inner_mail_enter">
                        <span class="inquary_content_inner_mail_enter_box">
                            <input type="text" value size="40" class="inquary_content_inner_mail_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字">
                        </span>
                    </dd>
                </dl>
                <dl class="inquary_content_inner_phone">
                    <dt class="inquary_content_inner_phone_title">電話番号 ※</dt>
                    <dd class="inquary_content_inner_phone_enter">
                        <span class="inquary_content_inner_phone_enter_box">
                            <input type="text" value size="40" class="inquary_content_inner_phone_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字">
                        </span>
                    </dd>
                </dl>
                <!-- 掲載情報変更 -->
                <div  id="hidden1" class="radio_box">
                    <dl class="inquary_content_inner_edit_change">
                        <dt class="inquary_content_inner_edit_change_title">タイトル</dt>
                        <dd class="edit_change inquary_content_inner_edit_change_enter">
                            <span class="inquary_content_inner_edit_change_enter_box">
                                <input id="txt1" type="text" value size="40" class="inquary_content_inner_edit_change_enter_text id">
                            </span>
                        </dd>
                    </dl>
                    <dl class="inquary_content_inner_edit_change_detail">
                        <dt class="inquary_content_inner_edit_change_detail_title">本文</dt>
                        <dd class="edit_change inquary_content_inner_edit_change_detail_enter">
                            <span class="inquary_content_inner_edit_change_detail_enter_box">
                                <textarea name="inquary_content_inner_edit_change_detail_enter_text" id="txt2" class="inquary_content_inner_edit_change_detail_enter_text" cols="40" rows="10" aria-invalid="false" placeholder="変更内容を含む全文を記入してください。" ></textarea>
                            </span>
                        </dd>
                    </dl>
                    <!-- クラス名そのまま -->
                    <dl class="inquary_content_inner_edit_change">
                        <dt class="inquary_content_inner_edit_change_title">アイキャッチ取得したい</dt>
                        <dd class="edit_change inquary_content_inner_icatch_enter">
                            <span class="inquary_content_inner_edit_change_enter_box">
                                <input id="txt3" type="text" value size="40" class="inquary_content_inner_edit_change_enter_text">
                            </span>
                        </dd>
                    </dl>
                </div>
                <!-- 学生個人情報 -->
                <div id="hidden2" class="radio_box">
                    <dl class="inquary_content_inner_student_information">
                        <dt class="inquary_content_inner_student_information_title">学生のお名前</dt>
                        <dd class="student inquary_content_inner_student_information_enter">
                            <span class="inquary_content_inner_student_information_enter_box">
                                <input id="txt4" type="text" value size="40" class="inquary_content_inner_student_information_enter_text">
                            </span>
                        </dd>
                    </dl>
                    <dl class="inquary_content_inner_student_information_mail">
                    <dt class="inquary_content_inner_student_information_mail_title">学生Email</dt>
                    <dd class="student inquary_content_inner_student_information_mail_enter">
                        <span class="inquary_content_inner_student_information_mail_enter_box">
                            <input id="txt5" type="text" value size="40" class="inquary_content_inner_student_information_mail_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字">
                        </span>
                    </dd>
                    </dl>
                    <dl class="inquary_content_inner_student_information_detail">
                        <dt class="inquary_content_inner_student_information_detail_title">お問い合わせ理由</dt>
                        <dd class="student_reason inquary_content_inner_student_information_detail_enter">
                            <span class="inquary_content_inner_student_information_detail_enter_box">
                                <textarea id="txt6" name="inquary_content_inner_student_information_detail_enter_text" id="inquary_content_inner_student_information_enter_text" class="inquary_content_inner_student_information_detail_enter_text" cols="40" rows="10" aria-invalid="false" placeholder="個人情報に関するお問い合わせ理由をご記入ください。" ></textarea>
                            </span>
                        </dd>
                    </dl>
                </div>
                <!-- その他 -->
                <div id="hidden3" class="radio_box">
                    <dl class="inquary_content_inner_message">
                        <dt class="inquary_content_inner_message_title">タイトル</dt>
                        <dd class="other_title inquary_content_inner_message_enter">
                            <span class="inquary_content_inner_message_enter_box">
                                <input id="txt7" type="text" value size="40" class="inquary_content_inner_message_enter_text">
                            </span>
                        </dd>
                    </dl>
                    <dl class="inquary_content_inner_message_detail">
                        <dt class="inquary_content_inner_message_detail_title">お問い合わせ詳細</dt>
                        <dd class="other_reason inquary_content_inner_message_detail_enter">
                            <span class="inquary_content_inner_message_detail_enter_box">
                                <textarea id="txt8" name="inquary_content_inner_message_detail_enter_text" id="inquary_content_inner_message_enter_text" class="inquary_content_inner_message_detail_enter_text" cols="40" rows="10" aria-invalid="false" placeholder="お問い合わせの内容をご記入ください。" ></textarea>
                            </span>
                        </dd>
                    </dl>
                </div>
                <p class="inquary_content_inner_submit">
                    <a href="contactConfirm.php" class="inquary_content_inner_submit_button">この内容で送信する</a>
                </p>
                <p>This site is protected by CAPTCHA and <a class="privacy_policy" href="https://policies.google.com/terms?hl=ja">the Google Privacy Policy</a> and Terms of Service apply.</p>
                <p>＊3営業日以内に返信いたします。</p>
            </div>
        </form>
    </main>
</div>

<?php include dirname(__FILE__) . '/footer.php' ?>
