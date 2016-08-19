<?php
 date_default_timezone_set('Asia/Kolkata');
	include("config_db2.php");
	$ser=$_REQUEST['ser'];
	$cmd1 = "select patientid,patientname from patientdetails where patientid='$ser' or contactno='$ser' or patientname='$ser'";
	$res1 = mysql_query($cmd1);
	
	$msg = "";
	while($rs1 = mysql_fetch_array($res1)){
	$pid=$rs1['patientid'];
	$name=$rs1['patientname'];
		
	}
	$pid=trim($pid," ");
	//echo $pid;
		//echo "SELECT bill_no FROM billing WHERE cast(created_at as date) = '".date("Y-m-d")."' order by id desc limit 1";
	$cmd=mysql_query("SELECT bill_no FROM billing WHERE cast(created_at as date) = '".date("Y-m-d")."' and patientid='$pid' order by id desc limit 1");
while($rs1 = mysql_fetch_array($cmd)){
	$bill_number=$rs1['bill_no'];
		//$tot=$rs1['tot'];
}//echo $paid;


		
		//$bal=$tot-$paid;
		$msg .= $pid.'~'.$name.'~'.$bill_number;
	//$msg = substr($msg, 0, -1);
	echo $msg;
	mysql_close($db2);
?>