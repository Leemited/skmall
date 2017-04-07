<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
if(!$id)
	alert('잘못된 접근입니다.');
$mb_name=get_session("name");
$mb_email=get_session("email");
if($is_member)
	$where="`mb_id`='{$member['mb_id']}'";
else
	$where="`mb_name`='{$mb_name}' and `mb_email`='{$mb_email}'";
$sql="select * from `gsw_order` where {$where} and `id`='{$id}'";
$view=sql_fetch($sql);
if(!$view['id'])
	alert('订单无法找到。');
$gsw_config=sql_fetch("select * from `gsw_config`");
$sql="select *,c.id as id,c.number as number,p.number as total,c.price as cprice from `gsw_cart` as c inner join `gsw_product` as p on c.product_id=p.id where `od_code`='{$view['od_code']}' order by c.datetime desc";
$query=sql_query($sql);
$i=0;
while($data=sql_fetch_array($query)){
	$list[$i]=$data;
	$i++;
}
?>
<section class="section01">
	<header class="section01_header">
		<h1>MYPAGE</h1>
		<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo $is_member?G5_BBS_URL."/register_form.php?w=u":G5_URL."/page/mypage/nomember.php"; ?>">MY PAGE</a> &gt; <?php if($view['status']>=0){ ?><a href="<?php echo G5_URL."/page/mypage/buy_list.php"; ?>">购买列表</a><?php }else{?><a href="<?php echo G5_URL."/page/mypage/refund_list.php"; ?>">退款列表</a><?php } ?></p>
	</header>
	<nav class="section01_nav">
		<ul<?php echo $is_member?" class='list3'":""?>>
			<?php if($is_member){ ?><li><a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>">编辑信息</a></li><?php } ?>
			<li<?php echo $view['status']>=0?" class='active'":""; ?>><a href="<?php echo G5_URL."/page/mypage/buy_list.php"; ?>">购买列表</a></li>
			<li<?php echo $view['status']<0?" class='active'":""; ?>><a href="<?php echo G5_URL."/page/mypage/refund_list.php"; ?>">退款列表</a></li>
		</ul>
	</nav>
	<article class="section01_con wrap" id="mall_buy">
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
							for($i=0;$i<count($list);$i++){
								$number=$list[$i]['number'];
								$price=$list[$i]['cprice'];
								$total_num+=$number;
								$total_price+=$price;
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
							<td class="num">¥ <?php echo number_format($view['delivery']); ?></td>
							<td class="price">¥ <?php echo number_format($view['total_price']); ?></td>
						</tr>
					</tfoot>
				</table>
				<p class="text-right"><label for="desc">汇率 : 1 USD = <?php echo number_format($gsw_config["usexchange"]/$gsw_config["exchange"],9);?> CNY</label><br />付款金额是，可能会有一些差异。</p>
			</div>
			<div class="table02">
				<h2>客户信息</h2>
				<table>
					<tr>
						<th>姓名</th>
						<td><?php echo $view['mb_name']; ?></td>
					</tr>
					<tr>
						<th>邮箱</th>
						<td><?php echo $view['mb_email']; ?></td>
					</tr>
					<tr>
						<th>电话</th>
						<td><?php echo $view['mb_hp']; ?></td>
					</tr>
				</table>
			</div>
			<div class="table02">
				<h2>配送信息</h2>
				<table>
					<tr>
						<th>地址</th>
						<td><?php echo $view['mb_addr']; ?></td>
					</tr>
					<tr>
						<th>联系方式</th>
						<td><?php echo $view['re_name']; ?></td>
					</tr>
					<tr>
						<th>往来</th>
						<td><?php echo $view['re_hp']; ?></td>
					</tr>
					<?php if($view['status']>=2){ ?>
					<tr>
						<th>联系方式</th>
						<td><?php echo $view['company']; ?> <?php echo $view['invoice']; ?></td>
					</tr>
					<?php } ?>
					<tr>
						<th>送货请求</th>
						<td><?php echo $view['content']; ?></td>
					</tr>
				</table>
			</div>
			<?php if($view['status']<0){ ?>
			<div class="table02">
				<h2>退款信息</h2>
				<table>
					<tr>
						<th>为什么</th>
						<td><?php echo $view['reason']; ?></td>
					</tr>
					<tr>
						<th>帐号</th>
						<td><?php echo $view['bank']; ?> <?php echo $view['account']; ?></td>
					</tr>
					<tr>
						<th>内容</th>
						<td><?php echo $view['refund_content']; ?></td>
					</tr>
				</table>
			</div>
			<?php } ?>
			<div class="btn_group">
				<a href="<?php echo $view['status']<0?G5_URL."/page/mypage/refund_list.php":G5_URL."/page/mypage/buy_list.php"; ?>" class="lg_btn01">确认</a>
			</div>
		</div>
	</article>
</section>
<?php
include_once(G5_PATH.'/tail.php');
?>
