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

    $query_filter_services_mos_2016 = "SELECT DISTINCT type as Service, sum(`jan` + `feb` + `mar` + `apr` + `may` + `jun`+ `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) as Total FROM `abcd_mos_2016` GROUP by type";

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



	//Based on US employees

	$query_us_employees = "SELECT sum(`jan`+ `feb`+ `mar` + `apr`+ `may`+ `jun`+ `jul`+ `aug`+ `sep`+ `oct`+ `nov`+ `dec`) as USEmp FROM `abcd_mos_2016` WHERE person IN ('Anil Kumar Kunapareddy', 'Julio Cezar Almeida', 'Parishudh Reddy Marupurolu', 'Chinmay Garg', 'Deepika Paturu', 'Kiran Bose', 'Rahul Shetti', 'Rajendra N', 'Rakesh Patel', 'Sriram Bhaskar', 'Wilson Karunakar Puvvula', 'Steven Sanchez', 'Kaushik Bangalore Venkatarama', 'David Uhr', 'Balakameswara Sarma Sishta', 'Kishan Vimalachandran', 'Abhishek Anand', 'mr. Mrinal Sarkar')";

	$us_empl_result = mysql_query($query_us_employees, $conn);

	if (!$us_empl_result) { // add this check.
		die('Invalid query: ' . mysql_error());
	}


	$query_US_employees_special = "SELECT sum(days) as USEmp FROM `isp_recording` WHERE person IN ('Anil Kumar Kunapareddy', 'Julio Cezar Almeida', 'Parishudh Reddy Marupurolu', 'Chinmay Garg', 'Deepika Paturu', 'Kiran Bose', 'Rahul Shetti', 'Rajendra N', 'Rakesh Patel', 'Sriram Bhaskar', 'Wilson Karunakar Puvvula', 'Steven Sanchez') AND orderType = 'Customer Order'";

	$US_empl_result_special = mysql_query($query_US_employees_special, $conn);

	if (!$US_empl_result_special) { // add this check.
		die('Invalid query: ' . mysql_error());
	}



	$query_US_employees_special_internal = "SELECT sum(days) as Total FROM `isp_recording` WHERE person IN ('Anil Kumar Kunapareddy', 'Julio Cezar Almeida', 'Parishudh Reddy Marupurolu', 'Chinmay Garg', 'Deepika Paturu', 'Kiran Bose', 'Rahul Shetti', 'Rajendra N', 'Rakesh Patel', 'Sriram Bhaskar', 'Wilson Karunakar Puvvula', 'Steven Sanchez') AND orderType = 'Internal Order'";

	$US_empl_result_special_internal = mysql_query($query_US_employees_special_internal, $conn);

	if (!$US_empl_result_special_internal) { // add this check.
		die('Invalid query: ' . mysql_error());
	}




	$query_other_employees = "SELECT sum(days) as USEmp FROM `isp_recording` WHERE person NOT IN ('Anil Kumar Kunapareddy', 'Julio Cezar Almeida', 'Parishudh Reddy Marupurolu', 'Chinmay Garg', 'Deepika Paturu', 'Kiran Bose', 'Rahul Shetti', 'Rajendra N', 'Rakesh Patel', 'Sriram Bhaskar', 'Wilson Karunakar Puvvula', 'Steven Sanchez') AND orderType = 'Customer Order'";

	$other_empl_result = mysql_query($query_other_employees, $conn);

	if (!$other_empl_result) { // add this check.
		die('Invalid query: ' . mysql_error());
	}


	$NoServices = "SELECT count(SO) as Total FROM `abcd_mos_2016`";

	$NoServicesResult = mysql_query($NoServices, $conn);

	if(!$NoServicesResult) {
		die('Could not get data from new ITP 2016 result1: ' . mysql_error());
	}










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



	$query_filter_services_it_2016 = "SELECT DISTINCT subservice as Service, sum(days) as Total FROM `abcd_it_2016_extra` GROUP by subservice";

	$services_result_it_filter_2016 = mysql_query($query_filter_services_it_2016, $conn);

   	if (!$services_result_it_filter_2016) { // add this check.
   		die('Invalid query: ' . mysql_error());
   	}


   	//Based on US employees

	$query_us_employees_it = "SELECT sum(`jan`+ `feb`+ `mar` + `apr`+ `may`+ `jun`+ `jul`+ `aug`+ `sep`+ `oct`+ `nov`+ `dec`) as USEmp FROM `abcd_it_2016` WHERE person IN ( 'Anil Kumar Kunapareddy', 'Julio Cezar Almeida', 'Parishudh Reddy Marupurolu', 'Chinmay Garg', 'Deepika Paturu', 'Kiran Bose', 'Rahul Shetti', 'Rajendra N', 'Rakesh Patel', 'Sriram Bhaskar', 'Wilson Karunakar Puvvula', 'Steven Sanchez', 'Kaushik Bangalore Venkatarama', 'David Uhr', 'Balakameswara Sarma Sishta', 'Kishan Vimalachandran', 'Abhishek Anand', 'mr. Mrinal Sarkar')";

	$us_empl_result_it = mysql_query($query_us_employees_it, $conn);

	if (!$us_empl_result_it) { // add this check.
		die('Invalid query: ' . mysql_error());
	}


	$query_employees_it_special = "SELECT sum(days) as USEmp FROM `isp_recording` WHERE person IN ( 'Anil Kumar Kunapareddy', 'Kaushik Bangalore Venkatarama', 'David Uhr', 'Balakameswara Sarma Sishta', 'Kishan Vimalachandran', 'Abhishek Anand', 'mr. Mrinal Sarkar')  AND orderType = 'Customer Order'";

	$empl_result_it_special = mysql_query($query_employees_it_special, $conn);

	if (!$empl_result_it_special) { // add this check.
		die('Invalid query: ' . mysql_error());
	}


	$query_employees_it_special_internal = "SELECT sum(days) as Total FROM `isp_recording` WHERE person IN ( 'Anil Kumar Kunapareddy', 'Kaushik Bangalore Venkatarama', 'David Uhr', 'Balakameswara Sarma Sishta', 'Kishan Vimalachandran', 'Abhishek Anand', 'mr. Mrinal Sarkar')  AND orderType = 'Internal Order'";

	$empl_result_it_special_internal = mysql_query($query_employees_it_special_internal, $conn);

	if (!$empl_result_it_special_internal) { // add this check.
		die('Invalid query: ' . mysql_error());
	}




	$query_other_employees_it = "SELECT sum(days) as USEmp FROM `isp_recording` WHERE person NOT IN ( 'Anil Kumar Kunapareddy', 'Kaushik Bangalore Venkatarama', 'David Uhr', 'Balakameswara Sarma Sishta', 'Kishan Vimalachandran', 'Abhishek Anand', 'mr. Mrinal Sarkar')  AND orderType = 'Customer Order'";

	$other_empl_result_it = mysql_query($query_other_employees_it, $conn);

	if (!$other_empl_result_it) { // add this check.
		die('Invalid query: ' . mysql_error());
	}



	$NoServicesIT = "SELECT count(SO) as Total FROM `abcd_it_2016_extra`";

	$NoServicesResultIT = mysql_query($NoServicesIT, $conn);

	if(!$NoServicesResultIT) {
		die('Could not get data from new ITP 2016 result1: ' . mysql_error());
	}




   	mysql_close();
   	?>