<?php
include_once('../../common.php');
$code=sql_fetch("SELECT * FROM  `gsw_code` where `code`='{$member['mb_2']}'");
/*if(!$category){
	$category=$cate[0]['cate'];
}*/
$where="";
if($category!=""){
	$where.="and `category` like '%{$category}%'";
}
if(!$page)
	$page=1;
$rows=12;
$start=($page-1)*$rows;
$sql="select *,(select sum(number) from `gsw_sell` as s where p.id=s.product_id and s.status<>'-1') as sell from `gsw_product` as p where `show`<>'0' {$where} order by `order` asc, `id` desc limit {$start},{$rows}";
$query=sql_query($sql);
$j=0;
while($data=sql_fetch_array($query)){
	$list[$j]=$data;
	$j++;
}
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
$gsw_config=sql_fetch("select * from `gsw_config`");
?>
<div class="item">

	<a href="<?php echo G5_URL."/page/mall/view.php?&id=".$list[$i]['id']."&category=".urlencode($list[$i]['category']); ?>">
		     <?php if($list[$i]['out'] || ($list[$i]['number']-$list[$i]['sell'])<=0){ ?><div class="out"><i></i></div><?php } ?>
		<div class="img"><div><div><img src="<?php echo G5_DATA_URL."/product/".$list[$i]['photo']; ?>" alt="<?php echo $list[$i]['title']; ?>" /></div></div></div>
		<div class="txt">
			<h4><?php echo $list[$i]['title']; ?></h4>
			<?php if($price<$list[$i]['price']){ ?><h5>¥<?php echo number_format(round($list[$i]['price']/$gsw_config['exchange']),0); ?></h5><?php } ?>	
			         
            <?php if($list[$i]['hospital'] == '2'){                                                       
             if($is_member){?>
            <h3>¥ <?php echo number_format(round($price/$gsw_config['exchange']),0); ?></h3>
            <?php }elseif($is_guest){?>
                 <h3 class="infotxt" style="font-size:12px;">本产品只提供给有合法叛卖医疗机器许可证的人<br>或者可以登入合法叛卖资格之后进行购买</h3>
            <?php }
            }elseif($list[$i]['hospital'] != '2'){?>                             
                    <h3>¥<?php echo number_format(round($price/$gsw_config['exchange']),0); ?></h3>
            <?php }?>
		</div> 
	</a>
</div>
<?php
}
?>