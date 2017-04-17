<?php
/**
 * Created by PhpStorm.
 * User: Pc
 * Date: 2017-04-12
 * Time: 오후 2:17
 */
include_once('../../common.php');

$id = $_REQUEST["id"];
$type = $_REQUEST["type"];
if(!$id)
    echo "1";
$sql="select * from `gsw_product` WHERE id='{$id}'";
$row=sql_fetch($sql);
if($type==1){
?>
<input type="button" value="신청하기" class="lg_btn01 grid_100" onclick="window.open('<?php echo $row["orderlink"]; ?>','_new')"/>
<?php
}else if($type==2){
?>
<input type="button" value="신청하기" class="lg_btn01 grid_100" onclick="window.open('<?php echo $row["orderlink2"]; ?>','_new')"/>
<?php
}else{
?>
<input type="button" value="신청하기" class="lg_btn01 grid_100" onclick="window.open('<?php echo $row["orderlink3"]; ?>','_new')"/>
<?php
}
?>
