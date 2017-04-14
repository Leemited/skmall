<?php
	include_once("../common.php");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	$mb_no=$_POST['mb_no'];
	$mb_id=$_POST["mb_id"];
	$mb_name=$_POST['mb_name'];
	$mb_password=$_POST['mb_password'];
	$mb_email=$_POST['mb_email'];
	$mb_hp=hyphen_hp_number($_POST['mb_hp']);
	$mb_1=$_POST['mb_1'];
	$mb_2=$_POST['mb_2'];
	if($mb_password){
		$mb_password_sql=", `mb_password`=password('".$mb_password."')";
	}
    if($mb_id)
        $data=sql_fetch("select * from `gsw_banner` where mb_id='".$mb_id."'");
    $dir=G5_DATA_PATH."/banner";
    @mkdir($dir, G5_DIR_PERMISSION);
    @chmod($dir, G5_DIR_PERMISSION);
    $filename1=time()."_banner.jpg";
    $path1=$dir."/".$filename1;
	if($mb_no){
        if($_FILES['banner']['tmp_name']){
            image_resize_update($_FILES['banner']['tmp_name'],$_FILES['banner']['name'], $path1);
            $banner=$filename1;
            $banner_sql="`banner`='".$filename1."'";
            @unlink($dir."/".$data['banner']);
        }
        $sql="update `gsw_banner` set {$banner_sql} where `mb_id`='{$mb_id}'";
        if(sql_query($sql)){
            alert("파일 등록 성공");
        }else{
            alert("파일 등록 실패");
        }
	    $sql="update `g5_member` set `mb_name`='{$mb_name}',`mb_email`='{$mb_email}',`mb_hp`='{$mb_hp}',`mb_1`='{$mb_1}',`mb_2`='{$mb_2}'  where `mb_no`='{$mb_no}'";
	    sql_query($sql);
        alert("수정 되었습니다.");
    }else{
        if($_FILES['banner']['tmp_name']){
            image_resize_update($_FILES['banner']['tmp_name'],$_FILES['banner']['name'], $path1);
            $banner=$filename1;
            $banner_sql=",`banner`='".$filename1."'";
            @unlink($dir."/".$data['banner']);
        }
        $sql="insert into `gsw_banner` (`banner`,`link`,`target`,`status`,`mb_id`) values ('{$banner}','#','#','1','{$mb_id}')";
        sql_query($sql);

        $sql="insert into `g5_member` (`mb_id`,`mb_password`) values ('{$mb_id}',password('".$mb_password."'))";
        sql_query($sql);
        alert("등록 되었습니다.");
    }
