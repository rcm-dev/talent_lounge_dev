<?php  


include '../db/db-connect.php';


$amount			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['pledge'])));
$pledgedBy		=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['pledgedBy'])));
$projectId		=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['projectId'])));
$minPledge		=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['minPledge'])));
$fAmount		=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['fAmount'])));

if ($amount >= $minPledge) {
	$insertPledge  	= "INSERT INTO mj_fund_pledged (fund_pledged_id, fund_usr_id_fk, fund_post_id_fk, fund_money)
					VALUES ('', '$pledgedBy', '$projectId', '$amount')";
	$rinsertPledge 	= mysql_query($insertPledge);

	echo 1;
}
else {
	echo 0;
}







?>