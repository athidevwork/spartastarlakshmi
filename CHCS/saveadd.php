<?php
session_start();
 date_default_timezone_set('Asia/Kolkata');
 if(isset($_REQUEST['submit'])){
 $name=$_REQUEST['name'];
		$email=$_REQUEST['email'];
		$about=$_REQUEST['about'];
		$mobile=$_REQUEST['mobile'];
		$id=$_SESSION['uid'];
		$address=$_REQUEST['address1'];
		$address = mysql_escape_string($address);
		//echo 'sdfdfds';
		if (!empty($_FILES["photo"]["name"])) {
			$filename = $_FILES['photo']['name'];
			$imgData =addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		}else
			$imgData = "";
 
 include("config_db1.php");
 $sql = "INSERT INTO address (name, email, about, createdby, phone, img, address) VALUES ('$name', '$email', '$about', '$id', '$mobile', '{$imgData}', '$address');";

 if(mysql_query($sql))
		{
			mysql_close($db1);
			//echo "Sucess";
			header("location: addressbook.php");
			}
			}