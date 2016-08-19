<?php
session_start();
 date_default_timezone_set('Asia/Kolkata'); 
$role=$_SESSION['role'];
//$pid=$_REQUEST['pid'];
 include("config_db1.php");
 $cmd=mysql_query("select * from settings where role='$role'");
 mysql_close($db1);
$sql=mysql_fetch_array($cmd);

if($sql['registration'] !=1)
{
echo '<script>alert("You could not access this page");</script>';
//header('Location :home.php');
echo '<script>window.location.href="home.php"</script>';
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from aqvatarius.com/themes/atlant/html/pages-edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:47:47 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <!-- META SECTION -->
        <title>DPP- Patient Registration</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" href="css/cropper/cropper.min.css"/>
        <!--  EOF CSS INCLUDE -->        
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->    
		
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            <?php include('navication.php'); ?>
            <!-- END PAGE SIDEBAR -->
            
			
			<div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                  
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" onBlur="dispid()" name="search" id="search" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                    <!-- POWER OFF -->
                    <li class="xn-icon-button pull-right last">
                        <a href="#"><span class="fa fa-power-off"></span></a>
                        <ul class="xn-drop-left animated zoomIn">
                           <!-- <li><a href="pages-lock-screen.html"><span class="fa fa-lock"></span> Lock Screen</a></li>-->
                            <li><a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Sign Out</a></li>
                        </ul>                        
                    </li> 
                    <!-- END POWER OFF -->
                    <!-- MESSAGES -->
                     <li class="xn-icon-button pull-right"> <a href="#"><span class="fa fa-comments"></span></a>
        <div id="new" class="informer informer-danger"></div>
        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
          <div class="panel-heading">
            <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>
            <div  class="pull-right"> <span id="new1" class="label label-danger"></span> </div>
          </div>
          <div id="appmsg" class="panel-body list-group list-group-contacts scroll" style="height: 200px;"> 
		  
		  
		  
		  
		  </div>
          <div class="panel-footer text-center"> <a href="messages.php">Show all messages</a> </div>
        </div>
      </li>
                    <!-- END MESSAGES -->
                    <!-- TASKS -->
					<?php
					include("config_db2.php");
					$quer=mysql_query("Select * from patientdetails where hold!=0");
					$tothold=mysql_num_rows($quer);
					mysql_close($db2);
					?>
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-tasks"></span></a>
                        <div class="informer informer-warning"><?php echo $tothold; ?></div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-tasks"></span> Hold</h3>                                
                                <div class="pull-right">
                                    <span class="label label-warning"><?php echo $tothold;?> holding</span>
                                </div>
                            </div>
                            <div class="panel-body list-group scroll" style="height: 200px;">  
							<?php while($ho=mysql_fetch_array($quer))
							{ 
							$per=$ho['hold'];
							?>                              
                                <a class="list-group-item" href="pausecom.php?pid=<?php echo $ho['patientid']; ?>">
                                    <strong><?php echo $ho['patientname']; ?></strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $per; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $per; ?>%;">50%</div>
                                    </div>
                                    <small class="text-muted">hold By: <?php echo $ho['holdby']; ?>, on <?php echo date('d  M  Y').' /'; echo $per; ?>%</small>
                                </a>
                                  <?php }?>                          
                            </div>     
                            <div class="panel-footer text-center">
                                <a href="pages-tasks.html">Show all tasks</a>
                            </div>                            
                        </div>                        
                    </li>
                    <!-- END TASKS -->
                    <!-- LANG BAR -->
                   
                    <!-- END LANG BAR -->
                </ul>
				 <ul class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li class="active">Registration</li>
    </ul>
                <!-- END X-NAVIGATION VERTICAL -->                    
                
                <!-- START BREADCRUMB -->
              <!--  <ul class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="#">Registration</a></li>
                    
                </ul>-->
                <!-- END BREADCRUMB -->                                                
                
                <!-- PAGE TITLE -->
               
                <!-- END PAGE TITLE -->                     
                
                <!-- PAGE CONTENT WRAPPER -->
			
											
				<div class="page-content-wrap">
                    
                   
                    <div class="registration-container registration-extended">  
					 <!--<div class="page-title">                    
                    <h2><span class="fa fa-users"></span> Patient Registration</h2>
                </div>-->          
            <div class="registration-box animated fadeInDown" style="padding-top: 20px;">
               <!-- <div class="registration-logo"></div>-->
                <div class="registration-body">
                    
                    <div class="row">                        
                        <form action="registerpatient.php" class="form-horizontal" method="post" onSubmit="return valid()"  enctype="multipart/form-data">
						<?php if(isset($_REQUEST['error'])){ ?>
						<div class="alert alert-warning fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>						
						  <?php echo $_REQUEST['error']; ?>
						</div>
						<?php	} ?>
                        <div class="col-md-6">
                            
                            <div class="registration-title"><strong>Registration</strong>, use form below</div>
                            <!--<div class="registration-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In odio mauris, maximus ac sapien sit amet.</div>-->
                            
							<?php date_default_timezone_set('Asia/Kolkata'); ?>
								<input type="hidden" id="datepicker" name="datepicker" value="<?php echo date("m/d/Y");?>" />
								<input type="hidden" id="x" name="x" value="<?php echo $_REQUEST['id']; ?>" />
                                <h4>Official info</h4>
                                <div class="form-group">
                                    <div class="col-md-12">
										<select  class="form-control select" id="branch" name="branch">
										<option value="1">Select Branch Hospital</option>
										<?php
										include("config_db1.php");
										$cmd = "select branch from hospitalbranches WHERE status = 1";
										$res = mysql_query($cmd);
										while($rs = mysql_fetch_array($res)){
										echo '<option>'.$rs['branch'].'</option>';
										}
										mysql_close($db1);
										?>
										</select>
										
                                    </div>
                                </div>
								
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" id="patid" name="patid"  class="form-control" required readonly="readonly" placeholder="UHID"/>
										
                                    </div>
                                </div>
								<h4>Personal Info</h4>
                                <div class="form-group">
                                    <div class="col-md-5">
											<select style="auto" class="select form-control" id="patsat" name="patsat" required>
											<option value="1">Select</option>
											<option>Baby</option>
											<option>Miss.</option>		
											<option>Mr.</option>
											<option>Mrs.</option>
											<option>Master</option>		
											</select></div>
											<div class="col-md-7"> <input type="text" placeholder="Patient Name" class="form-control"  id="patname" name="patname" required/>
                                    </div>
                                </div>

                                                    
                                <div class="form-group">
                                    <div class="col-md-5">
									<select  style="width:auto" class="select form-control" id="gsat" name="gsat" required >
									<option value="1">Select</option>
									<option>Mr.</option>
									<option>Mrs.</option>
									</select> </div>
									<div class="col-md-7">
									<input type="text"  placeholder="Parents/Spouse Name" class="form-control" id="gname" name="gname" required />
                                    </div>
                                </div>                        
                                <div class="form-group">
								<div class="col-md-8">
                                        <input type="text" class="form-control datepicker" id="dob" name="dob" required placeholder="Date of Birth*" onBlur="javascript:calculate_age(this);" />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="age" name="age" required placeholder="Age" readonly />
                                    </div>
                                </div>
									<script>
									function calculate_age(dob_element){
											var today = new Date();
											var	dob = new Date(dob_element.value); 
											var	age = new Date(today - dob).getFullYear() - 1970;
											//alert(age);
											if(isNaN(age) || age=='' || age < 0){
												age=0;
												
											}
											$('#age').val(age);
										}
										
									
									</script>								
                                <div class="form-group">
                                    <div class="col-md-4">
									  <label class="check">
									<input name="gender" type="radio" id="gender" value="Male" required /> 
									Male</label>
									</div>
									 <div class="col-md-4">
									 <label class="check">
									<input name="gender" type="radio" id="gender" value="Female" required /> 
									Female</label>
                                    </div>
									 <div class="col-md-4"></div>
                                </div>             
								
                                <!--<div class="form-group push-up-30">
                                    <div class="col-md-6">
                                        <a href="#" class="btn btn-link btn-block">Already have an account?</a>                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger btn-block">Sign Up</button>
                                    </div>
                                </div>-->
                              
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" onBlur="checkphnone()" class="form-control mask_ssn" id="contactno" name="contactno"  placeholder="Contact Number"/>
                                </div>
                            </div>
							<div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="email" name="email"  placeholder="Email ID"/>
                                </div>
                            </div>                       
                        </div>
						
						
						<div class="col-md-6">
                            
                           <div class="registration-title"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;</div>
                           <h4>Address info</h4>
                            <div class="form-group">
                                <div class="col-md-12">
                                <input type="text" list="dloccupation" id="occupation" name="occupation"  class="form-control" placeholder="Occupation"/>
									<datalist id="dloccupation">
									<option>Employee</option>
									<option>Engineer</option>
									<option>House Wife</option>
									<option>Self-Employed</option>
									<option>Student</option>
									<option>Others</option>
									</datalist>
								</div>
                            </div>
							<div class="form-group">
                                <div class="col-md-12">
                                <textarea class="form-control" name="address" id="address" placeholder="Address"  ></textarea>
									
								</div>
                            </div>
							<div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="reference" name="reference"  placeholder="Consultant"/>
                                </div>
                            </div>
							<div class="form-group">
                                <div class="col-md-12">
                                    <img style="float:right; cursor:pointer; margin-right:30px" src="img/default.png" height="200" width="200" id="img_prev" name="img_prev" />
    <input type="file" class="form-control" id="photo" name="photo" onChange="readURL(this);"/>
                                </div>
                            </div>
							<script>
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#img_prev')

					.attr('src', e.target.result)
					.width(200)
				.height(200);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
	</script>
                            <div class="form-group push-down-30">
                                <div class="col-md-6">
                                   <input type="reset" class="btn btn-danger btn-block" name="clear" id="clear" value="Clear"/></div>
                                <div class="col-md-6">
								<input type="submit" class="btn btn-info btn-block" name="submit" id="submit" value="Save And Next"/>
                                   <!-- <button class="btn btn-info btn-block">Log In</button>-->
                                </div>
                            </div>
                             
                        </div>
						</form>
                    </div>
                </div>
                
               <div class="registration-footer">
                    <!--<div class="pull-left">
                        &copy; 2015 AppName                    </div>
                    <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>                    </div>-->
                </div>
            </div>
        </div>

                </div>
				
                <!-- END PAGE CONTENT WRAPPER -->                                                 
            </div>
            <!-- PAGE CONTENT -->
                        
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <div class="pull-right"> <a href="logout.php" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->
        
        <!-- MODALS -->
        <!--<div class="modal animated fadeIn" id="modal_change_photo" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="smallModalHead">Change photo</h4>
                    </div>                    
                    <form id="cp_crop" method="post" action="crop.php">
                    <div class="modal-body">
                        <div class="text-center" id="cp_target">Use form below to upload file. Only .jpg files.</div>
                        <input type="hidden" name="cp_img_path" id="cp_img_path"/>
                        <input type="hidden" name="ic_x" id="ic_x"/>
                        <input type="hidden" name="ic_y" id="ic_y"/>
                        <input type="hidden" name="ic_w" id="ic_w"/>
                        <input type="hidden" name="ic_h" id="ic_h"/>                        
                    </div>                    
                    </form>
                    <form id="cp_upload" method="post" enctype="multipart/form-data" action="upload.php">
                    <div class="modal-body form-horizontal form-group-separated">
                        <div class="form-group">
                            <label class="col-md-4 control-label">New Photo</label>
                            <div class="col-md-4">
                                <input type="file" class="fileinput btn-info"  name="file" id="cp_photo" data-filename-placement="inside" title="Select file"/>
                            </div>                            
                        </div>                        
                    </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success disabled" id="cp_accept">Accept</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>-->
		
		 <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->          
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
		
	
		
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
        
        <script type="text/javascript" src="js/plugins/jquery/jquery-migrate.min.js"></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->
		<script type="text/javascript" src="js/demo_tables.js"></script>          
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>  
        
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="js/plugins/form/jquery.form.js"></script>
		<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>                
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <script type='text/javascript' src='js/plugins/maskedinput/jquery.maskedinput.min.js'></script>
        <script type="text/javascript" src="js/plugins/cropper/cropper.min.js"></script>
		<script type="text/javascript" src="js/faq.js"></script>
		
		  
            
            <script type='text/javascript' src='js/plugins/noty/themes/default.js'></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>        
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>
		
        
       <!-- <script type="text/javascript" src="js/demo_edit_profile.js"></script>-->
        <!-- END TEMPLATE -->

        
        <!--<div class="modal animated fadeIn" id="modal_change_password" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="smallModalHead">Change password</h4>
                    </div>
                    <div class="modal-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer faucibus, est quis molestie tincidunt</p>
                    </div>
                    <div class="modal-body form-horizontal form-group-separated">                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Old Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="old_password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">New Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="new_password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Repeat New</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="re_password"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Proccess</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>-->        
        <!-- EOF MODALS -->
        
        <!-- BLUEIMP GALLERY -->
         
        <!-- END BLUEIMP GALLERY -->        
        
       </body>
	   
	   <script>
		function checkphnone()
		{
		var phno=$('#contactno').val();
		//alert(phno);
		$.ajax({
				type: "post",
				url: "checkphno.php",
				data: {
					phno: phno,
				},
				success: function(msg) {
				var msg=$.trim(msg);
				if(msg !=0)
				{
				if(confirm('This Number share ' +msg+ ' patient Sure to Continue ?')){
				
				}else{
				$('#contactno').val("");
				}
			}
			}	
			});
		}
		</script>
		
		<script>
		function valid()
		{
		txt = $('#branch').val();
			if(txt==1)
				{
					alert('Select Any Branch');
					return false;
				}
				txt = $('#patid').val();
			if(txt=="")
				{
					alert('Patient ID Should not blank');
					return false;
				}
							txt = $('#patsat').val();
							if(txt==1)
							{
								alert('Select Patient Surname');
								return false;
							}
							txt = $('#patname').val();
							if(txt=="")
							{
								alert('Patient Name Should not blank');
								return false;
							}
					txt = $('#gsat').val();
					if(txt==1)
					{
						alert('Select Parent/Spouse Surname');
						return false;
					}
					txt = $('#gname').val();
					if(txt=="")
					{
						alert('Parent/Spouse Name Should not blank');
						return false;
					}
		
				txt = $('#age').val();
					if(txt=="")
					{
						alert('Age Should not blank');
						return false;
					}
					txt = $('#contactno').val();
					if(txt=="")
					{
						alert('Contact Number Should not blank');
						return false;
					}
					var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
    if (!filter.test(txt)) {
	alert('Invalid Phone Number  !');
        return false;
    }
			txt = $('#occupation').val();
					//if(txt=="")
					//{
						//alert('Occupation Should not blank');
						//return false;
					//}
					//txt = $('#address').val();
					//if(txt=="")
					//{
						//alert('Address Should not blank');
						//return true;
					//}
					return true;
		}
		</script>
		<script>
		$('#branch').on('change', function() {
			txt = $('#branch').val();
			if(txt==1)
			return false;
			$.ajax({
				type: "post",
				url: "generateid.php",
				data: {
					branch: txt,
					date: $('#datepicker').val()
				},
				success: function(value) {
				   $('#patid').val(value);
				}
			});
		});
	</script>
	
	<script>
		$('#patsat').on('change', function(){
			gen = $('#patsat').val();
			if(gen == "Miss." || gen == "Mrs.")
				$('input:radio[name=gender]')[1].checked = true;
			else if(gen == "Mr." || gen == "Master")
				$('input:radio[name=gender]')[0].checked = true;
		});
	</script>
	   </html>