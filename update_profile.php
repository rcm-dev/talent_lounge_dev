<?php  


require 'db/db-connect.php';

$curr_username			=	$_POST['curr_username'];
$currPhone				=	$_POST['currPhone'];
$currGeneralInfo		=	$_POST['currGeneralInfo'];
$currID					=	$_POST['currID'];



$updateProfil	=	"UPDATE mj_users SET usr_name = '$curr_username', usr_tel = '$currPhone', usr_general_info = '$currGeneralInfo' WHERE usr_id = '$currID'";

$resultUpdateProfil = mysql_query($updateProfil);

if ($resultUpdateProfil) {
	session_destroy();
	session_start();
	$usr_name = $_SESSION['curr_username'];
	header("location: connect.php");
}


?>