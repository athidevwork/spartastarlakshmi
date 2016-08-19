<?php
 date_default_timezone_set('Asia/Kolkata'); 
	$pid = $_REQUEST['pid'];
	include("config_db2.php");
	$cmd = "select id, branch, patientid, patientsalutation, patientname, guardiansalutation, guardianname, age, gender, contactno, occupation, address, image, reference, cast(time as date) as time from patientdetails WHERE patientid = '$pid'";
	$res = mysql_query($cmd);
	$msg = "";
	$rs = mysql_fetch_array($res);
	$msg .= date("m/d/Y", strtotime($rs['dob'])) . '~' . $rs['branch'] . '~' . $rs['patientid'] .  '~' . $rs['patientsalutation'] .  '~' . $rs['patientname'] .  '~' . $rs['guardiansalutation'] .  '~' . $rs['guardianname'] . '~' . $rs['age'] .  '~' . $rs['gender'] .  '~' . $rs['contactno'] .  '~' . $rs['occupation'] .  '~' . $rs['address'] .  '~' . $rs['reference'] .  '~' . $rs['id'];

	echo $msg;
?>