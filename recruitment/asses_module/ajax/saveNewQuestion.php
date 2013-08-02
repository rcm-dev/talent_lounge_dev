<?php require_once('../../Connections/conJobsPerak.php'); ?>
<?php  
	
session_start();
$userID = $_SESSION['MM_UserID'];
// include '../con/conDB.php';

$question_name       = mysql_real_escape_string($_GET['question_name']);
$question_order      = mysql_real_escape_string($_GET['question_order']);
$test_id             = mysql_real_escape_string($_GET['test_id']);


$query_insert_new       = "INSERT INTO test_question (qid, qname, qno, tid_fk) 
							VALUES ('', '$question_name', $question_order, $test_id)";
$result_insert_new_question = mysql_query($query_insert_new);

if(!$result_insert_new_question) {
	echo "SQL ERROR " . mysql_error();
} else {
	echo "Saved!";
}
	



?>