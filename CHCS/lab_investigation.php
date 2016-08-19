<?php

function get_lab_det2($lab_id,$lab_full_det)
   {
		include("config_db1.php");
		$lab_id = strtolower($lab_id);
		
	$ex=mysql_query("select * from $lab_id where id = '$lab_full_det'");
	$ex1=mysql_fetch_array($ex);
	$sym=$ex1['sym'];
	return $sym;
	}
	
	$lab_id = $_REQUEST['lab_det'];
	$lab_det = $_REQUEST['inves1'];
	$lab_full_det = $_REQUEST['lab_full_det'];
	$get_lab_names=get_lab_det2($lab_id,$lab_full_det);
	$patient_id = $_REQUEST['pat_id'];
	$reports = $_REQUEST['chief'];
	$note = $_REQUEST['note'];
    $fees = $_REQUEST['fees'];
	$created_date=date('Y-m-d H:i:sa');
	if($patient_id != "")
	{
		include("config_db2.php");
		 $cmd1 = "INSERT INTO lab_details_ip (id,patient_id,lab_id,lab_det,lab_full_det,lab_full_det_name,fees,created_date,bill_queue) VALUES (NULL,'$patient_id','$lab_id','$lab_id','$lab_full_det','$get_lab_names','$fees','$created_date','1')";
		$cmds1=mysql_query($cmd1);
    }
	
	
?>


					<table id="investable" class="table table-bordered table-striped table-actions">
                        <thead>
                        <tr>
                  <th>No</th>
                  <th>Type</th>
                  <th style="display:none">Type</th>
                  <th>Test</th>
                  <th>Report</th>
                  <th>Notes</th>
                  <th>Action</th>
				  <th style="display:none">Action</th>
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
					<?php }
				?>

                        </tbody>
                    </table>
