<?php
	$p = $_REQUEST['p'];
	$q = $_REQUEST['q'];
	$r = $_REQUEST['r'];
	$s = $_REQUEST['s'];
	$psy = $_REQUEST['w'];
	$med = $_REQUEST['x'];
	$fam = $_REQUEST['y'];
	$per = $_REQUEST['z'];
	$cad = $_REQUEST['a'];
	
	$id = $_REQUEST['u'];
	
	$med = str_replace("~","<br />",$med);
	$med .= '<br />';
	
	$fam = str_replace("~","<br />",$fam);
	$fam .= '<br />';
	
	$per = str_replace("~","<br />",$per);
	$per .= '<br />';
	
	$psy = str_replace("~","<br />",$psy);
	$psy .= '<br />';
	
		
	include("config_db2.php");
	$cmd = "UPDATE medicalhistory SET diabetes= '$p',hypertension= '$r',cad='$cad',coronary= '$q',asthma= '$s',medicalhistory= '$med',familyhistory= '$fam',personalhistory= '$per',psychiatrichistory= '$psy'  WHERE id='$id'";
	if(mysql_query($cmd))
		echo 'updated';
	else
		echo $cmd .' Error : ' . mysql_error();
		
?>