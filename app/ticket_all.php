<div class='form-group'>
	<div class="panel-group" id="panel-trains">
			<div class="panel  panel-primary">
				<div class="panel-heading" style="height:60px"><h4>
					<div class="col-md-2 text-center">Train</div>
					<div class="col-md-2 text-center">Type</div>
					<div class="col-md-2">Start/End Time</div>
					<div class="col-md-1 text-center">Hours</div>
					<div class="col-md-2 text-center">Departure City</div>
					<div class="col-md-2 text-right">Destination City</div></h4>
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
			<div id="panel-date<?php echo $row_trains['id'];?>" class="panel-collapse collapse">
			<?php
				while($row_date = $mysql->fetch($res_date)){
			?>
				<div>
					<a id="modal-ticket" href="#modal-container-ticket" onclick='ticketinfo(this,"<?php echo $row_trains['id'].'","'.$row_trains['type']?>")' role="button" class="btn" data-toggle="modal"><?php echo $row_date['godate'];?></a>
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
<script>
	/* Check all tickes of a train in a day*/
	function ticketinfo(ele,tid,ttp){
		var tdate = $(ele).html()
		$("#tid_label").html(tid);
		$("#ttp_label").html(ttp);
		$("#tdate_label").html(tdate);
		$.ajax({
			url:'ajax.php',
			data:{"tid":tid,"tdate":tdate},
			type:'POST',
			dataType:'json',
			success:function(data){
				setTimeout(function(){$('#tickets_info').html(data.htmls)},200)
			},
			beforeSend:function(){
				$('#tickets_info').html("<th colspan=8><center><a class='fa fa-refresh fa-3x fa-spin nodeco'></a></center></th>")
			}
		})
	}
	function delTk(id){
		if(confirm("Do you want to delete the ticket?")){
			$.ajax({
				url:'ajax.php',
				data:{"deltkid":id},
				type:'POST',
				success:function(data){
					setTimeout(function(){$('#tk'+id).hide()},500)
				},
				beforeSend:function(){
					$('#tk'+id).html("<th colspan=8><center><a class='fa fa-refresh fa-spin nodeco'></a></center></th>")
				}
			})
		}	
	}
</script>
<div class="modal fadein" id="modal-container-ticket">
	<div class="modal-dialog" style='width:80%'>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">
					Ticket Information
				</h4>
			</div>
			<div class="modal-body">
				<table class ='table table table-striped'>
					<thead>
						<th colspan='9'>
							<span class="col-md-2">Train:<span id='tid_label'></span></span>
							<span class="col-md-2">Type:<span id='ttp_label'></span></span>
							<span class="col-md-2">Date:<span id='tdate_label'></span></span>
						</th>
							<tr>
								<th>Trian</th>
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
					<tbody id='tickets_info'>
					</tbody>
				</table>
			</div>
		</div>					
	</div>				
</div>