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
		<div class="form-group col-md-6">
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
        <input type="number" class="form-control" placeholder="Number of High Seat Carriage" name="hseatca"> 
    </div>
    <div class="form-group col-md-6">
        <label>Slow Seat Carriage</label>
        <input type="number" class="form-control" placeholder="Number of Slow Seat Carriage" name="sseatca" disabled> 
    </div>
    <div class="form-group col-md-6">
        <label>Hard Sleeper Carriage</label>
        <input type="number" class="form-control " placeholder="Number of Hard Sleeper Carriage" name="hsleepca" disabled> 
    </div>
    <div class="form-group col-md-6">
        <label>Soft Sleeper Carriage</label>
        <input type="number" class="form-control" placeholder="Number of Soft Sleeper Carriage" name="ssleepca" disabled> 
    </div>
<div class="col-md-6 col-md-offset-3 topblank">
        <button type="submit" class="btn btn-primary btn-block" name='newtrain'>Submit</button>
</div>
</form>
<script>
	function cartype(){
		if($('[name="ttype"]').val()==1){
			$('[name="hseatca"]').attr('disabled',false);
			$('[name="sseatca"]').attr('disabled',true);
			$('[name="hsleepca"]').attr('disabled',true);
			$('[name="ssleepca"]').attr('disabled',true);
		}else if($('[name="ttype"]').val()==2){
			$('[name="hseatca"]').attr('disabled',true);
			$('[name="sseatca"]').attr('disabled',false);
			$('[name="hsleepca"]').attr('disabled',false);
			$('[name="ssleepca"]').attr('disabled',false);
		}
	}
</script>
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
			if(!empty($hseatca+$sseatca+$hsleepca+$ssleepca)){	
				$sql_newtrain = "INSERT INTO train VALUES('','$name','$start_city_id','$end_city_id','$gotime','$hours','$train_type_id')"; 
				$mysql->query($sql_newtrain);
				$lid = mysql_insert_id();
				if(!empty($hseatca)){
					$sql_hseatca = "INSERT INTO cariage VALUES('','2','$lid','$hseatca')"; 
					$mysql->query($sql_hseatca);
				}
				if(!empty($sseatca)){
					$sql_sseatca = "INSERT INTO cariage VALUES('','4','$lid','$sseatca')"; 
					$mysql->query($sql_sseatca);
				}
				if(!empty($hsleepca)){
					$sql_hsleepca = "INSERT INTO cariage VALUES('','5','$lid','$hsleepca')"; 
					$mysql->query($sql_hsleepca);
				}
				if(!empty($ssleepca)){
					$sql_ssleepca = "INSERT INTO cariage VALUES('','6','$lid','$ssleepca')"; 
					$mysql->query($sql_ssleepca);
				}
				echo "<script>alert('Add New Train Successfully');location.href='index.php?page=train&action=all';</script>"; 
			}else{
				echo "<script>alert('You must add one carriage at least')</script>";
			}
    }
?>