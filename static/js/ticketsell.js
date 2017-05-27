/* Avoid same start/end city */
	function selectCity(ele){
		var elename=ele.name=='scity'?'ecity':'scity';
		$('[name="'+elename+'"] option').attr('disabled',false)
		$('[name="'+elename+'"] [value="'+ele.value+'"]').attr('disabled',true)
		if($('[name="'+elename+'"]').val()==ele.value)$('[name="'+elename+'"]').val('')
		trainTime()
		countSeat()
	}
/* Count ticket price */
	function countPrice(){
		var ele = $('[name="level"]').val();
		if(ele!=null){
			price = parseInt(ele.split(",")[1])*$("#hours").val()
			$("#price").val(price+'RMB')
			$('[name="price"]').val(price)
			countSeat()
		}
	}
/* Count remain seats*/
	function countSeat(){
		var godate = $('[name="date"]').val();
		var train_id = $('#tid').val();
		try{
			if(($('[name="level"]').val()+godate+train_id)!='undefined'){
				var seat_type_id = $('[name="level"]').val().split(",")[0];
				var cariage_cap = $('[name="level"]').val().split(",")[2];
				$.ajax({
					url:'ajax.php',
					data:{"stype":seat_type_id,"godate":godate,"tid":train_id},
					type:'POST',
					dataType:'json',
					success:function(data){
						total = parseInt(data.carnum)*cariage_cap;
						remain = total - data.seatnum;
						$('#remain').val(remain+' / '+total+' ('+cariage_cap+' Seat * '+data.carnum+' Cariage)')
						$('[name="remain"]').val(remain+','+cariage_cap)
						if(remain==0){
							$('[name="level"]').val('')
						}
					}
				})
			}
		}catch(error){
			return false;
		}
	}
/* Check train time */
	function trainTime(){
		scityid = $('[name="scity"]').val();
		ecityid = $('[name="ecity"]').val();
		ttype = $('[name="ttype"]').val();
		$.ajax({
			url:'ajax.php',
			data:{"scityid":scityid,"ecityid":ecityid,"ttype":ttype},
			type:'POST',
			dataType:'json',
			success:function(data){
				var level = $('[name="level"] option');
				level.attr('disabled',true)
				if(data.error==1){
					$('#stime').val('No train between these two cities')
					$('#etime').val('No train between these two cities')
					$('#trainSelected').html('')
					$('#tid').val('')
					$("#price").val(0)
				}else{
					var standid = data.type==1? 1:3;
					for(var i=1;i<level.length;i++){
						var sid = level[i].value.split(",")[0];
						if(data.train.seat_type.indexOf(sid)!=-1||sid==standid){
							level[i].disabled = false;
						}
					}
					if($('[name="level"] option:selected').attr('disabled')=='disabled'){
						$('[name="level"]').val('')
						$('#price').val('')
						$('#remain').val('')
					}
					$('#stime').val(data.start)
					$('#etime').val(data.end+' /'+data.hours+' Hours')
					$("#hours").val(data.hours)
					$('#trainSelected').html('('+data.train.tname+')')
					$('#tid').val(data.train.tid)
					countPrice()
				}
			}
		});
	}
/* Date must later than tomorrow */
	function checkDate(){
		reqDate = document.getElementsByName('date')[0].valueAsDate
		if(reqDate < new Date().getTime()){
			alert("The ticket date must later than today");
			$('[name="date"]').val('')
			$('#subbtn').attr('disabled',true)
		}else{
			$('#subbtn').attr('disabled',false)
			countSeat()
		}
	}
/* Edit tickets */
	function editTk(id){
		$.ajax({
			url:'ajax.php',
			data:{"editTkId":id},
			type:'POST',
			dataType:'json',
			success:function(data){
				$('[name="level"]').children()[data.seats_type].selected='true';
				$('[name="scity"]').val(data.start_city_id);
				$('[name="ecity"]').val(data.end_city_id);
				$('[name="cusid"]').val(data.cus_id);
				$('#cusname').val($('#cuslist [value='+data.cus_id+']').html().split('/')[0])
				$('[name="date"]').val(data.godate);
				selectCity($('[name="scity"]')[0]);
				selectCity($('[name="ecity"]')[0]);
				countPrice();
				checkDate();
				$('[name="editid"]').val(id)
				$('[name="newtk"]').html('Edit')
				$('[name="newtk"]').attr('name','editTk')
			},
			beforeSend:function(){
				$('#subbtn').html('<i class="fa fa-refresh fa-spin nodeco"></i>')
			}
		})
	}
