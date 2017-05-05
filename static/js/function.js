/*function of check passord*/
	function seepwd(i){
		pwd = document.getElementsByName(i)[0];
		pwd.type='text';
		this.onmouseup = function(){
			pwd.type='password';
		};
	}
