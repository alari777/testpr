<?php

$arg1 = isset($_POST['arg1']) ? strip_tags($_POST['arg1']) : "";
$arg2 = isset($_POST['arg2']) ? strip_tags($_POST['arg2']) : "";

$str   = array();
$str[] = "Something wrong 1...";

if ($arg1!=""&&$arg2!="") {

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

	$rand   = rand(0, 3);

	switch ($rand) {
		case 0:
			$strResult = "summa";
			$intResult = intval($arg1) + intval($arg2);
			break;

		case 1:
			$strResult = "multiplication";
			$intResult = intval($arg1) * intval($arg2);

			break;

		case 2:
			$strResult = "difference";
			$intResult = intval($arg1) - intval($arg2);
			break;

		case 3:
			$strResult = "division";
			$intResult = intval($arg1) / intval($arg2);
			break;									
		
		default:
			$strResult = "summa";
			$intResult = intval($arg1) + intval($arg2);
			break;
	}

	$sql 	= "INSERT INTO `numbers` (`id`, `arg1`, `arg2`, `result`) VALUES (NULL, '{$arg1}', '{$arg2}', '{$intResult}');";
	$result = $mysqli->query($sql);

	$sql 	= "INSERT INTO `operations` (`id`, `name`) VALUES (NULL, '{$strResult}');";
	$result = $mysqli->query($sql);	

	$operations = array();

	$arg1 = trim($arg1);
	$arg2 = trim($arg2);

	$operations[] = intval($arg1) + intval($arg2);
	$operations[] = intval($arg1) * intval($arg2);
	$operations[] = intval($arg1) - intval($arg2);
	$operations[] = intval($arg1) / intval($arg2);	

	echo json_encode($operations);
}
	else echo json_encode($str);
?>