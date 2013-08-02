<?php  


/**
 * User network View
 */



include '../db/db-connect.php';
include '../session_checking.php';



if ($_POST) {

	$networkName = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['networkName'])));
	$netDesc	 = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['netDesc'])));
	$usr_id		 = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['usr_id'])));


	$newNetwork = "INSERT INTO mj_network (mn_id, mn_name, mn_desc, mn_published, mn_created_by)
	VALUES ('','$networkName', '$netDesc', '1', '$usr_id');";

	$resultNewNetwotk	= mysql_query($newNetwork);
	$newNetworkId		= mysql_insert_id();
	
	

	if ($resultNewNetwotk) {
		
		echo 1;

		$insertNetworkRelation = "INSERT INTO mj_network_relation (mnr_id, usr_id_fk, mn_id_fk, mnr_status)
		VALUES ('','$usr_id', '$newNetworkId', '1')";

		$resullNetRelation = mysql_query($insertNetworkRelation);

	} else {
		
		echo 0;

	}


}



?>
