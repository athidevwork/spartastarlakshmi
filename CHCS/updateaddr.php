<?php
session_start();
 date_default_timezone_set('Asia/Kolkata');
 if(isset($_REQUEST['submit'])){
 $name=$_REQUEST['uname'];
 $id=$_REQUEST['uidaddr'];
		$email=$_REQUEST['uemail'];
		$about=$_REQUEST['uabout'];
		$mobile=$_REQUEST['umobile'];
		//$id=$_SESSION['uid'];
		$address=$_REQUEST['address1'];
		$address = mysql_escape_string($address);
		//echo 'sdfdfds';
		if (!empty($_FILES["uph"]["name"])) {
			$filename = $_FILES['uph']['name'];
			$imgData =addslashes(file_get_contents($_FILES['uph']['tmp_name']));
		}else
			$imgData = "";
 echo $imgData;
 include("config_db1.php");
 if($imgData !="")
 $sql = "update address set name='$name', email='$email', about='$about', phone='$mobile', img='{$imgData}', address='$address' where id='$id'";
 else
 $sql = "update address set name='$name', email='$email', about='$about', phone='$mobile', address='$address' where id='$id'";
 echo $sql;
 if(mysql_query($sql))
		{
			mysql_close($db1);
			//echo "Sucess";
	//		header("location: addressbook.php");
			}
			}