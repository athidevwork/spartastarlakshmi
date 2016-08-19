<?php
	session_start();
	if(!isset($_SESSION['phar-username']) || (trim($_SESSION['phar-username']) == '')) {
		header("location:login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title>Manage Users</title>
<meta name="description" content="top menu &amp; navigation" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<link rel="stylesheet" href="dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="font/font-awesome.min.css" />
<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />-->
<link rel="stylesheet" href="dist/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
<style>
input[type="text"]{
	width: 100%;
}
.tdcenter{
	text-align:center;
}
</style>
<!--[if lte IE 9]>
			<link rel="stylesheet" href="dist/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
<!--[if lte IE 9]>
		  <link rel="stylesheet" href="dist/css/ace-ie.min.css" />
		<![endif]-->
<script src="dist/js/ace-extra.min.js"></script>
<!--[if lte IE 8]>
		<script src="dist/js/html5shiv.min.js"></script>
		<script src="dist/js/respond.min.js"></script>
		<![endif]-->
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
</head>
<body class="no-skin">
<div id="navbar" class="navbar navbar-default navbar-collapseh-navbar">
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
        <li class="light-blue user-min"> <a id="usermenu" data-toggle="dropdown" href="#" class="dropdown-toggle"> <img class="nav-user-photo" src="return-user-img.php?id=<?php echo $_SESSION['phar-loginid']; ?>" alt="<?php echo $_SESSION['phar-username']; ?>" /> <span class="user-info"> <small>Welcome,</small> <?php echo $_SESSION['phar-username']; ?> </span> <i class="ace-icon fa fa-caret-down"></i> </a>
          <ul style="margin-top: 25px;" class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
            <!--<li> <a href="#"> <i class="ace-icon fa fa-cog"></i> Settings </a> </li>
            <li class="divider"></li> -->
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
      <li class="hover"> <a href="index.php"> <i class="menu-icon fa fa-tachometer"></i> <span class="menu-text"> Dashboard </span> </a> <b class="arrow"></b> </li>
      <?php
	if($_SESSION['bill'] == 1 || $_SESSION['sr'] == 1){
		echo '<li class="hover"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-pencil-square-o"></i> <span class="menu-text"> Sales </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu">';
		if($_SESSION['bill'] == 1) echo '<li class="active open hover"> <a href="billing.php"> <i class="menu-icon fa fa-caret-right"></i> Billing </a> <b class="arrow"></b> </li>';
		if($_SESSION['sr'] == 1) echo '<li class="hover"> <a href="sales-return.php"> <i class="menu-icon fa fa-caret-right"></i> Sales Return</a> <b class="arrow"></b> </li>';
        echo '</ul></li>';
	}
	if($_SESSION['mp'] == 1 ||	$_SESSION['mm'] == 1 ||	$_SESSION['ms'] ==1 || $_SESSION['mu'] == 1){
		echo '<li class="active open hover highlight"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-desktop"></i> <span class="menu-text"> Master Entry </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu">';
		if($_SESSION['mp'] == 1) echo '<li class="hover"> <a href="manage-product.php"> <i class="menu-icon fa fa-caret-right"></i> Manage Products </a> <b class="arrow"></b> </li>';
		if($_SESSION['ms'] == 1) echo '<li class="hover"> <a href="manage-supplier.php"> <i class="menu-icon fa fa-caret-right"></i> Manage Suppliers </a> <b class="arrow"></b> </li>';
		if($_SESSION['mm'] == 1) echo '<li class="hover"> <a href="manage-manufacturer.php"> <i class="menu-icon fa fa-caret-right"></i> Manage Manufacturer </a> <b class="arrow"></b> </li>';
		if($_SESSION['mu'] == 1) echo '<li class="active open hover"> <a href="manage-user.php"> <i class="menu-icon fa fa-caret-right"></i> Manage Users </a> <b class="arrow"></b> </li>';
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
    <script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
  </div>
  <div class="main-content">
    <div class="main-content-inner">
      <div class="main-content-inner">
        <div class="page-content">
          <div class="page-header">
            <h1> Master Entry <small> <i class="ace-icon fa fa-angle-double-right"></i> Manage Users </small> </h1>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="row">
                <div class="col-xs-12">
                  <div class="table-header"> List of Users <a data-toggle="modal" data-target="#modal-new" class="pull-right" style="margin-right:15px;color:#FFFFFF;text-decoration:none;cursor:pointer;"><i class="ace-icon fa fa-user"></i> Add New User </a> </div>
                  <div>
                    <table id="table-user-list" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th class="center">#</th>
                          <th>Name</th>
                          <th>User ID</th>
                          <th>Role</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div id="modal-view" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header no-padding">
                      <div class="table-header">User Information</div>
                    </div>
                    <div class="modal-body no-padding">
                      <div class="col-xs-12">
                        <div class="col-xs-6">
                          <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                            <tr>
                              <th scope="row">Name</th>
                              <td id="txtUserName">UserName</td>
                            </tr>
                            <tr>
                              <th scope="row">User ID</th>
                              <td id="txtUserId">Admin</td>
                            </tr>
                            <tr>
                              <th scope="row">Role</th>
                              <td id="txtRole">Role</td>
                            </tr>
                            <tr>
                              <th scope="row">Status</th>
                              <td id="txtStatus">Status</td>
                            </tr>
                          </table>
                        </div>
                        <div class="col-xs-3"> <img height=150 width=180 alt="Image Not Found" id="txtPhoto" /></div>
                      </div>
                    </div>
                    <div class="col-xs-12"> <br />
                      <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                        <tr>
                          <td colspan="4">Master Entry</td>
                        </tr>
                        <tr>
                          <td id="vopt1"></td>
                          <td id="vopt2"></td>
                          <td id="vopt3"></td>
                          <td id="vopt4"></td>
                        </tr>
                        <tr>
                          <td colspan="4">Sales</td>
                        </tr>
                        <tr>
                          <td id="vopt5"></td>
                          <td id="vopt6"></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="4">Purchase</td>
                        </tr>
                        <tr>
                          <td id="vopt7"></td>
                          <td id="vopt8"></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="4">Stocks</td>
                        </tr>
                        <tr>
                          <td id="vopt9"></td>
                          <td id="vopt10"></td>
                          <td id="vopt11"></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="4">Reports</td>
                        </tr>
                        <tr>
                          <td id="vopt12"></td>
                          <td id="vopt13"></td>
						   <td id="vopt14"></td>
						   <td id="vopt15"></td>
						   <td id="vopt16"></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </table>
                      <br />
                    </div>
                    <div class="modal-footer no-margin-top">
                      <button class="btn btn-sm btn-info pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="modal-update" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header no-padding">
                      <div class="table-header">Update User Information</div>
                    </div>
                    <div class="modal-body no-padding">
                      <div class="col-xs-12">
                        <div class="col-xs-8">
                          <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                            <tr>
                              <th scope="row">Name</th>
                              <td><input type="hidden" id="DBid" name="DBid">
                                <input type="text" id="UserName" name="UserName"></td>
                            </tr>
                            <tr>
                              <th scope="row">User ID</th>
                              <td><input type="text" id="UserId" name="UserId"></td>
                            </tr>
                            <tr>
                              <th scope="row">Password</th>
                              <td><input type="text" id="Password" name="Password"></td>
                            </tr>
                            <tr>
                              <th scope="row">Role</th>
                              <td><select id="Role" name="Role">
                                  <option value="1">Admin</option>
                                  <option value="2">User</option>
                                </select></td>
                            </tr>
                            <tr>
                              <th scope="row">Photo</th>
                              <td><input type="file" id="Photo" name="Photo" onChange="readURL(this)"></td>
                            </tr>
                          </table>
                        </div>
                        <div class="col-xs-3"> <img height=150 width=180 alt="Image Not Found" id="imgPhoto" /></div>
                      </div>
                    </div>
                    <div class="col-xs-12"> <br />
                      <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                        <tr>
                          <td colspan="4">Master Entry</td>
                        </tr>
                        <tr>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt1">
                              Manage Product</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt2">
                              Manage Manufacturer</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt3">
                              Manage Suppliers</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt4">
                              Manage Users</label>
                            </div></td>
                        </tr>
                        <tr>
                          <td colspan="4">Sales</td>
                        </tr>
                        <tr>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt5">
                              Billing</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt6">
                              Sales Return</label>
                            </div></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="4">Purchase</td>
                        </tr>
                        <tr>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt7">
                              Purchase Entry</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt8">
                              Purchase Return</label>
                            </div></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="4">Stocks</td>
                        </tr>
                        <tr>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt9">
                              Stock Availability</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt10">
                              Initial Stock Entry</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt11">
                              Stock Adjustment</label>
                            </div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="4">Reports</td>
                        </tr>
                        <tr>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt12">
                              Sales Report</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt13">
                              Purchase Report</label>
                            </div></td>
							<td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt14">
                              Doctor Report</label>
                            </div></td>
							<td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt15">
                              Vat Report</label>
                            </div></td>
							<td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="xopt16">
                              Schedule Report</label>
                            </div></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </table>
                      <br />
                    </div>
                    <div class="modal-footer no-margin-top">
                      <button class="btn btn-sm btn-info pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
                      <input type="button" class="btn btn-sm btn-primary pull-right" value="Update" onClick="updateUser()" style="margin-right:10px;"/>
                    </div>
                  </div>
                </div>
              </div>
              <div id="modal-new" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header no-padding">
                      <div class="table-header">New User Information</div>
                    </div>
                    <div class="modal-body no-padding">
                      <div class="col-xs-12">
                        <div class="col-xs-8">
                          <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                            <tr>
                              <th scope="row">Name</th>
                              <td><input type="text" id="newUserName" name="newUserName"></td>
                            </tr>
                            <tr>
                              <th scope="row">User ID</th>
                              <td><input type="text" id="newUserId" name="newUserId"></td>
                            </tr>
                            <tr>
                              <th scope="row">Password</th>
                              <td><input type="text" id="newPassword" name="newPassword"></td>
                            </tr>
                            <tr>
                              <th scope="row">Role</th>
                              <td><select id="newRole" name="newRole">
                                  <option value="0">Select</option>
                                  <option value="1">Admin</option>
                                  <option value="2">User</option>
                                </select></td>
                            </tr>
                            <tr>
                              <th scope="row">Photo</th>
                              <td><input type="file" id="newPhoto" name="newPhoto" onChange="readNewURL(this)"></td>
                            </tr>
                          </table>
                        </div>
                        <div class="col-xs-3"> <img height=150 width=180 alt="Image Not Found" id="newimgPhoto" /></div>
                      </div>
                    </div>
<div class="col-xs-12"> <br />
                      <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                        <tr>
                          <td colspan="4">Master Entry</td>
                        </tr>
                        <tr>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt1">
                              Manage Product</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt2">
                              Manage Manufacturer</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt3">
                              Manage Suppliers</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt4">
                              Manage Users</label>
                            </div></td>
                        </tr>
                        <tr>
                          <td colspan="4">Sales</td>
                        </tr>
                        <tr>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt5">
                              Billing</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt6">
                              Sales Return</label>
                            </div></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="4">Purchase</td>
                        </tr>
                        <tr>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt7">
                              Purchase Entry</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt8">
                              Purchase Return</label>
                            </div></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="4">Stocks</td>
                        </tr>
                        <tr>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt9">
                              Stock Availability</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt10">
                              Initial Stock Entry</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt11">
                              Stock Adjustment</label>
                            </div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="4">Reports</td>
                        </tr>
                        <tr>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt12">
                              Sales Report</label>
                            </div></td>
                          <td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt13">
                              Purchase Report</label>
                            </div></td>
							<td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt14">
                              Doctor Report</label>
                            </div></td>
							<td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt15">
                              Vat Report</label>
                            </div></td>
							<td><div class="checkbox">
                              <label>
                              <input type="checkbox" id="opt16">
                              Schedule Report</label>
                            </div></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </table>
                      <br />
                    </div>
                    <div class="modal-footer no-margin-top">
                      <button class="btn btn-sm btn-info pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
                      <input type="button" class="btn btn-sm btn-primary pull-right" value="Save" onClick="newUser()" style="margin-right:10px;"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="footer-inner">
      <div class="footer-content"> <span class="bigger-120"> <span class="blue bolder">Pharmacy</span> &copy; 2015 By <a href="http://spartasolutions.in" target="_blank" >Sparta Software Solutions</a> </span> &nbsp; &nbsp; </div>
    </div>
  </div>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> </div>
<script src="ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!--[if IE]>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<![endif]-->
<script type="text/javascript">
			window.jQuery || document.write("<script src='dist/js/jquery.min.js'>"+"<"+"/script>");
		</script>
<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='dist/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='dist/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
<script src="netdna.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="dist/js/dataTables/jquery.dataTables.min.js"></script>
<script src="dist/js/dataTables/jquery.dataTables.bootstrap.min.js"></script>
<script src="dist/js/dataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="dist/js/dataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<script src="dist/js/ace-elements.min.js"></script>
<script src="dist/js/ace.min.js"></script>
<script src="manage-user/manage-user.js"></script>
<script src="manage-bill/quick-bill.js"></script>
<script type="text/javascript">
	jQuery(function($) {
		//initiate dataTables plugin
		var oTable1 = 
		$('#table-user-list')
		//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
		.dataTable( {
			bAutoWidth: false,
			"bProcessing": true,
			"sAjaxSource": "manage-user/return-user-list.php",
			"aoColumns": [
				{ mData: '#',"bSortable": false },
				{ mData: 'Name' },
				{ mData: 'User ID' },
				{ mData: 'Role' },
				{ mData: 'Status',"sClass": "tdcenter" },
				{ mData: 'Action',"bSortable": false,"sClass": "tdcenter" },
			],
			"aaSorting": [],
		} );		
	});
</script>
</body>
</html>
