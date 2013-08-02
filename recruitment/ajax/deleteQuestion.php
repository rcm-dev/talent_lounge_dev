<?php require_once('../Connections/conJobsPerak.php'); ?>
<?php  

session_start();
$userID = $_SESSION['MM_UserID'];
// include '../con/conDB.php';

$qid = mysql_real_escape_string(@$_GET['qid']);


/****************************
 *
 * Record Set for DeleteQuestion 
 * MySQL Info 
 * Table Used DeleteQuestion
 *
 ***************************/

$query_rsDeleteQuestion = "DELETE FROM test_question WHERE qid = $qid";
$result_rsDeleteQuestion = mysql_query($query_rsDeleteQuestion);


/****************************
 *
 * Record Set for DeleteAnswerFromQuestion 
 * MySQL Info 
 * Table Used DeleteAnswerFromQuestion
 *
 ***************************/

$query_rsDeleteAnswerFromQuestion = "DELETE FROM test_answer WHERE qid_fk = $qid";
$result_rsDeleteAnswerFromQuestion = mysql_query($query_rsDeleteAnswerFromQuestion);






?>