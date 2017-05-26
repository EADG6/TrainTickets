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
                <th>Role</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>
					Operation <a onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icona"></a>
				</th>
              </tr>
        </thead>
		<tbody>
			<?php
				$sql_stf = "SELECT u.id,CONCAT(fname,' ',lname) AS realname,username,tel,email,r.name AS role FROM user AS u INNER JOIN role AS r ON u.role_id=r.id";
				$res_stf = $mysql->query($sql_stf);
				while($row_stf = $mysql->fetch($res_stf)){
					echo "<tr>
						<td>".$row_stf['id']."</td>
						<td>".$row_stf['realname']."</td>
						<td>".$row_stf['username']."</td>
						<td>".$row_stf['role']."</td>
						<td>".$row_stf['tel']."</td>
						<td>".$row_stf['email']."</td>
						<td>
							<a class='label label-primary' href='index.php?page=staff&action=new&edit=".$row_stf['id']."'>E</a>						
							<a class='label label-danger' onclick=\"if(confirm('Do you want to delete the user?')){location.href='index.php?page=staff&action=all&del=".$row_stf['id']."'}\">X</a>
						</td>
					</tr>";
				}	
			?>
        </tbody>
    </table>
</div>
<?php
	if(isset($_GET['del'])){
		$deluserid = inputCheck($_GET['del']);
		$sql_deluser = "DELETE FROM user WHERE id = '$deluserid'";
		$mysql->query($sql_deluser);
		redirect('index.php?page=staff&action=all','Delete user successfully!');
	}
?>