<?php  


/**
 * 
 * 
 * Invite to join network
 */
include '../db/db-connect.php';

if ($_POST) {


	$email 	= $_POST['email'];

	$numrow = 1;

	if ($numrow == 1) {
		
		echo $numrow;

	} else {
		
		echo 0;

	}


}




?>