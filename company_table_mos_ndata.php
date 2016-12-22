<meta charset="UTF-8">
<title><?php echo $_GET["company"] ?></title>

<link rel="stylesheet" type="text/css" href="../dmo/css/styles.css"/>

<head>
<?php 


    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = "mysql";
    $con = mysql_connect($dbhost, $dbuser, $dbpass, $dbname);
    if(! $con ) {
      die('Could not connect: ' . mysql_error());
    }

    $companyname = $_GET['company'];
    $servicename = $_GET['service_'];
    mysql_select_db('mysql');
    $query = "SELECT service as Service, SO, person FROM `abcd_mos_2016` WHERE company = '$companyname' AND service = '$servicename'";
    //first pass just gets the column names

    //echo $query;
     
    $result = mysql_query($query, $con);

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
    <div class="row">
        <div>
        <!-- <canvas id="PieChartForCompany"></canvas> -->
        </div>
        <div>
        <?php 
        echo "<table border='1'>
          <tr>
            <th><b>SO</b></th>
            <th><b>Service</b></th>
            <th><b>Person Responsible</b></th>
          </tr>";
        $total = 0;

        while($row = mysql_fetch_array($result, MYSQL_ASSOC)){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['SO'] . '</td><td>' . $row['Service'] . "</td><td>" . $row['person'] . "</td></tr>";  
        
        //$total += $row['Total'];
        }
        //echo  "<tr> <th><b>Total Days </b></th><th></th><th><b>$total </b></th> </tr>";

       
        echo "</table>"; 
        mysql_close();
        ?>
        </div>
    </div>
  
   </body></html>