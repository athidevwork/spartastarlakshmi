<?php
session_start();
	$role=$_SESSION['role'] ;
	$username=$_SESSION['username'] ;
	date_default_timezone_set('Asia/Kolkata');
	if(isset($_REQUEST['submit'])){
		$patid=$_REQUEST['patid'];
		
		if(!check_patid_exists($patid)){
			$branch=$_REQUEST['branch'];
			$email=$_REQUEST['email'];
			$datepicker=$_REQUEST['datepicker'];
			$date=date('Y-m-d H:m:s');
			$patid=$_REQUEST['patid'];
			$patsal=$_REQUEST['patsat'];$patname=$_REQUEST['patname'];$patname = mysql_escape_string($patname);
			$gsal=$_REQUEST['gsat'];$gname=$_REQUEST['gname'];$gname = mysql_escape_string($gname);
			$dob=$_REQUEST['dob'];
			$dob = date('Y-m-d', strtotime($dob));
			$age=$_REQUEST['age'];
			$gender=$_REQUEST['gender'];
			$contactno=$_REQUEST['contactno'];$contactno = mysql_escape_string($contactno);
			$occupation=$_REQUEST['occupation'];$occupation = mysql_escape_string($occupation);
			$address=$_REQUEST['address'];$address = mysql_escape_string($address);
			$reference=$_REQUEST['reference'];$reference = mysql_escape_string($reference);
			//echo $_FILES["photo"]["name"];
			//echo $_FILES['photo']['size'];
			//exit;
			if (!empty($_FILES["photo"]["name"])) {
				$filename = $_FILES['photo']['name'];
				$imgData =addslashes(file_get_contents($_FILES['photo']['tmp_name']));
			}else
				$imgData = "";
				
				//echo $imgData;
			include("config_db1.php");
			$query=mysql_query("select * from settings where role='$role'");
			$rs=mysql_fetch_array($query);
			
				
			include("config_db2.php");
				if($rs['clinicalhistory']==1)
				{
					$sql = "INSERT INTO patientdetails (id, branch, patientid, patientsalutation, patientname, guardiansalutation, guardianname, age, gender, contactno, occupation, address, image, reference, time,email,dob) VALUES (NULL, '$branch', '$patid', '$patsal', '$patname', '$gsal', '$gname', '$age', '$gender', '$contactno', '$occupation', '$address', '{$imgData}', '$reference', '$date','$email','$dob')";
				}
				else{
					$sql = "INSERT INTO patientdetails (id, branch, patientid, patientsalutation, patientname, guardiansalutation, guardianname, age, gender, contactno, occupation, address, image, reference, time,email,hold,holdby,dob) VALUES (NULL, '$branch', '$patid', '$patsal', '$patname', '$gsal', '$gname', '$age', '$gender', '$contactno', '$occupation', '$address', '{$imgData}', '$reference', '$date','$email','10','$username','$dob')";	
				}
					if($_REQUEST['x'] !="") {
				$id=$_REQUEST['x'];
				$sq=mysql_query("update appointments set status=0 where id='$id'");
				}
				//echo $sql;
			if(mysql_query($sql))
			{
				mysql_close($db2);
				include("config_db1.php");
				
					$cmd = "UPDATE hospitalbranches SET nextnumber = nextnumber+1 WHERE branch='$branch'";
					if(mysql_query($cmd)){
						mysql_close($db1);
						
						if($rs['clinicalhistory']==1)
						header("location:complaints.php?pid=".$patid);
						else
						header("location:home.php");
				
						exit();
					}else{
						mysql_close($db1);
						header("location:registration.php?pid=".$patid);
						exit();
			}
			}
		}else{
			header("location:registration.php?error=Patient id already exists. Please try again.");
			exit();
		}
	}
	function check_patid_exists($pid){
		include("config_db2.php");
		$query_num_rows=mysql_num_rows(mysql_query("select id from patientdetails where patientid='$pid'"));
		if($query_num_rows > 0)
			return true;
		else
			return false;
	}
?>