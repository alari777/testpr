<?php

// $typeCount = isset($_POST['typeCount']) ? strip_tags($_POST['typeCount']) : "";

$str = "Something wrong 2 ...";

if ($typeCount!="") {

	/*database*/
	/**/
	define ("DBNAME", "testpr");
	define ("DBUSER", "root");
	define ("DBPASS", "");

	define ("DBHOST", "localhost"); 

	$mysqli = new mysqli("localhost", "root", "", "testpr");

	/* check connection */ 
	if (mysqli_connect_errno()) {
	    //printf("Connect failed: %s\n", mysqli_connect_error());
	    //exit();
	}	


	switch ($typeCount) {
		case 'get_summ':
			$strResult = "summa";
			break;

		case 'get_multi':
			$strResult = "multiplication";
			break;

		case 'get_diff':
			$strResult = "difference";
			break;

		case 'get_div':
			$strResult = "division";
			break;									
		
		default:
			$strResult = "summa";
			break;
	}

	$sql 	= "SELECT COUNT(*) as totalCount FROM `operations` AS op 
				LEFT JOIN `numbers` as num ON (op.`id` = num.`id`)
				WHERE op.`name` = '{$strResult}';";
	$result = $mysqli->query($sql);

    while($row = mysqli_fetch_assoc($result)) { 
        $totalCount = $row['totalCount'];
    } 

	echo $totalCount;
}
	else echo $str;
?>