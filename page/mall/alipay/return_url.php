<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */

require_once("../../../common.php");
require_once("../../../lib/mailer.lib.php");
require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
?>

<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
	//订单外币金额
	$total_fee = $_GET['total_fee'];

	//清算币种
	$currency = $_GET['currency'];

	//商户订单号
	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号
	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];


	//判断是否在商户网站中已经做过了这次通知返回的处理
		//如果没有做过处理，那么执行商户的业务程序
		//如果有做过处理，那么不执行商户的业务程序
	$return_id=explode("-",$out_trade_no);
	$return_id=$return_id[1];
	$sql="select * from `gsw_order` where `key`='{$out_trade_no}'";
	$view=sql_fetch($sql);
	$sql="update `gsw_order` set `payment`='알리페이' ,`status`='1' ,`datetime`=now() where `key`='{$out_trade_no}'";
	sql_query($sql);
	$sql="update `gsw_cart` set `od_status`='1' where `od_code`='{$view['od_code']}'";
	sql_query($sql);
	alert('결제되었습니다.',G5_URL."/page/mypage/cart.php");
	echo "验证成功<br />";

	$sql = "select * from `gsw_order` where `od_code` = '{$view['od_code']}'";
	$res = sql_query($sql);
	$row = sql_fetch_array($res);
	
	$con .= "<h2>(".$row['mb_id'].") 订货信息</h2>";
	$con .= "<table style='border-spacing:0px;'>";
	$con .= "<tr><th style='border:1px solid #ddd;font-size:14px;padding:14px;background:#eee'>商品名称</th><td style='border:1px solid #ddd;font-size:14px;padding:14px;'>".$row['title']."</td></tr>";
	$con .= "<tr><th style='border:1px solid #ddd;font-size:14px;padding:14px;background:#eee'>数量</th><td style='border:1px solid #ddd;font-size:14px;padding:14px;'>".$row['number']."</td></tr>";
	$con .= "<tr><th style='border:1px solid #ddd;font-size:14px;padding:14px;background:#eee'>价格</th><td style='border:1px solid #ddd;font-size:14px;padding:14px;'>".$row['price']."</td></tr>";
	$con .= "<tr><th style='border:1px solid #ddd;font-size:14px;padding:14px;background:#eee'>运费</th><td style='border:1px solid #ddd;font-size:14px;padding:14px;'>".$row['delivery']."</td></tr>";
	$con .= "<tr><th style='border:1px solid #ddd;font-size:14px;padding:14px;background:#eee'>总合</th><td style='border:1px solid #ddd;font-size:14px;padding:14px;'>".$row['total_price']."</td></tr>";
	$con .= "</table>";

	mailer('GSWMALL','info@gsmartway.com',$row['mb_email'] ,"订单信息-GSWMALL",$con);

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>
        <title>支付宝支付宝境外商户交易创建接口</title>
	</head>
    <body>
    </body>
</html>