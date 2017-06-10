	function checkNewName(){
		$('[name="username"]').val($('[name="username"]').val().replace(" ",""))
		if($('[name="username"]').val().length>0){
			$.ajax({
				url:'ajax.php',
				data:{"usercheck":encodeURI(encodeURI($('[name="username"]').val()))},
				success:function(data){
				setTimeout(function(){
					if(data.used=='used'){
						$('[name="username"]').attr('class','form-control alert-danger')
						$('[name="username"]').next().attr('class','seepwd alert-danger')
						$('[name="username"]').next().children('i').attr('class','fa fa-close')
						$('[name="newstaff"]').attr('disabled',true)
					}else if(data.used=='ok'){
						$('[name="username"]').attr('class','form-control alert-success')
						$('[name="username"]').next().attr('class','seepwd alert-success')
						$('[name="username"]').next().children('i').attr('class','fa fa-check')
						$('[name="newstaff"]').attr('disabled',false)
					}else if(data.used=='empty'){
						$('[name="username"]').attr('class','form-control')
						$('[name="username"]').next().attr('class','seepwd hidden')
						$('[name="newstaff"]').attr('disabled',true)
					}
				},500)
				},
				type:'POST',
				dataType:'json',
				beforeSend:function(){
					$('[name="username"]').next().attr('class','seepwd btn-warning')
					$('[name="username"]').next().children('i').attr('class','fa fa-refresh fa-spin')
					$('[name="newstaff"]').attr('disabled',true)
				}
			});
		}else{
			$('[name="username"]').attr('class','form-control')
			$('[name="username"]').next().attr('class','seepwd hidden')
			$('[name="newstaff"]').attr('disabled',true)
		}
	}