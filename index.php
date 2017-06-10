<?php
	session_start();
	date_default_timezone_set('PRC');
	require "inc/db.php";
	/*Log out*/
	if(isset($_GET['logout'])){
		unset($_SESSION['user']);
		unset($_SESSION['userid']);
		unset($_SESSION['role']);
		session_destroy();
		header("Location:login.php");
	}
	if(!isset($_SESSION['userid'])){
		header("Location:login.php");
	}
	$page = isset($_GET['page']) ? $_GET['page']:'dashboard';
	$action = isset($_GET['action']) ? $_GET['action']:'all';
	$access = $mysql->oneQuery("SELECT role_id FROM access WHERE page = '$page' AND action = '$action'");
	/*Main Pages*/
	include "inc/header.php";
	include "inc/nav.php";
	if($access < $_SESSION['role']){
		echo "<h1>Access Denied</h1>";
	}else{
		if($page=='ticket'){
			if($action=='new'){
				include "app/ticket_new.php";
			}else if($action=='all'){
				include "app/ticket_all.php";
			}else if($action=='day'){
				include "app/ticket_day.php";
			}
		}else if($page=='train'){
			if($action=='new'){
				include "app/train_new.php";
			}else if($action=='all'){
				include "app/train_all.php";
			}
		}else if($page=='customer'){
			if($action=='new'){
				include "app/customer_new.php";
			}else if($action=='all'){
				include "app/customer_all.php";
			}else if($action=='report'){
				include "app/customer_report.php";
			}
		}else if($page=='staff'){
			if($action=='new'){
				include "app/staff_new.php";
			}else if($action=='all'){
				include "app/staff_all.php";
			}else if($action=='role'){
				include "app/staff_role.php";
			}
		}else if($page=='profile'){
			include "app/profile.php";
		}else if($page=='dashboard'){
			include "app/dashboard.php";
		}
	}
	include "inc/footer.php";
?>