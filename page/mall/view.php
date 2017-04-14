<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
if(!$category){
	$category=$cate[0]['cate'];
}
if(!$id)
	alert('잘못된 접근입니다.');

//조회수 업
sql_query("update `gsw_product` set `hit` = `hit`+1 where `id` = {$id}");

$sql="select *,(select sum(number) from `gsw_sell` as s where p.id=s.product_id and s.status<>'-1') as sell from `gsw_product` as p where `show`<>'0' and `id`='{$id}'";
$view=sql_fetch($sql);
if(!$view['id'])
	alert('제품을 찾을 수 없습니다.');

$url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
$gsw_config=sql_fetch("select * from `gsw_config`");

$sql="select COUNT(*) as cnt from `g5_write_inquiry` where wr_1= ".$view["id"];
$inquiry = sql_fetch($sql);
$inquiryCnt = $inquiry['cnt'];

$sql="select COUNT(*) as cnt from `g5_write_review` where wr_1= ".$view["id"];
$review = sql_fetch($sql);
$reviewCnt = $review['cnt'];

$mobile_agent = array("Iphone","Ipod","Ipad","Android","Blackberry","SymbianOS|SCH-M\d+","Opera Mini", "Windows ce", "Nokia", "sony" );
$check_mobile = false;
for($i=0; $i<sizeof($mobile_agent); $i++){
    if(stripos( $_SERVER['HTTP_USER_AGENT'], $mobile_agent[$i] )){
        $check_mobile = true;
        break;
    }
}

?>

<section class="section01">
	<article id="mall_view">
		<div class="width-fixed">
			<div class="top">
                <div class="txt">
                    <div class="info">
                        <div class="title">
                            <h2><?php echo $view['title']; ?></h2>
                            <h3><?php echo $view['en_title']; ?></h3>
                        </div>
                        <div class="contact">
                            <ul>
                                <li <?php if($check_mobile){ ?>onclick="location.href='tel:1670-5370';"<?php }else{?> onclick="alert('모바일에서 가능합니다.')" <?php }?>><img src="<?php echo G5_IMG_URL;?>/call_icon.png" alt="전화상담" >전화 상담 신청하기</li>
                                <li onclick="location.href='#inquiry';"><img src="<?php echo G5_IMG_URL;?>/inquiry_btn.png" alt="상품문의">상품문의하기</li>
                            </ul>
                        </div>
                    </div>
                </div>
				<div class="img datainput">

				</div>
                <?php
                if($view["color_title"]){
                ?>
                <div class="choiceColor">
                    <h3>색상선택</h3>
                    <ul class="colorsel">
                        <?php
                        $color = explode(",",$view["color_title"]);
                        for($i=0;$i<count($color);$i++){
                            ?>
                            <li><input type="button"  class="color<?=$i?>" style="border:none;background:#eee;color:#222;border-radius: 3px;padding:10px 13px;" value="<?=$color[$i]?>"></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <?php
                }
                ?>
                <div class="buy">
                    <div class="btn_group">
                        <input type="button" value="신청하기" class="lg_btn01 grid_100" onclick="window.open('<?php echo $view["orderlink"]; ?>','_new')"/>
                    </div>
                </div>
			</div>
            <div class="detailView">
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
                <div class="viewMenu" >
                    <ul class="tab" id="callplan">
                        <li class="first active" onclick="location.href='#callplan';">요금제안내</li>
                        <li onclick="location.href='#productinfo';">상품정보</li>
                        <li onclick="location.href='#register';">가입절차안내</li>
                        <li onclick="location.href='#inquiry';">상품문의 [<?php echo $inquiryCnt;?>]</li>
                        <li class="last" onclick="location.href='#review';" >개통후기 [<?php echo $reviewCnt;?>]</li>
                    </ul>
                    <div>
                        <table style="margin-top:20px;">
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
                        <img class="card" src="<?php echo G5_IMG_URL?>/card_bg.jpg" alt="카드할인정보">
                    </div>
                    <ul class="tab" id="productinfo">
                        <li class="first " onclick="location.href='#callplan';">요금제안내</li>
                        <li class="active" onclick="location.href='#productinfo';">상품정보</li>
                        <li onclick="location.href='#register';">가입절차안내</li>
                        <li onclick="location.href='#inquiry';">상품문의 [<?php echo $inquiryCnt;?>]</li>
                        <li class="last" onclick="location.href='#review';">개통후기 [<?php echo $reviewCnt;?>]</li>
                    </ul>
                    <div >
                        <?=$view["content"]?>
                    </div>
                    <ul class="tab" id="register">
                        <li class="first " onclick="location.href='#callplan';">요금제안내</li>
                        <li  onclick="location.href='#productinfo';">상품정보</li>
                        <li class="active" onclick="location.href='#register';">가입절차안내</li>
                        <li onclick="location.href='#inquiry';">상품문의[<?php echo $inquiryCnt;?>]</li>
                        <li class="last" onclick="location.href='#review';">개통후기 [<?php echo $reviewCnt;?>]</li>
                    </ul>
                    <div >
                        <img src="<?php echo G5_IMG_URL?>/call_plan_img.jpg" alt="가입절차안내">
                    </div>
                    <ul class="tab" id="inquiry">
                        <li class="first " onclick="location.href='#callplan';">요금제안내</li>
                        <li onclick="location.href='#productinfo';">상품정보</li>
                        <li onclick="location.href='#register';">가입절차안내</li>
                        <li class="active" onclick="location.href='#inquiry';">상품문의 [<?php echo $inquiryCnt;?>]</li>
                        <li class="last" onclick="location.href='#review';">개통후기 [<?php echo $reviewCnt;?>]</li>
                    </ul>
                    <div>
                        <div class="inquiry-list"></div>

                    </div>
                    <ul class="tab" id="review">
                        <li class="first " onclick="location.href='#callplan';">요금제안내</li>
                        <li onclick="location.href='#productinfo';">상품정보</li>
                        <li onclick="location.href='#register';">가입절차안내</li>
                        <li onclick="location.href='#inquiry';">상품문의 [<?php echo $inquiryCnt;?>]</li>
                        <li class="active" class="last" onclick="location.href='#review';">개통후기 [<?php echo $reviewCnt;?>]</li>
                    </ul>
                    <div >
                        <div class="review-list"></div>
                    </div>
                </div>
            </div>
		</div>
	</article>
</section>
<script type="text/javascript">
	$(document).ready(function () {
        $.ajax({
            url:"./ajax.product.php",
            method:"POST",
            data:{id:"<?=$id?>",color:0},
            dataType:"html"
        }).done(function(html) {
            $(".datainput").html(html);
            $.ajax({
                url:"./ajax.inquiry.list.php",
                method:"POST",
                data:{wr_1:"<?=$id?>"},
                dataType:"html"
            }).done(function(html) {
                $(".inquiry-list").html(html);
            });
            $.ajax({
                url:"./ajax.review.list.php",
                method:"POST",
                data:{wr_1:"<?=$id?>"},
                dataType:"html"
            }).done(function(html) {
                $(".review-list").html(html);
            });
        });



        $("input[class^=color]").each(function () {
            $(this).click(function () {
                var num = $(this).attr("class").replace("color","");
                $.ajax({
                    url:"./ajax.product.php",
                    method:"POST",
                    data:{id:"<?=$id?>",color:num},
                    dataType:"html"
                }).done(function(html) {
                    $(".datainput").html(html);
                })
            })
        })
    })

</script>
<?php
include_once(G5_PATH.'/tail.php');
?>
