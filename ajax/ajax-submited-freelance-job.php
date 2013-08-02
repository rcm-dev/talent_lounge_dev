<?php  


// GET POST
$user_id				=	mysql_real_escape_string($_GET['user_id']);
$idea_title				=	mysql_real_escape_string($_GET['idea_title']);
$idea_desc				=	mysql_real_escape_string($_GET['idea_desc']);
$idea_skills			=	mysql_real_escape_string($_GET['idea_skills']);
$job_categories			=	mysql_real_escape_string($_GET['job_categories']);
$job_budget				=	mysql_real_escape_string($_GET['job_budget']);



?>


<div id="preview">

<h3>Submission preview</h3>

<label>Title</label>
<p><?php echo $idea_title ?></p>

<label>Description </label>
<p><?php echo $idea_desc ?></p>

<label>Skills </label>
<p><?php echo $idea_skills ?></p>

<label>Category  </label>
<p><?php //echo $idea_cat ?></p>
<p>
	<?php  

	require '../db/db-connect.php';

	$displayCat = "SELECT
	  f_categories.fc_name As catNamePreview
	From
	  f_categories
	Where
	  f_categories.fc_id = '$job_categories'";
	$resultCat = mysql_query($displayCat);
	$rowCar = mysql_fetch_object($resultCat);

	echo ucwords($rowCar->catNamePreview);

	?>
</p>

<label>Budget </label>
<p>
	<?php  

	require '../db/db-connect.php';

	$displayCat = "SELECT
	  f_budget.fb_range As badNamePreview
	From
	  f_budget
	Where
	  f_budget.fb_id = '$job_budget'";
	$resultCat = mysql_query($displayCat);
	$rowCar = mysql_fetch_object($resultCat);

	echo ucwords($rowCar->badNamePreview);

	?>
</p>

<?php //echo $user_id; ?>

<form action="#" method="post" id="hiddenIdeaForm" accept-charset="utf-8">
	<input type="hidden" name="idea_title" value="<?php echo $idea_title ?>" />
	<input type="hidden" name="idea_desc" value="<?php echo $idea_desc ?>" />
	<input type="hidden" name="idea_skills" value="<?php echo $idea_skills ?>" />
	<input type="hidden" name="job_categories" value="<?php echo $job_categories ?>" />
	<input type="hidden" name="job_budget" value="<?php echo $job_budget ?>" />
	<input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
	<input type="submit" name="submitIdeaReview" class="button green" id="submitIdeaReview" value="Submit Jobs">

</form>

</div>




<!-- successfull submit -->
<div id="success" class="none">
	<p>Your idea has been submited to MOJO Site.<br>
		Upload your picture, video to make it more valueable idea.</p>
</div><!-- /success -->




<!-- upload video and picture -->
<div id="ideaMediaUpload">
	
</div><!-- /ideaMediaUpload -->

<script type="text/javascript">

	$('label').css('font-weight','bold');
	$('p').css('margin','5px 0px');


	/* submit to server */
	$('#submitIdeaReview').click(function(){

		$('#preview').fadeOut();


		var data = $('#hiddenIdeaForm').serialize();

		$.ajax({

			url: 'freelance-job-submited.php',
			type: 'POST',
			data: data,

			success: function(html){


				$('#editIdeaSubmission').hide();
				$('#cancelNewIdea').hide();

				//$('#success').fadeIn();
				//$('#ideaMediaUpload').html('loading...').load('ajax/ajax-idea-media-upload.php?ideaid='+html);

				console.log('load upload media '+html);
				$.jnotify("Your Jobs has been submited", 5000);
			}


		});


		//alert('submited');
		console.log('clicked');
		return false;

	});

</script>