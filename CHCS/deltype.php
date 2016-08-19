<?php
	$id = $_REQUEST['id'];
	include("config_db1.php");
	if($id != ""){
	$cmd = "delete from type_creation where id=".$id;
			if(mysql_query($cmd))
				echo 'Type info. deleted!';
			else
				echo 'unable to deleted';		
		}
		mysql_close($db1);
?>