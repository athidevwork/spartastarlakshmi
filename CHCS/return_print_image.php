<?php

$type=$_REQUEST['type'];

//$id = $_SESSION['username'];
	include("config_db1.php");
	$sql = "select $type from print_image where id=1";
	$result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
	header("Content-type: image/jpeg");
	echo mysql_result($result, 0);
	
	//mysql_close($db1);
?>
