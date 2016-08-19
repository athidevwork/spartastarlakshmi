<?php 
					include("config_db2.php");
					$id=$_REQUEST['id'];
					
					$cmd = "select sum(fees) as fees from fees_detailsip where patient_id='$id' and paid_status!='1'";
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
					$total_amt+=$rs['fees'];}
					
					
					$cmd = "select sum(total_count) as total_count from services_details where patient_id='$id' and paid_status!='1' AND bill_queue='1'";
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
					$total_amt2+=$rs['total_count'];}
					
					$cmd = "select sum(total_count) as fees_amount from procedure_details where patient_id='$id' and paid_status!='1' AND bill_queue='1'";
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
					$total_amt3+=$rs['fees_amount'];}
					
					
					
					
					
					$sql1 = "SELECT * FROM inv_patient WHERE patientid='$id' AND pat_ip_status = 0";
					$result = mysql_query($sql1);
					$inv_pat_id ='';
					if(mysql_num_rows($result) != 0){
						$rs = mysql_fetch_array($result);
						$inv_pat_id = $rs['inv_pat_id'];
					}
					$cmd1 = "select sum(testtotalamt) as feesnew from lab_testsample_ip where patient_id='$id' and paid_status!='1' and bill_queue='1'";
					$res1 = mysql_query($cmd1);
					while($rs1 = mysql_fetch_array($res1)){
					$total_amt1+=$rs1['feesnew'];}
					$cmd1 = "select sum(fees_amount) as feesnew from room_bill_details where ip_no='$inv_pat_id' and paid_status!='1' AND vacate ='yes'";
					$res1 = mysql_query($cmd1);
					while($rs1 = mysql_fetch_array($res1)){
					$total_amt5+=$rs1['feesnew'];}
					
					$cmd1 = "select sum(total_count) as feesnew from sitting_details where ip_no='$inv_pat_id' and paid_status!='1' AND bill_queue='1'";
					$res1 = mysql_query($cmd1);
					while($rs1 = mysql_fetch_array($res1)){
					$total_amt5+=$rs1['feesnew'];}
					
					$cmd1 = "select sum(fee) as feesnew from consultant_details where ip_no='$inv_pat_id' and paid_status!='1' AND bill_queue='1'";
					$res1 = mysql_query($cmd1);
					while($rs1 = mysql_fetch_array($res1)){
					$total_amt5+=$rs1['feesnew'];}
					
					//echo "select  bal_amt from billing as a where a.patientid='$id' AND ip_id='$inv_pat_id' AND balance='1' order by id DESC limit 1";
					$cmd=mysql_query("select  bal_amt from billing as a where a.patientid='$id' AND ip_id='$inv_pat_id' AND balance='1' order by id DESC limit 1");
					$old_bal =0;
					while($rs1 = mysql_fetch_array($cmd)){
						$old_bal+=$rs1['bal_amt'];
					}
					$cmd = "select advance_amt from ip_patientadv where patientid='$id' and paid_status='1' and active=1";
					$res = mysql_query($cmd);
					$adv_amt=0;
					while($rs = mysql_fetch_array($res)){
					$adv_amt+=$rs['advance_amt'];
					}
					//echo $total_amt1;
					$totz=(($total_amt+$total_amt1+$total_amt2+$total_amt3+$total_amt5));
					$totz = $totz + $old_bal;
					if($totz <= $adv_amt){
						$pay =0;
						$pay_readonly='readonly';
						$remain_pay_bal=0;
						$remain_adv_amt=$adv_amt-$totz;
					}
					if($adv_amt < $totz){
						$pay =$totz-$adv_amt;
						$pay_readonly='';
						$remain_pay_bal=0;
						$remain_adv_amt=0;
					}	
						?>
						<div class="col-md-4">
                                            <label class="col-md-5 control-label">Amount in Advance:</label>  
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="total_adv_amt" id="total_adv_amt" value="<?php echo sprintf('%0.2f', $adv_amt); ?>" readonly />
                                                
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
										</div> 
										<div class="col-md-4">
                                            <label class="col-md-5 control-label">Old Balance:</label>  
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="old" id="old" value="<?php echo sprintf('%0.2f', $old_bal); ?>" readonly />
                                                
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
										</div> 
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Total:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="<?php echo sprintf('%0.2f', $totz); ?>" style=" font-weight:bold" readonly  name="total" id="total"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div> </div>
												   
												   <div class="col-md-4">
                                            <label class="col-md-3 control-label">Pay:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  onBlur="cal()" name="pay" id="pay" value="<?php echo sprintf('%0.2f', $pay); ?>" <?php echo $pay_readonly; ?>/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div>  
												   
												   
												   <div class="col-md-4">
                                            <label class="col-md-5 control-label">Remaining Balance:</label>  
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="bal" id="bal" value="<?php echo sprintf('%0.2f', $remain_pay_bal); ?>" readonly />
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div> 
												    <div class="col-md-4">
                                            <label class="col-md-5 control-label">Remaining Advance:</label>  
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="adv_remain" id="adv_remain" value="<?php echo sprintf('%0.2f', $remain_adv_amt); ?>" readonly />
												<span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div>
												   <div class="col-md-3">
                                            <label class="col-md-7 control-label">Return Advance:</label>  
                                            <div class="col-md-4">
											<input id="return_adv" name="return_adv" style="height:25px; width:20px;" type="checkbox">                                                
											
												</div>                                        
												   </div>
