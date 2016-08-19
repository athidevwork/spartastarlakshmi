<?php
	session_start();
	$username = $_SESSION['phar-username'];
	$id = $_REQUEST['id'];
	include("../config.php");
	$sql = mysql_query("SELECT * FROM tbl_requestmedicine WHERE reqid = $id");
	$rs = mysql_fetch_array($sql);
	$pid = $rs['patientid'];
	$pname = $rs['patientname'];
	$dname = $rs['doctorname'];

	$ss = mysql_query("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE TABLE_SCHEMA = '".DATABASE."' AND TABLE_NAME = 'tbl_billing'");
	$rr = mysql_fetch_array($ss);
	$billid = $rr['AUTO_INCREMENT'];
		
	$cmd = "INSERT INTO tbl_billing (id, patientid, patientname, drname, totalamt, discount, netamt, paidamt, balanceamt, datentime, username, status) VALUES (NULL, '$pid', '$pname', '$dname', '0.00', '0.00', '0.00', '0.00', '0.00', CURRENT_TIMESTAMP, '$username', '3');";
	
	if(mysql_query($cmd)){
		
		mysql_query("UPDATE tbl_requestmedicine SET status = 1, billingid = $billid WHERE reqid = $id");
		
		$sql1 = mysql_query("SELECT * FROM tbl_requestmedicine WHERE reqid = $id");
		while($rs = mysql_fetch_array($sql1)){
			$reqpid = $rs['id'];
			$prod = $rs['drugname'];
			$cmd = mysql_query("SELECT * FROM tbl_productlist WHERE productname = '$prod'");
			$r = mysql_fetch_array($cmd);
			if($r['id']){
				$code = $r['id'];
				$sql = "INSERT INTO tbl_billing_items (id, billno, bid, code, qty, batchno, expirydate, amount, purchaseid, datentime, username, status) VALUES (NULL, '', '$billid', '$code', '', '', '', '', '', CURRENT_TIMESTAMP, '$username', '3')";
			}else{
				$sql = "INSERT INTO tbl_outofstock (id, reqid, reqpid, billingid, datentime, username, status) VALUES (NULL, '$id', '$reqpid', '$billid', CURRENT_TIMESTAMP, '$username', '1')";
			}
			mysql_query($sql);
		}
		echo "Select ".$pname." in Patient Bills";
	}else{
		echo "Unable to create bill";
	}
?>