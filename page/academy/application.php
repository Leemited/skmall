<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
$date=date("Y-m-d");
$sql="SELECT *,(select sum(person) from `gsw_application` as b where b.academy_id=a.id and `status`<>'-1') as application FROM `gsw_academy` as a WHERE start>'{$date}'";
$query=sql_query($sql);
while($data=sql_fetch_array($query)){
	$list[]=$data;
}
if($academy){
	$aca=sql_fetch("SELECT * FROM `gsw_academy` as a WHERE id='{$academy}'");
}
?>
<section class="section01">
	<header class="section01_header">
		<h1>ACADEMY</h1>
		<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo G5_URL."/page/academy"; ?>">ACADEMY</a> &gt; <a href="<?php echo G5_URL."/page/academy/application.php"; ?>">接收在线申请</a></p>
	</header>
	<nav class="section01_nav">
		<ul class="list3">
			<li><a href="<?php echo G5_URL."/page/academy"; ?>">学院介绍</a></li>
<!--			<li><a href="<?php echo G5_URL."/page/academy/schedule.php"; ?>">学院日程</a></li>-->
			<li class="active"><a href="<?php echo G5_URL."/page/academy/application.php"; ?>">接收在线申请</a></li>
		</ul>
	</nav>
	<article id="join">
		<div class="wrap write01 width-small-fixed section01_con">
			<form action="<?php echo G5_URL."/page/application_update.php"; ?>" method="post" id="application_form">
				<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
				<ul>
					<li>
						<input type="text" id="reg_mb_name" name="mb_name" value="<?php echo $member['mb_name'] ?>" required class="input01 grid_100" size="10" placeholder="姓名(英文)" />
					</li>
					<li>
						<div class="grid_40">
							<label for="mb_1" class="input01 grid_100 select01"<?php echo $member['mb_1']?" style='color:#000;'":""; ?>>
								<div><?php echo $member['mb_1']?"+".$member['mb_1']:"国家代码"; ?><span></span></div>
								<select name="mb_1" id="mb_1" class="input01 grid_100 light_gray" required>
									<option value="">国家代码</option>
									<option value="86" data-label="+86" <?php echo $member['mb_1']=="86"?"selected":""; ?>>中国</option>
									<option value="852" data-label="+852" <?php echo $member['mb_1']=="852"?"selected":""; ?>>香港</option>
									<option value="82" data-label="+82" <?php echo $member['mb_1']=="86"?"selected":""; ?>>韩国</option>
								</select>
							</label>
						</div>
						<div class="grid_60">
							<input type="tel" name="mb_hp" value="<?php echo $member['mb_hp'] ?>" id="reg_mb_hp" required class="input01 grid_100" maxlength="20" placeholder="手机号码" onkeyup="return number_only(this);" />
						</div>
					</li>
					<li>
						<input type="text" name="person" id="person" required class="input01 grid_100" maxlength="20" placeholder="听课人数" onkeyup="return number_only(this);" />
					</li>
					<li>
						<label for="academy_id" class="input01 grid_100 select01"<?php echo $aca['id']?" style='color:#000;'":"" ?>>
							<div><?php echo $aca['id']?$aca['start']."~".$aca['end']:"希望听课日期" ?><span></span></div>
							<select name="academy_id" id="academy_id" class="input01 grid_100 light_gray" required>
								<option value="">希望听课日期</option>
								<?php
								for($i=0;$i<count($list);$i++){
									if($list[$i]['application']>=$list[$i]['recruit'])
										continue;
								?>
								<option value="<?php echo $list[$i]['id']; ?>" data-label="<?php echo $list[$i]['start']; ?>~<?php echo $list[$i]['end']; ?>" <?php echo $academy==$list[$i]['id']?" selected":""; ?>><?php echo $list[$i]['start']; ?>~<?php echo $list[$i]['end']; ?> (<?php echo number_format($list[$i]['application']); ?>/<?php echo number_format($list[$i]['recruit']); ?>)</option>
								<?php
								}
								?>
							</select>
						</label>
					</li>
					<div class="agree"></div>
					<input type="submit" value="申请" class="lg_btn01 grid_100">
				</ul>
			</form>
		</div>
	</article>
</section>
<script type="text/javascript">
	$(function () {
		$('#application_form').on('submit', function (e) {
			$.ajax({
				type: 'post',
				url: 'application_update.php',
				data: $('#application_form').serialize(),
				success: function (data) {
					if(data==1){
						alert('请选择您想要的课程日期');
					}else if(data==2){
						alert('可以接收每班人数超标。');
					}else if(data==3){
						alert('发生了问题。请联系您的\n管理员或\n请重试。');
					}else if(data){
						alert('发生了问题。请联系您的\n管理员或\n请重试。\n'+data);
					}else{
						$(".msg").load(g5_url+"/page/modal/academy_application_complete.php",function(data){
							msg_active();
						});
						$('#application_form input').val('');
						$('#application_form select').val('');
					}
				},
				error:function(){
					alert('发生了问题。请联系您的\n管理员或\n请重试。');
				}
			});
			return false;
		});
	});
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>
