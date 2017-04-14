<?php
	include_once("../common.php");
	include_once(G5_EDITOR_LIB);
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$view=sql_fetch("select * from `gsw_product` where id='".$id."'");
	}
$color = explode(",",$view["color_title"]);
$image = explode(",",$view["photo"]);
$image1 = explode(",",$view["photo1"]);
$image2 = explode(",",$view["photo2"]);
$image3 = explode(",",$view["photo3"]);
$image4 = explode(",",$view["photo4"]);


?>
<style type="text/css">
	.sound_only,.cke_sc{display:none;}
</style>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>제품관리</h1>
			<hr />
		</header>
		<article id="admin_academy_write">
			<div class="adm-table02">
				<table>
                    <tr>
                        <th>노출 순서 *</th>
                        <td>
                            <?php echo $view['order']; ?>
                        </td>
                    </tr>
					<tr>
						<th>제품명 *</th>
						<td>
							<?php echo $view['title']; ?>
						</td>
					</tr>
					<tr>
						<th>모델명 *</th>
						<td>
							<?php echo $view['en_title']; ?>
						</td>
					</tr>
                    <tr>
                        <th>색상</th>
                        <td>
                            <table>
                                <?php
                                for($i=0;$i<count($color);$i++) {

                                    $img[$i][0] = $image1[$i];
                                    $img[$i][1] = $image2[$i];
                                    $img[$i][2] = $image3[$i];
                                    $img[$i][3] = $image4[$i];

                                    ?>
                                    <tr>
                                        <th>색상</th>
                                        <td><?=$color[$i]?></td>
                                    </tr>
                                    <tr>
                                        <th>이미지</th>
                                        <td>
                                                <?php
                                                for($j=0;$j<count($img[$i]);$j++){
                                                ?>
                                                    <img src="<?php echo G5_DATA_URL;?>/product/<?php echo trim($img[$i][$j]);?>" alt="제품사진" style="width: 20%">
                                                <?php
                                                }
                                                ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>제품 스펙</th>
                        <td>
                            <table>
                                <?php
                                $specs = explode("||",$view["specinfo"]);
                                for($i=0;$i<count($specs);$i++){
                                    $specinfo = explode("##",$specs[$i]);
                                    ?>
                                    <tr>
                                        <th><?=$specinfo[0]?></th>
                                        <td><?=$specinfo[1]?></td>
                                    </tr>
                                    <?
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
					<tr>
						<th>리스트 노출</th>
						<td>
							<?php echo $view['show']!=""&&$view['show']==1?"노출":"숨기기"; ?>
						</td>
					</tr>
                    <tr>
                        <th>품절</th>
                        <td>
                            <?php echo $view['out']!=""&&$view['out']==0?"-":"품절"; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>사전예약신청</th>
                        <td>
                            <?php echo $view['preorder']!=""&&$view['preorder']==0?"-":"사전예약중"; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>요금제</th>
                        <td>
                            <table>
                                <tr>
                                    <th>요금제명</th>
                                    <th>기본료</th>
                                    <th>음성</th>
                                    <th>SMS</th>
                                    <th>제공데이터</th>
                                </tr>

                                <?php
                                $callplans = explode("||",$view["calling_plan"]);
                                for($i=0;$i<count($callplans);$i++){
                                    $callp = explode("##",$callplans[$i]);
                                    ?>
                                    <tr>
                                        <td><?=$callp[0]?></td>
                                        <td><?=$callp[1]?></td>
                                        <td><?=$callp[2]?></td>
                                        <td><?=$callp[3]?></td>
                                        <td><?=$callp[4]?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
					<tr>
                        <th>신청링크</th>
                        <td>
                            <?php echo $view["orderlink"];?>
                        </td>
                    </tr>
					<tr>
						<th>상세정보</th>
						<td>
							<?php echo $view['content']; ?>
						</td>
					</tr>
				</table>
			</div>
			<div class="text-center mt20">
				<a href="<?php echo G5_URL."/admin/product.php?page=".$page."&category=".$category."&sub_category=".$sub_category; ?>" class="adm-btn01 bg_gray" >목록</a>
				<a href="<?php echo G5_URL."/admin/product_write.php?id=".$id."&page=".$page."&category=".$category."&sub_category=".$sub_category; ?>" class="adm-btn01" >수정</a>
			</div>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
