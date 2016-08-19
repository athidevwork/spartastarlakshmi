<?php
	include("config_db2.php");
function get_lab_det2($lab_id,$lab_full_det)
   {
		include("config_db1.php");
		$lab_id = strtolower($lab_id);
		
	$ex=mysql_query("select * from $lab_id where id = '$lab_full_det'");
	$ex1=mysql_fetch_array($ex);
	$sym=$ex1['sym'];
	return $sym;
	}
	function get_lab_det_fee($lab_id,$lab_full_det)
   {
		include("config_db1.php");
		$lab_id = strtolower($lab_id);
		
	$ex=mysql_query("select * from $lab_id where id = '$lab_full_det'");
	$ex1=mysql_fetch_array($ex);
	$rate=$ex1['rate'];
	return $rate;
	}
	$patient_id = $_REQUEST['pat_id'];
	$current_date = date("Y-m-d H:i:sa");
	

	
	
	if($patient_id != ""){
		include("config_db2.php");		
		 $cmd1 = "UPDATE lab_details_ip SET sample_req_date='$current_date' where patient_id='$patient_id' and paid_status !=1 AND bill_queue='0'";
		$cmds1=mysql_query($cmd1);
    }
	
	
?>


					<table id="investable" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>No</th>
                        <th>Type </th>
                        <th>Test</th>
                        <th>Reports</th>
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
						
	 $cmd = "select * from lab_details_ip where patient_id='$patient_id' and paid_status!='1' AND bill_queue != '1' AND sample_req_date =''";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['lab_det']; ?></td>
						<td><?php echo $rs['lab_full_det_name']; ?></td>
                       <td><?php echo $rs['reports']; ?></td>
						<td><a href="#" onclick="delete_lab_inves_details('<?php echo $rs['id'];?>','<?php echo $rs['patient_id'];?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>

		