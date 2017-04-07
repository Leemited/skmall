<?php
	include_once('../../common.php');
	$number=$_POST['number'];
	$id=$_POST['id'];
	$cart_session=get_session("cart_session");
	if(!$cart_session){
		$cart_session="";
		for($i=0;$i<6;$i++){
			$c=rand(0,9);
			$cart_session.=$c;
		}
		set_session('cart_session',$cart_session);
	}
	if(!$id)
		alert('这是错误的做法。');
	$date1=date("Y-m-d H:i:s",strtotime("-1 days"));
	$where="((`mb_id`='{$member['mb_id']}' and `mb_id`<>'') or (`mb_ip`='{$_SERVER['REMOTE_ADDR']}' and `mb_session`='{$cart_session}' and `datetime`>'{$date1}'))";
	$data=sql_fetch("select * from `gsw_cart` where `product_id`='{$id}' and {$where} and `od_status`<>1");
	if($is_member && $data['mb_id']==""){
		sql_query("update `gsw_cart` set `mb_id`='{$data['mb_id']}' where `id`='{$data['id']}';");
	}
	$sql="select *,(select sum(number) from `gsw_sell` as s where p.id=s.product_id and s.status<>'-1') as sell from `gsw_product` as p where `show`<>'0' and `id`='{$id}'";
	$view=sql_fetch($sql);
	if($view['out'] || $view['number']-$view['sell']<($number+$data['number']))
		alert('此产品售完，或者如果数目是不够的。');
	if($data['id'] && $member['mb_id']==$data['mb_id']){
		sql_query("update `gsw_cart` set `number`=`number`+'{$number}',`datetime`=now() where `product_id`='{$id}' and {$where} and `od_status`<>1;");
	}else{
		sql_query("insert into `gsw_cart` (`product_id`,`number`,`mb_ip`,`mb_id`,`mb_session`,`datetime`) values ('{$id}','{$number}','{$_SERVER['REMOTE_ADDR']}','{$member['mb_id']}','{$cart_session}',NOW());");
	}
	alert("车已保存。",G5_URL."/page/mypage/cart.php");
?>