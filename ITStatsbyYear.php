<!DOCTYPE html>
<html lang="en">
	<head>
		<title>2016 & 2015 Stats</title>
		<link rel="stylesheet" type="text/css" href="../dmo/css/styles.css"/>
		<!--  Paper Dashboard core CSS    -->
    	<link href="assets/css/paper-dashboard.css" rel="stylesheet"/>
    	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    	  <!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

	    <!-- Compiled and minified JavaScript -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
		<!-- Data Retrival PHP File - very important -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    	<script type="text/javascript" src="assets/js/main.js"></script>
        <script>
      console.log("%cWhat's up? This area is forbidden.", "background: red; color: yellow; font-size: x-large");

  </script>
    	<?php include 'database_retrival.php' ?>

		<script type="text/javascript">
        var data_years = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
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
            },
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
	</head>

	<body>
		<div class="row">
			<div class="left" style="width:50%">
				<canvas id="2016_2015_line"></canvas>
			</div> 
			
			<div>
			<?php
				echo "<style>
					table {
					    border-collapse: collapse;
					    width: 40%;
					}

					th, td {
					    text-align: left;
					    padding: 5px;
						border: -moz-use-text-color;
					}

					tr:nth-child(even){background-color: #f2f2f2}

					th {
					    background-color: #F0AB00;
					    color: white;
					}
					</style>
					";

				echo '<table><thead><tr><th>Month</th><th>2015</th><th>2016</th></tr></thead>';
				echo '<tr><td>January</td><td>' . $jan_it_2015 . '</td><td>' . $jan_it_2016 . '</td></tr>';
				echo '<tr><td>February</td><td>' . $feb_it_2015 . '</td><td>' . $feb_it_2016 . '</td></tr>';
				echo '<tr><td>March</td><td>' . $mar_it_2015 . '</td><td>' . $mar_it_2016 . '</td></tr>';
				echo '<tr><td>April</td><td>' . $apr_it_2015 . '</td><td>' . $apr_it_2016 . '</td></tr>';
				echo '<tr><td>May</td><td>' . $may_it_2015 . '</td><td>' . $may_it_2016 . '</td></tr>';
				echo '<tr><td>June</td><td>' . $jun_it_2015 . '</td><td>' . $jun_it_2016 . '</td></tr>';
				echo '<tr><td>July</td><td>' . $jul_it_2015 . '</td><td>' . $jul_it_2016 . '</td></tr>';
				echo '<tr><td>August</td><td>' . $aug_it_2015 . '</td><td>' . $aug_it_2016 . '</td></tr>';
				echo '<tr><td>September</td><td>' . $sep_it_2015 . '</td><td>' . $sep_it_2016 . '</td></tr>';
				echo '<tr><td>October</td><td>' . $oct_it_2015 . '</td><td>' . $oct_it_2016 . '</td></tr>';
				echo '<tr><td>November</td><td>' . $nov_it_2015 . '</td><td>' . $nov_it_2016 . '</td></tr>';
				echo '<tr><td>December</td><td>' . $dec_it_2015 . '</td><td>' . $dec_it_2016 . '</td></tr>';
				echo '<tr><th>Total</th><th>' . $total_it_2015 . '</th><th>' . $total_it_2016 . '</th></tr>';
				echo '</table>';
			?>
			</div>

			<div>
				<?php
				echo '<table><thead><tr><th>Country</th><th>2015</th><th>2016</th></tr></thead>';

				echo '<tr><td>USA</td><td>'. $totaldays_usa_it_2015 . '</td><td>' . $totaldays_usa_it . '</td></tr>';
				echo '<tr><td>Canada</td><td>'. $totaldays_canada_it_2015 . '</td><td>' . $totaldays_canada_it . '</td></tr>';

				echo '</table>'; 
				?>
			</div>
		</div>
	</body>
</html>