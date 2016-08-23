<?php
	$id = $_REQUEST['id'];
	include("config_db1.php");
	if($id != ""){
		$cmd = "delete from type_creation where id=".$id;
		/*if(mysql_query($cmd))
			echo 'Type info. deleted!';
		else
			echo 'unable to deleted';*/
		if(!mysql_query($cmd))
			echo 'Unable to delete type - '. mysql_error();
	}
	mysql_close($db1);
?>