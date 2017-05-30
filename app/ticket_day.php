<div class='helptip' id='helptip' style="display:none;">
	<a class='label label-primary'>E</a> Edit /
	<a class='label label-danger'>X</a> Delete /
</div>
<div class="col-md-12">
	<div class='col-md-3 form-group'>
		<form method="post" id='dayquery'>
			<input type='date' class="form-control" name='tdate' value="<?php echo isset($_POST['tdate'])?inputCheck($_POST['tdate']):'2017-05-07';?>" onchange="$('#dayquery').submit()">
		</form>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
                <th>Train</th>
				<th>Time</th>
				<th>Hours</th>
				<th>Price</th>
				<th>Customer</th>
				<th>Seats</th>
				<th>Carriage</th>
                <th>
					Operation <a onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icona"></a>
				</th>
              </tr>
        </thead>
		<tbody>
		<?php
			$date = isset($_POST['tdate'])?inputCheck($_POST['tdate']):'2017-05-07';
			$now = strtotime(date('Y-m-d',time()));
			$sql_tkinfo = "SELECT tk.id,t.name AS train,ty.type,c1.city AS scity,c2.city AS ecity,tk.cariage_id,car.train_cariage_num,CONCAT(firstname,' ',lastname) AS realname,tk.seat_id,CASE WHEN tk.isstand=0 THEN stp.seats_level WHEN tk.isstand=1 THEN 'Stand' END AS seats_level,tk.godate,CONCAT (gotime,'-',DATE_FORMAT(timestampadd(hour,hours,gotime),'%T')) AS time,hours,stp.price*hours AS price FROM tickets AS tk 
			INNER JOIN cariage AS car ON tk.cariage_id=car.id INNER JOIN train AS t ON car.train_id=t.id INNER JOIN train_type AS ty ON t.train_type_id=ty.id INNER JOIN city AS c1 ON start_city_id=c1.id INNER JOIN city AS c2 ON end_city_id=c2.id INNER JOIN customer AS cus ON tk.cus_id=cus.id INNER JOIN seats_type AS stp ON car.cariage_type_id=stp.id WHERE godate = '$date' ORDER BY id";
			$res = $mysql->query($sql_tkinfo);
			while($row = $mysql->fetch($res)){
				$delfunc = $now>strtotime($date)?"delTk(".$row['id'].")":"alert(\"You can only delete history tickets\")";
				$editfunc = $now>strtotime($date)?'javascript:alert("You cannot edit history tickets")':"index.php?page=ticket&action=new&edit=".$row['id'];
				echo "<tr id='tk".$row['id']."'><td>".$row['train']."(".$row['type'].")</td>
					<td>".$row['time']."</td>
					<td>".$row['hours']."</td>
					<td>".$row['price']."&#165;</td>
					<td>".$row['realname']."</td>
					<td>".$row['seats_level'].'-'.$row['seat_id']."</td>
					<td>No.".$row['train_cariage_num']."-".$row['cariage_id']."</td>
					<td>
						<a class='label label-primary' href='$editfunc'>E</a>					
						<a class='label label-danger' onclick='$delfunc'>X</a>
					</td>
				</tr>";
			}
			if(mysql_num_rows($res)==0){
				echo "<tr><td colspan=8 class='alert alert-warning text-center'>No ticktes in the day</td></tr>";
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