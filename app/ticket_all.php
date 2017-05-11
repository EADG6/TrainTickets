<div class='form-group'>
	<div class="panel-group" id="panel-trains">
			<div class="panel  panel-primary">
				<div class="panel-heading" style="height:60px"><h4>
					<div class="col-md-2 text-center">Train</div>
					<div class="col-md-2 text-center">Type</div>
					<div class="col-md-2">Start/End Time</div>
					<div class="col-md-1 text-center">Hours</div>
					<div class="col-md-2 text-center">Start City</div>
					<div class="col-md-2 text-right">End City</div></h4>
				</div>
			</div>
		<div class="panel panel-default" style='margin-top:0px;'>
		<?php
			$sql_trains = "SELECT t.id,t.name,ty.type,c1.city AS scity,c2.city AS ecity,gotime,DATE_FORMAT(timestampadd(hour,hours,gotime),'%T') AS endtime,hours FROM train AS t INNER JOIN train_type AS ty ON t.train_type_id=ty.id INNER JOIN city AS c1 ON start_city_id=c1.id INNER JOIN city AS c2 ON end_city_id=c2.id ORDER BY id";
			$res_trains = $mysql->query($sql_trains);
			while($row_trains = $mysql->fetch($res_trains)){	
				$sql_date = "SELECT godate,COUNT(*) AS num FROM tickets AS t INNER JOIN cariage AS c ON t.cariage_id=c.id WHERE train_id=".$row_trains['id']." GROUP BY godate";
				$res_date = $mysql->query($sql_date);
				$num = mysql_num_rows($res_date);
		?>
			<div class="panel-heading" onclick="$('#ticket<?php echo $row_trains['id'];?>')[0].click()">
				<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-trains" id="ticket<?php echo $row_trains['id'];?>" href="#panel-date<?php echo $row_trains['id'];?>" style="text-decoration:none;">
					<div class="col-md-2 text-center"><?php echo $row_trains['name'];?></div>
					<div class="col-md-2 text-center"><?php echo $row_trains['type'];?></div>
					<div class="col-md-2"><?php echo $row_trains['gotime'].'-'.$row_trains['endtime'];?></div>
					<div class="col-md-1 text-center"><?php echo $row_trains['hours'];?></div>
					<div class="col-md-2 text-center"><?php echo $row_trains['scity'];?></div>
					<div class="col-md-2 text-right"><?php echo $row_trains['ecity'];?></div>
				</a><span class='caret' <?php echo $num==0?"style='visibility:hidden'":'';?>></span>
			</div>
			<input type='hidden' id='tid' value="<?php echo $row_trains['id'];?>">
			<div id="panel-date<?php echo $row_trains['id'];?>" class="panel-collapse collapse">
			<?php
				while($row_date = $mysql->fetch($res_date)){
			?>
				<div>
					<a id="modal-ticket" href="#modal-container-ticket" onclick='$("#test").html($("#tid").val());$("#test1").html($(this).html())' role="button" class="btn" data-toggle="modal"><?php echo $row_date['godate'];?></a>
				</div>									
			<?php
				}
			?>
			</div>	
		<?php
			}
		?>
		</div>
	</div>
</div> 
<div class="modal fadein" id="modal-container-ticket">
	<div class="modal-dialog" style='width:80%'>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close">×</button>
				<h4 class="modal-title" id="myModalLabel">
					Ticket Management
				</h4>
			</div>
			<div class="modal-body">
				<table class ='table table table-striped'>
					<thead>
						<th colspan='9'>trainid:<span id='test'></span>date:<span id='test1'></span>Ticket Information</th>
							<tr>
								<th>TrianID</th>
								<th>Time</th>
								<th>Hours</th>
								<th>Price</th>
								<th>Customer</th>
								<th>Seats</th>
								<th>Carriage</th>
								<th>
									Operation <a href='javascript:void(0);' onclick="$('#helptip1').toggle()" class="glyphicon glyphicon-question-sign icona"></a>
								</th>
							</tr>
						</thead>
					<tbody>
					<th>DH389</th>
					<th>8:00-20:00</th>
					<th>12h</th>
					<th>300￥</th>
					<th>John</th>
					<th>Stand</th>
					<th>1</th>
					<th>
						EDIT  DELETE
					</th>	
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary">Save</button>
			</div>
		</div>					
	</div>				
</div>