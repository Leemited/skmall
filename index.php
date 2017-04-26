<?php
define('_INDEX_', true);
include_once('./_common.php');
$main=true;
// 초기화면 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_index'] && is_file(G5_PATH.'/'.$config['cf_include_index'])) {
    include_once(G5_PATH.'/'.$config['cf_include_index']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}
include_once('./_head.php');
$sql="SELECT * FROM  `gsw_banner` where status<> 0 and mb_id = '".$member["mb_id"]."' order by id asc";
$query=sql_query($sql);
while($data=sql_fetch_array($query)){
    $banner[]=$data;
}
if(defined('_INDEX_')) { // index에서만 실행
    include_once(G5_BBS_PATH.'/newwin.inc.php'); // 팝업레이어
}
$gsw_config=sql_fetch("select * from `gsw_config`");
?>
<!-- <div class="hidden lg_show">
	<a href="<?php echo G5_URL."/page/academy/application.php"; ?>">
		<img src="<?php echo G5_IMG_URL."/academy_banner.png"; ?>" alt="아카데미 온라인 수강 신청" />
	</a>
	<a href="<?php echo G5_URL."/page/concierge/"; ?>">
		<img src="<?php echo G5_IMG_URL."/concierge_banner.png"; ?>" alt="컨시어지 상담하러가기" />
	</a>
</div> -->
<?php if(count($banner)>0){ ?>
    <div id="main_slide" class="owl-carousel">
        <?php
        for($i=0;$i<count($banner);$i++){
            ?>
            <div class="item" style="background-image:url('<?php echo G5_DATA_URL."/banner/".$banner[$i]['banner']; ?>');"><?php if($banner[$i]['link']){ ?><a href="<?php echo $banner[$i]['link']; ?>" target="<?php echo $banner[$i]['target']; ?>"></a><?php } ?></div>
            <?php
        }
        ?>
    </div>
<?php } ?>
<div id="main_mall">
    <div class="width-fixed wrap">
        <h2></h2>
        <div class="allbtn"><input type="button" onclick="location.href='<?php echo G5_URL;?>/page/mall/list.php';" class="allview"/></div>
        <!--<div class="menu list">
			<ul>
				<?php /*for($i=0;$i<count($cate);$i++){ */?>
				<li><a href="<?php /*echo G5_URL."/page/mall/list.php?category=".urlencode($cate[$i]['cate']); */?>"><?php /*echo $cate[$i]['cate'];*/?></a></li>
				<?php /*} */?>
			</ul>
		</div>-->
        <!-- <div class="menu slide">
			<div class="owl-carousel">
				<?php for($i=0;$i<count($cate);$i++){ ?>
				<div class="item"><a href=" <?php echo G5_URL."/page/mall/list.php?category=".urlencode($cate[$i]['cate']); ?>"><?php echo $cate[$i]['cate'];?></a></div>
				<?php } ?>
			</div>
		</div> -->
    </div>
</div>
<div id="main_product">
    <div class="width-fixed wrap">
        <div>
            <?php //for($i=0;$i<count($cate);$i++){
            $sql="select *,(select sum(number) from `gsw_sell` as s where p.id=s.product_id and s.status<>'-1') as sell from `gsw_product` as p where `show`<>'0' order by `order` ,`id` desc limit 0,6";
            $list=array();
            $query=sql_query($sql);
            $j=0;
            while($data=sql_fetch_array($query)){
                $list[$j]=$data;
                $j++;
            }
            ?>
            <div class="list">
                <div>
                    <ul>
                        <?php
                        for($j=0;$j<count($list);$j++){
                            $class="";
                            if($j>=4)
                                $class="md_hidden";
                            $main_img = explode(",",$list[$j]["photo"]);
                            $sql="select COUNT(*) as cnt from `g5_write_review` where wr_1= ".$list[$j]["id"];
                            $review = sql_fetch($sql);
                            $reviewCnt = $review['cnt'];
                            ?>
                            <li<?php echo $class?" class='".$class."'":""; ?>>
                                <a href="<?php echo G5_URL."/page/mall/view.php?&id=".$list[$j]['id']."&category=".urlencode($cate[$i]['cate']); ?>">
                                    <?php if($list[$j]['out'] || ($list[$j]['number']-$list[$j]['sell'])<=0){ ?><div class="out"><i></i></div><?php } ?>
                                    <div class="img"><div><div><img src="<?php echo G5_DATA_URL."/product/".$main_img[0]; ?>" alt="<?php echo $list[$j]['title']; ?>" /></div></div></div>

                                    <div class="txt">
                                        <h3><?php echo $list[$j]['title']; ?></h3>
                                        <h4><?php echo $list[$j]['en_title']; ?></h4>
                                        <h5><?php if($list[$j]["preorder"]){echo "예약만 진행, 입고시순차진행";}?></h5>
                                        <p>리뷰(<?=$reviewCnt?>)</p>
                                    </div>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php //} ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        var owl1=$("#main_slide");
        var owl2=$("#main_mall .slide > div");
        owl1.owlCarousel({
            animateOut: 'fadeOut',
            autoplay:true,
            autoplayTimeout:5000,
            autoplaySpeed:2000,
            smartSpeed:2000,
            loop:true,
            dots:true,
            items:1
        });
        owl2.owlCarousel({
            autoplay:false,
            smartSpeed:2000,
            loop:true,
            items:3
        });
    });
</script>
<?php
include_once('./_tail.php');
?>
