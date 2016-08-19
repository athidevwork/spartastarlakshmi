<?php
include("config_db1.php");
	$ward_name = $_REQUEST['ward_name'];
	$description = $_REQUEST['description'];
	$id = $_REQUEST['id'];
	if($id!= ""){
	   $cmd = "update ward_creation set ward_name='$ward_name',description='$description' where id=".$id;
			if(mysql_query($cmd))
				echo 'Ward info. updated!';
			else
				echo 'unable to update';		
		}if($id==""){
			$cmd = "INSERT INTO ward_creation(ward_name, description)VALUES('$ward_name','$description')";
			if(mysql_query($cmd))
				echo 'Ward info. Inserted!';
			else
				echo 'unable to Insert';
		}
		mysql_close($db1);
?>