<?php
include("config_db1.php");



$s=mysql_query("select * from sub_test");
	while($fetch=mysql_fetch_array($s)) {
	
	$symid=$fetch['id'];
	echo $symid;
	}
	
	include("config_db2.php");

	$s1=mysql_query("select * from investigationsub");
	while($fetch=mysql_fetch_array($s1)) {
	
	$symid=$fetch['id'];
	echo $symid;
	}
?>