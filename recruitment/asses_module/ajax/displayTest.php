<?php require_once('../../Connections/conJobsPerak.php'); ?>
<?php  

session_start();
$userID = $_SESSION['MM_UserID'];
// include '../con/conDB.php';


$query_test = "SELECT * FROM test_name WHERE user_id_fk = $userID ORDER BY tid ASC";
$result_test = mysql_query($query_test);
$total_rows_test = mysql_num_rows($result_test);


?>


<?php if ($total_rows_test == 0): ?>
	<p>No Test</p>
<?php endif ?>



<?php if ($total_rows_test != 0): ?>

<div class="doneDeleted"></div>

<ul class="testUI">
	<?php while ($row_test = mysql_fetch_object($result_test)) { ?>

		<li>
			<strong><?php echo $row_test->test_name; ?></strong> &middot; Scores <strong><?php echo $row_test->test_score; ?></strong> &middot; View <strong><?php echo $row_test->display; ?></strong> &middot; 
			[<a href="#" id="testDelete" data-id="<?php echo $row_test->tid; ?>">Delete</a>] 
			
			<span id="alertDelete<?php echo $row_test->tid; ?>" style="display:none">
				<a href="#" id="alertConfirmDelete<?php echo $row_test->tid; ?>" data-id="<?php echo $row_test->tid; ?>">Yes</a> &middot; 
				<a href="#" id="alertHideDelete<?php echo $row_test->tid; ?>" data-id="<?php echo $row_test->tid; ?>">No</a>
			</span>

			<div><?php echo $row_test->test_desc; ?></p>
			
			<?php 

			$query_questions = "SELECT * FROM test_question WHERE tid_fk = " . $row_test->tid; 
			$result_questions = mysql_query($query_questions);
			$total_rows_questions = mysql_num_rows($result_questions);

			?>

			<?php if ($total_rows_questions == 0) { ?>
				<strong><?php echo $total_rows_questions ?></strong> Question(s) &middot; 
				<a href="#" id="createNewQuestion" data-id="<?php echo $row_test->tid; ?>" data-name="<?php echo $row_test->test_name; ?>">Create Set of Questions</a>
				<br>
				<br>
			<?php } else { ?>
				<strong><?php echo $total_rows_questions ?></strong> Question(s) &middot; 
				<a href="#" id="editQuestion" data-id="<?php echo $row_test->tid; ?>" data-name="<?php echo $row_test->test_name; ?>">Edit Set of Questions</a> &middot; <a href="preview_assessment.php?tid=<?php echo base64_encode($row_test->tid); ?>" id="previewTest" data-id="<?php echo $row_test->tid; ?>">Preview Test</a>
				<br>
				<br>
			<?php } ?>
		</li>

	<?php } ?>
</ul>

<?php endif ?>