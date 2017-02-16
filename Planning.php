<!DOCTYPE html>
<html>
<head>
	<title>Workshop Planning</title>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/jquery.canvasjs.min.js" type="text/javascript"></script>

	<style type="text/css">
		.canvasjs-chart-credit {
			display: none;
		}
	</style>
	<script>
      console.log("%cWhat's up? This area is forbidden.", "background: red; color: yellow; font-size: x-large");

  </script>

	<style>
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
	</style>
	
	<?php include 'database_retrival.php' ?>

	<?php

	$S_4_Query = "SELECT DISTINCT COUNT(*) as count FROM `abcd_planning_2017`";

	$S_4_Count = mysql_query($S_4_Query, $conn);

	if (!$S_4_Count) { // add this check.
		die('Invalid query: ' . mysql_error());
	}	

	$row_s4 = mysql_fetch_array($S_4_Count);

	$NON_S_4_Query = "SELECT DISTINCT COUNT(*) as count FROM `abcd_planning_non_s4_2017`";

	$NON_S_4_Count = mysql_query($NON_S_4_Query, $conn);
	if (!$NON_S_4_Count) { // add this check.
		die('Invalid query: ' . mysql_error());
	}	

	$row_non_s4 = mysql_fetch_array($NON_S_4_Count);
	?>

	<script>

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
			var myPieChart = new Chart("pieChart",{
				type: 'pie',
				data: data,
				options: pieOptions
			})
		};

		addFunctionOnWindowLoad(pieChart);

	</script>
</head>

<body>
	<center><h3>Planned Projects</h3></center>
	<div class="row">
		<div class="col s3">
			<canvas id="pieChart"></canvas>
		</div>

		<div class="col s6">
			<ul class="collapsible popout" data-collapsible="accordion">
				<li>
					<div class="collapsible-header"><b>S/4 HANA</b></div>
					<div class="collapsible-body">
						<ul class="collapsible popout" data-collapsible="accordion">
							<li>
								<div class="collapsible-header">New</div>
								<div class="collapsible-body">

									<?php
									echo '<ul class="collapsible popout" data-collapsible="accordion">';
									$query1 = "SELECT * from `abcd_planning_2017` WHERE status = 'New'";

									$result1 = mysql_query($query1, $conn);

				if (!$result1) { // add this check.
					die('Invalid query: ' . mysql_error());
				}
				echo '<table>';
				echo '<tr><th>Customer</th><th>Week</th><th>Year</th><th>Type</th><th>SO</th><th>Implementation</th><th>Workshop</th><th>Team Lead</th></tr>';
				while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
				
				echo '<tr><td>' . $row1['customer'] . '</td><td>' . $row1['week'] . '</td><td>' . $row1['year'] . '</td><td>' . $row1['type'] . '</td><td>' . $row1['SO'] . '</td><td>' . $row1['implementation'] . '</td><td>' . $row1['workshop'] . '</td><td>' .$row1['teamlead'] . '</td></tr>'; 
				
				


				
			}
			echo '</table>';
			echo '</li>';
			echo '</ul>';
			?>
		</div>
	</li>

	<li>
		<div class="collapsible-header">Delivered</div>
		<div class="collapsible-body">

			<?php
			echo '<ul class="collapsible popout" data-collapsible="accordion">';
			$query1 = "SELECT * from `abcd_planning_2017` WHERE status = 'Delivered'";

			$result1 = mysql_query($query1, $conn);

				if (!$result1) { // add this check.
					die('Invalid query: ' . mysql_error());
				}

				echo '<table>';
				echo '<tr><th>Customer</th><th>Week</th><th>Year</th><th>Type</th><th>SO</th><th>Implementation</th><th>Workshop</th><th>Team Lead</th></tr>';
				while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
				
				echo '<tr><td>' . $row1['customer'] . '</td><td>' . $row1['week'] . '</td><td>' . $row1['year'] . '</td><td>' . $row1['type'] . '</td><td>' . $row1['SO'] . '</td><td>' . $row1['implementation'] . '</td><td>' . $row1['workshop'] . '</td><td>' .$row1['teamlead'] . '</td></tr>'; 
				
				


				
			}
			echo '</table>';
			echo '</li>';
			echo '</ul>';
			?>
			</div>
		</li>
	</ul>
</div>
</li>

<li>
	<div class="collapsible-header"><b>NON S/4</b></div>
	<div class="collapsible-body">
		<ul class="collapsible popout" data-collapsible="accordion">
			<li>
				<div class="collapsible-header">New</div>
				<div class="collapsible-body">

					<?php
					echo '<ul class="collapsible popout" data-collapsible="accordion">';
					$query1 = "SELECT * from `abcd_planning_non_s4_2017` WHERE status = 'New'";

					$result1 = mysql_query($query1, $conn);

				if (!$result1) { // add this check.
					die('Invalid query: ' . mysql_error());
				}

				echo '<table>';
				echo '<tr><th>Customer</th><th>Week</th><th>Year</th><th>Type</th><th>SO</th><th>Implementation</th><th>Team Lead</th></tr>';
				while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
				
				echo '<tr><td>' . $row1['customer'] . '</td><td>' . $row1['week'] . '</td><td>' . $row1['year'] . '</td><td>' . $row1['type'] . '</td><td>' . $row1['SO'] . '</td><td>' . $row1['implementation'] . '</td><td>'  .$row1['teamlead'] . '</td></tr>'; 
				
				


				
			}
			echo '</table>';
			echo '</li>';
			echo '</ul>';
				?>
			</div>
		</li>

		<li>
			<div class="collapsible-header">Delivered</div>
			<div class="collapsible-body">

				<?php
				echo '<ul class="collapsible popout" data-collapsible="accordion">';
				$query1 = "SELECT * from `abcd_planning_non_s4_2017` WHERE status = 'Delivered'";

				$result1 = mysql_query($query1, $conn);

				if (!$result1) { // add this check.
					die('Invalid query: ' . mysql_error());
				}

				echo '<table>';
				echo '<tr><th>Customer</th><th>Week</th><th>Year</th><th>Type</th><th>SO</th><th>Implementation</th><th>Team Lead</th></tr>';
				while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
				
				echo '<tr><td>' . $row1['customer'] . '</td><td>' . $row1['week'] . '</td><td>' . $row1['year'] . '</td><td>' . $row1['type'] . '</td><td>' . $row1['SO'] . '</td><td>' . $row1['implementation'] . '</td><td>'  .$row1['teamlead'] . '</td></tr>'; 
				
				


				
			}
			echo '</table>';
			echo '</li>';
			echo '</ul>';
				?>
			</div>
		</li>
	</ul>
</div>
</li>
</ul>
</div>
</li>
</ul>
</div>





</body>
</html>