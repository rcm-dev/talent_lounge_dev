<?php require_once('../../Connections/conJobsPerak.php'); ?>
<?php  
session_start();
$userID = $_SESSION['MM_UserID'];
// include '../con/conDB.php';


$answertText  = mysql_real_escape_string(@$_GET['answertText']);
$answerScore  = mysql_real_escape_string(@$_GET['answerScore']);
$answerOrder  = mysql_real_escape_string(@$_GET['answerOrder']);
$qid_fk       = mysql_real_escape_string(@$_GET['qid_fk']);


/****************************
 *
 * Record Set for InsertNewAnswer 
 * MySQL Info 
 * Table Used InsertNewAnswer
 *
 ***************************/

$query_rsInsertNewAnswer = "INSERT INTO test_answer (aid, qid_fk, ans_text, ans_score, ans_no) 
							VALUES ('', $qid_fk, '$answertText', $answerScore, $answerOrder)";
$result_rsInsertNewAnswer = mysql_query($query_rsInsertNewAnswer);

if (!$result_rsInsertNewAnswer) {
	echo "ERROR " . mysql_error();
} else {
	echo "Saved!";
}



?>