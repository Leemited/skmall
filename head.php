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

if($g5['lo_url'] != "/bbs/login.php" && $member['mb_id']==""){
    goto_url(G5_BBS_URL."/login.php");
}

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
	<div class="top <?php echo $main?"":submenu; ?>">
        <div class="mb_menu">
            <div class="width-fixed">
                <ul>
                    <?php if($is_admin){ ?>
                        <li><a href="<?php echo G5_URL."/admin/"; ?>">관리자</a></li>
                        <li><a href="<?php echo G5_URL."/bbs/logout.php"; ?>">관리자로그아웃</a></li>
                    <?php } else {?>
                        <li><a href="<?php echo G5_URL."/bbs/login.php"; ?>">관리자로그인</a></li>
                        <li><a href="<?php echo G5_URL."/bbs/logout.php"; ?>">고객사로그아웃</a></li>
                    <?php } ?>
                    <li class="last"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=notice"; ?>">공지사항</a></li>
                </ul>
            </div>
        </div>
		<div class="width-fixed">
			<h1 class="logo"><a href="<?php echo G5_URL; ?>"><i></i></a></h1>
            <div class="menu">
                <ul class="menuUl" style="padding-right:0;">
                    <li class="depth img" onclick="location.href='<?php echo G5_URL."/page/mall/list.php"; ?>'">
                        <!--<a href="<?php /*echo G5_URL."/page/company"; */?>" class="top"><img src="<?php /*echo G5_IMG_URL; */?>/menu1_img.png" alt="메뉴"></a>-->
                    </li>
                    <li class="depth community">
                        <a href="<?php echo G5_URL."/bbs/board.php?bo_table=review"; ?>" class="top">커뮤니티</a>
                        <ul class="menu1">
                            <li class="menu1_title"><h2>커뮤니티</h2></li>
                            <li onclick="location.href='<?php echo G5_BBS_URL;?>/board.php?bo_table=review';">개통후기</li>
                            <li onclick="location.href='<?php echo G5_BBS_URL;?>/board.php?bo_table=notice';">공지사항</li>
                        </ul>
                    </li>
                    <li class="depth community">
                        <a href="<?php echo G5_URL."/bbs/board.php?bo_table=inquiry"; ?>" class="top">고객센터</a>
                        <ul class="menu1">
                            <li class="menu1_title"><h2>고객센터</h2></li>
                            <li onclick="location.href='<?php echo G5_BBS_URL;?>/board.php?bo_table=inquiry';">상품문의</li>
                            <li onclick="location.href='<?php echo G5_BBS_URL;?>/board.php?bo_table=callinfo';">요금제안내</li>
                            <li onclick="location.href='<?php echo G5_BBS_URL;?>/board.php?bo_table=qna';">자주묻는질문</li>
                        </ul>
                    </li>
                </ul>
            </div>
			<div class="header_search">
				<form action="<?php echo G5_URL."/page/mall/list.php"; ?>" method="get">
					<input type="text" name="sch_text" id="sch_text" class="input_search" value="<?php echo $sch_text; ?>" placeholder="검색"/>
					<input type="submit" class="btn" value=""/>
				</form>
			</div>
		</div>
        <div class="sub_menu_bg">
        </div>
	</div>
</header>
<div class="msg"></div>
<div id="mobile_header">
	<h1><a href="<?php echo G5_URL; ?>"><i></i></a></h1>
	<div class="menu_btn"><i></i></div>
	<div class="mobile_menu">
		<span></span>
		<div>
			<div class="member_box">
				<div class="box">
					<h3 class="mb_none"></h3>
					<div class="btn_group">
                        <?php if($is_admin){ ?>
                            <a href="<?php echo G5_URL."/admin/"; ?>" class="btn01">관리자</a>
                            <a href="<?php echo G5_URL."/bbs/logout.php"; ?>" class="btn01">로그아웃</a>
                        <?php } else {?>
                            <a href="<?php echo G5_URL."/bbs/login.php"; ?>" class="btn01">관리자로그인</a>
                            <a href="<?php echo G5_URL."/bbs/logout.php"; ?>" class="btn01">로그아웃</a>
                        <?php } ?>
                        <a href="<?php echo G5_URL."/bbs/board.php?bo_table=notice"; ?>" class="btn01">공지사항</a>
					</div>
				</div>
			</div>
			<div class="menu">
				<ul>
					<li onclick="location.href='<?=G5_URL?>/page/mall/list.php'">
						<h4>SKT</h4>
					</li>
					<li>
						<h4>커뮤니티<i></i></h4>
                        <ul>
                            <li><a href="javascript:location.href='<?php echo G5_BBS_URL;?>/board.php?bo_table=review';">개통후기</a></li>
                            <li><a href="javascript:location.href='<?php echo G5_BBS_URL;?>/board.php?bo_table=notice';">공지사항</a></li>
                        </ul>
					</li>
					<li>
						<h4>고객센터<i></i></h4>
                        <ul>
                            <li><a href="javascript:location.href='<?php echo G5_BBS_URL;?>/board.php?bo_table=inquiry';">상품문의</a></li>
                            <li><a href="javascript:location.href='<?php echo G5_BBS_URL;?>/board.php?bo_table=callinfo';">요금제안내</a></li>
                            <li><a href="javascript:location.href='<?php echo G5_BBS_URL;?>/board.php?bo_table=qna';">자주묻는질문</a></li>
                        </ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="mobile_search">
		<form action="<?php echo G5_URL."/page/mall/list.php"; ?>" method="get">
			<input type="text" name="sch_text" id="sch_text" class="input_search" value="<?php echo $sch_text; ?>" placeholder="검색"/>
			<input type="submit" class="btn" value="검색"/>
		</form>
	</div>
	<div class="<?php echo $main?"main":"sub"; ?>">