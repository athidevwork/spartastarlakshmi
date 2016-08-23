<?php
	$user = $_REQUEST['branch'];
	$id = $_REQUEST['id'];
	include("config_db1.php");
	//$role = $_REQUEST['role'];
	if($id != ""){	
		$cmd = "update hospitalbranches set branch='$user' where id=".$id;
		/*if(mysql_query($cmd))
			//echo 'Branch info. updated!';
			break;
		else
			echo 'unable to update branch information to DB';*/				
	}else{
		$cmd = "INSERT INTO hospitalbranches (id, branch) VALUES (NULL, '$user')";
		/*if(mysql_query($cmd))
			//echo 'Branch info. Inserted!';
		    break;
		else
			echo 'unable to Insert branch information to DB';*/		
	}
	if(!mysql_query($cmd))
		echo 'Unable to Insert/Update branch - '. mysql_error();	
	mysql_close($db1);
?>