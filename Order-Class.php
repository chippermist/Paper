<!DOCTYPE html>
<html lang="en">
<head>
	<title>Order Classification</title>
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

	$customerorders_mo = mysql_fetch_array($US_empl_result_special, MYSQL_ASSOC);
	$internalorders_mo = mysql_fetch_array($US_empl_result_special_internal, MYSQL_ASSOC);
	$customerorders_itp = mysql_fetch_array($empl_result_it_special, MYSQL_ASSOC);
	$internalorders_itp = mysql_fetch_array($US_empl_result_special_internal, MYSQL_ASSOC);
	$total_internal = $internalorders_itp['Total'] + $internalorders_mo['Total'];

	?>

	<script>

		var data = {
			labels: ["Internal Order", "Customer Order"],
			datasets: [
			{
				backgroundColor: [
				"#52BE80",
				"#EB984E"
				],
				data: [<?php echo ($internalorders_mo['Total'] + $internalorders_itp['Total']) ?>, <?php echo ($customerorders_mo['USEmp'] + $customerorders_itp['USEmp']) ?>]
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
	<center><h3>Internal & Customer Orders</h3></center>
	<div class="row">
		<div class="col s3">
			<canvas id="pieChart"></canvas>
		</div>

		<div class="col s6">
			<ul class="collapsible popout" data-collapsible="accordion">
				<li>
					<div class="collapsible-header"><b>MO</b></div>
					<div class="collapsible-body">
						<ul class="collapsible popout" data-collapsible="accordion">
							<li>
								<div class="collapsible-header">Customer Order</div>
								<div class="collapsible-body">

									<?php
									echo '<ul class="collapsible popout" data-collapsible="accordion">';
									$query1 = "SELECT distinct person, sum(days) as Total FROM `isp_recording` WHERE person IN ('Anil Kumar Kunapareddy', 'Julio Cezar Almeida', 'Parishudh Reddy Marupurolu', 'Chinmay Garg', 'Deepika Paturu', 'Kiran Bose', 'Rahul Shetti', 'Rajendra N', 'Rakesh Patel', 'Sriram Bhaskar', 'Wilson Karunakar Puvvula', 'Steven Sanchez', 'Sandeep Kumar') AND orderType = 'Customer Order' GROUP BY person";

									$result1 = mysql_query($query1, $conn);

				if (!$result1) { // add this check.
					die('Invalid query: ' . mysql_error());
				}

				while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
					echo '<li>';
					echo '<div class="collapsible-header">' . $row1['person'] . ' - ' . $row1['Total'] . '</div>';
					echo '<div class="collapsible-body">';
					$personname = $row1['person'];

					$query2 = "SELECT SO, company, days as Total FROM `isp_recording` WHERE person = '$personname' AND orderType = 'Customer Order' GROUP BY SO";

					$result2 = mysql_query($query2, $conn);

				if (!$result2) { // add this check.
					die('Invalid query: ' . mysql_error());
				}

				echo '<table>';
				echo '<tr><th>SO</th><th>Company</th><th>Days</th></tr>';
				while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
					echo '<tr><td>' . $row2['SO'] . '</td><td>' . $row2['company'] . '</td><td>' . $row2['Total'] . '</td></tr>'; 
				}

				echo '</table>';


				echo '</li>';
			}
			echo '</ul>';
			?>
		</div>
	</li>

	<li>
		<div class="collapsible-header">Internal Order</div>
		<div class="collapsible-body">

			<?php
			echo '<ul class="collapsible popout" data-collapsible="accordion">';
			$query1 = "SELECT distinct person, sum(days) as Total FROM `isp_recording` WHERE person IN ('Anil Kumar Kunapareddy', 'Julio Cezar Almeida', 'Parishudh Reddy Marupurolu', 'Chinmay Garg', 'Deepika Paturu', 'Kiran Bose', 'Rahul Shetti', 'Rajendra N', 'Rakesh Patel', 'Sriram Bhaskar', 'Wilson Karunakar Puvvula', 'Steven Sanchez', 'Sandeep Kumar') AND orderType = 'Internal Order' GROUP BY person";

			$result1 = mysql_query($query1, $conn);

				if (!$result1) { // add this check.
					die('Invalid query: ' . mysql_error());
				}

				while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
					echo '<li>';
					echo '<div class="collapsible-header">' . $row1['person'] . ' - ' . $row1['Total'] . '</div>';
					echo '<div class="collapsible-body">';
					$personname = $row1['person'];

					$query2 = "SELECT SO, description, days as Total FROM `isp_recording` WHERE person = '$personname' AND orderType = 'Internal Order' GROUP BY SO";

					$result2 = mysql_query($query2, $conn);

					if (!$result2) { // add this check.
						die('Invalid query: ' . mysql_error());
					}

					echo '<table>';
					echo '<tr><th>IO</th><th>Type/Company</th><th>Days</th></tr>';
					while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
						echo '<tr><td>' . $row2['SO'] . '</td><td>' . $row2['description'] . '</td><td>' . $row2['Total'] . '</td></tr>'; 
					}


					echo '</table>';
					echo '</li>';
				}
				echo '</ul>';
				?>
			</div>
		</li>
	</ul>
