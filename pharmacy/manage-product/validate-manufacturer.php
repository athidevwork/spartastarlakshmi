<?php
	include("../config.php");
	$manuf = $_REQUEST['manuf'];
	$manuf = urldecode($manuf);
	$manuf = mysql_escape_string($manuf);
	$sql = mysql_query("SELECT id FROM tbl_manufacturer WHERE manufacturername = '$manuf'");
	$cnt = mysql_num_rows($sql);
	if($cnt == 0)
		echo 'invalid';
	else
		echo 'valid';
	
?>