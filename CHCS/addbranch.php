<?php
	$user = $_REQUEST['branch'];
	$id = $_REQUEST['id'];
	include("config_db1.php");
	//$role = $_REQUEST['role'];
	if($id != ""){
		
		$cmd = "update hospitalbranches set branch='$user' where id=".$id;
			if(mysql_query($cmd))
				echo 'Branch info. updated!';
			else
				echo 'unable to update';		
		}else{
			$cmd = "INSERT INTO hospitalbranches (id, branch) VALUES (NULL, '$user')";
			if(mysql_query($cmd))
				echo 'Branch info. Inserted!';
			else
				echo 'unable to Insert';
		}
		mysql_close($db1);
	
?>