<?php
include("config_db1.php");
	$visit_name = $_REQUEST['visit_name'];
	$vtypes = $_REQUEST['vtypes'];
	$vamount = $_REQUEST['vamount'];
	$id = $_REQUEST['id'];
	if($id!= ""){
	   	$cmd = "update visit_creation set visit_name='$visit_name',vtypes='$vtypes',vamount='$vamount' where id=".$id;
		/*if(mysql_query($cmd))
			echo 'Visit info. updated!';
		else
			echo 'unable to update';*/		
	}if($id==""){
		$cmd = "INSERT INTO visit_creation(visit_name, vtypes, vamount)VALUES('$visit_name','$vtypes','$vamount')";
		/*if(mysql_query($cmd))
			echo 'Visit info. Inserted!';
		else
			echo 'unable to Insert';*/
	}
	if(!mysql_query($cmd))
		echo 'Unable to Insert/Update visit - '. mysql_error();
	mysql_close($db1);
?>