<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
$mb_name=get_session("name");
$mb_email=get_session("email");
if(!$is_member && !$mb_name && !$mb_email)
	goto_url(G5_URL."/page/mypage/nomember.php");
if($is_member)
	$where="`mb_id`='{$member['mb_id']}'";
else
	$where="`mb_name`='{$mb_name}' and `mb_email`='{$mb_email}'";
$view=sql_fetch("select * from `gsw_order` where {$where} and `status`>=0 and id='{$id}'");
if(!$view['id'])
	alert("해당하는 주문번호가 없거나, 이미 환불 요청이 된 주문입니다.");
if($view['reson'])
	alert("이미 환불검토가 된 주문입니다.");
$sql="select *,c.id as id,c.number as number,p.number as total,c.price as cprice from `gsw_cart` as c inner join `gsw_product` as p on c.product_id=p.id where `od_code`='{$view['od_code']}' order by c.datetime desc";
$query=sql_query($sql);
$i=0;
while($data=sql_fetch_array($query)){
	$list[$i]=$data;
	$i++;
}
?>
<header class="section01_header hidden lg_show">
	<h1>退款</h1>
</header>
<div class="member_section" id="refund_form">
	<header>
		<h1>退款</h1>
		<p>对购买产品进行退款<br />请输入   及退款账户。<span class="green">退款原因</span>及<span class="green">退款账户</span>。</p>
	</header>
	<div id="mall_buy">
		<form action="<?php echo G5_URL."/page/mypage/refund_update.php";?>" method="post">
			<input type="hidden" name="id" id="id" value="<?php echo $view['id']; ?>" />
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
				<p class="text-right">付款金额是，可能会有一些差异。</p>
			</div>
			<div class="write mt20">
				<ul>
					<li>
						<label for="reson" class="select01 grid_100 input02 text-left">
							<div>选择退款原因<span></span></div>
							<select name="reson" id="reson" class="input02 grid_100 light_gray" required>
								<option value="">选择退款原因</option>
								<option value="产品有瑕疵" data-label="产品有瑕疵">产品有瑕疵</option><!-- 제품에 하자가 있음 -->
								<option value="不想购买" data-label="不想购买">不想购买</option><!-- 단순변심 -->
								<option value="其他" data-label="其他">其他</option><!-- 기타 -->
							</select>
						</label>
					</li>
					<li>
						<textarea name="refund_content" id="refund_content" cols="30" rows="10" class="input02 grid_100" placeholder="请输入详细内容。" style="height:160px;"></textarea>
					</li>
					<li>
						<div class="grid_100">
							<div class="grid_30" style="padding-right:5px;">
								<input type="text" name="bank" id="bank" class="grid_100 input02" placeholder="银行名称" />
							</div>
							<div class="grid_70">
								<input type="text" name="account" id="account" class="grid_100 input02" placeholder="输入帐户号码" />
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="btn_group">
				<input type="submit" value="退款" class="lg_btn01" />
			</div>
		</form>
	</div>
</div>
<?php
include_once(G5_PATH.'/tail.php');
?>
