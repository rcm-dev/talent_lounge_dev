<?php require_once('../../Connections/conJobsPerak.php'); ?>
<?php  

session_start();
$userID = $_SESSION['MM_UserID'];
// include '../con/conDB.php';

$test_id = mysql_real_escape_string(@$_GET['test_id']);

$query_test = "SELECT * FROM test_question WHERE tid_fk = " . $test_id;
$result_test = mysql_query($query_test);
$total_rows_test = mysql_num_rows($result_test);


?>

<?php while ($row_rsQuestions = mysql_fetch_object($result_test)) { ?>
	<li>
		No.<?php echo $row_rsQuestions->qno; ?>
		<?php echo $row_rsQuestions->qname; ?>
	</li>
<?php } ?>