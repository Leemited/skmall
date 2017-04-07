<?php
include_once('../../common.php');
$number=trim($_POST['number']);
$id=trim($_POST['id']);
if($number=="" || !$id)
	return false;
if($number==0){
	sql_query("delete from `gsw_cart` where `id`='{$id}';");
}else{
	sql_query("update `gsw_cart` set `number`='{$number}' where `id`='{$id}';");
}
?>