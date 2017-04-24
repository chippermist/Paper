<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-89738956-1', 'auto');
    ga('send', 'pageview');

  </script>
  <script>
    console.log("%cWhat's up? This area is forbidden.", "background: red; color: yellow; font-size: x-large");

  </script>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <title>MO Dashboard</title>

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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/jquery.canvasjs.min.js" type="text/javascript"></script>


  <style type="text/css">
    .canvasjs-chart-credit {
     display: none;
   }
 </style>
 <!-- Data Retrival PHP File - very important -->
 <?php include 'database_retrival.php' ?>




 <script type="text/javascript">

  var dataBar2017 = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [
    {
      backgroundColor: '#F1C40F',
      borderColor: "#F1C40F",
      data: [<?php echo $jan_mos_2017+$jan_it_2017 ?>, <?php echo $feb_mos_2017+$feb_it_2017 ?>, <?php echo $mar_mos_2017+$mar_it_2017 ?>, <?php echo $apr_mos_2017+$apr_it_2017 ?>, <?php echo $may_mos_2017+$may_it_2017 ?>, <?php echo $jun_mos_2017+$jun_it_2017 ?>, <?php echo $jul_mos_2017+$jul_it_2017 ?>, <?php echo $aug_mos_2017+$aug_it_2017 ?>, <?php echo $sep_mos_2017+$sep_it_2017 ?>, <?php echo $oct_mos_2017+$oct_it_2017 ?>, <?php echo $nov_mos_2017+$nov_it_2017 ?>, <?php echo $dec_mos_2017+$dec_it_2017 ?>],
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
    var newChart = new Chart("chartContainer2017Bar", {
      type: 'bar',
      data: dataBar2017,
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
      data: [<?php echo $jan_mos_2016+$jan_it_2016 ?>, <?php echo $feb_mos_2016+$feb_it_2016 ?>, <?php echo $mar_mos_2016+$mar_it_2016 ?>, <?php echo $apr_mos_2016+$apr_it_2016 ?>, <?php echo $may_mos_2016+$may_it_2016 ?>, <?php echo $jun_mos_2016+$jun_it_2016 ?>, <?php echo $jul_mos_2016+$jul_it_2016 ?>, <?php echo $aug_mos_2016+$aug_it_2016 ?>, <?php echo $sep_mos_2016+$sep_it_2016 ?>, <?php echo $oct_mos_2016+$oct_it_2016 ?>, <?php echo $nov_mos_2016+$nov_it_2016 ?>, <?php echo $dec_mos_2016+$dec_it_2016 ?>],
      spanGaps: false
    },
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
      data: [<?php echo $jan_mos_2017+$jan_it_2017 ?>, <?php echo $feb_mos_2017+$feb_it_2017 ?>, <?php echo $mar_mos_2017+$mar_it_2017 ?>, <?php echo $apr_mos_2017+$apr_it_2017 ?>, <?php echo $may_mos_2017+$may_it_2017 ?>, <?php echo $jun_mos_2017+$jun_it_2017 ?>, <?php echo $jul_mos_2017+$jul_it_2017 ?>, <?php echo $aug_mos_2017+$aug_it_2017 ?>, <?php echo $sep_mos_2017+$sep_it_2017 ?>, <?php echo $oct_mos_2017+$oct_it_2017 ?>, <?php echo $nov_mos_2017+$nov_it_2017 ?>, <?php echo $dec_mos_2017+$dec_it_2017 ?>],
      spanGaps: false
    }
    ]
  };


    //var ctx1 = document.getElementById("yearChartLine");

    function lineChartForYears() {
      var myNewChart = new Chart("2017_2016_line", {
        type: 'bar',
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
                    data: [<?php echo $totaldays_usa_2017+$totaldays_usa_it ?>, <?php echo $totaldays_canada_2017+$totaldays_canada_it ?>]
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
                <div class="sidebar" data-background-color="black" data-active-color="info">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

 <div class="sidebar-wrapper">
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
    <li class="inactive">
      <a href="itplanning.php">
        <i class="ti-panel"></i>
        <p>ITP</p>
      </a>
    </li>
    <li class="active">
      <a href="combined.php">
        <i class="ti-panel"></i>
        <p>Both</p>
      </a>
    </li>
  </ul>
</div>
</div>

<div class="main-panel">

  <div class="content">
    <div class="container-fluid">

      <div class="row" style="margin-bottom: 0px">

        <div class="col-md-6" style="padding-left: 0px">
          <div class="card">
            <div class="header">
              <h4 class="title"><center><a href ="">Service Days Delivered</a></center></h4>
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
              <h4 class="title"><center><a href="">2016 & 2017</a></center></h4>
              <p class="category"></p>
            </div>
            <div class="content">
              <div >
                <canvas id="2017_2016_line" style="height:50%"></canvas>
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

                          <?php
                          $US_Total = mysql_fetch_array($us_empl_result, MYSQL_ASSOC);
               //$others_Total = mysql_fetch_array($other_empl_result, MYSQL_ASSOC);;
                          $others_Total = ($total_mos_2017 -  $US_Total['USEmp']);
                          $US_Total_special = mysql_fetch_array($US_empl_result_special, MYSQL_ASSOC);
                          ?>


                          <div class="row" style="margin-bottom: 0px">
                            <div class="col-md-6" style="padding-left: 0px">
                              <div class="card">
                                <div class="header">
                                  <h2 class="title"><center><a href=""><?php echo ceil($total_mos_2017+$total_it_2017) ?></a></center></h2>
                                  <p class="category"></p>
                                </div>
                                <div class="content">
                                  <div >
                                    <canvas id="chartContainer2017Bar" style="height:50%"></canvas>
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
                                        <p>NA</p>
                                        <a href="NA_MO_ITP.php"><?php echo ceil($US_Total_special['USEmp']) ?> </a> <!-- Adding this number to print in total for year -->
                                      </div>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>



                            <?php
               //$US_Total = mysql_fetch_array($us_empl_result, MYSQL_ASSOC);
               //$others_Total = mysql_fetch_array($other_empl_result, MYSQL_ASSOC);;
               //$others_Total = ($total_mos_2017 -  $US_Total['USEmp']);
               //$US_Total_special = mysql_fetch_array($US_empl_result_special, MYSQL_ASSOC);
                            ?>







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
