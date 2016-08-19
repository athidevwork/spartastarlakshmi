<?php
	$dis =  $_REQUEST['dis'];
	$id = $_REQUEST['bid'];
	
	include("../config.php");
	
	//$billno = date("Y").$id;
	
	$sql = mysql_query("SELECT sum(amount) as total FROM tbl_billing_items WHERE status = 2 AND bid = $id");
	$rs = mysql_fetch_array($sql);
	$amount = $rs['total'];
	$disamt=($dis/100)*($amount);
	$disfinal=$amount-$disamt;
//	$round = round($amount,0);
	
		echo $disfinal;
	
?>