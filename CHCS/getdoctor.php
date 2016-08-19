<?php
include("config_db1.php");
$depart=$_REQUEST['depart'];

$cmd1 = "select id,doctor_name from doctor_creation where department_name='$depart' ";
//echo $cmd1;
$res1 = mysql_query($cmd1);
//$num="";
while($rs1 = mysql_fetch_array($res1))
{
$doctor .=$rs1['doctor_name'].'+'.$rs1['id'].'~';
}
$doctor = substr($doctor,0,-1);

	echo $doctor;		
	mysql_close($db1);
?>