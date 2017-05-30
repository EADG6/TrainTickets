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
                <th>Seat Cariage (Capacity)</th>
                <th>Hard Sleeper Cariage (Capacity)</th>
                <th>Soft Sleeper Cariage (Capacity)</th>
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
							<a class='label label-primary' href='index.php?page=customer&action=new&edit=".$row_train['id']."'>E</a>						
							<a class='label label-danger' onclick=\"if(confirm('Do you want to delete the user and its all tickets?')){location.href='index.php?page=customer&action=all&del=".$row_train['id']."'}\">X</a>
						</td>
					</tr>";
				}	
			?>
        </tbody>
    </table>
</div>
<?php
	if(isset($_GET['del'])){
		$delid = inputCheck($_GET['del']);
		$sql_delcustk = "DELETE FROM tickets WHERE cus_id = '$delid'";
		$sql_delcus = "DELETE FROM customer WHERE id = '$delid'";
		$mysql->query($sql_delcustk);
		$mysql->query($sql_delcus);
		redirect('index.php?page=customer&action=all','Delete customer and its tickets successfully!');
	}
?>