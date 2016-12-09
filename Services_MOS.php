<!doctype html>
<html lang="en">
<head>
<!-- Important JavaScript Files -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/randomcolor/0.4.4/randomColor.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    <script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/randomcolor/0.4.4/randomColor.min.js"></script>
      <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../dmo/css/styles.css"/>


    
    <!-- Data Retrival PHP File - very important -->
    <?php include 'database_retrival.php' ?>

    <script type="text/javascript">
    	<?php

    		while($row = mysql_fetch_array($services_result_mos, MYSQL_ASSOC)){
    			$label_array[] = $row['Service'];
    			$data_points[] = $row['Total'];
    		}

    	?>

    	var temp_labels = <?php echo json_encode($label_array); ?>;
    	var temp_points = <?php echo json_encode($data_points); ?>;
    	var temp_colors = [];
    	
    	for (i = 0; i < temp_points.length; i++) { 
		    temp_colors.push(randomColor());
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

    	function pieChart() {
        var myNewChart = new Chart("pieChart", {
        	type: 'pie',
        	data: pieData,
        	options: {
	        legend: {
	           display: false
	        }
	    }

        	})
    	};


    addFunctionOnWindowLoad(pieChart);
    </script>

</head>
<body>
<div class = "row">
<div class="left" style="width: 50%">
	<canvas id="pieChart"></canvas>
</div>
<div class="right">
	<?php
		echo "<style>
            table {
                border-collapse: collapse;
                width: 70%;
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


		echo '<table><thead><tr><th>Service</th><th>Days</th></tr></thead>';

		if (!mysql_data_seek($services_result_mos, 0)) {
        echo 'Cannot seek to row $i: ' . mysql_error() . '\n';
        continue;
    	}

    	while($row = mysql_fetch_array($services_result_mos, MYSQL_ASSOC)){
    			echo '<tr><td>' . $row['Service'] . '</td><td>' . $row['Total'] . '</td></tr>';
    	}

    	echo '</table>';

	?>
</div>
</div>
</body>
</html>