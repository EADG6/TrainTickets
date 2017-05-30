


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
                <th>Start City</th>
                <th>End City</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Seat Cariage</th>
                <th>Hard Sleeper City</th>
                <th>Soft Sleeper City</th>
                <th>
					Operation <a onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icona"></a>
				</th>
              </tr>
        </thead>
		<tbody>
			<?php
				$sql_cus = "SELECT t.id,t.name,ty.type,c1.city AS scity,c2.city AS ecity,gotime,DATE_FORMAT(timestampadd(hour,hours,gotime),'%T') AS endtime,hours FROM train AS t INNER JOIN train_type AS ty ON t.train_type_id=ty.id INNER JOIN city AS c1 ON start_city_id=c1.id INNER JOIN city AS c2 ON end_city_id=c2.id ORDER BY id";
				$res_cus = $mysql->query($sql_cus); 
				while($row_cus = $mysql->fetch($res_cus)){
					echo "<tr>
						<td>".$row_cus['name']."</td>
						<td>".$row_cus['type']."</td>
						<td>".$row_cus['scity']."</td>
						<td>".$row_cus['ecity']."</td>
						<td>".$row_cus['gotime']."</td>
						<td>".$row_cus['endtime']."</td>						
						<td>
							<a class='label label-primary' href='index.php?page=customer&action=new&edit=".$row_cus['id']."'>E</a>						
							<a class='label label-danger' onclick=\"if(confirm('Do you want to delete the user and its all tickets?')){location.href='index.php?page=customer&action=all&del=".$row_cus['id']."'}\">X</a>
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