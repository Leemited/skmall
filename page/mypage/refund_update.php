<?php
	include_once('../../common.php');
	$id=$_POST['id'];
	$reason=$_POST['reson'];
	$refund_content=nl2br($_POST['refund_content']);
	$bank=$_POST['bank'];
	$account=$_POST['account'];
	if(!$id)
		alert("这是错误的做法。");
	$sql="update `gsw_order` set `reason`='{$reason}',`refund_content`='{$refund_content}',`bank`='{$bank}',`account`='{$account}',`status2`=`status`,`status`='-1' where id='{$id}'";
	sql_query($sql);
	alert("退款请求完成。",G5_URL."/page/mypage/refund_list.php");
?>