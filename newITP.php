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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/jquery.canvasjs.min.js" type="text/javascript"></script>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<style type="text/css">
		.canvasjs-chart-credit {
			display: none;
		}
	</style>
	<script>
      console.log("%cWhat's up? This area is forbidden.", "background: red; color: yellow; font-size: x-large");

  </script>

	<?php

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = "mysql";
	$conn = mysql_connect($dbhost, $dbuser, $dbpass, $dbname);

	mysql_select_db('mysql');

	$query1 = "SELECT distinct service, count(SO) as Days FROM `abcd_it_2017_extra` GROUP BY service";

	$result1 = mysql_query($query1, $conn);

	if(!$result1) {
		die('Could not get data from new ITP 2017 result1: ' . mysql_error());
	}

	?>




	<script type="text/javascript">

		<?php
		$query1_it = "SELECT distinct service, sum(days) as Days FROM `abcd_it_2017_extra` GROUP BY service";

		$result1_it = mysql_query($query1_it, $conn);

		if(!$result1_it) {
			die('Could not get data from new ITP 2017 result1: ' . mysql_error());
		}
		
		?>

		window.onload = function () {
			var chart = new CanvasJS.Chart("serviceChart",
			{
				toolTip:{
        			enabled: false   //enable here
		    },
		    data: [
		    {
            //startAngle: 45,
            //animationEnabled: true,
            indexLabelFontSize: 12.5,
            //indexLabelFontFamily: "Garamond",
            //indexLabelFontColor: "darkgrey",
            indexLabelLineColor: "darkgrey",
            indexLabelPlacement: "outside",
            type: "doughnut",
            showInLegend: true,
            dataPoints: [
            <?php
            $rowNumber = 0;
            while($row = mysql_fetch_array($result1_it, MYSQL_ASSOC)){
            	echo '{ y:' . $row['Days'] . ', legendText: "' . $row['service'] . '", indexLabel: "#percent%"}'; 
            	if(mysql_fetch_array($result1_it, MYSQL_ASSOC)){
            		mysql_data_seek($result1_it, ($rowNumber+1));
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



</head>
<body>
	<div class="row">
		<div class="col s6"><br><br><br><br><div id="serviceChart"></div></div>
		
		<div class="col s6">
			<br><br><br><br>

			<ul class="collapsible popout" data-collapsible="accordion" style="width: 80%">

				<?php
				mysql_data_seek($result1, 0);
				while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
					echo '<li>';
					echo '<div class="collapsible-header"> <i class="material-icons">view_list</i>' . $row1['service'] . '</div><div class="collapsible-body">';
					$servicename = $row1['service'];
					$query2 = "SELECT distinct subservice, count(SO) as Orders FROM `abcd_it_2017_extra` WHERE service = '$servicename' GROUP BY subservice" ;

					$result2 = mysql_query($query2, $conn);

					if(!$result2) {
						die('Could not get data from new ITP 2017 result2: ' . mysql_error());
					}

					echo '<ul class="collapsible popout" data-collapsible="accordion">';

			    //echo '<p><center><table class="highlight">';
					while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
						echo '<li><div class="collapsible-header"><i class="material-icons">toc</i>' . $row2['subservice'] . ' - <b>' . $row2['Orders'] . '</b></div><div class="collapsible-body">';
						$subservicename = $row2['subservice'];
						$query3 = "SELECT company , count(SO) as Total FROM `abcd_it_2017_extra` WHERE subservice = '$subservicename' GROUP BY company";
						$result3 = mysql_query($query3, $conn);

						if(!$result3) {
							die('Could not get data from new ITP 2017 result3: ' . mysql_error());
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



