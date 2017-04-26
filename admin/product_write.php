<?php
	include_once("../common.php");
	include_once(G5_EDITOR_LIB);
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$write=sql_fetch("select * from `gsw_product` where id='".$id."'");
	}
	$sql="select * from `gsw_category` order by `od` asc";
	$query=sql_query($sql);
	while($data=sql_fetch_array($query)){
		$cate[]=$data;
	}
	$sql="select * from `gsw_sub_category` order by `od` asc";
	$query=sql_query($sql);
	while($data=sql_fetch_array($query)){
		$cate2[]=$data;
	}
	$sql="select * from `gsw_code` order by `id` desc";
	$query=sql_query($sql);
	while($data=sql_fetch_array($query)){
		$code[]=$data;
	}
	$sql="select * from `gsw_product` where `id`<>'{$id}' order by `id` desc";
	$query=sql_query($sql);
	while($data=sql_fetch_array($query)){
		$prod[]=$data;
	}
	$editor_html = editor_html('content', $write['content'], 1);
	$editor_js = '';
	$editor_js .= get_editor_js('content', 1);
	$editor_js .= chk_editor_js('content', 1);
	$write['code_sale_array']=explode("||",$write['code_sale']);
	$write['related_product_array']=explode("|",$write['related_product']);
	$write['category_arr']=explode("|",$write['category']);
	for($i=0;$i<count($write['code_sale_array']);$i++){
		$write['code_sale_array'][$i]=explode("|",$write['code_sale_array'][$i]);
	}
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
			<form action="<?php echo G5_URL."/admin/product_update.php"; ?>" onsubmit="return product_write_form(this);" name="product_form" id="product_form" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<input type="hidden" name="category" value="<?php echo $category; ?>" />
				<input type="hidden" name="sub_category" value="<?php echo $sub_category; ?>" />
                <input type="hidden" name="ori_photo" value="<?php echo $write["photo"]; ?>">
                <input type="hidden" name="ori_photo1" value="<?php echo $write["photo1"]; ?>">
                <input type="hidden" name="ori_photo2" value="<?php echo $write["photo2"]; ?>">
                <input type="hidden" name="ori_photo3" value="<?php echo $write["photo3"]; ?>">
                <input type="hidden" name="ori_photo4" value="<?php echo $write["photo4"]; ?>">
                <input type="hidden" name="delRow" id="delRow" value="" >
				<div class="adm-table02">
					<table>
                        <tr>
                            <th>노출 순서 *</th>
                            <td>
                                <input type="text" name="order" required id="order" class="adm-input01 grid_100" value="<?php echo $write['order']?$write['order']:"0"; ?>" />
                                <p>숫자가 작을수록 앞에 노출됩니다. 숫자 -2147483648에서 214748364까지 입력 하실수 있습니다.</p>
                            </td>
                        </tr>
						<tr>
							<th>제품명 *</th>
							<td>
								<input type="text" name="title" required id="title" class="adm-input01 grid_100" value="<?php echo $write['title']; ?>" />
							</td>
						</tr>
						<tr>
							<th>모델명 *</th>
							<td>
								<input type="text" name="en_title" required id="en_title" class="adm-input01 grid_100" value="<?php echo $write['en_title']; ?>" />
							</td>
						</tr>
						<!--<tr>
							<th>대분류1 *</th>
							<td>
								<div class="cate_div">
								<?php
/*								if($write['category']){
									for($i=0;$i<count($write['category_arr']);$i++){
										if($i==0)
											$required="required";
								*/?>
								<select name="cate[]" <?php /*echo $required; */?> class="adm-input01 grid_100">
									<option value="">선택</option>
									<?php /*for($j=0;$j<count($cate);$j++){ */?>
									<option value="<?php /*echo $cate[$j]['cate']; */?>" <?php /*echo $cate[$j]['cate']==$write['category_arr'][$i]?"selected":""; */?>><?php /*echo $cate[$j]['cate']; */?></option>
									<?php /*} */?>
								</select>
								<?php
