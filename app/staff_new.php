<form method="post">        
	<div class="col-md-6">
        <div class="form-group"> 
			<label>Staff ID</label>
			<input type="text" class="form-control" disabled>
		</div>
        <div class="form-group">
			<label>User Name</label>
			<input type="text" class="form-control" name='username' placeholder="User Name" required>
		</div>
        <div class="form-group">
			<label>Pass Word</label>
			<input type="text" class="form-control" name='pwd' placeholder="Pass Word" required>
		</div>
         <div class="form-group">
			<label>Pass Word Again</label>
			<input type="text" class="form-control" name='pwda' placeholder="Pass Word Again" required>
		</div>
        </div>
    <div class="col-md-6">
		<div class="form-group">
			<label>First Name *</label>
			<input type="text" class="form-control" name='fname' placeholder="First Name" required>
		</div>
		<div class="form-group">
			<label>Last Name *</label>
			<input type="text" class="form-control" name='lname' placeholder="Last Name" required>
		</div>
        <div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" name='email' placeholder="Email" required>
		</div>
        <div class="form-group">
			<label>Phone Number *</label>
			<input type="text" class="form-control" name='tel' placeholder="Phone Number" required>
		</div>
    </div>
    <div class="col-md-6 col-md-offset-3 topblank">
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </div>
</form>