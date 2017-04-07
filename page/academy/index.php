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
		<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo G5_URL."/page/academy"; ?>">ACADEMY</a> &gt; <a href="<?php echo G5_URL."/page/academy"; ?>">学院介绍</a></p>
	</header>
	<nav class="section01_nav">
		<ul class="list3">
			<li class="active"><a href="<?php echo G5_URL."/page/academy"; ?>">学院介绍</a></li>
<!--			<li><a href="<?php echo G5_URL."/page/academy/schedule.php"; ?>">学院日程</a></li>-->
			<li><a href="<?php echo G5_URL."/page/academy/application.php"; ?>">接收在线申请</a></li>
		</ul>
	</nav>
	<article class="section01_con" id="academy">
		<div class="intro">
			<div class="con">
				<div>
				    <img src="<?php echo G5_IMG_URL."/acsdemylogo.png"; ?>" alt="logo"><!--
					<h1>GSW ACADEMY</h1>-->
					<p>
						以丰富的现场经验与诀窍武装的韩国最佳讲师团，<br />
						根据每位学员的能力，进行针对性培训，<br />
						帮助您掌握可用于现场工作的实力。
					</p>

				</div>
			</div>
		</div>
<!--
		<div class="doctor">
			<div class="width-fixed wrap">
				<header>
					<h1 class="lg_hidden">延世YOUELLE皮肤科医疗团队培训</h1>
					<h1 class="hidden lg_show">延世YOUELLE皮肤科<br />医疗团队培训</h1>
					<p>
						可以亲自看到和学到在韩国以及海外闻名的延世YOUELLE皮肤科医疗团队的治疗。<br />
						对于学生来讲，会是一个与韩国著名医疗团队学习正确的治疗方法与掌握实务感觉的最好机会。
					</p>
				</header>
				<div class="list">
					<h2><span class="left"><i></i></span>医师介绍<span class="right"><i></i></span></h2>
					<ul>
						<li>
							<div class="img"><img src="<?php echo G5_IMG_URL."/academy_doctor_img1.png"; ?>" alt="Cho Hongchun院长" /></div>
							<div class="txt">
								<h3>Cho Hongchun院长</h3>
								<ul>
									<li>毕业于延世大学医科大学</li>
									<li>取得延世大学延世大学医疗院新村Severance医院专科医生资格</li>
									<li>取得美国医师执照(USMLE)</li>
									<li>国际亚太激光医学会会员</li>
									<li>大韩医学激光学会正式会员</li>
									<li>大韩美容外科学会正式会员</li>
									<li>大韩美容养生学会正式会员</li>
									<li>大韩肥胖体型学会正式会员</li>
									<li>大韩女性肥胖抗衰老学会正式会员</li>
								</ul>
								<ul>
									<li>大韩头皮头发学会正式会员</li>
									<li>美国明尼苏达州ST, JOHN’S HOSPITAL交换过程结业</li>
									<li>大韩美容医学会副会长</li>
									<li>德国LONG TIME LINER CONTURE MAKE-UP教授</li>
									<li>各种学会及学术大会讲座及参加节目</li>
									<li>朝鲜开城工业园免费医疗服务</li>
									<li>参加多数海外灾区医疗救援活动</li>
									<li>前)延世Roseelle济州店院长</li>
									<li>现)延世YOUELLE代表院长</li>
								</ul>
							</div>
						</li>
						<li>
							<div class="img"><img src="<?php echo G5_IMG_URL."/academy_doctor_img2.png"; ?>" alt="Park Minseok院长" /></div>
							<div class="txt">
								<h3>Park Minseok院长</h3>
								<ul>
									<li>国际亚太激光医学会会员</li>
									<li>大韩医学激光学会正式会员</li>
									<li>大韩综合美容医学会正式会员</li>
									<li>大韩干细胞治疗学会正式会员</li>
									<li>大韩美容养生学会正式会员</li>
									<li>大韩肥胖体型学会正式会员</li>
									<li>大韩肥胖治疗学会正式会员</li>
									<li>大韩天然治疗医学会正式会员</li>
									<li>大韩功能医学研究会正式会员</li>
								</ul>
								<ul>
									<li>大韩疼痛医学会正式会员</li>
									<li>2008秋季学会痤疮疤痕激光治疗访问讲座</li>
									<li>前)盆唐Ivy White皮肤科代表院长</li>
									<li>前)B&Young整形外科/皮肤科狎鸥亭店院长</li>
									<li>前)延世Roseelle门诊麻醉科院长</li>
									<li>现)延世YOUELLE门诊麻醉科院长</li>
								</ul>
							</div>
						</li>
						<li>
							<div class="img"><img src="<?php echo G5_IMG_URL."/academy_doctor_img3.png"; ?>" alt="Hwang Minhyo院长" /></div>
							<div class="txt">
								<h3>Hwang Minhyo院长</h3>
								<ul>
									<li>整形外科专科医生</li>
									<li>大韩整形外科学会会员</li>
									<li>大韩美容整形外科学会正式会员</li>
									<li>前)大田SUN医院整形外科科长</li>
									<li>前)仁济大学外科大学外来教授</li>
									<li>前)东国大学外科大学外来教授</li>
								</ul>
								<ul>
									<li>前)江南整形外科院长</li>
									<li>前)延世YOUELLE整形外科院长</li>
									<li>现)延世YOUELLE整形外科院长</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
-->
		<div class="curriculum">
			<div class="width-fixed wrap">
				<div class="left">
					<h1>大韩国际美容学院<br />共同开设课程</h1>
					<p>
						韩国唯一一家<span>与大学共同开发的正式美容课程，</span><br />
						所有讲座在济州观光大学进行，<br />
						吃住也在济州观光大学宿舍。<br />
						优秀的专业讲师团队与教育环境是GSW学院的骄傲。
					</p>
					<a href="<?php echo G5_URL."/page/academy/schedule.php"; ?>" class="btn">确认GSW ACADEMY课程 →</a>
				</div>
				<div class="right">
					<div class="lg_hidden"><img src="<?php echo G5_IMG_URL."/academy_curriculum_img1.png"; ?>" alt="image" /></div>
					<div class="hidden lg_show"><img src="<?php echo G5_IMG_URL."/academy_curriculum_img2.png"; ?>" alt="image" /></div>
				</div>
			</div>
		</div>
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
					<li><span>想了解培训课程联系到咨询区</span></li>
					<li>大韩国际美容学院申请过程<br /><span> 咨询 > 确定课程时间 > 付款 > 安排 </span></li>
				</ul>
			</div>
		</div>
	</article>
		<div class="certificate">
			<div class="width-fixed wrap">
				<div class="left">
					<div class="img"><img src="<?php echo G5_IMG_URL."/academy_certificate_img.png"; ?>" alt="济州观光大学共同开设课程" /></div>
				</div>
				<div class="right">
					<h1>
						为学员们准备<br />
						的特别待遇,<br />
						<span>颁发结业证书</span>
					</h1>
					<p>
						向参加所有教育过程的学员<br />
						颁发结业证<br />
						<span>的正式培训认证项目</span>。
					</p>
					<a href="<?php echo G5_URL."/page/academy/application.php"; ?>" class="btn">申请GSW ACADEMY →</a>
				</div>
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
