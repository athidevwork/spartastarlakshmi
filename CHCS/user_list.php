<table id="user" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Username</th>
					  <th>Role</th>
						<th style="display:none">id</th>
						<th>Name</th>
						 <th>Action</th>
                    </tr>
					
                  </thead>
				  <tbody>
				  
				  <?php 
					include("config_db1.php");
					$cmd = "select username,role,id,name from user_login order by username asc";
					$i=1;
			$res = mysql_query($cmd);
			while($rs = mysql_fetch_array($res)){
			if($rs['role']==1)
			$role="Admin";
			
			if($rs['role']==2)
			$role="User";
			if($rs['role']==3)
			$role="Lab";

if($rs['role']==4)
			$role="Cashier";
if($rs['role']==5)
			$role="Ward";
if($rs['role']==6)
			$role="ICU";
if($rs['role']==7)
			$role="OT";
if($rs['role']==8)
			$role="ER";
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$rs['username'].'</td>
						<td>'.$role.'</td>
						<td style="display:none;">'.$rs['id'].'</td>
						<td style="">'.$rs['name'].'</td>
						<td><a href="javascript:return false;" name="editimg" onClick="edit_user(this);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
						<a href="javascript:delete_id(\''.$rs['id'].'\')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?>
				  </tbody>
				  </table>