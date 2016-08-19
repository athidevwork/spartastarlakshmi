<?php
	include("../config.php");
	
	$id = $_REQUEST['DBid'];
	$supplier = $_REQUEST['usupplier'];				$supplier = mysql_escape_string($supplier);
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
	$tin = $_REQUEST['utin'];
	$cst = $_REQUEST['ucst'];
	
	$sql = "UPDATE tbl_supplier SET suppliername = '$supplier', addressline1 = '$addressline1', addressline2 = '$addressline2', addressline3 = '$addressline3', city = '$city', state = '$state', country = '$country', pincode = '$pincode', contactno1 = '$contact1', contactno2 = '$contact2', emailid = '$email', tin = '$tin', cst = '$cst' WHERE id = $id";
	
	if(mysql_query($sql))
		echo 'Supplier Information Updated!';
	else
		echo mysql_error();
?>