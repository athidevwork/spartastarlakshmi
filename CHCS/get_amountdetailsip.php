<?php
include("config_db1.php");


$inves_det=$_REQUEST['inves_det'];
$fees_det=$_REQUEST['fees_det'];
echo $cmd1 = "select * from $inves_det where id='$fees_det'";
$res1 = mysql_query($cmd1);
while($rs1 = mysql_fetch_array($res1)){
$rate .=$rs1['rate'];

}
	echo $rate;	
    mysql_close($db1);
?>