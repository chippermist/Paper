<!DOCTYPE html>
<html lang="en">
	<head>
		<title>2016 Stats</title>
		<link rel="stylesheet" type="text/css" href="../dmo/css/styles.css"/>
		<!--  Paper Dashboard core CSS    -->
    	<link href="assets/css/paper-dashboard.css" rel="stylesheet"/>
    	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    	  <!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

		<!-- Data Retrival PHP File - very important -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    	<script type="text/javascript" src="assets/js/main.js"></script>
    	<?php include 'database_retrival.php' ?>

		<script type="text/javascript">

        var dataBar2016 = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [
                {
                    backgroundColor: '#F15854',
                    borderColor: "#F15854",
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
	</head>

	<body>
		<div class="row">
        <br><br><br>
			<div class="left" style="width:50%">
				<canvas id="chartContainer2016Bar"></canvas>
			</div> 
			<div >
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

				echo '<table><thead><tr><th>Month</th><th>2016</th></tr></thead>';
				echo '<tr><td>January</td><td>' . $jan_it_2016 . '</td></tr>';
				echo '<tr><td>February</td><td>' . $feb_it_2016 . '</td></tr>';
				echo '<tr><td>March</td><td>' . $mar_it_2016 . '</td></tr>';
				echo '<tr><td>April</td><td>' . $apr_it_2016 . '</td></tr>';
				echo '<tr><td>May</td><td>' . $may_it_2016 . '</td></tr>';
				echo '<tr><td>June</td><td>' . $jun_it_2016 . '</td></tr>';
				echo '<tr><td>July</td><td>' . $jul_it_2016 . '</td></tr>';
				echo '<tr><td>August</td><td>' . $aug_it_2016 . '</td></tr>';
				echo '<tr><td>September</td><td>' . $sep_it_2016 . '</td></tr>';
				echo '<tr><td>October</td><td>' . $oct_it_2016 . '</td></tr>';
				echo '<tr><td>November</td><td>' . $nov_it_2016 . '</td></tr>';
				echo '<tr><td>December</td><td>' . $dec_it_2016 . '</td></tr>';
				echo '<tr><th>Total</th><th>' . $total_it_2016 . '</th></tr>';
				echo '</table>';
			?>
			</div>
		</div>
	</body>
</html>