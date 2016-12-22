<!DOCTYPE html>
<html>
<head>
	<title>IT Planning Data - Services</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<script src="assets/js/main.js" type="text/javascript" ></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/randomcolor/0.4.4/randomColor.min.js"></script>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


	<?php

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = "mysql";
	$conn = mysql_connect($dbhost, $dbuser, $dbpass, $dbname);

	mysql_select_db('mysql');

	$query1 = "SELECT distinct service, count(SO) as Days FROM `abcd_it_2016_extra` GROUP BY service";

	$result1 = mysql_query($query1, $conn);

	if(!$result1) {
		die('Could not get data from new ITP 2016 result1: ' . mysql_error());
	}

	?>


	<script type="text/javascript">
		<?php
		
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

		var serviceChartOptions = {
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

		function serviceCategoryChart() {
			var myNewChart = new Chart("serviceChart", {
				type: 'doughnut',
				data: serviceChartData,
				options: serviceChartOptions
			})
		};

		addFunctionOnWindowLoad(serviceCategoryChart);

	</script>

</head>
<body>
	<div class="row">
		<div class="col s4"><br><br><br><br><canvas id=serviceChart></canvas></div>
		
		<div class="col s8">
			<br><br><br><br><br><br><br><br>

			<ul class="collapsible popout" data-collapsible="accordion" style="width: 50%">

				<?php
				mysql_data_seek($result1, 0);
				while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
					echo '<li>';
					echo '<div class="collapsible-header"> <i class="material-icons">view_list</i>' . $row1['service'] . '</div><div class="collapsible-body">';
					$servicename = $row1['service'];
					$query2 = "SELECT distinct subservice, count(SO) as Orders FROM `abcd_it_2016_extra` WHERE service = '$servicename' GROUP BY subservice" ;

					$result2 = mysql_query($query2, $conn);

					if(!$result2) {
						die('Could not get data from new ITP 2016 result2: ' . mysql_error());
					}

					echo '<ul class="collapsible popout" data-collapsible="accordion">';

			    //echo '<p><center><table class="highlight">';
					while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
						echo '<li><div class="collapsible-header"><i class="material-icons">toc</i>' . $row2['subservice'] . ' - <b>' . $row2['Orders'] . '</b></div><div class="collapsible-body">';
						$subservicename = $row2['subservice'];
						$query3 = "SELECT company , count(SO) as Total FROM `abcd_it_2016_extra` WHERE subservice = '$subservicename' GROUP BY company";
						$result3 = mysql_query($query3, $conn);

						if(!$result3) {
							die('Could not get data from new ITP 2016 result3: ' . mysql_error());
						}

						echo "<style>
						table {
							border-collapse: collapse;
							width: 100%;
						}

						th, td {
							text-align: left;
							padding: 5px;
						}

						tr:nth-child(even){background-color: #f2f2f2}

						th {
							background-color: #F0AB00;
							color: white;
						}
					</style>";



					echo '<table class="highlight">';
					while($row3 = mysql_fetch_array($result3, MYSQL_ASSOC)){
						$url_bind = "company_table_it_ndata.php?company=";
						$url_bind .= $row3['company'];
						$url_bind .= "&service_=";
						$servicename_ = str_replace("&","%26",$subservicename );
						$url_bind .= $servicename_;
						echo '<tr><td><a href="' . $url_bind . '"><i class="material-icons">open_in_new</i></a> ' . $row3['company'] . '</td><td>' . $row3['Total'] . '</td></tr>';
					}

					echo '</table>';

					echo '</div></li>';
				}
				echo '</ul>';
			}

			mysql_close();
			?>


		</div>
		<br>
		<br>
		<center><a class="btn waves-effect waves-light red" href="services_it_filter.php">View All Companies</a></center>
	</div>

</body>
</html>



