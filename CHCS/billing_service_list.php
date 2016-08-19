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


 <table id="services_ids" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Services</th>
						<th>Count</th>
                        <th>Amount <br>Per Count</th>
                        <th>Amount</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
				 	$cmd = "select * from services_details where patient_id='$pat_id' and paid_status!='1'  AND bill_queue='1'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='BILLING';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['service_name']."/".$rs['duration']; ?></td>
						<td><?php echo $rs['given_details']; ?></td>
						<td><?php echo $rs['count']; ?></td>
						<td><?php echo $rs['total_count']; ?></td>
						<td><a href="#" onclick="delete_servicess('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>
                        </tbody>
                        </table>
