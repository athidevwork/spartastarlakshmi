<?php
	session_start();
 
	$username = $_POST['username'];
	$password = $_POST['password'];
	$username  = mysql_escape_string($username);
	include("config.php");
	
	$res = mysql_query("SELECT * FROM test WHERE status = 1");
	$r = mysql_fetch_array($res);

	$today = date('d-m-Y');
	$checkin = strtotime($today);
		
	if($r['checkin'] != '')
		$oldday = date('d-m-Y',$r['checkin']);
	else
		$oldday = date('d-m-Y');
	
	if(strtotime($oldday) > strtotime($today)){
		$_SESSION['loginerror'] = "Check System Date & Time ! <br /> Last Login $oldday";
		header('location:login.php');
		exit();
	}else{
		mysql_query("UPDATE test SET checkin = '$checkin'");
	}
		
	$sql = mysql_query("SELECT * FROM tbl_users WHERE status = 1 AND userid = '$username'");
	$rs = mysql_fetch_array($sql);
	if($password == $rs['password']){
		$_SESSION['phar-username'] = $rs['username'];
		$_SESSION['phar-role'] = $rs['role'];
		$_SESSION['phar-loginid'] = $rs['id'];
		/*header('location:index.php');	
		exit();*/
				
		$_SESSION['mp'] = $rs['mp'];		$_SESSION['mm'] = $rs['mm'];		$_SESSION['ms'] = $rs['ms']; 		$_SESSION['mu'] = $rs['mu'];
		$_SESSION['bill'] = $rs['bill'];	$_SESSION['sr'] = $rs['sr'];
		$_SESSION['pe'] = $rs['pe'];		$_SESSION['pr'] = $rs['pr'];
		$_SESSION['sa'] = $rs['sa'];		$_SESSION['ise'] = $rs['ise'];		$_SESSION['stka'] = $rs['stka'];		
		$_SESSION['srep'] = $rs['srep'];	$_SESSION['prep'] = $rs['prep']; $_SESSION['doc'] = $rs['doc'];  $_SESSION['vat'] = $rs['vat'];  $_SESSION['sch'] = $rs['sch'];
		
		if($r["register_date"] != '')
			$expiry = date('d-m-Y',$r["register_date"]);
		else
			$expiry = '';
		
		if($expiry != ''){
			if(strtotime($expiry) < strtotime($today)){
				$_SESSION['phar-license'] = 0;
				header('location:license-expired.php');	
				exit();
			}else{
				$_SESSION['phar-license'] = 1;
				header('location:index.php');	
				exit();
			}
		}else{
			$_SESSION['phar-license'] = 0;
			header('location:license-expired.php');	
			exit();
		}	
	}
	else{
		$_SESSION['loginerror'] = "Invalid Username / Password !";
		header('location:login.php');
		exit();
	}
?>