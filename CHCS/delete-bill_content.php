<?php
	$id = $_REQUEST['id'];
	include("config_db2.php");

	$query5 = "delete from billing_content where id =$id";
	if(mysql_query($query5))
		echo 'ok';
	else
		echo mysql_error();
?>