<form method="post">        
	<div class="col-md-6">
        <div class="form-group"> 
			<label>Username</label>
			<input type="text" class="form-control" name='username' placeholder="Username" oninput="checkNewName()" maxlength=30 required><kbd class="seepwd hidden"><i class=''></i></kbd>
		</div>
        <div class="form-group">
			<label>Role</label>
			<select type="text" class="form-control" name='role' required>
				<option value="">Select a Role...</option>
				<?php // sele1 role from role table and while loop
					$sql_roles = "SELECT * FROM role WHERE id !=1";
					$res_roles = $mysql->query($sql_roles);
					while($row_roles=$mysql->fetch($res_roles)){
						echo "<option value='".$row_roles['id']."'>".$row_roles['name']."</option>";
					}
				?>
			</select>
		</div>
        <div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" name='pwd' placeholder="Password" onchange='checkpwd()' maxlength=30 required>
			<kbd class='seepwd' onmousedown="seepwd('pwd')"><i class='fa fa-eye'></i></kbd>
		</div>
         <div class="form-group">
			<label>Password Again</label>
			<input type="password" class="form-control" name='pwdConfirm' placeholder="Password Again" onchange='checkpwd()' maxlength=30 required>
			<kbd class='seepwd' onmousedown="seepwd('pwdConfirm')" onclick='checkpwd()'><i class='fa fa-eye'></i></kbd>
		</div>
        </div>
    <div class="col-md-6">
		<div class="form-group">
			<label>First Name</label>
			<input type="text" class="form-control" name='fname' placeholder="First Name" maxlength=30 required>
		</div>
		<div class="form-group">
			<label>Last Name</label>
			<input type="text" class="form-control" name='lname' placeholder="Last Name" maxlength=30 required>
		</div>
        <div class="form-group">
			<label>Email</label>
			<input type="email" class="form-control" name='email' placeholder="Email" maxlength=50 required>
		</div>
        <div class="form-group">
			<label>Phone Number</label>
			<input type="tel" class="form-control" name='tel' placeholder="Phone Number" maxlength=30 required>
		</div>
    </div>
    <div class="col-md-6 col-md-offset-3 topblank">
        <button type="submit" class="btn btn-primary btn-block" name='newstaff' disabled>Submit</button>
    </div>
</form>
<script src='static/js/staff_new.js'></script>
<?php  // add new staff information to user table
	if(isset($_POST['newstaff'])){
		$username = inputCheck($_POST['username']);
		$role = inputCheck($_POST['role']);
		$pwd = inputCheck($_POST['pwd']);
		$salt = base64_encode(mcrypt_create_iv(6,MCRYPT_DEV_RANDOM)); //Add random salt
		$pwdhash = MD5($pwd.$salt); 
		$fname = inputCheck($_POST['fname']);
		$lname = inputCheck($_POST['lname']);
		$email = inputCheck($_POST['email']);
		$tel = inputCheck($_POST['tel']);
		$sql_newStaff = "INSERT user VALUE ('','$username','$pwdhash','$salt','$fname','$lname','$role','$tel','$email')";
		$mysql->query($sql_newStaff);
		redirect("index.php?page=staff&action=all","Create New Staff Successfully!");
	}
?>