<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<section class="section01">
	<header class="section01_header">
		<h1>CONTACT</h1>
		<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo G5_URL."/page/contact"; ?>">CONTACT</a> &gt; <a href="<?php echo G5_BBS_URL."/board.php?bo_table=qna"; ?>">Q&amp;A</a></p>
	</header>
	<nav class="section01_nav">
		<ul>
			<li><a href="<?php echo G5_URL."/page/contact"; ?>">CONTACT</a></li>
			<li class="active"><a href="<?php echo G5_BBS_URL."/board.php?bo_table=qna"; ?>">Q&amp;A</a></li>
		</ul>
	</nav>
	<article class="section01_con width-fixed board01">
		<div class="width-small-fixed">
			<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
				<input type="hidden" name="stx" value="<?php echo $stx ?>">
				<input type="hidden" name="spt" value="<?php echo $spt ?>">
				<input type="hidden" name="sca" value="<?php echo $sca ?>">
				<input type="hidden" name="sst" value="<?php echo $sst ?>">
				<input type="hidden" name="sod" value="<?php echo $sod ?>">
				<input type="hidden" name="page" value="<?php echo $page ?>">
				<input type="hidden" name="sw" value="">
				<div class="table04">
					<table>
						<thead>
							<tr>
								<th class="num">
									<?php if ($is_checkbox) { ?>
										<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
									<?php }else{ ?>
										NO.
									<?php } ?>
								</th>
								<th class="subject">Subject</th>
								<th class="date"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>Date</a></th>
							</tr>
						</thead>
						<tbody>
						<?php
						for ($i=0; $i<count($list); $i++) {
						 ?>
						<tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?> num">
							<td class="td_num">
							<?php if ($is_checkbox) { ?>
								<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
							<?php }else{ ?>
							<?php
							if ($list[$i]['is_notice']) // 공지사항
								echo '公告';
							else if ($wr_id == $list[$i]['wr_id'])
								echo "<span class=\"bo_current\">열람중</span>";
							else
								echo $list[$i]['num'];
							 ?>
							 <?php } ?>
							</td>
							<td class="subject" onclick="location.href='<?php echo $list[$i]['href'] ?>';">
								<?php
								echo $list[$i]['icon_reply'];
								if ($is_category && $list[$i]['ca_name']) {
								 ?>
								<a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
								<?php } ?>
								<a href="<?php echo $list[$i]['href'] ?>" class="title">
									<? if ($list[$i]['is_notice']) echo '<span class="notice">公告</span>';?> <?php echo $list[$i]['subject'] ?>
								</a>
							</td>
							<td class="date" onclick="location.href='<?php echo $list[$i]['href'] ?>';"><?php echo date("Y/m/d",strtotime($list[$i]['wr_datetime'])) ?></td>
						</tr>
						<?php } ?>
						<?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" style="padding:100px 0;">게시물이 없습니다.</td></tr>'; } ?>
						</tbody>
					</table>
				</div>
				<?php if ($is_checkbox) { ?>
				<div class="bo_fx" style="margin-top:20px">
					<?php if ($is_checkbox) { ?>
					<ul class="btn_bo_adm">
						<li><input type="submit" name="btn02" value="선택삭제" onclick="document.pressed=this.value"></li>
						<li><input type="submit" name="btn02" value="선택복사" onclick="document.pressed=this.value"></li>
						<li><input type="submit" name="btn02" value="선택이동" onclick="document.pressed=this.value"></li>
					</ul>
					<?php } ?>
				</div>
				<?php } ?>
				<?php if ($write_href) { ?>
				<div class="btn_group">
					<?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn01">写作</a><?php } ?>
				</div>
				<?php } ?>
				</form>
			</div>
			<?php if($is_checkbox) { ?>
			<noscript>
			<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
			</noscript>
			<?php } ?>
			<!-- 페이지 -->
			<?php if($write_pages){ ?>
			<div class="list_num01">
			<?php echo $write_pages;  ?>
			</div>
			<?php } ?>
		</div>
	</article>
</section>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
