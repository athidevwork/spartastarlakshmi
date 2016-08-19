 <?php
 date_default_timezone_set('Asia/Kolkata');
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
	include("config_db2.php");
	$sampleno=$_REQUEST['sampleno'];
	if($_REQUEST['action'] =='update'){
		$test_title = $_REQUEST['test_title'];
		$test_category = $_REQUEST['test_category'];
		$test_app_name = $_REQUEST['test_app_name'];
		$test_app_desgn = $_REQUEST['test_app_desgn'];
		$asset = $_REQUEST['asset'];
		$sample_test_query=mysql_query("UPDATE lab_testsample_ip SET sampletesttitle='$test_title',sampletestsubtitle='$test_category',sampleapprover='$test_app_name',sampleapproverdesign='$test_app_desgn' WHERE labsampleno='$sampleno'");
		foreach($asset as $key=>$value){
		
		$id = $value[0];
		$reports = $value[4];
		$notes = $value[5];
		$sample_test_query=mysql_query("UPDATE lab_details_ip SET reports='$reports',notes='$notes' WHERE id='$id'");
				
	}
		
	}
	
	$cmd_lab_sample_query = mysql_query("select sampletesttitle,sampletestsubtitle,sampleapprover,sampleapproverdesign,datecollect,test_external from lab_testsample_ip where labsampleno ='$sampleno' limit 1");
	$cmd_lab_sample_array = mysql_fetch_array($cmd_lab_sample_query);
	$sampletesttitle = $cmd_lab_sample_array['sampletesttitle'];
	$sampletestsubtitle = $cmd_lab_sample_array['sampletestsubtitle']; 
	$sampleapprover = $cmd_lab_sample_array['sampleapprover'];
	$sampleapproverdesign = $cmd_lab_sample_array['sampleapproverdesign']; 
	$datecollect = $cmd_lab_sample_array['datecollect']; 
	$test_external = $cmd_lab_sample_array['test_external']; 
	if($test_external == 'yes')
		$checked = 'checked';
	else
		$checked = '';
	
	$cmd_lab_details_query = mysql_query("select * from lab_details_ip where labsampleno ='$sampleno'");
	?>
	<form id="jvalidate" role="form" class="form-horizontal">
                            
                                    <h5 >&nbsp;&nbsp;&nbsp;</h5>
									 <div class="form-group">
									 <div class="col-md-6" align="center">
                                     <label class="col-md-6 control-label"  >Lab Sample No:</label>  
                                            <div class="col-md-6" >
                                             <input type="text"  class="form-control" name="test_sample_no" id="test_sample_no" readonly value="<?php echo $sampleno; ?>" />

                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
									 </div>
									      <div class="form-group">
										  
										 <div class="col-md-6" align="left">
                                     <label class="col-md-6 control-label"  >Test Title:&nbsp;&nbsp;&nbsp;&nbsp;    <?php echo $sampletesttitle ?></label>  
                                                                                    
												   </div>
											   
                                   
                                                     <div class="col-md-6">
                                            <label class="col-md-6 control-label"  >Category:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sampletestsubtitle ?></label>  
                                                                                   
												   </div>       
                       
										</div>
										<h3>Tests Details</h3>
								
										<div class="col-md-12">
										
										<center>
	<table id="labtest-dataTables" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>#</th>
					    <th>LAB</th>
                        <th>LAB Test</th>
						
                        <th>Report</th>
						<th>Notes</th>
						
                        </tr>
                        </thead>
                        <tbody>
						<?php
						$i=0;
	while($cmd_lab_details_array = mysql_fetch_array($cmd_lab_details_query)){
		$i++;
		$id=$cmd_lab_details_array['id'];
		$bill_number=$cmd_lab_details_array['bill_number'];
		$lab_id = $cmd_lab_details_array['lab_id'];
		$lab_sub_id = $cmd_lab_details_array['lab_sub_id'];
		$test_type = get_labtype($lab_id);
		$lab_test = get_labtest($lab_id,$lab_sub_id);
		$reports = $cmd_lab_details_array['reports'];
		$notes = $cmd_lab_details_array['notes'];
		?>
			<tr>
				<td style="display:none"><?php echo $id; ?></td>
				<td><?php echo $i; ?></td>
				<td><?php echo $test_type; ?></td>
				<td><?php echo $lab_test; ?></td>
				
				<td><?php echo $reports; ?></td>
				<td><?php echo $notes; ?></td>
				
			</tr>
	<?php
		
	}
?>
 </tbody>
                                </table></center>
										</div>
                                       
                                        <div class="form-group">
										 <div class="col-md-4" align="left">
                                     <label class="col-md-6 control-label"  >Approver Name:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sampleapprover; ?></label>  
                                            
												   </div>
											   
                                   
                                                     <div class="col-md-8">
                                            <label class="col-md-8 control-label"  >Approver Designation:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sampleapproverdesign; ?></label>  
                                            
												   </div>   
																
                       
										</div>
										<div class="form-group">
										<div class="col-md-9">
										 Sent To External Lab
                                         			<input name="lab_detail_tbl_colsample_id" onclick="checksampleexternal(this)" id="lab_detail_tbl_colsample_id" value="<?php echo $sampleno ?>" type="checkbox" <?php echo $checked ?>>					
											</div>
											<div class="col-md-3" align="right">
													<a class="btn btn-info btn-block" href="lab_ip_report_view.php?sampleno=<?php echo $sampleno ?>" target="_blank">View Tests</a>
                                         								

											</div>
																					
										</div>																
                                       
							
							</form>
							
							