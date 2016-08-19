<?php
	$brands = $_REQUEST['brand'];
	$generic = $_REQUEST['generic'];
	$company = $_REQUEST['company'];
	
		
		$company = mysql_escape_string($company);	
		$brands = mysql_escape_string($brands);		
		$generic = mysql_escape_string($generic);	
	
		include("config_db1.php");
		$cmd = "INSERT INTO druglist (brand, company, content) VALUES ('$brands', '$company', '$generic')";
		if(mysql_query($cmd))
			echo 'inserted';
		else
			echo 'unable to insert';
		mysql_close($db1);
	
?>