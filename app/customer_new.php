<form method="post">        
	<div class="col-md-6">
        <div class="form-group">
			<label>Customer Number</label>
			<input type="text" class="form-control" value="<?php echo $mysql->oneQuery('SELECT MAX(id)+1 FROM customer');?>" disabled>
		</div>
		<div class="form-group">
			<label>First Name</label>
			<input type="text" class="form-control" name='fname' placeholder="First Name" required>
		</div>
		<div class="form-group">
			<label>Last Name</label>
			<input type="text" class="form-control" name='lname' placeholder="Last Name" required>
		</div>
        <div class="form-group">
			<label>Birthdate</label>
			<input type="date" class="form-control" name='birth' required>
		</div>
    </div>
    <div class="col-md-6 form-group">
        <div class="form-group">
			<label>ID Card</label>
			<input type="text" class="form-control" name='idnum' placeholder="ID Card" required>
		</div>
        <div class="form-group">
			<label>Phone Number</label>
			<input type="tel" class="form-control" name='tel' placeholder="Phone Number" required>
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
			<input type="text" class="form-control" name='nplace' placeholder="Native Place" required>
		</div>
    </div>
    <div class="col-md-6 col-md-offset-3 topblank">
        <button type="submit" class="btn btn-primary btn-block" name="new">Submit</button>
		<input type="hidden" name='editcusid'>
    </div>
</form>
<script src='static/js/customer_new.js'></script>
<?php	
	if(isset($_POST['fname'])){   //insert customer information to customer table 
		$fname = inputCheck($_POST['fname']);
		$lname = inputCheck($_POST['lname']);
		$birth = inputCheck($_POST['birth']);
		$idnum = inputCheck($_POST['idnum']);
		$tel = inputCheck($_POST['tel']);
		$sex = inputCheck($_POST['sex']);
		$nplace = inputCheck($_POST['nplace']);
		if(isset($_POST['new'])){
			$sql_newCustomer = "INSERT customer VALUES('','$fname','$lname','$sex','$birth','$tel','$idnum','$nplace')";
			$mysql->query($sql_newCustomer);
			$act = "Create New";
		}else if(isset($_POST['edit'])){  // updata customer information in customer table
			$editid = inputCheck($_POST['editcusid']);
			$sql_editcus = "UPDATE customer SET firstname='$fname',lastname='$lname',sex='$sex',birthdate='$birth',tel='$tel',IDcard='$idnum',birthplace='$nplace' WHERE id='$editid'";
			$mysql->query($sql_editcus);
			$act = "Edit";
		}
		redirect('index.php?page=customer&action=all',"$act Customer Successfully!");
	}
	if(isset($_GET['edit'])){
		$editcusid = inputCheck($_GET['edit']);
		echo "<script>editcus('$editcusid')</script>";
	}
?>