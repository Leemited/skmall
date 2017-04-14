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

$sql = "SELECT * FROM `g5_write_review` WHERE `wr_id` = '{$wr_id}'";
$view = sql_fetch($sql);
switch ($list[$i]["wr_3"]){
    case "5":
        $rank = "★★★★★";
        break;
    case "4":
        $rank =  "★★★★☆";
        break;
    case "3":
        $rank =  "★★★☆☆";
        break;
    case "2":
        $rank =  "★★☆☆☆";
        break;
    case "1":
        $rank =  "★☆☆☆☆";
        break;
    case "0":
        $rank =  "☆☆☆☆☆";
        break;
}

?>
<table class="viewtbl">
    <tr>
        <td><h3><?php echo $view["wr_subject"]; ?></h3><div class="orange"><?php echo $rank;?></div></td>
    </tr>
    <tr>
        <td>작성자 : <?php echo $view["wr_name"] ;?> <span><?php echo $view["wr_datetime"]; ?></span></td>
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