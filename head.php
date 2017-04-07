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
	<div class="top">
		<div class="width-fixed">
			<div class="academy"><a href="<?php echo G5_URL."/page/academy/application.php"; ?>"><i></i></a></div>
			<div class="consierge"><a href="<?php echo G5_URL."/page/concierge/"; ?>"><i></i></a></div>
			<h1 class="logo"><a href="<?php echo G5_URL; ?>"><i></i></a></h1>
			<div class="mb_menu">
				<ul>
				<?php if($is_member){ ?>
					<?php if($is_admin){ ?><li><a href="<?php echo G5_URL."/admin"; ?>">관리자</a></li><?php } ?>
					<?php if(!$is_admin && $code_admin['code']){ ?><li><a href="<?php echo G5_URL."/admin/sell.php"; ?>">매출관리</a></li><?php } ?>
					<li><a href="<?php echo G5_URL."/bbs/logout.php"; ?>">LOGOUT</a></li>
					<li><a href="<?php echo G5_URL."/bbs/register_form.php?w=u"; ?>">编辑个人信息</a></li>
					<li><a href="<?php echo G5_URL."/page/mypage/cart.php"; ?>">购物车</a></li>
					<li class="last"><a href="<?php echo G5_URL."/page/mypage/buy_list.php"; ?>">采购清单</a></li>
					<!-- <li class="last"><a href="<?php echo G5_URL."/page/mypage/refund_list.php"; ?>">환불목록</a></li> -->
				<?php }else{ ?>
					<li><a href="<?php echo G5_URL."/bbs/register_form.php"; ?>">JOIN</a></li>
					<li><a href="<?php echo G5_URL."/bbs/login.php"; ?>">LOGIN</a></li>
					<li><a href="<?php echo G5_URL."/page/mypage/cart.php"; ?>">购物车</a></li>
					<li class="last"><a href="<?php echo get_session('name') && get_session('email')?G5_URL."/page/mypage/buy_list.php":G5_URL."/page/mypage/nomember.php"; ?>">采购清单</a></li>
					<!-- <li class="last"><a href="<?php echo get_session('name') && get_session('email')?G5_URL."/page/mypage/refund_list.php":G5_URL."/page/mypage/nomember.php"; ?>">환불목록</a></li> -->
				<?php } ?>
				</ul>
			</div>
			<div class="header_search">
				<form action="<?php echo G5_URL."/page/mall/list.php"; ?>" method="get">
					<input type="text" name="sch_text" id="sch_text" class="input_search" value="<?php echo $sch_text; ?>" placeholder="Search..."/>
					<input type="submit" class="btn" value="搜索"/>
				</form>
			</div>
		</div>
	</div>
	<div class="main_menu">
		<div class="width-fixed">
			<h1 class="logo"><a href="<?php echo G5_URL; ?>"><i></i></a></h1>
			<div class="menu">
				<ul class="menuUl" style="padding-right:0;">
					<li class="depth company ">
						<a href="<?php echo G5_URL."/page/company"; ?>" class="top">COMPANY</a>
						<ul class="menu1">
							<li><a href="<?php echo G5_URL."/page/company"; ?>">关于公司</a></li>
							<li><a href="<?php echo G5_URL."/page/company/business.php"; ?>">关于事业</a></li>
						</ul>
					</li>
					<li class="depth academy">
						<a href="<?php echo G5_URL."/page/academy"; ?>" class="top">ACADEMY</a>
						<ul class="menu2">
							<li><a href="<?php echo G5_URL."/page/academy"; ?>">学院介绍</a></li>
<!--							<li><a href="<?php echo G5_URL."/page/academy/schedule.php"; ?>">学院日程</a></li>-->
							<li><a href="<?php echo G5_URL."/page/academy/application.php"; ?>">接收在线申请</a></li>
						</ul>
					</li>
					<li class="depth concierge">
						<a href="<?php echo G5_URL."/page/concierge"; ?>" class="top">CONCIERGE</a>
						<ul class="menu4">
							<li><a href="<?php echo G5_URL."/page/concierge"; ?>">关于礼宾医疗</a></li>
							<li><a href="<?php echo G5_URL."/page/concierge/skin.php"; ?>">皮肤治疗介绍</a></li>
							<li><a href="<?php echo G5_URL."/page/concierge/plastic.php"; ?>">整容手术介绍</a></li>
						</ul>
					</li>
					<li class="depth alliance">
						<a href="#" target="_blank" class="top">ALLIANCE</a>
						<ul class="menu5">
							<li style="letter-spacing:-0.1em;"><a href="#" target="_blank">延世YOUELLE皮肤科</a></li>
							<li><a href="http://www.kaasm.co.kr/" target="_blank">大韩美容学会</a></li>
							<!-- <li><a href="http://www.ctc.ac.kr/" target="_blank">济州观光大学</a></li> -->
						</ul>
<!--
						http://www.youelle.co.kr/
						http://www.youelle.co.kr/
						http://www.kaasm.co.kr/
						http://www.ctc.ac.kr/
