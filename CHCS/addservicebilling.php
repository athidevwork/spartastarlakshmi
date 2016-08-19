  <?php
include("config_db2.php");
	$service = $_REQUEST['service'];
	$patient_name = $_REQUEST['patient_name'];
	$patient_id = $_REQUEST['patient_id'];
	$mrd_no = $_REQUEST['mrd_no'];
	$ref_no = $_REQUEST['ref_no'];
	$serv_explode=explode("@#@#",$service);
		$service_name=$serv_explode[1];
		$types=$serv_explode[2];
		$count=$serv_explode[3];
		$id=$serv_explode[0];
	$created_date=date("Y-m-d");
	$service_no = $_REQUEST['service_no'];
	$total=$service_no*$count;
	$service = mysql_escape_string($service);
	
	if($service != ""){
		
		$cmd = "INSERT INTO services_details (id,ref_no,insert_from,service_id,service_name,duration,count,given_details,total_count,created_date) VALUES (NULL, '$ref_no','CHART','$id','$service_name','$types','$count','$service_no','$total','$created_date')";
		$cmds=mysql_query($cmd);
		$insert_id = mysql_insert_id();
	    $cmd1 = mysql_query("INSERT INTO fees_details (id,patient_id,pat_name,ip_id,description,fees,created_date,insert_from,insert_id) VALUES (NULL, '$patient_id','$patient_name','$mrd_no','$service_name','$total','$created_date','CHART','$insert_id')");
	}
						
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
				 	$cmd = "select * from services_details where ref_no='$ref_no' and insert_from='CHART'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='CHART';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['service_name']; ?></td>
						<td><?php echo $rs['duration']; ?></td>
						<td><?php echo $rs['given_details']; ?></td>
						<td><a href="#" onclick="delete_services2('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>
                        </tbody>
                        </table>
