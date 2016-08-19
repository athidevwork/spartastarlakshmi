<?php
	session_start();
	$user = $_SESSION['username'];
	date_default_timezone_set('Asia/Kolkata'); 
include("config_db2.php");
	$procedures = $_REQUEST['procedures'];
	$procedure_no = $_REQUEST['procedure_no'];
	$patient_name = $_REQUEST['patient_name'];
	$patient_id = $_REQUEST['patient_id'];
	$mrd_no = $_REQUEST['mrd_no'];
	$consultant = $_REQUEST['consultant'];
	$fees_amount = $_REQUEST['fees_amount'];
		$ref_no = $_REQUEST['ref_no'];
	$serv_explode=explode("@#@#",$procedures);
		$procedure_name=$serv_explode[1];
		$types=$serv_explode[2];
		$count=$serv_explode[3];
		$id=$serv_explode[0];
	$created_date=date('Y-m-d H:i:s');
	if(empty($_REQUEST['fees_amount']) || $_REQUEST['fees_amount']=='')
	$total=$procedure_no*$count;
	else
	$total = $_REQUEST['fees_amount']*$procedure_no;
	$procedures = mysql_escape_string($procedures);
	
	if($procedures != "")
	{
        $cmd = "INSERT INTO procedure_details (id,ref_no,insert_from,procedure_id,procedure_name,duration,count,given_details,total_count,created_date,consultant,fees_amount,patient_id,ip_no,added_by) VALUES (NULL, '$ref_no','CHART','$id','$procedure_name','$types','$count','$procedure_no','$total','$created_date','$consultant','$fees_amount','$patient_id','$mrd_no','$user')";
		$cmds=mysql_query($cmd);
		$insert_id = mysql_insert_id();
	    //$cmd1 = mysql_query("INSERT INTO fees_details (id,patient_id,pat_name,ip_id,description,fees,created_date,insert_from,insert_id) VALUES (NULL, '$patient_id','$patient_name','$mrd_no','$service_name','$total','$created_date','CHART','$insert_id')");
    }
						
?>


					<table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Procedure</th>
                        <th>Duration</th>
                        <th>Timing</th>
                       <th>Consultant</th>
                        <th>Amount</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					$cmd = "select * from procedure_details where insert_from='CHART' and paid_status !=1 AND bill_queue='0' AND patient_id='$patient_id'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='CHART';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['procedure_name']; ?></td>
						<td><?php echo $rs['duration']; ?></td>
						<td><?php echo $rs['given_details']; ?></td>
                          <td><?php echo $rs['consultant']; ?></td>
                        <td><?php echo $rs['total_count']; ?></td>	
						<td><a href="#" onclick="delete_procedures2('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>
