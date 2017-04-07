<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<header class="section01_header hidden lg_show">
	<h1>JOIN</h1>
</header>
<div id="join">
	<header>
		<h1>JOIN</h1>
		<!-- <p>
			고릴라 스마트웨이 회원가입을 환영합니다. <br />
			회원등록하시면 고릴라 스마트웨이가 제공하는 다양한 회원혜택을 받으실 수 있습니다.
		</p> -->
	</header>
	<div class="wrap" id="join_result">
		<i></i>
		<p>注册成功!</p>
		<a href="<?php echo G5_URL; ?>" class="lg_btn01">HOME</a>
	</div>
</div>
<!-- } 회원가입결과 끝 -->