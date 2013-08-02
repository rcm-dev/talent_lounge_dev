<?php require_once('../Connections/conJobsPerak.php'); ?>
<?php  
	
session_start();	
$userID = $_SESSION['MM_UserID'];

$tid = mysql_real_escape_string(@$_POST['tid']);


/****************************
 *
 * Record Set for Test 
 * MySQL Info 
 * Table Used Test
 *
 ***************************/

$query_rsTest = "SELECT * FROM test_name WHERE tid = $tid";
$result_rsTest = mysql_query($query_rsTest);
$total_rows_rsTest = mysql_num_rows($result_rsTest);
$row_rsTest = mysql_fetch_object($result_rsTest);


/****************************
 *
 * Record Set for Question 
 * MySQL Info 
 * Table Used Question
 *
 ***************************/

$query_rsQuestion = "SELECT * FROM test_question WHERE tid_fk = $row_rsTest->tid";
$result_rsQuestion = mysql_query($query_rsQuestion);
$total_rows_rsQuestion = mysql_num_rows($result_rsQuestion);


$scores = 0;

while ($row_rsQuestions = mysql_fetch_object($result_rsQuestion)) {


	$scores += $_POST['answerScore'.$row_rsQuestions->qid];

	// echo '<input type="text" name="answerScore'.$row_rsQuestions->qid.'" value="'.$_POST['answerScore'.$row_rsQuestions->qid].'">';
	// echo "<br/>";
	
	
	
}

echo "Your Score is ".$scores."/".$row_rsTest->test_score;


?>

<br><br>
<a href="index.php">Main</a>