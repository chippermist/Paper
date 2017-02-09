<!DOCTYPE html>
<html lang="en">
	<head>
		<title>2017 & 2016 Stats</title>
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
    	<?php include 'database_retrival.php' ?>
        <script>
      console.log("%cWhat's up? This area is forbidden.", "background: red; color: yellow; font-size: x-large");

  </script>

		<script type="text/javascript">
        var data_years = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
            {
                label: "2017",
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
                data: [<?php echo $jan_mos_2017 ?>, <?php echo $feb_mos_2017 ?>, <?php echo $mar_mos_2017 ?>, <?php echo $apr_mos_2017 ?>, <?php echo $may_mos_2017 ?>, <?php echo $jun_mos_2017 ?>, <?php echo $jul_mos_2017 ?>, <?php echo $aug_mos_2017 ?>, <?php echo $sep_mos_2017 ?>, <?php echo $oct_mos_2017 ?>, <?php echo $nov_mos_2017 ?>, <?php echo $dec_mos_2017 ?>],
                spanGaps: false
            },
            {
                label: "2016",
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
                data: [<?php echo $jan_mos_2016 ?>, <?php echo $feb_mos_2016 ?>, <?php echo $mar_mos_2016 ?>, <?php echo $apr_mos_2016 ?>, <?php echo $may_mos_2016 ?>, <?php echo $jun_mos_2016 ?>, <?php echo $jul_mos_2016 ?>, <?php echo $aug_mos_2016 ?>, <?php echo $sep_mos_2016 ?>, <?php echo $oct_mos_2016 ?>, <?php echo $nov_mos_2016 ?>, <?php echo $dec_mos_2016 ?>],
                spanGaps: false
            }
        ]
    };


    //var ctx1 = document.getElementById("yearChartLine");

    function lineChartForYears() {
        var myNewChart = new Chart("2017_2016_line", {
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
            <div class="col-md-6" style="width:50%">
			
				<canvas id="2017_2016_line"></canvas>
			
            </div>
			
			<div class="col-md-6" style="width:50%">
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

				echo '<table><thead><tr><th>Month</th><th>2016</th><th>2017</th></tr></thead>';
				echo '<tr><td>January</td><td>' . $jan_mos_2016 . '</td><td>' . $jan_mos_2017 . '</td></tr>';
				echo '<tr><td>February</td><td>' . $feb_mos_2016 . '</td><td>' . $feb_mos_2017 . '</td></tr>';
				echo '<tr><td>March</td><td>' . $mar_mos_2016 . '</td><td>' . $mar_mos_2017 . '</td></tr>';
				echo '<tr><td>April</td><td>' . $apr_mos_2016 . '</td><td>' . $apr_mos_2017 . '</td></tr>';
				echo '<tr><td>May</td><td>' . $may_mos_2016 . '</td><td>' . $may_mos_2017 . '</td></tr>';
				echo '<tr><td>June</td><td>' . $jun_mos_2016 . '</td><td>' . $jun_mos_2017 . '</td></tr>';
				echo '<tr><td>July</td><td>' . $jul_mos_2016 . '</td><td>' . $jul_mos_2017 . '</td></tr>';
				echo '<tr><td>August</td><td>' . $aug_mos_2016 . '</td><td>' . $aug_mos_2017 . '</td></tr>';
				echo '<tr><td>September</td><td>' . $sep_mos_2016 . '</td><td>' . $sep_mos_2017 . '</td></tr>';
				echo '<tr><td>October</td><td>' . $oct_mos_2016 . '</td><td>' . $oct_mos_2017 . '</td></tr>';
				echo '<tr><td>November</td><td>' . $nov_mos_2016 . '</td><td>' . $nov_mos_2017 . '</td></tr>';
				echo '<tr><td>December</td><td>' . $dec_mos_2016 . '</td><td>' . $dec_mos_2017 . '</td></tr>';
				echo '<tr><th>Total</th><th>' . $total_mos_2016 . '</th><th>' . $total_mos_2017 . '</th></tr>';
				echo '</table>';
			?>
			</div>
            
			<div>
				<?php
				echo '<table><thead><tr><th>Country</th><th>2016</th><th>2017</th></tr></thead>';

				echo '<tr><td>USA</td><td>'. $totaldays_usa_2016 . '</td><td>' . $totaldays_usa_2017 . '</td></tr>';
				echo '<tr><td>Canada</td><td>'. $totaldays_canada_2016 . '</td><td>' . $totaldays_canada_2017. '</td></tr>';

				echo '</table>'; 
				?>
			</div>
		</div>
	</body>
</html>