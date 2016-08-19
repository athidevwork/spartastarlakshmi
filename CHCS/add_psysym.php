<?php
session_start();
	$symptoms = $_REQUEST['symptoms'];
	include("config_db1.php");
	$symptoms = mysql_escape_string($symptoms);
 $cat=$_SESSION['category'];
 $cm=mysql_query("select display_name,tbl_name from complaint_tbl_name where id=$cat");
$v=mysql_fetch_array($cm);
$table=$v['tbl_name'];
	if($symptoms != ""){
		
		$cmd = "INSERT INTO $table (id, symptom) VALUES (NULL, '$symptoms');";
		if(mysql_query($cmd))
			echo 'inserted';
		else
			echo 'unable to insert';
		mysql_close($db1);
	}else{
		echo 'Psychiatric symptoms cannot be left blank';
	}
?>