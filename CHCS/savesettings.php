<?php
include("config_db1.php");

$role=$_REQUEST['role'];


$billip=$_REQUEST['billip'];
$billop=$_REQUEST['billop'];
$report=$_REQUEST['report'];
$lab_reports_perm=$_REQUEST['lab_reports_perm'];
$printbill=$_REQUEST['printbill'];
$master=$_REQUEST['master'];
$reg=$_REQUEST['reg'];
$medication_perm=$_REQUEST['medication_perm'];
$complaints_perm=$_REQUEST['complaints_perm'];
$activechart_perm=$_REQUEST['activechart_perm'];
$clinicalchart_perm=$_REQUEST['clinicalchart_perm'];
$investigation_perm=$_REQUEST['investigation_perm'];
$info=$_REQUEST['info'];
$admission_perm=$_REQUEST['admission_perm'];
$cmd="select billingip from settings where role='$role'";
//echo $cmd;
$num_sql=mysql_num_rows(mysql_query($cmd));
if($num_sql == 1){
	//echo $bill;
	$cmd="UPDATE `settings` SET `billingip` = '$billip',`billingop` = '$billop', `reports` = '$report', `labreports` = '$lab_reports_perm', `printbill` = '$printbill', `masterentry` = '$master', `registration` = '$reg', `medication` = '$medication_perm', `complaints` = '$complaints_perm', `activechart` = '$activechart_perm',`clinicalchart` = '$clinicalchart_perm', `investigation` = '$investigation_perm', `patientinfo` = '$info', `admission` = '$admission_perm' WHERE `settings`.`role` = $role;";
	//echo $cmd;exit;
	if(mysql_query($cmd))
	{
	echo 'Settings Updated';
	}else
	{
	echo 'Settings could not be Updated';
	}
}elseif($num_sql == 0){
	$cmd="INSERT INTO `dps_master`.`settings` (`id`, `role`, `billingip`, `billingop`, `reports`, `labreports`, `printbill`, `masterentry`, `registration`, `medication`, `complaints`, `activechart`, `investigation`, `patientinfo`, `admission`,`clinicalchart`) VALUES (NULL, '$role', '$billip', '$billop', '$report', '$lab_reports_perm', '$printbill', '$master', '$reg', '$medication_perm', '$complaints_perm', '$activechart_perm', '$investigation_perm', '$info', '$admission_perm','$clinicalchart_perm')";
	//echo $cmd;
	if(mysql_query($cmd))
	{
	echo 'Setting Added';
	}else
	{
	echo 'Settings could not be added';
	}
}else{
	echo 'Settings could not be applied. Please check with your DB administrator';
}



?>