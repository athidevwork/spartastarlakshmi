<?php
$phno=$_REQUEST['phno'];
include("config_db2.php");
$cmd=mysql_query("select contactno from patientdetails where contactno='$phno'");
$num=mysql_num_rows($cmd);
echo $num;
mysql_close($db2);
?>