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
	$cmd2 = "select inv_pat_id from inv_patient where patientid='$ser' or contactno='$ser' or patientname='$ser'";
	$res2 = mysql_query($cmd2);
	$msg = "";
	while($rs2 = mysql_fetch_array($res2)){
	$inv_pat_id=$rs2['inv_pat_id'];
	}
	$pid=trim($pid," ");
	$cmd=mysql_query("select sum(a.fees)as tot ,sum(a.pay) as paid from billing as a where a.patientid='$pid'");
while($rs1 = mysql_fetch_array($cmd)){
	$paid=$rs1['paid'];
		$tot=$rs1['tot'];
}
$row="";
$cmd=mysql_query("select created_at,fees,pay from billing  where balance='1' and patientid ='$pid'");
while($rs1 = mysql_fetch_array($cmd)){
	$row.=date('d/m/Y',strtotime($rs1['created_at'])).'~'.$rs1['fees'].'~'.$rs1['pay'].'@';
}
$num=mysql_num_rows($cmd);
$row = substr($row, 0, -1);
		
		$bal=$tot-$paid;
		$msg .= $pid.'~'.$name.'~'.$inv_pat_id.'~'.$bal.'+'.$row.'#'.$num;
	    echo $msg;
	mysql_close($db2);
?>