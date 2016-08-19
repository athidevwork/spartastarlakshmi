<?php
	include("../config.php");
	
	$id = $_REQUEST['DBid'];
	$doctor = $_REQUEST['udoctor'];				$doctor = mysql_escape_string($doctor);
	$addressline1 = $_REQUEST['uaddressline1'];		$addressline1 = mysql_escape_string($addressline1);
	$addressline2 = $_REQUEST['uaddressline2'];		$addressline2 = mysql_escape_string($addressline2);
	$addressline3 = $_REQUEST['uaddressline3'];		$addressline3 = mysql_escape_string($addressline3);

	$city = $_REQUEST['ucity'];	
	$state = $_REQUEST['ustate'];
	$pincode = $_REQUEST['upincode'];
	$country = $_REQUEST['ucountry'];
	$contact1 = $_REQUEST['ucontact1'];
	$contact2 = $_REQUEST['ucontact2'];
	$email = $_REQUEST['uemail'];
	
	
	$sql = "UPDATE tbl_doctor SET doctorname = '$doctor', addressline1 = '$addressline1', addressline2 = '$addressline2', addressline3 = '$addressline3', city = '$city', state = '$state', country = '$country', pincode = '$pincode', contactno1 = '$contact1', contactno2 = '$contact2', emailid = '$email' WHERE id = $id";
	
	if(mysql_query($sql))
		echo 'Doctor Information Updated!';
	else
		echo mysql_error();
?>