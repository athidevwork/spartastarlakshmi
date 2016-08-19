<?php
	$name = $_REQUEST['name'];
	$user = $_REQUEST['user'];
	$pass = $_REQUEST['pass'];
	$role = $_REQUEST['role'];
	$id = $_REQUEST['id'];
	$type = $_REQUEST['type'];
	include("config_db1.php");
	if($id !="") {	
	$cmd = "update user_login set name='$name', username='$user', password='$pass', role=$role,category='$type' where id=".$id;
			if(mysql_query($cmd)){
				echo 'user info. updated!';
				mysql_close($db1);
				exit;
			}
			else{
				echo 'unable to update';
				mysql_close($db1);
				exit;				
			}				
		}else{
			$cmd_user_exist = mysql_query("SELECT username FROM user_login WHERE username='$user' LIMIT 1"); 
			if(mysql_num_rows($cmd_user_exist) !=0){
				echo 'User Name Already Exist. Please try with different username';
				mysql_close($db1);
				exit;
			}
			$cmd = "INSERT INTO user_login (id, username, password, role,category,name) VALUES (NULL, '$user', '$pass', '$role','$type','$name')";
			if(mysql_query($cmd)){
				echo 'user info. Inserted!';
				mysql_close($db1);
				exit;
			}
			else{
				echo 'unable to Insert';
				mysql_close($db1);
				exit;
			}
		}
		
	
?>