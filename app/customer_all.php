<div class='helptip' id='helptip' style="display:none;">
	<a class='label label-primary'>E</a> Edit /
	<a class='label label-danger'>X</a> Delete /
</div>
<div class="col-md-12">
	<table class="table table-striped">
		<thead>
			<tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Gender</th>
                <th>Phone Number</th>
                <th>Age</th>
                <th>
					Operation <a onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icona"></a>
				</th>
              </tr>
        </thead>
		<tbody>
			<?php
				$sql_cus = "SELECT id,CONCAT(firstname,' ',lastname) AS realname,CASE WHEN sex=1 THEN 'Male' WHEN sex=2 THEN 'Female' WHEN sex=0 THEN 'Unknown' END AS sex,year(from_days(datediff(now(),birthdate))) AS age,tel FROM customer";
				$res_cus = $mysql->query($sql_cus);
				while($row_cus = $mysql->fetch($res_cus)){
					echo "<tr>
						<td>".$row_cus['id']."</td>
						<td>".$row_cus['realname']."</td>
						<td>".$row_cus['sex']."</td>
						<td>".$row_cus['tel']."</td>
						<td>".$row_cus['age']."</td>
						<td>
							<a class='label label-primary' onclick=''>E</a>						
							<a class='label label-danger' onclick=''>X</a>
						</td>
					</tr>";
				}	
			?>
        </tbody>
    </table>
</div>