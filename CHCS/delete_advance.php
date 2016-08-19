<?php
		include("config_db2.php");
	$id = $_REQUEST['id'];
	$patient_id = $_REQUEST['patient_id'];
	$ip_no = $_REQUEST['ip_no'];
	if($patient_id != "")
	{
		$cmd = "delete from ip_patientadv where id='$id' and patientid='$patient_id'";
	}
	$cmds=mysql_query($cmd);
		?>	
        <table id="advance_id" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                       <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Advance Amount</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					 $cmd = "select * from ip_patientadv where patientid='$patient_id' and ip_no='$ip_no'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$id=$rs['id'];
						$insert_from='CHART OT';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['description']; ?></td>
						<td><?php echo $rs['advance_amt']; ?></td>
						<td><a href="#" onclick="delete_advance('<?php echo $rs['id'];?>','<?php echo $rs['patientid'];?>','<?php echo $rs['ip_no'];?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php } ?>

                        </tbody>
                    </table>