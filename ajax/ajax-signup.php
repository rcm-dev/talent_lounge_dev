<?php 

/**
 * Database
 */

include '../db/db-connect.php';

if ($_POST) {


	$email 	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['email'])));

	$sqlEmail = "SELECT
	  mj_users.usr_email
	From
	  mj_users
	Where
	  mj_users.usr_email = '$email'";

	$result = mysql_query($sqlEmail);
	$numrow = mysql_num_rows($result);

	if ($numrow == 1) {
		
		echo $numrow;

	} else {
		
		echo 0;

	}


}


?>