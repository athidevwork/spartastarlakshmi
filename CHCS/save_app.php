<?php
session_start();
date_default_timezone_set('Asia/Kolkata'); 
$user = $_SESSION['username'];
$date=$_REQUEST['appdate'];
$date=explode(" ", $date);
$name= $_REQUEST['apppatient'];;
$phone = $_REQUEST['appphone']; $phone=trim($phone);
$doctor=$_REQUEST['appdoctor'];

include("config_db2.php");
$cmd1 = "select patientid,patientname from patientdetails where patientid='$phone' and patientname='$name'";
$sql=mysql_query($cmd1);
$res = mysql_fetch_array($sql);
$pid=$res['patientid'];
$name1=$res['patientname'];
if($name1 !="")
$name=$name1;
//echo $cmd1;
$sql="insert into appointments(doctor, name, phono,patientid, time, date, appointby) values ('$doctor', '$name', '$phone', '$pid', '$date[1]', '$date[0]', '$user')";
//echo $sql;
if(mysql_query($sql))
{
exit(header("Location:home.php?msgx=1"));
}


?>