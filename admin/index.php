<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	if(!$is_admin){
		alert("권한이 없습니다.",G5_URL);
	}
	$sql="select * from `g5_member` WHERE mb_id!='admin' order by `mb_no` desc limit 0,5";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$member_list[$j]=$data;
		$member_list[$j]['num']=$j+1;
		$j++;
	}
	$sql="select *,a.id as id,(select sum(person) from `gsw_application` as c where a.academy_id=c.academy_id and a.`id`>=c.`id` and a.status<>'-1') as sum_person from `gsw_application` as a inner join `gsw_academy` as b on a.academy_id=b.id where 1 order by a.`id` desc limit 0,5;";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$application_list[$j]=$data;
		$application_list[$j]['num']=$j+1;
		$j++;
	}
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>관리자페이지</h1>
			<hr />
		</header>
		<article>
			<h1 style="font-size:24px;margin-bottom:20px;font-weight:normal">회원관리 <a href="<?php echo G5_URL."/admin/member_list.php"; ?>" style="float:right;font-size:14px;vertical-align:bottom;margin-top:12px">더보기</a></h1>
			<div class="adm-table01">
				<table>
					<thead>
						<tr>
							<th class="md_none">번호</th>
							<th>아이디</th>
							<th class="md_none">최종접속일</th>
							<th>관리</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($member_list);$i++){
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['num']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_id']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo date("Y.m.d H:i",strtotime($member_list[$i]['mb_today_login'])); ?></td>
							<td><a href="<?php echo G5_URL."/admin/member_stop.php?mb_no=".$member_list[$i]['mb_no']; ?>"><?php echo $member_list[$i]['mb_intercept_date']?"활성":"정지"; ?></a></td>
						</tr>
					<?php
						}
						if(count($member_list)==0){
							echo "<tr><td colspan='9' class='text-center' style='padding:100px 0;'>목록이 없습니다</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
