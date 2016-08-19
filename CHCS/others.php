<?php
				$others = $_REQUEST['others'];
				$complaint_no = $_REQUEST['complaint_no'];
				$room_no= $_REQUEST['room_no'];
				$consultant = $_REQUEST['consultant'];

	$id = $_REQUEST['id'];
	$pid = $_REQUEST['pid'];
	$user = $_REQUEST['user'];
	$type = $_REQUEST['type'];
	$create_date=date("Y-m-d H:i:s");
	include("config_db2.php");
	if($id !="") {	
	//$cmd = "update user_login set username='$user', password='$pass', role=$role where id=".$id;
			//if(mysql_query($cmd))
			//	echo 'user info. updated!';
			//else
			//	echo 'unable to update';		
		}if(($id=="")&&($user == "")){
			 echo $cmd = "INSERT INTO clinical_others (id, 	patient_id,type,reason, room_no, consultant, complaint_no, createdate) VALUES (NULL,'$pid','$type', '$others', '$room_no', '$consultant', '$complaint_no', '$create_date')";
			if(mysql_query($cmd))
				echo 'others info. Inserted!';
			else
				echo 'unable to Insert';
		}
		if($user != ""){
			$cmd = "delete from clinical_others where id='$user'";
			if(mysql_query($cmd))
				echo 'others info. deleted!';
			else
				echo 'unable to deleted';		
		}
		mysql_close($db2);
	
?>