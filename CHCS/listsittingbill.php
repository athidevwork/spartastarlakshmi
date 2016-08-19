<?php
	include("config_db2.php");
	$patient_id = $_REQUEST['patient_id'];
	$mrd_no = $_REQUEST['mrd_no'];
	$req_from = $_REQUEST['req_from'];
	$action = $_REQUEST['action'];
	
	$cmds=mysql_query($cmd);
		?>				

                       <table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Type Name</th>
                        <th>Sitting</th>
						<?php if($req_from =='Billing'){ ?>
						<th>Amount</th>
						<?php } ?>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					include("config_db2.php");
					$cmd = "select * from sitting_details where patient_id='$patient_id' AND paid_status !=1 AND bill_queue='0'";
					if($req_from =='Billing'){
						$cmd = "select * from sitting_details where patient_id='$patient_id' AND paid_status !=1 AND bill_queue='1'";
					} 
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['type_name']; ?></td>
						<td><?php echo $rs['sitting']; ?></td>
						<?php if($req_from =='Billing'){ ?>
						<td><?php echo $rs['total_count']; ?></td>
						<?php } ?>
						<td><a href="#" onclick="delete_sitting('<?php echo $rs['id'];?>','<?php echo $ref_no;?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>
                        </tbody>
                        </table>