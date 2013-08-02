<?php 

/**
 * Database
 */

$dbuser = 'root';
$dbpwd	= '';
$dbhost = 'localhost';
$dbname = 'testing';

$db = mysql_connect($dbhost, $dbuser, $dbpwd);

if (!$db) {
	die('Could not connect: ' . mysql_error());
} 

mysql_select_db($dbname, $db);

if ($_POST) {


	$comUsr = $_POST['comb'];

	mysql_query("INSERT INTO comment (com_id, com_body) VALUES ('', '$comUsr')");


}


?>

<li class="comment-box">
	<span><?php echo $comUsr; ?></span>
</li>