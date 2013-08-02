<?php 

/**
 * Database
 */

include '../db/db-connect.php';

if ($_POST) {


	$conum 	= $_POST['conum'];

	$sqlconum = "SELECT
	  _company.comp_name As coName
	From
	  _company
	Where
	  _company.comp_co_num = '$conum'";

	$result = mysql_query($sqlconum);
	$numrow = mysql_num_rows($result);
	$row    = mysql_fetch_object($result);

	if ($numrow == 1) {
		
		echo $numrow;

	} else {
		
		echo 0;

	}


}


?>