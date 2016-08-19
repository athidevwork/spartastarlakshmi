<?php
	$content = $_REQUEST['content'];
	$field = $_REQUEST['field'];
	$id = $_REQUEST['id'];
	
	$content = str_replace(";","<br />",$content);
	$content .= '<br />';
	if($field == "Symptoms")
		$tablefield = "symptoms";
	else if($field == "Allergies")
		$tablefield = "allergies";	
		
	include("config_db2.php");
	$cmd = "UPDATE complaints SET $tablefield = '$content' WHERE complaintid='$id'";
	if(mysql_query($cmd))
		echo 'updated';
	else
		echo $cmd .' Error : ' . mysql_error();
		
?>