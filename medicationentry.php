<?php
	session_start();
	$patid=$_REQUEST['id'];
	$assets = $_REQUEST['assets'];
	$user = $_SESSION['username'];
			$datetime = date('Y-m-d H:i:s');
			$ip_id=get_ipid($patid);
			
			//$datepicker=$_REQUEST['datepicker'];
			//$date=date('Y-m-d', strtotime($datepicker));
			$count=count($assets);
			include("config_db2.php");
			
			$query4 = "select max(id)+1 as maxid from prescriptiondetail";
			$res4 = mysql_query($query4);	
			$rs4 = mysql_fetch_array($res4);
			if($rs4['maxid'])
				$maxid = $rs4['maxid'];
			else
				$maxid = 1;
				
			$count1=0;
			if(!empty($ip_id)){
				foreach($assets as $asset => $key){
			$sql ="INSERT INTO prescriptiondetail (id, patientid, drugname, dosage, specification, frequency, route, duration,prescribed_by,ip_id,type,tablet,generic,brands,avail_quantity,order_quantity,datetime,drugid) VALUES ('$maxid', '$patid', '$key[1]', '$key[8]', '$key[9]', '$key[10]', '$key[11]', '$key[12]' ,'$user','$ip_id','$key[2]','$key[3]','$key[4]','$key[5]','$key[6]','$key[7]','$datetime','$key[13]')";
					include("config_db2.php");
					$count1 += mysql_query($sql);
					$insert_id = mysql_insert_id();
					include("config_db3.php");
					$sql_pharmacy ="INSERT INTO tbl_ip_prescription (id, prescriptionid, prescriptiondrugid, patientid, ip_id, drugid, order_quantity, prescribed_by,status,datetime) VALUES (NULL,'$maxid','$insert_id', '$patid','$ip_id','$key[13]','$key[7]','$user','Pending','$datetime')";
					mysql_query($sql_pharmacy);
			//		echo $drug .'	'. $dosage .'	'. $specification .'	'. $frequency .'	'. $route .'	'. $duration . '<br />';
				}
			}
			//echo $count1;
			//$cmd=mysql_query("update complaints set maxid='$maxid' where patientid='$patid' order by complaintid desc limit 1");
			if($count==$count1){
				echo 'Success';
			}else{
				echo 'error';
			}
			function get_ipid($univ_num)
   {
		include("config_db2.php");
		$lab_id = strtolower($lab_id);
		
	$ex=mysql_query("select inv_pat_id from inv_patient where patientid = '$univ_num' AND pat_ip_status=0 limit 1");
	$ex1=mysql_fetch_array($ex);
	$inv_pat_id=$ex1['inv_pat_id'];
	return $inv_pat_id;
	}
	
?>