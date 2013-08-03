<?php 

/**
 * Database
 */

// localhost
/*$dbuser = 'root';
$dbpwd	= '';
$dbhost = 'localhost';
$dbname = 'new_sb';
$server = 'http://localhost:81/mojo/';*/

// Live Server
/*$dbuser = 'pathfind_user1';
$dbpwd	= 'USER!PASSWORD';
$dbhost = 'localhost';
$dbname = 'pathfind_sb';
$server = 'http://pathfinder.my';*/

$dbuser = 'root';
$dbpwd	= '';
$dbhost = 'localhost';
$dbname = 'talentlo_livedb';
$server = 'http://localhost/zing.my';




$db = mysql_connect($dbhost, $dbuser, $dbpwd);

if (!$db) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db($dbname, $db);

?>