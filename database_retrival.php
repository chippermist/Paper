<?php 


   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = "mysql";
   $conn = mysql_connect($dbhost, $dbuser, $dbpass, $dbname);
   $jan_mos_2016 =0; $feb_mos_2016=0; $mar_mos_2016=0;$apr_mos_2016=0; $may_mos_2016=0; $jun_mos_2016=0;$jul_mos_2016=0; $aug_mos_2016=0; $sep_mos_2016=0;$oct_mos_2016=0; $nov_mos_2016=0; $dec_mos_2016=0;
   if(! $conn ) {
      die('Could not connect: ' . mysql_error());
   }

  $sql_mos_2016 =  'SELECT * FROM abcd_mos_2016';
   //$sql = 'SELECT * FROM abcd';
   
   //select 
   mysql_select_db('mysql');
   $retval_mos_2016 = mysql_query( $sql_mos_2016, $conn );
   
   if(! $retval_mos_2016 ) {
      die('Could not get data from MOS 2016: ' . mysql_error());
   }

/*// echo "<style>
// table {
//     border-collapse: collapse;
//     width: 70%;
// }

// th, td {
//     text-align: left;
//     padding: 5px;
// }

// tr:nth-child(even){background-color: #f2f2f2}

// th {
//     background-color: #F0AB00;
//     color: white;
// }
// </style>
// ";
   
 */
   while($row = mysql_fetch_array($retval_mos_2016, MYSQL_ASSOC)) {
     
	 
		 $jan_mos_2016 += $row['jan'];
		 $feb_mos_2016 += $row['feb'];
		 $mar_mos_2016 += $row['mar'];
		 $apr_mos_2016 += $row['apr'];
		 $may_mos_2016 += $row['may'];
		 $jun_mos_2016 += $row['jun'];
		 $jul_mos_2016 += $row['jul'];
		 $aug_mos_2016 += $row['aug'];
		 $sep_mos_2016 += $row['sep'];
		 $oct_mos_2016 += $row['oct'];
		 $nov_mos_2016 += $row['nov'];
		 $dec_mos_2016 += $row['dec'];
		 
		
  

		// $retval1 = mysql_query( $sql, $conn );
		// 	//echo count($row1['k']);
		// while($row1 = mysql_fetch_array($retval1, MYSQL_ASSOC)) {
		// 	//echo $row1['k'];
		// }
   }
    

  $total_mos_2016 = $jan_mos_2016+$feb_mos_2016+$mar_mos_2016+$apr_mos_2016+$may_mos_2016+$jun_mos_2016+$jul_mos_2016+$aug_mos_2016+$sep_mos_2016+$oct_mos_2016+$nov_mos_2016+$dec_mos_2016;


	//for MOS 2015
  $jan_mos_2015 =0; $feb_mos_2015=0; $mar_mos_2015=0;$apr_mos_2015=0; $may_mos_2015=0; $jun_mos_2015=0;$jul_mos_2015=0; $aug_mos_2015=0; $sep_mos_2015=0;$oct_mos_2015=0; $nov_mos_2015=0; $dec_mos_2015=0;

  $sql_mos_2015 =  'SELECT * FROM abcd_mos_2015';
   //$sql = 'SELECT * FROM abcd';
   
   //select 
   mysql_select_db('mysql');
   $retval_mos_2015 = mysql_query( $sql_mos_2015, $conn );
   
   if(! $retval_mos_2015 ) {
      die('Could not get data from MOS 2015: ' . mysql_error());
   }

 
   while($row = mysql_fetch_array($retval_mos_2015, MYSQL_ASSOC)) {
     
	 
		 $jan_mos_2015 += $row['jan'];
		 $feb_mos_2015 += $row['feb'];
		 $mar_mos_2015 += $row['mar'];
		 $apr_mos_2015 += $row['apr'];
		 $may_mos_2015 += $row['may'];
		 $jun_mos_2015 += $row['jun'];
		 $jul_mos_2015 += $row['jul'];
		 $aug_mos_2015 += $row['aug'];
		 $sep_mos_2015 += $row['sep'];
		 $oct_mos_2015 += $row['oct'];
		 $nov_mos_2015 += $row['nov'];
		 $dec_mos_2015 += $row['dec'];
		 
		
  

		// $retval1 = mysql_query( $sql, $conn );
		// 	//echo count($row1['k']);
		// while($row1 = mysql_fetch_array($retval1, MYSQL_ASSOC)) {
		// 	//echo $row1['k'];
		// }
   }


   $total_mos_2015 = $jan_mos_2015+$feb_mos_2015+$mar_mos_2015+$apr_mos_2015+$may_mos_2015+$jun_mos_2015+$jul_mos_2015+$aug_mos_2015+$sep_mos_2015+$oct_mos_2015+$nov_mos_2015+$dec_mos_2015;


   $query_services = "SELECT service as Service, sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM `abcd_mos_2016` GROUP by service";

   $services_result_mos = mysql_query($query_services, $conn);

    if (!$services_result_mos) { // add this check.
    die('Invalid query: ' . mysql_error());
    }

   	$query_filter_services_mos_2016 = "SELECT type as Service, sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM `abcd_mos_2016` GROUP by type";

   	$services_result_mos_filter_2016 = mysql_query($query_filter_services_mos_2016, $conn);

   	if (!$services_result_mos_filter_2016) { // add this check.
    die('Invalid query: ' . mysql_error());
    }

    $query_USA_2016 = "SELECT sum(`jan`+ `feb`+ `mar` + `apr`+ `may`+ `jun`+ `jul`+ `aug`+ `sep`+ `oct`+ `nov`+ `dec`) as TotalDaysUSA FROM `abcd_mos_2016` WHERE country = 'USA' ";

	$USA_2016_result = mysql_query($query_USA_2016, $conn);

    if (!$USA_2016_result) { // add this check.
    die('Invalid query: ' . mysql_error());
    }

    $query_USA_2015 = "SELECT sum(`jan`+ `feb`+ `mar` + `apr`+ `may`+ `jun`+ `jul`+ `aug`+ `sep`+ `oct`+ `nov`+ `dec`) as TotalDaysUSA FROM `abcd_mos_2015` WHERE country = 'USA' ";

	$USA_2015_result = mysql_query($query_USA_2015, $conn);

    if (!$USA_2015_result) { // add this check.
    die('Invalid query: ' . mysql_error());
    }

    $query_Canada_2016 = "SELECT sum(`jan`+ `feb`+ `mar` + `apr`+ `may`+ `jun`+ `jul`+ `aug`+ `sep`+ `oct`+ `nov`+ `dec`) as TotalDaysCanada FROM `abcd_mos_2016` WHERE country = 'Canada' ";

	$Canada_2016_result = mysql_query($query_Canada_2016, $conn);

    if (!$Canada_2016_result) { // add this check.
    die('Invalid query: ' . mysql_error());
    }

    $query_Canada_2015 = "SELECT sum(`jan`+ `feb`+ `mar` + `apr`+ `may`+ `jun`+ `jul`+ `aug`+ `sep`+ `oct`+ `nov`+ `dec`) as TotalDaysCanada FROM `abcd_mos_2015` WHERE country = 'Canada' ";

	$Canada_2015_result = mysql_query($query_Canada_2015, $conn);

    if (!$Canada_2015_result) { // add this check.
    die('Invalid query: ' . mysql_error());
    }    

    $totaldays_usa = 0;
    $totaldays_canada = 0;
    $totaldays_usa_2015 =0;
    $totaldays_canada_2015 =0;

    while($row = mysql_fetch_array($USA_2016_result, MYSQL_ASSOC)) {
				
				$totaldays_usa += $row["TotalDaysUSA"];
		}

	$row = null;	

	while($row = mysql_fetch_array($USA_2015_result, MYSQL_ASSOC)) {
				
				$totaldays_usa_2015 += $row["TotalDaysUSA"];
		}

	$row = null;

    while($row = mysql_fetch_array($Canada_2016_result, MYSQL_ASSOC)) {
				
				$totaldays_canada += $row["TotalDaysCanada"];
		}

	$row = null;

	while($row = mysql_fetch_array($Canada_2015_result, MYSQL_ASSOC)) {
				
				$totaldays_canada_2015 += $row["TotalDaysCanada"];
		}

	$row = null;


	//Calculation of Top 5 companies for MOS 2016

	$query_top5_mos_2016 = "SELECT company, sum(`jan`+ `feb`+ `mar` + `apr`+ `may`+ `jun`+ `jul`+ `aug`+ `sep`+ `oct`+ `nov`+ `dec`) as Total FROM `abcd_mos_2016` GROUP BY company ORDER BY Total DESC LIMIT 5";

	$top5_mos_result = mysql_query($query_top5_mos_2016, $conn);

	if (!$top5_mos_result) { // add this check.
    die('Invalid query: ' . mysql_error());
    }

    //Rest is done inside the mos and itp .php file


	// Retrival for all services and then categorization



















	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////        IT PLANNING        ///////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////


	$jan_it_2016 =0; $feb_it_2016=0; $mar_it_2016=0;$apr_it_2016=0; $may_it_2016=0; $jun_it_2016=0;$jul_it_2016=0; $aug_it_2016=0; $sep_it_2016=0;$oct_it_2016=0; $nov_it_2016=0; $dec_it_2016=0;
   if(! $conn ) {
      die('Could not connect: ' . mysql_error());
   }

  $sql_it_2016 =  'SELECT * FROM abcd_it_2016';
   //$sql = 'SELECT * FROM abcd';
   
   //select 
   mysql_select_db('mysql');
   $retval_it_2016 = mysql_query( $sql_it_2016, $conn );
   
   if(! $retval_it_2016 ) {
      die('Could not get data from it 2016: ' . mysql_error());
   }

 
   while($row = mysql_fetch_array($retval_it_2016, MYSQL_ASSOC)) {
     
	 
		 $jan_it_2016 += $row['jan'];
		 $feb_it_2016 += $row['feb'];
		 $mar_it_2016 += $row['mar'];
		 $apr_it_2016 += $row['apr'];
		 $may_it_2016 += $row['may'];
		 $jun_it_2016 += $row['jun'];
		 $jul_it_2016 += $row['jul'];
		 $aug_it_2016 += $row['aug'];
		 $sep_it_2016 += $row['sep'];
		 $oct_it_2016 += $row['oct'];
		 $nov_it_2016 += $row['nov'];
		 $dec_it_2016 += $row['dec'];
		 
		
  

		// $retval1 = mysql_query( $sql, $conn );
		// 	//echo count($row1['k']);
		// while($row1 = mysql_fetch_array($retval1, MYSQL_ASSOC)) {
		// 	//echo $row1['k'];
		// }
   }
    

  $total_it_2016 = $jan_it_2016+$feb_it_2016+$mar_it_2016+$apr_it_2016+$may_it_2016+$jun_it_2016+$jul_it_2016+$aug_it_2016+$sep_it_2016+$oct_it_2016+$nov_it_2016+$dec_it_2016;


	//for it 2015
  $jan_it_2015 =0; $feb_it_2015=0; $mar_it_2015=0;$apr_it_2015=0; $may_it_2015=0; $jun_it_2015=0;$jul_it_2015=0; $aug_it_2015=0; $sep_it_2015=0;$oct_it_2015=0; $nov_it_2015=0; $dec_it_2015=0;

  $sql_it_2015 =  'SELECT * FROM abcd_it_2015';
   //$sql = 'SELECT * FROM abcd';
   
   //select 
   mysql_select_db('mysql');
   $retval_it_2015 = mysql_query( $sql_it_2015, $conn );
   
   if(! $retval_it_2015 ) {
      die('Could not get data from it 2015: ' . mysql_error());
   }

	
 
   while($row = mysql_fetch_array($retval_it_2015, MYSQL_ASSOC)) {
     
	 
		 $jan_it_2015 += $row['jan'];
		 $feb_it_2015 += $row['feb'];
		 $mar_it_2015 += $row['mar'];
		 $apr_it_2015 += $row['apr'];
		 $may_it_2015 += $row['may'];
		 $jun_it_2015 += $row['jun'];
		 $jul_it_2015 += $row['jul'];
		 $aug_it_2015 += $row['aug'];
		 $sep_it_2015 += $row['sep'];
		 $oct_it_2015 += $row['oct'];
		 $nov_it_2015 += $row['nov'];
		 $dec_it_2015 += $row['dec'];
		 
		
  

		// $retval1 = mysql_query( $sql, $conn );
		// 	//echo count($row1['k']);
		// while($row1 = mysql_fetch_array($retval1, MYSQL_ASSOC)) {
		// 	//echo $row1['k'];
		// }
   }


   $total_it_2015 = $jan_it_2015+$feb_it_2015+$mar_it_2015+$apr_it_2015+$may_it_2015+$jun_it_2015+$jul_it_2015+$aug_it_2015+$sep_it_2015+$oct_it_2015+$nov_it_2015+$dec_it_2015;


   $query_services_it = "SELECT service as Service, sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM `abcd_it_2016` GROUP by service";

   $services_result_it = mysql_query($query_services_it, $conn);

    if (!$services_result_it) { // add this check.
    die('Invalid query: ' . mysql_error());
    }


    $query_USA_2016_it = "SELECT sum(`jan`+ `feb`+ `mar` + `apr`+ `may`+ `jun`+ `jul`+ `aug`+ `sep`+ `oct`+ `nov`+ `dec`) as TotalDaysUSA FROM `abcd_it_2016` WHERE country = 'USA' ";

	$USA_2016_result_it = mysql_query($query_USA_2016_it, $conn);

    if (!$USA_2016_result_it) { // add this check.
    die('Invalid query: ' . mysql_error());
    }

    $query_USA_2015_it = "SELECT sum(`jan`+ `feb`+ `mar` + `apr`+ `may`+ `jun`+ `jul`+ `aug`+ `sep`+ `oct`+ `nov`+ `dec`) as TotalDaysUSA FROM `abcd_it_2015` WHERE country = 'USA' ";

	$USA_2015_result_it = mysql_query($query_USA_2015_it, $conn);

    if (!$USA_2015_result_it) { // add this check.
    die('Invalid query: ' . mysql_error());
    }

    $query_Canada_2016_it = "SELECT sum(`jan`+ `feb`+ `mar` + `apr`+ `may`+ `jun`+ `jul`+ `aug`+ `sep`+ `oct`+ `nov`+ `dec`) as TotalDaysCanada FROM `abcd_it_2016` WHERE country = 'Canada' ";

	$Canada_2016_result_it = mysql_query($query_Canada_2016_it, $conn);

    if (!$Canada_2016_result_it) { // add this check.
    die('Invalid query: ' . mysql_error());
    }

    $query_Canada_2015_it = "SELECT sum(`jan`+ `feb`+ `mar` + `apr`+ `may`+ `jun`+ `jul`+ `aug`+ `sep`+ `oct`+ `nov`+ `dec`) as TotalDaysCanada FROM `abcd_it_2015` WHERE country = 'Canada' ";

	$Canada_2015_result_it = mysql_query($query_Canada_2015_it, $conn);

    if (!$Canada_2015_result_it) { // add this check.
    die('Invalid query: ' . mysql_error());
    }    

    $totaldays_usa_it = 0;
    $totaldays_usa_it_2015 = 0;
    $totaldays_canada_it = 0;
    $totaldays_canada_it_2015 = 0;

    while($row = mysql_fetch_array($USA_2016_result_it, MYSQL_ASSOC)) {
				
				$totaldays_usa_it += $row["TotalDaysUSA"];
		}

	$row = null;	

	while($row = mysql_fetch_array($USA_2015_result_it, MYSQL_ASSOC)) {
				
				$totaldays_usa_it_2015 = $row["TotalDaysUSA"];
		}

	$row = null;

    while($row = mysql_fetch_array($Canada_2016_result_it, MYSQL_ASSOC)) {
				
				$totaldays_canada_it += $row["TotalDaysCanada"];
		}

	$row = null;

	while($row = mysql_fetch_array($Canada_2015_result_it, MYSQL_ASSOC)) {
				
				$totaldays_canada_it_2015 += $row["TotalDaysCanada"];
		}

	$row = null;


	//Calculation of Top 5 companies for IT 2016

	$query_top5_it_2016 = "SELECT company, sum(`jan`+ `feb`+ `mar` + `apr`+ `may`+ `jun`+ `jul`+ `aug`+ `sep`+ `oct`+ `nov`+ `dec`) as Total FROM `abcd_it_2016` GROUP BY company ORDER BY Total DESC LIMIT 5";

	$top5_it_result = mysql_query($query_top5_it_2016, $conn);

	if (!$top5_it_result) { // add this check.
    die('Invalid query: ' . mysql_error());
    }



   	$query_filter_services_it_2016 = "SELECT type as Service, sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM `abcd_it_2016` GROUP by type";

   	$services_result_it_filter_2016 = mysql_query($query_filter_services_it_2016, $conn);

   	if (!$services_result_it_filter_2016) { // add this check.
    die('Invalid query: ' . mysql_error());
    }










   mysql_close();
?>