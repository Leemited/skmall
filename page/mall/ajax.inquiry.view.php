<?php
/**
 * Created by PhpStorm.
 * User: Pc
 * Date: 2017-04-12
 * Time: 오후 6:08
 */
include_once ("../../common.php");

$wr_id = $_REQUEST["wr_id"];
$id = $_REQUEST["id"];
$page = $_REQUEST["page"];

$sql = "SELECT * FROM `g5_write_inquiry` WHERE `wr_id` = '{$wr_id}'";
$view = sql_fetch($sql);


?>
<table class="viewtbl">
    <tr>
        <td><h3><?php echo $view["wr_subject"]; ?></h3><div><?php echo $view["wr_3"]?"답변완료":"답변대기";?></div></td>
    </tr>
    <tr>
        <td>연락처 : <?php echo $view["wr_2"] ;?> <span><?php echo $view["wr_datetime"]; ?></span></td>
    </tr>
    <tr>
        <td class="con">
            <?php echo $view["wr_content"] ;?>
        </td>
    </tr>
</table>
<div class="btnarea">
    <input type="button" value="목록으로" class="inquiryBtn" onclick="page(<?=$id?>,<?=$page?>);">
</div>