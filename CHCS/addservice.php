<?php
	include("config_db1.php");
	$service_name = $_REQUEST['service_name'];
	$types = $_REQUEST['types'];
	$amount = $_REQUEST['amount'];
	$id = $_REQUEST['id'];
	if($id!= ""){
	   	$cmd = "update service_creation set service_name='$service_name',types='$types',amount='$amount' where id=".$id;
		/*if(mysql_query($cmd))
			echo 'Service info. updated!';
		else
			echo 'unable to update';*/		
	}if($id==""){
		$cmd = "INSERT INTO service_creation(service_name, types, amount)VALUES('$service_name','$types','$amount')";
		/*if(mysql_query($cmd))
			echo 'Service info. Inserted!';
		else
			echo 'unable to Insert';*/
	}
	if(!mysql_query($cmd))
		echo 'Unable to Insert/Update service - '. mysql_error();
	mysql_close($db1);
?>