			<form method='post'>
				<h1 class="text-center text-danger"><?php echo ucwords($_SESSION['user'])."'s Profile";?></h1>
				<div class='col-md-3 col-md-offset-1'>
					<label>Change Password</label>
				</div>
				<div class="form-group col-md-6 col-md-offset-1">
					
					<div class="form-group">
						 <label>Original Password </label>
						 <input type="password" class="form-control" name='oldpwd' required/>
					</div>
					<div class="form-group">
						 <label>New Password </label>
						 <input type="password" class="form-control" onchange='checkpwd()' name='pwd' required/>
						 <kbd class='seepwd' onmousedown="seepwd('pwd')"><i class='fa fa-eye'></i></kbd>
					</div>
					<div class="form-group">
						<label>Password Confirm </label>
						<input type="password" class="form-control" onchange='checkpwd()' name='pwdConfirm' required/>
						<kbd class='seepwd' onmousedown="seepwd('pwdConfirm')" onclick='checkpwd()'><i class='fa fa-eye'></i></kbd>
					</div>
					<div class="form-group col-md-4 col-md-offset-4" style='padding:0'>
						 <button type="submit" class="btn btn-block btn-primary" name='newstaff' onmousedown='checkpwd()' disabled>Submit</button>
					</div>
				</div>
			</form>
			<form method='post'>
				<div class='col-md-3 col-md-offset-1'>
					<label>Change Information</label>
				</div>
				<div class="form-group col-md-6 col-md-offset-1">
					<div class="form-group col-md-6">
						<label>Last name</label><input type="text" class="form-control" name='lname' maxlength=20/>
					</div>
					<div class="form-group col-md-6">
						<label>First name</label><input type="text" class="form-control" name='fname' maxlength=20/>
					</div>
					<div class="form-group col-md-6">
						<label>Phone</label><input type="tel" class="form-control" name='tel' maxlength=30/>
					</div>
					<div class="form-group col-md-6">
						<label>Email</label><input type="email" class="form-control" name='email' maxlength=30/>
					</div>
					<div class="form-group col-md-4 col-md-offset-4" style='padding:0'>
						<button type="submit" class="btn btn-block btn-primary" name='editinfo'>Submit</button>
					</div>
				</div>
			</form>
		</dd>
	</dl>

<?php 
/**Edit Password*/
	if(isset($_POST['newstaff'])){
		$oldpwd = inputCheck($_POST['oldpwd']);
		$res_pwd = $mysql->fetch($mysql->query("SELECT pwd,salt FROM user WHERE id = '{$_SESSION['userid']}'"));
		$oldpwdhash = MD5($oldpwd.$res_pwd['salt']);
		if($oldpwdhash == $res_pwd['pwd']){
			$newpwdhash = MD5($_POST['pwd'].$res_pwd['salt']);
			if($newpwdhash==$oldpwdhash){
				echo "<script>
					$('[name=\"pwd\"').addClass('alert-danger');
					$('[name=\"pwd\"').focus();
					alert('New Password Cannot be same as the original one!');
				</script>";
			}else{
				$sql_newPwd = "UPDATE user SET pwd = '$newpwdhash' WHERE id = {$_SESSION['userid']}";
				$mysql->query($sql_newPwd);
				unset($_SESSION['user']);
				unset($_SESSION['userid']);
				unset($_SESSION['role']);
				redirect('login.php','Change Password Successfully!\\nPlease Log in again!');
			}
		}else{
			echo "<script>
				$('[name=\"oldpwd\"').addClass('alert-danger');
				$('[name=\"oldpwd\"').focus();
				alert('Wrong Password');
			</script>";
		}
	}
/**Edit Customer Info*/
	$sql_userinfo = "SELECT * from user WHERE id = {$_SESSION['userid']}";
	$res_userinfo = $mysql->fetch($mysql->query($sql_userinfo)); 
	echo "<script>
				$('[name=\"fname\"').val('".inputCheck($res_userinfo['fname'])."')
				$('[name=\"lname\"').val('".inputCheck($res_userinfo['lname'])."')
				$('[name=\"tel\"').val('".inputCheck($res_userinfo['tel'])."')
				$('[name=\"email\"').val('".inputCheck($res_userinfo['email'])."')
		</script>";
 	if(isset($_POST['editinfo'])){
		$fname = inputCheck($_POST['fname']);
		$lname = inputCheck($_POST['lname']);
		$tel = inputCheck($_POST['tel']);
		$email = inputCheck($_POST['email']);
		$sql_updateInfo = "UPDATE user SET fname = '$fname', lname = '$lname', tel = '$tel', email = '$email' WHERE id = '{$_SESSION['userid']}'";
		$mysql->query($sql_updateInfo);
		redirect('index.php?page=profile','Change information Successfully!');
	}
?>