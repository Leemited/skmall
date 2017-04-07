<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
$lan=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);


$sql = "select * from `gsw_code`";
$row = mysql_query($sql);
while($data=sql_fetch_array($row)){
	$list.=$data.",";
}
?>
<?php if(!$is_member){ ?>
<header class="section01_header hidden lg_show">
	<h1>JOIN</h1>
</header>
<div id="join">
	<header>
		<h1>JOIN</h1>
		<p>
			欢迎您注册为大猩猩Smartway会员。<br />
			成为会员可享受大猩猩Smartway提供的各种会员优惠。<br />
			注册会员需要会员代码，如果没有会员代码，请通过微信咨询。<br /><br /> <img src="../img/menu_wechat_icon.png" alt="" />
		</p>
	</header>
	<div class="wrap write01">
<?php }else{ ?>
<header class="section01_header">
	<h1>MY PAGE</h1>
	<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>">MY PAGE</a> &gt; <a href="<?php echo G5_URL."/register_form.php?w=u"; ?>">编辑信息</a></p>
</header>
<section class="section01">
	<nav class="section01_nav">
		<ul class="list3">
			<li class="active"><a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>">编辑信息</a></li>
			<li><a href="<?php echo G5_URL."/page/mypage/buy_list.php"; ?>">购买列表</a></li>
			<li><a href="<?php echo G5_URL."/page/mypage/refund_list.php"; ?>">退款上市</a></li>
		</ul>
	</nav>
	<div id="join">
		<div class="wrap write01 section01_con">
<?php } ?>
		<div>
			<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
			<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
			<script src="<?php echo G5_JS_URL ?>/certify.js"></script>
			<?php } ?>
			<form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="w" value="<?php echo $w ?>">
				<input type="hidden" name="url" value="<?php echo $urlencode ?>">
				<input type="hidden" name="agree" value="<?php echo $agree ?>">
				<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
				<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
				<input type="hidden" name="cert_no" value="">
				<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
				<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
				<input type="hidden" name="mb_nick_default" value="<?php echo $member['mb_nick'] ?>">
				<input type="hidden" name="mb_nick" value="<?php echo $member['mb_nick'] ?>">
				<?php }  ?>
				<ul>
					<li>
						<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="input01 grid_100" minlength="3" maxlength="20" placeholder="ID" />
						<p class="violet">请输入三个字符以上的账号ID(只能输入英文字母、数字)</p>
					</li>
					<li>
						<input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="input01 grid_100" minlength="6" maxlength="20" placeholder="密码" />
						<p class="violet">6~12个英文字母和数字组合</p>
					</li>
					<li>
						<input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="input01 grid_100" minlength="6" maxlength="20" placeholder="确认密码" />
					</li>
				</ul>
				<ul>
					<li>
						<input type="text" id="reg_mb_name" name="mb_name" value="<?php echo $member['mb_name'] ?>" <?php echo $required ?> <?php echo $readonly; ?> class="input01 grid_100" size="10" placeholder="姓名" />
					</li>
					<li>
						<input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
						<input type="text" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="input01 grid_100" size="70" maxlength="100" placeholder="邮件">
					</li>
					<li>
						<div class="grid_40">
							<label for="mb_1" class="input01 grid_100 select01"<?php echo $member['mb_1']?" style='color:#000;'":""; ?>>
								<div><?php echo $member['mb_1']?"+".$member['mb_1']:"国家代码"; ?><span></span></div>
								<select name="mb_1" id="mb_1" class="input01 grid_100 light_gray" required>
									<option value="">国家代码</option>
									<option value="86" data-label="+86" <?php echo $member['mb_1']=="86"?"selected":""; ?>>中国</option>
									<option value="852" data-label="+852" <?php echo $member['mb_1']=="852"?"selected":""; ?>>香港</option>
									<option value="82" data-label="+82" <?php echo $member['mb_1']=="86"?"selected":""; ?>>韩国</option>
								</select>
							</label>
						</div>
						<div class="grid_60">
							<input type="tel" name="mb_hp" value="<?php echo $member['mb_hp'] ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="input01 grid_100" maxlength="20" placeholder="电话号码" />
						</div>
					</li>
					<li>
						<div class="grid_40"><input type="text" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="reg_mb_zip" <?php echo $config['cf_req_addr']?"required":""; ?> class="input01 grid_100" size="5" maxlength="6" placeholder="邮政编码"></div>
						<div class="grid_60"><input type="text" name="mb_addr1" value="<?php echo $member['mb_addr1'] ?>" id="reg_mb_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="input01 grid_100" size="50" placeholder="地址"></div>
					</li>
					<li>
						<input type="text" name="mb_2" value="<?php echo $member['mb_2'] ?>" id="mb_2" class="input01 grid_100" placeholder="会员代码">
						<p class="violet">如果会员号码无效不可注册。<br/>如果没有会员代码，请通过微信咨询。</p>
					</li>
				</ul>
				<div class="agree">
					<?php if(!$is_member){ ?>
					<p>我同意<a href="<?php echo G5_URL."/page/guide/"; ?>">使用条款</a>&nbsp;<a href="<?php echo G5_URL."/page/guide/privacy.php"; ?>">和隐私政策</a>。</p>
					<div><label for="agree" class="check01_label"><input type="checkbox" name="agree" id="agree" class="check01" value="1" />同意条款<i></i></label></div>
					<?php } ?>
				</div>
				<input type="submit" value="<?php echo $w==''?'注册会员':'编辑信息'; ?>" class="lg_btn01 grid_100">
				<a href="javascript:member_leave('<?php echo G5_BBS_URL."/member_leave.php"; ?>');" class="lg_btn02 grid_100">注销会员</a>
			</form>
		</div>
	</div>
