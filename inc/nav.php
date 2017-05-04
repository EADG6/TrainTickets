<!-- Show all the admin menu from databse -->
<dl class="mynav">
	<dd class="clearfix">
		<div class="col-md-2" style="padding-right:0;">
			<div class="panel-group" id="panel-1">
			  <div class="panel" style="background:#DB4C4C;color:#fff"><div class="panel-heading"><h4><img src=''> Train Ticket System</h4></div>
			  </div>
				<div class="panel panel-default" style='margin-top:0px;'>
					<div class="panel-heading" onclick="$('#ticket')[0].click()">
						<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-1" id="ticket" href="#panel-element-1" style="text-decoration:none;">
							Ticket
						</a><span class="caret"></span>
					</div>
					<div id="panel-element-1" class="panel-collapse collapse">
						<a href="index.php?page=ticket&action=new" class="panel-legend">
							<div class="panel-body">New Ticket</div>
						</a>
						<a href="index.php?page=ticket&action=all" class="panel-legend">
							<div class="panel-body">Edit Ticket</div>
						</a>
					</div>
					<div class="panel-heading" onclick="$('#train')[0].click()">
						<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-1" id="train" href="#panel-element-2" style="text-decoration:none;">
							Train
						</a><span class="caret"></span>
					</div>
					<div id="panel-element-2" class="panel-collapse collapse">
						<a href="index.php?page=ticket&action=new" class="panel-legend">
							<div class="panel-body">New Train</div>
						</a>
						<a href="index.php?page=ticket&action=all" class="panel-legend">
							<div class="panel-body">Edit Train</div>
						</a>
					</div>
					<div class="panel-heading" onclick="$('#customer')[0].click()">
						<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-1" id="customer" href="#panel-element-3" style="text-decoration:none;">
							Customer
						</a><span class="caret"></span>
					</div>
					<div id="panel-element-3" class="panel-collapse collapse">
						<a href="index.php?page=ticket&action=new" class="panel-legend">
							<div class="panel-body">New Customer</div>
						</a>
						<a href="index.php?page=ticket&action=all" class="panel-legend">
							<div class="panel-body">Edit Customer</div>
						</a>
					</div>
					<div class="panel-heading" onclick="$('#staff')[0].click()">
						<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-1" id="staff" href="#panel-element-4" style="text-decoration:none;">
							Staff
						</a><span class="caret"></span>
					</div>
					<div id="panel-element-4" class="panel-collapse collapse">
						<a href="index.php?page=ticket&action=new" class="panel-legend">
							<div class="panel-body">New Staff</div>
						</a>
						<a href="index.php?page=ticket&action=all" class="panel-legend">
							<div class="panel-body">Edit Staff</div>
						</a>
						<a href="index.php?page=ticket&action=all" class="panel-legend">
							<div class="panel-body">Role Management</div>
						</a>
					</div>
					<div class="panel-heading" onclick="$('#profile')[0].click()">
						<a class="panel-title collapsed" id="profile" href="123.php" style="text-decoration:none;">
							My Profile
						</a>
					</div>
				</div>
			</div>
		</div>	
		<div class="main col-md-9" style="width:80%">
			<span>
<?php 
/**Show current path*/	
	/* if(isset($_GET['page']))echo '<i class="fa fa-home"></i>&nbsp;>&nbsp;'.ucwords(inputCheck($_GET['page'])).'&nbsp;>&nbsp;'; 
	if(isset($_GET['action'])){echo ucwords(inputCheck($_GET['action'])).'&nbsp;>';}
	$sql_currentMenu = "SELECT pid FROM admin_menu WHERE url = '$url'";
	$curentMenuId = $mysql->oneQuery($sql_currentMenu);
	echo "<script>if($('#panele$curentMenuId')[0])$('#panele$curentMenuId')[0].click()</script>";	 */
?>
			</span>
		</div>
