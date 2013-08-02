<?php require_once('../Connections/conJobsPerak.php'); ?>
<?php  
	
session_start();	
$userID = $_SESSION['MM_UserID'];

// get current assessment id
$tid = base64_decode(mysql_real_escape_string(@$_GET['tid']));

/****************************
 *
 * Record Set for CurrentAssesment 
 * MySQL Info 
 * Table Used CurrentAssesment
 *
 ***************************/

$query_rsCurrentAssesment      = "SELECT * FROM test_name WHERE tid = $tid";
$result_rsCurrentAssesment     = mysql_query($query_rsCurrentAssesment);
$total_rows_rsCurrentAssesment = mysql_num_rows($result_rsCurrentAssesment);
$row_rsCurrentAssesment        = mysql_fetch_object($result_rsCurrentAssesment);





/****************************
 *
 * Record Set for Question 
 * MySQL Info 
 * Table Used Question
 *
 ***************************/

$query_rsQuestion      = "SELECT * FROM test_question WHERE tid_fk = $row_rsCurrentAssesment->tid ORDER BY qno ASC";
$result_rsQuestion     = mysql_query($query_rsQuestion);
$total_rows_rsQuestion = mysql_num_rows($result_rsQuestion);





?>
<html>
<head>
	<title>Preview Assessment : <?php echo $row_rsCurrentAssesment->test_name ?></title>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
</head>
<body>

<h2><?php echo $row_rsCurrentAssesment->test_name ?></h2>
<p>
	<?php echo $row_rsCurrentAssesment->test_desc ?>
</p>

<form action="preview_score.php" method="post" id="formAction<?php echo str_replace(" ", "", ucfirst($row_rsCurrentAssesment->test_name)); ?>">

<ol class="question<?php echo str_replace(" ", "", ucfirst($row_rsCurrentAssesment->test_name)); ?>">
	<?php while($row_rsQuestion = mysql_fetch_object($result_rsQuestion)) { ?>

		<li>
			<?php echo $row_rsQuestion->qname ?>
			<ul>
				<?php  


				/****************************
				 *
				 * Record Set fo rsAnswer 
				 * MySQL Info 
				 * Table Use rsAnswer
				 *
				 ***************************/
				
				$query_rsAnswer = "SELECT * FROM test_answer WHERE qid_fk = $row_rsQuestion->qid ORDER BY aid ASC";
				$result_rsAnswer = mysql_query($query_rsAnswer);
				$total_rows_rsAnswer = mysql_num_rows($result_rsAnswer);
				
				while ($row_rsAnswer = mysql_fetch_object($result_rsAnswer)) { ?>
					
					<li>
						<?php if ($row_rsQuestion->qtype == "radio"): ?>
							<input type="radio" name="answerScore<?php echo $row_rsQuestion->qid ?>" id="answerScore<?php echo $row_rsAnswer->aid ?>" value="<?php echo $row_rsAnswer->ans_score; ?>">
						<?php endif ?>
						<?php echo $row_rsAnswer->ans_text; ?>
					</li>

				<?php } ?>
			</ul>
			<br>
		</li>

	<?php } ?>
</ol>

	<input type="submit" id="submitBtn" data-name="<?php echo str_replace(" ", "", ucfirst($row_rsCurrentAssesment->test_name)); ?>" value="Submit Test">
	<input type="hidden" id="tid" name="tid" value="<?php echo $row_rsCurrentAssesment->tid ?>">
</form>

<br><br>
<a href="index.php">Main</a>

<script>
	$(document).ready(function(){

		// var submitBtn = $('input#submitBtn');

		// submitBtn.live('click', function(){

		// 	var testName = $(this).attr('data-name');

		// 	var formData = $('form#formAction'+testName).serialize();


		// 	console.log('Data '+formData);
		// 	return false;

		// });

	});
</script>
</body>
</html>