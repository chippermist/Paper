<meta charset="UTF-8">
<title><?php echo $_GET["company"] ?></title>

<link rel="stylesheet" type="text/css" href="../dmo/css/styles.css"/>
<script>
      console.log("%cWhat's up? This area is forbidden.", "background: red; color: yellow; font-size: x-large");

  </script>

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
    $query = "SELECT service as Service, sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM `abcd_it_2016` where company = '$companyname' GROUP by service";
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

</head>
<body>
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
  
   </body></html>

 <?php 
 
 
 ?>  
 
 