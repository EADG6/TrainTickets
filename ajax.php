<?php
	require "inc/db.php";
	if(isset($_POST['scityid'])){
		$traininfo = ['train'=>['tid'=>'','tname'=>'','seat_type'=>[]],'start'=>'','end'=>'','hours'=>'','type'=>'','error'=>0];
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
				$traininfo['train']['tid'] = $row['id'];
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
	}else if(isset($_POST['stype'])){
		$stype = $_POST['stype'];
		$godate = $_POST['godate'];
		$tid = $_POST['tid'];
		$isstand = 0;
 		if($stype==1||$stype==3){
			$stype++;
			$isstand = 1;
		}
		$sql_seats = "SELECT COUNT(*) FROM tickets WHERE godate='$godate' AND cariage_id in (SELECT id FROM cariage WHERE train_id = $tid AND cariage_type_id = $stype) AND isstand = $isstand";
		$seats = $mysql->oneQuery($sql_seats);
		$cariage = $mysql->oneQuery("SELECT COUNT(id) FROM cariage WHERE train_id = $tid AND cariage_type_id = $stype");
		echo json_encode(['carnum'=>$cariage,'seatnum'=>$seats]);
	}else if(isset($_POST['tid'])){
		$tid = $_POST['tid'];
		$date = $_POST['tdate'];
		$now = strtotime(date('Y-m-d',time()));
		$sql = "SELECT tk.id,t.name AS train,ty.type,c1.city AS scity,c2.city AS ecity,tk.cariage_id,CONCAT(firstname,' ',lastname) AS realname,tk.seat_id,CASE WHEN tk.isstand=0 THEN stp.seats_level WHEN tk.isstand=1 THEN 'Stand' END AS seats_level,tk.seat_id,tk.godate,CONCAT (gotime,'-',DATE_FORMAT(timestampadd(hour,hours,gotime),'%T')) AS time,hours,stp.price*hours AS price FROM tickets AS tk 
		INNER JOIN cariage AS car ON tk.cariage_id=car.id INNER JOIN train AS t ON car.train_id=t.id INNER JOIN train_type AS ty ON t.train_type_id=ty.id INNER JOIN city AS c1 ON start_city_id=c1.id INNER JOIN city AS c2 ON end_city_id=c2.id INNER JOIN customer AS cus ON tk.cus_id=cus.id INNER JOIN seats_type AS stp ON car.cariage_type_id=stp.id WHERE t.id = '$tid' AND godate = '$date' ORDER BY id";
		$res = $mysql->query($sql);
		$data = '';
		while($row = $mysql->fetch($res)){
			$delfunc = $now>strtotime($date)?"delTk(".$row['id'].")":"alert(\"You can only delete history tickets\")";
			$data .= "<tr id='tk".$row['id']."'><td>".$row['train']."</td>
						<td>".$row['time']."</td>
						<td>".$row['hours']."</td>
						<td>".$row['price']."&#165;</td>
						<td>".$row['realname']."</td>
						<td>".$row['seats_level'].'-'.$row['seat_id']."</td>
						<td>".$row['cariage_id']."</td>
						<td>
							<a class='label label-primary' href='index.php?page=ticket&action=new&edit=".$row['id']."'>E</a>						
							<a class='label label-danger' onclick='$delfunc'>X</a>
						</td>
					</tr>";
		}
		echo json_encode(['htmls'=>$data]);
	}else if(isset($_POST['deltkid'])){
		$delid = $_POST['deltkid'];
		$sql_deltk = "DELETE FROM tickets WHERE id = '$delid'";
		$mysql->query($sql_deltk);
	}
?>
