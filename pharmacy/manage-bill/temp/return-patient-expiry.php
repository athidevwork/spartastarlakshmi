<?php
	$id = $_REQUEST['id'];
	$batch = $_REQUEST['batch'];
	
	include('../config.php');
	
	$sql = mysql_query("SELECT distinct expirydate FROM tbl_purchaseitems WHERE status = 1 AND productid = $id AND batchno = '$batch' AND aval > 0");
	$array = array();
	while($r = mysql_fetch_array($sql)){
		$expirydate = implode("/",array_reverse(explode("-",$r['expirydate'])));
		$expiry = substr($expirydate,3);
		array_push($array, array("expiry"=>$expiry));
	}
	echo json_encode($array);
	
?>