<?php 

/**
 * Database
 */

include '../db/db-connect.php';

if ($_POST) {


	$getuserviewid 	= $_POST['getuserviewid'];
	$currUsrId		= $_POST['currUsrId'];

	$sqlEmail = "INSERT INTO mj_usr_network (usr_network_id, usr_network_usr_id_fk, usr_network_friend_usr_id_fk, usr_network_approved) VALUES ('', '$currUsrId', '$getuserviewid', '1')";
	$result = mysql_query($sqlEmail);
	//$numrow = mysql_num_rows($result);

	// duplicate
	$sqlEmail2 = "INSERT INTO mj_usr_network (usr_network_id, usr_network_usr_id_fk, usr_network_friend_usr_id_fk, usr_network_approved) VALUES ('', '$getuserviewid', '$currUsrId', '1')";
	$result2 = mysql_query($sqlEmail2);

	// insert notification
	$sqlNotiFriend = "INSERT INTO mj_notification (noti_id, noti_type_id_fk, noti_to_usr_id, noti_request_usr_id_fk, noti_status) VALUES (NULL, '7', '$getuserviewid', '$currUsrId', '1')";
	$resultNotiFriend = mysql_query($sqlNotiFriend);


	/*if ($numrow == 1) {
		
		echo $numrow;

	} else {
		
		echo 0;

	}*/

	echo "Send Requested";


}


?>