<?php
	include("config_db2.php");
	$fileTempName = $_FILES['RemoteFile']['tmp_name'];
	//$user = $_REQUEST['username']; 
	//$mrdno = $_REQUEST['mrdno'];
	$pid=$_REQUEST['pid'];
	$name=$_REQUEST['name'];
	
	$imgData =addslashes(file_get_contents($_FILES['RemoteFile']['tmp_name']));
	$cmd = "insert into $name (created_by, pid, scan_image) values('$name', '$pid','{$imgData}')";
	if(!mysql_query($cmd))
		echo 'error';
?>