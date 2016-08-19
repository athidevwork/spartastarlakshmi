<?php
	session_start();
	date_default_timezone_set("Asia/Kolkata");
	if(!isset($_SESSION['phar-username']) || (trim($_SESSION['phar-username']) == '')) {
		header("location:login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--<meta http-equiv="refresh" content="30"> -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title>Dashboard</title>
<meta name="description" content="top menu &amp; navigation" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="font/font-awesome.min.css" />
<!-- page specific plugin styles -->
<!-- text fonts -->
<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />-->
<!-- ace styles -->
<link rel="stylesheet" href="dist/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<script src="dist/js/ace-extra.min.js"></script>
</head>
<body class="no-skin">
<div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar">
  <script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>
  <div class="navbar-container" id="navbar-container">
    <div class="navbar-header pull-left"> <a href="#" class="navbar-brand"> <small> <img height="80" width="130" src="images/logoo.png" /> Pharmacy </small> </a>
      <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu"> <span class="sr-only">Toggle user menu</span> <img src="return-user-img.php?id=<?php echo $_SESSION['phar-loginid']; ?>" alt="<?php echo $_SESSION['phar-username']; ?>" /> </button>
      <button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar"> <span class="sr-only">Toggle sidebar</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </div>
    <div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
      <ul class="nav ace-nav">
        <li class="light-blue user-min"> <a id="usermenu" data-toggle="dropdown" href="#" class="dropdown-toggle"> <img class="nav-user-photo" src="return-user-img.php?id=<?php echo $_SESSION['phar-loginid']; ?>" alt="<?php echo $_SESSION['mp-username']; ?>" /> <span class="user-info"> <small>Welcome,</small> <?php echo $_SESSION['phar-username']; ?> </span> <i class="ace-icon fa fa-caret-down"></i> </a>
          <ul style="margin-top: 25px;" class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
            <li> <a href="#" data-toggle="modal" data-target="#mdlRestPassword"> <i class="ace-icon fa fa-cog"></i> Settings </a> </li>
            <li class="divider"></li>
            <li> <a href="logout.php"> <i class="ace-icon fa fa-power-off"></i> Logout </a> </li>
          </ul>
        </li>
      </ul>
    </div>
  </div >
  <style>
	#usermenu{
		margin-top: 25px;
	}
	@media only screen and (max-width:992px){
		#usermenu {
			margin-top: 0px;
		}
	}
	</style>
  <!-- /.navbar-container -->
</div>
<div class="modal fade" id="mdlRestPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Name</label>
            <input type="text" class="form-control" id="txt-name" value="<?php echo $_SESSION['phar-username']; ?>" readonly />
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">New Password</label>
            <input type="text" class="form-control" id="txt-pwd">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm" onClick="saveNewPassword()">Save Password</button>
      </div>
    </div>
  </div>
