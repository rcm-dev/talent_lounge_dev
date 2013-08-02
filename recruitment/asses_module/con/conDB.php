<?php  



$server = 'localhost';
$user = 'root';
$pwd = '';

$database = 'tl';


$con = mysql_connect($server, $user, $pwd);

if (!$con) {
	echo "Disconnected";
} else {
	mysql_select_db($database);
}



/**
 * DEBUG MODE
 * SESSION SET TO USER 1
 */
// session_start();

$userID = $_SESSION['MM_UserID'];


?>