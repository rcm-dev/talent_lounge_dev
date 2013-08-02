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


	$inputUsr = $_POST['input'];
	$txtUsr	  = $_POST['txtarea'];

	mysql_query("INSERT INTO form (form_id, form_input, form_txt) VALUES ('', '$inputUsr', '$txtUsr')");


}


?>