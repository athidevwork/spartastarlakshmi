<?php
		include("config_db2.php");
	$ref_no = $_REQUEST['ref_no'];
	$serviceid = $_REQUEST['serviceid'];
	$chart_ot = $_REQUEST['chart_ot'];
	if($serviceid != ""){

		$cmd = "delete from services_details where id='$serviceid' and insert_from='$chart_ot'";
		$cmd1 = "delete from fees_details where insert_id='$serviceid' and insert_from='$chart_ot'";
	}
	$cmds=mysql_query($cmd);
	$cmds1=mysql_query($cmd1);
		?>				

                        <table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Services</th>
                        <th>Duration</th>
                        <th>Timing</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					$cmd = "select * from services_details where ref_no='$ref_no' and insert_from='CHART OT'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='CHART OT';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['service_name']; ?></td>
						<td><?php echo $rs['duration']; ?></td>
						<td><?php echo $rs['given_details']; ?></td>
						<td><a href="#" onclick="delete_services('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>
                        </tbody>
                        </table>