</div>
<div class="main-container container" id="main-container">
  <script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
  <div id="sidebar" class="sidebar      h-sidebar                navbar-collapse collapse">
    <script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>
    <ul class="nav nav-list">
      <li class="active open hover highlight"> <a href="index.php"> <i class="menu-icon fa fa-tachometer"></i> <span class="menu-text"> Dashboard </span> </a> <b class="arrow"></b> </li>
      <?php
	if($_SESSION['bill'] == 1 || $_SESSION['sr'] == 1){
		echo '<li class="hover"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-pencil-square-o"></i> <span class="menu-text"> Sales </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu">';
		if($_SESSION['bill'] == 1) echo '<li class="active open hover"> <a href="billing.php"> <i class="menu-icon fa fa-caret-right"></i> Billing </a> <b class="arrow"></b> </li>';
		if($_SESSION['sr'] == 1) echo '<li class="hover"> <a href="sales-return.php"> <i class="menu-icon fa fa-caret-right"></i> Sales Return</a> <b class="arrow"></b> </li>';
        echo '</ul></li>';
	}
	if($_SESSION['mp'] == 1 ||	$_SESSION['mm'] == 1 ||	$_SESSION['ms'] ==1 || $_SESSION['mu'] == 1){
		echo '<li class="hover"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-desktop"></i> <span class="menu-text"> Master Entry </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu">';
		if($_SESSION['mp'] == 1) echo '<li class="active open hover"> <a href="manage-product.php"> <i class="menu-icon fa fa-caret-right"></i> Manage Products </a> <b class="arrow"></b> </li>';
		if($_SESSION['ms'] == 1) echo '<li class="hover"> <a href="manage-supplier.php"> <i class="menu-icon fa fa-caret-right"></i> Manage Suppliers </a> <b class="arrow"></b> </li>';
		if($_SESSION['mm'] == 1) echo '<li class="hover"> <a href="manage-manufacturer.php"> <i class="menu-icon fa fa-caret-right"></i> Manage Manufacturer </a> <b class="arrow"></b> </li>';
		if($_SESSION['mu'] == 1) echo '<li class="hover"> <a href="manage-user.php"> <i class="menu-icon fa fa-caret-right"></i> Manage Users </a> <b class="arrow"></b> </li>';
		if($_SESSION['mu'] == 1) echo '<li class="hover"> <a href="manage-doctor.php"> <i class="menu-icon fa fa-caret-right"></i> Manage Doctor </a> <b class="arrow"></b> </li>';
		echo '</ul></li>';
	}
	if($_SESSION['pe'] == 1 || $_SESSION['pr'] == 1){
		echo '<li class="hover"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-shopping-cart"></i> <span class="menu-text"> Purchase </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu">';
		if($_SESSION['pe'] == 1) echo '<li class="active open hover"> <a href="purchase-entry.php"> <i class="menu-icon fa fa-caret-right"></i> Purchase Entry </a> <b class="arrow"></b> </li>';
		if($_SESSION['pr'] == 1) echo '<li class="hover"> <a href="purchase-return.php"> <i class="menu-icon fa fa-caret-right"></i> Purchase Return </a> <b class="arrow"></b> </li>';
        echo '</ul></li>';
	}
	if($_SESSION['sa'] == 1 || $_SESSION['ise'] == 1 || $_SESSION['stka'] == 1){
		echo '<li class="hover"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-line-chart"></i> <span class="menu-text"> Stocks </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu">';
		if($_SESSION['sa'] == 1) echo '<li class="active open hover"> <a href="stock-availability.php"> <i class="menu-icon fa fa-caret-right"></i> Stock Availability </a> <b class="arrow"></b> </li>';
		if($_SESSION['ise'] == 1) echo '<li class="hover"> <a href="initial-stock-entry.php"> <i class="menu-icon fa fa-caret-right"></i> Initial Stock Entry </a> <b class="arrow"></b> </li>';
		if($_SESSION['stka'] == 1) echo '<li class="hover"> <a href="stock-adjustment.php"> <i class="menu-icon fa fa-caret-right"></i> Stock Adjustment </a> <b class="arrow"></b> </li>';
        echo '</ul></li>';
	}
	if($_SESSION['prep'] == 1 || $_SESSION['srep'] == 1 || $_SESSION['doc'] == 1 || $_SESSION['vat'] == 1 || $_SESSION['sch'] == 1){
		echo '<li class="hover"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-calendar"></i> <span class="menu-text"> Reports</span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu">';
		if($_SESSION['srep'] == 1) echo '<li class="active open hover"> <a href="sales-report.php"> <i class="menu-icon fa fa-caret-right"></i> Sales Report </a> <b class="arrow"></b> </li>';
		if($_SESSION['prep'] == 1) echo '<li class="hover"> <a href="purchase-report.php"> <i class="menu-icon fa fa-caret-right"></i> Purchase Report </a> <b class="arrow"></b> </li>';
		if($_SESSION['doc'] == 1) echo '<li class="hover"> <a href="doctor-report.php"> <i class="menu-icon fa fa-caret-right"></i> Doctor Report </a> <b class="arrow"></b> </li>';
		if($_SESSION['vat'] == 1) echo '<li class="hover"> <a href="vat-report.php"> <i class="menu-icon fa fa-caret-right"></i> VAT Report </a> <b class="arrow"></b> </li>';
if($_SESSION['sch'] == 1) echo '<li class="hover"> <a href="schedule-report.php"> <i class="menu-icon fa fa-caret-right"></i> Schedule Drug Report </a> <b class="arrow"></b> </li>';
if($_SESSION['sch'] == 1) echo '<li class="hover"> <a href="adj-report.php"> <i class="menu-icon fa fa-caret-right"></i> Stock Adjustment Report </a> <b class="arrow"></b> </li>';
if($_SESSION['sch'] == 1) echo '<li class="hover"> <a href="pf-report.php"> <i class="menu-icon fa fa-caret-right"></i> PF Report </a> <b class="arrow"></b> </li>';
        echo '</ul></li>';
	}
	if($_SESSION['phar-role'] == 1) {
      	echo '<li class="hover"> <a href="manage-license.php"> <i class="menu-icon fa fa-key"></i> <span class="menu-text"> License </span> <b class="arrow fa fa-angle-down"></b> </a> </li>';
	  }
	 if($_SESSION['bill'] == 1) {
      	echo '<li class="hover pull-right"> <a href="#" onClick="quickBilling()"> <i class="menu-icon fa fa-pencil-square-o"></i> <span class="menu-text"> Quick Bill </span> <b class="arrow fa fa-angle-down"></b> </a> </li>';
	  }
	  ?>
    </ul>
