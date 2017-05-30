<form method="post">
<div class="col-md-12">
    <div class="form-group col-md-6">
        <label class="my-4">Train ID :</label>
        <input type="text" class="form-control form-control-lg" placeholder="Train ID" name="train_id" required> 
    </div>
    <div class="form-group col-md-6">
        <label>Train Type:</label>
			<input type="hidden" name="tid" id="tid" required/>
			<select class="form-control" name='ttype' onchange='' required>		
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
            <label>hours :</label>
            <input class="form-control" type="text" name="hours" required>
        </div>
    <div class="form-group col-md-12">
        <label class=>Seat Level :</label>
    </div>
    <div class="form-group col-md-6">
        <label class="my-4">High Seat Carriage</label>
        <input type="text" class="form-control form-control-lg" placeholder="Number of High Seat Carriage" name="hseatca"> 
    </div>
    <div class="form-group col-md-6">
        <label class="my-4">Slow Seat Carriage</label>
        <input type="text" class="form-control form-control-lg" placeholder="Number of Slow Seat Carriage" name="sseatca"> 
    </div>
    <div class="form-group col-md-6">
        <label class="my-4">Hard Sleeper Carriage</label>
        <input type="text" class="form-control form-control-lg" placeholder="Number of Hard Sleeper Carriage" name="hsleepca"> 
    </div>
    <div class="form-group col-md-6">
        <label class="my-4">Soft Sleeper Carriage</label>
        <input type="text" class="form-control form-control-lg" placeholder="Number of Soft Sleeper Carriage" name="ssleepca"> 
    </div>
<div class="col-md-6 col-md-offset-3 topblank">
        <button type="submit" class="btn btn-primary btn-block" name='newtrain'>Submit</button>
</div>
</form>
<?php
    if(isset($_POST['newtrain'])){
			$name = inputCheck($_POST['train_id']);
            $start_city_id = inputCheck($_POST['scity']);
            $end_city_id = inputCheck($_POST['ecity']);
            $gotime = inputCheck($_POST['stime']);
            $hours = inputCheck($_POST['hours']);
            $train_type_id = inputCheck($_POST['ttype']);
            $hseatca = inputCheck($_POST['hseatca']);
            $sseatca = inputCheck($_POST['sseatca']);
            $hsleepca = inputCheck($_POST['hsleepca']);
            $ssleepca = inputCheck($_POST['ssleepca']);
            $sql = "SELECT * FROM train WHERE name = '$name'";
            $query = $mysql->query("$sql");
            $rows = mysql_num_rows($query);
	        if ($rows ==1){
			 echo"<script>alert('Train ID in Using');location.href='index.php?page=train&action=new';</script>"; 
		  }else{
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
            echo"<script>alert('Add New Train Successful');location.href='index.php?page=train&action=all';</script>"; 
            }
    }
?>