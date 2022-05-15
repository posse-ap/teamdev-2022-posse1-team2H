<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include dirname(__FILE__) . '/headerPostEditAgencyInfo.php';
?>

<main>
    <div id="displayed_content" class="displayed_content">○○○○株式会社の基本情報と掲載情報</div>
    <div class="agency_info_wrapper">
        <div class="agency_info_inner">
            <div class="editable_info">
                <div class="agency_info_type">エージェンシー編集可能情報</div>
                <ul>
                    <li>メールアドレス：</li>
                    <li>担当者：</li>
                </ul>
            </div>
            <div class="uneditable_info">
                <div class="agency_info_type">掲載されている情報</div>
                <div class="uneditable_info_content">
                    むかしむかし、あるところに、おじいさんとおばあさんが住んでいました。
                    　おじいさんは山へしばかりに、おばあさんは川へせんたくに行きました。
                    　おばあさんが川で洗濯をしていると、ドンブラコ、ドンブラコと、大きな桃が流れてきました。
                    「おや、これは良いおみやげになるわ」
                    　おばあさんは大きな桃をひろいあげて、家に持ち帰りました。
                    　そして、おじいさんとおばあさんが桃を食べようと桃を切ってみると、なんと、中から元気の良い男の赤ちゃんが飛び出してきました。
                    「これはきっと、神さまがくださったにちがいない」
                    　子どものいなかったおじいさんとおばあさんは、大喜びです。
                </div>
            </div>
        </div>
    </div>
</main>

<?php include dirname(__FILE__) . '/footerPostEditAgencyInfo.php' ?>