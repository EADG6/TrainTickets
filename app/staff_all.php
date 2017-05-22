<div class='helptip' id='helptip' style="display:none;">
	<a class='label label-primary'>E</a> Edit /
	<a class='label label-danger'>X</a> Delete /
</div>
<div class="col-md-12">
	<table class="table table-striped">
		<thead>
			<tr>
                <th>Staff ID</th>
                <th>Staff Name</th>
                <th>User Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>
					Operation <a onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icona"></a>
				</th>
              </tr>
        </thead>
		<tbody>
			<?php
				$sql_stf = "SELECT id,CONCAT(fname,' ',lname) AS realname,username,tel,email FROM user";
				$res_stf = $mysql->query($sql_stf);
				while($row_stf = $mysql->fetch($res_stf)){
					echo "<tr>
						<td>".$row_stf['id']."</td>
						<td>".$row_stf['realname']."</td>
						<td>".$row_stf['username']."</td>
						<td>".$row_stf['tel']."</td>
						<td>".$row_stf['email']."</td>
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