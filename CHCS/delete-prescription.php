<?php
	$id = $_REQUEST['maxid'];
	include("config_db2.php");

	$query5 = "delete from prescriptiondetail where slno =$id";
	if(mysql_query($query5))
		echo 'ok';
	else
		echo mysql_error();
?>