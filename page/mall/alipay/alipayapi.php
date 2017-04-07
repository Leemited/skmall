<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>支付宝支付宝境外商户交易创建接口接口</title>
</head>
<?php
/* *
 * 功能：支付宝境外商户交易创建接口接入页
 * 版本：3.3
 * 修改日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************注意*************************
 * 如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
 * 1、商户服务中心（https://b.alipay.com/support/helperApply.htm?action=consultationApply），提交申请集成协助，我们会有专业的技术工程师主动联系您协助解决
 * 2、商户帮助中心（http://help.alipay.com/support/232511-16307/0-16307.htm?sh=Y&info_type=9）
 * 3、支付宝论坛（http://club.alipay.com/read-htm-tid-8681712.html）
 * 如果不想使用扩展功能请把扩展功能参数赋空值。
 */

require_once("../../../common.php");
require_once("alipay.config.php");
require_once("lib/alipay_submit.class.php");

/**************************请求参数**************************/
        // 商户订单号
        $out_trade_no = $_POST['WIDout_trade_no'];
        // 清算币种
        $currency = $_POST['WIDcurrency'];
        // 商品名称
        $subject = $_POST['WIDsubject'];
        // 商品描述
        $body = $_POST['WIDbody'];
        // 商品人民币金额
        $total_fee = $_POST['WIDrmb_fee'];
		
		/*
		$product_id=$_POST['product_id'];
		$category=$_POST['category'];
		$number=$_POST['number'];
		$price=$_POST['price'];
		$delivery=$_POST['delivery'];
		$total_price=$_POST['total_price'];
		$mb_id=$_POST['mb_id'];
		$code=$_POST['code'];
		$mb_name=$_POST['mb_name'];
		$mb_email=$_POST['mb_email'];
		$mb_hp=$_POST['mb_hp'];
		$mb_addr=$_POST['mb_addr'];
		$re_name=$_POST['re_name'];
		$re_hp=$_POST['re_hp'];
		$content=nl2br($_POST['content']);
		$sql="select *,(select sum(number) from `gsw_sell` as s where p.id=s.product_id and s.status<>'-1') as sell from `gsw_product` as p where `show`<>'0' and `id`='{$product_id}'";
		$view=sql_fetch($sql);
		if(!$view['id'])
			alert('제품을 찾을 수 없습니다.',G5_URL."/page/mall/list?category=".urlencode($category));
		if($view['out'] || $view['number']-$view['sell']<$number)
			alert('본 상품은 매진되었거나, 개수가 부족합니다.',G5_URL."/page/mall/list?category=".urlencode($category));
		$sql="INSERT INTO  `gsw_sell` (`product_id` ,`number` ,`price` ,`delivery` ,`total_price` ,`payment` ,`mb_id`,`code` ,`mb_name` ,`mb_email` ,`mb_hp` ,`mb_addr` ,`re_name` ,`re_hp` ,`content` ,`status` ,`datetime`, `key`) VALUES ('{$product_id}',  '{$number}',  '{$price}',  '{$delivery}',  '{$total_price}',  '알리페이',  '{$mb_id}',  '{$code}',  '{$mb_name}',  '{$mb_email}',  '{$mb_hp}','{$mb_addr}',  '{$re_name}',  '{$re_hp}',  '{$content}',  '0',now(),'{$out_trade_no}');";
		sql_query($sql);
		*/
		$od_code=$_POST['od_code'];
		$price=$_POST['price'];
		$delivery=$_POST['delivery'];
		$total_price=$_POST['total_price'];
		$mb_id=$_POST['mb_id'];
		$code=$_POST['code'];
		$mb_name=$_POST['mb_name'];
		$mb_email=$_POST['mb_email'];
		$mb_hp=$_POST['mb_hp'];
		$mb_addr=$_POST['mb_addr'];
		$re_name=$_POST['re_name'];
		$re_hp=$_POST['re_hp'];
		$content=nl2br($_POST['content']);
		$where="c.od_code={$od_code}";
		$sql="select *,c.id as id,c.number as number,p.number as total from `gsw_cart` as c inner join `gsw_product` as p on c.product_id=p.id where {$where} order by c.datetime desc";
		$query=sql_query($sql);
		$i=0;
		while($data=sql_fetch_array($query)){
			if($data['out'] || $data['total']-$data['sell']<$data['number'])
				alert('数量不足的配制或出售产品。',G5_URL."/page/mypage/cart.php");
			$i++;
		}
		if($i<=0)
			alert('잘못된 접근입니다.',G5_URL."/page/mypage/cart.php");
		$sql="INSERT INTO  `gsw_order` (`od_code` ,`title`, `number`,`price` ,`delivery` ,`total_price` ,`payment` ,`mb_id`,`code` ,`mb_name` ,`mb_email` ,`mb_hp` ,`mb_addr` ,`re_name` ,`re_hp` ,`content` ,`status` ,`datetime`, `key`) VALUES ('{$od_code}','{$title}', '{$number}', '{$price}',  '{$delivery}',  '{$total_price}',  '알리페이',  '{$mb_id}',  '{$code}',  '{$mb_name}',  '{$mb_email}',  '{$mb_hp}','{$mb_addr}',  '{$re_name}',  '{$re_hp}',  '{$content}',  '0',now(),'{$out_trade_no}');";
		sql_query($sql);
if(is_mobile()){
	$service="create_forex_trade_wap";
}else{
	$service="create_forex_trade";
}

/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"service" => $service,
		"partner" => trim($alipay_config['partner']),
		"out_trade_no"	=> $out_trade_no,
		"currency"	=> $currency,
		"subject"	=> $subject,
		"body"	=> $body,
		"total_fee"	=> $total_fee,
		"rmd_fee"	=> $total_fee,
		//"notify_url"    => "http://gswmall.cn/page/mall/alipay/notify_url.php",
		"return_url"    => "http://gswmall.cn/page/mall/alipay/return_url.php",
		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
echo $html_text;

?>
</body>
</html>