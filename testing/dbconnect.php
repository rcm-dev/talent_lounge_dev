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

?>