<?php
	$personal = $_REQUEST['personal'];
		$complaint_no = $_REQUEST['complaint_no'];
$room_no= $_REQUEST['room_no'];
				$consultant = $_REQUEST['consultant'];
	$id = $_REQUEST['id'];
				$user = $_REQUEST['user'];
	$create_date=date("Y-m-d");
	include("config_db2.php");
	if($id !="") {	
	$cmd = "update user_login set username='$user', password='$pass', role=$role where id=".$id;
			if(mysql_query($cmd))
				echo 'user info. updated!';
			else
				echo 'unable to update';		
		}if(($id=="")&&($user == "")){
			$cmd = "INSERT INTO personal_history (id, personal_hist, room_no, consultant, complaint_no, createdate) VALUES (NULL, '$personal', '$room_no', '$consultant', '$complaint_no', '$create_date')";
			if(mysql_query($cmd))
				echo 'personal info. Inserted!';
			else
				echo 'unable to Insert';
		}
		if($user != ""){
	echo $cmd = "delete from personal_history where id='$user'";
			if(mysql_query($cmd))
				echo 'others info. deleted!';
			else
				echo 'unable to deleted';		
		}
		mysql_close($db2);
	
?>