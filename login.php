<?php 
	session_start();
	require "inc/db.php";
	include 'inc/header.php';
?>
<dl>
	<dd class="row clearfix">
		<h1 class='loginTit text-center'>
			<a href='../index.php'><a class="fa fa-subway"></a>&nbsp;China Railway Management System
		</h1>
		<div class="col-sm-6 col-sm-offset-3 logmain">
			<form method="post" class='col-sm-10 col-sm-offset-1'>
				<h2 class="text-center">Staff Entry Portal</h2>
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name='username' maxlength=20 placeholder='admin' oninput="checkNewName('admin')" required/>
				</div>
				<div class="form-group">
					 <label>Password </label>
					 <input type="password" class="form-control" name='pwd' placeholder='1234' required/>
					 <kbd class='seepwd' onmousedown="seepwd('pwd')"><i class='fa fa-eye'></i></kbd>
				</div>
				<div class="form-group">
					<div class="col-sm-8 col-sm-offset-2" style='padding-top:30px'>
						<button type='submit' class='btn btn-danger btn-block' name='login' style=''>Log in</button>
					</div>
				</div>
			</form>
		</div>
	</dd>
</dl>
<?php
	include "inc/footer.php";
?>