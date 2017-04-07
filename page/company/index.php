<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
?>
<section class="section01">
	<header class="section01_header">
		<h1>COMPANY</h1>
		<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo G5_URL."/page/company"; ?>">COMPANY</a> &gt; <a href="<?php echo G5_URL."/page/company"; ?>">关于公司</a></p>
	</header>
	<nav class="section01_nav">
		<ul>
			<li class="active"><a href="<?php echo G5_URL."/page/company"; ?>">关于公司</a></li>
			<li><a href="<?php echo G5_URL."/page/company/business.php"; ?>">关于事业</a></li>
		</ul>
	</nav>
	<article class="section01_con" id="company">
		<div class="wrap">
			<div class="company_intro">
				<div class="company_bg">
					<div class="company_blue_bg"></div>
					<div class="company_pattern_bg"></div>
				</div>
				<div class="width-fixed">
					<div>
						<div class="company_logo_bg">
							<div><i></i></div>
						</div>
						<div class="company_txt">
							<div>
								<span>GORILLA SMARTWAY</span>起名来自象征智慧的大猩猩为主题，<br />
								开括Global Health Care新典范的<span class="green">医疗解决方案</span> <br /><br />
								<span>通过皮肤专家培训、韩国优秀美容设备的流通及促销、吸引外国患者等，</span><br />
								为<span class="green">韩国皮肤美容产业的全球化</span>而成立，<br />
								基于每个领域韩国最佳皮肤美容机构的合作，致力于通过稳定顾客及对外信任、<br />
								专门差异化服务来在海外市场确保更有竞争力的位置
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="company_info">
				<div class="width-fixed">
					<div>
						<ul>
							<li>
								<div class="padd left"></div>
								<header><h2>GSW ACADEMY</h2></header>
								<div class="padd bottom"></div>
								<div class="title"><h4>全球皮肤美容科学院</h4></div>
								<div class="padd bottom"></div>
								<div class="con">
									<p>
										- 大韩国际美容学院运营
										丰富的现场经验与诀窍武装的韩国最佳讲师
										进行全面的皮肤理论课程和 通过韩国最新的皮肤管理技法和
										 传授实操课程 进行完整的感受以及进行熟练的教育课程 <br><br>
								        - 运营大学和医院 相连的海外 <br>医疗产业从事者 对象医疗进修羡慕 
									</p>
								</div>
								<div class="padd right"></div>
							</li>
							<li>
								<div class="padd left"></div>
								<header><h2>GSW MALL</h2></header>
								<div class="padd bottom"></div>
								<div class="title"><h4>精选及流通优秀美容医疗设备</h4></div>
								<div class="padd bottom"></div>
								<div class="con">
									<p>
										对著名医疗团队亲自<br />挑选的优秀美容医<br />疗设备及化妆品的介<br />绍和流通销售
									</p>
								</div>
								<div class="padd right"></div>
							</li>
							<li>
								<div class="padd left"></div>
								<header><h2>GSW MEDICAL<br />CONCIERGE</h2></header>
								<div class="padd bottom"></div>
								<div class="title"><h4>吸引国外医疗观光游客项目</h4></div>
								<div class="padd bottom"></div>
								<div class="con">
									<p>
										与拥有最好的医疗团队和美容<br />
										设备的济州延世YOUELLE<br />
										诊所的独家合作，<br />
										提供高级一站式医疗服务
									</p>
								</div>
								<div class="padd right"></div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="company_contact">
				<div class="width-fixed">
					<div class="email">
						<a href="mailto:info@gsmartway.com">
							<div>
								<h1>E-MAIL</h1>
								<p>INFO@GSMARTWAY.COM</p>
							</div>
						</a>
					</div>
					<div class="phone">
						<a href="tel:821072777833">
							<div>
								<h1>PHONE</h1>
								<p>82-10-7277-7833</p>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="company_consult">
				<div class="width-fixed">
					<div class="left">
						<i></i>
						<p>Gorilla Smart Way为了提供更可靠和成熟的服务于解决方案，<br />与大韩美容医学会(KAASM)医疗团队组成的咨询委员会联手。</p>
					</div>
					<div class="right">
						<ul>
							<li>大韩美容医学会医疗团队</li>
							<li>济州365诊疗Kim Hyungjun院长</li>
							<li>济州YOUELLE皮肤科Cho Hongchun院长</li>
							<li>济州YOUELLE皮肤科Park Minseok院长</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="partner">
			<div class="con">
				<div>
					<h1>PARTNER SHIP</h1>
					<div class="slide">
						<div class="owl-carousel">
							<div class="item"><div><img src="<?php echo G5_IMG_URL."/business_partner1.png"; ?>" alt="" /></div></div>
							<div class="item"><div><img src="<?php echo G5_IMG_URL."/business_partner2.png"; ?>" alt="" /></div></div>
							<!-- <div class="item"><div><img src="<?php echo G5_IMG_URL."/business_partner3.png"; ?>" alt="" /></div></div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
</section>
<script type="text/javascript">
	$(function(){
		var owl1=$("#company .partner .slide > div");
		owl1.owlCarousel({
			autoplay:false,
			smartSpeed:2000,
			loop:true,
			dots:false,
			nav:true,
			navText: [ '', '' ],
			items:1,
			touchDrag:false,
			mouseDrag:false,
			pullDrag:false,
			freeDrag:false,
			animateOut: 'fadeOut',
			responsive:{
				480:{
					stagePadding:312
				},
				768:{
					stagePadding:244
				},
				981:{
					stagePadding:417
				}
			}
		});
	});
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>
