<meta charset="UTF-8">
<title></title>

<link rel="stylesheet" type="text/css" href="../dmo/css/styles.css"/>

<?php 


   $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = "mysql";
    $con = mysql_connect($dbhost, $dbuser, $dbpass, $dbname);
    if(! $con ) {
      die('Could not connect: ' . mysql_error());
    }

    
    mysql_select_db('mysql');
    $query = "SELECT service as Service, company as Company, sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM `abcd_mos_2016` GROUP by service, company";
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
          $tempCompany = null;
          $tempCount = null;
          $prevTotal = 0;
          $dataseek = 0;
       
       // O(n^2) - Could be improved if used graph iteration
        while($row = mysql_fetch_array($result)){
          $dataseek++;
          echo "<table border='1'>";
          $total = 0;


          echo "<tr><th><b>" . $row['Service'] . "</b></th><th>Days</th></tr>";
          $serviceName = $row['Service'];

          if(!mysql_data_seek($result, $dataseek-1)){
            echo "Error seeking";
          }
          else{
            $dataseek--;
          }
          while($row = mysql_fetch_array($result)){
            $dataseek++;
            if($row['Service'] == $serviceName){
              echo "<tr><td>" . $row['Company'] . "</td><td>" . $row['Total'] . "</td></tr>";
              $total += $row['Total'];
              $prevTotal = $total;
            }
            else{

              echo "<tr><th><b>Total</b></th><th>$total</th></tr>";
              echo "</table>";
              $prevTotal = 0;
              $serviceName = null;
              if(!mysql_data_seek($result, $dataseek-1)){
                echo "Error seeking";
              }
              else{
                $dataseek--;
              }
              break;
            }
          }
           

        }
        echo "<tr><th><b>Total</b></th><th>$prevTotal</th></tr>";
              echo "</table>";
       
        mysql_close();
        ?>
    </div>
  
   </body></html>

 <?php 
 
 
 ?>  
 
 