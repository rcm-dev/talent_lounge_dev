<?php require_once('../../Connections/conJobsPerak.php'); ?>
<?php  

// include '../con/conDB.php';
session_start();
$userID = $_SESSION['MM_UserID'];

$aid = mysql_real_escape_string(@$_GET['aid']);



/****************************
 *
 * Record Set for DeleteAnswerOnly 
 * MySQL Info 
 * Table Used DeleteAnswerOnly
 *
 ***************************/

$query_rsDeleteAnswerOnly = "DELETE FROM test_answer WHERE aid = $aid";
$result_rsDeleteAnswerOnly = mysql_query($query_rsDeleteAnswerOnly);

echo "Deleted!";




?>