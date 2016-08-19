<div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation" style="height:850px">
                    <li class="xn-logo">
                        <a href="home.php">DPP</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="return_profile_img.php?name=<?php echo $_SESSION['username']; ?>" alt="<?php echo $_SESSION['name']; ?>"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="return_profile_img.php?name=<?php echo $_SESSION['username']; ?>" alt="<?php echo $_SESSION['name']; ?>"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $_SESSION['username']; ?></div>
                                <div class="profile-data-title"><?php echo $_SESSION['name'].'/'; if($_SESSION['role']==1) echo'Doctor'; else if($_SESSION['role']==2) echo 'Nurse'; else echo 'Lab'; ?></div>
                            </div>
                            <div class="profile-controls">
                                <a href="pages-edit-profile.php" class="profile-control-left"><span class="fa fa-info"></span></a>
                                <a href="message.php" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                            </div>
                        </div>                                                                        
                    </li>
                    <li class="xn-title">Navigation</li>
                    <li>
                        <a href="home.php"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
                    </li>
					<?php  if($sql['registration']==1) { ?>
                      <li>
                        <a href="registration.php"><span class="fa fa-pencil-square-o"></span> <span class="xn-text">Registration</span></a>                        
                    </li> 
					<?php } if($sql['admission']==1) {?>
					<li>
                        <a href="patient-info.php"><span class="glyphicon glyphicon-record"></span> <span class="xn-text">Admission</span></a>                        
                    </li> <?php } 
					
					if($sql['billingop']==1) { ?>
					<li>
                        <a href="billing.php"><span class="fa fa-credit-card"></span> <span class="xn-text">Billing OP</span></a>                        
                    </li>  
					<?php }
					 if($sql['billingip']==1) { ?>
					<li>
                        <a href="billing_ip.php"><span class="fa fa-credit-card"></span> <span class="xn-text">Billing IP</span></a>                        
                    </li>
                    <?php }  if($sql['editbilling']==1) { ?>
					
					<li>
                        <a href="managebills.php"><span class="fa fa-credit-card"></span> <span class="xn-text">Manage Billing</span></a>                        
                    </li>
					<?php } if($sql['masterentry']==1) { ?>
					<li>
                        <a href="master_entry.php"><span class="fa fa-cogs"></span> <span class="xn-text">Master Entry</span></a>                        
                    </li>  
					<?php } if($sql['reports']==1) { ?>
					<li>
                        <a href="reports.php"><span class="fa fa-sort-alpha-desc"></span> <span class="xn-text">Reports</span></a>                        
                    </li>
					<?php } if($sql['labreports']==1) {  ?> 
					<li>
                        <a href="IPlabsample.php"><span class="fa fa-sort-alpha-desc"></span> <span class="xn-text">Lab Reports</span></a>                        
                    </li>
					<?php } ?> 
					
					<li>
                        <a href="addressbook.php"><span class="fa fa-users"></span> <span class="xn-text">Address Book</span></a>                        
                    </li> 
					<li style="padding-top:60px"><center>
                        <a style="font-size:14px; color:#F98B57" target="_blank" href="http://spartasolutions.in">Designed by Sparta &copy; </a>                        
						</center>
                    </li>                                          
                <!--    <li class="xn-title">Components</li>-->
                                        
                    
                    
                </ul>
                <!-- END X-NAVIGATION -->
            </div>