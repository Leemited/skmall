<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
?>
<section class="section01">
	<header class="section01_header">
		<h1>CONCIERGE</h1>
		<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo G5_URL."/page/concierge"; ?>">CONCIERGE</a> &gt; <a href="<?php echo G5_URL."/page/concierge/skin.php"; ?>">皮肤治疗介绍</a></p>
	</header>
	<nav class="section01_nav">
		<ul class="list3">
		<!-- <ul> -->
			<li><a href="<?php echo G5_URL."/page/concierge"; ?>">关于礼宾医疗</a></li>
			<li class="active"><a href="<?php echo G5_URL."/page/concierge/skin.php"; ?>">皮肤治疗介绍</a></li>
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
					<h3>GSWMALL</h3>					
				</li>
			</ul>
		</div>
	</div>
	<article class="section01_con full_slide" id="skin">
		<div class="intro item">
			<div class="con">
				<div>
					<div class="width-fixed wrap">
						<header>
							<h1>黄褐斑•色素门诊</h1>
							<p>分析适合亚洲人的真皮性与混合性黄褐斑的类型，选择最适合患者的治疗方法。</p>
						</header>
						<table>
							<tr>
								<th>治疗对象</th>
								<td>黄褐斑、雀斑、老年斑、去除纹身、Ota母斑</td>
							</tr>
							<tr>
								<th>质量方法</th>
								<td>
									VRM激光治疗调理，光谱填充，TETHYS IPL，Ncl-Yag，<br />
									旋转填充，旋转填充，Vitaliont，Ellefine鸡尾酒美白 <br />
									护理，IRIS(Blue Toning)
								</td>
							</tr>
						</table>
						<div class="img_list">
							<ul>
								<li>
									<div><img src="<?php echo G5_IMG_URL."/skin_slide1_img1.png"; ?>" alt="before" /></div>
								</li>
								<li>
									<div><img src="<?php echo G5_IMG_URL."/skin_slide1_img2.png"; ?>" alt="after" /></div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="intro2 item">
			<div class="con">
				<div>
					<div class="width-fixed wrap">
						<header>
							<h1>痤疮门诊</h1>
							<p>要做到真正意义上的痤疮治疗，首先去除痤疮，<br />然后为了不再重发，还要消除痤疮疤痕。</p>
						</header>
						<table>
							<tr>
								<th>治疗对象</th>
								<td>炎症性粉刺，成人青春痘，复发性粉刺，痤疮疤痕</td>
							</tr>
							<tr>
								<th>治疗方法</th>
								<td>
									MILD-PDT，ALA-PDT，VH-PDT，光谱填充，旋转填充，<br />
									Fraxel Ⅱ Jenna，痤疮Scaling，MTS 
								</td>
							</tr>
						</table>
						<div class="img_list">
							<ul>
								<li>
									<div><img src="<?php echo G5_IMG_URL."/skin_slide2_img1.png"; ?>" alt="before" /></div>
								</li>
								<li>
									<div><img src="<?php echo G5_IMG_URL."/skin_slide2_img2.png"; ?>" alt="after" /></div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="intro3 item">
			<div class="con">
				<div>
					<div class="width-fixed wrap">
						<header>
							<h1>毛孔门诊</h1>
							<p>皮肤毛孔也要根据原因进行不同的治疗。<br />弹性和皮脂管理是关键。</p>
						</header>
						<table>
							<tr>
								<th>治疗对象</th>
								<td>毛孔粗大，皮脂分泌导致扩张毛孔等</td>
							</tr>
							<tr>
								<th>治疗方法</th>
								<td>
									Fraxel Ⅱ Jenna激光 + 光谱填充 + PDT<br />
									+ MTS + IRIS(Blue Toning)
								</td>
							</tr>
						</table>
						<div class="img_list">
							<ul>
								<li>
									<div><img src="<?php echo G5_IMG_URL."/skin_slide3_img1.png"; ?>" alt="before" /></div>
								</li>
								<li>
									<div><img src="<?php echo G5_IMG_URL."/skin_slide3_img2.png"; ?>" alt="after" /></div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="intro4 item">
			<div class="con">
				<div>
					<div class="width-fixed wrap">
						<header>
							<h1>疤痕•萎缩纹门诊</h1>
							<p>去除疤痕的同时，帮您清除过去的痛苦回忆。</p>
						</header>
						<table>
							<tr>
								<th>治疗对象</th>
								<td>烧伤疤痕，痤疮疤痕，手术疤痕，纹身疤痕，<br />指甲印，萎缩纹，小腿萎缩纹，妊辰纹等</td>
							</tr>
							<tr>
								<th>治疗方法</th>
								<td>
									Fraxel Ⅱ Jenna激光 + Line Cell激光 + 多孔系统 + MTS
								</td>
							</tr>
						</table>
						<div class="img_list">
							<ul>
								<li>
									<div><img src="<?php echo G5_IMG_URL."/skin_slide4_img1.png"; ?>" alt="before" /></div>
								</li>
								<li>
									<div><img src="<?php echo G5_IMG_URL."/skin_slide4_img2.png"; ?>" alt="after" /></div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="intro5 item">
			<div class="con">
				<div>
					<div class="width-fixed wrap">
						<header>
							<h1>脱毛门诊</h1>
							<p>粗细毛到颜色淡的细毛，献上光滑干净的皮肤。</p>
						</header>
						<table>
							<tr>
								<th>治疗对象</th>
								<td>脸部，腿部，胸部，背部，胡须，腋毛，比基尼线，身体脱毛</td>
							</tr>
							<tr>
								<th>治疗方法</th>
								<td>
									Jemina激光，ApogeeⅡ激光
								</td>
							</tr>
						</table>
						<div class="img_list">
							<ul>
								<li>
									<div><img src="<?php echo G5_IMG_URL."/skin_slide5_img1.png"; ?>" alt="before" /></div>
								</li>
								<li>
									<div><img src="<?php echo G5_IMG_URL."/skin_slide5_img2.png"; ?>" alt="after" /></div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="intro6 item">
			<div class="con">
				<div>
					<div class="width-fixed wrap">
						<header>
							<h1>皱纹•肉毒杆菌门诊</h1>
							<p>虽然我们不能帮您找回已流逝的时间，<br />但是可以帮您找回没有细纹的皮肤。</p>
						</header>
						<table>
							<tr>
								<th>治疗对象</th>
								<td>额头皱纹，眼角皱纹，眉间皱纹，法令纹•嘴角皱纹，松弛颈部皱纹，<br />方下巴，提升&缩小脸，面部塌陷</td>
							</tr>
							<tr>
								<th>治疗方法</th>
								<td>
									肉毒杆菌+ 填充 + Fraxel Ⅱ Jenna激光 + Line Cell激光 <br />
									+ Ultra V面部提升 + 超声刀激光
								</td>
							</tr>
						</table>
						<div class="img_list">
							<ul>
								<li>
									<div><img src="<?php echo G5_IMG_URL."/skin_slide6_img1.png"; ?>" alt="before" /></div>
								</li>
								<li>
									<div><img src="<?php echo G5_IMG_URL."/skin_slide6_img2.png"; ?>" alt="after" /></div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="item slide1">
			<div>
				<div class="width-fixed wrap">
					<header>
						<h1>기미·색소 클리닉</h1>
						<p>동양인에게 많은 진피성과 혼재성 기미타입을 분석하여 <br />환자분에게 가장 적합한 치료방법을 찾아 시술합니다.</p>
					</header>
					<table>
						<tr>
							<th>치료대상</th>
							<td>기미, 주근깨, 검버섯, 문신제거, 점, 오타모반</td>
						</tr>
						<tr>
							<th>치료방법</th>
							<td>
								VRM 레이져토닝, 스펙트라필링, TETHYS IPL, Ncl-Yag, <br />
								로테이션필링, 바이탈이온드, 엘레핀 칵테일 화이트닝 <br />
								케어, IRIS(블루토닝)
							</td>
						</tr>
					</table>
					<div class="img_list">
						<ul>
							<li>
								<div><img src="<?php echo G5_IMG_URL."/skin_slide1_img1.png"; ?>" alt="before" /></div>
							</li>
							<li>
								<div><img src="<?php echo G5_IMG_URL."/skin_slide1_img2.png"; ?>" alt="after" /></div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="item slide2">
			<div>
				<div class="width-fixed wrap">
					<header>
						<h1>여드름 클리닉</h1>
						<p>진정한 의미의 여드름 치료가 가능하려면 기존의 여드름을 없애주고 <br />재발이 안되도록하여 여드름 흉터까지 없앨 수 있어야 합니다.</p>
					</header>
					<table>
						<tr>
							<th>치료대상</th>
							<td>염증성 여드름, 성인 여드름, 재발성 여드름, 여드름흉터</td>
						</tr>
						<tr>
							<th>치료방법</th>
							<td>
								MILD-PDT, ALA-PDT, VH-PDT, 스펙트라필링, 로테이션필링, <br />
								프락셀Ⅱ제나, 여드름 스케일링, MTS
							</td>
						</tr>
					</table>
					<div class="img_list">
						<ul>
							<li>
								<div><img src="<?php echo G5_IMG_URL."/skin_slide2_img1.png"; ?>" alt="before" /></div>
							</li>
							<li>
								<div><img src="<?php echo G5_IMG_URL."/skin_slide2_img2.png"; ?>" alt="after" /></div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="item slide3">
			<div>
				<div class="width-fixed wrap">
					<header>
						<h1>모공 클리닉</h1>
						<p>피부 모공도 원인에 따라 다른 시술이 필요합니다. <br />탄력과 피지관리가 중요합니다.</p>
					</header>
					<table>
						<tr>
							<th>치료대상</th>
							<td>넓은 모공, 피지분비로 인한 모공확대 등</td>
						</tr>
						<tr>
							<th>치료방법</th>
							<td>
								프락셀Ⅱ제나레이져 + 스펙트라필링 + PDT<br />
								+ MTS + IRIS(블루토닝)
							</td>
						</tr>
					</table>
					<div class="img_list">
						<ul>
							<li>
								<div><img src="<?php echo G5_IMG_URL."/skin_slide3_img1.png"; ?>" alt="before" /></div>
							</li>
							<li>
								<div><img src="<?php echo G5_IMG_URL."/skin_slide3_img2.png"; ?>" alt="after" /></div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="item slide4">
			<div>
				<div class="width-fixed wrap">
					<header>
						<h1>흉터·튼살 클리닉</h1>
						<p>흉터는 물론 과거의 아픈 기억까지 지워드립니다.</p>
					</header>
					<table>
						<tr>
							<th>치료대상</th>
							<td>화상흉터, 여드름흉터, 수술흉터, 문신흉터, <br />손톱자국, 튼살, 종아리튼살, 임신튼살 등</td>
						</tr>
						<tr>
							<th>치료방법</th>
							<td>
								프락셀Ⅱ제나레이져 + 라인셀레이져 + 멀티홀<br />
								시스템 + MTS
							</td>
						</tr>
					</table>
					<div class="img_list">
						<ul>
							<li>
								<div><img src="<?php echo G5_IMG_URL."/skin_slide4_img1.png"; ?>" alt="before" /></div>
							</li>
							<li>
								<div><img src="<?php echo G5_IMG_URL."/skin_slide4_img2.png"; ?>" alt="after" /></div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="item slide5">
			<div>
				<div class="width-fixed wrap">
					<header>
						<h1>제모 클리닉</h1>
						<p>굵은 털은 물론, 얇고 옅은 색의 털까지 <br />매끈하고 깨끗한 피부를 만들어 드립니다.</p>
					</header>
					<table>
						<tr>
							<th>치료대상</th>
							<td>얼굴, 다리, 가슴, 등, 콧수염, 겨드랑이, 비키니라인, 전신제모</td>
						</tr>
						<tr>
							<th>치료방법</th>
							<td>
								제미나레이져, 아포지Ⅱ레이져
							</td>
						</tr>
					</table>
					<div class="img_list">
						<ul>
							<li>
								<div><img src="<?php echo G5_IMG_URL."/skin_slide5_img1.png"; ?>" alt="before" /></div>
							</li>
							<li>
								<div><img src="<?php echo G5_IMG_URL."/skin_slide5_img2.png"; ?>" alt="after" /></div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="item slide6">
			<div>
				<div class="width-fixed wrap">
					<header>
						<h1>주름·보톡스 클리닉</h1>
						<p>지나간 시간을 되돌려 드릴 수는 없지만 <br />잔주름 없는 피부로 되돌려드립니다.</p>
					</header>
					<table>
						<tr>
							<th>치료대상</th>
							<td>이마주름, 눈가주름, 미간주름, 팔자·입가주름, 처진목주름, <br />사각턱, 리프팅&얼굴축소, 처진 볼</td>
						</tr>
						<tr>
							<th>치료방법</th>
							<td>
								보톡스 + 필러 + 프락셀Ⅱ제나레이져 + 라인셀레이져 <br />
								+ 울트라V리프트 + 울트라포마레이져
							</td>
						</tr>
					</table>
					<div class="img_list">
						<ul>
							<li>
								<div><img src="<?php echo G5_IMG_URL."/skin_slide6_img1.png"; ?>" alt="before" /></div>
							</li>
							<li>
								<div><img src="<?php echo G5_IMG_URL."/skin_slide6_img2.png"; ?>" alt="after" /></div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div> -->
	</article>
</section>
<?php
include_once(G5_PATH.'/tail.php');
?>
