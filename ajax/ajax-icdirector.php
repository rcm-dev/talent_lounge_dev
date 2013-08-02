<?php 

/**
 * Database
 */

include '../db/db-connect.php';

if ($_POST) {


	$icdirector 	= $_POST['icdirector'];

	$sqlconum = "SELECT _company_director._cd_name,
				       	_company_director._cd_ic
					FROM _company_director
					WHERE _company_director._cd_ic = '$icdirector'";

	$result = mysql_query($sqlconum);
	$numrow = mysql_num_rows($result);

	if ($numrow == 1) {
		
		echo $numrow;

	} else {
		
		echo 0;

	}


}


?>