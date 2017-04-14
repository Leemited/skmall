<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
?>
<section class="section02 width-fixed">
    <header class="section02_header no-border-bottom" >
        <h1 >사이트맵</h1>
    </header>
    <article class="section01_con">
        <div class="wrap" id="sitemap">
            <div>
                <div class="title" onclick="location.href='<?=G5_URL?>/page/mall/list.php'">
                    SKT
                    <img src="<?=G5_IMG_URL?>/sitemap_icon_1.png" alt="">
                </div>
            </div>
            <div>
                <div class="title" onclick="location.href='<?=G5_BBS_URL?>/board.php?bo_table=inquiry'">
                    커뮤니티
                    <img src="<?=G5_IMG_URL?>/sitemap_icon_2.png" alt="">
                </div>
                <ul>
                    <li onclick="location.href='<?=G5_BBS_URL?>/board.php?bo_table=review'"><span class="red bold">·</span> 개통후기</li>
                    <li onclick="location.href='<?=G5_BBS_URL?>/board.php?bo_table=notice'"><span class="red bold">·</span> 공지사항</li>
                </ul>
            </div>
            <div class="last">
                <div class="title" onclick="location.href='<?=G5_BBS_URL?>/board.php?bo_table=inquiry'">
                    고객센터
                    <img src="<?=G5_IMG_URL?>/sitemap_icon_3.png" alt="">
                </div>
                <ul>
                    <li onclick="location.href='<?=G5_BBS_URL?>/board.php?bo_table=inquiry'"><span class="red bold">·</span> 상품문의</li>
                    <li onclick="location.href='<?=G5_BBS_URL?>/board.php?bo_table=callinfo'"><span class="red bold">·</span> 요금제안내</li>
                    <li onclick="location.href='<?=G5_BBS_URL?>/board.php?bo_table=qna'"><span class="red bold">·</span> 자주묻는질문</li>
                </ul>
            </div>
        </div>
    </article>
</section>
<?php
include_once(G5_PATH.'/tail.php');
?>
