<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>IT Planning Dashboard</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>


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

    
    <!-- Data Retrival PHP File - very important -->
    <?php include 'database_retrival.php' ?>


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
          legend: {display: true, position: 'right'},
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
                  ctx.fillText(dataset.data[i], model.x + x, model.y + y);
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

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="info">

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
                <div class="row" >

                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><center><a href ="all_services_it.php">Service Days Delivered</a></center></h4>
                            </div>
                            <div class="content">
                                <div >
                                    <canvas id="pieChartUSACanada"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title"><center><a href="ITStatsbyYear.php">2015 & 2016</a></center></h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <div >
                                    <canvas id="2016_2015_line"></canvas>
                                </div>

                                <div class="footer">
                                    <!-- <hr>
                                    <div class="stats">
                                        
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><center><a href="2016_it.php">2016 Total: <?php echo $total_it_2016 ?></a></center></h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <div >
                                    <canvas id="chartContainer2016Bar"></canvas>
                                </div>

                                <div class="footer">
                                    <!-- <hr>
                                    <div class="stats">
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                    <div class="card">
                        <div class="header">
                            <h4 class="title"><center><a href="services_it_filter.php">Services</a></center></h4>
                            <p class="category"></p>
                        </div>
                        <div class="content">
                            <div >
                                <canvas id="doughnut-Chart"></canvas>
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
