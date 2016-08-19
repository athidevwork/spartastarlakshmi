<?php
	$prod = urldecode($_REQUEST['prod']);
	$prod = mysql_escape_string($prod);
	$batch = $_REQUEST['batch'];
	
	include('../config.php');
	
	$cmd = mysql_query("SELECT id FROM tbl_productlist WHERE productname = '$prod'");
	$rs = mysql_fetch_array($cmd);
	if($rs['id']){
		$id = $rs['id'];
		$sql = mysql_query("SELECT distinct expirydate FROM tbl_purchaseitems WHERE status = 1 AND productid = $id AND batchno = '$batch' AND aval > 0");
		$array = array();
		while($r = mysql_fetch_array($sql)){
			$expirydate = implode("/",array_reverse(explode("-",$r['expirydate'])));
			$expiry = substr($expirydate,3);
			array_push($array, array("expiry"=>$expiry));
		}
		echo json_encode($array);
	}else{
		echo "error1";
	}
	
?>