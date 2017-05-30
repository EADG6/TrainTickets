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
