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
                <th>ID Card</th>
                <th>Native Place</th>
                <th>
					Operation <a onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icona"></a>
				</th>
              </tr>
        </thead>
		<tbody>
			<?php  // Select information from customer table, and use while loop to output customer information
				$sql_cus = "SELECT id,CONCAT(firstname,' ',lastname) AS realname,CASE WHEN sex=1 THEN 'Male' WHEN sex=2 THEN 'Female' WHEN sex=0 THEN 'Unknown' END AS sex,year(from_days(datediff(now(),birthdate))) AS age,tel,IDcard,birthplace FROM customer";
				$res_cus = $mysql->query($sql_cus);
				while($row_cus = $mysql->fetch($res_cus)){
					echo "<tr>
						<td>".$row_cus['id']."</td>
						<td>".$row_cus['realname']."</td>
						<td>".$row_cus['sex']."</td>
						<td>".$row_cus['tel']."</td>
						<td>".$row_cus['age']."</td>
						<td>".$row_cus['IDcard']."</td>
						<td>".$row_cus['birthplace']."</td>
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
<?php	// delete the customer and tickets
	if(isset($_GET['del'])){
		$delid = inputCheck($_GET['del']);
		$sql_delcustk = "DELETE FROM tickets WHERE cus_id = '$delid'";
		$sql_delcus = "DELETE FROM customer WHERE id = '$delid'";
		$mysql->query($sql_delcustk);
		$mysql->query($sql_delcus);
		redirect('index.php?page=customer&action=all','Delete customer and its tickets successfully!');
	}
?>