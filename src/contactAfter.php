<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

use cruds\User;

$user_cruds = new User($db);

include dirname(__FILE__) . "/header.php";
?>

<main class="inquary_content">
                <form class="inquary_content_inner">
                    <div class="inquary_content_innerFrame">
                        <dl class="inquary_content_inner_name">
                            <dt class="inquary_content_inner_name_title">お名前 ※
                                                  </dt>
                            <dd class="inquary_contet_inner_name_enter">
                                <span class="inquary_content_inner_name_enter_box">
                                              布施陸斗
                                                </span>
                            </dd>
                        </dl>
                        <dl class="inquary_content_inner_mail">
                            <dt class="inquary_content_inner_mail_title">Email ※
                                                              </dt>
                            <dd class="inquary_contet_inner_mail_enter">
                                <span class="inquary_content_inner_mail_enter_box">
                                                kdjfkdkj.icloud.com
                                                  </span>
                            </dd>
                        </dl>
                        <dl class="inquary_content_inner_phone">
                            <dt class="inquary_content_inner_phone_title">電話番号 ※
                                                              </dt>
                            <dd class="inquary_contet_inner_phone_enter">
                                <span class="inquary_content_inner_phopne_enter_box">
                                                  080-####-####
                                                  </span>
                            </dd>
                        </dl>
                        <dl class="inquary_content_inner_college">
                            <dt class="inquary_content_inner_college_title">大学名
                                                                          </dt>
                            <dd class="inquary_contet_inner_college_enter">
                                <span class="inquary_content_inner_college_enter_box">
                                                 ##大学
                                                </span>
                            </dd>
                        </dl>
                        <dl class="inquary_content_inner_faculty">
                            <dt class="inquary_content_inner_faculty_title">学部・学科
                                                                                      </dt>
                            <dd class="inquary_contet_inner_faculty_enter">
                                <span class="inquary_content_inner_faculty_enter_box">
                                                 ##学部＃＃学科
                                                </span>
                            </dd>
                        </dl>
                        <dl class="inquary_content_inner_graduation">
                            <dt class="inquary_content_inner_graduation_title">卒業予定日
                                            </dt>
                            <dd class="inquary_contet_inner_graduation_enter">
                                <span class="inquary_content_inner_mail_enter_box">
                                                 24卒予定
                                                    
                                                  </span>
                            </dd>
                        </dl>
                        <dl class="inquary_content_inner_message">
                            <dt class="inquary_content_inner_message_title">メッセージ                                                                                        </dt>
                            <dd class="inquary_contet_inner_message_enter">
                                <span class="inquary_content_inner_message_enter_box">
                                           ###################
                                                   
                                                  </span>
                            </dd>
                        </dl>



                        <p class="inquary_content_inner_submit">
                            <a href="https://spectron.tech/jp/" class="inquary_content_inner_submit_button">内容送信</a>
                        </p>
                    </div>
                </form>
            </main>

<?php include dirname(__FILE__) . '/footer.php' ?>