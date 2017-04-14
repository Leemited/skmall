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
?>