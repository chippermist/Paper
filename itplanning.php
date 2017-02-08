<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>IT Planning Dashboard</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<script>
      console.log("%cWhat's up? This area is forbidden.", "background: red; color: yellow; font-size: x-large");

  </script>


	<!-- Bootstrap core CSS     -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />

	<!-- Animation library for notifications   -->
	<link href="assets/css/animate.min.css" rel="stylesheet"/>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-89738956-1', 'auto');
		ga('send', 'pageview');

	</script>

	<!--  Paper Dashboard core CSS    -->
	<link href="assets/css/paper-dashboard.css" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


	<!--  Fonts and icons     -->
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
	<link href="assets/css/themify-icons.css" rel="stylesheet">

	<!-- Important JavaScript Files -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
	<script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/randomcolor/0.4.4/randomColor.min.js"></script>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/jquery.canvasjs.min.js" type="text/javascript"></script>

	<!-- Data Retrival PHP File - very important -->
	<?php include 'database_retrival.php' ?>

	<style type="text/css">
		.canvasjs-chart-credit {
			display: none;
		}
	</style>

	<script type="text/javascript">

		<?php
		$query1_it = "SELECT distinct service, sum(days) as Days FROM `abcd_it_2016_extra` GROUP BY service";

		$result1_it = mysql_query($query1_it, $conn);

		if(!$result1_it) {
			die('Could not get data from new ITP 2016 result1: ' . mysql_error());
		}
		
		?>

		window.onload = function () {
			var chart = new CanvasJS.Chart("newServiceChart",
			{
				toolTip:{
        			enabled: false   //enable here
        		},
        		data: [
        		{
            //startAngle: 45,
            //animationEnabled: true,
            indexLabelFontSize: 15,
            //indexLabelFontFamily: "Garamond",
            //indexLabelFontColor: "darkgrey",
            indexLabelLineColor: "darkgrey",
            indexLabelPlacement: "outside",
            type: "doughnut",
            showInLegend: true,
            dataPoints: [
            <?php
            $rowNumber = 0;
            while($row = mysql_fetch_array($result1_it, MYSQL_ASSOC)){
            	echo '{ y:' . $row['Days'] . ', legendText: "' . $row['service'] . '", indexLabel: "#percent%"}'; 
            	if(mysql_fetch_array($result1_it, MYSQL_ASSOC)){
            		mysql_data_seek($result1_it, ($rowNumber+1));
            		echo ',';
            		$rowNumber++;
            	}

            }

            ?>




            ]
        }
        ]
    });

			chart.render();
		}
	</script>


	<script type="text/javascript">
		<?php
		$query1 = "SELECT distinct service, sum(days) as Days FROM `abcd_it_2016_extra` GROUP BY service";

		$result1 = mysql_query($query1, $conn);

		if(!$result1) {
			die('Could not get data from new ITP 2016 result1: ' . mysql_error());
		}
		
		while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
			$label_service[] = $row1['service'];
			$service_days[] = $row1['Days'];
		}
		?>

		var temp_labels = <?php echo json_encode($label_service); ?>;
		var temp_points = <?php echo json_encode($service_days); ?>;
		var temp_colors = ["#884EA0", "#2E86C1", "#28B463", "#F39C12", "#7F8C8D"];

		// for (i = 0; i < temp_points.length; i++) { 
		// 	temp_colors.push(randomColor({luminosity: 'dark'}));
		// }

		var serviceChartData = {
			labels : temp_labels,
			datasets: [
			{
				backgroundColor: temp_colors,
				data: temp_points
			}
			]
		};

		var serviceOptions = {
			legend: {display: true, position: 'top'},
			animation: {
				duration: 500,
				easing: "easeOutQuart",
				onComplete: function () {
					var ctx = this.chart.ctx;
					ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
					ctx.textAlign = 'center';
					ctx.textBaseline = 'bottom';

					this.data.datasets.forEach(function (dataset) {

						for (var i = 0; i < dataset.data.length; i++) {
							var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
							total = dataset._meta[Object.keys(dataset._meta)[0]].total,
							mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
							start_angle = model.startAngle,
							end_angle = model.endAngle,
							mid_angle = start_angle + (end_angle - start_angle)/2;

							var x = mid_radius * Math.cos(mid_angle);
							var y = mid_radius * Math.sin(mid_angle);

							ctx.fillStyle = '#fff';
				  // if (i == 3){ // Darker text color for lighter background
				  //   ctx.fillStyle = '#444';
				  // }
				  var percent = String((dataset.data[i]/total*100).toFixed(1)) + "%";
				  //ctx.fillText(dataset.data[i], model.x + x, model.y + y);
				  // Display percent in another line, line break doesn't work for fillText
				  ctx.fillText(percent, model.x + x, model.y + y + 15);
				}
			});               
				}
			}
		};

		function serviceCategoryChart() {
			var myNewChart = new Chart("serviceChart", {
				type: 'doughnut',
				data: serviceChartData,
				options: serviceOptions
			})
		};

		addFunctionOnWindowLoad(serviceCategoryChart);

	</script>



	<script type="text/javascript">
		<?php

		while($row = mysql_fetch_array($services_result_it_filter_2016, MYSQL_ASSOC)){
			$label_array[] = $row['Service'];
			$data_points[] = $row['Total'];
		}

		?>

		var temp_labels = <?php echo json_encode($label_array); ?>;
		var temp_points = <?php echo json_encode($data_points); ?>;
		var temp_colors = [];
		
		for (i = 0; i < temp_points.length; i++) { 
			temp_colors.push(randomColor({luminosity: 'dark'}));
		}

		var pieData = {
			labels : temp_labels,
			datasets: [
			{
				backgroundColor: temp_colors,
				data: temp_points
			}
			]
		};

		var doughnutOptions = {
			legend: {display: true, position: 'top'},
			animation: {
				duration: 500,
				easing: "easeOutQuart",
				onComplete: function () {
					var ctx = this.chart.ctx;
					ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
					ctx.textAlign = 'center';
					ctx.textBaseline = 'bottom';

					this.data.datasets.forEach(function (dataset) {

						for (var i = 0; i < dataset.data.length; i++) {
							var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
							total = dataset._meta[Object.keys(dataset._meta)[0]].total,
							mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
							start_angle = model.startAngle,
							end_angle = model.endAngle,
							mid_angle = start_angle + (end_angle - start_angle)/2;

							var x = mid_radius * Math.cos(mid_angle);
							var y = mid_radius * Math.sin(mid_angle);

							ctx.fillStyle = '#fff';
				  // if (i == 3){ // Darker text color for lighter background
				  //   ctx.fillStyle = '#444';
				  // }
				  var percent = String((dataset.data[i]/total*100).toFixed(1)) + "%";
				  //ctx.fillText(dataset.data[i], model.x + x, model.y + y);
				  // Display percent in another line, line break doesn't work for fillText
				  ctx.fillText(percent, model.x + x, model.y + y + 15);
				}
			});               
				}
			}
		};

		function doughnutChart() {
			var myNewChart = new Chart("doughnut-Chart", {
				type: 'doughnut',
				data: pieData,
				options: doughnutOptions

			})
		};


		addFunctionOnWindowLoad(doughnutChart);
	</script>


	<script type="text/javascript">

		var dataBar2016 = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			datasets: [
			{
				backgroundColor: '#F1C40F',
				borderColor: "#F1C40F",
				data: [<?php echo $jan_it_2016 ?>, <?php echo $feb_it_2016 ?>, <?php echo $mar_it_2016 ?>, <?php echo $apr_it_2016 ?>, <?php echo $may_it_2016 ?>, <?php echo $jun_it_2016 ?>, <?php echo $jul_it_2016 ?>, <?php echo $aug_it_2016 ?>, <?php echo $sep_it_2016 ?>, <?php echo $oct_it_2016 ?>, <?php echo $nov_it_2016 ?>, <?php echo $dec_it_2016 ?>],
				borderWidth: 1,
			}
			]
		};

		Chart.plugins.register({
			beforeDraw: function(chartInstance) {
				var ctx = chartInstance.chart.ctx;
				ctx.fillStyle = "white";
				ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
			}
		});



		function barChart1(){
			var newChart = new Chart("chartContainer2016Bar", {
				type: 'bar',
				data: dataBar2016,
				options: {
					legend: {
						display: false
					}
					,scales: {
						xAxes: [{
							barThickness: 25,
							gridLines: {
								display:false
							}
						}],
						yAxes: [{
							gridLines: {
								display:false
							},
							ticks: {
								beginAtZero:true
							}
						}]
					}
				}
			});
		} 


		addFunctionOnWindowLoad(barChart1);
	</script>
	
	<script type="text/javascript">

		var data_years = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			datasets: [
			{
				label: "2015",
				fill: false,
				lineTension: 0.1,
				backgroundColor: "rgba(30,144,255,1)",
				borderColor: "rgba(30,144,255,1)",
				borderCapStyle: 'butt',
				borderDash: [],
				borderDashOffset: 0.0,
				borderJoinStyle: 'miter',
				pointBorderColor: "rgba(75,192,192,1)",
				pointBackgroundColor: "#fff",
				pointBorderWidth: 1,
				pointHoverRadius: 5,
				pointHoverBackgroundColor: "#F15854",
				pointHoverBorderColor: "#F15854",
				pointHoverBorderWidth: 2,
				pointRadius: 1,
				pointHitRadius: 10,
				data: [<?php echo $jan_it_2015 ?>, <?php echo $feb_it_2015 ?>, <?php echo $mar_it_2015 ?>, <?php echo $apr_it_2015 ?>, <?php echo $may_it_2015 ?>, <?php echo $jun_it_2015 ?>, <?php echo $jul_it_2015 ?>, <?php echo $aug_it_2015 ?>, <?php echo $sep_it_2015 ?>, <?php echo $oct_it_2015 ?>, <?php echo $nov_it_2015 ?>, <?php echo $dec_it_2015 ?>],
				spanGaps: false
			},
			{
				label: "2016",
				fill: false,
				lineTension: 0.1,
				backgroundColor: "rgba(255,165,0,1)",
				borderColor: "rgba(255,165,0,1)",
				borderCapStyle: 'butt',
				borderDash: [],
				borderDashOffset: 0.0,
				borderJoinStyle: 'miter',
				pointBorderColor: "rgba(75,192,192,1)",
				pointBackgroundColor: "#fff",
				pointBorderWidth: 1,
				pointHoverRadius: 5,
				pointHoverBackgroundColor: "#F15854",
				pointHoverBorderColor: "#F15854",
				pointHoverBorderWidth: 2,
				pointRadius: 1,
				pointHitRadius: 10,
				data: [<?php echo $jan_it_2016 ?>, <?php echo $feb_it_2016 ?>, <?php echo $mar_it_2016 ?>, <?php echo $apr_it_2016 ?>, <?php echo $may_it_2016 ?>, <?php echo $jun_it_2016 ?>, <?php echo $jul_it_2016 ?>, <?php echo $aug_it_2016 ?>, <?php echo $sep_it_2016 ?>, <?php echo $oct_it_2016 ?>, <?php echo $nov_it_2016 ?>, <?php echo $dec_it_2016 ?>],
				spanGaps: false
			}
			]
		};


	//var ctx1 = document.getElementById("yearChartLine");

	function lineChartForYears() {
		var myNewChart = new Chart("2016_2015_line", {
			type: 'line',
			data: data_years,
			options: {maintainAspectRatio: true}
		}
		)
	};


	addFunctionOnWindowLoad(lineChartForYears);
