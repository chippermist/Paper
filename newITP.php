<!DOCTYPE html>
<html>
<head>
	<title>New ITP</title>
	<script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
	 <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <?php

	   $dbhost = 'localhost';
	   $dbuser = 'root';
	   $dbpass = '';
	   $dbname = "mysql";
	   $conn = mysql_connect($dbhost, $dbuser, $dbpass, $dbname);

	   mysql_select_db('mysql');

	   $query1 = "SELECT service, subservice, company, sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM `itp_2016` GROUP BY service";

	   $result1 = mysql_query($query1, $conn);

	   if(!$result1) {
	     die('Could not get data from new ITP 2016 result1: ' . mysql_error());
	   }

    ?>

</head>
<body>

	<center>
		<h1> Rough Draft </h1>
		<ul class="collapsible popout" data-collapsible="accordion" style="width: 50%">

		<?php
			while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
				echo '<li>';
				echo '<div class="collapsible-header"> <i class="material-icons">view_list</i>' . $row1['service'] . '</div><div class="collapsible-body">';
				$servicename = $row1['service'];
				$query2 = "SELECT subservice FROM `itp_2016` WHERE service = '$servicename' GROUP BY subservice" ;

			    $result2 = mysql_query($query2, $conn);

			    if(!$result2) {
			      die('Could not get data from new ITP 2016 result2: ' . mysql_error());
			    }

			    echo '<ul class="collapsible popout" data-collapsible="accordion">';

			    //echo '<p><center><table class="highlight">';
				while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
					echo '<li><div class="collapsible-header"><i class="material-icons">toc</i>' . $row2['subservice'] . '</div><div class="collapsible-body">';
					$subservicename = $row2['subservice'];
					$query3 = "SELECT company , sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM `itp_2016` WHERE subservice = '$subservicename' GROUP BY company , subservice";
					$result3 = mysql_query($query3, $conn);

				    if(!$result3) {
				      die('Could not get data from new ITP 2016 result3: ' . mysql_error());
				    }

				    echo '<table class="highlight">';
				    while($row3 = mysql_fetch_array($result3, MYSQL_ASSOC)){
				    	echo '<tr><td>' . $row3['company'] . '</td><td>' . $row3['Total'] . '</td></tr>';
				    }

				    echo '</table>';

					echo '</div></li>';
				}
				echo '</ul>';
			}

			mysql_close();
		?>

	</center>

</body>
</html>

    

