<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
?>
<section class="section01">
	<header class="section01_header">
		<h1>CONCIERGE</h1>
		<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo G5_URL."/page/concierge"; ?>">CONCIERGE</a> &gt; <a href="<?php echo G5_URL."/page/concierge/plastic.php"; ?>">整容手术介绍</a></p>
	</header>
	<nav class="section01_nav">
		<ul class="list3">
			<li><a href="<?php echo G5_URL."/page/concierge"; ?>">关于礼宾医疗</a></li>
			<li><a href="<?php echo G5_URL."/page/concierge/skin.php"; ?>">皮肤治疗介绍</a></li>
			<li class="active"><a href="<?php echo G5_URL."/page/concierge/plastic.php"; ?>">整容手术介绍</a></li>
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
	<article class="section01_con full_page " id="plastic">
		<div class="width-fixed wrap layout-mod">
			<header>
				<h1>眼睛整形</h1>
				<p>为您打造适合您的脸型，更年轻、健康的美丽自信。</p>
			</header>
			<div class="con">
				<ul>
					<li>
						<div class="txt">
							<h3><span>01</span>切割法</h3>
							<p>适于眼皮下垂或脂肪层较厚、大小眼等。</p>
							<table>
								<tr>
									<th>手术时间</th>
									<td>1小时</td>
								</tr>
								<tr>
									<th>麻醉</th>
									<td>局部麻醉</td>
								</tr>
								<tr>
									<th>可化妆时期</th>
									<td>术后4~7天后</td>
								</tr>
								<tr>
									<th>优点</th>
									<td>
										可以去除下垂的眼睑。<br />
										根本上去除眼部脂肪。
									</td>
								</tr>
							</table>
						</div>
						<div class="img_list">
							<ul>
								<li>
									<h4>Before</h4>
									<div>
										<img src="<?php echo G5_IMG_URL."/plastic_slide1_img1.png"; ?>" alt="Before" />
									</div>
								</li>
								<li>
									<h4>After</h4>
									<div>
										<img src="<?php echo G5_IMG_URL."/plastic_slide1_img2.png"; ?>" alt="After" />
									</div>
								</li>
							</ul>
						</div>
					</li>
					<li>
						<div class="txt">
							<h3><span>02</span>埋线法</h3>
							<p>不切合整个双眼皮线，做几个针孔，<br />捆绑上眼肌肉的比较简单的手术，浮肿少。</p>
							<table>
								<tr>
									<th>手术时间</th>
									<td>20~30分钟</td>
								</tr>
								<tr>
									<th>麻醉</th>
									<td>局部麻醉</td>
								</tr>
								<tr>
									<th>可化妆时期</th>
									<td>术后2~4天后</td>
								</tr>
								<tr>
									<th>优点</th>
									<td>
										浮肿少，恢复快。<br />
										手术简单，时间短。几乎没有疤。
									</td>
								</tr>
							</table>
						</div>
						<div class="img_list">
							<ul>
								<li>
									<h4>Before</h4>
									<div>
										<img src="<?php echo G5_IMG_URL."/plastic_slide1_img3.png"; ?>" alt="Before" />
									</div>
								</li>
								<li>
									<h4>After</h4>
									<div>
										<img src="<?php echo G5_IMG_URL."/plastic_slide1_img4.png"; ?>" alt="After" />
									</div>
								</li>
							</ul>
						</div>
					</li>
					<li class="last">
						<div class="txt">
							<h3><span>03</span>部分切割法</h3>
							<p>结合于切割法和埋线法优点的手术，皮肤不会松弛。<br />可以采取埋线法，但是因为有脂肪而需要去除时适用。</p>
							<table>
								<tr>
									<th>手术时间</th>
									<td>30分钟</td>
								</tr>
								<tr>
									<th>麻醉</th>
									<td>局部麻醉</td>
								</tr>
								<tr>
									<th>可化妆时期</th>
									<td>术后4~7天后</td>
								</tr>
								<tr>
									<th>优点</th>
									<td>
										自然粘连，解开的概率极少。<br />
										可去除脂肪。浮肿少，恢复快。<br />
										曲线自然。
									</td>
								</tr>
							</table>
						</div>
						<div class="img_list">
							<ul>
								<li>
									<h4>Before</h4>
									<div>
										<img src="<?php echo G5_IMG_URL."/plastic_slide1_img5.png"; ?>" alt="Before" />
									</div>
								</li>
								<li>
									<h4>After</h4>
									<div>
										<img src="<?php echo G5_IMG_URL."/plastic_slide1_img6.png"; ?>" alt="After" />
									</div>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="bg">
			<div class="width-fixed wrap layout-mod" >
				<header>
					<h1>鼻子整形</h1>
				</header>
				<div class="con">
					<ul>
						<li>
							<div class="txt">
								<h3><span>01</span>提高低鼻</h3>
								<p>
									挺拔、侧面曲线好看的鼻子，总是看着更有气质，看着爽朗。<br />
									只是鼻子出现了变化，就让整个面部有曲线感与立体感。<br />
									选择考虑到自身鼻子的高度与厚度等情况的假体，<br />
									尽可能减少副作用，拥有美丽的鼻子。
								</p>
								<div>
									<div>
										<h4>软硅</h4>
										<p>比现有的硅胶更柔软，可以塑造自然的线条。</p>
									</div>
									<div>
										<h4>戈尔特斯</h4>
										<p>结合硅胶和戈尔特斯的优点<br>弥补了在明亮的地方映出来或者看到硅胶影子的缺点。.</p>
									</div>
								</div>
							</div>
							<div class="img_list">
								<ul>
									<li>
										<h4>Before</h4>
										<div>
											<img src="<?php echo G5_IMG_URL."/plastic_slide2_img1.png"; ?>" alt="Before" />
										</div>
									</li>
									<li>
										<h4>After</h4>
										<div>
											<img src="<?php echo G5_IMG_URL."/plastic_slide3_img2.png"; ?>" alt="After" />
										</div>
									</li>
								</ul>
							</div>
						</li>
						<li class="last">
							<div class="txt">
								<h3><span>02</span>鼻尖塑形</h3>
								<p>鼻尖圆或者向下的情况，<br />可以结合隆鼻术或单独塑造漂亮的鼻尖。</p>
								<div>
									<div>
										<h4>鼻翼软骨术</h4>
										<p>
											调整鼻翼软骨，并不意味着成为尖鼻。<br />
											可以对圆形、斜型鼻孔形状塑形，自然聚拢。<br />
											通过耳软骨和鼻翼软骨移植呈现鼻部曲线。
										</p>
									</div>
								</div>
							</div>
							<div class="img_list">
								<ul>
									<li>
										<h4>Before</h4>
										<div>
											<img src="<?php echo G5_IMG_URL."/plastic_slide2_img3.png"; ?>" alt="Before" />
										</div>
									</li>
									<li>
										<h4>After</h4>
										<div>
											<img src="<?php echo G5_IMG_URL."/plastic_slide2_img4.png"; ?>" alt="After" />
										</div>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="width-fixed wrap layout-mod" >
			<header>
				<h1>面部轮廓</h1>
				<p>	
					面部轮廓术是让脸型变小、温和改变的手术方法，有面部畸形矫正术、<br />
					缩小颧骨的颧骨缩小术、方下巴缩小术、下巴凸出的撅下巴、相反下巴不明显的无下巴等，<br />
					而额头有凹凸不齐额头整形术，还有针对额头宽大的额头缩小术等，都属于面部轮廓矫正术。
				</p>
			</header>
			<div class="con">
				<ul>
					<li>
						<div class="txt">
							<h3><span>01</span>方下巴整形</h3>
							<p>
								从正面看下巴两边明显凸出，侧面看也严重有角的下巴就叫方下巴。<br />
								微创方下巴缩小术适于侧面看方下巴严重，正面看不太严重，而且没有充足恢复时间的情况。
							</p>
							<div>
								<div>
									<h4>小切口方下巴缩小术</h4>
									<p>侧脸看着方下巴严重，正面看起来不严重的情况，<br />或者恢复时间不充足的情况下选择。</p>
								</div>
							</div>
						</div>
						<div class="img_list">
							<ul>
								<li>
									<h4>Before</h4>
									<div>
										<img src="<?php echo G5_IMG_URL."/plastic_slide3_img1.png"; ?>" alt="Before" />
									</div>
								</li>
								<li>
									<h4>After</h4>
									<div>
										<img src="<?php echo G5_IMG_URL."/plastic_slide2_img2.png"; ?>" alt="After" />
									</div>
								</li>
							</ul>
						</div>
					</li>
					<li>
						<div class="txt">
							<h3><span>02</span>颧骨整形</h3>
							<div>
								<div>
									<h4>微创颧骨缩小术</h4>
									<p>
										通过1cm左右的嘴内部切割，使用特殊仪器手术，易于伤口管理，术后立即可以用餐。<br />
										具备手术时间短，浮肿少，可以快速恢复日常的优点。<br />
									</p>
								</div>
							</div>
						</div>
						<div class="img_list">
							<ul>
								<li>
									<h4>Before</h4>
									<div>
										<img src="<?php echo G5_IMG_URL."/plastic_slide3_img3.png"; ?>" alt="Before" />
									</div>
								</li>
								<li>
									<h4>After</h4>
									<div>
										<img src="<?php echo G5_IMG_URL."/plastic_slide3_img4.png"; ?>" alt="After" />
									</div>
								</li>
							</ul>
						</div>
					</li>
					<li class="last">
						<div class="txt">
							<h3><span>03</span>无下巴整形</h3>
							<div>
								<div>
									<h4>截骨术</h4>
									<p>
										将向后凹的下颏骨切下，整体向前挪动的方法。<br />
										挪动整个骨头，所以下巴形状会更自然，脖子曲线更美丽，还有舒缓下巴的优点。<br />
										但是需要全身麻醉。<br />
									</p>
								</div>
								<div>
									<h4>插入假体</h4>
									<p>
										下巴插入戈尔特斯、硅胶、曼特波等假体，放大或改变下巴大小的方式。<br />
										如果无下巴情况不严重，可以局部麻醉。
									</p>
								</div>
							</div>
						</div>
						<div class="img_list">
							<ul>
								<li>
									<h4>Before</h4>
									<div>
										<img src="<?php echo G5_IMG_URL."/plastic_slide3_img5.png"; ?>" alt="Before" />
									</div>
								</li>
								<li>
									<h4>After</h4>
									<div>
										<img src="<?php echo G5_IMG_URL."/plastic_slide3_img6.png"; ?>" alt="After" />
									</div>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="bg">
			<div class="width-fixed wrap layout-mod" >
				<header>
					<h1>面部提升</h1>
				</header>
				<div class="con2">
					<div class="txt">
						<span>选</span>用特殊线矫正面部皱纹的手术已在韩国流传1~2年的时间，而现在已经有多家医疗机构也在使用这个新方法。但是具体手术方法略有不同，且效果也呈现细微不同。 <br /> <br />
						延世YOUELLE整形外科的Hwang Minhyo院长在尝试各种方式的过程中，努力寻找着改善手术技术，并且更有效的方法。因此才能达到满意的手术技术，而且于2004年将这个方法发表到大韩美容整形外科学会。<br /> <br />
						这个手术方法使用一种线，而将线插入某个部位，拉向哪一方才是关键。因此，我们认为需要使用在美容整形外科学会发表的那种更结实的线，做到强力拉皮。而这就是与其他方法最大的不同。<br /><br />
						作为衰老导致的皱纹整形专业机构，延世YOUELLE整形外科基于对老化的更多经验，得出以下结论。<br />
						延世YOUELLE整形外科的这项手术方法达到最好的效果，功劳于我们的经验与技术。<br />
						通过这项新方法，期待让为皱纹而苦恼的顾客体验满意的结果。
					</div>
					<div class="img">
						<img src="<?php echo G5_IMG_URL."/plastic_slide3_img.png"; ?>" alt="Before&after" />
					</div>
				</div>
			</div>
		</div>
		<div class="width-fixed wrap layout-mod" >
			<header>
				<h1>脂肪移植术</h1>
				<p>除皱术有几种方法，其中有削掉皮肤上层的剥皮术、肉毒杆菌等麻痹肌肉、防皱纹的注射法、使用胶原蛋白和r玻尿酸等让皱纹鼓起的注射法，还有抚平皱纹手术等。</p>
			</header>
			<div class="con3">
				<div class="left">
					<h2>脂肪移植术的优点</h2>
					<p>
						1.肌肉内脂肪移植，生成率与持续性高。<br />
						2.减少淤血和浮肿。<br />
						3.呈现自然曲线。<br />
						4.减少额外手术的负担。<br />
						5.缩短恢复时间。
					</p>
				</div>
				<div class="right">
					<h2>脂肪移植术适应阶段</h2>
					<p>
						适用于因脸上没肉，看似疲惫或上了年纪的脸型，换成年轻、健康的印象。而且深皱纹或下陷的疤痕、凹进去的太阳穴和脸颊，或者随着年龄的增加凸显的上眼皮或面颊等。<br /><br />
						注入的脂肪在移植的部位稳定定位的生成率根据手术部位的条件或因患者而异。但是比不同的脂肪移植手术的生成率高。
					</p>
				</div>
			</div>
			<div class="img_list2">
				<ul>
					<li><img src="<?php echo G5_IMG_URL."/plastic_slide5_img1.png"; ?>" alt="嘴角皱纹" /></li>
					<li><img src="<?php echo G5_IMG_URL."/plastic_slide5_img2.png"; ?>" alt="法令纹" /></li>
					<li class="last"><img src="<?php echo G5_IMG_URL."/plastic_slide5_img3.png"; ?>" alt="额头" /></li>
				</ul>
			</div>
		</div>
		<div class="bg">
			<div class="width-fixed wrap layout-mod" >
				<header>
					<h1>抽脂&肥胖门诊</h1>
				</header>
				<div class="con">
					<ul>
						<li>
							<div class="txt">
								<h3><span>01</span>全层抽脂</h3>
								<p>
									近年来对美体的追求不断增加。<br />
									全层抽脂几乎没有反弹现象，完成美丽的身体与曲线。
								</p>
								<div>
									<div>
										<h4>治疗对象</h4>
										<p>腹部，游泳圈，大腿，小腿，胳膊，双下巴</p>
									</div>
								</div>
							</div>
							<div class="img_list">
								<ul>
									<li>
										<h4>Before</h4>
										<div>
											<img src="<?php echo G5_IMG_URL."/plastic_slide6_img1.png"; ?>" alt="Before" />
										</div>
									</li>
									<li>
										<h4>After</h4>
										<div>
											<img src="<?php echo G5_IMG_URL."/plastic_slide6_img2.png"; ?>" alt="After" />
										</div>
									</li>
								</ul>
							</div>
						</li>
						<li class="last">
							<div class="txt">
								<h3><span>02</span>肥胖门诊</h3>
								<p>个性化选择项目，每月8次治疗，<br />让您感受身体的变化。</p>
								<div>
									<div>
										<h4>PPC</h4>
										<p>
											非手术消脂术、PPC注射一般隔三周到1~2个月，每次最多接受3~5次治疗。<br />
											PPC会破碎脂肪细胞的结合，破坏脂肪质，通过液体状淋巴循环，以汗或者小便的形式排出。
										</p>
									</div>
									<div>
										<h4>脂肪组织(ADIPO-TOGTIS)</h4>
										<p>
											一般高频是皮肤或表皮层发热，<br />
											而ROMANCE-IPR在细胞组织产热。
										</p>
									</div>
									<div>
										<h4>治疗类型</h4>
										<p>
											PPC，羧基，中胚层疗法，HPL，高频，击碎脂肪团
										</p>
									</div>
								</div>
							</div>
							<div class="img_list">
								<ul>
									<li>
										<h4>Before</h4>
										<div>
											<img src="<?php echo G5_IMG_URL."/plastic_slide6_img3.png"; ?>" alt="Before" />
										</div>
									</li>
									<li>
										<h4>After</h4>
										<div>
											<img src="<?php echo G5_IMG_URL."/plastic_slide6_img4.png"; ?>" alt="After" />
										</div>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</article>
</section>
<?php
include_once(G5_PATH.'/tail.php');
?>
