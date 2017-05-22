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
	/*Main Pages*/
	include "inc/header.php";
	include "inc/nav.php";
	$page = isset($_GET['page']) ? $_GET['page']:'ticket';
	$action = isset($_GET['action']) ? $_GET['action']:'all';
	if($page=='ticket'){
		if($action=='new'){
			include "app/ticket_new.php";
		}else if($action=='all'){
			include "app/ticket_all.php";
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
		//include "app/profile.php";
	}
	include "inc/footer.php";
?>