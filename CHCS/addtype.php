<?php
include("config_db1.php");
	$type_name = $_REQUEST['type_name'];
	$amount = $_REQUEST['amount'];
	$id = $_REQUEST['id'];
	if($id!= ""){
	   $cmd = "update type_creation set type_name='$type_name',amounts='$amount' where id=".$id;
			if(mysql_query($cmd))
				echo 'Type info. updated!';
			else
				echo 'unable to update';		
		}if($id==""){
			$cmd = "INSERT INTO type_creation(type_name,amounts)VALUES('$type_name','$amount')";
			if(mysql_query($cmd))
				echo 'Type info. Inserted!';
			else
				echo 'unable to Insert';
		}
		mysql_close($db1);
?>