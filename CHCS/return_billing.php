 <?php
	include("config_db2.php");
	 $cmd1 = "select patientid,contactno,patientname,inv_pat_id from inv_patient WHERE pat_ip_status=0 order by id asc";
	$res1 = mysql_query($cmd1);
	$msg = "";
	while($rs1 = mysql_fetch_array($res1)){
		$msg .= $rs1['patientid'].'-'.$rs1['contactno'].'-'.$rs1['patientname'].'-'.$rs1['inv_pat_id'].'~';
	}
	$msg = substr($msg, 0, -1);
	echo $msg;
	mysql_close($db2);
?>