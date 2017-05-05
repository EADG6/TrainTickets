<!-- Show all the admin menu from databse -->
<dl class="col-md-2" style="margin-bottom:0;padding-right:0;" id='leftMenu'>
	<dd class="clearfix">
		<div class="mynav">
			<div class="panel-group" id="panel-1">
			  <div class="panel" style="background:#DB4C4C;color:#fff" onclick='location.href="index.php"'><div class="panel-heading icona"><h4><img src=''> Train Ticket System</h4></div>
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
			<i class="fa fa-3x fa-arrow-circle-right icona" onmouseover='this.style.color="#333"' onmouseout='this.style.color="rgba(51, 51, 51, 0.4)"' id='leftArrow' onclick="hideLeft()"></i>
		</div>
	</dd>
</dl>
<i class="fa fa-3x fa-arrow-circle-left icona" id='rightArrow' onmouseover='this.style.color="#333"' onmouseout='this.style.color="rgba(51, 51, 51, 0.4)"' onclick="showLeft()" style="display:none"></i>
<a href='#leftMenu'><i class="fa fa-3x fa-arrow-circle-o-up" id='topArrow' onmouseover='this.style.color="#333"' onmouseout='this.style.color="rgba(1, 1, 1, 0.1)"'></i></a>
<script>
	function hideLeft(){
		$('#leftMenu').hide()
		$('#rightArrow').show()
		$('#rightMain').attr('class','col-md-10 col-md-offset-1 main')
	}
	function showLeft(){
		$('#leftMenu').show()
		$('#rightArrow').hide()
		$('#rightMain').attr('class','col-md-10 main')
	}
</script>
<div class="col-md-10 main" id='rightMain'>