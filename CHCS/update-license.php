<?php
	 include("config_db1.php");
	$key = $_REQUEST['pkey'];
	$name = $_REQUEST['pname'];
    $client = $_REQUEST['client'];
	$valid = $_REQUEST['valid'];
	$date = date('Y-m-d');
	
	$cmd = "INSERT INTO test (id, clientname, productname, licensekey, registerdate, expirydate, status) VALUES (NULL, '$client', '$name', '$key', '$date', '$valid', '1')";
	if(mysql_query($cmd)){
		mysql_query("UPDATE test SET status = 0 WHERE licensekey <> '$key'");
		echo 'success';
	}else
		echo mysql_error();
	
?>