<?php
	session_start();
	$user = $_SESSION['username'];
	date_default_timezone_set('Asia/Kolkata');
include("config_db2.php");
	$room_no = $_REQUEST['room_no'];
	$name = $_REQUEST['name'];
	$pid = $_REQUEST['pid'];
	$age = $_REQUEST['age'];
	$doa = date('Y-m-d',strtotime($_REQUEST['doa']));
	$cons = $_REQUEST['cons'];
	$intimedate = date('Y-m-d H:i:s',strtotime($_REQUEST['intimedate']));
	$chart_ot_no = $_REQUEST['chart_ot_no'];
	$patient_ip_id = $_REQUEST['patient_ip_id'];
	$remarks=mysql_real_escape_string($_REQUEST['description']);
    $remarks1=str_replace("\$1quot;",'"',$remarks);
    $remarks12=str_replace("\$1amp;",'&',$remarks1);
    $descriptions=str_replace("\$1nbsp;",'    ',$remarks12);
	$shift_patient = $_REQUEST['shift_patient'];
	$outtime = date('Y-m-d H:i:s',strtotime($_REQUEST['outtime']));
	
	$vacant_chk = $_REQUEST['vacant_chk'];	
	
	$created_date=date("Y-m-d H:i:s");
	if($room_no =='OT1'){
	$vacant_chk ='checked';
	}
	include("config_db1.php");
	$cmd_shift_room_check_row = mysql_num_rows(mysql_query("select id,rate from room_no WHERE id = '$shift_patient' AND vacant ='no'"));
	if($cmd_shift_room_check_row ==1){
		echo "Room is Already Occupied. Select Different room.";
		exit;
	}
	include("config_db2.php");
	if($chart_ot_no != ""){
		include("config_db2.php");
		$cmd = "INSERT INTO chart_ot (id,ref_id,patientid,ip_no,insert_from,room_no,name,age,doa,cons,intimedate,description,shift_patient,outtime,vacant_chk,created_date) VALUES (NULL, '$chart_ot_no','$pid','$patient_ip_id','CHART','$room_no','$name','$age','$doa','$cons','$intimedate','$descriptions','$shift_patient','$outtime','$vacant_chk','$created_date')";
		$cmds=mysql_query($cmd);
		$cmd_bill_queue = mysql_query("UPDATE sitting_details SET bill_queue='1' where ip_no='$patient_ip_id' AND paid_status !=1 AND bill_queue='0'");
		$cmd_bill_queue = mysql_query("UPDATE services_details SET bill_queue='1' where ip_no='$patient_ip_id' AND paid_status !=1 AND bill_queue='0'");
		$cmd_bill_queue = mysql_query("UPDATE procedure_details SET bill_queue='1' where ip_no='$patient_ip_id' and paid_status !=1 AND bill_queue='0'");
		$cmd_bill_queue = mysql_query("UPDATE consultant_details SET bill_queue='1' where ip_no='$patient_ip_id' and paid_status !=1 AND bill_queue='0'");
		if(!empty($shift_patient) && $shift_patient !='Discharge' && $shift_patient !='select'){
					
				include("config_db2.php");
				$cmd_update_current_room_in_admission = mysql_query("UPDATE inv_patient SET room='$shift_patient' WHERE inv_pat_id ='$patient_ip_id'");
				include("config_db1.php");
					$before_ot_room ='';
					$before_ot_room_query = mysql_query("SELECT id from room_no WHERE vacant='$patient_ip_id'");
					while($before_ot_room_array = mysql_fetch_array($before_ot_room_query)){
						$before_ot_room = $before_ot_room_array['id'];
						
					}
				$existing_rm_allc_out_date ='';
				$vacate ='';
				$fee_tobe_paid ='';
					
									
					
				if($vacant_chk == 'checked'){
					$existing_rm_allc_out_date = $outtime;
					$vacate = 'yes';
					$existing_rm_nos = array();
					include("config_db2.php");
					$cmd_room_check = mysql_query("select room_id from room_bill_details  WHERE  `ip_no`='$patient_ip_id' AND `paid_status`= '0' AND `to_time`= ''");
					while($rs = mysql_fetch_array($cmd_room_check)){
						$existing_rm_nos[] = $rs['room_id'];
						
					}
					$existing_rm_nos_implode=implode(",",$existing_rm_nos);
					include("config_db1.php");
					
					$cmd_vacate_rm =mysql_query("Update room_no set vacant='' where id IN ($existing_rm_nos_implode)");
					$cmd_fill_rm =mysql_query("Update room_no set vacant='no' where id=$shift_patient");
					
				include("config_db2.php");
				if($shift_patient == $before_ot_room){
					
				mysql_query("UPDATE `dps_patients`.`room_bill_details` SET  `insert_from` ='CHART',`to_time`='$existing_rm_allc_out_date', `vacate`='$vacate' WHERE  `ip_no`='$patient_ip_id' AND `paid_status`= '0' AND `to_time`= '' AND room_id <> '$shift_patient'");
				}else{
					
					mysql_query("UPDATE `dps_patients`.`room_bill_details` SET  `insert_from` ='CHART',`to_time`='$existing_rm_allc_out_date', `vacate`='$vacate' WHERE  `ip_no`='$patient_ip_id' AND `paid_status`= '0' AND `to_time`= ''");
					
				}
					
							
				}else{
					include("config_db1.php");
					if($shift_patient=='13'){
					$cmd_fill_rm_id = get_room_id($room_no);
					$cmd_fill_rm =mysql_query("Update room_no set vacant='$patient_ip_id' where id='$cmd_fill_rm_id'");
					}
					
					$cmd_fill_rm =mysql_query("Update room_no set vacant='no' where id='$shift_patient'");
					
				}
			
			$current_rm_indate = date('Y-m-d H:i:s',strtotime($_REQUEST['intimedate']));
			//echo "SHIFY: $shift_patient";
			//echo "BEFOR: $before_ot_room";
			if($shift_patient != $before_ot_room){
			include("config_db2.php");
			
			//echo "INSERT INTO `dps_patients`.`room_bill_details` (`id`, `ref_no`, `insert_from`, `bill_number`, `room_id`, `ip_no`, `room_name`, `patient_id`, `from_time`, `to_time`, `vacate`, `given_details`, `fees_amount`, `paid_status`, `created_date`) VALUES (NULL, '$chart_ot_no', 'CHART','', '$shift_patient', '$patient_ip_id', '', '', '$current_rm_indate', '','', '', '', '0', '$created_date')";
				$cmdcmd_insert_current_rm_bill_query = mysql_query("INSERT INTO `room_bill_details` (`id`, `ref_no`, `insert_from`, `bill_number`, `room_id`, `ip_no`, `room_name`, `patient_id`, `from_time`, `to_time`, `vacate`, `given_details`, `fees_amount`, `paid_status`, `created_date`,`added_by`) VALUES (NULL, '$chart_ot_no', 'CHART','', '$shift_patient', '$patient_ip_id', '', '$pid', '$current_rm_indate', '','', '', '', '0', '$created_date','$user')");
			}
			
		}
		if($shift_patient =='Discharge'){
			//return $vacant_chk;
			$existing_rm_allc_out_date ='';
				$vacate ='';
				$fee_tobe_paid ='';
				
					$existing_rm_allc_out_date = $outtime;
					$vacate = 'yes';
					$existing_rm_nos = array();
					include("config_db2.php");
					$cmd_room_check = mysql_query("select room_id from room_bill_details WHERE  `ip_no`='$patient_ip_id' AND `paid_status`= '0' AND `to_time`= ''");
					while($rs = mysql_fetch_array($cmd_room_check)){
						$existing_rm_nos[] = $rs['room_id'];
						
					}
					$existing_rm_nos_implode=implode(",",$existing_rm_nos);
					include("config_db1.php");
					
					$cmd_vacate_rm =mysql_query("Update room_no set vacant='' where id IN ($existing_rm_nos_implode)");
					//$cmd_fill_rm =mysql_query("Update room_no set vacant='no' where id='$shift_patient'");
					
				include("config_db2.php");
				mysql_query("UPDATE `room_bill_details` SET  `insert_from` ='CHART',`to_time`='$existing_rm_allc_out_date', `vacate`='$vacate' WHERE  `ip_no`='$patient_ip_id' AND `paid_status`= '0' AND `to_time`= ''");
					
							
				
							
				
		}
			include("config_db1.php");
			$cmd_get_rm_fee_query = mysql_query("select id,rate from room_no");
					while($cmd_get_rm_fee_array = mysql_fetch_array($cmd_get_rm_fee_query)){
						$cmd_get_rm_id = $cmd_get_rm_fee_array['id'];
						$cmd_get_rm_fee = $cmd_get_rm_fee_array['rate'];
						include("config_db2.php");
						//echo "ROOM: select * from room_bill_details WHERE `ip_no`='$patient_ip_id' AND `paid_status`= '0' AND `vacate`='yes' AND `room_id` = '$cmd_get_rm_id' ";
						$cmd_get_vacate_rm_wo_fee = mysql_query("select from_time,to_time from room_bill_details WHERE `ip_no`='$patient_ip_id' AND `paid_status`= '0' AND `vacate`='yes' AND `room_id` = '$cmd_get_rm_id' ");
						$cmd_get_vacate_rm_wo_fee_num_rows = mysql_num_rows($cmd_get_vacate_rm_wo_fee);
						
						if($cmd_get_vacate_rm_wo_fee_num_rows !=0){
							while($cmd_get_vacate_rm_wo_fee_array = mysql_fetch_array($cmd_get_vacate_rm_wo_fee)){
								$cmd_get_vacate_rm_wo_fee_array_in_date = $cmd_get_vacate_rm_wo_fee_array['from_time'];
								$cmd_get_vacate_rm_wo_fee_array_out_date = $cmd_get_vacate_rm_wo_fee_array['to_time'];
								$no_of_day = floor(abs(strtotime($cmd_get_vacate_rm_wo_fee_array_out_date) - strtotime($cmd_get_vacate_rm_wo_fee_array_in_date)) / 86400);
								if($no_of_day ==0)
									$no_of_day =1;
									
									//$newDateTime = date('A', strtotime($cmd_get_vacate_rm_wo_fee_array_out_date));
									
									$a = date('A', strtotime($cmd_get_vacate_rm_wo_fee_array_in_date));
                                    $b = date('A', strtotime($cmd_get_vacate_rm_wo_fee_array_out_date));
									
									if($a=='AM' && $b=='PM')

{
	  
	    $fee_tobe_paid =(($no_of_day+1))*$cmd_get_rm_fee;
	
	}
	elseif($a=='PM' && $b=='AM')

{
	if ($no_of_day==0){
         
		$no_of_day=1; 
      }

	 $fee_tobe_paid =(($no_of_day+1))*$cmd_get_rm_fee;
	
	
	}	elseif($a=='PM' && $b=='PM')

{
	 
	$fee_tobe_paid=(abs((($no_of_day+1)-.5)))*$cmd_get_rm_fee;
	
	
	}elseif($a=='AM' && $b=='AM')

{
	$fee_tobe_paid=(abs((($no_of_day+1)-.5)))*$cmd_get_rm_fee;
	}
								
								//echo "UPDATE: UPDATE `dps_patients`.`room_bill_details` SET  `fees_amount`=$fee_tobe_paid WHERE `ip_no`='$patient_ip_id' AND `paid_status`= '0' AND `vacate`='yes' AND `room_id` = '$cmd_get_rm_id'";
								mysql_query("UPDATE `room_bill_details` SET  `fees_amount`=$fee_tobe_paid WHERE `ip_no`='$patient_ip_id' AND `paid_status`= '0' AND `vacate`='yes' AND `room_id` = '$cmd_get_rm_id'");
							}
							
						}
					}
		
		
		echo "Added Successfully!";
	}
		
function get_room_id($room)
{
	include("config_db1.php");
	$sql2="select id from  room_no where room='$room'"; 
	$rs2=mysql_query($sql2);
	while($rsdata2=mysql_fetch_array($rs2))
	{
		$room=$rsdata2['id'];
	}
	return $room;
}		
						
?>
