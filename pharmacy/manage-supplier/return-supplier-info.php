<?php
	$supplier = urldecode($_REQUEST['supplier']);
	include("../config.php");
	$sql = "SELECT * FROM tbl_supplier WHERE suppliername = '$supplier'";
	$res = mysql_query($sql);
	$rs = mysql_fetch_array($res);
	$status = ($rs['status'] == 1) ? "<span class='label label-sm label-success arrowed-in arrowed-in-right'>Active</span>" : "<span class='label label-sm label-arrowed arrowed-in arrowed-in-right'>Expired</span>";
	
	$array = array("id"=>$rs['id'],"supp"=>$rs['suppliername'], "add1"=>$rs['addressline1'], "add2"=>$rs['addressline2'], "add3"=>$rs['addressline3'], "city"=>$rs['city'], "state"=>$rs['state'], "country"=>$rs['country'], "pin"=>$rs['pincode'], "con1"=>$rs['contactno1'], "con2"=>$rs['contactno2'], "emailid"=>$rs['emailid'], "tin"=>$rs['tin'], "cst"=>$rs['cst'], "status"=>$status);
	
	print json_encode($array);
?>