<?php  



include 'db/db-connect.php';
$currUserID      =	$_GET['id'];

$querymedia = "SELECT * FROM mj_users WHERE usr_id = '$currUserID'";
$result = mysql_query($querymedia);
$numrows = mysql_num_rows($result);

echo "<br><br><strong>Current Picture</strong><br><br>";


while ($row = mysql_fetch_object($result)) {
	

	echo '<img src="'.$row->user_pic.'" />';

}


?>