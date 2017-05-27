<div class="col-md-12">
	<div class='helptip' id='helptip' style="display:none;">
		<a class='label label-primary'>E</a> Edit
	</div>
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#panel-editrole" data-toggle="tab" id='showcartab'><span class="fa fa-user"></span>&nbsp;User Role</a>
		</li>
		<li>
			<a href="#panel-rolecfg" data-toggle="tab" id='editcartab'><span class="fa fa-cog"></span>&nbsp;Access Rule</a>
		</li>
	</ul>
	<div class="tab-content">
	<!-- Edit user roles -->	
		<div class="tab-pane active" id="panel-editrole">	
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Staff ID</th>
						<th>Username</th>
						<th>Staff Name</th>
						<th>Role</th>
						<th>
							Operation <a onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icona"></a>
						</th>
					  </tr>
				</thead>
				<tbody>
					<?php
						$sql_stf = "SELECT u.id,username,CONCAT(fname,' ',lname) AS realname,r.name AS role FROM user AS u INNER JOIN role AS r ON u.role_id=r.id";
						$res_stf = $mysql->query($sql_stf);
						while($row_stf = $mysql->fetch($res_stf)){
							echo "<tr>
								<td>".$row_stf['id']."</td>
								<td>".$row_stf['username']."</td>
								<td>".$row_stf['realname']."</td>
								<td>".$row_stf['role']."</td>
								<td>
									<a class='label label-primary' href='#modal-container-1' data-toggle='modal' onclick=$('[name=\"editid\"]').val('{$row_stf['id']}')>E</a>						
								</td>
							</tr>";
						}	
					?>
				</tbody>
			</table>
		</div>
		<div class="tab-pane" id="panel-rolecfg">	
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Menu Description</th>
						<th>URL</th>
						<th>Minimal Access Level</th>
						<th>
							Operation <a onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icona"></a>
						</th>
					  </tr>
				</thead>
				<tbody>
					<?php
						$sql_accesscfg = "SELECT a.*,r.name AS role FROM access AS a INNER JOIN role AS r ON a.role_id=r.id";
						$res_accfg = $mysql->query($sql_accesscfg);
						while($row_accfg = $mysql->fetch($res_accfg)){
							echo "<tr>
								<td>".$row_accfg['name']."</td>
								<td>index.php?page=".$row_accfg['page']."&action=".$row_accfg['action']."</td>
								<td>".$row_accfg['role']."</td>
								<td>
									<a class='label label-primary' href='#modal-container-2' data-toggle='modal' onclick=$('[name=\"cfgid\"]').val('{$row_accfg['id']}')>E</a>
								</td>
							</tr>";
						}
					?>
				</tbody>
			</table>	
		</div>
	</div>
</div>
	<!-- Update Role Form -->
			<div class="modal fade" id="modal-container-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h1 class="modal-title text-center" id='popFormLabel'>
								Change User Role
							</h1>
						</div>
						<div class="modal-body">	
							<form method='post'>
							  <div class="form-group" id='selectRole'>
								<label>User Role:</label>
								<select class="form-control" name='newRole' required>
									<option value="">Select a Role...</option>
								<?php
									$sql_roles = "SELECT * FROM role";
									$res_roles = $mysql->query($sql_roles);
									while($row_roles=$mysql->fetch($res_roles)){
										echo "<option value='".$row_roles['id']."'>".$row_roles['name']."</option>";
									}
								?>
								</select>
							  </div>
								<div class="form-group">
									<label>Please Verify Your Password...</label>
									<input type='password' name='cfpwd' class="form-control" required/>
								</div>
								<input type='hidden' name='editid'/>
								<br/><button type='submit' class='btn btn-primary btn-block' style='padding-right:0;'/>Submit</button>
							</form>
						</div>
					</div>	
				</div>
			</div>
	<!-- Configure Role Form -->
			<div class="modal fade" id="modal-container-2" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h1 class="modal-title text-center" id='popFormLabel'>
								Configure Role Access
							</h1>
						</div>
						<div class="modal-body">	
							<form method='post'>
							  <div class="form-group" id='selectRole'>
								<label>Minimal Role: (this role and its boss will have access right to the menu)</label>
								<select class="form-control" name='newRole' required>
									<option value="">Select a Role...</option>
								<?php
									$sql_roles = "SELECT * FROM role";
									$res_roles = $mysql->query($sql_roles);
									while($row_roles=$mysql->fetch($res_roles)){
										echo "<option value='".$row_roles['id']."'>".$row_roles['name']."</option>";
									}
								?>
								</select>
							  </div>
								<div class="form-group">
									<label>Please Verify Your Password...</label>
									<input type='password' name='cfpwd' class="form-control" required/>
								</div>
								<input type='hidden' name='cfgid'/>
								<br/><button type='submit' class='btn btn-primary btn-block' style='padding-right:0;'/>Submit</button>
							</form>
						</div>
					</div>	
				</div>
			</div>
<?php
/**Get Real pwd hash*/
	$pwdres = $mysql->fetch($mysql->query("SELECT pwd,salt FROM user WHERE id = {$_SESSION['userid']}"));
	if(isset($_POST['cfpwd'])){
		$inputpwd = MD5($_POST['cfpwd'].$pwdres['salt']);
		if($inputpwd==$pwdres['pwd']){
			/**Edit User's Role*/
			if(isset($_POST['editid'])){	
				if($_SESSION['userid']==$_POST['editid']){
					echo "<script>alert('You cannot edit your own role!')</script>";
				}else{
					$editid = inputCheck($_POST['editid']);
					$newRole = inputCheck($_POST['newRole']);
					$sql_updRole = "UPDATE user SET role_id = '$newRole' WHERE id = '$editid'";
					$mysql->query($sql_updRole);
					redirect("index.php?page=staff&action=role","Change Role Successfully!");
				}
			}
			/**Configure Role Right*/
			if(isset($_POST['cfgid'])){	
				$sql_rolecfg = "UPDATE access SET role_id = '".$_POST['newRole']."' WHERE id = '".$_POST['cfgid']."'";
				$mysql->query($sql_rolecfg);
				redirect("index.php?page=staff&action=role","Configure Role Access Rule Successfully!");
			}
		}else{
			echo "<script>alert('Wrong Password')</script>";
		}	
	}

	
		
?>
