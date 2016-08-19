<?php
include("config_db2.php");
	$id = $_REQUEST['id'];
	$patient_id = $_REQUEST['patient_id'];
	if($id != "")
	{
		 $cmd1 = "delete from patientlabdetails where id='$id'";
		$cmds1=mysql_query($cmd1);
    }
		function get_lab_full_det1($from,$id)
	{
		include("config_db1.php");
		$from=strtolower($from);
					$cmd11 = "select * from $from where id='$id'";
					$res11 = mysql_query($cmd11);
					while($rs11 = mysql_fetch_array($res11)){
						$sym11=$rs11['sym'];
					}
					return $sym11;
	}

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
						 
						 
						
	
					$cmd = "select * from patientlabdetails where patient_id='$patient_id' and paid_status!='1'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['lab_det']; ?></td>
						<td><?php echo $rs['lab_full_det']; ?></td>
                       <td><?php echo $rs['fees']; ?></td>
						<td><a href="#" onclick="delete_patient_details('<?php echo $rs['id'];?>','<?php echo $rs['patient_id'];?>'),get_total_amt(pat_id.value)" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>
