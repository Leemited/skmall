<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
if(!$category){
	$category=$cate[0]['cate'];
}
$number=$_POST['number'];
$id=$_POST['id'];
$category=$_POST['category'];
$code=sql_fetch("SELECT * FROM  `gsw_code` where `code`='{$member['mb_2']}'");
if(!$id)
	alert('这是错误的做法。');
$sql="select *,(select sum(number) from `gsw_sell` as s where p.id=s.product_id and s.status<>'-1') as sell from `gsw_product` as p where `show`<>'0' and `id`='{$id}'";
$view=sql_fetch($sql);
if(!$view['id'])
	alert('你找不到你的产品。');
$price=$view['price'];
if($code['sale'])
	$price=$view['price']-(($view['price']/100)*$code['sale']);
$view['code_sale_arr']=explode("||",$view['code_sale']);
for($j=0;$j<count($view['code_sale_arr']);$j++){
	$view['code_sale_arr'][$j]=explode("|",$view['code_sale_arr'][$j]);
	if($view['code_sale_arr'][$j][0]==$code['id'])
		$price=$view['price']-(($view['price']/100)*$view['code_sale_arr'][$j][1]);
}
$price=$price*$number;
$weight=$view['weight']*$number;
$delivery=sql_fetch("select * from `gsw_delivery` as p where `weight`>='{$weight}' order by `weight` asc");
if(!$delivery['price']){
	$delivery=sql_fetch("select * from `gsw_delivery` as p order by `weight` desc");
}
$delivery=$delivery['price'];
$total_price=$delivery+$price;
if($view['out'] || $view['number']-$view['sell']<$number)
	alert('此产品售完，或者如果数目是不够的。');
$pay_folder="alipay";

$gsw_config=sql_fetch("select * from `gsw_config`");
?>
<section class="section01">
	<article id="mall_buy" class="wrap">
		<header class="mypage_header">
			<h1>结算</h1>
			<p>要求确认后,结算。</p>
		</header>
		<div class="width-small-fixed">
			<div class="price_info">
				<div class="hidden ld_show">
					<div class="img"><div><div><img src="<?php echo G5_DATA_URL."/product/".$view['photo']; ?>" alt="<?php echo $view['title']; ?>" /></div></div></div>
					<div class="title">
						<h4><?php echo str_replace("|","/",$view['category']); ?></h4>
						<h3><?php echo $view['title']; ?></h3>
					</div>
				</div>
				<table>
					<thead>
						<tr>
							<th class="ld_hidden info">货物信息</th>
							<th class="num">数量</th>
							<th class="price">价格</th>
							<th class="delivery">配送费</th>
							<th class="total_price">总价</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="ld_hidden info">
								<div>
									<div class="img"><div><div><img src="<?php echo G5_DATA_URL."/product/".$view['photo']; ?>" alt="<?php echo $view['title']; ?>" /></div></div></div>
									<div class="title">
										<h4><?php echo str_replace("|","/",$view['category']); ?></h4>
										<h3><?php echo $view['title']; ?></h3>
									</div>
								</div>
							</td>
							<td class="num"><?php echo $number; ?></td>
							<td class="price">¥ <?php echo number_format(round($price/$gsw_config['exchange']),0); ?></td>
							<td class="delivery">¥ <?php echo number_format(round($delivery/$gsw_config['exchange']),0); ?></td>
							<td class="total_price">¥ <?php echo number_format(round($total_price/$gsw_config['exchange']),0); ?></td>
						</tr>
					</tbody>
				</table>
				<p><label for="desc">汇率 : 1 USD = <?php echo number_format($gsw_config["usexchange"]/$gsw_config["exchange"],9);?> CNY</label></p>
			</div>
			<form name="alipayment" action="<?php echo G5_URL."/page/mall/".$pay_folder."/alipayapi.php"; ?>" method="post"><!-- target="_blank" <?php echo G5_URL."/page/mall/buy_update.php"?> -->
				<input type="hidden" name="product_id" value="<?php echo $id ?>" />
				<input type="hidden" name="number" value="<?php echo $number ?>" />
				<input type="hidden" name="price" value="<?php echo $price ?>" />
				<input type="hidden" name="delivery" value="<?php echo $delivery ?>" />
				<input type="hidden" name="total_price" value="<?php echo $total_price ?>" />
				<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>" />
				<input type="hidden" name="code" value="<?php echo $member['mb_2'] ?>" />
				<input type="hidden" name="category" value="<?php echo $category ?>" />
				<input type="hidden" name="WIDout_trade_no" value="gsw-<?php echo $id; ?>-<?php echo date("Ymdhis") ?>" />
				<input type="hidden" name="WIDcurrency" value="USD" />
				<input type="hidden" name="WIDsubject" value="<?php echo $view['title']; ?>" />
				<input type="hidden" name="WIDbody" value="<?php echo $view['info']; ?>" />
				<input type="hidden" name="WIDrmb_fee" value="<?php echo round($total_price/$gsw_config['usexchange']); ?>" />
				<div class="table02">
					<h2>客户信息</h2>
					<table>
						<tr>
							<th>姓名</th>
							<td><input type="text" name="mb_name" id="mb_name" class="input04" required value="<?php echo $member['mb_name']; ?>" /></td>
						</tr>
						<tr>
							<th>邮箱</th>
							<td><input type="text" name="mb_email" id="mb_email" class="input04" required value="<?php echo $member['mb_email']; ?>" /></td>
						</tr>
						<tr>
							<th>电话</th>
							<td><input type="text" name="mb_hp" id="mb_hp" class="input04" required title="전화번호" value="<?php echo $member['mb_1']?"+".$member['mb_1']:""; ?> <?php echo $member['mb_hp']; ?>" /></td>
						</tr>
					</table>
				</div>
				<div class="table02">
					<h2>配送信息</h2>
					<table>
						<tr>
							<th>地址</th>
							<td><input type="text" name="mb_addr" id="mb_addr" required class="input04" value="<?php echo $member['mb_addr1']; ?>" /></td>
						</tr>
						<tr>
							<th>联系方式</th>
							<td><input type="text" name="re_name" id="re_name" required class="input04" value="<?php echo $member['mb_name']; ?>" /></td>
						</tr>
						<tr>
							<th>往来</th>
							<td><input type="text" name="re_hp" id="re_hp" required class="input04" value="<?php echo $member['mb_1']?"+".$member['mb_1']:""; ?> <?php echo $member['mb_hp']; ?>" /></td>
						</tr>
						<tr>
							<th>送货请求</th>
							<td><input type="text" name="content" id="content" class="input04" /></td>
						</tr>
					</table>
				</div>
				<p><input type="checkbox" name="agree" id="agree" required /> <label for="agree">上产品的销售确认条件,同意进行购买。</label></p>
				<div class="btn_group">
					<input type="submit" value="结算" class="lg_btn01" />
				</div>
			</form>
		</div>
	</article>
</section>
<?php
include_once(G5_PATH.'/tail.php');
?>
