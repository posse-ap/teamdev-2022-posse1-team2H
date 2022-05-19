<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
use modules\auth\Agency;

$auth = new Agency($db);
$auth->validate();

include dirname(__FILE__) . '/header.php' ?>
<div>
    <div>
        <div class="inquary_header_bg">
            <h2 class="inquary_header_title">お問合せはこちら</h2>
        </div>
        <p class="inquary_header_prompt">質問がございましたらお気軽に下記にお問合せください</p>
        <main class="inquary_content">
            <form class="inquary_content_inner">
                <div class="inquary_content_innerFrame">
                    <dl class="inquary_content_inner_consul">
                            <dt class="inquary_content_inner_consul_title">ご相談内容</dt>
                            <dd class="inquary_contet_inner_consul_enter">
                                <span class="checkbox">
                                    <input type="checkbox" value="掲載情報変更">
                                    <label for="" class="checkbox_title">掲載情報変更</label>
                                </span>
                                <span class="checkbox">
                                    <input type="checkbox" value="学生個人情報">
                                    <label for="" class="checkbox_title">学生個人情報</label>
                                </span>
                                <span class="checkbox">
                                    <input type="checkbox" value="その他">
                                    <label for="" class="checkbox_title"></label>その他
                                </span>
                            </dd>
                    </dl>
                    <dl class="inquary_content_inner_name">
                        <dt class="inquary_content_inner_name_title">お名前 ※</dt>
                        <dd class="inquary_contet_inner_name_enter">
                            <span class="inquary_content_inner_name_enter_box">
                                <input type="text" value size="40" class="inquary_content_inner_name_enter_text">
                            </span>
                        </dd>
                    </dl>
                    <dl class="inquary_content_inner_mail">
                        <dt class="inquary_content_inner_mail_title">Email ※</dt>
                        <dd class="inquary_contet_inner_mail_enter">
                            <span class="inquary_content_inner_mail_enter_box">
                                <input type="text" value size="40" class="inquary_content_inner_mail_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字">
                            </span>
                        </dd>
                    </dl>
                    <dl class="inquary_content_inner_phone">
                        <dt class="inquary_content_inner_phone_title">電話番号 ※</dt>
                        <dd class="inquary_contet_inner_phone_enter">
                            <span class="inquary_content_inner_phopne_enter_box">
                                <input type="text" value size="40" class="inquary_content_inner_phone_enter_text" aria-required="true" aria-invalid="false" placeholder="※半角数字">
                            </span>
                        </dd>
                    </dl>
                    <dl class="inquary_content_inner_message">
                        <dt class="inquary_content_inner_message_title">タイトル</dt>
                        <dd class="inquary_contet_inner_message_enter">
                            <span class="inquary_content_inner_message_enter_box">
                                <input type="text" value size="40" class="inquary_content_inner_message_enter_text">
                            </span>
                        </dd>
                    </dl>
                    <dl class="inquary_content_inner_message_detail">
                        <dt class="inquary_content_inner_message_detail_title">お問い合わせ詳細</dt>
                        <dd class="inquary_contet_inner_message_detail_enter">
                            <span class="inquary_content_inner_message_detail_enter_box">
                                <textarea name="inquary_content_inner_message_detail_enter_text" id="inquary_content_inner_message_enter_text" class="inquary_content_inner_message_detail_enter_text" cols="40" rows="10" aria-invalid="false" placeholder="お問い合わせの内容をご記入ください。" ></textarea>
                            </span>
                        </dd>
                    </dl>
                    <!-- <dl class="inquary_contet_inner_confirmation">
                        <dd class="inquary_contet_inner_confirmation_check">
                            <span inquary_content_inner_confirmaiton_inner_check_box>
                                <input type="checkbox" class="inquary_content_inner_confirmation_inner_checkBox" value="プライバシーポリシーに同意します">
                                <span class="inquary_content_inner_confirmation_inner_label">
                                  プライバシーポリシーに同意します
                                </span>
                            </span>
                        </dd>
                        <dd class="inquary_content_inner_cofirmation_policy">
                            <span class="inquary_content_inner_confirmation_policy_text">
                                <p>
                                    &rarr;
                                    <a href="https://spectron.tech/jp/" class="PRIVACY">PRIVACY POLICY</a>
                                </p>
                            </span>
                        </dd>
                    </dl> -->
                    <p class="inquary_content_inner_submit">
                        <a href="https://spectron.tech/jp/" class="inquary_content_inner_submit_button">この内容で送信する</a>
                    </p>
                    <p>This site is protected by CAPTCHA and the Google Privacy Policy and Terms of Service apply.</p>
                    <p>＊3営業日以内に返信いたします。</p>
                </div>
            </form>
        </main>
    </div>
</div>

<?php include dirname(__FILE__) . '/footer.php' ?>
