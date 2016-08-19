<?php
	session_start();
	if(!isset($_SESSION['phar-username']) || (trim($_SESSION['phar-username']) == '')) {
		header("location:login.php");
		exit();
	}
	
	include("config.php");
	if(isset($_REQUEST['billno'])){
		mysql_query("UPDATE tbl_billing set status = 8 WHERE billno = '".$_REQUEST['billno']."' AND status = 1");
		mysql_query("UPDATE tbl_billing_items set status = 8 WHERE billno = '".$_REQUEST['billno']."' AND status = 1");
		$sql = "SELECT * FROM tbl_billing WHERE billno = '".$_REQUEST['billno']."' AND status = 8";
	}else
		$sql = "SELECT * FROM tbl_billing WHERE status = 8";
	$res = mysql_query($sql);
	if(mysql_num_rows($res) != 0){
		$r = mysql_fetch_array($res);
		$billno = $r['billno'];			$flag1 = 'readonly';	$paidamt = $r['paidamt'];	$flag11 = '';
		$billingid = $r['billingid'];	$flag2 = 'disabled';	$pm = $r['paymentmode'];	$flag22 = '';
		if($pm == 'Cash'){ $cash = 'selected'; $card = ''; }
		else if($pm == 'Card'){ $card = 'selected'; $cash = ''; }
	}else{
		$billno = '';	$flag1 = '';	$flag2 = '';	$cash = '';	$card = '';		$flag11 = 'readonly';	$flag22 = 'disabled';
		$pm = '';	$paidamt = 0;	$$billingid = '';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title>Sales Return</title>
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
    <div class="navbar-header pull-left"> <a href="#" class="navbar-brand"> <small> <img height="80" width="130" src="images/logo.png" /> Pharmacy </small> </a>
      <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu"> <span class="sr-only">Toggle user menu</span> <img src="return-user-img.php?id=<?php echo $_SESSION['phar-loginid']; ?>" alt="<?php echo $_SESSION['phar-username']; ?>" /> </button>
      <button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar"> <span class="sr-only">Toggle sidebar</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </div>
    <div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
      <ul class="nav ace-nav">
        <li class="light-blue user-min"> <a id="usermenu" data-toggle="dropdown" href="#" class="dropdown-toggle"> <img class="nav-user-photo" src="return-user-img.php?id=<?php echo $_SESSION['phar-loginid']; ?>" alt="<?php echo $_SESSION['mp-username']; ?>" /> <span class="user-info"> <small>Welcome,</small> <?php echo $_SESSION['phar-username']; ?> </span> <i class="ace-icon fa fa-caret-down"></i> </a>
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
	.form-group {
    	margin-bottom: 5px;
	}
	@media only screen and (max-width:992px){
		#usermenu {
			margin-top: 0px;
		}
	}
	</style>
  <!-- /.navbar-container -->
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
	if($_SESSION['mp'] == 1 ||	$_SESSION['mm'] == 1 ||	$_SESSION['ms'] ==1 || $_SESSION['mu'] == 1){
		echo '<li class="hover"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-desktop"></i> <span class="menu-text"> Master Entry </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu">';
		if($_SESSION['mp'] == 1) echo '<li class="active open hover"> <a href="manage-product.php"> <i class="menu-icon fa fa-caret-right"></i> Manage Products </a> <b class="arrow"></b> </li>';
		if($_SESSION['ms'] == 1) echo '<li class="hover"> <a href="manage-supplier.php"> <i class="menu-icon fa fa-caret-right"></i> Manage Suppliers </a> <b class="arrow"></b> </li>';
		if($_SESSION['mm'] == 1) echo '<li class="hover"> <a href="manage-manufacturer.php"> <i class="menu-icon fa fa-caret-right"></i> Manage Manufacturer </a> <b class="arrow"></b> </li>';
		if($_SESSION['mu'] == 1) echo '<li class="hover"> <a href="manage-user.php"> <i class="menu-icon fa fa-caret-right"></i> Manage Users </a> <b class="arrow"></b> </li>';
		echo '</ul></li>';
}
	if($_SESSION['bill'] == 1 || $_SESSION['sr'] == 1){
		echo '<li class="active open hover highlight"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-pencil-square-o"></i> <span class="menu-text"> Sales </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b><ul class="submenu">';
		if($_SESSION['bill'] == 1) echo '<li class="hover"> <a href="billing.php"> <i class="menu-icon fa fa-caret-right"></i> Billing </a> <b class="arrow"></b> </li>';
		if($_SESSION['sr'] == 1) echo '<li class="active open hover"> <a href="sales-return.php"> <i class="menu-icon fa fa-caret-right"></i> Sales Return</a> <b class="arrow"></b> </li>';
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
	  ?>
    </ul>
    <!-- /.nav-list -->
    <script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
  </div>
  <div class="main-content">
    <div class="main-content-inner">
      <div class="page-content">
        <div class="page-header">
          <h1> Sales <small> <i class="ace-icon fa fa-angle-double-right"></i> Sales Return </small> </h1>
        </div>
        <!-- /.page-header -->
        <div class="row">
          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="center"> <br />
              <form class="form-horizontal" id="frmBilling">
                <div class="form-group">
                  <label class="col-xs-1 control-label">Bill No</label>
                  <div class="col-xs-2">
                    <input type="text" class="form-control input-sm mand" name="billno" id="billno" value="<?php echo $billno; ?>" placeholder="Bill No" <?php echo $flag1; ?> />
                  </div>
                  <input type="button" class="btn btn-info btn-sm col-xs-1" value="Get Bill" onClick="getBill()" <?php echo $flag2; ?> />
                </div>
                <br />
                <div class="form-group">
                  <label class="col-xs-2 control-label">Product Name</label>
                  <div class="col-xs-3">
                    <input type="text" class="form-control input-sm" name="pname" id="pname" placeholder="Product Name" onBlur="retBatchNo()" list="lstProducts" <?php echo $flag11; ?>>
                  </div>
                  <datalist id="lstProducts">
                    <?php
						include("config.php");
						$rres = mysql_query("SELECT productname FROM tbl_productlist WHERE status = 1");
						while($rrs = mysql_fetch_array($rres)){
							echo '<option>'.$rrs['productname'].'</option>';
						}
					?>
                  </datalist>
                  <label class="col-xs-1 control-label">Batch #</label>
                  <div class="col-xs-2">
                    <select class="form-control input-sm" name="batch" id="batch" onChange="retExpiry()">
                      <option>SELECT</option>
                    </select>
                  </div>
                  <label class="col-xs-1 control-label">Expiry</label>
                  <div class="col-xs-2">
                    <select class="form-control input-sm" name="expiry" id="expiry">
                      <option>SELECT</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-xs-2 control-label">Quantity</label>
                  <div class="col-xs-1">
                    <input type="text" class="form-control input-sm mand number" name="qty" id="qty" placeholder="0" onBlur="validateQty()">
                  </div>
                  <input type="button" class="btn btn-sm btn-info col-xs-1" value="Add" onClick="addBillingItems()" <?php echo $flag22; ?> />
                </div>
                <br />
                <br />
                <div style="min-height: 350px; max-height: 450px; overflow-y: auto;">
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
                      <?php
						include("config.php");
						$sql = mysql_query("SELECT * FROM tbl_billing_items WHERE status = 8");
						while($r = mysql_fetch_array($sql)){
							$code = $r['code'];
							$expirydate = implode("/",array_reverse(explode("-",$r['expirydate'])));
							$expiry = substr($expirydate,3);
							$q = mysql_query("SELECT * FROM tbl_productlist WHERE id = $code");
							$rq = mysql_fetch_array($q);
							echo '<tr><td>'.$r['code'].'</td><td>'.$rq['productname'].'</td><td>'.$r['qty'].'</td><td>'.$r['batchno'].'</td><td>'.$expiry.'</td><td>'.$r['amount'].'</td><td><img src="images/delete.png" style="height:24px; cursor:pointer;" onClick="javascript:deleteItem(this,\''.$r['id'].'\')"></td></tr>'; 
						}
					?>
                    </tbody>
                  </table>
                </div>
                <div class="form-group">
                  <label class="col-xs-2 control-label">Total Amount : </label>
                  <label class="col-xs-1 control-label" id="lblAmount"><?php echo $paidamt; ?></label>
                  <div class="pull-left col-xs-2">
                    <select id="paymentmode" name="paymentmode" class="form-control input-sm">
                      <option>SELECT</option>
                      <option <?php echo $cash; ?>>Cash</option>
                      <option <?php echo $card; ?>>Card</option>
                    </select>
                  </div>
                  <button type="button" class="btn btn-primary btn-sm pull-right" onClick="closeBill('0')" <?php echo $flag22; ?>>Close Bill</button>
                  <button type="button" style="margin-right:10px;" class="btn btn-primary btn-sm pull-right" onClick="closeBill('1')" <?php echo $flag22; ?>>Close Bill & Print</button>
                </div>
              </form>
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
<!-- page specific plugin scripts -->
<!-- ace scripts -->
<script src="dist/js/ace-elements.min.js"></script>
<script src="dist/js/ace.min.js"></script>
<!-- inline scripts related to this page -->
<script src="manage-bill/sales-return.js"></script>
<script>
</script>
</body>
<!-- Mirrored from responsiweb.com/themes/preview/ace/1.3.3/top-menu.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 May 2015 06:07:38 GMT -->
</html>
