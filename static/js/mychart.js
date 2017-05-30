/* Customer Payment Chart */
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
/*Sales Trend Chart*/
	function crefinanTrend(){
		$.ajax({
			url:'ajax.php',
			data:{"tksales":true},
			type:'POST',
			success:function(data){
				data_rev = data.rev
				data_num = data.num
				creSalesChart()
			},
			dataType: 'json'
		});
	}
	function creSalesChart(){
		var sales = $("#tksalesChart");
		var data_tksale =  {
			datasets: [{
				label: 'Tickets Sales Amount /100',
				data: data_num,
				fill: false,
				backgroundColor: "rgba(255,99,132,0.2)",
				borderColor: 'rgba(255,99,132,0.9)',
				pointHoverRadius: 5,
				lineTension: 0.2
			},{
				label: 'Sales Revenues',
				data: data_rev,
				borderColor: "rgba(75,192,192,1)",
				backgroundColor: "rgba(75,192,192,0.2)",
				pointHoverRadius: 5,
				lineTension: 0.2
			}]
		};
		var mysales = new Chart(sales, {
			type: 'line',
			data: data_tksale,
			options: {
				responsive:true,
				title: {
					display: true,
					text: 'Tickets Sales'
				},
				scales: {
					xAxes: [{
						type: 'time',
						position: 'bottom',
						time: {
							parser: "YYYY-MM-DD",
							minUnit: "day",
							displayFormats: {
								day: "DD MMM, YY"
							}
						}
					}],
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	}
/* Popular city Chart */
	function crepopcity(labels,data_scity,data_ecity){
		var popcity = $('#popcityChart');
			var mypopcity = new Chart(popcity, {
				type: 'bar',
				data: {
					labels: labels,
					datasets: [
						{
							label: "Popular Departure Station",
							backgroundColor: 'rgba(54, 162, 235, 0.6)',
							borderColor: 'rgba(54, 162, 235, 1)',
							borderWidth: 1,
							data: data_scity,
						},{
							label: "Popular Destination Station",
							backgroundColor: 'rgba(255, 99, 132, 0.6)',
							borderColor: 'rgba(255,99,132,1)',
							borderWidth: 1,
							data: data_ecity,
						}
					]
				},
				options: {
					responsive: true,
					title: {
						display: true,
						text: 'Popular Station'
					},
						scales: {
							xAxes: [{
								position: "bottom",
							}],
							yAxes: [{
								stacked: true,
								position: "left",
								ticks: {
									beginAtZero:true,
									suggestedMin: 0,
									suggestedMax: 10
								}
								
							}]
						}
				}
			});
	}