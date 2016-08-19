<?php
	$id = $_REQUEST['x'];
	//$aller = $_REQUEST['y'];
	$sym = $_REQUEST['s'];
	
		$content = str_replace("~","<br />",$sym);
	$content .= '<br />';
		
		
	include("config_db2.php");
	$cmd = "UPDATE complaints SET symptoms = '$content' WHERE complaintid='$id'";
	if(mysql_query($cmd))
		echo 'updated';
	else
		echo $cmd .' Error : ' . mysql_error();
?>