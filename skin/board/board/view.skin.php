<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

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
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<section class="section02">
    <header class="section02_header width-fixed">
        <h1><?php echo $board['bo_subject'];?><span><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo $link; ?>"><?php echo $sitemap; ?></a> &gt; <a href="<?php echo G5_BBS_URL."/board.php?bo_table=qna"; ?>"><?php echo $board['bo_subject'];?></a></span></h1>

    </header>
	<article class="section01_con width-fixed board_write01">
		<div class="table01">
			<table>
				<thead>
					<tr>
						<td colspan="2">
							<h1>
								<?php
								if ($category_name) echo $view['ca_name'].' | '; // 분류 출력 끝
								echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
								?>
							</h1>
							<div class="info" style="color:#666;">
                                <div class="wr_name_icon"></div><?php echo $view['wr_name'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;<div class="wr_time_icon"></div>작성일 : <?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?>&nbsp;&nbsp;|&nbsp;&nbsp;조회 : <?php echo number_format($view['wr_hit']) ?>
                                <?php if($bo_table=="review"){
                                    echo "&nbsp;&nbsp;|&nbsp;&nbsp;만족도 : ";
                                    switch ($view["wr_3"]){
                                        case "5":
                                            echo "<span class='orange'>★★★★★</span>";
                                            break;
                                        case "4":
                                            echo "<span class='orange'>★★★★☆</span>";
                                            break;
                                        case "3":
                                            echo "<span class='orange'>★★★☆☆</span>";
                                            break;
                                        case "2":
                                            echo "<span class='orange'>★★☆☆☆</span>";
                                            break;
                                        case "1":
                                            echo "<span class='orange'>★☆☆☆☆</span>";
                                            break;
                                        case "0":
                                            echo "<span class='orange'>☆☆☆☆☆</span>";
                                            break;
                                    }
                                }?>
							</div>
						</td>
					</tr>
				</thead>
				<tbody>
                <tr>
                    <td colspan="2" style="padding: 1px"></td>
                </tr>
				<?php
				if ($view['file']['count']) {
					$cnt = 0;
					for ($i=0; $i<count($view['file']); $i++) {
						if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
							$cnt++;
					}
				}
				if($cnt) {
				// 가변 파일
				for ($i=0; $i<count($view['file']); $i++) {
					if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
				 ?>
					<tr>
						<th>첨부파일<?php echo $i+1; ?></th>
						<td>
							<a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
								<strong><?php echo $view['file'][$i]['source'] ?></strong>
								<?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
							</a>
						</td>
					</tr>
				<?php
						}
					}
				}
				?>
				<tr>
					<td colspan="2">
						<div style="min-height:130px">
							<?php
							// 파일 출력
							$v_img_count = count($view['file']);
							if($v_img_count) {
								echo "<div id=\"bo_v_img\">\n";
								for ($i=0; $i<=count($view['file']); $i++) {
									if ($view['file'][$i]['view']) {
										//echo $view['file'][$i]['view'];
										echo get_view_thumbnail($view['file'][$i]['view']);
									}
								}
								echo "</div>\n";
							}
							 ?>
							<!-- 본문 내용 시작 { -->
							<div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>
							<?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
							<!-- } 본문 내용 끝 -->
						</div>
					</td>
				</tr>
				</tbody>
			</table>
            <?php
            // 코멘트 입출력
                include_once('./view_comment.php');
            ?>
			<!-- 링크 버튼 시작 { -->
			<ul class="btn_bo_adm">

				<?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="inquiryBtn">수정</a></li><?php } ?>
				<?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="inquiryBtn" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
				<?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>" class="inquiryBtn">검색</a></li><?php } ?>
				<li><a href="<?php echo $list_href ?>" class="inquiryBtn">목록</a></li>
				<?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="inquiryBtn">답글</a></li><?php } ?>
				<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="inquiryBtn">글쓰기</a></li><?php } ?>
                <?php if ($prev_href || $next_href) { ?>
                <?php if ($prev_href) { ?><li class="left"><a href="<?php echo $prev_href ?>" class="inquiryBtn">이전글</a></li><?php } ?>
                <?php if ($next_href) { ?><li class="right"><a href="<?php echo $next_href ?>" class="inquiryBtn">다음글</a></li><?php } ?>
                <?php } ?>
			</ul>
		</div>
	</article>
</section>
<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->