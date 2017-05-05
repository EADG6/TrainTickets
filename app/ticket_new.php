<form method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label>Start City:</label>
			<select class="form-control" onchange='selectCity(this)' name="scity" required>
				<option value=''>Choose City</option>
				<option value=0>Chengdu</option>
				<option value=1>Beijing</option>
				<option value=2>Xian</option>
				<option value=3>Shanghai</option>
			</select>
		</div>
        <div class="form-group">
			<label>Start time:</label>
			<select class="form-control" name="stime" required>
				<option value></option>
			</select>
		</div>
        <div class="form-group">
			<label>Seat level:</label>
			<select class="form-control" name="level" required>
				<option value></option>
			</select>
		</div>
        <div class="form-group">
			<label>Customer:</label>
			<select class="form-control" name="cusid" required>
				<option value></option>
			</select>
		</div>
        <div class="form-group">
			<label>Date:</label>
			<input type="date" class="form-control" name="date" required>
		</div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
			<label>End City:</label>
			<select class="form-control" onchange='selectCity(this)' name="ecity" required>
				<option value=''>Choose City</option>
				<option value=0>Chengdu</option>
				<option value=1>Beijing</option>
				<option value=2>Xian</option>
				<option value=3>Shanghai</option>
			</select>
		</div>
		<div class="form-group">
			<label>End time:</label>
			<input type="text" class="form-control" disabled>
		</div>
		<div class="form-group">
			<label>Seat Ramain:</label>
			<input type="text" class="form-control" disabled>
		</div>
		<div class="form-group">
			<label>Customer Name:</label>
			<input type="text" class="form-control" disabled>
		</div>
		<div class="form-group">
			<label>Price:</label>
			<input type="text" class="form-control" disabled>
		</div>
    </div>
	 <div class="col-md-6 col-md-offset-3 topblank">
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </div>
</form>
<script>
	function selectCity(ele){
		var elename=ele.name=='scity'?'ecity':'scity';
		$('[name="'+elename+'"] option').show()
		$('[name="'+elename+'"] [value="'+ele.value+'"]').hide()
		if($('[name="'+elename+'"]').val()==ele.value){
			$('[name="'+elename+'"]').val('')
		}
	}
</script>
