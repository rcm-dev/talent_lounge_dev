<?php require_once('../../Connections/conJobsPerak.php'); ?>
<?php  

session_start();
$userID = $_SESSION['MM_UserID'];
// include '../con/conDB.php';


$qid_fk = mysql_real_escape_string(@$_GET['qid_fk']);

/****************************
 *
 * Record Set for AllAnswer 
 * MySQL Info 
 * Table Used AllAnswer
 *
 ***************************/

$query_rsAllAnswer = "SELECT * FROM test_answer WHERE qid_fk = $qid_fk ORDER BY ans_no ASC";
$result_rsAllAnswer = mysql_query($query_rsAllAnswer);

?>

<?php while ($row_rsAllAnswer = mysql_fetch_object($result_rsAllAnswer)) { ?>
	
	<li>
		<?php echo $row_rsAllAnswer->ans_text ?> &middot; 
		Score <?php echo $row_rsAllAnswer->ans_score; ?> &middot; 
		Order <?php echo $row_rsAllAnswer->ans_no; ?>
	</li>

<?php } ?>
