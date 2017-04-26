<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$page=$_POST['page'];
	$title=$_POST['title'];
	$en_title=$_POST['en_title'];
	$show=$_POST['show']?"1":"0";
	$out=$_POST['out']?"1":"0";
    $preorder=$_POST['preorder']?"1":"0";
    $spec=$_POST['spec'];
    $specCon=$_POST['specCon'];
	$color = $_POST["color"];
	$orderlink=$_POST['orderlink'];
	$orderlink2=$_POST['orderlink2'];
	$orderlink3=$_POST['orderlink3'];
	$callplan = $_POST["callplan"];
	$callprice = $_POST["price"];
	$callvoice = $_POST["voice"];
	$callsms = $_POST["sms"];
	$calldata = $_POST["data"];
	$delRow = $_POST["delRow"];
	$ori_photo0 = $_POST["ori_photo"];
    $ori_photo1 = $_POST["ori_photo1"];
    $ori_photo2 = $_POST["ori_photo2"];
    $ori_photo3 = $_POST["ori_photo3"];
    $ori_photo4 = $_POST["ori_photo4"];

	$content = substr(trim($_POST['content']),0,65536);
    $content = preg_replace("#[\\\]+$#", "", $content);

	$photo = $_FILES["photo"];
    $photo1 = $_FILES["photo1"];
    $photo2 = $_FILES["photo2"];
    $photo3 = $_FILES["photo3"];
    $photo4 = $_FILES["photo4"];

    $dir=G5_DATA_PATH."/product";
    @mkdir($dir, G5_DIR_PERMISSION);
    @chmod($dir, G5_DIR_PERMISSION);
    $filename1=time();

    $mainCount = count(explode(",",$ori_photo0));

	if($id){
		$sql = "SELECT * FROM `gsw_product` where `id` = {$id}";
		$data = sql_fetch($sql);
		if($data["photo"]){
			$image0 = explode(",",$data["photo"]);
			$image1 = explode(",",$data["photo1"]);
			$image2 = explode(",",$data["photo2"]);
			$image3 = explode(",",$data["photo3"]);
			$image4 = explode(",",$data["photo4"]);
		}
		if(count($image0) == 0){
		    for($j=0;$j<5;$j++){
                if($j!=0) {
                    $num = $j;
                }
                for ($i = 0; $i < count($_FILES["photo".$num]['tmp_name']); $i++) {
                    if (count($_FILES["photo".$num]['tmp_name']) == ($i + 1)) {
                        ${"photos".$num} .= $filename1 . "_product".$num."_" . $i . ".jpg";
                        $path1 = $dir . "/" . $filename1 . "_product".$num."_" . $i . ".jpg";
                    } else {
                        ${"photos".$num} .= $filename1 . "_product".$num."_" . $i . ".jpg, ";
                        $path1 = $dir . "/" . $filename1 . "_product".$num."_" . $i . ".jpg";
                    }
                    image_resize_update($_FILES["photo".$num]['tmp_name'][$i], $_FILES["photo".$num]['name'][$i], $path1, 850);
                }
            }
            sql_query("UPDATE  `gsw_product`  SET `photo` = '{$photos}', `photo1` = '{$photos1}' , `photo2` = '{$photos2}' , `photo3` = '{$photos3}' , `photo4` = '{$photos4}' WHERE `id` = '{$id}'");
        }else if($mainCount < count($_FILES["photo"]['tmp_name'])){
            for($j=0;$j<5;$j++) {
                if ($j != 0) {
                    $num = $j;
                }
                for ($i = 0; $i < count($_FILES["photo".$num]['tmp_name']); $i++) {
                    if($_FILES["photo".$num]["tmp_name"][$i]) {
                        if (count($_FILES["photo" . $num]['tmp_name']) == ($i + 1)) {
                            ${"photos" . $num} .= $filename1 . "_product" . $num . "_" . $i . ".jpg";
                            $path1 = $dir . "/" . $filename1 . "_product" . $num . "_" . $i . ".jpg";
                        } else {
                            ${"photos" . $num} .= $filename1 . "_product" . $num . "_" . $i . ".jpg, ";
                            $path1 = $dir . "/" . $filename1 . "_product" . $num . "_" . $i . ".jpg";
                        }
                        image_resize_update($_FILES["photo" . $num]['tmp_name'][$i], $_FILES["photo" . $num]['name'][$i], $path1, 850);
                    }
                }
            }
            sql_query("UPDATE  `gsw_product`  SET `photo` = CONCAT(`photo`,',','{$photos}'),`photo1` = CONCAT(`photo1`,',','{$photos1}'),`photo2` = CONCAT(`photo2`,',','{$photos2}'),`photo3` = CONCAT(`photo3`,',','{$photos3}'),`photo4` = CONCAT(`photo4`,',','{$photos4}') WHERE `id` = '{$id}'");
        }else{
            for($j=0;$j<5;$j++) {
                if ($j != 0) {
                    $num = $j;
                }
                for ($i = 0; $i < count($_FILES["photo".$num]['tmp_name']); $i++) {
                    if($_FILES["photo".$num]["tmp_name"][$i]) {

                        $path1 = $dir . "/" . $filename1 . "_product" . $num . "_" . $i . ".jpg";

                        image_resize_update($_FILES["photo" . $num]['tmp_name'][$i], $_FILES["photo" . $num]['name'][$i], $path1, 850);
                        @unlink($dir . "/" . ${"image".$i}[$j]);
                        ${"image".$j}[$i] =  $filename1 . "_product" . $num . "_" . $i . ".jpg";
                    }
                }
            }
            $upImg0 = implode(",",$image0);
            $upImg1 = implode(",",$image1);
            $upImg2 = implode(",",$image2);
            $upImg3 = implode(",",$image3);
            $upImg4 = implode(",",$image4);
            sql_query("UPDATE  `gsw_product`  SET `photo` = '{$upImg0}',`photo1` = '{$upImg1}',`photo2` = '{$upImg2}',`photo3` = '{$upImg3}',`photo4` = '{$upImg4}' WHERE `id` = '{$id}'");
        }
		if($delRow){
		    $delnum = explode(",",$delRow);
            for($j=0;$j<count($delnum);$j++){
                $nums = $delnum[$j];
                @unlink($dir . "/" . $image0[$nums]);
                @unlink($dir . "/" . $image1[$nums]);
                @unlink($dir . "/" . $image2[$nums]);
                @unlink($dir . "/" . $image3[$nums]);
                @unlink($dir . "/" . $image4[$nums]);
                unset($image0[$nums]);
                unset($image1[$nums]);
                unset($image2[$nums]);
                unset($image3[$nums]);
                unset($image4[$nums]);

            }
            $delimg0 = implode(",",$image0);
            $delimg1 = implode(",",$image1);
            $delimg2 = implode(",",$image2);
            $delimg3 = implode(",",$image3);
            $delimg4 = implode(",",$image4);
            sql_query("UPDATE  `gsw_product`  SET `photo` = '{$delimg0}', `photo1` = '{$delimg1}' , `photo2` = '{$delimg2}' , `photo3` = '{$delimg3}' , `photo4` = '{$delimg4}' WHERE `id` = '{$id}'");
        }
	}else{
	    for($j=0;$j<5;$j++) {
	        if($j!=0) {
                $num = $j;
            }
            for ($i = 0; $i < count($_FILES["photo".$num]['tmp_name']); $i++) {
                if (count($_FILES["photo".$num]['tmp_name']) == ($i + 1)) {
                    ${"photos".$num} .= $filename1 . "_product".$num."_" . $i . ".jpg";
                    $path1 = $dir . "/" . $filename1 . "_product".$num."_" . $i . ".jpg";
                } else {
                    ${"photos".$num} .= $filename1 . "_product".$num."_" . $i . ".jpg, ";
                    $path1 = $dir . "/" . $filename1 . "_product".$num."_" . $i . ".jpg";
                }
                image_resize_update($_FILES["photo".$num]['tmp_name'][$i], $_FILES["photo".$num]['name'][$i], $path1, 850);
            }
        }
    }


    if(count($spec)>1){
        for($i=0;$i<count($spec);$i++){
            if(count($spec)==($i+1))
                $specInfo .= $spec[$i]."##".$specCon[$i];
            else
                $specInfo .= $spec[$i]."##".$specCon[$i]."||";
        }
    }

    if(count($callingplan)>1){
       for($i=0;$i<count($callingplan);$i++){
            if(count($callingplan)==($i+1))
                $call_plan .= $callingplan[$i]."##".$price[$i]."##".$voice[$i]."##".$sms[$i]."##".$calldata[$i];
            else
                $call_plan .= $callingplan[$i]."##".$price[$i]."##".$voice[$i]."##".$sms[$i]."##".$calldata[$i]."||";
        }
    }

    if(count($color)>1){
        for($i=0;$i<count($color);$i++){
            if(count($color)==($i+1))
                $color_title .= $color[$i];
            else
                $color_title .= $color[$i].",";
        }
    }

	if($id){
		$sql="update `gsw_product` set `category`='{$catego}',`title`='{$title}',`en_title`='{$en_title}',`preorder`= '{$preorder}',`color_title`= '{$color_title}',`specinfo`= '{$specInfo}',`orderlink`='{$orderlink}',`orderlink2`='{$orderlink2}',`orderlink3`='{$orderlink3}',`out`='{$out}',`show`='{$show}',`calling_plan`='{$call_plan}',`content`='{$content}'  where `id`='{$id}';";
	}else{
		$sql="insert into `gsw_product` (`category`,`title`,`en_title`,`specinfo`,`number`,`out`,`show`,`photo`,`photo1`,`photo2`,`photo3`,`photo4`,`content`,`datetime`,`order`,`preorder`,`orderlink`,`orderlink2`,`orderlink3`,`calling_plan`,`color_title`) VALUES ('{$catego}','{$title}','{$en_title}','{$specInfo}','{$number}','{$out}','{$show}','{$photos}','{$photos1}','{$photos2}','{$photos3}','{$photos4}','{$content}',NOW(),'$order','{$preorder}','{$orderlink}','{$orderlink2}','{$orderlink3}','{$call_plan}','{$color_title}');";
	}

	sql_query($sql);
	alert('저장되었습니다.',G5_URL."/admin/product.php?page=".$page."&category=".$category."&sub_category=".$sub_category);
?>