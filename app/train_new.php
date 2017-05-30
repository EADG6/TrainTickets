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
    </div>
    <div class="form-group col-md-6">
        <div class="form-group col-md-6">
            <label>Start Time :</label>
            <input class="form-control" type="time" name="stime" required>
        </div>
        <div class="form-group col-md-6">
            <label>hours :</label>
            <input class="form-control" type="text" name="hours" required>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label class=>Seat Level :</label>
    </div>
    <div class="form-group col-md-3">
        <label>High Seat Cariage</label>
            <select name="hseatca" class="form-control">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
            </select>
    </div>
    <div class="form-group col-md-3">
        <label>Slow Seat Cariage</label>
            <select name="sseatca" class="form-control">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
            </select>
    </div>
    <div class="form-group col-md-3">
        <label>Hard Sleeper Cariage</label>
        <select name="hsleepca" class="form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label>Soft Sleeper Cariage</label>
        <select name="ssleepca" class="form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
        </select>
    </div> 
</div>
<div class="col-md-12 center-block">
    <div class="col-md-4" style="margin:0 auto;width:200px;">
        <button href="#" class="btn btn-primary form-control">Update</button>
    </div>
</div>
</form>
<?php
    if(isset($_POST['train_id'])){
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