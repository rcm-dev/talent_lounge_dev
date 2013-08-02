<?php 

/**
 * Database
 */

include '../db/db-connect.php';

if ($_POST) {


	$statusupdate 	 = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['statusupdate'])));
	$currID		     = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['currID'])));

	$sqlstatus       = "INSERT INTO mj_status (status_id, status_usr_id_fk, status_body)
						VALUES ('', '$currID', '$statusupdate')";

	$resultsqlstatus = mysql_query($sqlstatus);
	$numrow          = mysql_num_rows($resultsqlstatus);

	if ($numrow == 1) {
		
		echo $numrow;

	} else {
		
		echo 0;

	}


}


?>