</script>

<!-- pie chart for USA and Canada -->
<script type="text/javascript">
	var datapieCountry = {
		labels: ["USA", "Canada"],
		datasets: [
		{
			backgroundColor: [
					// randomColor(),
					// randomColor()
					"#85C1E9",
					"rgba(255,165,0,1)"
					],
					data: [<?php echo $totaldays_usa_it ?>, <?php echo $totaldays_canada_it ?>]
				}
				]
			};

			var pieOptions = {
				events: false,
				animation: {
					duration: 500,
					easing: "easeOutQuart",
					onComplete: function () {
						var ctx = this.chart.ctx;
						ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
						ctx.textAlign = 'center';
						ctx.textBaseline = 'bottom';

						this.data.datasets.forEach(function (dataset) {

							for (var i = 0; i < dataset.data.length; i++) {
								var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
								total = dataset._meta[Object.keys(dataset._meta)[0]].total,
								mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
								start_angle = model.startAngle,
								end_angle = model.endAngle,
								mid_angle = start_angle + (end_angle - start_angle)/2;

								var x = mid_radius * Math.cos(mid_angle);
								var y = mid_radius * Math.sin(mid_angle);

								ctx.fillStyle = '#fff';
				  if (i == 3){ // Darker text color for lighter background
				  	ctx.fillStyle = '#444';
				  }
				  var percent = String(Math.round(dataset.data[i]/total*100)) + "%";
				  ctx.fillText(dataset.data[i], model.x + x, model.y + y);
				  // Display percent in another line, line break doesn't work for fillText
				  ctx.fillText(percent, model.x + x, model.y + y + 15);
				}
			});               
					}
				}
			};

			function pieChartCountry() {
				var myNewChart = new Chart("pieChartUSACanada", {
					type: 'pie',
					data: datapieCountry,
					options: pieOptions
				}
				)
			};

			addFunctionOnWindowLoad(pieChartCountry);
		</script>




		<script>
			<?php

			$S_4_Query = "SELECT DISTINCT COUNT(*) as count FROM `abcd_planning_2016`";

			$S_4_Count = mysql_query($S_4_Query, $conn);

    if (!$S_4_Count) { // add this check.
    	die('Invalid query: ' . mysql_error());
    }   

    $row_s4 = mysql_fetch_array($S_4_Count);

    $NON_S_4_Query = "SELECT DISTINCT COUNT(*) as count FROM `abcd_planning_non_s4_2016`";

    $NON_S_4_Count = mysql_query($NON_S_4_Query, $conn);
    if (!$NON_S_4_Count) { // add this check.
    	die('Invalid query: ' . mysql_error());
    }   

    $row_non_s4 = mysql_fetch_array($NON_S_4_Count);
    ?>
    
    var data = {
    	labels: ["S/4", "Non S/4"],
    	datasets: [
    	{
    		backgroundColor: [
    		"#52BE80",
    		"#EB984E"
    		],
    		data: [<?php echo $row_s4['count'] ?>, <?php echo $row_non_s4['count'] ?>]
    	}
    	]
    };

    var pieOptions = {
    	events: false,
    	animation: {
    		duration: 500,
    		easing: "easeOutQuart",
    		onComplete: function () {
    			var ctx = this.chart.ctx;
    			ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
    			ctx.textAlign = 'center';
    			ctx.textBaseline = 'bottom';

    			this.data.datasets.forEach(function (dataset) {

    				for (var i = 0; i < dataset.data.length; i++) {
    					var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
    					total = dataset._meta[Object.keys(dataset._meta)[0]].total,
    					mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
    					start_angle = model.startAngle,
    					end_angle = model.endAngle,
    					mid_angle = start_angle + (end_angle - start_angle)/2;

    					var x = mid_radius * Math.cos(mid_angle);
    					var y = mid_radius * Math.sin(mid_angle);

    					ctx.fillStyle = '#fff';
                  if (i == 3){ // Darker text color for lighter background
                  	ctx.fillStyle = '#444';
                  }
                  var percent = String(Math.round(dataset.data[i]/total*100)) + "%";
                //ctx.fillText(dataset.data[i], model.x + x, model.y + y);
                  // Display percent in another line, line break doesn't work for fillText
                  ctx.fillText(percent, model.x + x, model.y + y + 15);
              }
          });               
    		}
    	}
    };


    function pieChart() {
    	var myPieChart = new Chart("planningChart",{
    		type: 'pie',
    		data: data,
    		options: pieOptions
    	})
    };

    addFunctionOnWindowLoad(pieChart);

