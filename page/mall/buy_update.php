<?php
include_once('../../common.php');
$product_id=$_POST['product_id'];
$category=$_POST['category'];
$number=$_POST['number'];
$price=$_POST['price'];
$delivery=$_POST['delivery'];
$total_price=$_POST['total_price'];
$mb_id=$_POST['mb_id'];
$code=$_POST['code'];
$mb_name=$_POST['mb_name'];
$mb_email=$_POST['mb_email'];
$mb_hp=$_POST['mb_hp'];
$mb_addr=$_POST['mb_addr'];
$re_name=$_POST['re_name'];
$re_hp=$_POST['re_hp'];
$content=nl2br($_POST['content']);
$sql="select *,(select sum(number) from `gsw_sell` as s where p.id=s.product_id and s.status<>'-1') as sell from `gsw_product` as p where `show`<>'0' and `id`='{$product_id}'";
$view=sql_fetch($sql);
if(!$view['id'])
	alert('제품을 찾을 수 없습니다.',G5_URL."/page/mall/list?category=".urlencode($category));
if($view['out'] || $view['number']-$view['sell']<$number)
	alert('본 상품은 매진되었거나, 개수가 부족합니다.',G5_URL."/page/mall/list?category=".urlencode($category));
$sql="INSERT INTO  `gsw_sell` (`product_id` ,`number` ,`price` ,`delivery` ,`total_price` ,`payment` ,`mb_id`,`code` ,`mb_name` ,`mb_email` ,`mb_hp` ,`mb_addr` ,`re_name` ,`re_hp` ,`content` ,`status` ,`datetime`)VALUES ('{$product_id}',  '{$number}',  '{$price}',  '{$delivery}',  '{$total_price}',  '알리페이',  '{$mb_id}',  '{$code}',  '{$mb_name}',  '{$mb_email}',  '{$mb_hp}','{$mb_addr}',  '{$re_name}',  '{$re_hp}',  '{$content}',  '1',now());";
sql_query($sql);
alert("구매 되었습니다.",G5_URL."/page/mall/view.php?category=".urlencode($category)."&id=".$product_id);
?>
