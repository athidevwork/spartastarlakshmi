<?php
	session_start();
  date_default_timezone_set('Asia/Kolkata'); 
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	include("config_db1.php");
	
	$username = mysql_real_escape_string($username);
	
	$query = "SELECT id,username, password,name, role,category FROM user_login WHERE username = '$username';";
	$result = mysql_query($query);
	$rs = mysql_fetch_array($result);
	
	if($username == $rs['username'] && $password == $rs['password']){
	$res = mysql_query("SELECT * FROM test WHERE status = 1");
	//echo "SELECT * FROM test WHERE status = 1";
	$r = mysql_fetch_array($res);

		$_SESSION['username'] = $username;
		$_SESSION['role'] = $rs['role'];
		$_SESSION['name'] = $rs['name'];
		$_SESSION['uid'] = $rs['id'];
		$_SESSION['category'] = $rs['category'];
		
		if($r["registerdate"] != '')
			$expiry = date('Y-m-d',strtotime($r["expirydate"]));
		else
			$expiry = '';
			
			//echo $expiry .'<br />';
			$today=date("Y-m-d");
			//strtotime
			$_SESSION['lidate']=round(abs(strtotime($today) - strtotime($expiry))/86400);
			
		//$_SESSION['lidate']=$diff;
		//echo $_SESSION['lidate'];
		//exit();
		if($expiry != ''){
			if(strtotime($expiry) < strtotime($today)){
				$_SESSION['mp-license'] = 0;
				header('location:master_entry.php');	
				exit();
			}else{
				$_SESSION['mp-license'] = 1;
				//exit();
				header('location:home.php');
				mysql_query("update user_login set lastvisit=CURRENT_TIMESTAMP where username = '$username';"); 
		mysql_query("select ");
		mysql_close($db1);	
				exit();
			}
		}else{
			$_SESSION['mp-license'] = 0;
			header('location:master_entry.php');	
			exit();
		}
		
		
/*		$url='home.php';
		echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';*/
		//header('location:home.php');	
		exit();
	}
	else{
		$_SESSION['loginerror'] = "Invalid UserName / Password !";
		mysql_close($db1);		
/*		$url='index.php';
		echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';*/
		header('location:index.php');
		exit();
	}
?>