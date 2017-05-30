	function ticketinfo(ele,tid,ttp,sold,totcap){
		var tdate = $(ele).html()
		$("#tid_label").html(tid);
		$("#ttp_label").html(ttp);
		$("#tdate_label").html(tdate);
		$("#caprem_label").html(sold+'/'+totcap);
		$.ajax({
			url:'ajax.php',
			data:{"tid":tid,"tdate":tdate},
			type:'POST',
			dataType:'json',
			success:function(data){
				setTimeout(function(){$('#tickets_info').html(data.htmls)},200)
			},
			beforeSend:function(){
				$('#tickets_info').html("<th colspan=8><center><a class='fa fa-refresh fa-3x fa-spin nodeco'></a></center></th>")
			}
		})
	}