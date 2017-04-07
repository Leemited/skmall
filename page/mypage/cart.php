<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
$date1=date("Y-m-d H:i:s",strtotime("-1 days"));
$cart_session=get_session("cart_session");
if(!$cart_session){
	$cart_session="";
	for($i=0;$i<6;$i++){
		$c=rand(0,9);
		$cart_session.=$c;
	}
	set_session('cart_session',$cart_session);
}
if($is_member)
	$where="`mb_id`='{$member['mb_id']}'";
else
	$where="`mb_ip`='{$_SERVER['REMOTE_ADDR']}' and `mb_session`='{$cart_session}' and `mb_id`='' and c.`datetime`>'{$date1}'";
$sql="select *,c.id as id,c.number as number,p.number as total from `gsw_cart` as c inner join `gsw_product` as p on c.product_id=p.id where {$where} and od_status='0' order by c.datetime desc";
$query=sql_query($sql);
while($data=sql_fetch_array($query)){
	$list[]=$data;
}
$gsw_config=sql_fetch("select * from `gsw_config`");
$code=sql_fetch("SELECT * FROM  `gsw_code` where `code`='{$member['mb_2']}'");
?>
<!-- <header class="section01_header">
	<h1>MYPAGE</h1>
	<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo $is_member?G5_BBS_URL."/register_form.php?w=u":G5_URL."/page/mypage/nomember.php"; ?>">MY PAGE</a> &gt; <a href="<?php echo G5_URL."/page/mypage/cart.php"; ?>">购物车</a></p>
