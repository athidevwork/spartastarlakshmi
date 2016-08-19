<?php
	$family = $_REQUEST['family'];
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
			$cmd = "INSERT INTO family_history (id, family_history, room_no, consultant, complaint_no, createdate) VALUES (NULL, '$family', '$room_no',  '$consultant', '$complaint_no', '$create_date')";
			if(mysql_query($cmd))
				echo 'personal info. Inserted!';
			else
				echo 'unable to Insert';
		}
		if($user != ""){
	echo $cmd = "delete from family_history where id='$user'";
			if(mysql_query($cmd))
				echo 'family info. deleted!';
			else
				echo 'unable to deleted';		
		}
		mysql_close($db2);
	
?>