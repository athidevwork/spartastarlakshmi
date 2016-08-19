<?php
session_start();
$role=$_SESSION['role'];
date_default_timezone_set('Asia/Kolkata'); 
		include("config_db2.php");
		function get_ipno($pat_id)
		{
					 $cmd = "select * from ip_patientadv where patientid='$pat_id' ";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$ip_no=$rs['ip_no'];
					}
			return $ip_no;
			}
		
		$pat_id=$_REQUEST['pat_id'];
		$ip_no=get_ipno($pat_id);
		?>


					<table id="fees_id" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Lab </th>
                        <th>Lab Details</th>
                        <th>Fees</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
						 
						 function get_lab_full_det1($lab_det,$lab_full_det)
	{
		include("config_db1.php");
		$from=strtolower($from);
					$cmd11 = "select * from $lab_det where id='$lab_full_det'";
					$res11 = mysql_query($cmd11);
					while($rs11 = mysql_fetch_array($res11)){
						$sym11=$rs11['sym'];
					}
					return $sym11;
	}
						
	$cmd = "select * from lab_details_ip where patient_id='$pat_id' and paid_status!='1' AND bill_queue='1'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['lab_det']; ?></td>
						<td><?php echo get_lab_full_det1($rs['lab_det'],$rs['lab_full_det']); ?></td>
                       <td><?php echo $rs['fees']; ?></td>
						<td><a href="#" onclick="delete_patient_details('<?php echo $rs['id'];?>','<?php echo $rs['patient_id'];?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php } ?>

                        </tbody>
                    </table>
