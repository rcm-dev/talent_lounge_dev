<?php  


/**
 * User network View
 */



include '../db/db-connect.php';
//include '../session_checking.php';



if ($_POST) {

	$networkname = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['networkname'])));
	$groupDes	 = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['groupDes'])));
	$nid		 = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['nid'])));
	$usr_id		 = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['usr_id'])));


	$newNetwork = "UPDATE mj_network 
				SET mn_name = '$networkname', 
				mn_desc = '$groupDes' 
				WHERE mn_id = '$nid' 
				AND mn_created_by = '$usr_id'";

	$resultNewNetwotk	= mysql_query($newNetwork);

	if ($resultNewNetwotk) {
		echo 1;
	}
	else {
		echo 0;
	}


}



?>
