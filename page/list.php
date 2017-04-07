<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
if(!$category){
	$category=$cate[0]['cate'];
}
$where="";
if($category!=""){
	$where.="and `category` like '%{$category}%'";
}
if($searchtext = $_REQUEST["sch_text"]){
	$where.=" and `title` like '%${searchtext}%'";
}
$sql="select * from `gsw_category_banner` where cate='{$category}' order by `od` asc";
$query=sql_query($sql);
while($data=sql_fetch_array($query)){
	$banner[]=$data;
}
$code=sql_fetch("SELECT * FROM  `gsw_code` where `code`='{$member['mb_2']}'");
$total=sql_fetch("select count(*) as cnt from `gsw_product` where `show`<>'0' {$where} order by `id` desc");
if(!$page)
	$page=1;
$total=$total['cnt'];
$rows=12;
$start=($page-1)*$rows;
$total_page=ceil($total/$rows);
$sql="select *,(select sum(number) from `gsw_sell` as s where p.id=s.product_id and s.status<>'-1') as sell from `gsw_product` as p where `show`<>'0' {$where} order by `order` asc, `id` desc limit {$start},{$rows}";
$query=sql_query($sql);
$j=0;
while($data=sql_fetch_array($query)){
	$list[$j]=$data;
	$j++;
}
?>
<section class="section01">
	<?php if(count($banner)>0){ ?>
	<div class="mall_slide owl-carousel lg_hidden">
		<?php for($i=0;$i<count($banner);$i++){ ?>
		<div class="item" style="background-image:url('<?php echo G5_DATA_URL."/cate_banner/".$banner[$i]['banner']; ?>');"></div>
		<?php } ?>
	</div>
	<?php } ?>
	<nav class="section01_nav">
		<ul class="<?php echo count($cate)==1?" list1":""; echo count($cate)>=3?" list3":""; ?>">
			<?php for($i=0;$i<count($cate);$i++){ ?>
			<li<?php echo $cate[$i]['cate']==$category?" class='active'":"" ?><?php echo count($cate)>5?" style='width:".(1280/count($cate))."px;'":"";?>><a href="<?php echo G5_URL."/page/mall/list.php?category=".urlencode($cate[$i]['cate']); ?>"><?php echo $cate[$i]['cate'];?></a></li>
			<?php } ?>
		</ul>
		<!-- <?php if(count($cate)>3){?>
			<div class="slide hidden lg_show owl-carousel">
			<?php for($i=0;$i<count($cate);$i++){ ?>
				<div class="item <?php echo $cate[$i]['cate']==$category?" act":""; ?>"><a href="<?php echo G5_URL."/page/mall/list.php?category=".urlencode($cate[$i]['cate']); ?>"><?php echo $cate[$i]['cate'];?></a></div>
			<?php } ?>
			</div>
		<?php } ?> -->
	</nav>
	<?php if(count($banner)>0){ ?>
	<div class="mall_slide owl-carousel lg_show hidden">
		<?php for($i=0;$i<count($banner);$i++){ ?>
		<div class="item" style="background-image:url('<?php echo G5_DATA_URL."/cate_banner/".$banner[$i]['banner']; ?>');"></div>
		<?php } ?>
	</div>
	<?php } ?>
	<article class="section01_con wrap" id="mall_list">
		<div class="width-fixed">
			<?php 
				if(!$is_member){ ?>
			<div class="join_box">
				<p><i></i>注册会员后登录，可以以会员价格进行购买。</p><a href="<?php echo G5_BBS_URL."/register_form.php"; ?>" class="btn01">注册会员<span class="lg_hidden"> </span></a>
			</div>
			<?php } ?>
			<div class="search_box">
				<div class="search_area">
				<form action="<?php echo G5_URL."/page/mall/list.php";?>" method="post" name="searchForm">
					<input type="hidden" name="category" value="<?=$category?>" />
					<input type="text" name="sch_text" id="sch_text" class="input_search" value="<?=$searchtext?>" placeholder="Search..."/>
					<input type="submit" class="searchBtn" value=""/>
				</form>
				</div>
			</div>
			<div class="list01">
				<?php
				for($i=0;$i<count($list);$i++){
					$price=$list[$i]['price'];
					if($code['sale'])
						$price=$list[$i]['price']-(($list[$i]['price']/100)*$code['sale']);
					$list[$i]['code_sale_arr']=explode("||",$list[$i]['code_sale']);
					for($j=0;$j<count($list[$i]['code_sale_arr']);$j++){
						$list[$i]['code_sale_arr'][$j]=explode("|",$list[$i]['code_sale_arr'][$j]);
						if($list[$i]['code_sale_arr'][$j][0]==$code['id'])
							$price=$list[$i]['price']-(($list[$i]['price']/100)*$list[$i]['code_sale_arr'][$j][1]);
					}
					
				?>
				<div class="item">
					<a href="<?php echo G5_URL."/page/mall/view.php?&id=".$list[$i]['id']."&category=".urlencode($category); ?>" target="_blank">
						<?php if($list[$i]['out'] || ($list[$i]['number']-$list[$i]['sell'])<=0){ ?><div class="out"><i></i></div><?php } ?>
						<div class="img"><div><div><img src="<?php echo G5_DATA_URL."/product/".$list[$i]['photo']; ?>" alt="<?php echo $list[$i]['title']; ?>" /></div></div></div>
						<div class="txt">
							<h4><?php echo $list[$i]['title']; ?></h4>
							<?php if($price<$list[$i]['price']){ ?><h5><?php echo number_format($list[$i]['price']); ?></h5><?php } ?>
							<h3><?php echo number_format($price); ?></h3>
						</div>
					</a>
				</div>
				<?php
				}
				if(count($list)==0){
					echo "<div class='text-center grid_100 item' style='padding:150px 0;'>没有列表。</div>";
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
