<?php 

/**
 * Database
 */

include '../db/db-connect.php';

if ($_POST) {


	$contributepost 	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['contributepost'])));
	$currentUserComment = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['currentUserComment'])));
	$currentWallID		= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['currentWallID'])));

	$sqlEmail = "INSERT INTO mj_network_comment (nc_id, nc_wall_id_fk, nc_body, nc_comment_by) 
			VALUES (NULL, '$currentWallID', '$contributepost', '$currentUserComment');";

	$result = mysql_query($sqlEmail);
	$numrow = mysql_num_rows($result);

	if ($numrow == 1) {
		
		echo $numrow;

	} else {
		
		echo 0;

	}


}


?>