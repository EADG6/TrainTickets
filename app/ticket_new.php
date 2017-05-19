<form method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label>Departure City:</label>
			<select class="form-control" onchange='selectCity(this)' name="scity" required>
				<option value=''>Choose City...</option>
				<?php
					$sql_allcity = "SELECT * FROM city";
					$res_city = $mysql->query($sql_allcity);
					$res_city1 = $mysql->query($sql_allcity);
					while($row_city = $mysql->fetch($res_city)){
						echo "<option value='".$row_city['id']."'>".$row_city['city']."</option>";
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label>Destination City:</label>
			<select class="form-control" onchange='selectCity(this)' name="ecity" required>
				<option value=''>Choose City...</option>
				<?php
					while($row_city = $mysql->fetch($res_city1)){
						echo "<option value='".$row_city['id']."'>".$row_city['city']."</option>";
					}
				?>
			</select>
		</div>
        <div class="form-group">
			<label>Seat Level: <span id='trainSelected'></span></label>
			<input type="hidden" id='tid' name='tid'>
			<select class="form-control" name="level" onchange='countPrice()' required >
				<option value=''>Select a Level...</option>
				<?php
					$sql_seatlevel = "SELECT CONCAT(s.id,',',price,',',capacity) AS info,CONCAT(seats_level,' - ',type,' - ',price,'RMB') AS level FROM seats_type AS s INNER JOIN train_type AS t ON s.train_type_id=t.id";
					$res = $mysql->query($sql_seatlevel);
					while($row = $mysql->fetch($res)){
						echo "<option value='".$row['info']."' disabled>".$row['level']."</option>";
					}
				?>
			</select>
		</div>
		<label>Customer ID:</label>
        <div class="form-group input-group">
			<input class="form-control" name="cusid" placeholder="Search Customer Phone/Name" list="cuslist" onchange="try{$('#cusname').val($('#cuslist [value='+this.value+']').html().split('/')[0])}catch(err){this.value=''}" autocomplete='off' required>
			<span class="input-group-btn">  			  
				<button type="button" class="btn btn-primary btn-search" style="margin-left:3px" onclick="$('[name=\'cusid\']').val('')">Clear</button>  
			</span>
		</div>
		<datalist id="cuslist">
		<?php
			$sql_cus = "SELECT id,CONCAT(firstname,' ',lastname,' / ',CASE WHEN sex=0 THEN 'Unknown' WHEN sex=1 THEN 'Male' WHEN sex=2 THEN 'Female' END,' / ',tel) AS info FROM customer";
			$res = $mysql->query($sql_cus);
			while($row = $mysql->fetch($res)){
				echo "<option value='".$row['id']."'>".$row['info']."</option>";
			}
		?>
		</datalist>
        <div class="form-group">
			<label>Departure Date:</label>
			<input type="date" class="form-control" name="date" onchange="checkDate()" required>
		</div>
    </div>
    <div class="col-md-6">
		<div class="form-group">
			<label>Start time:</label>
			<input type="text" class="form-control" id='stime' disabled>
		</div>
		<div class="form-group">
			<label>End time:</label>
			<input type="text" class="form-control" id='etime' disabled>
			<input type="hidden" value=0 id='hours'>
		</div>
		<div class="form-group">
			<label>Seat Ramain:</label>
			<input type="text" class="form-control" id='remain' disabled>
			<input type="hidden" name='remain'>
		</div>
		<div class="form-group">
			<label>Customer Name:</label>
			<input type="text" class="form-control" id='cusname' disabled>
		</div>
		<div class="form-group">
			<label>Price (Level * Time):</label>
			<input type="text" class="form-control" id='price' value=0 disabled>
		</div>
    </div>
	 <div class="col-md-6 col-md-offset-3 topblank">
        <button type="submit" class="btn btn-primary btn-block" id='subbtn' disabled>Submit</button>
    </div>
</form>
<script type="text/javascript" src="static/js/ticketsell.js"></script>
<?php
	if(isset($_POST['tid'])){
		if(!empty($_POST['tid'])){
			$tid = $_POST['tid'];
			$seat_level = explode(',',$_POST['level'])[0];
			$cusid = $_POST['cusid'];
			$tdate = $_POST['date'];
			$remain = explode(',',$_POST['remain'])[0];
			$cap = explode(',',$_POST['remain'])[1];
			$n = intval($remain/$cap);
			if($remain == $n*$cap){
				$newid = 1;
				$n = 1;
			}else{
				$newid = $cap-($remain-$n*$cap)+1;
			}
			if($seat_level==1||$seat_level==3){
				$seat_level++;
				$isstand = 1;
			}else{
				$isstand = 0;
			}
			$cariages = [];
			$sql_cariages = "SELECT id,train_cariage_num FROM cariage WHERE train_id = $tid AND cariage_type_id = $seat_level";
			$res_car = $mysql->query($sql_cariages);
			while($row_car = $mysql->fetch($res_car)){
				array_push($cariages,['id'=>$row_car['id'],'car_num'=>$row_car['train_cariage_num']]);
			}
			$cariage_id = $cariages[$n-1]['id'];
			$cariage_num = $cariages[$n-1]['car_num'];
			$sql_newTicket = "INSERT tickets VALUES('',$cusid,$isstand,'$tdate',$cariage_id,$newid)";
			$mysql->query($sql_newTicket);
			echo "<script>if(!confirm('Create Ticket Successfully! \\nCustomer: $cusid \\nisStand: $isstand \\nDate: $tdate \\nTrainID: $tid \\nTrainCarId: $cariage_num \\nCariageID: $cariage_id \\nSeatID: $newid \\nSeatLevel: $seat_level\\nDo you want to continue to add more ticket or cancel to check all tickets?'))
				{location.href='index.php?page=ticket&action=all'}
			</script>";
		}else{
			echo "<script>alert('No train selected')</script>";
		}
		
	}
?>
