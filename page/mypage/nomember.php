<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
if($is_member)
	goto_url(G5_URL);
?>
<header class="section01_header hidden lg_show">
	<h1>购买列表登录</h1>
</header>
<div class="member_section" id="lost">
	<header>
		<h1>购买列表登录</h1>
		<p>确认购买/退款状态。<br />请输入购买产品时登记的信息</p>
	</header>
	<div>
		<div class="id">
			<h3>登录</h3>
			<p>请输入注册的会员信息。</p>
			<div>
				<form action="<?php echo G5_URL."/bbs/login_check.php"; ?>" method="post" autocomplete="off">
					<input type="text" name="mb_id" id="mb_id" required class="input02 grid_100" placeholder="用户名" />
					<input type="password" name="mb_password" id="mb_password" required class="input02 grid_100" placeholder="密码" />
					<input type="submit" value="确认" class="btn01" />
				</form>
			</div>
		</div>
		<div>
			<h3>非会员购买确认</h3>
			<p>请输入购买时登记的姓名和电子邮件地址。</p>
			<div>
				<form action="<?php echo G5_URL."/page/mypage/buy_list.php"; ?>"  method="post" autocomplete="off">
					<input type="text" name="mb_name" id="mb_name" required class="input02 grid_100" placeholder="姓名" />
					<input type="text" name="mb_email" id="mb_email" required class="input02 grid_100" placeholder="电子邮件地址" />
					<input type="submit" value="确认" class="btn01" />
				</form>
			</div>
		</div>
	</div>
</div>
<?php
include_once(G5_PATH.'/tail.php');
?>
