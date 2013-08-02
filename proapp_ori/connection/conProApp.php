<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
// $hostname_conProApp = 'localhost';
// $database_conProApp = 'richcore_sc';
// $username_conProApp = 'richcore_scuser';
// $password_conProApp ='Mmahfudz2010';
// $server_conProApp = 'http://sc.richcoremedia.com';


$hostname_conProApp = 'localhost';
$database_conProApp = 'sc';
$username_conProApp = 'root';
$password_conProApp ='';
$server_conProApp   = 'http://localhost/zing.my';


// $dbuser = 'root';
// $dbpwd	= '';
// $dbhost = 'localhost';
// $dbname = 'sc';
// $server = 'http://localhost/zing.my';

$conProApp = mysql_pconnect($hostname_conProApp, $username_conProApp, $password_conProApp) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_conProApp);
?>