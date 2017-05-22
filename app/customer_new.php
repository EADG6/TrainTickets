<<<<<<< HEAD
﻿
=======
>>>>>>> fd62cac9236a4a048b2a2e3410908871ea14988d
<form method="post">        
	<div class="col-md-6">
        <div class="form-group">
			<label>Customer Number</label>
			<input type="text" class="form-control" disabled>
		</div>
		<div class="form-group">
			<label>First Name *</label>
			<input type="text" class="form-control" name='fname' placeholder="First Name" required>
		</div>
		<div class="form-group">
			<label>Last Name *</label>
			<input type="text" class="form-control" name='lname' placeholder="Last Name" required>
		</div>
        <div class="form-group">
			<label>Birthdate *</label>
			<input type="date" class="form-control" name='birth' required>
		</div>
    </div>
    <div class="col-md-6 form-group">
        <div class="form-group">
			<label>ID Card *</label>
			<input type="text" class="form-control" name='idnum' placeholder="ID Card" required>
		</div>
        <div class="form-group">
			<label>Phone Number *</label>
			<input type="text" class="form-control" name='tel' placeholder="Phone Number" required>
		</div>
        <div class="form-group">
			<label>Gender</label>
			<select class="form-control" name="sex">
				<option value=0>Unknown</option>
				<option value=1>Male</option>
				<option value=2>Female</option>
			</select>
		</div>
        <div class="form-group"> 
			<label>Native Place</label>
			<input type="text" class="form-control" name='nplace' placeholder="Native Place">
		</div>
    </div>
    <div class="col-md-6 col-md-offset-3 topblank">
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </div>
</form>
<?php
	if(isset($_POST['fname'])){
		if(!empty($_POST['fname'])){
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$birth = $_POST['birth'];
			$idnum = $_POST['idnum'];
			$tel = $_POST['tel'];
			$sex = $_POST['sex'];
			$nplace = $_POST['nplace'];

			$sql_newCustomer = "INSERT customer VALUES('','$fname','$lname','$sex','$birth','$tel')";
			$mysql->query($sql_newCustomer);
			echo "<script>if(confirm('Create Ticket Successfully!'))
				{location.href='index.php?page=customer&action=all'}
			</script>";
		}else{
			echo "<script>alert('Something Wrong')</script>";
		}
		
	}





?>