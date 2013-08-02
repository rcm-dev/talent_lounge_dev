<?php require_once('../Connections/conJobsPerak.php'); ?>
<?php  
	
session_start();	
$userID = $_SESSION['MM_UserID'];


$test_id = mysql_real_escape_string(@$_GET['test_id']);

$query_test_name = "SELECT * FROM test_name WHERE tid = $test_id";
$result_test_name = mysql_query($query_test_name);
$row_test_name = mysql_fetch_object($result_test_name);

?>

<br>
New Set of Questions  for <strong><?php echo $row_test_name->test_name; ?></strong>


<?php  

/****************************
 *
 * Record Set for ListQuestions 
 * MySQL Info 
 * Table Used ListQuestions
 *
 ***************************/

$query_rsListQuestions = "SELECT * FROM test_question WHERE tid_fk = " . $test_id;
$result_rsListQuestions = mysql_query($query_rsListQuestions);
$total_rows_rsListQuestions = mysql_num_rows($result_rsListQuestions);

?>

<br><br>
<a href="#" class="newQuestion">New Question</a>
<br><br>

<div class="newQuestionDone"></div>
<div class="newQuestionContainer" style="display:none">
	<form action="#" id="newQuestion" method="post">
		<label for="Question">Question</label>
		<textarea name="question_name" id="question_name" cols="30" rows="10"></textarea>

		<label for="Order">Question Order</label>
		<input type="text" name="question_order" id="question_order">
		<br>
		<input type="hidden" name="test_id" id="test_id" value="<?php echo $test_id ?>">
		<input type="submit" name="submitNewAndSaveQuestion" id="submitNewAndSaveQuestion"> &middot; <a href="#" id="cancelNewQuestion">Cancel</a>
	</form>
</div>

<?php 

/***
 *  show no data rsListQuestions
 **/

if($total_rows_rsListQuestions == 0) { ?>

	<p>No Questions</p>

<?php } else { // End If no data for rsListQuestions ?>


<!-- <a href="#" class="newQuestion">New Question</a> -->

<ul class="ListQuestions">

	<?php 

	/***
	 *  show data rsListQuestions
	 **/

	while($row_rsListQuestions = mysql_fetch_object($result_rsListQuestions)) { ?>
		
		<li>
			No.<?php echo $row_rsListQuestions->qno; ?>
			<?php echo $row_rsListQuestions->qname; ?> 
			[<a href="#" id="deleteQuestion" data-id="<?php echo $row_rsListQuestions->qid ?>">Delete</a>] 
			<span id="deleteQuestionContainer<?php echo $row_rsListQuestions->qid ?>" style="display:none">
				<a href="#" id="confirmDeleteQuestion<?php echo $row_rsListQuestions->qid ?>" data-id="<?php echo $test_id ?>">Yes</a> &middot; 
				<a href="#" id="cancelDeleteQuestion<?php echo $row_rsListQuestions->qid ?>">No</a>
			</span>

			<?php 

			/****************************
			 *
			 * Record Set for TotalAnswer 
			 * MySQL Info 
			 * Table Used TotalAnswer
			 *
			 ***************************/
			
			$query_rsTotalAnswer = "SELECT * FROM test_answer WHERE qid_fk = $row_rsListQuestions->qid ORDER BY ans_no ASC";
			$result_rsTotalAnswer = mysql_query($query_rsTotalAnswer);
			$total_rows_rsTotalAnswer = mysql_num_rows($result_rsTotalAnswer);
			
			?>
			<br>
			Type <?php echo $row_rsListQuestions->qtype ?> &middot; <i><?php echo $total_rows_rsTotalAnswer ?> Answer(s) [<a href="#" id="addNewAnswer" data-id="<?php echo $row_rsListQuestions->qid ?>">Add</a>]</i>

				<?php 
				
				/***
				 *  show no data rsTotalAnswer
				 **/
				
				if($total_rows_rsTotalAnswer == 0) { ?>
				
					<br><br>
					<ul class="TotalAnswer<?php echo $row_rsListQuestions->qid ?> answerLists">
						<li>No Answer(s)</li>
					</ul>
				
				<?php } else { // End If no data for rsTotalAnswer ?>
				
				<br><br>
				<ul class="TotalAnswer<?php echo $row_rsListQuestions->qid ?> answerLists">
				
					<?php 
				
					/***
					 *  show data rsTotalAnswer
					 **/
				
					while($row_rsTotalAnswer = mysql_fetch_object($result_rsTotalAnswer)) { ?>
						
						<li id="answer<?php echo $row_rsTotalAnswer->aid ?>">
							<?php echo $row_rsTotalAnswer->ans_text ?> &middot; Score <?php echo $row_rsTotalAnswer->ans_score; ?> &middot; Order <?php echo $row_rsTotalAnswer->ans_no; ?> [<a href="#" id="deleteAnswer" data-id="<?php echo $row_rsTotalAnswer->aid ?>" data-qid="<?php echo $row_rsListQuestions->qid ?>">Delete</a>]
						</li>
				
					<?php } // End IF data rsTotalAnswer ?>
				
				</ul>

				<?php } ?>
				
				<br>
				<!-- /subAnswer -->

			<div style="display:none" class="containerFormAnswer<?php echo $row_rsListQuestions->qid ?>">
				<form action="#" method="post" id="newAnswer<?php echo $row_rsListQuestions->qid ?>">
					<label for="Answer">Answer</label>
					<textarea name="answertText" id="answertText" cols="30" rows="10"></textarea>

					<label for="Score">Score</label>
					<input type="text" id="answerScore" name="answerScore">

					<label for="Answer Order">Order</label>
					<input type="text" id="answerOrder" name="answerOrder">

					<br>
					<input type="hidden" id="qid_fk" name="qid_fk" value="<?php echo $row_rsListQuestions->qid ?>">
					<input type="submit" name="submitNewAnswer" id="submitNewAnswer" data-id="<?php echo $row_rsListQuestions->qid ?>"> &middot; <a href="#" id="cancelAnswer" data-id="<?php echo $row_rsListQuestions->qid ?>">Cancel</a>
				</form>
				<br>
				<div class="answerSaved<?php echo $row_rsListQuestions->qid ?>"></div>
				<br>
			</div>
		</li>

	<?php } // End IF data rsListQuestions ?>

</ul>


<?php } // End Else ?>
