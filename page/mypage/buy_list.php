<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
$mb_name=$_POST['mb_name']?$_POST['mb_name']:get_session("name");
$mb_email=$_POST['mb_email']?$_POST['mb_email']:get_session("email");
if($_POST['mb_name'] && $_POST['mb_email']){
	set_session('name',$mb_name);
	set_session('email',$mb_email);
}
if(!$is_member && !$mb_name && !$mb_email)
	goto_url(G5_URL."/page/mypage/nomember.php");
if($is_member)
	$where="s.`mb_id`='{$member['mb_id']}'";
else
	$where="s.`mb_name`='{$mb_name}' and s.`mb_email`='{$mb_email}' and s.`mb_id`=''";
$today=date("Y-m-d");
$start=date("Y-m-d",strtotime("-1 year"));
$sql="select *,s.datetime as datetime,s.id as id,count(p.id) as pcount from `gsw_order` as s inner join `gsw_cart` as c on s.od_code=c.od_code left join `gsw_product` as p on c.product_id=p.id where {$where} and s.status<>'0' and s.`datetime` between '{$start} 00:00:00' and '{$today} 23:59:59' and s.status>=0 group by s.od_code order by s.id desc";
$query=sql_query($sql);
while($data=sql_fetch_array($query)){
	$list[]=$data;
}
$gsw_config=sql_fetch("select * from `gsw_config`");
?>
<section class="section01">
	<header class="section01_header">
		<h1>MYPAGE</h1>
		<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo $is_member?G5_BBS_URL."/register_form.php?w=u":G5_URL."/page/mypage/nomember.php"; ?>">MY PAGE</a> &gt; <a href="<?php echo G5_URL."/page/mypage/buy_list.php"; ?>">购买列表</a></p>
	</header>
	<nav class="section01_nav">
		<ul<?php echo $is_member?" class='list3'":""?>>
			<?php if($is_member){ ?><li><a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>">编辑信息</a></li><?php } ?>
			<li class="active"><a href="<?php echo G5_URL."/page/mypage/buy_list.php"; ?>">购买列表</a></li>
			<li><a href="<?php echo G5_URL."/page/mypage/refund_list.php"; ?>">退款列表</a></li>
		</ul>
	</nav>
	<article class="section01_con" id="mypage_list">
		<div class="width-small-fixed">
			<div class="list03">
				<ul>
					<?php for($i=0;$i<count($list);$i++){
						switch($list[$i]['status']){
							case "0":$act="等待付款";break;
							case "1":$act="商品准备";break;
							case "2":$act="运输";break;
							case "3":$act="竣工交付";break;
							case "-1":$act="批准之前";break;
							case "-2":$act="航运气氛";break;
							case "-3":$act="存款等待";break;
							case "-4":$act="退款完成";break;
							default:$act="";break;
						}
						$price=$list[$i]['price'];
						if($code['sale'])
							$price=$list[$i]['price']-(($list[$i]['price']/100)*$code['sale']);
						$list[$i]['code_sale_arr']=explode("||",$list[$i]['code_sale']);
						for($j=0;$j<count($list[$i]['code_sale_arr']);$j++){
							$list[$i]['code_sale_arr'][$j]=explode("|",$list[$i]['code_sale_arr'][$j]);
							if($list[$i]['code_sale_arr'][$j][0]==$code['id'])
								$price=$list[$i]['price']-(($list[$i]['price']/100)*$list[$i]['code_sale_arr'][$j][1]);
						}

						$number=$list[$i]['number'];
						
					?>
					<li onclick="javascript:location.href='<?php echo G5_URL."/page/mypage/view.php?id=".$list[$i]['id']; ?>'">
						<div>
							<div class="img"><div><div><div><img src="<?php echo G5_DATA_URL."/product/".$list[$i]['photo']; ?>" alt="<?php echo $list[$i]['title']; ?>" /></div></div></div></div>
							<div class="txt">
								<h3><?php echo $list[$i]['title']; ?><?php if($list[$i]['pcount']>1){ ?> 治疗<?php echo $list[$i]['pcount']-1 ?>等产品<?php } ?></h3>
								<p><span>订购日期</span><?php echo date("Y-m-d",strtotime($list[$i]['datetime'])); ?></p>
								<p><span>总价格</span>¥ <?php echo number_format($list[$i]['price'],0); ?></p>
								<p><span>运费</span>¥ <?php echo number_format($list[$i]['delivery']); ?></p>
								<p><span>结算价格</span>¥ <?php echo number_format($list[$i]['total_price'],0); ?></p>
							</div>
							<div class="act">
								<?php echo $act; ?>
								<?php if(strtotime($list[$i]['datetime'])>strtotime("-30 day") && $list['reason']==""){ ?>
								<a href="<?php echo G5_URL."/page/mypage/refund.php?id=".$list[$i]['id']; ?>">退款</a>
								<?php } ?>
							</div>
						</div>
					</li>
					<?php
					}
					if(count($list)==0){
					?>
					<li style="padding-left:0;"><div class="text-center"><div>没有列表。</div></div></li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
		<div class="wrap">
			<div class="width-small-fixed">
				<div class="box">
					-  查看快递单号可以在>购买商品详细页面中<span class="black">购买列表 &gt; 购买商品详细页面中</span>确认。<br />
					-  收货后<span class="black">7天</span>内可进行退款。
				</div>
			</div>
		</div>
	</article>
</section>
<?php
include_once(G5_PATH.'/tail.php');
?>
