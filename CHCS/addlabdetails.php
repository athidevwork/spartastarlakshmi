<?php
include("config_db2.php");

   function get_lab_det2($lab_id,$lab_full_det)
   {
		include("config_db1.php");
	$ex=mysql_query("select * from $lab_id where id = '$lab_full_det'");
	$ex1=mysql_fetch_array($ex);
	$sym=$ex1['sym'];
	return $sym;
	}
	
	$lab_id = $_REQUEST['lab_det'];
	$lab_det = $_REQUEST['inves1'];
	$lab_full_det = $_REQUEST['lab_full_det'];
	$get_lab_names=get_lab_det2($lab_id,$lab_full_det);
	$patient_id = $_REQUEST['patient_id'];
    $fees = $_REQUEST['fees'];
	$created_date=date('Y-m-d');
	if($patient_id != "")
	{   
	 include("config_db2.php");
	
	$cmd1 = "INSERT INTO patientlabdetails (id,patient_id,lab_id,lab_det,lab_full_det,lab_full_det_name,fees,created_date) VALUES (NULL,'$patient_id','$lab_id','$lab_id','$lab_full_det','$get_lab_names','$fees','$created_date')";
		$cmds1=mysql_query($cmd1);
    }
	
?>
					<table id="dataTables-example1234" class="table table-striped table-bordered table-hover" width="30%">
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
						
	            include("config_db2.php");
					$cmd = "select * from patientlabdetails where patient_id='$patient_id' and paid_status!='1'";
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
					<?php }
				?>

                        </tbody>
                    </table>
