<?php
 date_default_timezone_set('Asia/Kolkata'); 
include("config_db2.php");
$id=$_REQUEST['y'];
$date=$_REQUEST['x'];


	$cmd = mysql_query("select * from investigationreport where cast(datetime as date)='$date' and patientid='$id'");
	//$rs = mysql_fetch_array($cmd);
	//echo "select * from investigationreport where cast(datetime as date)='$date' and patientid='$id'";
	echo'
	
	<table id="invesupdate" class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th style="display:none">id</th>
													
													<th>Test</th>
                                                    <th>Report</th>
                                                    <th>Notes</th>
													<th>Action</th>
                                                  
													
                                                </tr>
                                            </thead>
                                            <tbody>';
											$i=1;
											while($rs = mysql_fetch_array($cmd)) {
											echo '  
											
											<tr>
											<td>'.$i++.'</td>
											<td style="display:none">'.$rs['id'].'</td>
											<td>'.$rs['test'].'</td>
											<td contenteditable="true">'.$rs['complaint'].'</td>
											<td contenteditable="true">'.$rs['notes'].'</td>
											<td><a href="#" class="remove" onClick="javascript:delinves($(this))" alt="'.$rs['id'].'"><span class="fa fa-times"></span></a></td>
											</tr>'; }
											echo '</tbody>
											</table>';
		
	
	//echo $rs['diag_report'].'+'.$rs['blood_report'].'+'.$rs['radio_report'].'+'.$rs['psychological'].'+'.$rs['psychometric'].'+'.$rs['other_report'];
	?>