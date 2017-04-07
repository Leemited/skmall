<?php
	include_once('../../common.php');
	$mb_id=$_POST['mb_id'];
	$mb_name=$_POST['mb_name'];
	$mb_1=$_POST['mb_1'];
	$mb_hp=$_POST['mb_hp'];
	$mb_hp="+".$mb_1." ".$mb_hp;
	$person=$_POST['person'];
	$academy_id=$_POST['academy_id'];
	if(!$academy_id){
		echo 1;
		return false;
	}
	$aca=sql_fetch("SELECT *,(select sum(person) from `gsw_application` as b where b.academy_id=a.id and `status`<>'-1') as application FROM `gsw_academy` as a WHERE id='{$academy_id}'");
	if(($aca['recruit']-$aca['application'])<$person){
		echo 2;
		return false;
	}
	$sql="insert into `gsw_application` (`mb_id`,`mb_name`,`mb_hp`,`person`,`academy_id`,`datetime`) values('{$mb_id}','{$mb_name}','{$mb_hp}','{$person}','{$academy_id}',NOW());";
	$query=sql_query($sql);
	if(!$query){
		echo 3;
		return false;
	}