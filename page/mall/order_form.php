<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
$od_code=date("YmdHis");
$ct_arr=array();
$ct_arr=$_POST['ct_id'];
if(count($ct_arr)<=0)
	alert('请选择一个或多个');
$ct_ids="";
for($i=0;$i<count($ct_arr);$i++){
	if($i!=0)
		$ct_ids.=",";
	$ct_ids.=" '{$ct_arr[$i]}'";
}
sql_query("update `gsw_cart` set `od_code`='{$od_code}' where `id` in ({$ct_ids})");
$code=sql_fetch("SELECT * FROM  `gsw_code` where `code`='{$member['mb_2']}'");
if($is_member)
	$where="`mb_id`='{$member['mb_id']}'";
else
	$where="`mb_ip`='{$_SERVER['REMOTE_ADDR']}' and `mb_id`='' and c.`datetime`>'{$date1}'";
$where.="and (c.od_code={$od_code})";
$sql="select *,c.id as id,c.number as number,p.number as total from `gsw_cart` as c inner join `gsw_product` as p on c.product_id=p.id where {$where} order by c.datetime desc";
$query=sql_query($sql);
$i=0;
while($data=sql_fetch_array($query)){
	if($data['out'] || $data['total']-$data['sell']<$data['number'])
		alert('数量不足的配制或出售产品。',G5_URL."/page/mypage/cart.php");
	$list[$i]=$data;
	$i++;
}
/*
$weight=$view['weight']*$number;
$delivery=sql_fetch("select * from `gsw_delivery` as p where `weight`>='{$weight}' order by `weight` asc");
if(!$delivery['price']){
	$delivery=sql_fetch("select * from `gsw_delivery` as p order by `weight` desc");
}
$delivery=$delivery['price'];
$total_price=$delivery+$price;
*/
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
			<div class="price_info" id="order">
				<table>
					<thead>
						<tr>
							<th class="info">货物信息</th>
							<th class="num">数量</th>
							<th class="price">价格</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$total_num=0;
						$total_price=0;
						$total_price1=0;
						for($i=0;$i<count($list);$i++){
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
							$weight+=$list[$i]['weight']*$number;
							$total_num+=$number;
							$total_price+=$price;
							$total_price1+=$price1;
							$title = $list[$i]['title'];
							sql_query("update `gsw_cart` set `price`='{$price}' where `id` = '{$list[$i]['id']}'");
						?>
						<tr>
							<td class="info">
								<div>
									<div class="img"><div><div><img src="<?php echo G5_DATA_URL."/product/".$list[$i]['photo']; ?>" alt="<?php echo $list[$i]['title']; ?>" /></div></div></div>
									<div class="title">
										<h4><?php echo str_replace("|","/",$list[$i]['category']); ?></h4>
										<h3><?php echo $list[$i]['title']; ?></h3>
									</div>
								</div>
							</td>
							<td class="num"><?php echo number_format($number); ?></td>
							<td class="price">¥ <?php echo number_format($price,0); ?></td>
						</tr>
						<?php
						}
						$delivery=sql_fetch("select * from `gsw_delivery` as p where `weight`>='{$weight}' order by `weight` asc");
						if(!$delivery['id']){
							$delivery=sql_fetch("select * from `gsw_delivery` order by `weight` desc");
						}
						$delivery=ceil($delivery['price']/$gsw_config['exchange']);
						$ttotal_price=$total_price+$delivery;
						$ttotal_price1=$total_price1+$delivery['price'];
						?>
					</tbody>
					<tfoot>
						<tr>
							<td class="info text-left">总价格</td>
							<td class="num"><?php echo number_format($total_num); ?></td>
							<td class="price">¥ <?php echo number_format($total_price); ?></td>
						</tr>
						<tr>
							<td class="info text-left">运费 / 结算价格</td>
							<td class="num">¥ <?php echo number_format($delivery); ?></td>
							<td class="price">¥ <?php echo number_format($ttotal_price); ?></td>
						</tr>
					</tfoot>
				</table>
				<p class="text-right"><label for="desc">汇率 : 1 USD = <?php echo number_format($gsw_config["usexchange"]/$gsw_config["exchange"],9);?> CNY</label><br />付款金额是，可能会有一些差异。</p>
			</div>
			<form name="alipayment" action="<?php echo G5_URL."/page/mall/".$pay_folder."/alipayapi.php"; ?>" method="post" target="_blank" >
				<input type="hidden" name="title" value="<?php echo $title; ?>" />
				<input type="hidden" name="od_code" value="<?php echo $od_code ?>" />
				<input type="hidden" name="number" value="<?php echo $total_num ?>" />
				<input type="hidden" name="price" value="<?php echo $total_price ?>" />
				<input type="hidden" name="delivery" value="<?php echo $delivery ?>" />
				<input type="hidden" name="total_price" value="<?php echo $ttotal_price ?>" />
				<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>" />
				<input type="hidden" name="code" value="<?php echo $member['mb_2'] ?>" />
				<input type="hidden" name="WIDout_trade_no" value="gsw-<?php echo $id; ?>-<?php echo date("Ymdhis") ?>" />
				<input type="hidden" name="WIDcurrency" value="USD" />
				<input type="hidden" name="WIDsubject" value="<?php echo $od_code ?>" />
				<input type="hidden" name="WIDbody" value="<?php echo $od_code ?>" />
				<input type="hidden" name="WIDrmb_fee" value="<?php echo ceil($ttotal_price*$gsw_config["exchange"]/$gsw_config['usexchange']); ?>" />
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
