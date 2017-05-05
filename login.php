<?php 
	session_start();
	require "inc/db.php";
	include 'inc/header.php';
?>
<dl>
	<dd class="row clearfix">
		<h1 class='loginTit text-center'>
			<a class="fa fa-subway"></a>&nbsp;China Railway Management System
		</h1>
		<div class="col-sm-6 col-sm-offset-3 logmain">
			<form method="post" class='col-sm-10 col-sm-offset-1'>
				<h2 class="text-center">Staff Entry Portal</h2>
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name='username' maxlength=20 placeholder='admin' required/>
				</div>
				<div class="form-group">
					 <label>Password </label>
					 <input type="password" class="form-control" name='pwd' maxlength=20 placeholder='1234' required/>
					 <kbd class='seepwd' onmousedown="seepwd('pwd')"><i class='fa fa-eye'></i></kbd>
				</div>
				<div class="form-group">
					<div class="col-sm-8 col-sm-offset-2 topblank">
						<button type='submit' class='btn btn-danger btn-block' name='login' style=''>Log in</button>
					</div>
				</div>
			</form>
		</div>
	</dd>
</dl>
<?php
	include "inc/footer.php";
	if(isset($_POST['login'])){
		$username = strtolower(inputCheck($_POST['username']));
		$pwd = inputCheck($_POST['pwd']);
		$res_pwd = $mysql->query("SELECT id,pwd,salt,role_id FROM user WHERE username = '$username'"); 
		$adminInfo = $mysql->fetch($res_pwd);
		$pwdhash = MD5($pwd.$adminInfo['salt']);
		if(mysql_num_rows($res_pwd)){
			$rightpwd = $adminInfo['pwd'];
			if($pwdhash == $rightpwd){
				$_SESSION['user'] = $username;
				$_SESSION['userid'] = $adminInfo['id'];
				$_SESSION['role'] = $adminInfo['role_id'];
				echo "<script>$('[name=\"username\"').addClass('alert-success');$('[name=\"pwd\"').addClass('alert-success');</script>";
				redirect('index.php');
			}else{
				echo "<script>$('[name=\"username\"').addClass('alert-success')
					$('[name=\"pwd\"').addClass('alert-danger')
					$('[name=\"username\"').val('$username')
					alert('Wrong Password');$('[name=\"pwd\"').focus();
				</script>";
			}
		}else{
			echo "<script>$('[name=\"username\"').addClass('alert-danger');$('[name=\"username\"').focus();alert('Username not found')</script>";
		}	
	}
?>