<div class="modal fade" tabindex="-1" role="dialog" id="mdlNewQuickBill">
    <div class="modal-dialog modal-xs">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">New Bill</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
		  	<div class="form-group">
              <label class="col-xs-3 control-label">Phone Number</label>
              <div class="col-xs-8">
                <input type="text" class="form-control input-sm mand" name="qbcontactnumber" id="qbcontactnumber" placeholder="Phone Number" onBlur="getdetails($(this))">
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-3 control-label">Patient Name</label>
              <div class="col-xs-8">
                <input type="text" class="form-control input-sm mand" name="qbpatientname" id="qbpatientname" placeholder="Patient Name">
              </div>
            </div>
		
            <div class="form-group">
			<?php include("config.php");
			$query=mysql_query("select id,doctorname from tbl_doctor");
			?>
              <label class="col-xs-3 control-label">Doctor Name</label>
              <div class="col-xs-8">
			  <select id='qbdrname' onChange="checkdoctor($(this))"> 
			  <option value="0">Select</option>
			<?php  while($q=mysql_fetch_array($query)) { 
			echo '
			<option value='.$q['doctorname'].'>'.$q['doctorname'].'</option>
			';
                
				} ?>
				</select>
              </div>
            </div>
			 <div class="form-group">
			 <label class="col-xs-3 control-label"></label>
			 <div class="col-xs-8">
			 <div id="otherdoctor">
			<input type="text" class="form-control input-sm" name="qbdrname1" id="qbdrname1" placeholder="Doctor Name">
			</div>
			</div>
			 </div>
          </form>
		 <script>
		 function checkdoctor(x) {
		 var doctor=x.val();
		 if(doctor==0)
		 $("#otherdoctor").show(); 
		
		 else {
		 $("#qbdrname1").val(""); 
		 $("#otherdoctor").hide();
		 }
		// alert(doctor);
		 }
		 </script>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" onClick="createNewBill()">Create Bill</button>
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" tabindex="-1" role="dialog" id="mdlQuickBill">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header no-padding">
		<div class="table-header">Billing Information : </div>
	  </div>
	  <div class="modal-body no-padding" style="  max-height: 450px; min-height: 400px; overflow-y: auto;">
		<div class="col-xs-12"> <br />
		  <form class="form-horizontal">
			<div class="form-group">
			  <label class="col-xs-2 control-label">Product Type</label>
			  <div class="col-xs-2">
				<select class="form-control input-sm" name="ptype" id="ptype">
				  <option>SELECT</option>
				  <?php
						$q = mysql_query("SELECT distinct stocktype FROM tbl_productlist");
						while($r = mysql_fetch_array($q)){
							echo '<option>'.$r['stocktype'].'</option>';
						}
					?>
				</select>
			  </div>
			  <label class="col-xs-2 control-label">Product Name</label>
			  <div class="col-xs-3">
				<input type="text" class="form-control input-sm" name="pname" id="pname" placeholder="Product Name" list="lstProducts" onBlur="retBatchNo()">
			  </div>
			  <label class="col-xs-1 control-label">Batch #</label>
			  <div class="col-xs-2">
				<select class="form-control input-sm" name="batch" id="batch" onChange="retExpiry()">
				  <option>SELECT</option>
				</select>
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-xs-2 control-label">Expiry</label>
			  <div class="col-xs-2">
				<select class="form-control input-sm" name="expiry" id="expiry">
				  <option>SELECT</option>
				</select>
			  </div>
			  <label class="col-xs-1 control-label">Quantity</label>
			  <div class="col-xs-1">
				<input type="text" class="form-control input-sm mand number" name="qty" id="qty" placeholder="0" onBlur="validateQty()">
			  </div>
			  <input type="button" class="btn btn-sm btn-info col-xs-1" value="Add" onClick="addBillingItems()" />
			</div>
			<table id="tbl-list" class="table table-striped">
			  <thead>
				<tr>
				  <th style="text-align:center">Code</th>
				  <th style="text-align:center">Description</th>
				  <th style="text-align:center">Qty.</th>
				  <th style="text-align:center">Batch#</th>
				  <th style="text-align:center">Expiry</th>
				  <th style="text-align:center">Amount</th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
			  </tbody>
			</table>
		  </form>
		</div>
	  </div>
	  <div class="modal-footer no-margin-top">
		<label class="pull-left col-xs-2">Total Amount : </label>
		<label class="pull-left col-xs-1" id="lblAmount">0.00</label>
		<div class="pull-left col-xs-2">
		  <select id="paymentmode" name="paymentmode" class="form-control input-sm">
			<option>SELECT</option>
			<option>Cash</option>
			<option>Card</option>
		  </select>
		</div>
		<button type="button" class="btn btn-primary btn-sm" onClick="closeBill('0')">Close Bill</button>
		<button type="button" class="btn btn-primary btn-sm" onClick="closeBill('1')">Close Bill & Print</button>
		<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">X</button>
	  </div>
	</div>
  </div>
