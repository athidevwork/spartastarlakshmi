<?php
	session_start();
	$user = $_SESSION['username'];
	date_default_timezone_set('Asia/Kolkata'); 
include("config_db2.php");
	$service = $_REQUEST['type_name'];
	$patient_name = $_REQUEST['patient_name'];
	$patient_id = $_REQUEST['patient_id'];
	$insert_from = $_REQUEST['insert_from'];
	$req_from = $_REQUEST['req_from'];
	$mrd_no = $_REQUEST['mrd_no'];
	$ref_no = $_REQUEST['ref_no'];
	$serv_explode=explode("@#@#",$service);
		$service_name=$serv_explode[1];
		//$types=$serv_explode[2];
		$count=$serv_explode[2];
		$id=$serv_explode[0];
	$created_date=date('Y-m-d H:i:s');
	$service_no = $_REQUEST['sitting'];
	$total=$service_no*$count;
	$service = mysql_escape_string($service);
	
	if($service != "")
	{
		$cmd = "INSERT INTO sitting_details (id,ref_no,patient_id,insert_from,bill_number,ip_no,service_id,type_name,duration,count,sitting,total_count,paid_status,created_date,added_by) VALUES (NULL, '$ref_no','$patient_id','$insert_from','','$mrd_no','$id','$service_name','','$count','$service_no','$total','0','$created_date','$user')";
		if($req_from =='Billing'){
			$cmd = "INSERT INTO sitting_details (id,ref_no,patient_id,insert_from,bill_number,ip_no,service_id,type_name,duration,count,sitting,total_count,bill_queue,paid_status,created_date,added_by) VALUES (NULL, '$ref_no','$patient_id','$insert_from','','$mrd_no','$id','$service_name','','$count','$service_no','$total','1','0','$created_date','$user')";	
		}
	    //$cmd1 = mysql_query("INSERT INTO fees_details (id,patient_id,pat_name,ip_id,description,fees,created_date) VALUES (NULL, '$patient_id','$patient_name','$mrd_no','$service_name','$total','0','$created_date')");
		$cmds=mysql_query($cmd);
	}
	
						
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