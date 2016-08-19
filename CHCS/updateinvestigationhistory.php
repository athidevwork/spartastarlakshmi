<?php
 date_default_timezone_set('Asia/Kolkata'); 
	//$content = $_REQUEST['content'];
	$assets = $_REQUEST['assets'];
	//$id = $_REQUEST['id'];
	//$len=sizeof($assets);
//	$i=1;
		include("config_db2.php");
	foreach($assets as $asset => $key){
	$cmd = "UPDATE investigationreport SET complaint = '$key[3]',notes = '$key[4]' WHERE id='$key[1]'";
	mysql_query($cmd);
	}
	//echo $cmd;
	//if($i==$len)
		echo 'updated';
	//else
		//echo ' Error : ' . mysql_error();
		
?>