<?php
	$pm =  $_REQUEST['pm'];
	$id = $_REQUEST['id'];
	$dis = $_REQUEST['dis'];
	$remind = $_REQUEST['remind'];
	//$remind = 2;
	$Date = date('Y-m-d');
	$rmiddate= date('Y-m-d', strtotime($Date. ' + '.$remind.' days'));
	//exit();
	include("../config.php");
	
	$billno = date("Y").$id;
	
	$sql = mysql_query("SELECT sum(amount) as total FROM tbl_billing_items WHERE status = 2 AND bid = $id");
	$rs = mysql_fetch_array($sql);
	$amount = $rs['total'];
	if($dis !=0) {
	$disamt=($dis/100)*($amount);
	$disfinal=$amount-$disamt; 
	}
	else {
	$disamt=0;
	$disfinal=$amount;
	}
//	$round = round($amount,0);
	mysql_query("UPDATE tbl_billing_items SET billno = $billno, status = 1 WHERE status = 2 AND bid = $id");
	mysql_query("UPDATE tbl_billing_items SET status = 10 WHERE status = 3 AND bid = $id");
	$sql = "UPDATE tbl_billing SET billno = $billno, status = 1, totalamt = $disfinal, netamt = $amount, paidamt = $amount, paymentmode = '$pm',discount='$disamt',disper='$dis',reminderdate='$rmiddate' WHERE (status = 2 or status = 3) AND id = $id";
	if(mysql_query($sql))
		echo $billno;
	else
		echo mysql_error();
?>