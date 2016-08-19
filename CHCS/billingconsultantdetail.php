<?php
include("config_db2.php");
	date_default_timezone_set('Asia/Kolkata');
	function get_ipid($univ_num)
   {
		include("config_db2.php");
		$lab_id = strtolower($lab_id);
		
	$ex=mysql_query("select inv_pat_id from inv_patient where patientid = '$univ_num' AND pat_ip_status=0");
	$ex1=mysql_fetch_array($ex);
	$inv_pat_id=$ex1['inv_pat_id'];
	return $inv_pat_id;
	}
	$pid = $_REQUEST['pid'];
	$pat_ip_id = get_ipid($_REQUEST['pid']);
	
	$action = $_REQUEST['action'];
	if($action == "delete"){
		$delete_id = $_REQUEST['delete_id'];
		$cmd = "delete from consultant_details where id='$delete_id'";
	}
	if($action == "add"){
		$depart = $_REQUEST['depart'];
		$consultant = $_REQUEST['consultant'];
		$visit = $_REQUEST['visit'];
		$ref_no = $_REQUEST['ref_no'];
		$created_date=date("Y-m-d");
		$intime = date('Y-m-d H:i:s');
	$fee = get_visit_fee($visit);
		$cmd = "INSERT INTO consultant_details (id,ref_no,insert_from,department,consultant,visit,created_date,fee,patient_id,ip_no,intime,bill_queue) VALUES (NULL, '$ref_no','Billing','$depart','$consultant','$visit','$created_date','$fee','$pid','$pat_ip_id','$intime','1')";
	}
	include("config_db2.php");
	$cmds=mysql_query($cmd);
						
?>
<?php 
function get_dept_name1($id)
{include("config_db1.php");
					$cmd_ser1 = "select * from department_creation where id='$id'";
					$res_ser1 = mysql_query($cmd_ser1);
					while($rs_ser1 = mysql_fetch_array($res_ser1))
					{
								$name=$rs_ser1['department_names'];
                     }
                                return $name;

}
function get_consult_name1($id)
{include("config_db1.php");
					$cmd_ser2 = "select * from doctor_creation where id='$id'";
					$res_ser2 = mysql_query($cmd_ser2);
					while($rs_ser2 = mysql_fetch_array($res_ser2)){
								$name=$rs_ser2['doctor_name'];
                                }
                                return $name;
}
function get_visit_name1($id)
{include("config_db1.php");
					$cmd_ser3 = "select * from visit_creation where id='$id'";
					$res_ser3 = mysql_query($cmd_ser3);
					while($rs_ser3 = mysql_fetch_array($res_ser3)){
								$name=$rs_ser3['visit_name'];
                                $vtypes=$rs_ser3['vtypes'];
                                }
                                return $name."/".$vtypes;

}
function get_visit_fee($id){
	include("config_db1.php");
					 $cmd_ser3 = "select * from visit_creation where id=$id";
					$res_ser3 = mysql_query($cmd_ser3);
					while($rs_ser3 = mysql_fetch_array($res_ser3)){
								$vamount=$rs_ser3['vamount'];
                                
                                }
                                return $vamount;

}


?>

					<table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Department</th>
                        <th>Consultant</th>
                        <th>Visit</th>
						<th>Fee</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
						 include("config_db2.php");
					 $cmd = "select * from consultant_details where paid_status !=1 AND patient_id='$pid' AND bill_queue='1' AND ip_no='$pat_ip_id'";
					
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
				
						$insert_from='CHART';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo get_dept_name1($rs['department']); ?></td>
						<td><?php echo get_consult_name1($rs['consultant']); ?></td>
						<td><?php echo get_visit_name1($rs['visit']); ?></td>
						<td><?php echo $rs['fee']; ?></td>
						<td><a href="#" onclick="delete_consultants2('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>
