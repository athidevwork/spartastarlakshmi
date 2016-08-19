<?php
	session_start();
	$user = $_SESSION['username'];
include("config_db1.php");	
include("config_db2.php");  
date_default_timezone_set('Asia/Kolkata');

function check_invoices($inv_pat_id1)
{
	$Isql=mysql_query("select * from inv_patient where inv_pat_id='$inv_pat_id1' AND pat_ip_status='0'");
	$rscount=mysql_num_rows($Isql);
	return $rscount;
} 
	if($_POST['action']=="Save")
	{
		$patientid=$_POST['patientid'];
		$patientname=$_POST['patientname'];
		$branch=$_POST['branch'];
		$patientsalutation=$_POST['patientsalutation'];
		$guardiansalutation=$_POST['guardiansalutation'];
		$age=$_POST['age'];
		$contactno=$_POST['contactno'];
		$gender=$_POST['gender'];
		$occupation=$_POST['occupation'];
		$address=$_POST['address'];
		$dates=date('Y-m-d H:i:s');
		
		
    $rs1=mysql_query("select inv_pat_id from inv_patient order by inv_pat_id desc");
	if($res1=mysql_fetch_assoc($rs1))
	{
	$inv_pat_ids=$res1['inv_pat_id'];
	$inv_pat_id1=explode('-',$inv_pat_ids);
	$inv_pat_id2=$inv_pat_id1[1];
	}
	if($inv_pat_ids=='')
	$inv_pat_id1='MHIP'.'-00001';
	else
	{
		$inv_pat_id2+=1;
		$inv_pat_id1='MHIP'.'-'.str_pad($inv_pat_id2, 5, '0', STR_PAD_LEFT);
	}
		
		$inc_invoice=check_invoices($inv_pat_id1);
		if($inc_invoice==0)
{
include("config_db2.php");	
		$Insql=mysql_query("INSERT INTO inv_patient (inv_pat_id, branch, patientid, patientsalutation, patientname, guardiansalutation, age, gender, contactno, occupation, address, create_date,pat_ip_status) VALUES
('$inv_pat_id1', '$branch', '$patientid', '$patientsalutation', '$patientname', '$guardiansalutation','$age', '$gender', '$contactno', '$occupation', '$address', '$dates','1')");
	echo "<script>alert('Patient Admited')</script>";
}
else
{
echo "<script>alert(' Alreaady Exist')</script>";
}
	}
	if($_POST['action']=="update_patient")
	{
		$mrd_no=$_POST['mrd_no'];
		$cmd = "select branch, patientid, patientsalutation, patientname, guardiansalutation, guardianname, age, gender, contactno, occupation, address, cast(time as date) as time from patientdetails where patientid = '$mrd_no'";
		//echo $cmd;
		$res = mysql_query($cmd);
		if(mysql_num_rows($res) !=0) {
		while($rs = mysql_fetch_array($res))
		{
			$branch = $rs['branch'];
			$patientid = $rs['patientid'];
			$patientsalutation = $rs['patientsalutation'];
			$patientname = $rs['patientname'];
			$guardiansalutation = $rs['guardiansalutation'];
			$age = $rs['age'];
			$gender = $rs['gender'];
			$contactno = $rs['contactno'];
			$occupation = $rs['occupation'];
			$address = $rs['address'];
		}
		}
		
	    $source=$_POST['source'];
		$ip_no=generate_ip_id();
		//$doa_time=$_POST['doa_time'];
		$mrd_no=$_POST['mrd_no'];
		$ward=$_POST['ward'];
		$room=$_POST['room'];
		$depart=$_POST['depart'];
		$consultant=$_POST['consultant'];
		$type=$_POST['type'];
		//$update_id=$_POST['update_id'];
		$dates=date('Y-m-d H:i:s');
		$room_alloc_date=date('Y-m-d H:i:s',strtotime($_POST['room_alloc_date']));
		$chk_mrd_no_param = $mrd_no;
		 
	  
		include("config_db1.php");
		$cmd_shift_room_check_row = mysql_num_rows(mysql_query("select id,rate from room_no WHERE id = '$room' AND vacant !=''"));
		if($cmd_shift_room_check_row ==1){
			echo "failure~Room is Already Occupied. Select Different room.";
			exit;
		}
		
	
	include("config_db2.php");
	
	$cmd_chk_ip_exit = mysql_num_rows(mysql_query("select id from inv_patient WHERE patientid = '$mrd_no' AND pat_ip_status ='0'"));
		if($cmd_chk_ip_exit ==1){
			echo "failure~Patient already admitted. Existing IP No is not closed.";
			exit;
		}
		
	
	$Insql=mysql_query("INSERT INTO inv_patient (inv_pat_id, branch, patientid, patientsalutation, patientname, guardiansalutation, age, gender, contactno, occupation, address, create_date,pat_ip_status,room_alloc_date,source,ward,room,depart,consultant,type) VALUES
('$ip_no', '$branch', '$patientid', '$patientsalutation', '$patientname', '$guardiansalutation','$age', '$gender', '$contactno', '$occupation', '$address', '$dates','0','$room_alloc_date','$source','$ward','$room','$depart','$consultant','$type')");
	//$Insql=mysql_query("Update inv_patient set room_alloc_date='$room_alloc_date', source='$source', ward='$ward', room='$room', depart='$depart', consultant='$consultant', type='$type',pat_ip_status='0' where inv_pat_id='$update_id'");
	if($Insql){
		$ex=mysql_query("UPDATE billing SET ip_id ='$ip_no' where patientid ='$mrd_no' and ip_id ='' AND balance='1'");
		$Insql=mysql_query("Update patientdetails set ip_id='$ip_no' where patientid='$mrd_no'");
		if(isset($room)){
		include("config_db2.php");	
			$cmd = "INSERT INTO chart_ot (id,patientid,ip_no,insert_from,room_no,doa,cons,created_date) VALUES (NULL,'$patientid','$ip_no','Admit Form','$room','$room_alloc_date','$consultant','$dates')";
			$cmds=mysql_query($cmd);
			include("config_db1.php");	
		$Insql=mysql_query("Update room_no set vacant='no' where id='$room'");
		include("config_db2.php");	
		 mysql_query("INSERT INTO `room_bill_details` (`id`, `ref_no`, `insert_from`, `bill_number`, `room_id`, `ip_no`, `room_name`, `patient_id`, `from_time`, `to_time`, `vacate`, `given_details`, `fees_amount`, `paid_status`, `created_date`,`added_by`) VALUES (NULL, '', 'Admit Form','', '$room', '$ip_no', '', '$mrd_no', '$room_alloc_date', '','', '', '', '0', '$dates','$user')");
		 
		}
		echo "admitted~".$ip_no;
		exit;
	}else{
		
		echo 'failure~Patient could not be admitted';
		exit;
		
	}		

	}
	function get_room_name($room)
  {
	  		include("config_db1.php");
    $sql2="select * from  room_no where id='$room'"; 
  $rs2=mysql_query($sql2);
	while($rsdata2=mysql_fetch_array($rs2))
	  {
	   $room=$rsdata2['room'];
  		}
  return $room;
  }
  function generate_ip_id(){
	  include("config_db2.php");
	  $rs1=mysql_query("select inv_pat_id from inv_patient order by inv_pat_id desc");
	if($res1=mysql_fetch_assoc($rs1))
	{
	$inv_pat_ids=$res1['inv_pat_id'];
	$inv_pat_id1=explode('-',$inv_pat_ids);
	$inv_pat_id2=$inv_pat_id1[1];
	}
	if($inv_pat_ids=='')
	$inv_pat_id1='MHIP'.'-00001';
	else
	{
		$inv_pat_id2+=1;
		$inv_pat_id1='MHIP'.'-'.str_pad($inv_pat_id2, 5, '0', STR_PAD_LEFT);
	}
	return $inv_pat_id1;
  }
  
?>