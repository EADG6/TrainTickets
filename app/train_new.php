<form method="post">
<div class="col-md-12">
    <div class="form-group col-md-6">
        <label class="my-4">Train ID :</label>
        <input type="text" class="form-control form-control-lg" placeholder="Enter Train ID" name="train_id"> 
    </div>
    <div class="form-group col-md-6">
        <label>Train Type: <span id='trainSelected'></span></label>
			<input type="hidden" name="tid" id="tid" required/>
			<select class="form-control" name='ttype' onchange='trainTime()' required>		
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
        <label class="my-4">High Seat Cariage</label>
        <input type="text" class="form-control form-control-lg" placeholder="Enter Number of High Seat Cariage" name="hseatca"> 
    </div>
    <div class="form-group col-md-6">
        <label class="my-4">Slow Seat Cariage</label>
        <input type="text" class="form-control form-control-lg" placeholder="Enter Number of Slow Seat Cariage" name="sseatca"> 
    </div>
    <div class="form-group col-md-6">
        <label class="my-4">Hard Sleeper Cariage</label>
        <input type="text" class="form-control form-control-lg" placeholder="Enter Number of Hard Sleeper Cariage" name="hsleepca"> 
    </div>
    <div class="form-group col-md-6">
        <label class="my-4">Soft Sleeper Cariage</label>
        <input type="text" class="form-control form-control-lg" placeholder="Enter Number of Soft Sleeper Cariage" name="ssleepca"> 
    </div>
<div class="col-md-6 col-md-offset-3 topblank">
        <button type="submit" class="btn btn-primary btn-block" name='newtrain'>Submit</button>
</div>
</form>
<?php
    if(isset($_POST['newtrain'])){
			$name = $_POST['train_id'];
            $start_city_id = $_POST['scity'];
            $end_city_id = $_POST['ecity'];
            $gotime = $_POST['stime'];
            $hours = $_POST['hours'];
            $train_type_id = $_POST['ttype'];
            $hseatca = $_POST['hseatca'];
            $sseatca = $_POST['sseatca'];
            $hsleepca = $_POST['hsleepca'];
            $ssleepca = $_POST['ssleepca'];
        if($start_city_id=="" || $end_city_id==""|| $train_type_id=="") {  
		echo"<script type='text/javascript'>alert('write all the information');location='index.php?page=ticket&action=new';  
            </script>";
        }else{
            $sql_newtrain = "INSERT INTO train VALUES('','$name','$start_city_id','$end_city_id','$gotime','$hours','$train_type_id')"; 
            echo $sql_newtrain;
            $mysql->query($sql_newtrain);
            $query="SELECT LAST_INSERT_ID()";
            $result=mysql_query($query);
            $rows=mysql_fetch_row($result);
            $sql_hseatca = "INSERT INTO cariage VALUES('','2','$rows','$hseatca')"; 
            $mysql->query($sql_hseatca);
            $sql_sseatca = "INSERT INTO cariage VALUES('','4','$rows','$sseatca')"; 
            $mysql->query($sql_sseatca);
            $sql_hsleepca = "INSERT INTO cariage VALUES('','5','$rows','$hsleepca')"; 
            $mysql->query($sql_hsleepca);
            $sql_ssleepca = "INSERT INTO cariage VALUES('','6','$rows','$ssleepca')"; 
            $mysql->query($sql_ssleepca);
            echo"<script type='text/javascript'>alert('Add New Train Successful');location='index.php?page=train&action=all';</script>"; 
        }
    }
?>