<?php
/**
 * Created by PhpStorm.
 * User: Pc
 * Date: 2017-04-12
 * Time: 오후 3:58
 */

include_once ("../../common.php");

$id = $_REQUEST['wr_1'];
$page = $_REQUEST["page"];

$sql = "SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM `g5_write_inquiry` WHERE wr_is_comment = 0 AND `wr_1` = '{$id}'";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$page_rows=10;
$list_page_rows = 10;

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

$sql = "SELECT * FROM `g5_write_inquiry` WHERE wr_is_comment = 0 AND `wr_1` = '{$id}' order by `wr_id` desc limit {$from_record}, $page_rows ";
$res = sql_query($sql);
$i = 0;
if($page_rows > 0) {
    $k=0;
    while ($row = sql_fetch_array($res)) {
        $list[$i] = get_list($row, $board, $board_skin_url, 40);

        $list_num = $total_count - ($page - 1) * $list_page_rows - 0;
        $list[$i]['num'] = $list_num - $k;

        $k++;
        $i++;
    }
}

$write_pages = get_paging2(10, $page, $total_page, $id);

?>
<p>※ 게시판 성격과 다른내용의 글을 등록하실 경우 임의로 삭제처리될 수 있습니다.</p>
<table class="listtbl">
    <colgroup>
        <col width="10%">
        <col width="50%">
        <col class="mobile" width="10%">
        <col class="mobile" width="15%">
        <col class="mobiles" width="15%">
    </colgroup>
    <tr>
        <th>번호</th>
        <th>제목</th>
        <th class="mobile">연락처</th>
        <th class="mobile">작성일</th>
        <th>답변상태</th>
    </tr>
    <tr>
        <td class="mobile" colspan="5" style="padding: 1px;"></td>
    </tr>
    <?php
    if(count($list)==0){
        ?>
        <tr>
            <td colspan="5" style="text-align: center">등록된 문의가 없습니다.</td>
        </tr>
        <?php
    }else{
        for ($i = 0; $i < count($list); $i++) {
            ?>
            <tr>
                <td class="num">
                    <?php
                    if ($list[$i]['is_notice']) // 공지사항
                        echo '<strong>공지</strong>';
                    else if ($wr_id == $list[$i]['wr_id'])
                        echo "<span class=\"bo_current\">열람중</span>";
                    else
                        echo $list[$i]['num'];
                    ?>
                </td>
                <td class="title"><a href="javascript:view(<?=$list[$i]["wr_id"]?>,<?=$page?>,<?=$id?>);"><?php echo $list[$i]["wr_subject"];?></a></td>
                <td class="mobile"><?php echo $list[$i]["wr_2"];?></td>
                <td class="mobile"><?php echo $list[$i]["datetime2"];?></td>
                <td><?php echo $list[$i]["wr_3"]?"답변완료":"답변대기";?></td>
            </tr>
        <?php }
    }
    ?>
</table>
<div class="pagediv">
<?php
echo $write_pages;
?>
</div>
<script>
    function page(id , page){
        $.ajax({
            url:"./ajax.inquiry.list.php",
            method:"POST",
            data:{wr_1:id,page:page},
            dataType:"html"
        }).done(function(html) {
            $(".inquiry-list").html(html);
        });
    }
    function view(wr_id , page, id){
        $.ajax({
            url:"./ajax.inquiry.view.php",
            method:"POST",
            data:{wr_id:wr_id,page:page,id:id},
            dataType:"html"
        }).done(function(html) {
            $(".inquiry-list").html(html);
        });
    }
</script>
<div class="btnarea">
    <a  class="inquiryBtn" href="<?php echo G5_BBS_URL?>/write.php?bo_table=inquiry&wr_1=<?=$id?>">문의하기</a>
</div>