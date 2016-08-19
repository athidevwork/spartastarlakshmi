<?php
	$pm =  $_REQUEST['pm'];
	$billno = $_REQUEST['billno'];
	$discount = $_REQUEST['discount'];
	
	include("../config.php");
	$sql = mysql_query("sELECT sum(amount) as total FROM tbl_billing_items WHERE  billno = '$billno'	");
	//echo $sql;
	$rs = mysql_fetch_array($sql);
	$amount = $rs['total'];
	$disamt=($dis/100)*($amount);
	$disfinal=$amount-$disamt;
	mysql_query("UPDATE tbl_billing_items SET status = 1 WHERE status = 8 AND billno = $billno");
	$sql = "UPDATE tbl_billing SET status = 1,disper='$discount',discount='$disfinal', paymentmode = '$pm' WHERE status = 8 AND billno = $billno";
	if(mysql_query($sql))
		echo $billno;
	else
		echo mysql_error();
?>