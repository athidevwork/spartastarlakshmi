<?php
	include("../config.php");
	
	$doctor = $_REQUEST['doctor'];				$doctor = mysql_escape_string($doctor);
	$addressline1 = $_REQUEST['addressline1'];		$addressline1 = mysql_escape_string($addressline1);
	$addressline2 = $_REQUEST['addressline2'];		$addressline2 = mysql_escape_string($addressline2);
	$addressline3 = $_REQUEST['addressline3'];		$addressline3 = mysql_escape_string($addressline3);

	$city = $_REQUEST['city'];	
	$state = $_REQUEST['state'];
	$pincode = $_REQUEST['pincode'];
	$country = $_REQUEST['country'];
	$contact1 = $_REQUEST['contact1'];
	$contact2 = $_REQUEST['contact2'];
	$email = $_REQUEST['email'];
	
		
	$sql = "INSERT INTO tbl_doctor (id,doctorname, addressline1, addressline2, addressline3, city, state, country, pincode, contactno1, contactno2, emailid, status) VALUES (NULL, '$doctor', '$addressline1', '$addressline2', '$addressline3', '$city', '$state', '$country', '$pincode', '$contact1', '$contact2', '$email', '1')";
	if(mysql_query($sql))
		echo 'New Doctor Added!';
	else
		echo mysql_error();
?>
 
