<?php
		include("config_db2.php");
	$ref_no = $_REQUEST['ref_no'];
	$delete_id = $_REQUEST['delete_id'];
	$chart_ot = $_REQUEST['chart_ot'];
	$pid = $_REQUEST['pid'];
	$pat_ip_id = $_REQUEST['pat_ip_id'];
	if($ref_no != ""){

		$cmd = "delete from consultant_details where id='$delete_id' and insert_from='$chart_ot'";
	}
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


?>
					<table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Department</th>
                        <th>Consultant</th>
                        <th>Visit</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					$cmd = "select * from consultant_details where insert_from='CHART' and patient_id='$pid' AND ip_no='$pat_ip_id' AND paid_status !=1 AND bill_queue='0'";
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
						<td><a href="#" onclick="delete_consultants2('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>
