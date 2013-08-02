<?php  


require 'db/db-connect.php';

$curr_username			=	$_POST['curr_username'];
$currPhone				=	$_POST['currPhone'];
$currGeneralInfo		=	$_POST['currGeneralInfo'];



$updateProfil	=	"UPDATE mj_users SET usr_name = '$curr_username', usr_tel = '$currPhone', usr_general_info = '$currGeneralInfo'";

echo $updateProfil;



?>