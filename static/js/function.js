/* Check passord */
	function seepwd(i){
		pwd = document.getElementsByName(i)[0];
		pwd.type='text';
		this.onmouseup = function(){
			pwd.type='password';
		};
	}
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
