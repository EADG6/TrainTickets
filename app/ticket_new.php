<form method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label>Start City:</label>
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
			<label>End City:</label>
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
			<label>Date:</label>
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
			<input type="text" class="form-control" disabled>
		</div>
		<div class="form-group">
			<label>Customer Name:</label>
			<input type="text" class="form-control" id="cusname" disabled>
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
<script>
/* Avoid same start/end city */
	function selectCity(ele){
		var elename=ele.name=='scity'?'ecity':'scity';
		$('[name="'+elename+'"] option').attr('disabled',false)
		$('[name="'+elename+'"] [value="'+ele.value+'"]').attr('disabled',true)
		if($('[name="'+elename+'"]').val()==ele.value)$('[name="'+elename+'"]').val('')
		trainTime()
	}
/* Count ticket price */
	function countPrice(){
		ele = $('[name="level"]').val();
		if(ele!=null){
			$("#price").val(parseInt(ele.split(",")[1])*$("#hours").val()+'RMB')
		}
	}
/* use ajax to check train time */
	function trainTime(){
		scityid = $('[name="scity"]').val();
		ecityid = $('[name="ecity"]').val();
		$.ajax({
			url:'ajax.php',
			data:{"scityid":scityid,"ecityid":ecityid},
			type:'POST',
			dataType:'json',
			success:function(data){
				var level = $('[name="level"] option');
				level.attr('disabled',true)
				if(data.error==1){
					$('#stime').val('No train between these two cities')
					$('#etime').val('No train between these two cities')
					$('#trainSelected').html('')
					$("#price").val(0)
				}else{
					var standid = data.type==1? 1:3;
					for(var i=1;i<level.length;i++){
						var sid = level[i].value.split(",")[0];
						if(data.train.seat_type.indexOf(sid)!=-1||sid==standid){
							level[i].disabled = false;
						}
					}
					$('#stime').val(data.start)
					$('#etime').val(data.end+' /'+data.hours+' Hours')
					$("#hours").val(data.hours)
					$('#trainSelected').html('('+data.train.tname+')')
					countPrice()
				}
			},
			beforeSend:function(){
			/* 	$('[name="username"]').next().attr('class','seepwd btn-warning')
				$('[name="username"]').next().children('i').attr('class','fa fa-spinner fa-spin') */
			}
		});
	}
/* Date must later than tomorrow */
	function checkDate(){
		reqDate = document.getElementsByName('date')[0].valueAsDate
		if(reqDate < new Date().getTime()){
			alert("The test drive request time must later than today");
			$('[name="date"]').val('')
			$('#subbtn').attr('disabled',true)
		}else{
			$('#subbtn').attr('disabled',false)
		}
	}
</script>
<?php
	if(isset($_POST['scity'])){
		$scity = $_POST['scity'];
		$ecity = $_POST['ecity'];
		$seat_level = explode(',',$_POST['level'])[0];
		$cusid = $_POST['cusid'];
		$tdate = $_POST['date'];
		
	}
?>
