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
<div class = "width-fixed"></div>
	<div class="gsw_wechat">
		<img src="<?php echo G5_IMG_URL."/footer_gsw_wechat.png"; ?>" alt="WECHAT GSW 공식계정 QR코드" />	
	</div>	
	
	<!-- <div class="sitemap">
		<div class="width-fixed">
			<div class="menu1">
				<h3><a href="<?php echo G5_URL."/page/company"; ?>">COMPANY</a></h3>
				<ul>
					<li><a href="<?php echo G5_URL."/page/company"; ?>">关于公司</a></li>
					<li><a href="<?php echo G5_URL."/page/company/business.php"; ?>">关于事业</a></li>
				</ul>
			</div>
			<div class="menu2">
				
				<h3><a href="<?php echo G5_URL; ?>">ACADEMY</a></h3>
				<ul>
					<li><a href="<?php echo G5_URL."/page/academy"; ?>">学院介绍</a></li>
					<li><a href="<?php echo G5_URL."/page/academy/schedule.php"; ?>">学院日程</a></li>
					<li><a href="<?php echo G5_URL."/page/academy/application.php"; ?>">接收在线申请</a></li>
				</ul>
			</div>
			<div class="menu3">
				<h3><a href="<?php echo G5_URL; ?>">MALL</a></h3>
				<ul>
					<?php for($i=0;$i<count($cate);$i++){ ?>
					<li><a href="<?php echo G5_URL."/page/mall/list.php?category=".urlencode($cate[$i]['cate']); ?>"><?php echo $cate[$i]['cate'];?></a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="menu4">
				<h3><a href="<?php echo G5_URL; ?>">CONCIERGE</a></h3>
				<ul>
					<li><a href="<?php echo G5_URL."/page/concierge"; ?>">关于礼宾医疗</a></li>
					<li><a href="<?php echo G5_URL."/page/concierge/skin.php"; ?>">皮肤治疗介绍</a></li>
					<li><a href="<?php echo G5_URL."/page/concierge/plastic.php"; ?>">整容手术介绍</a></li>
				</ul>
			</div>
			<div class="menu5">
				<h3><a href="<?php echo G5_URL; ?>">ALLIANCE</a></h3>
				<ul>
					<li><a href="http://www.youelle.co.kr/" target="_blank">延世YOUELLE皮肤科</a></li>
					<li><a href="http://www.kaasm.co.kr/" target="_blank">大韩美容学会</a></li>
					<li><a href="http://www.ctc.ac.kr/" target="_blank">济州观光大学</a></li>
				</ul>
			</div>
			<div class="last menu6">
				<h3><a href="<?php echo G5_URL; ?>">CONTACT</a></h3>
				<ul>
					<li><a href="<?php echo G5_URL."/page/contact"; ?>">CONTACT</a></li>
					<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=qna"; ?>">Q&amp;A</a></li>
				</ul>
			</div>
		</div>
	</div> -->
	<div class="guide">
		<div class="width-fixed">
			<ul>
				<li><a href="<?php echo G5_URL."/page/guide/privacy.php"; ?>">隐私政策</a></li>
				<li><a href="<?php echo G5_URL."/page/guide"; ?>">使用条款</a></li>
				<li class="last"><a href="<?php echo G5_URL."/page/contact"; ?>">CONTACT</a></li>
			</ul>
		</div>
	</div>
	<div class="chat">
		<div class="width-fixed">
			<ul>
				<li class="kakao"><i></i><span></span></li>
				<li class="last wechat"><i></i><span></span></li>
			</ul>
		</div>
	</div>
	<div class="copyright">
		<div class="width-fixed">
			GORLLA SMARTWAY&nbsp;&nbsp;&nbsp;/   CEO : Kim Hyun-jung&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;済州特別自治道 済州市 三徒二洞 365別館 4F<br />
			TEL : 070-7008-7833 , 010-7277-7833&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;E-mail : info@gsmartway.com
			<p>COPYRIGHTⓒ 2016 <span>GORLLA SMARTWAY</span>&nbsp;&nbsp;All RIGHTS RESERVED.</p>
		</div>
	</div>
</footer>

<?php
if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->
<?php
include_once(G5_PATH."/tail.sub.php");
?>