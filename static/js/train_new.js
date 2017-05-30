	function cartype(){
		if($('[name="ttype"]').val()==1){
			$('[name="hseatca"]').attr('disabled',false);
			$('[name="sseatca"]').attr('disabled',true);
			$('[name="hsleepca"]').attr('disabled',true);
			$('[name="ssleepca"]').attr('disabled',true);
		}else if($('[name="ttype"]').val()==2){
			$('[name="hseatca"]').attr('disabled',true);
			$('[name="sseatca"]').attr('disabled',false);
			$('[name="hsleepca"]').attr('disabled',false);
			$('[name="ssleepca"]').attr('disabled',false);
		}
	}
/* Edir Train */	
	function edittrain(id){
		$.ajax({
			url:'ajax.php',
			data:{"edittrain":id},
			success:function(data){
				$('[name="train_id"]').val(data.name)
				$('[name="ttype"]').val(data.train_type_id)
				$('[name="scity"]').val(data.start_city_id)
				$('[name="ecity"]').val(data.end_city_id)
				$('[name="stime"]').val(data.gotime.substr(0,5))
				$('[name="hours"]').val(data.hours)
				$('[name="carsnums"]').val(data.cars.car2+','+data.cars.car4+','+data.cars.car5+','+data.cars.car6)
				$('[name="newtrain"]').html('Edit')
				$('[name="edittid"]').val(id)
				$('#car2').val(data.cars.car2)
				$('#car4').val(data.cars.car4)
				$('#car5').val(data.cars.car5)
				$('#car6').val(data.cars.car6)
				cartype()
			},
			type:'POST',
			dataType:'json'
		});
	}