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
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer",
        {
            toolTip:{
        enabled: false   //enable here
    },
    legend: {
        horizontalAlign: "center"
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
            while($row = mysql_fetch_array($services_result_mos_filter_2016, MYSQL_ASSOC)){
                echo '{ y:' . $row['Total'] . ', legendText: "' . $row['Service'] . '", indexLabel: "#percent%"}'; 
                if(mysql_fetch_array($services_result_mos_filter_2016, MYSQL_ASSOC)){
                    mysql_data_seek($services_result_mos_filter_2016, ($rowNumber+1));
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

    var dataBar2016 = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
        {
            backgroundColor: '#F1C40F',
            borderColor: "#F1C40F",
            data: [<?php echo $jan_mos_2016 ?>, <?php echo $feb_mos_2016 ?>, <?php echo $mar_mos_2016 ?>, <?php echo $apr_mos_2016 ?>, <?php echo $may_mos_2016 ?>, <?php echo $jun_mos_2016 ?>, <?php echo $jul_mos_2016 ?>, <?php echo $aug_mos_2016 ?>, <?php echo $sep_mos_2016 ?>, <?php echo $oct_mos_2016 ?>, <?php echo $nov_mos_2016 ?>, <?php echo $dec_mos_2016 ?>],
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
            data: [<?php echo $jan_mos_2015 ?>, <?php echo $feb_mos_2015 ?>, <?php echo $mar_mos_2015 ?>, <?php echo $apr_mos_2015 ?>, <?php echo $may_mos_2015 ?>, <?php echo $jun_mos_2015 ?>, <?php echo $jul_mos_2015 ?>, <?php echo $aug_mos_2015 ?>, <?php echo $sep_mos_2015 ?>, <?php echo $oct_mos_2015 ?>, <?php echo $nov_mos_2015 ?>, <?php echo $dec_mos_2015 ?>],
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
            data: [<?php echo $jan_mos_2016 ?>, <?php echo $feb_mos_2016 ?>, <?php echo $mar_mos_2016 ?>, <?php echo $apr_mos_2016 ?>, <?php echo $may_mos_2016 ?>, <?php echo $jun_mos_2016 ?>, <?php echo $jul_mos_2016 ?>, <?php echo $aug_mos_2016 ?>, <?php echo $sep_mos_2016 ?>, <?php echo $oct_mos_2016 ?>, <?php echo $nov_mos_2016 ?>, <?php echo $dec_mos_2016 ?>],
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
                    data: [<?php echo $totaldays_usa ?>, <?php echo $totaldays_canada ?>]
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
        <li class="active">
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
    </ul>
</div>
</div>

<div class="main-panel">
        <!-- <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
								<p>Stats</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">5</p>
									<p>Notifications</p>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
						<li>
                            <a href="#">
								<i class="ti-settings"></i>
								<p>Settings</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav> -->


        <div class="content">
            <div class="container-fluid">
               <!--  <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-server"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Capacity</p>
                                            105GB
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-wallet"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Revenue</p>
                                            $1,345
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-calendar"></i> Last day
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="ti-pulse"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Errors</p>
                                            23
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> In the last hour
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-info text-center">
                                            <i class="ti-twitter-alt"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Followers</p>
                                            +45
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row" style="margin-bottom: 0px">

                    <div class="col-md-6" style="padding-left: 0px">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><center><a href ="all_services_mos.php">Service Days Delivered</a></center></h4>
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
                                <h4 class="title"><center><a href="MosStatsbyYear.php">2015 & 2016</a></center></h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <div >
                                    <canvas id="2016_2015_line" style="height:50%"></canvas>
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
               $others_Total = ($total_mos_2016 -  $US_Total['USEmp']);
               $US_Total_special = mysql_fetch_array($US_empl_result_special, MYSQL_ASSOC);
               ?>


                <div class="row" style="margin-bottom: 0px">
                    <div class="col-md-6" style="padding-left: 0px">
                        <div class="card">
                            <div class="header">
                                <h2 class="title"><center><a href="2016_mos.php"><?php echo ceil($others_Total + $US_Total_special['USEmp']) ?></a></center></h2>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <div >
                                    <canvas id="chartContainer2016Bar" style="height:50%"></canvas>
                                </div>

                                <div class="footer">
                                    <!-- <hr>
                                    <div class="stats">
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-left: 0px">
                        <div class="card">
                            <div class="header">
                                <?php $ans = mysql_fetch_array($NoServicesResult, MYSQL_ASSOC); ?>
                                <h4 class="title"><center><a href="newMO.php">Services</a></center></h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <div >
                                    <div id="chartContainer" style="height: 36vh; width: 100%;">
                                        <!-- <canvas id="pieChart"></canvas> -->
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
                <div class="row" style="margin-bottom: 0px">
                    <div class="col-md-6" style="padding-left: 0px">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><center>Top Customers</center></h4>
                                <p class="category"></p>
                            </div>
                            <div class="content" >
                                <div >
                                    <!-- <table class="highlight" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Company</th>
                                            <th>SO Days</th>
                                        </tr> -->
                                        <ul class="collapsible popout" data-collapsible="accordion">
                                            <?php
                                        /*while($row = mysql_fetch_array($top5_mos_result, MYSQL_ASSOC)){
                                            echo '<tr><td>' . $row['company'] . '</td><td>' . $row['Total'] . '</td></tr>';
                                        }*/

                                        $dbhost = 'localhost';
                                        $dbuser = 'root';
                                        $dbpass = '';
                                        $dbname = "mysql";
                                        $conn = mysql_connect($dbhost, $dbuser, $dbpass, $dbname);
                                        //echo '<table><thead><tr><th>Company</th><th>Number of Days</th></tr></thead></table>';
                                        while($row = mysql_fetch_array($top5_mos_result, MYSQL_ASSOC)){

                                            $companyname = $row['company'];
                                            mysql_select_db('mysql');
                                            $query = "SELECT service as Service, sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM `abcd_mos_2016` where company = '$companyname' GROUP by service";

                                            $result_temp_company = mysql_query($query, $conn);

                                            if (!$result_temp_company) { // add this check.
                                                die('Invalid query: ' . mysql_error());
                                            }

                                            echo '<li><div class="collapsible-header">';
                                            $url_bind = "company_table_mos.php?company=";
                                            $url_bind .= $row['company'];
                                            echo '<a href="'. $url_bind . '"><i class="material-icons">open_in_new</i></a>' . $row['company'] . '&nbsp-&nbsp<b>'. $row['Total'] . '</b></div><div class="collapsible-body"><p>';

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

                                        echo "<table border='1'>
                                        <tr>
                                            <th><b>Service</b></th>
                                            <th><b>Days</b></th>
                                        </tr>";
                                        $total = 0;


                                            while($row = mysql_fetch_array($result_temp_company)){   //Creates a loop to loop through results
                                                echo "<tr><td>" . $row['Service'] . "</td><td>" . $row['Total'] . "</td></tr>";  

                                                $total += $row['Total'];
                                            }
                                            echo  "<tr> <th><b>Total Days </b></th><th><b>$total </b></th> </tr>";


                                            echo "</table>"; 
                                            

                                            echo '</p></div></li>';
                                        }

                                        ?>
                                    </ul>
                                   <!--  </thead>
                               </table> -->

                           </div>
                       </div>
                   </div>
               </div>

               <?php
               //$US_Total = mysql_fetch_array($us_empl_result, MYSQL_ASSOC);
               //$others_Total = mysql_fetch_array($other_empl_result, MYSQL_ASSOC);;
               //$others_Total = ($total_mos_2016 -  $US_Total['USEmp']);
               //$US_Total_special = mysql_fetch_array($US_empl_result_special, MYSQL_ASSOC);
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
                                    <p>Non NA</p>
                                    <a href="NON_NA_MO.php"><?php echo ceil($others_Total) ?></a>
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
                                    <p>NA</p>
                                    <a href="NA_MO.php"><?php echo ceil($US_Total_special['USEmp']) ?> </a> <!-- Adding this number to print in total for year -->
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
                                $internalorders_mo = mysql_fetch_array($US_empl_result_special_internal, MYSQL_ASSOC);
                                ?>
                                <a href="Order-Class.php"><?php echo  ceil($internalorders_mo['Total']) ;?> </a>
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
                            mysql_data_seek($US_empl_result_special, 0);
                            $customerorders_mo = mysql_fetch_array($US_empl_result_special, MYSQL_ASSOC);
                            ?>
                            <a href="Order-Class.php"><?php echo  ceil($customerorders_mo['USEmp']) ;?> </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>




            <!-- <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            <h4 class="title"><center>Services</center></h4>
                            <p class="category"></p>
                        </div>
                        <div class="content">
                            <div >
                                <canvas id="pieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->


<!--         <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="http://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    
                </div>
            </div>
        </footer> -->

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


<!-- 	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'ti-stats-up',
            	message: "Welcome to <b>MOS & IT Planning Dashboard</b> - a internal tool for monitoring."

            },{
                type: 'success',
                timer: 500
            });

    	});
    </script>  -->

    </html>
