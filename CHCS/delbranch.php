<?php
	$id = $_REQUEST['id'];
	include("config_db1.php");
	if($id != ""){
	$cmd = "delete from hospitalbranches where id=".$id;
			/*if(mysql_query($cmd))
				echo 'user info. deleted!';
			else
				echo 'unable to deleted';*/
			if(!mysql_query($cmd))
				echo 'Unable to delete branch - '. mysql_error();					
		}
		mysql_close($db1);
?>