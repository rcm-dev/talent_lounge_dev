<?php  


/**
 * 
 * 
 * Invite to join group
 */
include '../db/db-connect.php';

if ($_POST) {


	$fid 	            = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['fid'])));
	$vid 	            = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['vid'])));
	$currUserId         = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['currUserId'])));

	$insertNewMember    = "INSERT INTO mj_network_relation 
						(mnr_id, usr_id_fk, mn_id_fk, mnr_status)
						VALUES (NULL ,  '$fid',  '$vid',  '0')";
	$resultinsertNew    = mysql_query($insertNewMember);

	$sqlNotification    = "INSERT INTO mj_notification (noti_id, noti_type_id_fk, mj_group_id_fk, noti_to_usr_id, noti_request_usr_id_fk, noti_status) VALUES ('', '6', '$vid', '$fid', '$currUserId', '1')";

	$resultNotification = mysql_query($sqlNotification);

	echo "Waiting Confirmation";


}




?>