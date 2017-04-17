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
	$weight=$_POST['weight'];
	$related=$_POST['related'];
	$color = $_POST["color"];
	$orderlink=$_POST['orderlink'];
	$orderlink2=$_POST['orderlink2'];
	$orderlink3=$_POST['orderlink3'];
	$callplan = $_POST["callplan"];
	$callprice = $_POST["price"];
	$callvoice = $_POST["voice"];
	$callsms = $_POST["sms"];
	$calldata = $_POST["data"];

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

	if($id){
		$sql = "SELECT * FROM `gsw_product` where `id` = {$id}";
		$data = sql_fetch($sql);
		if($data["photo"]){
			$image = explode(",",$data["photo"]);
			$image1 = explode(",",$data["photo1"]);
			$image2 = explode(",",$data["photo2"]);
			$image3 = explode(",",$data["photo3"]);
			$image4 = explode(",",$data["photo4"]);

			for($i=0;$i<count($image);$i++){
				$img[$i][0]=$image1[$i];
				$img[$i][1]=$image2[$i];
				$img[$i][2]=$image3[$i];
				$img[$i][3]=$image4[$i];
			}
		}
	}

    for($i=0;$i<count($photo["tmp_name"]);$i++) {
		if ($_FILES["photo"]['tmp_name'][$i]) {
			if (count($photo["tmp_name"]) == ($i + 1)) {
                $photos .= $filename1 . "_product_" . $i . ".jpg";
                $path1=$dir."/".$filename1 . "_product_" . $i . ".jpg";
            } else {
                $photos .= $filename1 . "_product_" . $i . ".jpg, ";
                $path1=$dir."/".$filename1 . "_product_" . $i . ".jpg";
            }
			image_resize_update($_FILES["photo"]['tmp_name'][$i],$_FILES["photo"]['name'][$i], $path1, 850);
			if($id){
				sql_query("update `gsw_product` set `photo`='{$photos}' where `id`='{$id}';");
			}
			if($img[$i][0]){
				@unlink($dir."/".$img[$i][0]);
			}
		}
		if ($_FILES["photo1"]['tmp_name'][$i]) {
			if (count($photo1["tmp_name"]) == ($i + 1)) {
                $photos1 .= $filename1 . "_product1_" . $i . ".jpg";
                $path2=$dir."/".$filename1 . "_product1_" . $i . ".jpg";
            } else {
                $photos1 .= $filename1 . "_product1_" . $i . ".jpg, ";
                $path2=$dir."/".$filename1 . "_product1_" . $i . ".jpg";
            }
			image_resize_update($_FILES["photo1"]['tmp_name'][$i],$_FILES["photo1"]['name'][$i], $path2, 850);
			if($id){
				sql_query("update `gsw_product` set `photo1`='{$photos1}' where `id`='{$id}';");
			}
			if($img[$i][1]){
				@unlink($dir."/".$img[$i][0]);
			}
		}
		if ($_FILES["photo2"]['tmp_name'][$i]) {
			if (count($photo2["tmp_name"]) == ($i + 1)) {
                $photos2 .= $filename1 . "_product2_" . $i . ".jpg";
                $path3=$dir."/".$filename1 . "_product2_" . $i . ".jpg";
            } else {
                $photos2 .= $filename1 . "_product2_" . $i . ".jpg, ";
                $path3=$dir."/".$filename1 . "_product2_" . $i . ".jpg";
            }
            image_resize_update($_FILES["photo2"]['tmp_name'][$i],$_FILES["photo2"]['name'][$i], $path3, 850);
			if($id){
				sql_query("update `gsw_product` set `photo2`='{$photos2}' where `id`='{$id}';");
			}
			if($img[$i][2]){
				@unlink($dir."/".$img[$i][0]);
			}
		}
		if ($_FILES["photo3"]['tmp_name'][$i]) {
			if (count($photo3["tmp_name"]) == ($i + 1)) {
                $photos3 .= $filename1 . "_product3_" . $i . ".jpg";
                $path4=$dir."/".$filename1 . "_product3_" . $i . ".jpg";
            } else {
                $photos3 .= $filename1 . "_product3_" . $i . ".jpg, ";
                $path4=$dir."/".$filename1 . "_product3_" . $i . ".jpg";
            }
            image_resize_update($_FILES["photo3"]['tmp_name'][$i],$_FILES["photo3"]['name'][$i], $path4, 850);
			if($id){
				sql_query("update `gsw_product` set `photo3`='{$photos3}' where `id`='{$id}';");
			}
			if($img[$i][3]){
				@unlink($dir."/".$img[$i][0]);
			}
		}
		if ($_FILES["photo4"]['tmp_name'][$i]) {
			if (count($photo4["tmp_name"]) == ($i + 1)) {
                $photos4 .= $filename1 . "_product4_" . $i . ".jpg";
                $path5=$dir."/".$filename1 . "_product4_" . $i . ".jpg";
            } else {
                $photos4 .= $filename1 . "_product4_" . $i . ".jpg, ";
                $path5=$dir."/".$filename1 . "_product4_" . $i . ".jpg";
            }
            image_resize_update($_FILES["photo4"]['tmp_name'][$i],$_FILES["photo4"]['name'][$i], $path5, 850);
			if($id){
				sql_query("update `gsw_product` set `photo4`='{$photos4}' where `id`='{$id}';");
			}
			if($img[$i][4]){
				@unlink($dir."/".$img[$i][0]);
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
                $call_plan .= $callingplan[$i]."##".$price[$i]."##".$voice[$i]."##".$sms[$i]."##".$data[$i];
            else
                $call_plan .= $callingplan[$i]."##".$price[$i]."##".$voice[$i]."##".$sms[$i]."##".$data[$i]."||";
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
		$sql="insert into `gsw_product` (`category`,`title`,`en_title`,`info`,`number`,`out`,`show`,`hospital`,`persnal`,`price`,`weight`,`code_sale`,`related_product`,`photo`,`photo1`,`photo2`,`photo3`,`photo4`,`content`,`datetime`,`order`,`orderlink`,`orderlink2`,`orderlink2`) VALUES ('{$catego}','{$title}','{$en_title}','{$info}','{$number}','{$out}','{$show}','{$hospital}','{$persnal}','{$price}','{$weight}','{$code_sale}','{$related_product}','{$photos}','{$photos1}','{$photo2}','{$photos3}','{$photos4}','{$content}',NOW(),'$order','{$orderlink}','{$orderlink2}','{$orderlink3}');";
	}

	sql_query($sql);
	alert('저장되었습니다.',G5_URL."/admin/product.php?page=".$page."&category=".$category."&sub_category=".$sub_category);
?>