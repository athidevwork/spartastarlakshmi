<?php
		include("config_db2.php");
	$id = $_REQUEST['id'];
	$patient_id = $_REQUEST['patient_id'];
	if($patient_id != "")
	{
		$cmd = "delete from fees_detailsip where id='$id' and patient_id='$patient_id'";
	}
	$cmds=mysql_query($cmd);
		?>				

<table id="dataTables-example" class="table table-striped table-bordered table-hover" width="75%">
										<thead>
										<tr>
										<th>#</th>
										<th>Description</th>
										<th>Fees</th>
										<th>Action</th>
										</tr>
										</thead>
										 <tbody>
                         <?php 
					include("config_db2.php");
					$ser=$_REQUEST['ser'];
					
					$cmd = "select * from fees_detailsip where paid_status!='1' and patient_id='$patient_id' AND ip_id='' ";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['description']; ?></td>
						<td><?php echo $rs['fees']; ?></td>
						<td><a href="#" onclick="delete_fee('<?php echo $rs['id'];?>','<?php echo $rs['patient_id'];?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php $total_fees+=$rs['fees'];}
				?>
                        </tbody>
                                </table>
                                