<?php
date_default_timezone_set('Asia/Kolkata');
	$action = $_REQUEST['action'];
	if($action =='add'){
		$pid = $_REQUEST['pid'];
		//$complaint_no = $_REQUEST['complaint_no'];
		//$complaints ='';
		//if(isset($_REQUEST['complaints']) && !empty($_REQUEST['complaints'])){
		//	$complaints_str = implode (",", $_REQUEST['complaints']);
		//	$complaints = get_complaints($complaints_str);
		//}
		$ddoc = $_REQUEST['ddoc'];
		$nur = $_REQUEST['nur'];
		
		//if(isset($_REQUEST['diagnosis']) && !empty($_REQUEST['diagnosis'])){
		//	$diagnosis_str = implode (",", $_REQUEST['diagnosis']);
		//	$diagnosis = get_diagnosis($diagnosis_str);
		//}
		
		
		include("config_db2.php");
		//if($id !="") {	
		//$cmd = "update user_login set username='$user', password='$pass', role=$role where id=".$id;
				//if(mysql_query($cmd))
					//echo 'user info. updated!';
				//else
					//echo 'unable to update';		
			//}else{
				
				$cmd = "INSERT INTO ddoc (ddoc,nur) VALUES ('$ddoc','$nur')";
				$insert=mysql_query($cmd);
				$update = false;
				//if($insert){
			//$insertid = mysql_insert_id();
				//$update = mysql_query("UPDATE clinical_others SET clinical_history_id='$insertid' WHERE patient_id='$pid' AND clinical_history_id=''");
				
				//}
				if($update)
					echo 'success';
				else
					echo 'unable to Insert';
			//}
			mysql_close($db2);
	}
?>