<?php
include("config_db1.php");
$role=$_REQUEST['role'];
$cmd="select * from settings where role='$role'";
//echo $cmd;
$sql=mysql_query($cmd);
$rs=mysql_fetch_array($sql);
$msg =$rs['billingip'].'~'.$rs['billingop'].'~'.$rs['reports'].'~'.$rs['clinicalchart'].'~'.$rs['labreports'].'~'.$rs['printbill'].'~'.$rs['masterentry'].'~'.$rs['registration'].'~'.$rs['medication'].'~'.$rs['complaints'].'~'.$rs['activechart'].'~'.$rs['investigation'].'~'.$rs['patientinfo'].'~'.$rs['admission'];
echo $msg;
?>
