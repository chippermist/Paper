<meta charset="UTF-8">
<title><?php echo $_GET["company"] ?></title>

<link rel="stylesheet" type="text/css" href="../dmo/css/styles.css"/>
<style>
h2 { 
    display: block;
    font-size: 2.5em;
    margin-top: 0.83em;
    margin-bottom: 0.83em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
    text-align: center;
    font-style: normal;
}
</style>

<?php 


    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = "mysql";
    $con = mysql_connect($dbhost, $dbuser, $dbpass, $dbname);
    if(! $con ) {
      die('Could not connect: ' . mysql_error());
    }

    $companyname = $_GET["company"];
    mysql_select_db('mysql');
    $query = "SELECT service as Service, sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM `abcd_mos_2016` where company = '$companyname' GROUP by service";
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
<head>

<script type="text/javascript">
    var datapieCompany = {
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

        $companyname = $row['company'];
        mysql_select_db('mysql');
        $query = "SELECT service as Service, sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM `abcd_mos_2016` where company = '$companyname' GROUP by service";

        $result_temp_company = mysql_query($query, $conn);

        if (!$result_temp_company) { // add this check.
        die('Invalid query: ' . mysql_error());
        }

        ?>    
        };

    function pieChartCompany() {
        var myNewChart = new Chart("PieChartForCompany", {
            type: 'pie',
            data: datapieCompany,
            options: {
                maintainAspectRatio: true,
                tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var allData = data.datasets[tooltipItem.datasetIndex].data;
                        var tooltipLabel = data.labels[tooltipItem.index];
                        var tooltipData = allData[tooltipItem.index];
                        var total = 0;
                        for (var i in allData) {
                            total += allData[i];
                        }
                        var tooltipPercentage = Math.round((tooltipData / total) * 100);
                        return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
                    }
                }
            }

            }
        }
    )
    };

    addFunctionOnWindowLoad(pieChartCompany);



</script>

</head>
<body>
<center><h2><?php echo $_GET["company"] ?></h2>
    <div class="row">
<!--         <div>
        <canvas id="PieChartForCompany"></canvas>
        </div> -->
        <div>
        <?php 
        echo "<table border='1'>
          <tr>
            <th><b>Service</b></th>
            <th><b>Days</b></th>
          </tr>";
        $total = 0;

        while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['Service'] . "</td><td>" . $row['Total'] . "</td></tr>";  
        
        $total += $row['Total'];
        }
        echo  "<tr> <th><b>Total Days </b></th><th><b>$total </b></th> </tr>";

       
        echo "</table>"; 
        mysql_close();
        ?>
        </div>
    </div>
  </center>
   </body></html>

 