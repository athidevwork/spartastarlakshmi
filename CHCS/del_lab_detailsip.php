<?php
include("config_db2.php");
	$id = $_REQUEST['id'];
	$patient_id = $_REQUEST['patient_id'];
	if($id != "")
	{
		 $cmd1 = "delete from lab_details_ip where id='$id'";
		$cmds1=mysql_query($cmd1);
    }


?>


					<table id="dataTables-example11" class="table table-striped table-bordered table-hover" width="30%">
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
		$lab_det=strtolower($lab_det);
					$cmd11 = "select * from $lab_det where id='$lab_full_det'";
					$res11 = mysql_query($cmd11);
					while($rs11 = mysql_fetch_array($res11)){
						$sym11=$rs11['sym'];
					}
					return $sym11;
	}
						
	
					 $cmd = "select * from lab_details_ip where patient_id='$patient_id' and paid_status!='1' AND bill_queue = '1'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['lab_det']; ?></td>
						<td><?php echo get_lab_full_det1($rs['lab_det'],$rs['lab_full_det']); ?></td>
                       <td><?php echo $rs['fees']; ?></td>
						<td><a href="#" onclick="delete_patient_details('<?php echo $rs['id'];?>','<?php echo $rs['patient_id'];?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php } ?>

                        </tbody>
                    </table>
