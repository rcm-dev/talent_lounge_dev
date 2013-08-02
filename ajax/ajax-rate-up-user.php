<?php  

include '../db/db-connect.php';

$iduser = $_POST['curruseridview'];

$sqlRateUpUser = "UPDATE mj_users SET usr_rating = usr_rating+1 WHERE usr_id = '$iduser'";
$sqlResult = mysql_query($sqlRateUpUser);

if ($sqlResult) {
	echo "Thank Your for your rating.";
}

?>