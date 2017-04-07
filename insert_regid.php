<?php
include_once './_common.php';
//include_once "./head.sub.php";
//registration ID 를 저장한다.
if ($_GET['regID']) {
	//$memberID = $member['mb_id']
    $regID = mysql_real_escape_string($_GET['regID']);
		
    $sql = "select count(*) as cnt from  GCM_RegistrationId where registrationId = '$regID'";
	$rs = mysql_query($sql);
    $cnt = mysql_fetch_array($rs);

    if ($cnt['cnt'] > 0) {
        //update
        $sql = "update GCM_RegistrationId set updateDate = now() where registrationId = '$regID' ";
		mysql_query($sql);
    } else if ($cnt['cnt'] == 0) {
        //insert
        $sql = "insert into GCM_RegistrationId (registrationId, insertDate, activity) values ('$regID', now(), 1)";
		mysql_query($sql);
    }    
}
?>
