<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<header class="section01_header hidden lg_show">
	<h1>查找用户名/密码</h1>
</header>
<div class="member_section" id="lost">
	<header>
		<h1>查找用户名/密码</h1>
		<p>忘记用户名/密码？<br />通过注册时登记的会员信息，帮您找回用户名/密码。</p>
	</header>
	<div>
		<div class="id">
			<h3>查找用户名</h3>
			<p>请输入注册时输入的手机号码。</p>
			<div>
				<form name="fidlost" action="<?php echo $action_url2 ?>" onsubmit="return fidlost_submit(this);" method="post" autocomplete="off">
					<label for="mb_1" class="input02 grid_100 select01"<?php echo $member['mb_1']?" style='color:#000;'":""; ?>>
						<div><?php echo $member['mb_1']?"+".$member['mb_1']:"国家代码"; ?><span></span></div>
						<select name="mb_1" id="mb_1" class="input02 grid_100 light_gray" required>
							<option value="">国家代码</option>
							<option value="86" <?php echo $member['mb_1']=="86"?"selected":""; ?>>中国</option>
							<option value="852" <?php echo $member['mb_1']=="86"?"selected":""; ?>>香港</option>
							<option value="82" <?php echo $member['mb_1']=="86"?"selected":""; ?>>韩国</option>
						</select>
					</label>
					<input type="tel" name="mb_hp" value="<?php echo $member['mb_hp'] ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="input02 grid_100" minlength="10" maxlength="20" placeholder="手机" />
					<input type="submit" value="确认" class="btn01" />
				</form>
			</div>
		</div>
		<div class="pw">
			<h3>查找密码</h3>
			<p>请输入注册时输入的邮件地址<br />验证邮件发送到该邮件地址。</p>
			<div>
				<form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
					<input type="text" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="input02 grid_100" size="70" maxlength="100" placeholder="电子邮件">
					<input type="submit" value="确认" class="btn01" />
				</form>
			</div>
		</div>
	</div>
</div>

<script>
function fpasswordlost_submit(f){
    return true;
}
function fidlost_submit(f){
	$.post(g5_bbs_url+"/ajax.find_mb_id.php",{"mb_hp":f.mb_hp.value,"mb_1":f.mb_1.value},function(data){
		if(data==1){
			alert("请输入手机号码。");
			return;
		}else if(data==2){
			alert("请再次确认号码。");
			return;
		}else if(data==3){
			alert("没有此手机号码会员。");
			return;
		}
		$(".msg").html(data);
		msg_active();
	});
	return false;
}
$(function() {
    var sw = screen.width;
    var sh = screen.height;
    var cw = document.body.clientWidth;
    var ch = document.body.clientHeight;
    var top  = sh / 2 - ch / 2 - 100;
    var left = sw / 2 - cw / 2;
    moveTo(left, top);
});
</script>
<!-- } 회원정보 찾기 끝 -->