</header>
<div class="width-small-fixed">
	<nav class="section01_nav">
		<ul class='list3' style="width:100%">
			<?php if($is_member){ ?><li<?php echo $is_member?" style='width:25% !important;'":"";?>><a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>">编辑信息</a></li><?php } ?>
			<li class="active"<?php echo $is_member?" style='width:25% !important;'":"";?>><a href="<?php echo G5_URL."/page/mypage/cart.php"; ?>">购物车</a></li>
			<li<?php echo $is_member?" style='width:25% !important;'":"";?>><a href="<?php echo G5_URL."/page/mypage/buy_list.php"; ?>">购买列表</a></li>
			<li<?php echo $is_member?" style='width:25% !important;'":"";?>><a href="<?php echo G5_URL."/page/mypage/refund_list.php"; ?>">退款列表</a></li>
		</ul>
	</nav>
</div> -->
<section class="section01">
	<article id="mall_buy" class="wrap">
		<header class="mypage_header">
			<h1>购物车</h1>
		</header>
		<div class="width-small-fixed">
			<form action="<?php echo G5_URL."/page/mypage/order_form.php"; ?>" method="post" name="cart_list" id="cart_list">
				<input type="hidden" name="act" value="" />
				<div class="price_info" id="cart">
					<table>
						<thead>
							<tr>
								<th class="check"><input type="checkbox" name="all" id="all" onchange="if (this.checked) all_checked(true); else all_checked(false);" checked /></th>
								<th class="info">货物信息</th>
								<th class="num">数量</th>
								<th class="price">价格</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$total_num=0;
						$total_price=0;
						for($i=0;$i<count($list);$i++){
							$out=false;
							$number=$list[$i]['number'];
							$price1=$list[$i]['price'];
							if($code['sale'])
								$price1=$list[$i]['price']-(($list[$i]['price']/100)*$code['sale']);
							$list[$i]['code_sale_arr']=explode("||",$list[$i]['code_sale']);
							for($j=0;$j<count($list[$i]['code_sale_arr']);$j++){
								$list[$i]['code_sale_arr'][$j]=explode("|",$list[$i]['code_sale_arr'][$j]);
								if($list[$i]['code_sale_arr'][$j][0]==$code['id'])
									$price1=$list[$i]['price']-(($list[$i]['price']/100)*$list[$i]['code_sale_arr'][$j][1]);
							}
							$price=ceil($price1/$gsw_config['exchange'])*$number;
							if($list[$i]['out'] || $list[$i]['total']-$list[$i]['sell'] < $list[$i]['number'])
								$out=true;
							$total_num+=$number;
							$total_price+=$price;
						?>
							<tr<?php echo $out?" class='out'":""; ?>>
								<td class="check"><input type="checkbox" name="ct_id[]" id="ct_id<?php echo $list[$i]['id']; ?>" value="<?php echo $list[$i]['id']; ?>" <?php echo $out?"":"checked"; ?> /></td>
								<td class="info">
									<div>
										<div class="img"><div><div><img src="<?php echo G5_DATA_URL."/product/".$list[$i]['photo']; ?>" alt="<?php echo $list[$i]['title']; ?>" /></div></div></div>
										<div class="title">
											<h4><?php echo str_replace("|","/",$list[$i]['category']); ?></h4>
											<h3><a href="<?php echo G5_URL."/page/mall/view.php?id=".$list[$i]['product_id']; ?>" target="_blank"><?php echo $list[$i]['title']; ?></a></h3>
											<?php if($out){ ?><p>数量不足的配制或出售产品。</p><?php } ?>
										</div>
									</div>
								</td>
								<td class="num">
									<input type="text" name="number[]" id="number<?php echo $list[$i]['id']; ?>" value="<?php echo $list[$i]['number']; ?>" class="number_input" onblur="num_enter(this);" data-max="<?php echo $list[$i]['out']?0:$list[$i]['total']-$list[$i]['sell']; ?>" data-id="<?php echo $list[$i]['id']; ?>" />
									<input type="hidden" name="price[]" id="price<?php echo $list[$i]['id']; ?>" value="<?php echo ceil($price1/$gsw_config['exchange']); ?>" class="price_input" />
									<input type="hidden" name="total_price[]" id="total_price<?php echo $list[$i]['id']; ?>" value="<?php echo ceil($price); ?>" class="total_price_input" />
								</td>
								<td class="price">
									¥ <?php echo number_format(ceil($price),0); ?>
								</td>
							</tr>
						<?php }
						if(count($list)<=0){
						?>
						<tr>
							<td colspan="4">
								你在你的购物车中没有商品。
							</td>
						</tr>
						<?php
						}else{
						?>
						<tfoot>
							<td class="check">&nbsp;</td>
							<td class="info text-left">总价格</td>
							<td class="num"><?php echo number_format($total_num); ?></td>
							<td class="price">¥ <?php echo number_format($total_price); ?></td>
						</tfoot>
						<?php
						}
						?>
						</tbody>
					</table>
					<input type="button" value="删除所选产品" class="btn delete_btn" onclick="return form_check('delete');" />
					<p class="text-right"><label for="desc">汇率 : 1 USD = <?php echo number_format($gsw_config["usexchange"]/$gsw_config["exchange"],9);?> CNY</label><br />这一数额不包括运费。 航运成本按重量来确定。</p>
				</div>
				<div class="btn_group text-center">
					<input type="button" value="秩序" class="btn lg_btn01" onclick="return form_check('buy');" />
				</div>
			</form>
		</div>
	</article>
</section>
<script type="text/javascript">
	function all_checked(sw) {
		var f = document.cart_list;
		for (var i=0; i<f.length; i++) {
			if (f.elements[i].name == "ct_id[]")
				f.elements[i].checked = sw;
		}
	}
	function num_enter(t){
		number_only(t);
		var ct_id = $(t).attr("data-id");
		var price1 = $(t).parent().find("#price"+ct_id).val();
		var max_num=$(t).attr("data-max");
		var num_var=parseInt($(t).val());
		if($(t).val()=="" || num_var<=0){
			alert("它不能再下车的数目。");
			$(t).val(1);
			num_var=1;
		}
		if(max_num==0){
			alert("该产品已经售罄。");
			$(t).parent().parent().remove();
		}else if(max_num<num_var){
			alert("不再能够减少的数量。");
			$(t).val(max_num);
			num_var=max_num;
		}
		$.post("./ajax.cart_num_update.php",{"id":ct_id,"number":num_var},function(data){})
		var total_price=num_var*price1;
		var total_price_txt=total_price.number_format();
		$(t).parent().find("#total_price"+ct_id).val(total_price);
		$(t).parent().parent().find('.price').html("¥ "+total_price_txt);
		var len=$(t).parent().parent().parent().find("tr").length;
		var total_num=0;
		var total_price2=0;
		for(i=0;i<len;i++){
			var tr=$(t).parent().parent().parent().find("tr").eq(i);
			var num=parseInt(tr.find(".num .number_input").val());
			var totprice=parseInt(tr.find(".num .total_price_input").val());
			total_num+=num;
			total_price2+=totprice;
		}
		var total_num_txt=total_num.number_format();
		var total_price2_txt=total_price2.number_format();
		$(t).parent().parent().parent().parent().find("tfoot tr .num").html(total_num_txt);
		$(t).parent().parent().parent().parent().find("tfoot tr .price").html(total_price2_txt);
	}
	Number.prototype.number_format = function(round_decimal) {
		return this.toFixed(round_decimal).replace(/(\d)(?=(\d{3})+$)/g, "$1,");
	};
	function form_check(act) {
		var f = document.cart_list;
		if($("input[name^=ct_id]:checked").size() < 1) {
			alert("请选择一个或多个");
			return false;
		}
		if (act == "delete"){
			f.act.value = act;
			$(f).attr("action",g5_url+"/page/mypage/cart_update.php");
			f.submit();
		}else{
			f.act.value = "";
			$(f).attr("action",g5_url+"/page/mall/order_form.php");
			f.submit();
		}

		return true;
	}
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>
