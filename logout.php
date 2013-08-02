<?php  


// INCLUDE API
include 'db/db-connect.php';
include 'class/api.php';


// SESSION START
session_start();
$usr_email 	= $_SESSION['usr_email'];
$usr_id 	= $_SESSION['usr_id'];



// UPDATE LAST LOGIN
$sql = "UPDATE mj_users SET usr_last_login = '$lastLogin' WHERE usr_id = '$usr_id'";

$result = mysql_query($sql);

if (!$result) {
	echo "Error Update TIMESTAMP";
} else {
	
	// DESTROY SESSION and REDIRECT
	session_unset($usr_email);
	session_unset($usr_id);
	session_unset($usr_name);
	session_destroy();
	header("location: index.php");	
}


?>