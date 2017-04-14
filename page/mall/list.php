<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
/*if(!$category){
	$category=$cate[0]['cate'];
}*/
$ordertype = $_REQUEST["orderType"];
$where="";
$where2="";
$order ="order by  `order` asc, `id` desc";
if($searchtext = $_REQUEST["sch_text"]){
	$where.=" and (`title` like '%${searchtext}%' or `en_title` like '%${searchtext}%')";
}

if($ordertype)
    $order = "order by `".$ordertype."` asc";

$sql="select * from `gsw_category_banner` where 1 and cate='{$category}' {$order}";
$query=sql_query($sql);
while($data=sql_fetch_array($query)){
	$banner[]=$data;
}
$total=sql_fetch("select count(*) as cnt from `gsw_product` where `show`<>'0' {$where} {$order}");
if(!$page)
	$page=1;
$total=$total['cnt'];
$rows=12;
$start=($page-1)*$rows;
$total_page=ceil($total/$rows);
$sql="select *,(select sum(number) from `gsw_sell` as s where p.id=s.product_id and s.status<>'-1') as sell from `gsw_product` as p where `show`<>'0' {$where} {$order} limit {$start},{$rows}";
$query=sql_query($sql);
$j=0;
while($data=sql_fetch_array($query)){
	$list[$j]=$data;
	$j++;
}
$gsw_config=sql_fetch("select * from `gsw_config`");
?>
<section class="section01">
    <div class="width-fixed">
        <div class="listView" >
            <div class="total"><h3>총 <span class="bold"><?=$total?></span>개의 상품이 있습니다.</h3></div>
            <div class="align">
                <ul>
                    <li onclick="location.href='<?php echo G5_URL?>/page/mall/list.php?orderType=hit'">인기상품순</li>
                    <li onclick="location.href='<?php echo G5_URL?>/page/mall/list.php?orderType=datetime'">최근등록순</li>
                </ul>
                <div>
                    <div class="grid"></div>
                    <div class="list"></div>
                </div>
            </div>

        </div>
    </div>
    <div class="clear"></div>
	<!--<div class="width-fixed">
		<nav class="section01_nav">
			<ul class="<?php /*echo count($cate)==1?" list1":""; echo count($cate)>=3?" list3":""; */?>" style="width:100%;">
				<li<?php /*echo $category==""?" class='active'":"" */?><?php /*echo (count($cate)+1)>5?" style='width:".(100/(count($cate)+1))."%;'":"";*/?>><a href="<?php /*echo G5_URL."/page/mall/list.php"; */?>">全部商品</a></li>
				<?php /*for($i=0;$i<count($cate);$i++){ */?>
				<li<?php /*echo $cate[$i]['cate']==$category?" class='active'":"" */?><?php /*echo (count($cate)+1)>5?" style='width:".(100/(count($cate)+1))."%;'":"";*/?>><a href="<?php /*echo G5_URL."/page/mall/list.php?category=".urlencode($cate[$i]['cate']); */?>"><?php /*echo $cate[$i]['cate'];*/?></a></li>
				<?php /*} */?>
			</ul>
			<?php /*if(count($cate)>3){*/?>
				<div class="slide hidden lg_show owl-carousel">
				<?php /*for($i=0;$i<count($cate);$i++){ */?>
					<div class="item <?php /*echo $cate[$i]['cate']==$category?" act":""; */?>"><a href="<?php /*echo G5_URL."/page/mall/list.php?category=".urlencode($cate[$i]['cate']); */?>"><?php /*echo $cate[$i]['cate'];*/?></a></div>
				<?php /*} */?>
				</div>
			<?php /*} */?>
		</nav>
	</div>-->
	<?php if(count($banner)>0){ ?>
	<div class="mall_slide owl-carousel lg_show hidden">
		<?php for($i=0;$i<count($banner);$i++){ ?>
		<div class="item" style="background-image:url('<?php echo G5_DATA_URL."/cate_banner/".$banner[$i]['banner']; ?>');"></div>
		<?php } ?>
	</div>
	<?php } ?>
	<article class="section01_con wrap" id="mall_list">
		<div class="width-fixed">
			<div class="list01">
				<?php
				for($i=0;$i<count($list);$i++){

					$main_img = explode(",",$list[$i]["photo"]);
                    $sql="select COUNT(*) as cnt from `g5_write_review` where wr_1= ".$list[$i]["id"];
                    $review = sql_fetch($sql);
                    $reviewCnt = $review['cnt'];
                ?>
				<div class="item">
					<a href="<?php echo G5_URL."/page/mall/view.php?&id=".$list[$i]['id']."&category=".urlencode($list[$i]['category']); ?>">
						<?php if($list[$i]['out']){ ?><div class="out"><i></i></div><?php } ?>
						<div class="img"><div><div><img src="<?php echo G5_DATA_URL."/product/".$main_img[0]; ?>" alt="<?php echo $list[$i]['title']; ?>" /></div></div></div>
						<div class="txt">
                            <h3><?php echo $list[$i]['title']; ?></h3>
                            <h4><?php echo $list[$i]['en_title']; ?></h4>
                            <h5><?php if($list[$i]["preorder"]==1){echo "예약만 진행, 입고시순차진행"; }?></h5>
                            <p>리뷰(<?=$reviewCnt?>)</p>
                        </div>
                        <div class="listBtn">
                            <input type="button" class="listViewBtn" value="자세히보기">
                        </div>
					</a>
				</div>
				<?php
				}
				if(count($list)==0){
					echo "<div class='text-center grid_100 item' style='padding:150px 0;'>등록제품이 없습니다.</div>";
				}
				?>
			</div>
		</div>
		<nav class="next-list">
			<a href="<?php echo G5_URL."/page/mall/ajax.list.php?category=".urlencode($category)."&page=2"; ?>"></a>
		</nav>
	</article>
</section>
<script type="text/javascript" src="<?php echo G5_JS_URL."/isotope.pkgd.min.js"; ?>"></script>
<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo G5_JS_URL."/jquery.infinitescroll.js"; ?>"></script>
<script>
	$(function(){
		var owl1=$(".mall_slide");
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
		var $container = $('.list01').isotope({
			itemSelector: '.item',
			percentPosition: true,
			masonry: {
				// use outer width of grid-sizer for columnWidth
				columnWidth: '.item'
			}
		});
		$container.imagesLoaded().progress(function() {
			$container.isotope('layout');
		});
		$container.infinitescroll({
			navSelector  : '.next-list',    // selector for the paged navigation 
			nextSelector : '.next-list a',  // selector for the NEXT link (to page 2)
			itemSelector : '.item',// selector for all items you'll retrieve
			transitionDuration: '0.5s',
			loading: {
				finishedMsg: ' ',
				/*img: 'http://i.imgur.com/6RMhx.gif'*/
			}
		},
		// trigger Masonry as a callback
		function( newElements ) {
			// hide new items while they are loading
			var $newElems = $( newElements ).css({ opacity: 0 });
			// ensure that images load before adding to masonry layout
			$newElems.animate({ opacity: 1 });
			$container.append($newElems).isotope('appended', $newElems);
			$container.imagesLoaded().progress(function() {
				$container.isotope('layout');
			});
		});
	});
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>
