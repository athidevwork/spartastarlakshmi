<?php
	 date_default_timezone_set('Asia/Kolkata');
		$branch=$_REQUEST['branch'];
		$datepicker=$_REQUEST['datepicker'];
		$date=date('Y-m-d', strtotime($datepicker));
		$patid=$_REQUEST['patid'];
		$patsal=$_REQUEST['patsat'];$patname=$_REQUEST['patname'];$patname = mysql_escape_string($patname);
		$gsal=$_REQUEST['gsat'];$gname=$_REQUEST['gname'];$gname = mysql_escape_string($gname);
		$age=$_REQUEST['age'];
		$gender=$_REQUEST['gender'];
		$contactno=$_REQUEST['contactno'];$contactno = mysql_escape_string($contactno);
		$occupation=$_REQUEST['occupation'];$occupation = mysql_escape_string($occupation);
		$address=$_REQUEST['address'];$address = mysql_escape_string($address);
		$reference=$_REQUEST['reference'];$reference = mysql_escape_string($reference);
		
		if (!empty($_FILES["photo"]["name"])) {
			$filename = $_FILES['photo']['name'];
			$imgData =addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		}else
			$imgData = "";
			
		include("config_db2.php");
		//$id = $rs1['patid'];
			
			if($imgData != "")
				$sql = "UPDATE patientdetails set patientsalutation = '$patsal', patientname = '$patname', guardiansalutation = '$gsal', guardianname = '$gname', age = '$age', gender = '$gender', contactno = '$contactno', occupation = '$occupation', address = '$address', image = '{$imgData}', reference = '$reference' WHERE patientid = '$patid'";
			else
				$sql = "UPDATE patientdetails set patientsalutation = '$patsal', patientname = '$patname', guardiansalutation = '$gsal', guardianname = '$gname', age = '$age', gender = '$gender', contactno = '$contactno', occupation = '$occupation', address = '$address', reference = '$reference' WHERE patientid = '$patid'";
				//echo $sql;
			if(mysql_query($sql)){
				echo 'sucess';
			}else
			{
				echo 'Error';
			}
		?>