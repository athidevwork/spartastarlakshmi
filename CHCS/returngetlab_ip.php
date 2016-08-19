 <?php
 date_default_timezone_set('Asia/Kolkata');
 function get_lab_det($lab_id,$lab_full_det)
   {
		include("config_db1.php");
		$lab_id = strtolower($lab_id);
		
	$ex=mysql_query("select * from $lab_id where id = '$lab_full_det'");
	$ex1=mysql_fetch_array($ex);
	$sym=$ex1['sym'];
	return $sym;
	}
	include("config_db2.php");
	$ser=$_REQUEST['ser'];
	$cmd1 = "select pd.patientid,pd.patientname,ipd.inv_pat_id from patientdetails pd JOIN `inv_patient` ipd ON pd.patientid = ipd.patientid WHERE pd.patientid='$ser' AND ipd.pat_ip_status=0";
	$res1 = mysql_query($cmd1);
	
	$msg = "";
	if(mysql_num_rows($res1) ==1){
		while($rs1 = mysql_fetch_array($res1)){
			$pid=$rs1['patientid'];
			$name=$rs1['patientname'];
			$ip_pid = $rs1['inv_pat_id'];
			
		}
		$pid=trim($pid," ");
		$msg = $pid.'~'.$name;
	}
	 
	 echo $msg;
?>