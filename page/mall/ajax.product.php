<?php
/**
 * Created by PhpStorm.
 * User: Pc
 * Date: 2017-04-12
 * Time: 오후 2:17
 */
include_once('../../common.php');

$id = $_REQUEST["id"];
$color = $_REQUEST["color"];
if(!$id)
    echo "1";
$sql="select *,(select sum(number) from `gsw_sell` as s where p.id=s.product_id and s.status<>'-1') as sell from `gsw_product` as p where `show`<>'0' and `id`='{$id}'";
$view=sql_fetch($sql);

$image = explode(",",$view["photo"]);
$image1 = explode(",",$view["photo1"]);
$image2 = explode(",",$view["photo2"]);
$image3 = explode(",",$view["photo3"]);
$image4 = explode(",",$view["photo4"]);

for($i=0;$i<count($image);$i++){
    $img[$i][0]=$image1[$i];
    $img[$i][1]=$image2[$i];
    $img[$i][2]=$image3[$i];
    $img[$i][3]=$image4[$i];
}
?>

<div class="owl-carousel">
    <?php
    for($i=0;$i<count($img[$color]);$i++){
        ?>
        <div class="item"><img src="<?php echo G5_DATA_URL."/product/".trim($img[$color][$i]); ?>" alt="<?php echo $view['title']?>" /></div>
        <?php
    }
    ?>
</div>
<script>
    $(function(){
        var owl1=$(".owl-carousel");
        owl1.owlCarousel({
            items:1,
            loop:false,
            center:true,
            dots:true,
            margin:10,
        });
    });
</script>