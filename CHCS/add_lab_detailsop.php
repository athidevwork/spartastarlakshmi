<?php
session_start();
include("config_db2.php");
date_default_timezone_set('Asia/Kolkata');
$name = $_SESSION['username'];
	function get_labfee($lab_id_arg,$lab_sub_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		//Lab sub title query to get fee details using title as table from investiogation
		$rate=0;
		if(!empty($lab_sub_id_arg)){
		$lab_query=mysql_query("select rate from $lab_title where id = $lab_sub_id_arg AND status=1 LIMIT 1");
		$lab_query_array=mysql_fetch_array($lab_query);
		$rate=strtolower($lab_query_array['rate']);
		}
		
		return $rate;
	}
	function get_labtype($lab_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		return $lab_title;
	}
	function get_labtest($lab_id_arg,$lab_sub_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		//Lab sub title query to get fee details using title as table from investiogation
		$sym='';
		if(!empty($lab_sub_id_arg)){
		$lab_query=mysql_query("select sym from $lab_title where id = $lab_sub_id_arg AND status=1 LIMIT 1");
		$lab_query_array=mysql_fetch_array($lab_query);
		$sym=strtolower($lab_query_array['sym']);
		}
		return $sym;
	}
	function generate_labsampleno(){
			include("config_db2.php");
		$sample_id_query=mysql_query("select id from lab_testsample_ip order by id DESC LIMIT 1");
		$sample_id_query=mysql_fetch_array($sample_id_query);
		$sample_id=$sample_id_query['id'];
		$sample_id = 'LAB'.str_pad($sample_id+1, 9, '0', STR_PAD_LEFT);	
		return $sample_id;
	}

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
	function get_ipid($univ_num)
   {
		include("config_db2.php");
		$lab_id = strtolower($lab_id);
		
	$ex=mysql_query("select inv_pat_id from inv_patient where patientid = '$univ_num' AND pat_ip_status=0");
	$ex1=mysql_fetch_array($ex);
	$inv_pat_id=$ex1['inv_pat_id'];
	return $inv_pat_id;
	}
	
	
	$patient_id = $_REQUEST['patient_id'];
	$ip_id = get_ipid($patient_id);
    //$fees = get_lab_det_fee($lab_id,$lab_full_det);
	
	if($patient_id != "" && $_REQUEST['action'] =='add')
	{
		$lab_id = $_REQUEST['lab_det'];
		$lab_det = $_REQUEST['lab_full_det'];
	//$lab_full_det = $_REQUEST['lab_full_det'];
	//$get_lab_names=get_lab_det2($lab_id,$lab_full_det);
	$created_date=date('d-m-Y H:i:s');
	$fees = $_REQUEST['fees'];
	if(empty($fees))
		$fees=0;
	//$fees = get_labfee($lab_id,$lab_det);
	$sampletitle = get_labtype($lab_id);
	$samplesubtitle =get_labtest($lab_id,$lab_det);
	$labsampleno =  generate_labsampleno();
		include("config_db2.php");
			 $query = "INSERT INTO lab_details_ip (id,patient_id,lab_id,lab_sub_id,fees,reports,notes,createdby,created_date,labsampleno) VALUES (NULL,'$patient_id','$lab_id','$lab_det','$fees','','','','$created_date','$labsampleno')";
			mysql_query($query);
			$lab_sample_query = mysql_query("INSERT INTO `lab_testsample_ip` (`id`, `patient_id`, `ip_id`, `bill_number`, `labsampleno`, `sampletesttitle`, `sampletestsubtitle`, `sampleapprover`, `sampleapproverdesign`, `datereq`, `datecollect`, `datereportgen`, `paid_status`, `bill_queue`, `testtotalamt`, `createby`, `createon`, `updatedon`) VALUES (NULL, '$patient_id', '$ip_id', '', '$labsampleno', '$sampletitle', '$samplesubtitle', '', '', CURRENT_TIMESTAMP, NULL, NULL, '0', '1', '$fees', '$name', '$created_date', CURRENT_TIMESTAMP)");
    }
	if($patient_id != "" && $_REQUEST['action'] =='delete')
	{
		$id = $_REQUEST['id'];
		$labsampleno =  $_REQUEST['sample_no'];
		include("config_db2.php");
			 $query = "DELETE FROM lab_details_ip WHERE labsampleno ='$labsampleno'";
			mysql_query($query);
			$lab_sample_query = mysql_query("DELETE FROM `lab_testsample_ip` WHERE `id`= $id");
    }
	
	
?>


					<table id="fees_id" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>SAMPLE NO </th>
                        <th>Test Title</th>
                        <th>Fees</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
						 include("config_db2.php");
						 //echo "select id,patient_id,ip_id,labsampleno,testtotalamt,sampletesttitle,datecollect from lab_testsample_ip WHERE patient_id='$patient_id' AND ip_id='$ip_id' AND paid_status !=1 AND bill_queue ='1' order by id desc";
					$cmd_lab_sample_query = mysql_query("select id,patient_id,ip_id,labsampleno,testtotalamt,sampletesttitle,sampletestsubtitle,datecollect from lab_testsample_ip WHERE patient_id='$patient_id' AND ip_id='' AND paid_status !=1 AND bill_queue ='1' order by id desc");		
	
					$i=1;
					
					while($rs = mysql_fetch_array($cmd_lab_sample_query)){
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['labsampleno']; ?></td>
						<td><?php echo $rs['sampletesttitle'].'/'.$rs['sampletestsubtitle']; ?></td>
                       <td><?php echo $rs['testtotalamt']; ?></td>
						<td><a href="#" onclick="delete_iplabpatient_details('<?php echo $rs['id'];?>','<?php echo $rs['labsampleno'];?>','<?php echo $patient_id;?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>