</script>


</head>
<body>

	<div class="wrapper">
		<div class="sidebar" data-background-color="black" data-active-color="info">

	<!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

	<div class="sidebar-wrapper" style="width:100%">
		<div class="logo">
			Dashboards
		</div>

		<ul class="nav">
			<li class="inactive">
				<a href="index.php">
					<i class="ti-panel"></i>
					<p>MO</p>
				</a>
			</li>
			<li class="active">
				<a href="itplanning.php">
					<i class="ti-panel"></i>
					<p>ITP</p>
				</a>
			</li>
		</ul>
	</div>
</div>

<div class="main-panel">
	<div class="content">
		<div class="row" style="margin-bottom: 0px">

			<div class="col-md-6" style="padding-left: 0px">
				<div class="card">
					<div class="header">
						<h4 class="title"><center><a href ="all_services_it.php">Service Days Delivered</a></center></h4>
					</div>
					<div class="content">
						<div >
							<canvas id="pieChartUSACanada" style="height:50%"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6" style="padding-left: 0px">
				<div class="card ">
					<div class="header">
						<h4 class="title"><center><a href="ITStatsbyYear.php">2015 & 2016</a></center></h4>
						<p class="category"></p>
					</div>
					<div class="content">
						<div>
							<canvas id="2016_2015_line"></canvas>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="row" style="margin-bottom: 0px">

			<div class="col-md-6" style="padding-left: 0px">
				<div class="card">
					<div class="header">
						<?php $ans_it = mysql_fetch_array($NoServicesResultIT, MYSQL_ASSOC); ?>
						<h4 class="title"><center><a href="newITP.php">Services</a></center></h4>
						<p class="category"></p>
					</div>
					<div class="content">
						<div id="newServiceChart" style="height: 36vh; width: 98%">
							<!-- <canvas id="serviceChart" style="height:50%"></canvas> -->
						</div>
					</div>
				</div>
			</div>

			<?php
			$US_Total_it = mysql_fetch_array($us_empl_result_it, MYSQL_ASSOC);
			//$others_Total_it = mysql_fetch_array($other_empl_result_it, MYSQL_ASSOC);
			$others_Total_it = ($total_it_2016 - $US_Total_it['USEmp']);
			$US_Total_it_special = mysql_fetch_array($empl_result_it_special, MYSQL_ASSOC);
			?>

			<div class="col-md-6" style="padding-left: 0px">
				<div class="card">
					<div class="header">
						<h2 class="title"><center><a href="2016_it.php"><?php echo ceil($others_Total_it + $US_Total_it_special['USEmp']) ?></a></center></h2>
						<p class="category"></p>
					</div>
					<div class="content">
						<div >
							<canvas id="chartContainer2016Bar" style="height:50%"></canvas>
						</div>

					</div>
				</div>
			</div>	
		</div>
		<div class="row" style="margin-bottom: 0px">
			<div class="col-md-6" style="padding-left: 0px">
				<div class="card">
					<div class="header">
						<h4 class="title"><center><a href="Planning.php">Planned Projects</a></center></h4>
						<p class="category"></p>
					</div>
					<div class="content">
						<div >
							<canvas id="planningChart" style="height:50%"></canvas>
						</div>

					</div>
				</div>
			</div>


			<?php
			//$US_Total_it = mysql_fetch_array($us_empl_result_it, MYSQL_ASSOC);
			//$others_Total_it = mysql_fetch_array($other_empl_result_it, MYSQL_ASSOC);
			//$others_Total_it = ($total_it_2016 - $US_Total_it['USEmp']);
			//$US_Total_it_special = mysql_fetch_array($empl_result_it_special, MYSQL_ASSOC);
			?>

			<div class="col-lg-3 col-sm-6" style="padding-left: 0px">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-success text-center">
									<i class="ti-world"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p>Non CoE NA ITP</p>
									<a href="NON_NA_ITP.php"><?php echo $others_Total_it ?></a>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6" style="padding-left: 0px">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-warning text-center">
									<i class="ti-home"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p>CoE NA ITP</p>
									<a href="NA_ITP.php"><?php echo $US_Total_it_special['USEmp'] ?></a>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6" style="padding-left: 0px">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-info text-center">
									<i class="ti-clipboard"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p>Internal Orders</p>
									<?php 
									$internalorders_itp = mysql_fetch_array($US_empl_result_special_internal, MYSQL_ASSOC);
									?>
									<a href="Order-Class.php"><?php echo  $internalorders_itp['Total'];?> </a>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>


			<div class="col-lg-3 col-sm-6" style="padding-left: 0px">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-success text-center">
									<i class="ti-credit-card"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p>Customer Orders</p>
									<?php 
									mysql_data_seek($empl_result_it_special, 0);
									$customerorders_itp = mysql_fetch_array($empl_result_it_special, MYSQL_ASSOC);
									?>
									<a href="Order-Class.php"><?php echo  $customerorders_itp['USEmp'];?> </a>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>




		</div>
	</div>
</div>
</div>
</div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio.js"></script>


<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Demo ONLY  -->
<script type="text/javascript" src="assets/js/chartist.min.js"></script>
<script type="text/javascript" src="assets/js/demo.js"></script>

</html>
