<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

if ($is_member) {
    alert("이미 로그인중입니다.");
}

$g5['title'] = '아이디/비밀번호 찾기';
$sub_title=$g5['title'];
$bak_link=G5_BBS_URL."/login.php";
include_once(G5_PATH.'/head.php');

$action_url = G5_HTTPS_BBS_URL."/password_lost2.php";
include_once($member_skin_path.'/password_lost.skin.php');

include_once(G5_PATH.'/tail.php');
?>