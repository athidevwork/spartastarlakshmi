<?php
include("config_db1.php");
$service2=$_REQUEST['service2'];
$cmd1 = "select * from service_creation where id='$service2'";
$res1 = mysql_query($cmd1);
while($rs1 = mysql_fetch_array($res1)){
$amount .=$rs1['amount'];
}
	echo $amount;		mysql_close($db1);
?>