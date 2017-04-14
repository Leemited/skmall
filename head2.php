<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 상단 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_head'] && is_file(G5_PATH.'/'.$config['cf_include_head'])) {
    include_once(G5_PATH.'/'.$config['cf_include_head']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/head.php');
    return;
}
$cate=array();
$sql="select * from `gsw_category` as c order by `od` asc";
$query=sql_query($sql);
while($data=sql_fetch_array($query)){
    $cate[]=$data;
}
$code_admin=sql_fetch("select * from `gsw_code` where mb_id='".$member['mb_id']."'");
?>
<header id="header">
    <div class="top" style="height:auto">
        <div class="width-fixed">
            <h1 class="logo" style="text-align: center;margin:10px auto 10px auto"><a href="<?php /*echo G5_URL; */?>"><i></i></a></h1>
        </div>
    </div>
</header>
<div class="msg"></div>
<div id="mobile_header">
    <h1><a href="<?php echo G5_URL; ?>"><i></i></a></h1>
</div>
<div class="container">
    <div class="<?php echo $main?"main":"sub"; ?>">