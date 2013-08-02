<?php  


include '../db/db-connect.php';

if ($_POST) {

	$messageto				=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['messageto'])));
	$messageby				=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['messageby'])));
	$sendmessagebody		=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['sendmessagebody'])));

	$messagenotitype	=	1;
	$unread				=	1;



	#1 New Threading message
	$insertNewThread 	= "INSERT INTO mj_message_thread (mt_id) VALUES ('')";
	$rinsertThread		= mysql_query($insertNewThread);
	$newThreadID		= mysql_insert_id();




	#2 New message with threading
	$insertPledge  	= "INSERT INTO mj_message (msg_id, msg_thread_id, msg_to, msg_by_usr_id_fk, msg_body, msg_status)
						VALUES ('', '$newThreadID', '$messageto', '$messageby', '$sendmessagebody', '$unread')";
	$rinsertPledge 	= mysql_query($insertPledge);
	$newMessageID	= mysql_insert_id();


	#3 New Notification
	$insertnotification = "INSERT INTO mj_notification (noti_id, mj_type_id_id_fk, noti_type_id_fk, noti_to_usr_id, noti_request_usr_id_fk, noti_status) VALUES (NULL, '$newMessageID', '$messagenotitype', '$messageto', '$messageby', '$unread')";
	$rinsertNoti	= mysql_query($insertnotification);




	if ($rinsertPledge && $rinsertNoti) {
		
		echo 1;

	} else {
		
		echo 0;

	}

}



?>