</div>
<?php if(!$is_member){ ?></section><?php } ?>
<script>
$(function() {
	$("#reg_zip_find").css("display", "inline-block");
	<?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
	// 아이핀인증
	$("#win_ipin_cert").click(function() {
		if(!cert_confirm())
			return false;

		var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
		certify_win_open('kcb-ipin', url);
		return;
	});
	<?php } ?>
	<?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
	// 휴대폰인증
	$("#win_hp_cert").click(function() {
		if(!cert_confirm())
			return false;
		<?php
		switch($config['cf_cert_hp']) {
			case 'kcb':
				$cert_url = G5_OKNAME_URL.'/hpcert1.php';
				$cert_type = 'kcb-hp';
				break;
			case 'kcp':
				$cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
				$cert_type = 'kcp-hp';
				break;
			case 'lg':
				$cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
				$cert_type = 'lg-hp';
				break;
			default:
				echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
				echo 'return false;';
				break;
		}
		?>
		certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
		return;
	});
	<?php } ?>
});

// submit 최종 폼체크
function fregisterform_submit(f){
	if (f.w.value == "") {
		if(!$("#agree").is(":checked")){
			alert("您同意我们的条款和隐私权政策的会员可以加入");
			return false;
		}
	}
	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			alert(msg);
			f.mb_id.select();
			return false;
		}
	}
	if (f.w.value == "") {
		var msg = reg_code_check();
		if (msg) {
			alert(msg);
			f.mb_2.select();
			return false;
		}
	}
	if (f.w.value == "") {
		if (f.mb_password.value.length < 3) {
			alert("密码3个字以上可以登入");
			f.mb_password.focus();
			return false;
		}
	}
	if (f.mb_password.value != f.mb_password_re.value) {
		alert("重新确认密码");
		f.mb_password_re.focus();
		return false;
	}
	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			alert("密码3个字以上可以登入");
			f.mb_password_re.focus();
			return false;
		}
	}
	// 이름 검사
	if (f.w.value=="") {
		if (f.mb_name.value.length < 1) {
			alert("이름을 입력하십시오.");
			f.mb_name.focus();
			return false;
		}
		/*
		var pattern = /([^가-힣\x20])/i;
		if (pattern.test(f.mb_name.value)) {
			alert("이름은 한글로 입력하십시오.");
			f.mb_name.select();
			return false;
		}
		*/
	}

	<?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
	// 본인확인 체크
	if(f.cert_no.value=="") {
		alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
		return false;
	}
	<?php } ?>
	// E-mail 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.reg_mb_email.select();
			return false;
		}
	}
	<?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
	// 휴대폰번호 체크
	var msg = reg_mb_hp_check();
	if (msg) {
		alert(msg);
		f.reg_mb_hp.select();
		return false;
	}
	<?php } ?>
	if (typeof f.mb_icon != "undefined") {
		if (f.mb_icon.value) {
			if (!f.mb_icon.value.toLowerCase().match(/.(gif)$/i)) {
				alert("회원아이콘이 gif 파일이 아닙니다.");
				f.mb_icon.focus();
				return false;
			}
		}
	}
	if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
		if (f.mb_id.value == f.mb_recommend.value) {
			alert("본인을 추천할 수 없습니다.");
			f.mb_recommend.focus();
			return false;
		}
		var msg = reg_mb_recommend_check();
		if (msg) {
			alert(msg);
			f.mb_recommend.select();
			return false;
		}
	}
	document.getElementById("btn_submit").disabled = "disabled";
	return true;
}
function member_leave(url){
	if(confirm("请再确认退出?")){
		location.href=url;
	}else{
		return false;
	}
}
</script>
<!-- } 회원정보 입력/수정 끝 -->