<?php
		include("config_db2.php");
	$ref_no = $_REQUEST['ref_no'];
	$procedureid = $_REQUEST['procedureid'];
	$patient_id = $_REQUEST['patient_id'];
	$ip_id = $_REQUEST['ip_id'];

	if($procedureid != ""){

		$cmd = "delete from procedure_details where id='$procedureid' ";
/*		$cmd1 = "delete from fees_details where insert_id='$procedureid' ";
*/	}
	$cmds=mysql_query($cmd);
	$cmds1=mysql_query($cmd1);
		?>				

                       <table id="procedures_ids_div" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Procedure</th>
                        <th>Timing</th>
                       <th>Consultant</th>
                        <th>Amount</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					 $cmd = "select * from procedure_details where patient_id='$patient_id' and paid_status!='1' AND bill_queue='1'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='BILLING';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['procedure_name']."/".$rs['duration']; ?></td>
						<td><?php echo $rs['given_details']; ?></td>
                        <td><?php echo $rs['consultant']; ?></td>
                        <td><?php echo $rs['total_count']; ?></td>	
						<td><a href="#" onclick="delete_procedures2('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>
