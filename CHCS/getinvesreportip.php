<?php
include("config_db1.php");
$inves=$_REQUEST['inves'];
$cmd1 = "select * from $inves order by sym desc";
$res1 = mysql_query($cmd1);
while($rs1 = mysql_fetch_array($res1)){
$num .=$rs1['sym'].'+'.$rs1['id'].'~';
}
$num = substr($num,0,-1);
	echo $num;		mysql_close($db1);
?>