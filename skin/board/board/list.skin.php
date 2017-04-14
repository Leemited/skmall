<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if($bo_table == "notice" || $bo_table == "qna" || $bo_table == "callinfo") {
    $colspan--;
    //if ($is_checkbox)
}
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
if($bo_table=="notice" || $bo_table == "review"){
    $sitemap = "커뮤니티";
    $link = G5_BBS_URL."/board.php?bo_table=review";
}else{
    $sitemap = "고객센터";
    $link = G5_BBS_URL."/board.php?bo_table=inquiry";
}
?>
<section class="section02">
	<header class="section02_header width-fixed">
		<h1><?php echo $board['bo_subject'];?><span><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo $link; ?>"><?php echo $sitemap; ?></a> &gt; <a href="<?php echo G5_BBS_URL."/board.php?bo_table=".$bo_table; ?>"><?php echo $board['bo_subject'];?></a></span></h1>

	</header>
    <article class="section01_con width-fixed board01">
        <?php
        if($bo_table=="review" || $bo_table=="inquiry"){
        ?>
        <p>※ 게시판 성격과 다른내용의 글을 등록하실 경우 임의로 삭제처리될 수 있습니다.</p>
        <br>
        <?php }?>
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
                        <colgroup>
                            <col width="10%">
                            <col width="40%">
                            <col class="mobile" width="15%">
                            <col class="<?php if($bo_table!="inquiry" || $bo_table!="review") {?>mobile <?php } ?>" width="15%">
                            <?php
                            if($bo_table=="inquiry" || $bo_table=="review"){
                            ?>
                            <col width="15%">
                            <?php }?>
                        </colgroup>
						<thead>
							<tr>
								<th class="num">
									<?php if ($is_admin) { ?>
										<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
									<?php }else{ ?>
										NO.
									<?php } ?>
								</th>
								<th class="subject">제목</th>
                                <th class="mobile"><?php echo $bo_table=="inquiry"?"연락처":"작성자";?></th>
								<th class="date <?php if($bo_table!="inquiry" || $bo_table!="review") {?>mobile <?php } ?>">등록일</a></th>
                                <?php
                                if($bo_table=="inquiry" || $bo_table=="review"){
                                ?>
                                <th><?php echo $bo_table=="inquiry"?"답변상태":"만족도";?></th>
                                <?php }?>
							</tr>
						</thead>
						<tbody>
                        <tr>
                            <td class="mobile" colspan="<?php echo $colspan; ?>" style="padding: 1px;"></td>
                        </tr>
						<?php
						for ($i=0; $i<count($list); $i++) {
						    $title = sql_fetch("SELECT * FROM `gsw_product` WHERE id = ".$list[$i]["wr_1"]);
						 ?>
						<tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?> num">
							<td class="td_num">
							<?php if ($is_checkbox) { ?>
								<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
							<?php }else{ ?>
							<?php
							if ($list[$i]['is_notice']) // 공지사항
								echo '공지';
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
									<? if ($list[$i]['is_notice']) echo '<span class="notice">공지</span>';?><? if($title["title"]) echo "[".$title["title"]."] "?> <?php echo $list[$i]['subject'] ?>
								</a>
							</td>
                            <td class="mobile"><?php echo $bo_table=="inquiry"? $list[$i]["wr_2"] : $list[$i]["wr_name"] ;?></td>
							<td class="date <?php if($bo_table!="inquiry" || $bo_table!="review") {?>mobile <?php } ?>" onclick="location.href='<?php echo $list[$i]['href'] ?>';"><?php echo date("Y/m/d",strtotime($list[$i]['wr_datetime'])) ?></td>
                            <?php
                            if($bo_table=="inquiry" || $bo_table=="review"){
                            ?>
                            <td class="orange">
                                <?php
                                if($bo_table=="inquiry"){
                                    echo $list[$i]["wr_3"]?"답변완료":"답변대기";
                                }else {
                                    switch ($list[$i]["wr_3"]){
                                        case "5":
                                            echo "★★★★★";
                                            break;
                                        case "4":
                                            echo "★★★★☆";
                                            break;
                                        case "3":
                                            echo "★★★☆☆";
                                            break;
                                        case "2":
                                            echo "★★☆☆☆";
                                            break;
                                        case "1":
                                            echo "★☆☆☆☆";
                                            break;
                                        case "0":
                                            echo "☆☆☆☆☆";
                                            break;
                                    }
                                }
                                ?>
                            </td>
                            <?php } ?>
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
						<li><input type="submit" name="btn_submit" class="inquiryBtn" value="선택삭제" onclick="document.pressed=this.value"></li>
						<li><input type="submit" name="btn_submit" class="inquiryBtn" value="선택복사" onclick="document.pressed=this.value"></li>
						<li><input type="submit" name="btn_submit" class="inquiryBtn" value="선택이동" onclick="document.pressed=this.value"></li>
					</ul>
					<?php } ?>
				</div>
				<?php } ?>


				</form>
            <?php if ($write_href) { ?>
                <div class="btn_group">
                    <?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="inquiryBtn">글쓰기</a><?php } ?>
                </div>
            <?php } ?>
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
            <!-- 게시물 검색 시작 { -->
            <fieldset id="bo_sch">
                <form name="fsearch" method="get">
                    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                    <input type="hidden" name="sca" value="<?php echo $sca ?>">
                    <input type="hidden" name="sop" value="and">
                    <label for="sfl" class="sound_only">검색대상</label>
                    <select name="sfl" id="sfl" class="input04">
                        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
                        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
                        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
                        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
                        <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
                        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
                        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
                    </select>
                    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="input04" size="15" maxlength="20">
                    <input type="submit" value="검색" class="inquiryBtn">
                </form>
            </fieldset>
            <!-- } 게시물 검색 끝 -->
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
