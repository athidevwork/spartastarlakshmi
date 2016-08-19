<?php
 date_default_timezone_set('Asia/Kolkata');
	include("config_db2.php");
	$ser=$_REQUEST['ser'];
	$cmd1 = "select patientid,patientname from patientdetails where patientid='$ser' or contactno='$ser' or patientname='$ser' AND ip_id=''";
	$res1 = mysql_query($cmd1);
	$msg = "";
	while($rs1 = mysql_fetch_array($res1)){
	$pid=$rs1['patientid'];
	$name=$rs1['patientname'];
	}
	$cmd2 = "select inv_pat_id from inv_patient where patientid='$ser' AND pat_ip_status=0";
	$res2 = mysql_query($cmd2);
	$msg = "";
	while($rs2 = mysql_fetch_array($res2)){
	$inv_pat_id=$rs2['inv_pat_id'];
	}
	$pid=trim($pid," ");
	$cmd=mysql_query("select bal_amt from billing as a where a.patientid='$pid' AND ip_id='' AND balance='1' order by id DESC limit 1");
while($rs1 = mysql_fetch_array($cmd)){
	//$paid=$rs1['paid'];
		//$tot=$rs1['tot'];
		$old_bal=$rs1['bal_amt'];
}
$row="";
$cmd=mysql_query("select created_at,fees,pay from billing  where balance='1' and patientid ='$pid' AND ip_id=''");
while($rs1 = mysql_fetch_array($cmd)){
	$row.=date('d/m/Y',strtotime($rs1['created_at'])).'~'.$rs1['fees'].'~'.$rs1['pay'].'@';
}
$num=mysql_num_rows($cmd);
$row = substr($row, 0, -1);
		
		//$bal=$tot-$paid;
		$bal = $old_bal;
		if(empty($bal))
			$bal=0;
		$msg .= $pid.'~'.$name.'~'.$inv_pat_id.'~'.$bal.'+'.$row.'#'.$num;
		if(!empty($inv_pat_id))
			$msg='~~0+#0';
	    echo $msg;
	mysql_close($db2);
?>