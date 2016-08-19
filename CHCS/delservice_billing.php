<?php
		include("config_db2.php");
	$ref_no = $_REQUEST['ref_no'];
	$serviceid = $_REQUEST['serviceid'];
	$patient_id = $_REQUEST['patient_id'];
		$ip_id = $_REQUEST['ip_no'];

	if($serviceid != ""){

		$cmd = "delete from services_details where id='$serviceid' ";
		//$cmd1 = "delete from fees_details where insert_id='$serviceid' ";
	}
	$cmds=mysql_query($cmd);
	//$cmds1=mysql_query($cmd1);
		?>				

                     
                        <table id="services_ids" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Services</th>
                        <th>Count</th>
						<th>Amount <br>per Count</th>
                        <th>Amount</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
				$cmd = "select * from services_details where patient_id='$patient_id' and paid_status!='1' AND bill_queue='1'";
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
