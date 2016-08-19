<?php
//session_start();
date_default_timezone_set('Asia/Kolkata'); 
$pid=$_REQUEST['id'];

include("config_db2.php");
$sql ="select * from investigationreport where patientid='$pid' and complaint like 'Pending' and sendlab=0";
	$result=mysql_query($sql);
	
	if(mysql_num_rows($result) !=0)
	{
	while($rs=mysql_fetch_array($result))
	{
	$id=$rs['id'];
	$test=$rs['test'];
	
	$cat=$rs['category'];
	include("config_db1.php");
	
	$cmd =mysql_query("select title from investigation where id='$cat'");
	//echo "select title from investigation where id='$cat'";
	$rs1=mysql_fetch_array($cmd);
	$tbl=$rs1['title'];
	$sql1=mysql_query("select rate ,sym from $tbl where id='$test'");
	
	$rs2=mysql_fetch_array($sql1);
	$test=$rs2['sym']; 
	mysql_close($db1);
	echo" 
	<tr><td></td><td>".$test."</td><td>".$rs2['rate']."</td><td><a href='#' onClick='delItem($(this))' class='btn btn-danger btn-condensed'><span class='fa fa-times'></span></a></td><td style='display:none';>".$id."</td></tr>";
	}
			//echo $sql;
	}else {
	echo 'no';
	}
			
	
			
		//print_r($hed);
		
?>