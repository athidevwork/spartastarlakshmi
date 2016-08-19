<?php
include("config_db2.php");
	$depart = $_REQUEST['depart'];
	$consultant = $_REQUEST['consultant'];
	$visit = $_REQUEST['visit'];
	$ref_no = $_REQUEST['ref_no'];
	$created_date=date("Y-m-d");
	if($ref_no != ""){
		$cmd = "INSERT INTO consultant_details (id,ref_no,insert_from,department,consultant,visit,created_date) VALUES (NULL, '$ref_no','CHART ICU','$depart','$consultant','$visit','$created_date')";
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
					$cmd = "select * from consultant_details where ref_no='$ref_no' and insert_from='CHART ICU'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
				
						$insert_from='CHART ICU';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo get_dept_name1($rs['department']); ?></td>
						<td><?php echo get_consult_name1($rs['consultant']); ?></td>
						<td><?php echo get_visit_name1($rs['visit']); ?></td>
						<td><a href="#" onclick="delete_consultant1('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>
