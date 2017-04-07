<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
?>
<section class="section01">
	<header class="section01_header">
		<h1>COMPANY</h1>
		<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo G5_URL."/page/company"; ?>">COMPANY</a> &gt; <a href="<?php echo G5_URL."/page/company/business.php"; ?>">关于事业</a></p>
	</header>
	<nav class="section01_nav">
		<ul>
			<li><a href="<?php echo G5_URL."/page/company"; ?>">关于公司</a></li>
			<li class="active"><a href="<?php echo G5_URL."/page/company/business.php"; ?>">关于事业</a></li>
		</ul>
	</nav>
	<article class="section01_con" id="business">
		<div class="academy">
			<div class="con">
				<div>
					<h1><img src="<?php echo G5_IMG_URL."/academy_logo_img.png";?>" alt="" /></h1>
					<p>
						GSW是大韩国际美容学院的运营进行皮肤管理理论以及最新皮肤管理技术<br/>
                        以丰富的现场经验与诀窍武装的韩国最佳讲师团，<br/>
                        根据每位学员的能力，进行针对性培训，<br/>
                        帮助您掌握可用于现场工作的实力。<br/>
                        以及与大韩美容医学会联手进行海外医疗事业 针对有医师资格证的院长进行医疗进修课程<br/>
                        提供韩国的美容医学技术以及向全世界开发多年的经验 多样的机会<br/>
					</p>
					<a href="<?php echo G5_URL."/page/academy"; ?>">打开GSW ACADEMY →</a>
				</div>
			</div>
		</div>
		<div class="mall">
			<div class="con">
				<div>
					<h1>GSW MALL</h1>
					<p>
						Gorilla Smart Way想把如雨后春笋般生产的众多美容医疗设备中<br />
						具备真正功效的韩国优秀的美容医疗设备向海外宣传。<br /><br />
						为此，由大韩美容学会（KAASM）医疗团队组成的咨询委员团，<br />
						经过亲自测试，获得功能与功效的详细认证。<br />
						为您选择介绍最好的美容医疗设备。
					</p>
					<a href="<?php echo G5_URL."/page/mall"; ?>">打开GSW ACADEMY →</a>
				</div>
			</div>
		</div>
		<div class="concierge">
			<div class="con">
				<div>
					<h1>GSW MEDICAL CONCIERGE</h1>
					<p>
						Gorilla Smart Way为了国外想接受韩国优秀医疗团队手术及治疗的顾客，<br />
						运营提供一站式服务的医疗礼宾项目。<br />
						与拥有最好的医疗团队与最佳设备的济州延世YOUELLE诊所进行独家合作，提供高级医疗服务。<br />
					</p>
					<a href="<?php echo G5_URL."/page/concierge"; ?>">打开GSW CONCIERGE →</a>
				</div>
			</div>
		</div>
	</article>
</section>
<?php
include_once(G5_PATH.'/tail.php');
?>
