<?php

	session_start();
	$username = $_SESSION['phar-username'];
	

	$batch = $_REQUEST['xpbatch'];
	
	$qty = $_REQUEST['pqty'];	$temp = $qty;
	$expiry = $_REQUEST['pexpiry'];	$exp = $expiry;
	$expiry = "27/".$expiry;
	$expiry = implode("-",array_reverse(explode("/",$expiry)));
	
	$dbval = $_REQUEST['dbval'];
	
	include('../config.php');
	
	$cmd = mysql_query("SELECT * FROM tbl_billing_items WHERE id = $dbval");
	$rs = mysql_fetch_array($cmd);
	if($rs['code']){
		$code = $rs['code'];
		$bid = $rs['bid'];
		$q = mysql_fetch_array(mysql_query("SELECT * FROM tbl_productlist WHERE id = $code"));
		$unit = $q['unitdesc'];
		$sql = mysql_query("SELECT * FROM tbl_purchaseitems WHERE status = 1 AND productid = $code AND batchno = '$batch' AND expirydate = '$expiry'");
		while($r = mysql_fetch_array($sql)){
			if($temp != 0){
				if($r['aval'] > $temp){
					$ids[] = array("id"=>$r['id'],"qty"=>$temp);
					$amount = $amount + ($temp * ($r['mrp'] / $unit));
					$temp = 0;
					break;
				}else{
					$ids[] = array("id"=>$r['id'],"qty"=>$r['aval']);
					$amount = $amount + ($r['aval'] * ($r['mrp'] / $unit));
					$temp = $temp - $r['aval'];
				}
			}else
				break;
		}
		for($i=0 ; $i<count($ids); $i++){
			$purchaseid .= $ids[$i]['id'] . '-' . $ids[$i]['qty'] . ';';
		}		
		$purchaseid = substr($purchaseid, 0, -1);
		
		$sql = "UPDATE tbl_billing_items SET qty = '$qty', batchno = '$batch', expirydate = '$expiry', amount = '$amount', purchaseid = '$purchaseid', status = 2 WHERE id = $dbval";
		if(mysql_query($sql)){
			for($i=0 ; $i<count($ids); $i++){
				$ii =  $ids[$i]['id'];
				$q =  $ids[$i]['qty'];
				$cmd = "UPDATE tbl_purchaseitems SET aval = aval - $q WHERE id = $ii";
				mysql_query($cmd);
			}
			$array = array("qty"=>$qty,"batch"=>$batch,"expi"=>$exp,"amt"=>$amount,"id"=>$dbval,"bid"=>$bid);
			echo json_encode($array);
		}else
			echo mysql_error();
	}else{
		echo "error1";
	}
	
?>