<?php
include_once('./_common.php');

$g5['title'] = "로그인 검사";

$mb_id       = trim($_POST['mb_id']);
$mb_password = trim($_POST['mb_password']);

if (!$mb_id || !$mb_password)
    alert('회원아이디나 비밀번호가 공백이면 안됩니다.');

$mb = get_member($mb_id);

// 가입된 회원이 아니다. 비밀번호가 틀리다. 라는 메세지를 따로 보여주지 않는 이유는
// 회원아이디를 입력해 보고 맞으면 또 비밀번호를 입력해보는 경우를 방지하기 위해서입니다.
// 불법사용자의 경우 회원아이디가 틀린지, 비밀번호가 틀린지를 알기까지는 많은 시간이 소요되기 때문입니다.
if (!$mb['mb_id'] || !check_password($mb_password, $mb['mb_password'])) {
    alert('가입된 회원아이디가 아니거나 비밀번호가 틀립니다.\\n비밀번호는 대소문자를 구분합니다.');
}

// 차단된 아이디인가?
if ($mb['mb_intercept_date'] && $mb['mb_intercept_date'] <= date("Ymd", G5_SERVER_TIME)) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_intercept_date']);
    alert('회원님의 아이디는 접근이 금지되어 있습니다.\n처리일 : '.$date);
}

// 탈퇴한 아이디인가?
if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
    alert('탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date);
}

if ($config['cf_use_email_certify'] && !preg_match("/[1-9]/", $mb['mb_email_certify'])) {
    confirm("{$mb['mb_email']} 메일로 메일인증을 받으셔야 로그인 가능합니다. 다른 메일주소로 변경하여 인증하시려면 취소를 클릭하시기 바랍니다.", G5_URL, G5_BBS_URL.'/register_email.php?mb_id='.$mb_id);
}

@include_once($member_skin_path.'/login_check.skin.php');

// 회원아이디 세션 생성
set_session('ss_mb_id', $mb['mb_id']);
// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

// 포인트 체크
if($config['cf_use_point']) {
    $sum_point = get_point_sum($mb['mb_id']);

    $sql= " update {$g5['member_table']} set mb_point = '$sum_point' where mb_id = '{$mb['mb_id']}' ";
    sql_query($sql);
}

// 3.26
// 아이디 쿠키에 한달간 저장
if ($auto_login) {
    // 3.27
    // 자동로그인 ---------------------------
    // 쿠키 한달간 저장
    $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
    set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31);
    set_cookie('ck_auto', $key, 86400 * 31);
    // 자동로그인 end ---------------------------
} else {
    set_cookie('ck_mb_id', '', 0);
    set_cookie('ck_auto', '', 0);
}

if ($url) {
    // url 체크
    check_url_host($url);

    $link = urldecode($url);
    // 2003-06-14 추가 (다른 변수들을 넘겨주기 위함)
    if (preg_match("/\?/", $link))
        $split= "&amp;";
    else
        $split= "?";

    // $_POST 배열변수에서 아래의 이름을 가지지 않은 것만 넘김
    foreach($_POST as $key=>$value) {
        if ($key != 'mb_id' && $key != 'mb_password' && $key != 'x' && $key != 'y' && $key != 'url') {
            $link .= "$split$key=$value";
            $split = "&amp;";
        }
    }
} else  {
    $link = G5_URL;
}
$query=sql_query("select * from `gsw_cart` where `mb_id`='{$mb['mb_id']}' and od_status='0'");
$i=0;
while($dataid=sql_fetch_array($query)){
	$cart_id_list[$i]=$dataid;
	$i++;
}
$cart_session=get_session("cart_session");
$date1=date("Y-m-d H:i:s",strtotime("-1 days"));
$query=sql_query("select * from `gsw_cart` where `mb_ip`='{$_SERVER['REMOTE_ADDR']}' and `mb_id`='' and `mb_session`='{$cart_session}' and `datetime`>'{$date1}' and od_status='0'");
$i=0;
while($dataip=sql_fetch_array($query)){
	$cart_ip_list[$i]=$dataip;
	$i++;
}
for($i=0;$i<count($cart_ip_list);$i++){
	$status=false;
	for($j=0;$j<count($cart_id_list);$j++){
		if($cart_ip_list[$i]['product_id']==$cart_id_list[$j]['product_id'])
			$status=true;
	}
	if($status){
		sql_query("update `gsw_cart` set `number`=`number`+'{$cart_ip_list[$i]['number']}',`datetime`='{$cart_ip_list[$i]['datetime']}' where `mb_id`='{$mb['mb_id']}' and `product_id`='{$cart_ip_list[$i]['product_id']}';");
		sql_query("delete from `gsw_cart` where `product_id`='{$cart_ip_list[$i]['product_id']}' and `mb_ip`='{$_SERVER['REMOTE_ADDR']}' and `mb_id`='';");
	}else{
		sql_query("update `gsw_cart` set `mb_id`='{$mb['mb_id']}' where `mb_ip`='{$_SERVER['REMOTE_ADDR']}' and `mb_id`='' and `datetime`>'{$date1}';");
	}
}
goto_url($link);
?>