</div>
    <!-- /.nav-list -->
    <script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					
					
					
				</script>
  </div>
  <div class="main-content">
    <div class="main-content-inner">
      <div class="page-content">
        <div class="page-header">
          <h1> Dashboard</h1>
        </div>
        <!-- /.page-header -->
        <div class="row">
          <div class="col-xs-12">
		  <div class="row">
                <div class="col-xs-12">
				<style>
				.table-header1{background-color:#a23030;color:#FFF;font-size:14px;line-height:38px;padding-left:12px;margin-bottom:1px}
				.blink_me {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {  
  50% { opacity: 0.0; }
}
				</style>
                  <div class="table-header1 blink_me">Minimum Stock Availability </div>
                  <div>
                    <table id="table-user-list" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th class="center">SNo</th>
						  <th>Product Type</th>
                          <th>Product Name</th>
                          <th>Batch #</th>
						  <th>Expiry</th>
						  <th>Availability</th>
                          <th>Shelf</th>
                          <th>Rack</th>
                          <th>MRP</th>
                          <th style="display:none;"></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
			  
			  <div class="row">
                <div class="col-xs-12">
                  <div class="table-header1 blink_me">Products Expiry Alerts</div>
                  <div>
                    <table id="table-exp-list" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th class="center">SNo</th>
						  <th>Product Type</th>
                          <th>Product Name</th>
                          <th>Batch #</th>
						  <th>Expiry</th>
						  <th>Availability</th>
                          <th>Shelf</th>
                          <th>Rack</th>
                          <th>MRP</th>
                          <th style="display:none;"></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            <!-- PAGE CONTENT BEGINS -->
            <div class="center"> <br />
			<?php 
				include("config.php");
				$s1 = mysql_query("SELECT status FROM tbl_setting WHERE settingstype = 'DPP'");
				$srs = mysql_fetch_array($s1);
				$dpp = $srs['status'] ? $srs['status'] : 0;
				if($dpp == 1) { ?>
             
			  
			  <?php } ?>
              <br />
              <img src="images/logoo.png" style="width:50%; opacity: 0.4;" /> <br />
              <?php
			  	include("config.php");
				$today = date('Y-m-d');
				$sql = mysql_query("SELECT count(billno) as noofbills, sum(paidamt) as billamt FROM tbl_billing WHERE cast(datentime as date) = '$today' AND status = 1");
				$r = mysql_fetch_array($sql);
				$patcount = $r['noofbills'] ? $r['noofbills'] : 0;
				$billamt = $r['billamt'] ? $r['billamt'] : 0;
			  ?>
              <div class="widget-box">
                <div class="widget-header">
                  <h4 class="widget-title lighter smaller"> <i class="ace-icon fa fa-rupee blue"></i> Today's Accounts </h4>
                </div>
                <div class="widget-body">
                  <div class="widget-main no-padding">
                    <div class="dialogs ace-scroll">
                      <div class="scroll-track scroll-active" style="display: block; height: 300px;">
                        <div class="scroll-bar" style="height: 262px; top: 0px;"></div>
                      </div>
                      <div class="col-lg-12">
                        <label class="col-lg-6" style="text-align:right;">No. of Patient Served : </label>
                        <label class="col-lg-6" style="text-align:left;"><?php echo $patcount; ?></label>
                        <label class="col-lg-6" style="text-align:right;">Total Billed amount : </label>
                        <label class="col-lg-6" style="text-align:left;"><i class="ace-icon fa fa-rupee blue"></i> <?php echo $billamt; ?></label>
                      </div>
                      <!-- /.widget-main -->
                    </div>
                    <!-- /.widget-body -->
                  </div>
                  <!-- /.widget-box -->
                </div>
              </div>
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
            </div>
            <!-- PAGE CONTENT ENDS -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.page-content -->
    </div>
  </div>
  <!-- /.main-content -->
  <div class="footer">
    <div class="footer-inner">
      <div class="footer-content"> <span class="bigger-120"> <span class="blue bolder">Pharmacy</span> &copy; 2015 By <a href="http://spartasolutions.in" target="_blank" >Sparta Software Solutions</a> </span> &nbsp; &nbsp; </div>
    </div>
  </div>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> </div>
<!-- /.main-container -->
<!-- basic scripts -->
<!--[if !IE]> -->
<script src="libs/jquery/2.1.1/jquery.min.js"></script>
<!-- <![endif]-->
<!--[if IE]>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<![endif]-->
<!--[if !IE]> -->
<script type="text/javascript">
			window.jQuery || document.write("<script src='dist/js/jquery.min.js'>"+"<"+"/script>");
		</script>
<!-- <![endif]-->
<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='dist/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='dist/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
<script src="bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="dist/js/dataTables/jquery.dataTables.min.js"></script>
<script src="dist/js/dataTables/jquery.dataTables.bootstrap.min.js"></script>
<script src="dist/js/dataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="dist/js/dataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<!-- page specific plugin scripts -->
<!-- ace scripts -->
<script src="dist/js/ace-elements.min.js"></script>
<script src="dist/js/ace.min.js"></script>
<!-- inline scripts related to this page -->
<script src="manage-bill/dashboard-bill.js"></script>
<script src="manage-bill/quick-bill.js"></script>
<script>
	function saveNewPassword(){
		var pwd = $('#txt-pwd').val();
		if($.trim(pwd) == '') return false;
		$.ajax({
	        type: 'post',
	        url: 'userjs/update-password.php',
			data: {
				pwd: pwd,
			},
    	    success: function(msg) {
				alert(msg);
				$('#txt-pwd').val('');
				$('#mdlRestPassword').modal('hide');
	        }
	    });
	}
</script>
<script type="text/javascript">
	jQuery(function($) {
		//initiate dataTables plugin
		var oTable1 = 
		$('#table-user-list').dataTable( {
			bAutoWidth: false,
			"bProcessing": true,
			"sAjaxSource": "manage-stock/return-stock-min.php",
			"aoColumns": [
				{ mData: '#',"bSortable": true, "sClass": "tdcenter"},
				{ mData: 'type' },
				{ mData: 'product' },
				{ mData: 'batch', "sClass": "tdcenter" },
				{ mData: 'expiry', "sClass": "tdcenter" },
				{ mData: 'avail', "sClass": "tdcenter" },
				{ mData: 'shelf', "sClass": "tdcenter" },
				{ mData: 'rack', "sClass": "tdcenter" },
				{ mData: 'mrp', "sClass": "tdcenter" },
				
			],
			"aaSorting": [],
			"fnInitComplete": function(oSettings, json) {
				$("#table-user-list > tbody > tr").each(function(item,i) {
					if($(this).find('td').eq(8).text() == '1'){
						$(this).css('background-color','rgba(255, 0, 0, 0.4)');
					}
				});
			}
		} );		
	});
</script>
<script type="text/javascript">
	jQuery(function($) {
		//initiate dataTables plugin
		var oTable11 = 
		$('#table-exp-list').dataTable( {
			bAutoWidth: false,
			"bProcessing": true,
			"sAjaxSource": "manage-stock/return-stock-exp.php",
			"aoColumns": [
				{ mData: '#',"bSortable": true, "sClass": "tdcenter"},
				{ mData: 'type' },
				{ mData: 'product' },
				{ mData: 'batch', "sClass": "tdcenter" },
				{ mData: 'expiry', "sClass": "tdcenter" },
				{ mData: 'avail', "sClass": "tdcenter" },
				{ mData: 'shelf', "sClass": "tdcenter" },
				{ mData: 'rack', "sClass": "tdcenter" },
				{ mData: 'mrp', "sClass": "tdcenter" },
				{ mData: 'alrt',"bSortable": false, "sClass": "tdhide" }, 
				
			],
			"aaSorting": [],
			"fnInitComplete": function(oSettings, json) {
				$("#table-exp-list > tbody > tr").each(function(item,i) {
					if($(this).find('td').eq(8).text() == '1'){
						$(this).css('background-color','rgba(255, 0, 0, 0.4)');
					}
				});
			}
		} );		
	});
</script>

</body>
<!-- Mirrored from responsiweb.com/themes/preview/ace/1.3.3/top-menu.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 May 2015 06:07:38 GMT -->
</html>
