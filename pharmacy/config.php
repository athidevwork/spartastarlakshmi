<?php
	define("HOST", "localhost");
	define("USER", "root");
	define("PASS", "");
	define("DATABASE", "pharmacy");
/*	define("HOST", "cpanel.spartasolutions.in");
	define("USER", "spartas");
	define("PASS", "sparta@123");
	define("DATABASE", "spartapharmacy");*/
	$db = mysql_connect(HOST, USER, PASS) or die("Unable to connect !");		
	mysql_select_db(DATABASE,$db);
?>