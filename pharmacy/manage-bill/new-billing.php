<?php
	session_start();
	$username = $_SESSION['phar-username'];
	$pname = $_REQUEST['pname'];
	$dname = $_REQUEST['dname'];
	$phno = $_REQUEST['phno'];
	include("../config.php");
	
	$cmd = "INSERT INTO tbl_billing (id, patientid, patientname, drname, totalamt, discount, netamt, paidamt, balanceamt, datentime, username, status,phno) VALUES (NULL, '', '$pname', '$dname', '0.00', '0.00', '0.00', '0.00', '0.00', CURRENT_TIMESTAMP, '$username', '2','$phno');";
	
	mysql_query($cmd) or die("Unable to create bill");
	$last_id = mysql_insert_id();
	echo '+'.$last_id;
?>