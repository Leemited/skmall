<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
if(!$category){
	$category=$cate[0]['cate'];
}
$code=sql_fetch("SELECT * FROM  `gsw_code` where `code`='{$member['mb_2']}'");
if(!$id)
	alert('잘못된 접근입니다.');
$sql="select *,(select sum(number) from `gsw_sell` as s where p.id=s.product_id and s.status<>'-1') as sell from `gsw_product` as p where `show`<>'0' and `id`='{$id}'";
$view=sql_fetch($sql);
if(!$view['id'])
	alert('제품을 찾을 수 없습니다.');
$price=$view['price'];
if($code['sale'])
	$price=$view['price']-(($view['price']/100)*$code['sale']);
$view['code_sale_arr']=explode("||",$view['code_sale']);
for($j=0;$j<count($view['code_sale_arr']);$j++){
	$view['code_sale_arr'][$j]=explode("|",$view['code_sale_arr'][$j]);
	if($view['code_sale_arr'][$j][0]==$code['id'])
		$price=$view['price']-(($view['price']/100)*$view['code_sale_arr'][$j][1]);
}
$url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
$gsw_config=sql_fetch("select * from `gsw_config`");
?>
<header class="section01_header hidden lg_show">
	<h1>购买</h1>
</header>
<section class="section01">
	<article id="mall_view">
		<?php if(!$is_member){ ?>
			<div class="join_box width-small-fixed">
				<p><i></i>注册会员后登录，可以以会员价格进行购买。</p><a href="<?php echo G5_BBS_URL."/register_form.php"; ?>" class="btn01">注册会员<span class="lg_hidden"></span></a>
			</div>
		<?php } ?>
		<div class="width-small-fixed">
			<div class="top">
				<div class="img">
					<div>
						<div><img src="<?php echo G5_DATA_URL."/product/".$view['photo']; ?>" alt="<?php echo $view['title']?>" /></div>
					</div>
				</div>
				<div class="txt">
					<div class="info">
						<div class="title">
							<!-- <h5><?php echo str_replace("|","/",$view['category']); ?></h5> -->
							<h2><?php echo $view['en_title']; ?></h2>
							<h3><?php echo $view['title']; ?></h3>
						</div>
						<p><?php echo $view['info']; ?></p>
					</div>
					<div class="price">
						<h4><span>非会员价 </span>
                    <?php if($view['hospital'] == '2') {?>
                    <?php if($is_guest){ ?>
                        <div class="info">
                            <p class="redp">本产品只提供给有合法叛卖医疗机器许可证的人<br>或者可以登入合法叛卖资格之后进行购买</p>
                        </div>
                    <?php  
                        }else if($is_member){ ?>¥
                    <?php
                        echo number_format(ceil($view['price']/$gsw_config['exchange']),0); ?>
                    <?php    } }else { ?>  ¥ <?php echo number_format(ceil($view['price']/$gsw_config['exchange']),0); }?></h4>
                        <h4><span>会员折扣价</span>
                        <?php if($is_member){ ?>¥ 
                    <?php echo number_format(ceil($price/$gsw_config['exchange']),0); ?>
                    <?php }else{ ?><a class="btn02" href="<?php echo G5_BBS_URL."/login.php?url=".urlencode($url); ?>">登陆</a><?php } ?></h4>
					</div>
					<div class="buy">
				
						<form action="<?php if($view['hospital'] == '2'){ 
                                        if($is_member){ echo G5_URL."/page/mall/add_cart.php";}} else echo G5_URL."/page/mall/add_cart.php" ?>" method="post">
							<input type="hidden" name="id" id="id" required value="<?php echo $view['id']; ?>" />
							<input type="hidden" name="category" id="category" required value="<?php echo $category; ?>" />
							<input type="hidden" name="price" id="price" required value="<?php echo ceil($price/$gsw_config['exchange']); ?>" />
							<div class="total">
								<div class="num">
									<a href="javascript:number_minus();">-</a>
									<input type="text" name="number" id="number" onkeyup="return num_enter(this);" data-max="<?php echo $view['out']?0:$view['number']-$view['sell']; ?>" required value="<?php echo $view['out'] || $view['number']-$view['sell']<=0?0:1; ?>" />
									<a href="javascript:number_plus();">+</a>
								</div>
								<?php 
                                
                                if($view['hospital'] == '2'){                                   
                                   if($is_member){?>
                                   <h4>¥<span>总价</span>
                                    <?php         
                                    echo $view['out'] || $view['number']-$view['sell']<=0?number_format(0):number_format(ceil($price/$gsw_config['exchange']),0); }?> </h4>
                                    <?php }elseif($is_guest){ ?>
                                    <h4>¥<span>总价</span>
                                    <?php 
                                    echo $view['out'] || $view['number']-$view['sell']<=0?number_format(0):number_format(ceil($price/$gsw_config['exchange']),0); ?> </h4>
                                    <?php }elseif($is_member){?>
                                    <h4>¥<span>总价</span>    
                                    <?php echo $view['out'] || $view['number']-$view['sell']<=0?number_format(0):number_format(ceil($price/$gsw_config['exchange']),0); }?> </h4>
							</div>
							<div class="btn_group">
								<input type="submit" value="<?php echo $view['out'] || $view['number']-$view['sell']<=0?"卖光了":"加入我的购物袋"; ?>" class="<?php echo $view['out'] || $view['number']-$view['sell']<=0?"lg_btn02":"lg_btn01"; ?> grid_100" <?php echo $view['out'] || $view['number']-$view['sell']<=0?"disabled":""; ?> />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="wrap">
			<div class="width-small-fixed">
				<div class="service">
					<div class="support">
						<h3><i></i>服务支持</h3>
						<div>
							配送 : EMS <br />
							支付 : <img src="<?php echo G5_IMG_URL."/mall_support_card1.png"; ?>" alt="VISA" /><img src="<?php echo G5_IMG_URL."/mall_support_card2.png"; ?>" alt="MASTER CARD" />
						</div>
					</div>
					<div class="certify">
						<h3><i></i>购买者保证</h3>
						<div>
							如果产品有瑕疵，请在收到产品24小时内联系我们，我们会为您进行退换处理。<br />
							但是，如果因为顾客变心而需要退换货时，请在24小时内联系我们，
							我们将以扣除来回运费的条件为您进行退换处理。
						</div>
					</div>
					<div class="delivery">
						<h3><i></i>配送信息</h3>
						<div>
							<p>订货时结算（运费根据产品重量而异。）</p>
						</div>
					</div>
					<div class="inquiry">
						<h3><i></i>产品咨询</h3>
						<div>
							<div>
								<i></i>
								<div><img src="<?php echo G5_IMG_URL."/menu_gsw_qr.png"; ?>" alt="WECHAT QR" /></div>
							</div>
						</div>
					</div>
				</div>
				<div class="detail">
					<h2></h2>
					<div>
						<?php echo $view['content']; ?>
					</div>
				</div>
				<?php
				if($view['related_product']){
					$related_product=str_replace("|",",",$view['related_product']);
					$sql="select *,(select sum(number) from `gsw_sell` as s where p.id=s.product_id and s.status<>'-1') as sell from `gsw_product` as p where `id` in({$related_product});";
					$query=sql_query($sql);
					while($data=sql_fetch_array($query)){
						$related[]=$data;
					}
				?>
				<div class="related">
					<h2></h2>
					<div class="owl-carousel">
						<?php
						for($i=0;$i<count($related);$i++){
							$price=$related[$i]['price'];
							if($code['sale'])
								$price=$related[$i]['price']-(($related[$i]['price']/100)*$code['sale']);
							$related[$i]['code_sale_arr']=explode("||",$related[$i]['code_sale']);
							for($j=0;$j<count($related[$i]['code_sale_arr']);$j++){
								$related[$i]['code_sale_arr'][$j]=explode("|",$related[$i]['code_sale_arr'][$j]);
								if($related[$i]['code_sale_arr'][$j][0]==$code['id'])
									$price=$related[$i]['price']-(($related[$i]['price']/100)*$related[$i]['code_sale_arr'][$j][1]);
							}
						?>
						<div class="item">
							<a href="<?php echo G5_URL."/page/mall/view.php?&id=".$related[$i]['id']."&category=".urlencode($category); ?>">
								<?php if($related[$i]['out'] || ($related[$i]['number']-$related[$i]['sell'])<=0){ ?><div class="out"><i></i></div><?php } ?>
								<div class="img"><div><div><img src="<?php echo G5_DATA_URL."/product/".$related[$i]['photo']; ?>" alt="<?php echo $related[$i]['title']; ?>" /></div></div></div>
								<div class="txt">
									<h4><?php echo $related[$i]['title']; ?></h4>
									<?php if($price<$related[$i]['price']){ ?><h5><?php echo number_format($related[$i]['price']); ?></h5><?php } ?>
									<h3><?php echo number_format($price); ?></h3>
								</div>
							</a>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</article>
</section>
<script type="text/javascript">
	$(function(){
		var owl1=$("#mall_view .related > div");
		owl1.owlCarousel({
			smartSpeed:2000,
			loop:true,
			dots:true,
			margin:5,
			items:2,
			responsive:{
				768:{
					items:4,
				}
			}
		});
	});
	function number_plus(){
		var price=$("#price").val();
		var max_num=$("#number").attr("data-max");
		var num_var=parseInt($("#number").val());
		var num_plus=num_var+1;
		if(max_num<num_plus){
			alert("你不能再提高一些。");
			return false;
		}
		$("#number").val(num_plus);
		var total=(num_plus*price).number_format();
		$("#mall_view .top .buy .total h4").html("<span>总价</span>$ "+total);
	}
	function number_minus(){
		var price=$("#price").val();
		var max_num=$("#number").attr("data-max");
		var num_var=parseInt($("#number").val());
		var num_minus=num_var-1;
		if(0>=num_minus){
			alert("它不能再下车的数目。");
			return false;
		}
		$("#number").val(num_minus);
		var total=(num_minus*price).number_format();
		$("#mall_view .top .buy .total h4").html("<span>总价</span>$ "+total);
	}
	function num_enter(t){
		number_only(t);
		var price=$("#price").val();
		var max_num=$("#number").attr("data-max");
		var num_var=parseInt($("#number").val());
		if($("#number").val()=="" || num_var<=0){
			alert("它不能再下车的数目。");
			$("#number").val(1);
			num_var=1;
		}
		if(max_num<num_var){
			alert("不再能够减少的数量。");
			$("#number").val(max_num);
			num_var=max_num;
		}
		var total=(num_var*price).number_format();
		$("#mall_view .top .buy .total h4").html("<span>总价</span>$ "+total);
	}
	Number.prototype.number_format = function(round_decimal) {
		return this.toFixed(round_decimal).replace(/(\d)(?=(\d{3})+$)/g, "$1,");
	};
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>
