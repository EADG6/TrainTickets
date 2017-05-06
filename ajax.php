<?php
	require "inc/db.php";
	if(isset($_POST['scityid'])){
		$traininfo = ['train'=>['tname'=>'','seat_type'=>[]],'start'=>'','end'=>'','hours'=>'','type'=>'','error'=>0];
		$scityid = $_POST['scityid'];
		$ecityid = $_POST['ecityid'];
		$sql_findTrain = "SELECT *,DATE_FORMAT(timestampadd(hour,hours,gotime),'%T') AS endtime FROM train WHERE start_city_id = $scityid AND end_city_id = $ecityid";
		$res = $mysql->query($sql_findTrain);
		if(mysql_num_rows($res)>0){
			while($row = $mysql->fetch($res)){
				$traininfo['start'] = $row['gotime'];
				$traininfo['hours'] = $row['hours'];
				$traininfo['end'] = $row['endtime'];
				$traininfo['type'] = $row['train_type_id'];
				$traininfo['train']['tname'] = $row['name'];
				$sql_seatinfo = "SELECT c.id,s.id AS seat_type_id,CONCAT(tr.name,'/',t.type,' - ',s.seats_level) AS train FROM cariage AS c INNER JOIN seats_type AS s ON c.cariage_type_id=s.id INNER JOIN train_type AS t ON s.train_type_id=t.id INNER JOIN train AS tr ON c.train_id=tr.id WHERE train_id = {$row['id']} GROUP BY train ORDER BY id";
				$res_seats = $mysql->query($sql_seatinfo);
				while($row_seats = $mysql->fetch($res_seats)){
					array_push($traininfo['train']['seat_type'],$row_seats['seat_type_id']);
				}
			}
		}else{
			$traininfo['error'] = 1;
		}
		echo json_encode($traininfo);
	}
?>