-->
					</li>
					<li class="depth contact">
						<a href="<?php echo G5_URL."/page/contact"; ?>" class="top">CONTACT</a>
						<ul class="menu6">
							<li><a href="<?php echo G5_URL."/page/contact"; ?>">CONTACT</a></li>
							<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=qna"; ?>">Q&amp;A</a></li>
						</ul>
					</li>
					<li class="depth mall">
						<a href="<?php echo G5_URL."/page/mall/list.php"; ?>" class="top" target="_blank"><i></i>GSW MALL</a>
						<ul class="menu3">
							<?php for($i=0;$i<count($cate);$i++){ ?>
							<li><a href="<?php echo G5_URL."/page/mall/list.php?category=".urlencode($cate[$i]['cate']); ?>" target="_blank"><?php echo $cate[$i]['cate'];?></a></li>
							<?php } ?>
						</ul>
					</li>
					<li class="depth icon gsw" style="position:absolute;right:78px;"><span><i>&nbsp;</i><div><img src="<?php echo G5_IMG_URL."/menu_gsw_qr.png"; ?>" alt="img" /></div></li>
					<li class="depth icon wechat" style="position:absolute;right:0;"><span><i>&nbsp;</i></span><div><img src="<?php echo G5_IMG_URL."/menu_gsw_qr.png"; ?>" alt="img" /></div></li>
				</ul>
			</div>
			<div class="icon_menu">
				<ul>
					<li class="icon gsw"><span><i>&nbsp;</i><div><img src="<?php echo G5_IMG_URL."/menu_gsw_qr.png"; ?>" alt="img" /></div></li>
					<li class="icon wechat"><span><i>&nbsp;</i></span><div><img src="<?php echo G5_IMG_URL."/menu_wechat_qr.png"; ?>" alt="img" /></div></li>
				</ul>
			</div>
			<div class="mb_menu">
				<ul>
				<?php if($is_member){ ?>
					<?php if($is_admin){ ?><li><a href="<?php echo G5_URL."/admin"; ?>">ADMIN</a></li><?php } ?>
					<li><a href="<?php echo G5_URL."/bbs/logout.php"; ?>">LOGOUT</a></li>
					<li><a href="<?php echo G5_URL."/bbs/register_form.php?w=u"; ?>">编辑个人信息</a></li>
					<li><a href="<?php echo G5_URL."/page/mypage/cart.php"; ?>">购物车</a></li>
					<li class="last"><a href="<?php echo G5_URL."/page/mypage/buy_list.php"; ?>">采购清单</a></li>
					<!-- <li class="last"><a href="<?php echo G5_URL."/page/mypage/refund_list.php"; ?>">환불목록</a></li> -->
				<?php }else{ ?>
					<li><a href="<?php echo G5_URL."/bbs/register_form.php"; ?>">JOIN</a></li>
					<li><a href="<?php echo G5_URL."/bbs/login.php"; ?>">LOGIN</a></li>
					<li><a href="<?php echo G5_URL."/page/mypage/cart.php"; ?>">购物车</a></li>
					<li class="last"><a href="<?php echo get_session('name') && get_session('email')?G5_URL."/page/mypage/buy_list.php":G5_URL."/page/mypage/nomember.php"; ?>">采购清单</a></li>
					<!-- <li class="last"><a href="<?php echo get_session('name') && get_session('email')?G5_URL."/page/mypage/refund_list.php":G5_URL."/page/mypage/nomember.php"; ?>">환불목록</a></li> -->
				<?php } ?>
				</ul>
			</div>
			<div class="header_search">
				<form action="<?php echo G5_URL."/page/mall/list.php"; ?>" method="get">
					<input type="text" name="sch_text" id="sch_text" class="input_search" value="<?php echo $sch_text; ?>" placeholder="Search..."/>
					<input type="submit" class="btn" value="搜索"/>
				</form>
			</div>
		</div>
		<!-- <div class="menu_box">
			<div>
				<ul class="menu1">
					<li><a href="<?php echo G5_URL."/page/company"; ?>">회사소개</a></li>
					<li><a href="<?php echo G5_URL."/page/company/business.php"; ?>">사업소개</a></li>
				</ul>
				<ul class="menu2">
					<li><a href="<?php echo G5_URL."/page/academy"; ?>">아카데미소개</a></li>
					<li><a href="<?php echo G5_URL."/page/academy/schedule.php"; ?>">아카데미일정</a></li>
					<li><a href="<?php echo G5_URL."/page/academy/application.php"; ?>">온라인신청접수</a></li>
				</ul>
				<ul class="menu4">
					<li><a href="<?php echo G5_URL."/page/concierge"; ?>">메디컬 컨시어지 소개</a></li>
					<li><a href="<?php echo G5_URL."/page/concierge/skin.php"; ?>">피부시술 소개</a></li>
					<li><a href="<?php echo G5_URL."/page/concierge/plastic.php"; ?>">성형시술 소개</a></li>
				</ul>
				<ul class="menu5">
					<li><a href="http://www.youelle.co.kr/" target="_blank">연세 유엘르 피부과</a></li>
					<li><a href="http://www.kaasm.co.kr/" target="_blank">대한미용학회</a></li>
					<li><a href="http://www.ctc.ac.kr/" target="_blank">제주관광대학교</a></li>
				</ul>
				<ul class="menu6">
					<li><a href="<?php echo G5_URL."/page/contact"; ?>">CONTACT</a></li>
					<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=qna"; ?>">Q&amp;A</a></li>
				</ul>
				<ul class="menu3">
					<?php for($i=0;$i<count($cate);$i++){ ?>
					<li><a href="<?php echo G5_URL."/page/mall/list.php?category=".urlencode($cate[$i]['cate']); ?>"><?php echo $cate[$i]['cate'];?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
			</div> -->
</header>
<div class="msg"></div>
<div id="mobile_header">
	<div class="cart_btn"><a href="<?php echo G5_URL."/page/mypage/cart.php"; ?>"><i></i></a></div>
	<h1><a href="<?php echo G5_URL; ?>"><i></i></a></h1>
	<div class="menu_btn"><i></i></div>
	<div class="mobile_menu">
		<span></span>
		<div>
			<div class="member_box">
				<div class="box">
				<?php if(!$is_member){ ?>
					<h3 class="mb_none">请登录</h3>
					<div class="btn_group">
						<a href="<?php echo G5_BBS_URL."/login.php"; ?>" class="btn01">LOGIN</a>
						<a href="<?php echo G5_BBS_URL."/register_form.php"; ?>" class="btn01">JOIN</a>
					</div>
				<?php }else{ ?>
					<h3><?php echo $member['mb_name']; ?></h3>
					<div class="btn_group">
						<a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>" class="btn01">MY PAGE</a>
						<a href="<?php echo G5_BBS_URL."/logout.php"; ?>" class="btn01">LOGOUT</a>
					</div>
				<?php } ?>
				</div>
				<div class="list">
					<ul>
						<li><a href="<?php echo $is_member || (get_session('name') && get_session('email'))?G5_URL."/page/mypage/buy_list.php":G5_URL."/page/mypage/nomember.php"; ?>"><h4>采购清单</h4><span>BUY LIST</span></a></li>
						<li class="last"><a href="<?php echo $is_member || (get_session('name') && get_session('email'))?G5_URL."/page/mypage/refund_list.php":G5_URL."/page/mypage/nomember.php"; ?>"><h4>退款清单</h4><span>REFUND LIST</span></a></li>
					</ul>
				</div>
			</div>
			<div class="menu">
				<ul>
					<li>
						<h4>COMPANY<i></i></h4>
						<ul>
							<li><a href="<?php echo G5_URL."/page/company"; ?>">关于公司</a></li>
							<li><a href="<?php echo G5_URL."/page/company/business.php"; ?>">关于事业</a></li>
						</ul>
					</li>
					<li>
						<h4>ACADEMY<i></i></h4>
						<ul>
							<li><a href="<?php echo G5_URL."/page/academy"; ?>">学院介绍</a></li>
<!--							<li><a href="<?php echo G5_URL."/page/academy/schedule.php"; ?>">学院日程</a></li>-->
							<li><a href="<?php echo G5_URL."/page/academy/application.php"; ?>">接收在线申请</a></li>
						</ul>
					</li>
					<li>
						<h4>GSW MALL<i></i></h4>
						<ul>
							<?php for($i=0;$i<count($cate);$i++){ ?>
							<li><a href="<?php echo G5_URL."/page/mall/list.php?category=".urlencode($cate[$i]['cate']); ?>"><?php echo $cate[$i]['cate'];?></a></li>
							<?php } ?>
						</ul>
					</li>
					<li>
						<h4>CONCIERGE<i></i></h4>
						<ul>
							<li><a href="<?php echo G5_URL."/page/concierge"; ?>">关于礼宾医疗</a></li>
							<li><a href="<?php echo G5_URL."/page/concierge/skin.php"; ?>">皮肤治疗介绍</a></li>
						</ul>
					</li>
					<li>
						<h4>ALLIANCE<i></i></h4>
						<ul>
							<li><a href=# target="_blank">延世YOUELLE皮肤科</a></li>
							<li><a href="http://www.kaasm.co.kr/" target="_blank">大韩美容学会</a></li>
							<!-- <li><a href="http://www.ctc.ac.kr/" target="_blank">济州观光大学</a></li> -->
						</ul>
					</li>
					<li>
						<h4>CONTACT<i></i></h4>
						<ul>
							<li><a href="<?php echo G5_URL."/page/contact"; ?>">CONTACT</a></li>
							<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=qna"; ?>">Q&amp;A</a></li>
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
			<input type="text" name="sch_text" id="sch_text" class="input_search" value="<?php echo $sch_text; ?>" placeholder="Search..."/>
			<input type="submit" class="btn" value="搜索"/>
		</form>
	</div>
	<div class="<?php echo $main?"main":"sub"; ?>">