<?php
	$id = $_REQUEST['bill'];
	include("config_db2.php");

	$query5 = "delete from billing where bill_no =$id";
	$query6 = mysql_query("delete from  billing_content where bill_no =$id");
	if(mysql_query($query5))
		echo 'ok';
	else
		echo mysql_error();
?>