</div>
</li>

<li>
	<div class="collapsible-header"><b>ITP</b></div>
	<div class="collapsible-body">
		<ul class="collapsible popout" data-collapsible="accordion">
			<li>
				<div class="collapsible-header">Customer Order</div>
				<div class="collapsible-body">

					<?php
					echo '<ul class="collapsible popout" data-collapsible="accordion">';
					$query1 = "SELECT distinct person, sum(days) as Total FROM `isp_recording` WHERE person IN ('Anil Kumar Kunapareddy', 'Kaushik Bangalore Venkatarama', 'David Uhr', 'Balakameswara Sarma Sishta', 'Kishan Vimalachandran', 'Abhishek Anand', 'mr. Mrinal Sarkar') AND orderType = 'Customer Order' GROUP BY person";

					$result1 = mysql_query($query1, $conn);

				if (!$result1) { // add this check.
					die('Invalid query: ' . mysql_error());
				}

				while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
					echo '<li>';
					echo '<div class="collapsible-header">' . $row1['person'] . ' - ' . $row1['Total'] . '</div>';
					echo '<div class="collapsible-body">';
					$personname = $row1['person'];

					$query2 = "SELECT SO, company, days as Total FROM `isp_recording` WHERE person = '$personname' AND orderType = 'Customer Order' GROUP BY SO";

					$result2 = mysql_query($query2, $conn);

					if (!$result2) { // add this check.
						die('Invalid query: ' . mysql_error());
					}

					echo '<table>';
					echo '<tr><th>SO</th><th>Company</th><th>Days</th></tr>';
					while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
						echo '<tr><td>' . $row2['SO'] . '</td><td>' . $row2['company'] . '</td><td>' . $row2['Total'] . '</td></tr>'; 
					}


					echo '</table>';


					echo '</li>';
				}
				echo '</ul>';
				?>
			</div>
		</li>

		<li>
			<div class="collapsible-header">Internal Order</div>
			<div class="collapsible-body">

				<?php
				echo '<ul class="collapsible popout" data-collapsible="accordion">';
				$query1 = "SELECT distinct person, sum(days) as Total FROM `isp_recording` WHERE person IN ('Anil Kumar Kunapareddy', 'Kaushik Bangalore Venkatarama', 'David Uhr', 'Balakameswara Sarma Sishta', 'Kishan Vimalachandran', 'Abhishek Anand', 'mr. Mrinal Sarkar') AND orderType = 'Internal Order' GROUP BY person";

				$result1 = mysql_query($query1, $conn);

				if (!$result1) { // add this check.
					die('Invalid query: ' . mysql_error());
				}

				while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
					echo '<li>';
					echo '<div class="collapsible-header">' . $row1['person'] . ' - ' . $row1['Total'] . '</div>';
					echo '<div class="collapsible-body">';
					$personname = $row1['person'];

					$query2 = "SELECT SO, description, days as Total FROM `isp_recording` WHERE person = '$personname' AND orderType = 'Internal Order' GROUP BY SO";

					$result2 = mysql_query($query2, $conn);

					if (!$result2) { // add this check.
						die('Invalid query: ' . mysql_error());
					}

					echo '<table>';
					echo '<tr><th>IO</th><th>Type/Company</th><th>Days</th></tr>';
					while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
						echo '<tr><td>' . $row2['SO'] . '</td><td>' . $row2['description'] . '</td><td>' . $row2['Total'] . '</td></tr>'; 
					}


					echo '</table>';

					echo '</li>';
				}
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