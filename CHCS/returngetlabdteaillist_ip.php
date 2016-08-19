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
	function get_labtest_normal($lab_id_arg,$lab_sub_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		//Lab sub title query to get fee details using title as table from investiogation
		$sym='';
		if(!empty($lab_sub_id_arg)){
			$lab_query=mysql_query("select normal from $lab_title where id = $lab_sub_id_arg AND status=1 LIMIT 1");
			$lab_query_array=mysql_fetch_array($lab_query);
			$sym=strtolower($lab_query_array['normal']);
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
	
	$cmd_lab_sample_query = mysql_query("select sampletesttitle,sampletestsubtitle,sampleapprover,sampleapproverdesign,datecollect from lab_testsample_ip where labsampleno ='$sampleno' limit 1");
	$cmd_lab_sample_array = mysql_fetch_array($cmd_lab_sample_query);
	$sampletesttitle = $cmd_lab_sample_array['sampletesttitle'];
	$sampletestsubtitle = $cmd_lab_sample_array['sampletestsubtitle']; 
	$sampleapprover = $cmd_lab_sample_array['sampleapprover'];
	$sampleapproverdesign = $cmd_lab_sample_array['sampleapproverdesign']; 
	$datecollect = $cmd_lab_sample_array['datecollect']; 
	
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
                                     <label class="col-md-6 control-label"  >Test Title:</label>  
                                            <div class="col-md-6" >
                                             <input type="text"  class="form-control" name="test_title" id="test_title" value="<?php echo $sampletesttitle ?>" />

                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                     <div class="col-md-6">
                                            <label class="col-md-4 control-label"  >Category:</label>  
                                            <div class="col-md-8"  >
                                <textarea class="form-control" name="test_category" id="test_category" placeholder="Category"  ><?php echo $sampletestsubtitle ?></textarea>
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div>       
                       
										</div>
										<h3>Reports Details</h3>
								
										<div class="col-md-12">
										
										<center>
	<table id="labtest-dataTables" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>#</th>
					    <th>LAB</th>
                        <th>LAB Test</th>
						
                        <th>Report</th>
						<th style="display:none">Notes</th>
						
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
		$lab_test_normal = get_labtest_normal($lab_id,$lab_sub_id);
		$reports = $cmd_lab_details_array['reports'];
		$notes = $cmd_lab_details_array['notes'];
		?>
			<tr>
				<td style="display:none"><?php echo $id; ?></td>
				<td><?php echo $i; ?></td>
				<td><?php echo $test_type; ?></td>
				<td><?php echo $lab_test; ?></td>
				
				<td><div id="report_edit<?php echo $i; ?>"><?php echo $reports; ?></div><div style="display:none" id="report_normal_edit<?php echo $i; ?>"><?php echo $lab_test_normal; ?></div><a href="#labsampletestreportedit_modal" data-toggle="modal" data-normal-id="report_normal_edit<?php echo $i; ?>" data-id="report_edit<?php echo $i; ?>" onclick="edit_lab_report(this);return false;"><span class="pencil glyphicon glyphicon-pencil" style="float:right;"></span></a></td>
				<td  style="display:none"><?php echo $notes; ?></td>
				
			</tr>
	<?php
		
	}
?>
 </tbody>
                                </table></center>
										</div>
                                       
                                        <div class="form-group">
										 <div class="col-md-6" align="left">
                                     <label class="col-md-6 control-label"  >Approver Name:</label>  
                                            <div class="col-md-6" >
                                             <input type="text"  class="form-control" name="test-app-name" id="test-app-name" value="<?php echo $sampleapprover; ?>" />

                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                     <div class="col-md-6">
                                            <label class="col-md-4 control-label"  >Approver Designation:</label>  
                                            <div class="col-md-8"  >
                                <textarea class="form-control" name="test_app-desgn" id="test_app-desgn" placeholder="Designation"  ><?php echo $sampleapproverdesign; ?></textarea>
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div>       
                       
										</div>

                                        <div class="form-group">
                                        										 
										 <div class="col-md-9" align="middle">
                                         								<input type="submit" class="btn btn-info btn-block" style="width:100px;" name="submit" id="submit"  onClick="addlabtest_update();return false;" value="Update"/>

                                    </div>
									<?php if(!empty($datecollect)) {?>
									<div class="col-md-3" align="right">
                                         								<input type="submit" class="btn btn-info btn-block"  name="submit" id="submit"  onClick="labtest_print('<?php echo $sampleno; ?>');return false;" value="Generate Report"/>

                                    </div>
									<?php } ?>
                                    										 
                                    
                       
                            
                            <!-- END JQUERY VALIDATION PLUGIN -->
                          
				
							
							
						
							</div>
							
							</form>