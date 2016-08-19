<?php 
	$id = $_REQUEST['id'];
	include("config_db2.php");
	$sql = "select scan_image from record where id=".$id;
	$result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
	header("Content-type: image/jpeg");
	echo mysql_result($result, 0);
	mysql_close($db2);
?>