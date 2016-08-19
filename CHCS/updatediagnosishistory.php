<?php
	$content = $_REQUEST['x'];
	$field = $_REQUEST['y'];
	$id = $_REQUEST['u'];
	
	$content = str_replace("~","<br />",$content);
	$content .= '<br />';
	$field = str_replace("~","<br />",$field);
	$field .= '<br />';
		
	include("config_db2.php");
	$cmd = "UPDATE tbl_diagnosis SET diagnosis = '$field', provisionaldiagnosis='$content' WHERE complaintid='$id'";
	if(mysql_query($cmd))
		echo 'updated';
	else
		echo ' Error : ' . mysql_error();
		
?>