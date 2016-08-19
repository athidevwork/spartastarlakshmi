<?php
session_start();
$name=$_SESSION['username'];
date_default_timezone_set('Asia/Kolkata'); 
include("config_db2.php");
//echo'hi';
if(isset($_REQUEST['id']))
{
$pid=$_REQUEST['id'];
$per=$_REQUEST['per'];
mysql_query("update patientdetails set hold='$per',holdby='$name' where patientid='$pid'");
header("Location:home.php"); 
}


if(isset($_REQUEST['pid']))
{
$pid=$_REQUEST['pid'];
//echo $pid;
mysql_query("update patientdetails set hold=0 where patientid='$pid'"); 
header("Location:patient-info.php?pid=".$pid);
}

?>