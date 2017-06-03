<div class='helptip' id='helptip' style="display:none;">
	<a class='label label-primary'>E</a> Edit /
	<a class='label label-danger'>X</a> Delete /
</div>
<div class="col-md-12">
	<div class='col-md-3 form-group'>
		<form method="post" id='dayquery'>
			<input type='month' class="form-control" name='tdate' value="<?php echo isset($_POST['tdate'])?inputCheck($_POST['tdate']):date('Y-m',time());?>" onchange="$('#dayquery').submit()">
		</form>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Payment</th>
              </tr>
        </thead>
		<tbody>
			<?php  // select cutomer name freom customer table and count whole payment
				$date = isset($_POST['tdate'])?$_POST['tdate'].'-01':date('Y-m-d',time());
				$sql_cus = "SELECT c.id,CONCAT(firstname,' ',lastname) AS realname,SUM(t.price) AS payment FROM customer AS c INNER JOIN tickets AS t ON c.id=t.cus_id WHERE MONTH(t.godate)=Month('$date') AND YEAR(t.godate)=YEAR('$date') GROUP BY t.cus_id ORDER BY payment DESC";
				$res_cus = $mysql->query($sql_cus);
				$cus_lab = [];
				$date_lab = substr($date,0,strlen($date)-3);
				$data = [];
				while($row_cus = $mysql->fetch($res_cus)){
					echo "<tr>
						<td>".$row_cus['id']."</td>
						<td>".$row_cus['realname']."</td>
						<td>".$row_cus['payment']."</td>
					</tr>";
					array_push($cus_lab,$row_cus['realname']);
					array_push($data,$row_cus['payment']);
				}
				if(mysql_num_rows($res_cus)==0){
					echo "<tr><td colspan=3 class='alert alert-warning text-center'>No ticktes in the day</td></tr>";
				}
				$cus_lab = implode("','",$cus_lab);
				$data = implode(',',$data);
				echo "<script>$(document).ready(function(){creCusChart(['$cus_lab'],[$data],'$date_lab');})</script>";
			?>
        </tbody>
    </table>
</div>
<div class="col-md-8 col-md-offset-2" id='cusrep'>
	<canvas id="cusrepChart" width="400"></canvas>
</div>