<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<header class="section01_header hidden lg_show">
	<h1>로그인</h1>
</header>
<div id="login">
	<div class="wrap write01">
		<header>
			<h1>로그인</h1>
		</header>
		<div>
			<form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
				<input type="hidden" name="url" value="<?php echo $login_url ?>">
				<input type="text" name="mb_id" id="login_id" required class="input01 grid_100" size="20" maxLength="20" placeholder="아이디">
				<input type="password" name="mb_password" id="login_pw" required class="input01 grid_100" size="20" maxLength="20" placeholder="비밀번호">
				<div class="chk_list01">
					<ul>
						<li><input type="checkbox" name="auto_login" id="login_auto_login" class="check01" /><label for="login_auto_login" class="check01_label">자동로그인<i></i></label></li>
						<!--<li><a href="<?php /*echo G5_BBS_URL */?>/password_lost.php">查找用户名密码<i></i></a></li>-->
					</ul>
				</div>
				<input type="submit" value="로그인" class="lg_btn01 grid_100">
			</form>
		</div>
	</div>
</div>

<script>
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    return true;
}
</script>
<!-- } 로그인 끝 -->