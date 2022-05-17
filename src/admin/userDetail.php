<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include dirname(__FILE__) . '/headerUserDetail.php';
?>

<main>
    <div class="content_wrapper">
        <ul>
            <li>氏名：加茂竜之介</li>
            <li>Email：kamo@gamil.com</li>
            <li>電話番号：090-3751-5188</li>
            <li>大学名：早稲田大学</li>
            <li>学科：教育学科</li>
            <li>卒業年：25年卒</li>
            <li>住所：東京都xx区xx-xx-xx</li>
         </ul>
         <div class="num_sent_infromation">企業に応募した件数：４件</div>

    </div>
</main>


<?php include dirname(__FILE__) . '/footerUserDetail.php' ?>