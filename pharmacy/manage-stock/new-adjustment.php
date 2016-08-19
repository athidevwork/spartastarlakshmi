<?php
	session_start();
	$username = $_SESSION['phar-username'];
	
	$prod = $_REQUEST['pname'];
	$prod = mysql_escape_string($prod);
	$adjtype = $_REQUEST['adjtype'];
	$avail = $_REQUEST['avail'];
	$batch = $_REQUEST['batch'];
	$mr = $_REQUEST['mr'];
	$expiry = $_REQUEST['expiry'];
	$expiry = "27/".$expiry;
	$expiry = implode("-",array_reverse(explode("/",$expiry)));
	
	$qty = $_REQUEST['qty'];	$temp = $qty;
	$reason = $_REQUEST['reason'];
	
	include("../config.php");
	$cmd = mysql_query("SELECT * FROM tbl_productlist WHERE productname = '$prod'");
	$rs = mysql_fetch_array($cmd);
	$code = $rs['id'];
	$unit = $rs['unitdesc'];
	$mrp = $rs['mrp'];
	
	if($adjtype == 'Deletion'){
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
		for($i=0 ; $i<count($ids); $i++){
			$ii =  $ids[$i]['id'];
			$q =  $ids[$i]['qty'];
			$cmd = "UPDATE tbl_purchaseitems SET aval = aval - $q WHERE id = $ii";
			mysql_query($cmd);
		}
	}else{
		$ss = mysql_query("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE TABLE_SCHEMA = '".DATABASE."' AND TABLE_NAME = 'tbl_stockadjustment'");
		$rr = mysql_fetch_array($ss);
		$purchaseid = $rr['AUTO_INCREMENT'] . '-' . $qty;
		
		$cmd = "INSERT INTO tbl_purchaseitems (id, purchaseid, invoiceno, productid, qty, freeqty, batchno, expirydate, pprice, mrp, vat, grossamt, netamt, aval, username, datentime, status) VALUES (NULL, '0', '0', '$code', '$qty', '0', '$batch', '$expiry', '0', '$mr', '0', '0', '0', '$qty', '$username', CURRENT_TIMESTAMP, '1')";
		mysql_query($cmd);
	}
	
	$cmd = "INSERT INTO tbl_stockadjustment (id, productid, qty, batchno, expiry, adjtype, adjreason, purchaseid, username, datentime, status) VALUES (NULL, '$code', '$qty', '$batch', '$expiry', '$adjtype', '$reason', '$purchaseid', '$username', CURRENT_TIMESTAMP, '1')";
	if(mysql_query($cmd))
		echo 'Stock Adjusted Successfully';
	else
		echo mysql_error();
?>