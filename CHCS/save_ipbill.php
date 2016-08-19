<?php
session_start();
date_default_timezone_set('Asia/Kolkata'); 
	include("config_db2.php");
	
	$pid=$_REQUEST['id'];
	$pay=$_REQUEST['pay'];
	$total=$_REQUEST['total'];
	$bal=$_REQUEST['bal'];
	$adv_remain=$_REQUEST['adv_remain'];
	$total_adv_amt=$_REQUEST['total_adv_amt'];
	$old=$_REQUEST['old'];
	$assets =array();
	$assets = $_REQUEST['assets'];
	$return_adv = $_REQUEST['return_adv'];
	$aset = $_REQUEST['aset'];
	$bill_number = abs(date-time(yyyyMMddHHmmss)); 
	$created_date=date("Y-m-d H:i:s");

	$name = $_SESSION['username'];
	$sql1 = "SELECT * FROM inv_patient WHERE patientid='$pid' AND pat_ip_status = 0";
					$result = mysql_query($sql1);
					$inv_pat_id ='';
					if(mysql_num_rows($result) != 0){
						$rs = mysql_fetch_array($result);
						$inv_pat_id = $rs['inv_pat_id'];
					}
	if($return_adv == 'return'){
		$return_amt = $adv_remain;
		$adv_remain = 0;
	}				
	if($adv_remain > 0){
		$update = mysql_query("update ip_patientadv set active=0 where patientid='$pid' and active=1");
		$return_amt = 0;
		$adv_desc = 'From IP-Billing add remaining advance amount';
		$cmd = mysql_query("INSERT INTO ip_patientadv (id,patientid,pat_name,ip_no,advance_amt,Return_amt,description,created_date,active,paid_status,bill_number) VALUES (NULL,'$pid','','$inv_pat_id','$adv_remain','$return_amt','$adv_desc','$created_date',1,'1','$bill_number')");
	}
	if($adv_remain == 0){
		$update = mysql_query("update ip_patientadv set active=0 where patientid='$pid' and paid_status ='1' AND active =1");
	}
	 if($bal==0)
	 {
	 $bal1=0;
	 
	 
	 //Discharge patient and disable ip id
			$cmd_pat_discharge_query = mysql_query("SELECT shift_patient FROM `chart_ot` WHERE ip_no='$inv_pat_id' order by id desc limit 1");
			$cmd_pat_discharge_array = mysql_fetch_array($cmd_pat_discharge_query);
			$discharge = $cmd_pat_discharge_array['shift_patient'];
			if($discharge == 'Discharge'){
				mysql_query("UPDATE inv_patient SET pat_ip_status=1,discharge_on='$created_date' WHERE inv_pat_id='$inv_pat_id' AND pat_ip_status=0 AND patientid='$pid'");
				mysql_query("UPDATE patientdetails SET ip_id='' WHERE ip_id='$inv_pat_id' AND patientid='$pid'");
			}
			
	 }
	 else
	 {
	 $bal1=1;
	 }
	 $update = mysql_query("update billing set balance='0' where patientid='$pid' and ip_id='$inv_pat_id' AND balance='1'");
//echo "insert into billing (patientid,ip_id,fees,pay,balance,bal_amt,created_by,bill_no,created_at) values ('$pid','$inv_pat_id','$total','$pay','$bal1','$bal','$name','$bill_number','$created_date')";
	$result = mysql_query("insert into billing (patientid,ip_id,fees,pay,balance,bal_amt,created_by,bill_no,created_at,type,advance_amount,advance_balance,old_balance,return_amt) values ('$pid','$inv_pat_id','$total','$pay','$bal1','$bal','$name','$bill_number','$created_date','IP','$total_adv_amt','$adv_remain','$old','$return_amt')");
	$update = mysql_query("update fees_detailsip set paid_status='1',bill_number='$bill_number' where patient_id='$pid' and paid_status!='1'");
	//$update = mysql_query("update lab_details_ip set paid_status='1',bill_number='$bill_number' where patient_id='$pid' and paid_status!='1'");
	$update = mysql_query("update services_details set paid_status='1',bill_number='$bill_number' where patient_id='$pid' and paid_status!='1'");
	$update = mysql_query("update procedure_details set paid_status='1',bill_number='$bill_number' where patient_id='$pid' and paid_status!='1'");
	//$update = mysql_query("update ip_patientadv set paid_status='1',bill_number='$bill_number' where patientid='$pid' and paid_status!='1'");
	$update = mysql_query("update room_bill_details set paid_status='1',bill_number='$bill_number' where ip_no='$inv_pat_id' and paid_status!='1' AND vacate ='yes'");
	$update = mysql_query("update sitting_details set paid_status='1',bill_number='$bill_number' where ip_no='$inv_pat_id' and paid_status!='1'");
	$update = mysql_query("update consultant_details set paid_status='1',bill_number='$bill_number' where ip_no='$inv_pat_id' and paid_status!='1'");
	$update = mysql_query("update lab_testsample_ip set paid_status='1',bill_number='$bill_number' where patient_id='$pid' and paid_status!='1'");
	

	if($result)
	{
		echo "Success~".$bill_number;
	
	}
	else
	{
		echo "Error";
	
	}
	
	?>