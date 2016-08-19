<?php
	$id = $_REQUEST['txt'];
	$tbl = $_REQUEST['inves'];
	$tbl=strtolower($tbl);
	include("config_db1.php");

	$query5 = "update $tbl set status='0' where id =$id";
	if(mysql_query($query5))
		echo 'ok';
	else
		echo mysql_error();
?>