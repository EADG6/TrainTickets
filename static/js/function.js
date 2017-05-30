/* hide/show navigation bar */
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
/* Show real password */
	function seepwd(e){
		pwd = $('[name="'+e+'"]');
		pwd.attr('type','text');
		this.onmouseup = function(){
			pwd.attr('type','password');
		};
	}
/* Check password when create new staff */
	function checkpwd(){
		var pwd = $('[name="pwd"]');
		var pwdconf =  $('[name="pwdConfirm"]');
		var btnsubmit = $('[name="newstaff"]');
		if(pwd.val().length<4){
			alert("Your password length is too short! Please type more than 3 word");
			pwd.attr('class','form-control alert-danger');
			pwdconf.attr('class','form-control');
			pwd.val('');
			pwdconf.val('');
			pwd.focus();
			btnsubmit.attr('disabled',true);
		}else{
			if(pwd.val() == pwdconf.val()){
				pwd.attr('class','form-control alert-success');
				pwdconf.attr('class','form-control alert-success');
				btnsubmit.attr('disabled',false);
				checkNewName();
			}else{
				pwdconf.attr('class','form-control alert-danger');
				pwdconf.val('');
				btnsubmit.attr('disabled',true);
			}
		}
	}
/* Avoid same start/end city */
	function selectCity(ele){
		var elename=ele.name=='scity'?'ecity':'scity';
		$('[name="'+elename+'"] option').attr('disabled',false)
		$('[name="'+elename+'"] [value="'+ele.value+'"]').attr('disabled',true)
		if($('[name="'+elename+'"]').val()==ele.value)$('[name="'+elename+'"]').val('')
	}
/* Delete ticket */
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
