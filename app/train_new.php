<form method="post">
<div class="col-md-12">
    <div class="form-group col-md-6">
        <label>Train ID :</label>
        <input type="text" class="form-control form-control-lg" placeholder="Train ID" name="train_id" required> 
    </div>
    <div class="form-group col-md-6">
        <label>Train Type:</label>
			<select class="form-control" name="ttype" onchange='cartype()' required>		
				<?php
					$sql_traintype = "SELECT * FROM train_type";
					$res = $mysql->query($sql_traintype);
					while($row = $mysql->fetch($res)){
						echo "<option value='".$row['id']."'>".$row['type']."</option>";
					}
				?>
			</select>
    </div>
        <div class="form-group col-md-6">
			<label>Departure City:</label>
			<select class="form-control" onchange='selectCity(this);trainTime();countSeat()' name="scity" required>
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
		<div class="form-group col-md-6">
			<label>Destination City:</label>
			<select class="form-control" onchange='selectCity(this);trainTime();countSeat()' name="ecity" required>
				<option value=''>Choose City...</option>
				<?php
					while($row_city = $mysql->fetch($res_city1)){
						echo "<option value='".$row_city['id']."'>".$row_city['city']."</option>";
					}
				?>
			</select>
		</div>
        <div class="form-group col-md-6">
            <label>Start Time :</label>
            <input class="form-control" type="time" name="stime" required>
        </div>
        <div class="form-group col-md-6">
            <label>Hours :</label>
            <input class="form-control" type="number" name="hours" required>
        </div>
    <div class="form-group col-md-12">
        <label class=>Seat Level :</label>
    </div>
    <div class="form-group col-md-6">
        <label>High Seat Carriage</label>
        <input type="number" class="form-control" placeholder="Number of High Seat Carriage" name="hseatca" min=0 max=10 id='car2'> 
    </div>
    <div class="form-group col-md-6">
        <label>Slow Seat Carriage</label>
        <input type="number" class="form-control" placeholder="Number of Slow Seat Carriage" name="sseatca" min=0 max=10 id='car4' disabled> 
    </div>
    <div class="form-group col-md-6">
        <label>Hard Sleeper Carriage</label>
        <input type="number" class="form-control " placeholder="Number of Hard Sleeper Carriage" name="hsleepca" min=0 max=10 id='car5' disabled> 
    </div>
    <div class="form-group col-md-6">
        <label>Soft Sleeper Carriage</label>
        <input type="number" class="form-control" placeholder="Number of Soft Sleeper Carriage" name="ssleepca" min=0 max=10 id='car6' disabled> 
    </div>
	<div class="col-md-6 col-md-offset-3 topblank">
        <button type="submit" class="btn btn-primary btn-block" name='newtrain'>Submit</button>
		<input type="hidden" name='edittid'>
		<input type="hidden" name='carsnums'>
	</div>
</form>
<script src='static/js/train_new.js'></script>
<?php
    if(isset($_POST['newtrain'])){
		$name = inputCheck($_POST['train_id']);
		$start_city_id = inputCheck($_POST['scity']);
            $end_city_id = inputCheck($_POST['ecity']);
            $gotime = inputCheck($_POST['stime']);
            $hours = inputCheck($_POST['hours']);
            $train_type_id = inputCheck($_POST['ttype']);
            $hseatca = isset($_POST['hseatca'])?(int)$_POST['hseatca']:0;
            $sseatca = isset($_POST['sseatca'])?(int)$_POST['sseatca']:0;
            $hsleepca = isset($_POST['hsleepca'])?(int)$_POST['hsleepca']:0;
            $ssleepca = isset($_POST['ssleepca'])?(int)$_POST['ssleepca']:0;
			$origcars = explode(',',$_POST['carsnums']);
			$sql_querytname = "SELECT * FROM train WHERE name = '$name'";
            $res_tname = $mysql->query($sql_querytname);
            $tnamerows= mysql_num_rows($res_tname);
			if(!empty($hseatca+$sseatca+$hsleepca+$ssleepca)){	
				if(empty($_POST['edittid'])){
					if($tnamerows == 1){
						echo"<script>alert('Train ID in Used');location.href='index.php?page=train&action=new';</script>"; 
					}else{
						$sql_newtrain = "INSERT INTO train VALUES('','$name','$start_city_id','$end_city_id','$gotime','$hours','$train_type_id')"; 
						$mysql->query($sql_newtrain);
						$tid = mysql_insert_id();
						if(!empty($hseatca)){
							$sql_hseatca = "INSERT INTO cariage VALUES('','2','$tid','$hseatca')"; 
							$mysql->query($sql_hseatca);
						}
						if(!empty($sseatca)){
							$sql_sseatca = "INSERT INTO cariage VALUES('','4','$tid','$sseatca')"; 
							$mysql->query($sql_sseatca);
						}
						if(!empty($hsleepca)){
							$sql_hsleepca = "INSERT INTO cariage VALUES('','5','$tid','$hsleepca')"; 
							$mysql->query($sql_hsleepca);
						}
						if(!empty($ssleepca)){
							$sql_ssleepca = "INSERT INTO cariage VALUES('','6','$tid','$ssleepca')"; 
							$mysql->query($sql_ssleepca);
						}
						echo "<script>alert('Add New Train Successfully');location.href='index.php?page=train&action=all';</script>";
					}
				}else{
					$tid = $_POST['edittid'];
					$sql_updtrain = "UPDATE train SET name='$name', start_city_id='$start_city_id', end_city_id='$end_city_id', hours='$hours', gotime='$gotime', train_type_id='$train_type_id' WHERE id = $tid";
					$mysql->query($sql_updtrain);
					if($hseatca > $origcars[0]){
						$sql_hseatca = "INSERT INTO cariage VALUES('','2','$tid','$hseatca')"; 
						$mysql->query($sql_hseatca);
					}
					if($sseatca > $origcars[1]){
						$sql_sseatca = "INSERT INTO cariage VALUES('','4','$tid','$sseatca')"; 
						$mysql->query($sql_sseatca);
					}
					if($hsleepca > $origcars[2]){
						$sql_hsleepca = "INSERT INTO cariage VALUES('','5','$tid','$hsleepca')"; 
						$mysql->query($sql_hsleepca);
					}
					if($ssleepca > $origcars[3]){
						$sql_ssleepca = "INSERT INTO cariage VALUES('','6','$tid','$ssleepca')"; 
						$mysql->query($sql_ssleepca);
					}
					echo "<script>alert('Edit Train Successfully');location.href='index.php?page=train&action=all';</script>";
				}
			}else{
				echo "<script>alert('You must add one carriage at least')</script>";
			}
    }else if(isset($_GET['edit'])){
		$editid = inputCheck($_GET['edit']);
		echo "<script>edittrain('$editid')</script>";
	}
?>