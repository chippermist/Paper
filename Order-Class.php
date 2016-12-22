<!DOCTYPE html>
<html>
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
	<?php include 'database_retrival.php' ?>

	<?php

	$customerorders_mo = mysql_fetch_array($US_empl_result_special, MYSQL_ASSOC);
	$internalorders_mo = mysql_fetch_array($US_empl_result_special_internal, MYSQL_ASSOC);
	$customerorders_itp = mysql_fetch_array($empl_result_it_special, MYSQL_ASSOC);
	$internalorders_itp = mysql_fetch_array($US_empl_result_special_internal, MYSQL_ASSOC);;


	?>

	<script>

		var data = {
			labels: ["Internal Order", "Customer Order"],
			datasets: [
			{
				backgroundColor: [
				"#85C1E9",
				"rgba(255,165,0,1)"
				],
				data: [<?php echo ($internalorders_mo['Total'] + $internalorders_itp['Total']) ?>, <?php echo ($customerorders_mo['USEmp'] + $customerorders_itp['USEmp']) ?>]
			}
			]
		};

		function pieChart() {
			var myPieChart = new Chart("pieChart",{
				type: 'pie',
				data: data
			})
		};

		addFunctionOnWindowLoad(pieChart);

	</script>
</head>

<body>
	<div class="row">
		<div class="col s3">
			<canvas id="pieChart"></canvas>
		</div>

		<div class="col s9">
			<ul class="collapsible popout" data-collapsible="accordion">
				<li>
					<div class="collapsible-header">MO</div>
					<div class="collapsible-body">
						<ul class="collapsible popout" data-collapsible="accordion">
							<li>
								<div class="collapsible-header">Customer Order</div>
								<div class="collapsible-body">

									<?php
									echo '<ul class="collapsible popout" data-collapsible="accordion">';
									$query1 = "SELECT distinct person, sum(days) as Total FROM `isp_recording` WHERE person IN ('Anil Kumar Kunapareddy', 'Julio Cezar Almeida', 'Parishudh Reddy Marupurolu', 'Chinmay Garg', 'Deepika Paturu', 'Kiran Bose', 'Rahul Shetti', 'Rajendra N', 'Rakesh Patel', 'Sriram Bhaskar', 'Wilson Karunakar Puvvula', 'Steven Sanchez') AND orderType = 'Customer Order' GROUP BY person";

									$result1 = mysql_query($query1, $conn);

				if (!$result1) { // add this check.
					die('Invalid query: ' . mysql_error());
				}

				while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
					echo '<li>';
					echo '<div class="collapsible-header">' . $row1['person'] . ' - ' . $row1['Total'] . '</div></li>';
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
				$query1 = "SELECT distinct person, sum(days) as Total FROM `isp_recording` WHERE person IN ('Anil Kumar Kunapareddy', 'Julio Cezar Almeida', 'Parishudh Reddy Marupurolu', 'Chinmay Garg', 'Deepika Paturu', 'Kiran Bose', 'Rahul Shetti', 'Rajendra N', 'Rakesh Patel', 'Sriram Bhaskar', 'Wilson Karunakar Puvvula', 'Steven Sanchez') AND orderType = 'Internal Order' GROUP BY person";

				$result1 = mysql_query($query1, $conn);

				if (!$result1) { // add this check.
					die('Invalid query: ' . mysql_error());
				}

				while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
					echo '<li>';
					echo '<div class="collapsible-header">' . $row1['person'] . ' - ' . $row1['Total'] . '</div></li>';
				}
				echo '</ul>';
				?>
			</div>
		</li>
	</ul>
</div>
</li>

<li>
	<div class="collapsible-header">ITP</div>
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
					echo '<div class="collapsible-header">' . $row1['person'] . ' - ' . $row1['Total'] . '</div></li>';
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
					echo '<div class="collapsible-header">' . $row1['person'] . ' - ' . $row1['Total'] . '</div></li>';
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