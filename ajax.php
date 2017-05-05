<?php
	require "inc/db.php";
	if(isset($_POST['scityid'])){
		$traininfo = ['start'=>'','end'=>'','hours'=>'','type'=>'','error'=>0];
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
			}
		}else{
			$traininfo['error'] = 1;
		}
		echo json_encode($traininfo);
	}
?>