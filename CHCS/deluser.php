<?php
	$user = $_REQUEST['user'];
	include("config_db1.php");
	if($user != ""){
		$cmd = "delete from user_login where id=".$user;
		/*if(mysql_query($cmd))
			echo 'user info. deleted!';
		else
			echo 'unable to deleted';*/
		if(!mysql_query($cmd))
			echo 'Unable to delete user - '. mysql_error();
	}
	mysql_close($db1);
?>