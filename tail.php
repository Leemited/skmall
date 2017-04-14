<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 하단 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_tail'] && is_file(G5_PATH.'/'.$config['cf_include_tail'])) {
    include_once(G5_PATH.'/'.$config['cf_include_tail']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/tail.php');
    return;
}
?>
	</div>
</div>
<footer id="footer">
    <div class="footer_contact">
        <div class = "width-fixed">
            <img src="<?php echo G5_IMG_URL."/footer_contact.png"; ?>" alt="contact정보" class="footer-contact"/>
            <div class="footer_menu">
                <ul>
                    <li onclick="location.href='#'">법인폰 신청</li>
                    <li onclick="location.href='#'">SKT SHOP 주문쉽게 따라하기</li>
                    <li onclick="location.href='#'" class="last"><img src="<?php echo G5_IMG_URL;?>/footer_call_btn.png" alt=""></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="guide">
        <div class="width-fixed">
            <ul>
                <li><a href="<?php echo G5_URL;?>/page/guide/privacy.php" rel="modal:open" >개인정보처리방침</a></li>
                <li><a href="<?php echo G5_URL;?>/page/guide/index.php" rel="modal:open" >이용약관</a></li>
                <li><a href="<?php echo G5_URL;?>/page/guide/email.php" rel="modal:open" >이메일정보수집거부</a></li>
                <li><a href="<?php echo G5_URL;?>/page/guide/userguide.php" rel="modal:open" >이용안내</a></li>
                <li class="last"><a href="<?php echo G5_URL;?>/page/guide/sitemap.php">사이트맵</a></li>
            </ul>
        </div>
    </div>
    <div class="copyright">
        <div class="width-fixed">(주)에스케이유&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;통신판매업 신고번호:제2016-복구-481호&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;사업자등록번호:409-86-47924&nbsp;<br>
            TEL : 1566-3521&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;개인정보 관리 책임자: 황승주
            <p>COPYRIGHTⓒ 2017 <span>sktshop.kr</span>&nbsp;&nbsp;All RIGHTS RESERVED.</p>
        </div>
    </div>
</footer>
    <script>
        $(document).ready(function(){
            $(".community").mouseover(function(){
                $(".sub_menu_bg").css("display","block");
            })
            $(".menu1, .community").mouseout(function(){
                $(".sub_menu_bg").css("display","none");
            })
        })
    </script>
<?php
if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->
<?php
include_once(G5_PATH."/tail.sub.php");
?>