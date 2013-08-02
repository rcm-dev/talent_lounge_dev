<?php require_once('../../Connections/conJobsPerak.php'); ?>
<?php  
	
session_start();	
$userID = $_SESSION['MM_UserID'];
// include '../con/conDB.php';

$testName       = mysql_real_escape_string($_GET['testName']);
$testDescription= mysql_real_escape_string($_GET['testDescription']);
$testScore      = mysql_real_escape_string($_GET['testScore']);
$testUserID     = mysql_real_escape_string($_GET['testUserID']);


$query_insert_new       = "INSERT INTO test_name (tid, user_id_fk, test_name, test_desc, test_score) 
							VALUES ('', $testUserID, '$testName', '$testDescription', '$testScore')";
$result_insert_new_test = mysql_query($query_insert_new);

if(!$result_insert_new_test) {
	echo "SQL ERROR " . mysql_error();
} else {
	echo "Saved";
}
	



?>