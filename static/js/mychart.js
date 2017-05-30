	function creCusChart(cus,payment,month){
		$('#cusrep').show();
		var custep = $('#cusrepChart');
			var myCus = new Chart(custep, {
				type: 'horizontalBar',//bar or horizontalBar
				data: {
					labels: cus,
					datasets: [
						{
							label: "Sold",
							backgroundColor: 'rgba(54, 162, 235, 0.5)',
							borderColor: 'rgba(54, 162, 235, 1)',
							borderWidth: 1,
							data: payment,
						}
					]
				},
				options: {
					responsive: true,
					title: {
						display: true,
						text: 'Customer Payment in '+month
					},
						scales: {
							xAxes: [{
								position: "top",
								ticks: {
									beginAtZero:true,
									suggestedMin: 0,
									suggestedMax: 10
								}
							}],
							yAxes: [{
								stacked: true,
								position: "left",
								
							}]
						}
				}
			});
	}