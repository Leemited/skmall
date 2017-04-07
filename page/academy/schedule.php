<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
$toyear = date('Y'); 
$tomonth = date('m'); 
$today = date('d'); 
$year = $y?$y:$toyear; 
$month = $m?$m:$tomonth;
$time = strtotime($year.'-'.$month.'-01'); 
$next_year = date('Y',strtotime("first day of +1 months",$time)); 
$next_month = date('m',strtotime("first day of +1 months",$time));
$prev_year = date('Y',strtotime("first day of -1 month",$time)); 
$prev_month = date('m',strtotime("first day of -1 month",$time));
list($tday, $sweek) = explode('-', date('t-w', $time));  // 총 일수, 시작요일 
$tweek = ceil(($tday + $sweek) / 7);  // 총 주차 
$lweek = date('w', strtotime($year.'-'.$month.'-'.$tday));  // 마지막요일
$sql="SELECT *,(select sum(person) from `gsw_application` as b where b.academy_id=a.id and `status`<>'-1') as application FROM `gsw_academy` as a WHERE start>='{$year}-{$month}-01' and end<'{$next_year}-{$next_month}-01'";
$query=sql_query($sql);
while($data=sql_fetch_array($query)){
	$list[]=$data;
}
?>
<section class="section01">
	<header class="section01_header">
		<h1>ACADEMY</h1>
		<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo G5_URL."/page/academy"; ?>">ACADEMY</a> &gt; <a href="<?php echo G5_URL."/page/academy/schedule.php"; ?>">学院日程</a></p>
	</header>
	<nav class="section01_nav">
		<ul class="list3">
			<li><a href="<?php echo G5_URL."/page/academy"; ?>">学院介绍</a></li>
			<li class="active"><a href="<?php echo G5_URL."/page/academy/schedule.php"; ?>">学院日程</a></li>
			<li><a href="<?php echo G5_URL."/page/academy/application.php"; ?>">接收在线申请</a></li>
		</ul>
	</nav>
	<article class="section01_con" id="schedule">
		<div class="width-small-fixed wrap">
			<div class="calendar">
				<h2><a href="<?php echo G5_URL."/page/academy/schedule.php?y=".$prev_year."&m=".$prev_month; ?>" class="prev"></a><?php echo $year.".".$month; ?><a href="<?php echo G5_URL."/page/academy/schedule.php?y=".$next_year."&m=".$next_month; ?>" class="next"></a></h2>
				<table width='100%' cellpadding='0' cellspacing='1'> 
					<tr> 
						<th class="sun">日</th> 
						<th>月</th> 
						<th>火</th> 
						<th>水</th> 
						<th>木</th>
						<th>金</th>
						<th class="sat">土</th>
					</tr> 
					<? for ($n=1,$i=0; $i<$tweek; $i++){ ?> 
					<tr> 
						<? for ($k=0; $k<7; $k++){
							$class="";
							if($k==0)
								$class.="sun ";
							if($k==6)
								$class.="sat ";
							$sch="";
							$remain="";
							$link="";
							for($j=0;$j<count($list);$j++){
								if(strtotime($list[$j]['start'])<=strtotime($year.'-'.$month.'-'.$n) && strtotime($list[$j]['end'])>=strtotime($year.'-'.$month.'-'.$n)){
									$sch.="<div class='line'>";
									if(strtotime($list[$j]['start'])<=time()){
										$class.="dead ";
										if(strtotime($list[$j]['start'])==strtotime($year.'-'.$month.'-'.$n))
											$sch.="진행마감";
									}else if($list[$j]['recruit']<=$list[$j]['application']){
										$class.="over ";
										if(strtotime($list[$j]['start'])==strtotime($year.'-'.$month.'-'.$n))
											$sch.="신청마감";
									}else{
										$class.="recruit ";
										$link="javascript:curriculum_view(\"".$list[$j]['id']."\");";
										if(strtotime($list[$j]['start'])==strtotime($year.'-'.$month.'-'.$n)){
											$sch.="모집중";
											$sch.="<p>남은인원:".number_format($list[$j]['recruit']-$list[$j]['application'])."명</p>";
										}
									}
									$sch.="</div>";
								}
							}
						?> 
						<td<?php echo $class? " class='".$class."'":""; ?><?php echo $link? " onclick='".$link."'":""; ?>>
							<? if (($i == 0 && $k < $sweek) || ($i == $tweek-1 && $k > $lweek)) {echo "</td>\n";continue;}
							if($toyear==$year&&$tomonth==$month&&$today==$n){
								echo "<span class='today'></span>";
							}
							echo $n++;
							echo $sch;
							?>
						</td> 
						<? }; ?> 
					</tr> 
					<? }; ?>
				</table>
			</div>
			<div class="info">
				<ul>
					<li><span>원하는 수강일정을 선택</span>하시면 <span>커리큘럼을 확인</span>하실 수 있습니다.</li>
					<li>GSW ACADEMY는 온라인 신청 완료 후, 교육비와 기타 자세한 사항에 대하여 개별적으로 연락드리며, <br /><span>개별 상담 후 결제가 완료되어야 교육 신청이 최종 완료</span>됩니다.</li>
				</ul>
			</div>
		</div>
	</article>
</section>
<script type="text/javascript">
	function curriculum_view(id){
		$.post(g5_url+"/page/modal/academy_schedule_view.php",{id:id},function(data){
			$(".msg").html(data);
			msg_active();
		});
	}
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>
