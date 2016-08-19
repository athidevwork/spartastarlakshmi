<?php
include("config_db1.php");
$procedures2=$_REQUEST['procedures2'];
$cmd1 = "select * from procedure_details where procedure_id='$procedures2'";
$res1 = mysql_query($cmd1);
while($rs1 = mysql_fetch_array($res1)){
$given_details .=$rs1['given_details'];
}
	echo $given_details;		mysql_close($db1);
?>