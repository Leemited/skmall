<?php
	include_once("../../common.php");
	$id=$_POST['id'];
	$view=sql_fetch("select * from `gsw_academy` where id='".$id."'");
	if(!$id){
		echo 1;
		return false;
	}
	$view['schedule_array']=explode("||",$view['schedule']);
	for($i=0;$i<count($view['schedule_array']);$i++){
		$view['schedule_array'][$i]=explode("|",$view['schedule_array'][$i]);
		for($j=0;$j<count($view['schedule_array'][$i]);$j++){
			$view['schedule_array'][$i][$j]=explode("//",$view['schedule_array'][$i][$j]);
		}
	}
?>
<div id="schedule_view">
	<header><h2>교육일정</h2><a href="<?php echo G5_URL."/page/academy/application.php?academy=".$view['id']; ?>" class="btn01">수강신청</a></header>
	<div class="con">
		<table>
			<?php
				for($i=0;$i<count($view['schedule_array']);$i++){
			?>
			<tr>
				<th><?php echo $i+1; ?>일<span><?php echo date("n/d",strtotime("+{$i} day",strtotime($view['start']))); ?></span></th>
				<td>
				<?php
					for($j=0;$j<count($view['schedule_array'][$i]);$j++){
				?>
					<div class="grid_100">
						<div class="time">
							<?php echo $view['schedule_array'][$i][$j][0] ?>
						</div>
						<div class="content">
							<div<?php echo $view['schedule_array'][$i][$j][1]?" class='bold'":"" ?>><?php echo $view['schedule_array'][$i][$j][2] ?></div>
							<p><?php echo $view['schedule_array'][$i][$j][3]; ?></p>
						</div>
					</div>
				<?php } ?>
				</td>
			</tr>
			<?php
				}
			?>
		</table>
		<div class="btn_group">
			<a href="javascript:msg_close();" class="btn01">닫기</a>
		</div>
	</div>
</div>