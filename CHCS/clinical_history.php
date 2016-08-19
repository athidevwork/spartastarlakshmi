<?php
date_default_timezone_set('Asia/Kolkata');
	$action = $_REQUEST['action'];
	if($action =='add'){
		$pid = $_REQUEST['pid'];
		$complaint_no = $_REQUEST['complaint_no'];
		$complaints ='';
		//if(isset($_REQUEST['complaints']) && !empty($_REQUEST['complaints'])){
		//	$complaints_str = implode (",", $_REQUEST['complaints']);
		//	$complaints = get_complaints($complaints_str);
		//}
		$bp = $_REQUEST['bp'];
		$temp = $_REQUEST['temp'];
		$pulse = $_REQUEST['pulse'];
		$wt = $_REQUEST['wt'];
		$ht = $_REQUEST['ht'];
		$dm = $_REQUEST['dm'];
		$cad = $_REQUEST['cad'];
		$asthma = $_REQUEST['asthma'];
		$seizure = $_REQUEST['seizure'];
		$pallor = $_REQUEST['pallor'];
		$icterus = $_REQUEST['icterus'];
		$clubbing = $_REQUEST['clubbing'];
		$cyanosis = $_REQUEST['cyanosis'];
		$ln = $_REQUEST['ln'];
		$ef = $_REQUEST['ef'];
		$oc = $_REQUEST['oc'];
		$oh = $_REQUEST['oh'];
		$diagnosis ='';
		//if(isset($_REQUEST['diagnosis']) && !empty($_REQUEST['diagnosis'])){
		//	$diagnosis_str = implode (",", $_REQUEST['diagnosis']);
		//	$diagnosis = get_diagnosis($diagnosis_str);
		//}
		$id = $_REQUEST['id'];
		$room_no= $_REQUEST['room_no'];
		$consultant = $_REQUEST['consultant'];
		$create_date=date("Y-m-d H:i:s");
		
		$ip_id = get_ip_id($pid);
		
		include("config_db2.php");
		//if($id !="") {	
		//$cmd = "update user_login set username='$user', password='$pass', role=$role where id=".$id;
				//if(mysql_query($cmd))
					//echo 'user info. updated!';
				//else
					//echo 'unable to update';		
			//}else{
				
				
				$cmd = "INSERT INTO clinical_history (id,patient_id,ip_no, complaint_no, complaints, bp,temp, pulse, wt, ht, dm, cad, asthma, seizure, pallor, icterus, clubbing, cyanosis,ln, ef, oc, oh, diagnosis, room_no, consultant,  create_date) VALUES (NULL,'$pid','$ip_id', '$complaint_no', '$complaints', '$bp','$temp','$pulse','$wt','$ht','$dm', '$cad', '$asthma', '$seizure','$pallor','$icterus','$clubbing','$cyanosis','$ln','$ef','$oc','$oh', '$diagnosis', '$room_no', '$consultant', '$create_date')";
				$insert=mysql_query($cmd);
				$update = false;
				if($insert){
				$insertid = mysql_insert_id();
				$update = mysql_query("UPDATE clinical_others SET clinical_history_id='$insertid' WHERE patient_id='$pid' AND clinical_history_id=''");
				
				}
				if($update)
					echo 'success';
				else
					echo 'unable to Insert';
			//}
			mysql_close($db2);
	}
	if($action=='list'){
		$pid = $_REQUEST['pid'];
		include("config_db2.php");
		$msg='';
			$cmd_clinic_hist_query = mysql_query("select id,complaints,diagnosis,create_date from clinical_history WHERE patient_id ='$pid' order by id desc");
			$cmd_clinic_hist_num = mysql_num_rows($cmd_clinic_hist_query);
		if($cmd_clinic_hist_num >0){
			while($cmd_clinic_hist_array = mysql_fetch_array($cmd_clinic_hist_query)){
				
				$id = $cmd_clinic_hist_array['id'];
				$complaints =array();
				$diagnosis =array();
				$cmd_clinic_complaints_diagnosis_query = mysql_query("select id,type,reason from clinical_others WHERE patient_id ='$pid' AND clinical_history_id ='$id' order by id desc");
				while($cmd_clinic__complaints_diagnosis_array = mysql_fetch_array($cmd_clinic_complaints_diagnosis_query)){
					$type= $cmd_clinic__complaints_diagnosis_array['type'];
					if($type=='complaints')
						$complaints[] = $cmd_clinic__complaints_diagnosis_array['reason'];
					if($type=='diagnosis')
						$diagnosis[] = $cmd_clinic__complaints_diagnosis_array['reason'];
				}
				$complaints = implode (",", $complaints);
				$diagnosis = implode (",", $diagnosis);
				$create_date = date('M j Y g:i A',strtotime($cmd_clinic_hist_array['create_date']));
				
				//$sample_edit = '<a data-id="'.$cmd_clinic_hist_array['labsampleno'].'" onclick="get_iplab_list(this);return false;" data-toggle="modal" href="#labsampletestedit_modal">'.ucfirst($cmd_clinic_hist_array['labsampleno']).'</a>';
				//$report_view ='';
				$view ='<a data-id="'.$id.'" onclick="get_clinichist_list(this);return false;" data-toggle="modal" href="#get_clinichist_modal"><span class="fa fa-eye"></span></a>';
					
					
					
				$msg .= $create_date.'~'.$complaints.'~'.$diagnosis."~".$view.'@';	
			}
				$msg = substr($msg, 0, -1);
				echo $msg;
		}
				mysql_close($db2);
	}
	if($action=='pc_modal_view'){
		$cno = $_REQUEST['pcno'];
		include("config_db2.php");
			$cmd_clinic_hist_query = mysql_query("select id,patient_id,complaints, bp, temp, pulse, wt, ht, dm, cad, asthma, seizure, pallor, icterus, clubbing, cyanosis, ln, ef, oc, oh, diagnosis, room_no, consultant,  create_date from clinical_history WHERE id ='$cno' order by id desc LIMIT 1");
			$cmd_clinic_hist_array = mysql_fetch_array($cmd_clinic_hist_query);
	?>
	
                            
                                    <h5 >&nbsp;&nbsp;&nbsp;</h5>
									 <div class="form-group">
									 <div class="col-md-6" align="center">
                                     <label class="col-md-6 control-label"  ><strong>Patient ID</strong>: <?php echo $cmd_clinic_hist_array['patient_id']; ?></label>  
                                                                                    
												   </div>
									<div class="col-md-6" align="center">
                                     <label class="col-md-6 control-label"  ><strong>Date</strong>:&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $cmd_clinic_hist_array['create_date']; ?></label>  
                                                                                    
												   </div>
									 </div>
									   <?php
										include("config_db2.php");
										
										$cmd_clinic_query = mysql_query("select id,type,reason,consultant,room_no from clinical_others WHERE clinical_history_id ='$cno' order by id desc");
						$i=1;
						$cmd_clinic_num = mysql_num_rows($cmd_clinic_query);
						if($cmd_clinic_num >0){
							while($cmd_clinic_array = mysql_fetch_array($cmd_clinic_query)){
								$type = $cmd_clinic_array['type'];
								$reason[$type][] =$cmd_clinic_array['reason'];
								$room_no = ($cmd_clinic_array['room_no']==0) ? '' : $cmd_clinic_array['room_no']; 
								$consultant =$cmd_clinic_array['consultant'];
								
							}
							//$complaints_count = count($reason['complaints']);
						}
							
						?>
						<div class="form-group">
									 <div class="col-md-6" align="center">
                                     <label class="col-md-12 control-label"  ><strong>Complaints</strong>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (count($reason['complaints'])==0) ? 'Nil' : implode(',',$reason['complaints']);  ?></label>  
                                                                                    
												   </div>
									<div class="col-md-6" align="center">
                                     <label class="col-md-12 control-label"  ><strong>Diagnosis</strong>:&nbsp;&nbsp;&nbsp;&nbsp; <?php echo (count($reason['diagnosis'])==0) ? 'Nil' : implode(',',$reason['diagnosis']);  ?></label>  
                                                                                    
												   </div>
						</div>   
						
						<div class="form-group">
						 <div class="col-md-6" align="left">
                                     <label class="col-md-12 control-label"  ><strong>BP</strong>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (count($reason['bp'])==0) ? 'Nil' : implode($bp);  ?></label>
						</div>
						
						
										<div class="form-group">
										  
										 <div class="col-md-3" align="left">
                                     <label class="col-md-8 control-label"  ><strong>DM</strong>:&nbsp;&nbsp;&nbsp;&nbsp;    <?php echo ($cmd_clinic_hist_array['dm']==0) ?  'NO' : 'YES' ?></label>  
                                                                                    
												   </div>
											   
                                   
                                                     <div class="col-md-3">
                                            <label class="col-md-4 control-label"  ><strong>CAD</strong>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($cmd_clinic_hist_array['cad']==0) ?  'NO' : 'YES' ?></label>  
                                                                                   
												   </div>  
										<div class="col-md-3" align="left">
                                     <label class="col-md-8 control-label"  ><strong>Asthma</strong>:&nbsp;&nbsp;&nbsp;&nbsp;    <?php echo ($cmd_clinic_hist_array['asthma']==0) ?  'NO' : 'YES' ?></label>  
                                                                                    
												   </div>
											   
                                   
                                                     <div class="col-md-3">
                                            <label class="col-md-4 control-label"  ><strong>Seizure</strong>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($cmd_clinic_hist_array['seizure']==0) ?  'NO' : 'YES' ?></label>  
                                                                                   
												   </div>		   
                       
										</div>
										<?php
						if(count($reason['Personal History']) > 0 || count($reason['Family History']) > 0 || count($reason['Others']) > 0){
						?>
										<h3>Details</h3>
								
										<div class="col-md-12">
										
										<center>
	<table id="clinichist-dataTables" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>#</th>
					    <th>Type</th>
                        <th>Reason</th>
						<th>Room</th>
						<th>Consultant</th>
                        </tr>
                        </thead>
                        <tbody>
						
						
						<?php
						if(count($reason['Personal History']) > 0){
						?>
							<tr>
							<td><?php echo $i++; ?></td>
							<td>Personal History</td>
							<td><?php echo (count($reason['Personal History'])==0) ? 'Nil' : implode(',',$reason['Personal History']);  ?></td>
							<td><?php echo $room_no;  ?></td>
							<td><?php echo $consultant;  ?></td>
							</tr>
						<?php
						}
						?>
						<?php
						if(count($reason['Family History']) > 0){
						?>
							<tr>
							<td><?php echo $i++; ?></td>
							<td>Family History</td>
							<td><?php echo (count($reason['Family History'])==0) ? 'Nil' : implode(',',$reason['Family History']);  ?></td>
							<td><?php echo $room_no;  ?></td>
							<td><?php echo $consultant;  ?></td>
							</tr>
						<?php
						}
						?>
						<?php
						if(count($reason['Others']) > 0){
						?>
						
							<tr>
							<td><?php echo $i++; ?></td>
							<td>Others</td>
							<td><?php echo (count($reason['Others'])==0) ? 'Nil' : implode(',',$reason['Others']);  ?></td>
							<td><?php echo $room_no;  ?></td>
							<td><?php echo $consultant;  ?></td>
							</tr>
						<?php
						}
						?>
						
 </tbody>
                                </table></center>
										</div>
						
                                <?php
						}
						?>
                                        

                                       
							
							
		
	<?php	
	}
	function get_ip_id($pid)
	{
		include("config_db2.php");
		$Isql=mysql_fetch_array(mysql_query("select inv_pat_id from inv_patient where patientid='$pid' and pat_ip_status='0' limit 1"));
		$ipid=$Isql['inv_pat_id'];
		return $ipid;
	}
	function get_complaints($cid)
	{
		include("config_db1.php");
		$dname = array();
		$Isql_query=mysql_query("select display_name from complaint_tbl_name where id IN ($cid)");
		while($Isql = mysql_fetch_array($Isql_query)){
			$dname[]=$Isql['display_name'];	
		}
		$dname_str ='';
		if(!empty($dname))
		$dname_str = implode (",", $dname);
		return $dname_str;
	}
	function get_diagnosis($did)
	{
		include("config_db1.php");
		$diag = array();
		$Isql_query=mysql_query("select diag_sym from diagnosis where id IN ($did)");
		while($Isql = mysql_fetch_array($Isql_query)){
		$diag[]=$Isql['diag_sym'];
		}
		$diag_str ='';
		if(!empty($diag))
		$diag_str = implode (",", $diag);
		return $diag_str;
	}
?>