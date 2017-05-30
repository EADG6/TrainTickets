<div class='helptip' id='helptip' style="display:none;">
	<a class='label label-primary'>E</a> Edit /
	<a class='label label-danger'>X</a> Delete /
</div>
<div class="col-md-12">
	<table class="table table-striped">
		<thead>
			<tr>
                <th>Trans</th>
                <th>Type</th>
                <th>Departure</th>
                <th>Destination</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Hours</th>
                <th>Seat Carriage (Capacity)</th>
                <th>Hard Sleeper Carriage (Capacity)</th>
                <th>Soft Sleeper Carriage (Capacity)</th>
                <th>
					Operation <a onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icona"></a>
				</th>
              </tr>
        </thead>
		<tbody>
			<?php
				$sql_train = "SELECT t.id,t.name,ty.type,c1.city AS scity,c2.city AS ecity,gotime,DATE_FORMAT(timestampadd(hour,hours,gotime),'%T') AS endtime,hours FROM train AS t INNER JOIN train_type AS ty ON t.train_type_id=ty.id INNER JOIN city AS c1 ON start_city_id=c1.id INNER JOIN city AS c2 ON end_city_id=c2.id ORDER BY id";
				$res_train = $mysql->query($sql_train); 
				while($row_train = $mysql->fetch($res_train)){
					echo "<tr>
						<td>".$row_train['name']."</td>
						<td>".$row_train['type']."</td>
						<td>".$row_train['scity']."</td>
						<td>".$row_train['ecity']."</td>
						<td>".$row_train['gotime']."</td>
						<td>".$row_train['endtime']."</td>
						<td>".$row_train['hours']."</td>";
					$sql_carnums = "SELECT seats_level,COUNT(*) AS carnum,CONCAT(COUNT(*),'*',s.capacity,'=',COUNT(*)*s.capacity) AS cap FROM cariage AS c INNER JOIN seats_type AS s ON c.cariage_type_id = s.id WHERE train_id = '".$row_train['id']."' GROUP BY cariage_type_id ORDER BY s.id";
					$res_car = $mysql->query($sql_carnums);
					$carinfo = array('Seat'=>0,'Hard Sleeper'=>0,'Soft Sleeper'=>0);
					while($row_car = $mysql->fetch($res_car)){
						$carinfo[$row_car['seats_level']] = $row_car['carnum'].' ('.$row_car['cap'].')';
					}	
					echo "<td>".$carinfo['Seat']."</td>
						<td>".$carinfo['Hard Sleeper']."</td>
						<td>".$carinfo['Soft Sleeper']."</td>";
					echo"<td>
							<a class='label label-primary' href='index.php?page=train&action=new&edit=".$row_train['id']."'>E</a>						
							<a class='label label-danger' href='#modal-container-1' data-toggle='modal' onclick=$('[name=\"delid\"]').val(".$row_train['id'].")>X</a>	
						</td>
					</tr>";
				}	
			?>
        </tbody>
    </table>
</div>
<!-- Delete Train Form -->
			<div class="modal fade" id="modal-container-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h1 class="modal-title text-center" id='popFormLabel'>
								Delete Train
							</h1>
						</div>
						<div class="modal-body">	
							<div class="alert alert-danger">
								This operation will delete the train and its all carriages and tickets!
							</div>
							<form method='post'>
								<div class="form-group">
									<label>Please Verify Your Password...</label>
									<input type='password' name='cfpwd' class="form-control" required/>
									<kbd class='seepwd' onmousedown="seepwd('cfpwd')"><i class='fa fa-eye'></i></kbd>
								</div>
								<input type='hidden' name='delid'/>
								<br/><button type='submit' class='btn btn-danger btn-block' style='padding-right:0;'/>Delete</button>
							</form>
						</div>
					</div>	
				</div>
			</div>
<?php
	if(isset($_POST['delid'])){
		$pwdres = $mysql->fetch($mysql->query("SELECT pwd,salt FROM user WHERE id = {$_SESSION['userid']}"));
		$inputpwd = MD5($_POST['cfpwd'].$pwdres['salt']);
		if($inputpwd==$pwdres['pwd']){
			$delid = inputCheck($_POST['delid']);
			$sql_deltk = "DELETE FROM tickets WHERE cariage_id IN (SELECT id FROM cariage WHERE train_id = '$delid')";
			$sql_delcar = "DELETE FROM cariage WHERE train_id = '$delid'";
			$sql_deltrain = "DELETE FROM train WHERE id = '$delid'";
			$mysql->query($sql_deltk);
			$mysql->query($sql_delcar);
			$mysql->query($sql_deltrain);
			redirect('index.php?page=train&action=all','Delete train and its carriage and tickets successfully!');
		}else{
			echo "<script>alert('Wrong Password')</script>";
		}
	}
?>