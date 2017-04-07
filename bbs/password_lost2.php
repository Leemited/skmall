<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

if ($is_member) {
    alert('已登录。');
}
$email = trim($_POST['mb_email']);

if (!$email)
    alert_close('邮件地址错误。');

$sql = " select count(*) as cnt from {$g5['member_table']} where mb_email = '$email' ";
$row = sql_fetch($sql);
if ($row['cnt'] > 1)
    alert('存在两个以上相同的邮件地址。\\n\\n请咨询管理员。');

$sql = " select mb_no, mb_id, mb_name, mb_nick, mb_email, mb_datetime from {$g5['member_table']} where mb_email = '$email' ";
$mb = sql_fetch($sql);
if (!$mb['mb_id'])
    alert('没有该会员。');
else if (is_admin($mb['mb_id']))
    alert('管理员用户名无法访问。');

// 임시비밀번호 발급
$change_password = rand(100000, 999999);
$mb_lost_certify = get_encrypt_string($change_password);

// 어떠한 회원정보도 포함되지 않은 일회용 난수를 생성하여 인증에 사용
$mb_nonce = md5(pack('V*', rand(), rand(), rand(), rand()));

// 임시비밀번호와 난수를 mb_lost_certify 필드에 저장
$sql = " update {$g5['member_table']} set mb_lost_certify = '$mb_nonce $mb_lost_certify' where mb_id = '{$mb['mb_id']}' ";
sql_query($sql);

// 인증 링크 생성
$href = G5_BBS_URL.'/password_lost_certify.php?mb_no='.$mb['mb_no'].'&amp;mb_nonce='.$mb_nonce;

$subject = "[GORILLASMARTWAY] 您申请的查找会员信息邮件指南。";

$content = "";

$content .= '<div style="margin:30px auto;width:600px;border:10px solid #f7f7f7">';
$content .= '<div style="border:1px solid #dedede">';
$content .= '<h1 style="padding:30px 30px 0;background:#f7f7f7;color:#555;font-size:1.4em">';
$content .= '查找会员信息指南';
$content .= '</h1>';
$content .= '<span style="display:block;padding:10px 30px 30px;background:#f7f7f7;text-align:right">';
$content .= '<a href="'.G5_URL.'" target="_blank">GORILLASMARTWAY</a>';
$content .= '</span>';
$content .= '<p style="margin:20px 0 0;padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em">';
$content .= addslashes($mb['mb_name'])." (".addslashes($mb['mb_nick']).")"." 您在 ".G5_TIME_YMDHIS." 申请查找会员信息。<br>";
$content .= '我们网站的管理人员也不会知道会员密码。因此，我们会创建新密码并告诉您。<br>';
$content .= '请确认下面修改的密码，然后点击<span style="color:#ff3061"><strong>更改密码</strong></span> 链接。修改密码<br>';
$content .= '出现修改密码认证消息后，请回到主页输入用户名和修改的密码进行登录。<br>';
$content .= '登录后在修改信息菜单中修改新密码。';
$content .= '</p>';
$content .= '<p style="margin:0;padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em">';
$content .= '<span style="display:inline-block;width:100px">用户名</span> '.$mb['mb_id'].'<br>';
$content .= '<span style="display:inline-block;width:100px">修改的密码</span> <strong style="color:#ff3061">'.$change_password.'</strong>';
$content .= '</p>';
$content .= '<a href="'.$href.'" target="_blank" style="display:block;padding:30px 0;background:#484848;color:#fff;text-decoration:none;text-align:center">修改密码</a>';
$content .= '</div>';
$content .= '</div>';

mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $mb['mb_email'], $subject, $content, 1);

alert_close($email.' 发送认证用户名和密码的邮件。\\n\\n请确认邮件。');
?>
