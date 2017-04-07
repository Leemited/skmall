<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
$contact=sql_fetch("select * from gsw_config");
?>
<section class="section01">
	<header class="section01_header">
		<h1>CONTACT</h1>
		<p><a href="<?php echo G5_URL; ?>">HOME</a> &gt; <a href="<?php echo G5_URL."/page/contact"; ?>">CONTACT</a> &gt; <a href="<?php echo G5_URL."/page/contact"; ?>">CONTACT</a></p>
	</header>
	<nav class="section01_nav">
		<ul>
			<li class="active"><a href="<?php echo G5_URL."/page/contact"; ?>">CONTACT</a></li>
			<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=qna"; ?>">Q&amp;A</a></li>
		</ul>
	</nav>
	<article class="section01_con" id="contact">
		<div class="width-fixed wrap">
			<header>
				<i></i>
				<h2>我们会用心<br />倾听顾客的宝贵意见。</h2>
			</header>
			<div class="width-small-fixed">
				<div class="box">
					<ul>
						<li class="tel">
							<i></i>
							<h3><?php echo $contact['call']; ?></h3>
							<p>咨询时间 <?php echo $contact['time']; ?></p>
						</li>
						<li class="kakao">
							<i></i>
							<h3>KAKAO TALK</h3>
							<p>gswmall</p>
						</li>
						<li class="wechat">
							<i></i>
							<h3>WE CHAT</h3>
							<p>gswmall</p>
						</li>
					</ul>
				</div>
				<div class="address">
					<h3>OFFICE ADDRESS</h3>
					<p><?php echo $contact['addr1']; ?> <?php echo $contact['addr2']; ?></p>
				</div>
			</div>
		</div>
		<!-- <div id="map"></div> -->
	</article>
</section>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChVVEdtGfI0cXlKa_kPrCj-f9TeyNuMm4&callback=initMap"
	async defer></script>
<script type="text/javascript">
	var addr1=$("#addr1").val();
	var name=$("#name").val();
	var tel=$("#tel").val();
	function initMap() {
			var mapOptions = {
								zoom: 15, // 지도를 띄웠을 때의 줌 크기
								mapTypeId: google.maps.MapTypeId.ROADMAP
							};
			var map = new google.maps.Map(document.getElementById("map"), // div의 id과 값이 같아야 함. "map-canvas"
										mapOptions);
			var size_x = 40; // 마커로 사용할 이미지의 가로 크기
			var size_y = 40; // 마커로 사용할 이미지의 세로 크기
		 
			// 마커로 사용할 이미지 주소
			//var image = new google.maps.MarkerImage( '',new google.maps.Size(size_x, size_y),'', '', new google.maps.Size(size_x, size_y));
			 
			// Geocoding *****************************************************
			var address = addr1; // DB에서 주소 가져와서 검색하거나 왼쪽과 같이 주소를 바로 코딩.
			var marker = null;
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode( { 'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					map.setCenter(results[0].geometry.location);
					marker = new google.maps.Marker({
						map: map,
						 //icon: image,  마커로 사용할 이미지(변수)
						title: name, // 마커에 마우스 포인트를 갖다댔을 때 뜨는 타이틀
						position: results[0].geometry.location
					});
	 
					var content = "<span style='color:#000;'>"+name+"<br/>Tel: "+tel+"</span>"; // 말풍선 안에 들어갈 내용
				 
					// 마커를 클릭했을 때의 이벤트. 말풍선 뿅~
					var infowindow = new google.maps.InfoWindow({ content: content});
					google.maps.event.addListener(marker, "click", function() {infowindow.open(map,marker);});
				} else {
					alert("Geocode was not successful for the following reason: " + status);
				}
				document.getElementById('direction_select').addEventListener('change', function() {
					geocodeAddress(geocoder, map);
				});
			});
			// Geocoding // *****************************************************
			 
		}
		google.maps.event.addDomListener(window, 'load', initialize);
		function geocodeAddress(geocoder, resultsMap) {
		  var address = $("#direction_select option:selected").attr("data-addr1");
		  name = $("#direction_select").val();
		  tel = $("#direction_select option:selected").attr("data-tel");
		  geocoder.geocode({'address': address}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
			  resultsMap.setCenter(results[0].geometry.location);
			  var marker = new google.maps.Marker({
				map: resultsMap,
				title: name,
				position: results[0].geometry.location
			  });
				var content = "<span style='color:#000;'>"+name+"<br/>Tel: "+tel+"</span>"; // 말풍선 안에 들어갈 내용
				// 마커를 클릭했을 때의 이벤트. 말풍선 뿅~
				var infowindow = new google.maps.InfoWindow({ content: content});	
				google.maps.event.addListener(marker, "click", function() {infowindow.open(map,marker);});
			} else {
			  alert('Geocode was not successful for the following reason: ' + status);
			}
		  });
		}
</script> -->
<?php
include_once(G5_PATH.'/tail.php');
?>
