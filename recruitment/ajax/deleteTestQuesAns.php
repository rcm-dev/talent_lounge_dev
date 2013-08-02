<?php require_once('../Connections/conJobsPerak.php'); ?>
<?php  

session_start();
$userID = $_SESSION['MM_UserID'];
// include '../con/conDB.php';


$test_id = mysql_real_escape_string(@$_GET['test_id']);


/****************************
 *
 * Record Set for masterDelete 
 * MySQL Info 
 * Table Used masterDelete
 *
 ***************************/

$query_rsmasterDelete = "DELETE FROM test_name WHERE tid = " . $test_id;
$result_rsmasterDelete = mysql_query($query_rsmasterDelete);




/****************************
 *
 * Record Set for AllQuestions 
 * MySQL Info 
 * Table Used AllQuestions
 *
 ***************************/

$query_rsAllQuestions = "SELECT * FROM test_question WHERE tid_fk = " . $test_id;
$result_rsAllQuestions = mysql_query($query_rsAllQuestions);
$total_rows_rsAllQuestions = mysql_num_rows($result_rsAllQuestions);


if ($total_rows_rsAllQuestions != 0) {
	
	
	while ($rows_rsAllQuestions = mysql_fetch_object($result_rsAllQuestions)) {
		
		/****************************
		 *
		 * Record Set for deleteAnswer 
		 * MySQL Info 
		 * Table Used deleteAnswer
		 *
		 ***************************/
		
		$query_rsdeleteAnswer = "DELETE FROM test_answer WHERE qid_fk = " . $rows_rsAllQuestions->qid;
		$result_rsdeleteAnswer = mysql_query($query_rsdeleteAnswer);

	}
	
	

}


/****************************
 *
 * Record Set for masterDeleteQuestion 
 * MySQL Info 
 * Table Used masterDeleteQuestion
 *
 ***************************/

$query_rsmasterDeleteQuestion = "DELETE FROM test_question WHERE tid_fk = " . $test_id;
$result_rsmasterDeleteQuestion = mysql_query($query_rsmasterDeleteQuestion);


// echo "Deleted!";


?>