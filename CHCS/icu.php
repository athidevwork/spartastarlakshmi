<?php
session_start();
$role=$_SESSION['role'];
date_default_timezone_set('Asia/Kolkata'); 
include("config_db1.php");
 $cmd=mysql_query("select * from settings where role='$role'");
 mysql_close($db1);
 
$sql=mysql_fetch_array($cmd);
$print_bill=$sql['print_bill'];
$lab=$sql['lab'];
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from aqvatarius.com/themes/atlant/html/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:48:25 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <!-- META SECTION -->
        <title>DPP-Activity Chart For ICU</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
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
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="ser" id="ser"  onBlur="get()" placeholder="Search Patient for Activity Chart For ICU..."/>
							<input type="hidden" id="print_bill" value="<?php echo $print_bill; ?>">
							<input type="hidden" id="lab" value="<?php echo $lab; ?>">
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                    <!-- POWER OFF -->
                    <li class="xn-icon-button pull-right last">
                        <a href="#"><span class="fa fa-power-off"></span></a>
                        <ul class="xn-drop-left animated zoomIn">
                            <!--<li><a href="pages-lock-screen.html"><span class="fa fa-lock"></span> Lock Screen</a></li>-->
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
		$sqlx = mysql_query("SELECT * FROM patientdetails WHERE hold = 10");
		$cnt = mysql_num_rows($sqlx);
	  ?>
      <li class="xn-icon-button pull-right"> <a href="#"><span class="fa fa-tasks"></span></a>
        <div class="informer informer-warning"><?php echo $cnt ?></div>
        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
          <div class="panel-heading">
            <h3 class="panel-title"><span class="fa fa-tasks"></span> Tasks</h3>
            <div class="pull-right"> <span class="label label-warning"><?php echo $cnt ?> active</span> </div>
          </div>
          <div class="panel-body list-group scroll" style="height: 200px;">
		   <?php
		   		while($rsx = mysql_fetch_array($sqlx)){
					echo '<a class="list-group-item" href="pausecom.php?pid='.$rsx['patientid'].'"> <strong>'.$rsx['patientsalutation'].' '.$rsx['patientname'].'</strong><br />
						<div class="progress progress-small progress-striped active">
						<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">50%</div>
						</div><small class="text">'.$rsx['contactno'].', '.$rsx['address'].'</small> </a>';
				}
			?>
			</div>
          <!--<div class="panel-footer text-center"> <a href="#">Show all tasks</a> </div>-->
        </div>
      </li>
                    <!-- END TASKS -->
                    <!-- LANG BAR -->
                    <!--<li class="xn-icon-button pull-right">
                        <a href="#"><span class="flag flag-gb"></span></a>
                        <ul class="xn-drop-left xn-drop-white animated zoomIn">
                            <li><a href="#"><span class="flag flag-gb"></span> English</a></li>
                            <li><a href="#"><span class="flag flag-de"></span> Deutsch</a></li>
                            <li><a href="#"><span class="flag flag-cn"></span> Chinese</a></li>
                        </ul>                        
                    </li> -->
                    <!-- END LANG BAR -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                    
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Activity Chart For ICU </a></li>
                    
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span>  Activity Chart For ICU</h2>
					
					<div class="pull-right">                            
                           <!--<a href="#" onClick="addreq()" class="btn btn-danger"><span class="fa fa-book"></span> Add Requisition </a>-->
						   </div>
						 
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">                
                
                    <div class="row">
                        
                        <div class="col-md-12"> 
						 <div class="panel panel-default">   
						  <div class="panel-body">                    
						
                            <!-- START JQUERY VALIDATION PLUGIN -->
                           <?php  date_default_timezone_set('Asia/Kolkata'); ?>
                                    <form id="jvalidate" role="form" class="form-horizontal">
                                    <div class="panel-body">                                    
                                        <div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-2 control-label">Room:</label>  
                                            <div class="col-md-9">
                                                <input type="text"  style="font-weight:bold; width:200px;" readonly class="form-control" name="room_no" id="room_no"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                     <div class="col-md-4">
                                            <label class="col-md-2 control-label">Name:</label>  
                                            <div class="col-md-9">
                                                <input type="text" style="font-weight:bold; width:200px;" readonly class="form-control" name="name" id="name"/>
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div>  
                                                   
                                                   
                                                    <div class="col-md-4">
                                            <label class="col-md-2 control-label">Age:</label>  
                                            <div class="col-md-9">
                                                <input type="text" style="font-weight:bold; width:200px;" readonly class="form-control" name="gender" id="gender"/>
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div>  
                                                        
                       
										 <div class="col-md-4">
                                            <label class="col-md-2 control-label">DOA:</label>  
                                            <div class="col-md-9">
                                                <input type="text" style="font-weight:bold; width:200px;" readonly class="form-control" value="<?php echo date("d/m/Y"); ?>" name="date"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
                                                   
                                                    <div class="col-md-4">
                                            <label class="col-md-2 control-label">Cons:</label>  
                                            <div class="col-md-9">
                                                <input type="text" style="font-weight:bold; width:200px;" readonly class="form-control" name="cons" id="cons"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
										</div>	   
										<div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-2 control-label">Date:</label>  
                                            <div class="col-md-9">
                                                <input type="text" style="font-weight:bold; width:200px;"  class="form-control" value="<?php echo date("d/m/Y"); ?>" name="date"/>
                                              <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   <div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-2 control-label">Service:</label>  
                                            <div class="col-md-9">
                                                <input type="text" style="font-weight:bold; width:200px;"  class="form-control" name="service" id="service"/>
                                              <span class="help-block"></span> 
												</div>
                                                <div class="col-md-1">
                                           <a href="#"  onClick="add();" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-plus"></span></a>                                   
												   </div>                                         
												   </div>
                                                   
                                                   <div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Procedure:</label>  
                                            <div class="col-md-9">
                                                <input type="text" style="font-weight:bold; width:200px;"  class="form-control" name="procedure" id="procedure"/>
                                              <span class="help-block"></span> 
												</div> 
                                                <div class="col-md-1">
                                           <a href="#"  onClick="add();" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-plus"></span></a>                                   
												   </div>                                        
												   </div>
                                                     
										<div class="col-md-12">
										
										<center>
										<table id="dataTables-example" class="table table-striped table-bordered table-hover">
										<thead>
										<tr>
										<th>#</th>
										<th>Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th>Fees&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th>Action</th>
										<th style="display:none">Send</th>
										</tr>
										</thead>
										<tbody id="billing" name="billing">
										
										  </tbody>
                                </table>
								</center>
										</div>
										<div id="tbl" style="display:none">
										<div class="col-md-8">
										
										
										<center>
										<table id="oldtable" class="table table-striped table-bordered table-hover">
										<thead>
										<tr>
										<th>#</th>
										<th>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th>Fees&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th>Pay&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>
										</thead>
										<tbody>
										
										  </tbody>
                                </table>
								</center>
										</div>
										</div>
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Total:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value='0' readonly  name="total" id="total"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div>  
												    
												    <div class="col-md-4">
                                            <label class="col-md-3 control-label">Pay:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  onBlur="cal()" name="pay" id="pay"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div>  
												   
												   
												   <div class="col-md-4">
                                            <label class="col-md-3 control-label">Balance:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="0" name="bal" id="bal"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div> 
												   
												     <div class="col-md-4">
                                            <label class="col-md-3 control-label">Old Balance:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="0" name="old" id="old"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div> 
												    
												     
												     
                       
                                                                                                                            
                                        <div class="btn-group pull-right">
                                         <!--   <button class="btn btn-primary" type="button" onClick="print_bill()">Print</button>-->
                                            <a href="#" class="btn btn-primary" onClick="save()" >Pay</a>
                                        </div>                                                                                                                          
                                    </div>                                               
                                    </form>
                       
                            
                            <!-- END JQUERY VALIDATION PLUGIN -->
                          
				
							
							
						
							</div>
							</div>
                            <!-- END JQUERY VALIDATION PLUGIN -->
                            </div>
							</div>
							
							
							
                        </div>
                    </div>

                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        
        <!-- MESSAGE BOX-->
		<div class="message-box message-box-success animated fadeIn" id="message-box-success">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-check"></span> Success</div>
                    <div class="mb-content">
                        <div id="appendmsg">
						</div>
                    </div>
                    <div class="mb-footer">
                        <a href="Activity Chart For ICU.php" class="btn btn-default btn-lg pull-right" >Close</a>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="message-box message-box-danger animated fadeIn" id="message-box-error">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Error</div>
                    <div class="mb-content">
                        <div id="appenderror">
						</div>
                    </div>
                    <div class="mb-footer">
                        <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="message-box message-box-info animated fadeIn" id="message-box-info">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-info"></span> Info</div>
                    <div class="mb-content">
					<div id="appendinfo">
						</div>
                       
                    </div>
                    <div class="mb-footer">
						<div class="pull-right">
                        <button class="btn btn-default btn-lg" onClick="removebtn()">Close</button>
						</div>
                    </div>
                </div>
			</div>
		</div>
		
		
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
                            <a href="logout.php" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                 
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
        <!-- END PLUGINS -->
        
        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>        
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-select.js'></script>        

        <script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type='text/javascript' src='js/plugins/validationengine/jquery.validationEngine.js'></script>        

        <script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>                

        <script type='text/javascript' src='js/plugins/maskedinput/jquery.maskedinput.min.js'></script>
        <!-- END THIS PAGE PLUGINS -->               

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>
        
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/actions.js"></script>
        <!-- END TEMPLATE -->
        
        <script type="text/javascript">
		function removebtn() {
	$('#message-box-info').toggle();
	}
		function addreq()
		{
		
		var id= $('#id').val();
		//alert(id);
		$.ajax({
		type: "POST",
		url: "add_req.php",
		data: { 
		id:id,
		},
		success: function(msg) {
		//alert(msg);
		msg=$.trim(msg);
		if(msg !='no') {
		$("#dataTables-example > tbody").append(msg);
		
			var i=1;
			var sum=0;
			$( "#dataTables-example tbody tr" ).each( function(){
		 $(this).find("td").eq(0).text(i++);
  			var s=$(this).find("td").eq(2).text();
			// s=parseInt(s);
			// alert(s);
			sum += Number(s);
			//alert(sum);
		});
			//alert(sum);
			$("#total").val(sum);
			cal();
			}
			else
			return false;
		}
		
	});
		
		
		}
		
		
		
		
		
		
		function save()
		{
		//alert('');
		var pay = $('#pay').val();
		var total = $('#total').val();
		var name = $('#name').val();
		var id= $('#id').val();
		var bal = $('#bal').val();
	
		//alert(bill);
		//return false;

		if(pay=="")
		return false;
		if(name=="")
		return false;
		if(id=="")
		return false;
		
	
		table = $("#dataTables-example");
    var asset = [];
    table.find('tbody > tr').each(function (rowIndex, r) {
        var cols = [];
        $(this).find('td').each(function (colIndex, c) {
            cols.push(c.textContent);
        });
        asset.push(cols);
    }); 
	//alert('');
		$.ajax({
		type: "POST",
		url: "save_bill.php",
		data: { assets: asset,
		pay:pay,
		total:total,
		id:id,
		bal:bal,
		},
		success: function(msg) {
		var msg=$.trim(msg);
		var x=msg.split("~");
			var bill= $('#print_bill').val();
		//alert(msg);
		
		//alert(bill);
		if(x[0]=='Success')
		{
		if(bill==1) {
		var win=window.open("printbill.php?billnumber="+x[1]);
		}	
		//alert(bill);
		//return false;
		$('#message-box-success').modal('toggle');
		$("#appendmsg").empty();
	msg='<p><span class="fa fa-check">Activity Chart For ICU  Sucessfully Added</span></p>';
	$("#appendmsg").append(msg);
	
	//$('#message-box-update').toggle();
	}
	
	else
		{
	$("#appenderror").empty();
	msg='<p><span class="fa fa-check">Error Occured During Activity Chart For ICU Try again !</span></p>';
	$("#appenderror").append(msg);
	$('#message-box-error').toggle();
	
	}
		
		//window.location.reload();
		//window.location.href=window.location.href;
	}	
		
	});
	}
		
		
		function delItem(x){	
		$("#total").val("");
	var row = x.closest("tr");
	 //row.find("td").eq(4).text("0");
		row.remove();
		 var sum=0;
		 var i=1;
		 $( "#dataTables-example tbody tr" ).each( function(){
		 $(this).find("td").eq(0).text(i++);
  			var s=$(this).find("td").eq(2).text();

			sum += Number(s);
			});
			$("#total").val(sum);
			var bal = $('#old').val();
		var pay = $('#pay').val();
		var total = $('#total').val();
		var amt=Number(total)-Number(pay);
		var due=Number(amt)+Number(bal);
		//alert(due);
		$('#bal').val(due);
			//cal();
			//$("#total").val(sum);
}

		function cal()
		{
		//alert($('#billing').text());
		var tbody = $("#dataTables-example tbody");

		if (tbody.children().length == 0) {
    	//alert('Table Sholud not blank');
		$('#pay').val("");
		return false;
	}
		var bal = $('#old').val();
		var pay = $('#pay').val();
		var total = $('#total').val();
		var amt=Number(total)-Number(pay);
		var due=Number(amt)+Number(bal);
		$('#bal').val(due);
		//alert(due);
		}

		function add()
		{
		$("#total").val("");
		var fees = $('#fees').val();
		var des = $('#des').val();
		//alert('');
		if(des =="")
		{
		$('#message-box-info').toggle();

		$("#appendinfo").empty();
	msg='<p><span class="fa fa-check">Description Should Not Blank !</span></p>';
	$("#appendinfo").append(msg);
			return false;
			}
		if(fees =="")
		{
		$('#message-box-info').toggle();
		$("#appendinfo").empty();
	msg='<p><span class="fa fa-check">Fees should not be blank !</span></p>';
	$("#appendinfo").append(msg);
	return false;
			}
			var txt = "<tr><td></td><td>"+des+"</td><td>"+fees+"</td><td><a href='#' onClick='delItem($(this))' class='btn btn-danger btn-condensed'><span class='fa fa-times'></span></a></td><td style='display:none'>0</td></tr>";
	$("#dataTables-example > tbody").append(txt);
			 $('#fees').val('');
		 $('#des').val('');
		 var sum=0;
		 var i=1;
		 $( "#dataTables-example tbody tr" ).each( function(){
		 $(this).find("td").eq(0).text(i++);
  			var s=$(this).find("td").eq(2).text();
			
			sum += Number(s);
		});
			//alert(sum);
			$("#total").val(sum);
			cal();
		}
		
		
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {                                            
                       
                        id: {
                                required: true
                               
                        },
                        
                        name: {
                                required: true,
                                
                        },
                        pay: {
                                required: true,
                              
                        },
                        
                        
                       
                    },			
   			 	
					
    	                                   
                }); 
				
				
				function get()
				{
				//alert('');
				$("#oldtable > tbody").html("");
				$("#dataTables-example > tbody").html("");
				var ser = $('#ser').val();
				ser=$.trim(ser);
				ser=ser.split('-');
				ser=ser[0];
				if(ser =="")
				return false;
			//alert(ser);
			$.ajax({
		type: "POST",
		url: "returnget.php",
		data: {ser:ser},
		success: function(msg) {
		var msg=$.trim(msg);
		//alert(msg);
		if(msg=='~~0+#0') {
		$('#message-box-info').toggle();
		$("#appendinfo").empty();
	msg='<p><span class="fa fa-check">Request Not Found !</span></p>';
	$("#appendinfo").append(msg);
		//alert('');
		$('#name').val('');
		$('#id').val('');
		
		return false;
		}
		else {
		var y=msg.split('+');
		var x=y[0].split('~');
		$('#name').val(x[1]);
		$('#id').val(x[0]);
		$('#old').val(x[2]);
		var z=y[1].split('#');
		var last=z[1];
		
		var v=z[0].split('@');
		var j=0;
		for (i = 0; i <last; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		$("#tbl").show();
		var txt = "<tr><td>"+s+"</td><td>"+x1[0]+"</td><td>"+x1[1]+"</td><td>"+x1[2]+"</td></tr>";
	$("#oldtable > tbody").append(txt);
		
		}
		
		
		}
		var lab=$("#lab").val();
		if(lab==1)
		addreq();
			
		}
	});

	}
				
				$(document).ready(function() {
 	$.ajax({
		type: "GET",
		url: "return_detail.php",
		success: function(msg) {
			var availableTags = msg.split("~");
			$( "#ser" ).autocomplete({
			  source: availableTags
			});
		}
	});
	
	$.ajax({
		type: "GET",
		url: "returnsymptom.php",
		success: function(msg) {
			var availableTags = msg.split("~");
			$( "#pid" ).autocomplete({
			  source: availableTags
			});
		}
	});
		});                                   



        </script> 
		
		<script>
	updateOnlineStatus();
	setInterval("updateOnlineStatus()", 5000);
	function updateOnlineStatus() { 
		$.ajax({	
			url: 'update-online-status.php',
			type:'POST',
			success:function(){
			}
		});
	}


 $(document).ready(function(){

   setInterval(function(){ 
  
//
	
	$.ajax({
		type: "POST",
		url: "msgnotifi.php",
		
		success: function(msg) {
		//alert(msg);
		$('#appmsg').empty();
		var msg=$.trim(msg);
		if(msg=="0#")
		return false;
		msg=msg.split('#');
		x=msg[1].split('@');
		$("#notifi").text(msg[0]);
		$("#new").text(msg[0]);
		$("#new1").text(msg[0]);
		$.each( x, function( key,value ) {
		y=value.split('~');
		
		/*var txt='<a href="#" onClick="chatWith(y[0])" class="list-group-item"><div class="list-group-status status-away"></div><img src="return_profile_img.php?name='+y[0]+'" class="pull-left" alt="'+y[0]+'"/> <span class="contacts-title">'+y[0]+' </span><p>'+y[1]+'</p></a>';*/
		var txt='<a href="message.php"  class="list-group-item"><div class="list-group-status status-away"></div><img src="return_profile_img.php?name='+y[0]+'" class="pull-left" alt="'+y[0]+'"/> <span class="contacts-title">'+y[0]+' </span><p>'+y[1]+'</p></a>';
		//alert(txt);
		//chatWith(y[0]);
		//startChatSession();
		//$("#ddd").empty();
		//$('#ddd').load('chat/js/chat.js');
		//$("#ddd").load("chat/js/chat.js");
		$('#appmsg').append(txt);
		});
		}
});

if ($(".chatbox").is(":visible")) {
  startChatSession();
}
	
   
    }, 5000);
});
</script>       
    <!-- END SCRIPTS -->          

    <!-- COUNTERS // NOT INCLUDED IN TEMPLATE -->
        <!-- GOOGLE -->
                
        <!-- END GOOGLE -->
        
        <!-- YANDEX -->
        
             
        <!-- END YANDEX -->
    <!-- END COUNTERS // NOT INCLUDED IN TEMPLATE -->
    </body>

<!-- Mirrored from aqvatarius.com/themes/atlant/html/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:48:33 GMT -->
</html>






