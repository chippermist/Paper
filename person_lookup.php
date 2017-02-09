<!DOCTYPE html>
<html>
<head>
	<title>MO Data - <?php echo $_GET['person'] ?></title>
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
	<?php include 'database_retrival.php' ?>

	<?php 
	$personname = $_GET['person'];
	$department = $_GET['department'];
	$ITP = 'ITP';

	if($department == $ITP)
	{
		$query = "SELECT DISTINCT SO, company, service, sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM abcd_it_2017 WHERE person = '$personname' GROUP BY SO";
	}
	else
	{
		$query = "SELECT DISTINCT SO, company, service, sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM abcd_mos_2017 WHERE person = '$personname' GROUP BY SO";
	}
	


	$result = mysql_query($query, $conn);

	    if (!$result) { // add this check.
	    	die('Invalid query: ' . mysql_error());
	    }
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

	?>


</head>
<body>
<?php
echo "<center><table border='1'>
<tr>
<th>SO</th>
	<th>Company</th>
	<th>Service</th>
	<th>Days</th>
</tr>";
$total =0;
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	echo '<tr><td>' . $row['SO'] . '</td><td>' . $row['company'] . '</td><td>' . $row['service'] . '</td><td>' . $row['Total'] . '</td></tr>';
	$total += $row['Total'];
}
echo '<tr><th>Total</th><th></th><th></th><th>' . $total . '</th></tr>';
?>
</table>
</center>
</body>
</html>