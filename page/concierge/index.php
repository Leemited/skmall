<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
?>
<section class="section01">
	<header class="section01_header">
		<h1>CONCIERGE</h1>
		<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo G5_URL."/page/concierge"; ?>">CONCIERGE</a> &gt; <a href="<?php echo G5_URL."/page/concierge"; ?>">关于礼宾医疗</a></p>
	</header>
	<nav class="section01_nav">
		<ul class="list3">
		<!-- <ul> -->
			<li class="active"><a href="<?php echo G5_URL."/page/concierge"; ?>">关于礼宾医疗</a></li>
			<li><a href="<?php echo G5_URL."/page/concierge/skin.php"; ?>">皮肤治疗介绍</a></li>
			<li><a href="<?php echo G5_URL."/page/concierge/plastic.php"; ?>">整容手术介绍</a></li>
		</ul>
	</nav>
	<?php
	$contact=sql_fetch("select * from gsw_config");
	?>
	<div class="wrap">
		<div class="contact_box">
			<h3>皮肤护理及整形咨询</h3>
			<ul>
				<li class="tel">
					<i></i>
					<h3><?php echo $contact['call']; ?></h3>
					<p>咨询时间 <?php echo $contact['time']; ?></p>
				</li>
				<li class="wechat">
					<i></i>
					<h3>WE CHAT</h3>
					<p>gswmall</p>
				</li>
			</ul>
		</div>
	</div>
	<article class="section01_con fullpage" id="concierge">
		<div class="intro">
			<div class="con">
				<div>
					<div class="width-fixed wrap">
						<header>
							<h1>GSW MEDICAL<br />CONCIERGE</h1>
							<p>
								GORILLA SMARTWAY 为了国外想接受韩国优秀医疗团队手术及治疗的顾客，<br />
								运营提供一站式服务的医疗礼宾项目。<br /><br />
								与拥有最好的医疗团队与最佳设备的济州延世YOUELLE诊所<br />
								进行独家合作，提供高级医疗服务。
							</p>
						</header>
<!--						<a href="http://www.youelle.co.kr/" target="_blank" class="btn">延世YOUELLE首页 →</a>-->
					</div>
				</div>
			</div>
			<i></i>
		</div>
	
		<div class="process">
			<div class="con">
				<div>
					<header>
						<h1 class="text-center lg_hidden">GSW ACADEMY <span>PROCESS</span></h1>
						<h1 class="text-center hidden lg_show">GSW ACADEMY<br /><span>PROCESS</span></h1>
					</header>
					<div class="width-fixed">
						<ul>
							<li>
								<span>01</span>
								<h3>咨询/入境前服务</h3>
								<div>
									<ul>
										<li>专业协调员当地医疗咨询</li>
										<li>出入境签证相关检查，咨询时执行旅行日程及航空服务</li>
									</ul>
								</div>
							</li>
							<li>
								<span>02</span>
								<h3>欢迎服务</h3>
								<div>
									<ul>
										<li>欢迎服务</li>
										<li>为VIP护理的24小时1:1服务，保障身份的VIP警卫服务</li>
									</ul>
								</div>
							</li>
							<li>
								<span>03</span>
								<h3>酒店预订服务</h3>
								<div>
									<ul>
										<li>根据用户偏好的个性化预订服务，快速入住服务</li>
										<li>美容美发联系服务，24小时协调员 / 指导护理服务</li>
									</ul>
								</div>
							</li>
							<li>
								<span>04</span>
								<h3>医院接待服务</h3>
								<div>
									<ul>
										<li>EXPRESS手续服务，医疗协调员跟踪服务</li>
										<li>医药医疗保险联系服务，检查结果服务-回国后<br />通过检查结果USB提供信息</li>
									</ul>
								</div>
							</li>
						</ul>
						<ul>
							<li>
								<span>05</span>
								<h3>车辆接应服务</h3>
								<div>
									<ul>
										<li>连接机场和医院的一站式服务，酒店住宿与<br />医院的大巴服务，叫车服务</li>
									</ul>
								</div>
							</li>
							<li>
								<span>06</span>
								<h3>协调员应答服务</h3>
								<div>
									<ul>
										<li>配备为外国顾客的口译服务</li>
										<li>公司专属医疗协调员分配服务，根据诊疗项目的特征，<br />安排适合的协调员</li>
									</ul>
								</div>
							</li>
							<li>
								<span>07</span>
								<h3>FOOD CARE服务</h3>
								<div>
									<ul>
										<li>符合恢复治疗的菜单服务，提前预约迅速服务，<br />提前通知菜单服务</li>
										<li>分配质量保证餐馆</li>
									</ul>
								</div>
							</li>
							<li>
								<span>08</span>
								<h3>欢送/事后管理服务</h3>
								<div>
									<ul>
										<li>EXPRESS手续服务，医疗协调员提供服务</li>
										<li>医疗保险联系服务，检查结果服务-回国后 <br />通过USB提供检查结果信息</li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</article>
</section>
	<section class="section01">
	    <article class="section01_con" id="academy">
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
								<h3>Cho Hongchun 院长</h3>
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
<!--
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
-->
						<li>
							<div class="img"><img src="<?php echo G5_IMG_URL."/academy_doctor_img3.png"; ?>" alt="Hwang Minhyo院长" /></div>
							<div class="txt">
								<h3>Hwang Minhyo 院长</h3>
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
							<li>
							<div class="img"><img src="<?php echo G5_IMG_URL."/academy_doctor_img2.png"; ?>" alt="Hwang Minhyo院长" /></div>
							<div class="txt">
								<h3>Lee SangLae 院长</h3>
								<ul>
									<li>中央大学校 医科大学毕业/li>
									<li>新村医院Severance医院 家庭医学科 专科医生培训</li>
									<li>国际阿泰激光医学会会员</li>
									<li>大韩医学激光学会正会员</li>
									<li>大韩美容Well-bing 学会正会员</li>
									<li>大韩头皮毛发学会正会员</li>
									<li>大韩美容外科学会正会员</li>
									<li>北朝鲜开城工团免费医疗服务</li>
									<li>激光学会多数讲课</li>
								</ul>
								
									
								<ul>
                                    <li>半永久玻尿酸 专家医生</li>
                                    <li>原任）延世 iellefine 院长</li>
                                    <li>现任）Yonsei Youelle 院长</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	    </article>
	</section>
<script type="text/javascript">
	$(function(){
		$("#concierge .advantage .con .owl-carousel").owlCarousel({
			autoplay:false,
			smartSpeed:2000,
			loop:true,
			dots:false,
			nav:true,
			touchDrag:false,
			mouseDrag:false,
			pullDrag:false,
			freeDrag:false,
			items:1,
			navText: [ '', '' ],
			responsive:{
				1300:{
					items:3
				}
			}
		});
	});
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>
