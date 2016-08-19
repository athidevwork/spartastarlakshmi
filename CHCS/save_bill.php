<?php
session_start();
date_default_timezone_set('Asia/Kolkata'); 
	include("config_db2.php");
	$pid=$_REQUEST['id'];
	$pay=$_REQUEST['pay'];
	$total=$_REQUEST['total'];
	$bal=$_REQUEST['bal'];
	$assets = $_REQUEST['assets'];
	$name = $_SESSION['username'];
	$billnumber= abs(date-time(yyyyMMddHHmmss)); 
	 if($bal==0)
	 {
	 $bal1=0;
	 }
	 else
	 {
	 $bal1=1;
	 }
	 
	$result = mysql_query("insert into billing (patientid,fees,pay,bal_amt,balance,created_by,bill_no,type) values ('$pid','$total','$pay','$bal','$bal1','$name','$billnumber','OP')");
	
	//$update = mysql_query("update fees_details set paid_status='1' and bill_number ='$billnumber' where patient_id='$pid'");
	
	//$update1 =mysql_query("update patientlabdetails set paid_status='1',bill_number='$billnumber'  where patient_id='$pid' and paid_status !='1'");
	$update1 =mysql_query("update lab_testsample_ip set paid_status='1',bill_number='$billnumber'  where patient_id='$pid' and paid_status !='1' AND ip_id=''");
	$update = mysql_query("update services_details set paid_status='1',bill_number='$billnumber' where patient_id='$pid' and paid_status!='1'");
	$update2 =mysql_query("update fees_detailsip set  paid_status='1',bill_number='$billnumber'  where patient_id='$pid' AND paid_status!='1' AND ip_id=''");  
	
	//foreach($assets as $asset => $key){
/*echo "insert into billing_content (patientid,fees,description,bill_no,created_by) values ('$pid','$key[2]','$key[1]','$billnumber','$name')";
*/
	 //$result1 = mysql_query("insert into billing_content (patientid,fees,description,bill_no,created_by) values ('$pid','$key[2]','$key[1]','$billnumber','$name')");
		//}
		
		if($bal==0)
		{
		mysql_query("update billing set balance='$bal' where patientid='$pid' AND ip_id='' AND balance='1'"); 
		}
		
		if($result)
{
echo "Success~".$billnumber;

}
else
{
echo "Error";

}
	
	?>