<?php
	include_once('./_common.php');
	include_once(G5_LIB_PATH.'/register.lib.php');
	$mb_hp=trim($_POST['mb_hp']);
	$mb_1=trim($_POST['mb_1']);
	$phone_len= strlen($mb_hp);
	if(!$mb_hp){
		echo 1;
		return;
	}
	if($phone_len!=10 && $phone_len!=11){
		echo 2;
		return;
	}
	$phone = hyphen_hp_number($mb_hp);
	$mb=sql_fetch("select * from `g5_member` where (`mb_hp`='{$phone}' or `mb_hp`='{$mb_hp}') and `mb_1`='{$mb_1}';");
	if(!$mb['mb_id']){
		echo 3;
		return;
	}
?>
<div class="msg-radius">
	<i class="left top"></i>
	<i class="right top"></i>
	<i class="left bottom"></i>
	<i class="right bottom"></i>
	<div class="msg_wrap text-center">
		<h1 class="msg_head">查找用户名</h1>
		您的用户名是 '<?php echo substr_replace ($mb['mb_id'], '***', 2, 3); ?>'。 <br />
		如果想知道全部用户名，请联系管理员。
		<div class="msg_btn">
			<a href="javascript:msg_close();" class="btn01">확인</a>
		</div>
	</div>
</div>
