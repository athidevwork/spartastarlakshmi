<?php
	include("../config.php");
	
	$id = $_REQUEST['DBid'];
	$product = $_REQUEST['uproduct'];			$product = mysql_escape_string($product);
	$generic = $_REQUEST['ugeneric'];			$generic = mysql_escape_string($generic);
	$manufacturername = $_REQUEST['umanufact'];	$manufacturername = mysql_escape_string($manufacturername);
	
	$q = mysql_query("SELECT id FROM tbl_manufacturer WHERE manufacturername = '$manufacturername'");
	$rs = mysql_fetch_array($q);
	$manufacturer = $rs['id'];
	
	$schedule = $_REQUEST['uschedule'];
	$producttype = $_REQUEST['uproducttype'];	
	$unitdesc = $_REQUEST['uunitdesc'];
	$stocktype = $_REQUEST['ustocktype'];
	$ptax = $_REQUEST['uptax'];
	$stax = $_REQUEST['ustax'];
	//$mrp = $_REQUEST['umrp'];
	//$price = $_REQUEST['uprice'];
	$minqty = $_REQUEST['uminqty'];
	$maxqty = $_REQUEST['umaxqty'];
	$shelf = $_REQUEST['ushelf'];
	$rack = $_REQUEST['urack'];
	
	$sql = "UPDATE tbl_productlist SET productname = '$product', genericname = '$generic', scheduletype = '$schedule', producttype = '$producttype', manufacturer = '$manufacturer', unitdesc = '$unitdesc', stocktype = '$stocktype', purchasetax = '$ptax', salestax = '$stax', minqty = '$minqty', maxqty = '$maxqty', shelf = '$shelf', rack = '$rack' WHERE id = $id";
	
	if(mysql_query($sql))
		echo 'Product Information Updated!';
	else
		echo mysql_error();
?>