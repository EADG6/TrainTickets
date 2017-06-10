<div class="col-md-12" style='padding-top:20px;padding-bottom:20px;'>
	<div class='col-sm-12'>
		<canvas id="tksalesChart" width="800" height="300"></canvas>
	</div>
	<div class='col-sm-12'>
		<canvas id="popcityChart" width="800" height="300"></canvas>
	</div>
</div>
<script>
	crefinanTrend();
<?php
	$data = array("labels"=>[],"scity"=>[],"ecity"=>[]);
	$sql_scity = "SELECT c.city,temp.num FROM city AS c LEFT JOIN (SELECT start_city_id,COUNT(*) AS num FROM tickets AS tk INNER JOIN cariage AS car ON tk.cariage_id=car.id INNER JOIN train AS t ON car.train_id=t.id GROUP BY t.start_city_id) AS temp ON c.id=temp.start_city_id";
	$res_scity = $mysql->query($sql_scity);
	while($row_scity = $mysql->fetch($res_scity)){
		array_push($data["labels"],$row_scity['city']);
		$num = empty($row_scity['num'])?0:$row_scity['num'];
		array_push($data["scity"],$num);
	}
	$sql_ecity = "SELECT c.city,temp.num FROM city AS c LEFT JOIN (SELECT end_city_id,COUNT(*) AS num FROM tickets AS tk INNER JOIN cariage AS car ON tk.cariage_id=car.id INNER JOIN train AS t ON car.train_id=t.id GROUP BY t.end_city_id) AS temp ON c.id=temp.end_city_id";
	$res_ecity = $mysql->query($sql_ecity);
	while($row_ecity = $mysql->fetch($res_ecity)){
		$num = empty($row_ecity['num'])?0:$row_ecity['num'];
		array_push($data["ecity"],$num);
	}
	$data["labels"] = implode("','",$data["labels"]);
	$data["scity"] = implode(',',$data["scity"]);
	$data["ecity"] = implode(',',$data["ecity"]);
	echo "crepopcity(['".$data['labels']."'],[".$data['scity']."],[".$data['ecity']."]);";
?>
</script>