<!-- Navigation bar -->
<dl class="col-md-2" style="margin-bottom:0;padding-right:0;" id='leftMenu'>
	<dd class="clearfix">
		<div class="mynav">
			<div class="panel-group" id="panel-leftmenu">
			  <div class="panel" style="background:#DB4C4C;color:#fff" onclick='location.href="index.php"'>
				<div class="panel-heading icona">
					<h4><img src=''> Train Ticket System</h4>
				</div>
			  </div>
				<div class="panel panel-default" style='margin-top:0px;'>
					<div class="panel-heading" onclick="$('#ticket')[0].click()">
						<a class="panel-title collapsed icona" data-toggle="collapse" data-parent="#panel-leftmenu" id="ticket" href="#panel-element-ticket">
							Ticket
						</a><span class="caret"></span>
					</div>
					<div id="panel-element-ticket" class="panel-collapse collapse">
						<a href="index.php?page=ticket&action=new" class="panel-legend icona">
							<div class="panel-body">New Ticket</div>
						</a>
						<a href="index.php?page=ticket&action=all" class="panel-legend icona">
							<div class="panel-body">All Ticket</div>
						</a>
						<a href="index.php?page=ticket&action=day" class="panel-legend icona">
							<div class="panel-body">Query Date</div>
						</a>
					</div>
					<div class="panel-heading" onclick="$('#train')[0].click()">
						<a class="panel-title collapsed icona" data-toggle="collapse" data-parent="#panel-leftmenu" id="train" href="#panel-element-train">
							Train
						</a><span class="caret"></span>
					</div>
					<div id="panel-element-train" class="panel-collapse collapse">
						<a href="index.php?page=train&action=new" class="panel-legend icona">
							<div class="panel-body">New Train</div>
						</a>
						<a href="index.php?page=train&action=all" class="panel-legend icona">
							<div class="panel-body">Edit Train</div>
						</a>
					</div>
					<div class="panel-heading" onclick="$('#customer')[0].click()">
						<a class="panel-title collapsed icona" data-toggle="collapse" data-parent="#panel-leftmenu" id="customer" href="#panel-element-customer">
							Customer
						</a><span class="caret"></span>
					</div>
					<div id="panel-element-customer" class="panel-collapse collapse">
						<a href="index.php?page=customer&action=new" class="panel-legend icona">
							<div class="panel-body">New Customer</div>
						</a>
						<a href="index.php?page=customer&action=all" class="panel-legend icona">
							<div class="panel-body">Edit Customer</div>
						</a>
						<a href="index.php?page=customer&action=report" class="panel-legend icona">
							<div class="panel-body">Customer Report</div>
						</a>
					</div>
					<div class="panel-heading" onclick="$('#staff')[0].click()">
						<a class="panel-title collapsed icona" data-toggle="collapse" data-parent="#panel-leftmenu" id="staff" href="#panel-element-staff">
							Staff
						</a><span class="caret"></span>
					</div>
					<div id="panel-element-staff" class="panel-collapse collapse">
						<a href="index.php?page=staff&action=new" class="panel-legend icona">
							<div class="panel-body">New Staff</div>
						</a>
						<a href="index.php?page=staff&action=all" class="panel-legend icona">
							<div class="panel-body">Edit Staff</div>
						</a>
						<a href="index.php?page=staff&action=role" class="panel-legend icona">
							<div class="panel-body">Role Management</div>
						</a>
					</div>
					<div class="panel-heading" onclick="$('#profile')[0].click()">
						<a class="panel-title collapsed icona" id="profile" href="index.php?page=profile">
							My Profile
						</a>
					</div>
					<div class="panel-heading" onclick="$('#logout')[0].click()">
						<a class="panel-title collapsed icona" id="logout" href="index.php?logout">
							Log Out
						</a>
					</div>
				</div>
			</div>
			<i class="fa fa-3x fa-arrow-circle-right icona" onmouseover='this.style.color="#333"' onmouseout='this.style.color="rgba(51, 51, 51, 0.4)"' id='leftArrow' onclick="hideLeft()"></i>
		</div>
	</dd>
</dl>
<i class="fa fa-3x fa-arrow-circle-left icona" id='rightArrow' onmouseover='this.style.color="#333"' onmouseout='this.style.color="rgba(51, 51, 51, 0.4)"' onclick="showLeft()" style="display:none"></i>
<a href='#leftMenu'><i class="fa fa-3x fa-arrow-circle-o-up" id='topArrow' onmouseover='this.style.color="#333"' onmouseout='this.style.color="rgba(1, 1, 1, 0.1)"'></i></a>
<div class="col-md-10 main" id='rightMain'>
	<div class='form-group'>
<?php
	if(isset($_GET['page'])){
		$curpage = $_GET['page'];
	}else{
		$curpage = 'ticket';
	}
	if(isset($_GET['action'])||$curpage=='ticket'){
		echo "<script>setTimeout(function(){\$('#".$curpage."')[0].click()},500)</script>";
	}
	echo '<i class="fa fa-home"></i>&nbsp;>&nbsp;'.ucwords(inputCheck($curpage)).'&nbsp;>&nbsp;';
	if(!isset($_GET['edit'])){
		if(isset($_GET['action'])){
			echo ucwords(inputCheck($_GET['action'])).'&nbsp;>';
		}
	}else{
		echo "Edit >";
	}
?>
	</div>