/*									}
								}else{
								*/?>
								<select name="cate[]" required class="adm-input01 grid_100">
									<option value="">선택</option>
									<?php /*for($j=0;$j<count($cate);$j++){ */?>
									<option value="<?php /*echo $cate[$j]['cate']; */?>" <?php /*echo $cate[$j]['cate']==$write['category']?"selected":""; */?>><?php /*echo $cate[$j]['cate']; */?></option>
									<?php /*} */?>
								</select>
								<?php /*} */?>
								</div>
								<div class="text-right small_btn_group">
									<a href="javascript:cate_add();" style="width:50px;margin-top:3px;" class="bg_gray white btn lh30">추가</a>
									<a href="javascript:cate_del();" style="width:50px;margin-top:3px;" class="bg_gray white btn lh30">삭제</a>
								</div>
							</td>
						</tr>-->

                        <tr>
                            <th>색상 *</th>
                            <td class="color">
                                <a style="width:50px;cursor: pointer" class="addColor bg_gray white btn lh30">추가</a>
                                <?php
                                $color = explode(",",$write["color_title"]);
                                $photo = explode(",",$write["photo"]);
                                if(count($color)>0) {
                                    for($i=0;$i<count($color);$i++){
                                    ?>
                                    <table class="table1">
                                        <colgroup>
                                            <col width="20%">
                                            <col width="70%">
                                            <col width="10%">
                                        </colgroup>
                                        <tr>
                                            <th>색상</th>
                                            <td><input type="text" name="color[]" class="adm-input01 grid_100" value="<?php echo $color[$i];?>"></td>
                                            <td rowspan="3" style="text-align: center"><a style="width:50px;cursor: pointer" class="delColor bg_gray white btn lh30" id="delc<?=$i?>">삭제</a></td>
                                        </tr>
                                        <tr>
                                            <th>제품 메인 사진 *</th>
                                            <td>
                                                <?php
                                                if($photo[$i]){ echo $photo[$i];}
                                                ?>
                                                <input type="file" name="photo[]"
                                                       id="photo" <?php echo $write['id'] ? "" : "required"; ?> />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>제품 사진 *</th>
                                            <td>
                                                <input type="file" name="photo1[]"
                                                       id="photo1" <?php echo $write['id'] ? "" : "required"; ?> /> 정면
                                                <br>
                                                <input type="file" name="photo2[]"
                                                       id="photo2" <?php echo $write['id'] ? "" : "required"; ?> /> 측면
                                                <br>
                                                <input type="file" name="photo3[]"
                                                       id="photo3" <?php echo $write['id'] ? "" : "required"; ?> /> 후면
                                                <br>
                                                <input type="file" name="photo4[]"
                                                       id="photo4" <?php echo $write['id'] ? "" : "required"; ?> /> 기타
                                            </td>
                                        </tr>
                                    </table>
                                    <?php
                                    }
                                }
                                ?>
                            </td>
                        </tr>
						<tr>
							<th>제품 스팩 *</th>
							<td>
                                <table class="spec">
                                    <colgroup>
                                        <col width="20%">
                                        <col width="60%">
                                        <col width="20%">
                                    </colgroup>
                                    <tr>
                                        <th>스팩명</th>
                                        <th>내용</th>
                                        <th><a style="width:50px;cursor: pointer" class="addSpec bg_gray white btn lh30">추가</a></th>
                                    </tr>
                                    <?php
                                    $spec_title = explode("||",$write["specinfo"]);
                                    if(count($spec_title)>0) {
                                        for($i=0;$i<count($spec_title);$i++){
                                            $specs = explode("##", $spec_title[$i]);
                                        ?>
                                        <tr class="items<?= $i + 1 ?>">
                                            <td><input type="text" name="spec[]" class="adm-input01 grid_100" value="<?=$specs[0]?>"></td>
                                            <td><input type="text" name="specCon[]" class="adm-input01 grid_100" value="<?=$specs[1]?>"></td>
                                            <td><a style="width:50px;cursor: pointer" class="delSpec bg_gray white btn lh30">삭제</a></td>
                                        </tr>
                                        <?php
                                        }
                                    }
                                    ?>
                                </table>
								<!--<textarea name="info" id="info" cols="30" rows="10" class="adm-input01 grid_100" style="height:100px;" required><?php /*echo strip_tags($write['info']); */?></textarea>-->
							</td>
						</tr>
						<tr>
							<th>리스트 노출</th>
							<td>
								<label for="show"><input type="checkbox" name="show" id="show" value="1" <?php echo $write['show']!=""&&$write['show']==0?"":"checked"; ?> /> 보이기</label>
							</td>
						</tr>
						<tr>
							<th>품절</th>
							<td>
								<label for="out"><input type="checkbox" name="out" id="out" value="1" <?php echo $write['out']!=""&&$write['out']==1?"checked":""; ?> /> 품절</label>
							</td>
						</tr>
                        <tr>
                            <th>사전예약</th>
                            <td>
                                <label for="preorder"><input type="checkbox" name="preorder" id="preorder" value="1" <?php echo $write['preorder']!=""&&$write['preorder']==1?"checked":""; ?> /> 사전예약신청중</label>
                            </td>
                        </tr>
						<tr>
							<th>요금제등록 *</th>
							<td>
                                <table class="calling">
                                    <tr>
                                        <th>요금제명</th>
                                        <th>기본료</th>
                                        <th>음성(망내/망외)</th>
                                        <th>SMS</th>
                                        <th>제공데이터</th>
                                        <th style="text-align: center"><a style="width:50px;cursor: pointer"  class="addRow bg_gray white btn lh30">추가</a></th>
                                    </tr>
                                    <?php
                                    $call_plan = explode("||",$write["calling_plan"]);
                                    if(count($call_plan)>0) {
                                        for($i=0;$i<count($call_plan);$i++){
                                            $call = explode("##" , $call_plan[$i]);
                                        ?>
                                        <tr class="item<?=$i+1?>">
                                            <td><input type="text" name="callingplan[]" class="adm-input01 grid_100" value="<?php echo $call[0]; ?>">
                                            </td>
                                            <td><input type="text" name="price[]" class="adm-input01 grid_100" value="<?php echo $call[1]; ?>"></td>
                                            <td><input type="text" name="voice[]" class="adm-input01 grid_100" value="<?php echo $call[2]; ?>"></td>
                                            <td><input type="text" name="sms[]" class="adm-input01 grid_100" value="<?php echo $call[3]; ?>"></td>
                                            <td><input type="text" name="data[]" class="adm-input01 grid_100" value="<?php echo $call[4]; ?>"></td>
                                            <td style="text-align: center"><a style="width:50px;cursor: pointer" class="delRow bg_gray white btn lh30">삭제</a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                    }
                                    ?>
                                </table>
								<!--<input type="text" name="price" required id="price" class="adm-input01 grid_100" value="<?php /*/*echo $write['price']; */?>" onkeyup="return number_only(this);" />-->
							</td>
						</tr>
						<tr>
							<th>신청링크 *</th>
							<td>
								신규가입 : <input type="text" name="orderlink" required id="orderlink" class="adm-input01 grid_100" value="<?php echo $write['orderlink']; ?>" />
								번호이동 : <input type="text" name="orderlink2" required id="orderlink2" class="adm-input01 grid_100" value="<?php echo $write['orderlink2']; ?>" />
								기기변경 : <input type="text" name="orderlink3" required id="orderlink3" class="adm-input01 grid_100" value="<?php echo $write['orderlink3']; ?>" />
							</td>
						</tr>

						<!--<tr>
							<th>관련상품</th>
							<td>
								<div class="related_product">
									<?php
/*									if($write['related_product']){
										for($i=0;$i<count($write['related_product_array']);$i++){
									*/?>
									<select name="related[]" id="related[]" class="adm-input01 grid_100">
										<option value="">선택</option>
										<?php /*for($j=0;$j<count($prod);$j++){ */?>
										<option value="<?php /*echo $prod[$j]['id']; */?>" <?php /*echo $prod[$j]['id']==$write['related_product_array'][$i]?"selected":""; */?>><?php /*echo $prod[$j]['title']; */?></option>
										<?php /*} */?>
									</select>
									<?php
/*										}
									}else{
									*/?>
									<select name="related[]" id="related[]" class="adm-input01 grid_100">
										<option value="">선택</option>
										<?php /*for($j=0;$j<count($prod);$j++){ */?>
										<option value="<?php /*echo $prod[$j]['id']; */?>"><?php /*echo $prod[$j]['title']; */?></option>
										<?php /*} */?>
									</select>
									<?php /*} */?>
								</div>
								<div class="text-right small_btn_group">
									<a href="javascript:related_product_add();" style="width:50px;margin-top:3px;" class="bg_gray white btn lh30">추가</a>
									<a href="javascript:related_product_del();" style="width:50px;margin-top:3px;" class="bg_gray white btn lh30">삭제</a>
								</div>
							</td>
						</tr>-->
						<tr>
							<th>상세정보</th>
							<td style="background:#fff;padding:0;">
								<?php echo $editor_html; ?>
							</td>
						</tr>
						<tr>
							<th>* 영상올리는법</th>
							<td>
								스마트에디터의 하단 html 버튼을 누른후 아래 코드에 유튜브 소스 코드를 추가하여 붙여넣기하여 동영상 적용<br>
								<?php 
								echo "&lt;style&gt;<br>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; height: auto; }<br>.embed-container iframe,.embed-container object,.embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }<br>	&lt;/style&gt;<br>&lt;div class='embed-container'&gt;<br>유튜브 소스 코드<br>&lt;/div&gt;";
								?>
							</td>
						</tr>
					</table>
				</div>
				<div class="text-center mt20">
					<input type="submit" id="btn_submit" value="확인" class="adm-btn01" />
				</div>
			</form>
		</article>
	</section>
</div>
<script type="text/javascript">
	function product_write_form(f){
		<?php echo $editor_js;  ?>
		document.getElementById("btn_submit").disabled = "disabled";
		return true;
	}
	function cate_chage(){
		var cate=$("#cate").val();
		var len=$("#sub_cate option").length;
		for(i=1;i<len;i++){
			var data_cate=$("#sub_cate option").eq(i).attr("data-cate");
			if(data_cate!=cate){
				$("#sub_cate option").eq(i).hide();
			}else{
				$("#sub_cate option").eq(i).show();
			}
		}
	}
	function code_sale_add(){
		var div=$(".code_sale_div");
		var day=$(".code_sale_div > div").length;
		div.find("div:last").clone().appendTo(div);
	}
	function code_sale_del(){
		var div=$(".code_sale_div");
		var len=$(".code_sale_div > div").length;
		if(len<=1){
			alert("더이상 삭제하실수 없습니다.");
		}else{
			div.find('div:last').remove();
		}
	}
	function related_product_add(){
		var div=$(".related_product");
		var day=$(".related_product > select").length;
		div.find("select:last").clone().appendTo(div);
	}
	function related_product_del(){
		var div=$(".related_product");
		var len=$(".related_product > select").length;
		if(len<=1){
			alert("더이상 삭제하실수 없습니다.");
		}else{
			div.find('select:last').remove();
		}
	}
	function cate_add(){
		var div=$(".cate_div");
		var day=$(".cate_div > select").length;
		div.find("select:last").clone().appendTo(div);
	}
	function cate_del(){
		var div=$(".cate_div");
		var len=$(".cate_div > select").length;
		if(len<=1){
			alert("더이상 삭제하실수 없습니다.");
		}else{
			div.find('select:last').remove();
		}
	}
    $(document).on("click",".addColor",function () {
        // item 의 최대번호 구하기
        var lastItemNo = $(".color table:last").attr("class").replace("table", "");
        var newitem = $(".color table:eq(0)").clone();
        newitem.removeClass();
        //newitem.find("td:eq(0)").attr("rowspan", "1");
        newitem.addClass("s"+(parseInt(lastItemNo)+1));

        $(".color").append(newitem);
    })
    $(document).on("click",".delColor",function () {
        var lastItemNo = $(".color table").length;
        var row = $(this).attr("id").replace("delc","");
        var delRow = $("#delRow").val();
        if(delRow)
            $("#delRow").val(delRow+","+row);
        else
            $("#delRow").val(row);
        if(lastItemNo<=1){
            alert("최소 1개 정보는 입력하셔야 합니다.");
        }else {
            var clickedRow = $(this).parent().parent().parent().parent();
            var cls = clickedRow.attr("class");

            // 각 항목의 첫번째 row를 삭제한 경우 다음 row에 td 하나를 추가해 준다.
            if (clickedRow.find("table:eq(0)").attr("rowspan")) {
                if (clickedRow.next().hasClass(cls)) {
                    clickedRow.next().prepend(clickedRow.find("td:eq(0)"));
                }
            }

            clickedRow.remove();
        }
    })

    $(document).on("click",".addSpec",function () {
        // item 의 최대번호 구하기
        var lastItemNo = $(".spec tr:last").attr("class").replace("items", "");

        var newitem = $(".spec tr:eq(1)").clone();
        newitem.removeClass();
        newitem.find("td:eq(0)").attr("rowspan", "1");
        newitem.addClass("s"+(parseInt(lastItemNo)+1));

        $(".spec").append(newitem);
    })
    $(document).on("click",".delSpec",function () {
        var lastItemNo = $(".spec tr").length;
        if(lastItemNo<=2){
            alert("최소 1개 정보는 입력하셔야 합니다.");
        }else {
            var clickedRow = $(this).parent().parent();
            var cls = clickedRow.attr("class");

            // 각 항목의 첫번째 row를 삭제한 경우 다음 row에 td 하나를 추가해 준다.
            if (clickedRow.find("td:eq(0)").attr("rowspan")) {
                if (clickedRow.next().hasClass(cls)) {
                    clickedRow.next().prepend(clickedRow.find("td:eq(0)"));
                }
            }

            clickedRow.remove();
        }
    })

    $(document).on("click",".addRow",function () {
        // item 의 최대번호 구하기
        var lastItemNo = $(".calling tr:last").attr("class").replace("item", "");

        var newitem = $(".calling tr:eq(1)").clone();
        newitem.removeClass();
        newitem.find("td:eq(0)").attr("rowspan", "1");
        newitem.addClass("item"+(parseInt(lastItemNo)+1));

        $(".calling").append(newitem);
    })
    $(document).on("click",".delRow",function () {
        var lastItemNo = $(".calling tr").length;
        if(lastItemNo<=2){
            alert("최소 1개 정보는 입력하셔야 합니다.");
        }else {
            var clickedRow = $(this).parent().parent();
            var cls = clickedRow.attr("class");

            // 각 항목의 첫번째 row를 삭제한 경우 다음 row에 td 하나를 추가해 준다.
            if (clickedRow.find("td:eq(0)").attr("rowspan")) {
                if (clickedRow.next().hasClass(cls)) {
                    clickedRow.next().prepend(clickedRow.find("td:eq(0)"));
                }
            }
            clickedRow.remove();
        }
    })

</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
