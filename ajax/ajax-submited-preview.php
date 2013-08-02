<?php  


// GET POST
$user_id				=	$_GET['user_id'];
$idea_title				=	$_GET['idea_title'];
$idea_desc				=	$_GET['idea_desc'];
$idea_cat				=	$_GET['idea_category'];
$idea_prob				=	$_GET['idea_prob'];
$idea_solu				=	$_GET['idea_sol'];
$idea_features			=	$_GET['idea_fea'];
$idea_trget_market		=	$_GET['idea_target'];
$idea_smlr_prod			=	$_GET['idea_sp'];
//$idea_picture			=	$_FILES['idea_file']['name'];
//$idea_m_picture			=	$_FILES['idea_m_picture']['name'];
//$idea_m_video			=	$_FILES['idea_m_video']['name'];


?>


<div id="preview">

<h3>Submission preview</h3>

<label>Title</label>
<p><?php echo $idea_title ?></p>

<label>Description </label>
<p><?php echo $idea_desc ?></p>

<label>Category  </label>
<p><?php //echo $idea_cat ?></p>
<p>
	<?php  

	require '../db/db-connect.php';

	$displayCat = "SELECT
	  mj_idea_category.id_cat_name As catNamePreview
	From
	  mj_idea_category
	Where
	  mj_idea_category.id_cat_id = '$idea_cat'";
	$resultCat = mysql_query($displayCat);
	$rowCar = mysql_fetch_object($resultCat);

	echo ucwords($rowCar->catNamePreview);

	?>
</p>

<label>The Problem </label>
<p><?php echo $idea_prob ?></p>

<label>The Solution </label>
<p><?php echo $idea_solu ?></p>

<label>Features  </label>
<p><?php echo $idea_features ?></p>

<label>Target Market / Customer / End User  </label>
<p><?php echo $idea_trget_market ?></p>

<label>Similar Product </label>
<p><?php echo $idea_smlr_prod ?></p>

<?php //echo $user_id; ?>

<form action="#" method="post" id="hiddenIdeaForm" accept-charset="utf-8">
	<input type="hidden" name="idea_title" value="<?php echo $idea_title ?>" />
	<input type="hidden" name="idea_desc" value="<?php echo $idea_desc ?>" />
	<input type="hidden" name="idea_cat" value="<?php echo $idea_cat ?>" />
	<input type="hidden" name="idea_prob" value="<?php echo $idea_prob ?>" />
	<input type="hidden" name="idea_solu" value="<?php echo $idea_solu ?>" />
	<input type="hidden" name="idea_features" value="<?php echo $idea_features ?>" />
	<input type="hidden" name="idea_trget_market" value="<?php echo $idea_trget_market ?>" />
	<input type="hidden" name="idea_smlr_prod" value="<?php echo $idea_smlr_prod ?>" />
	<input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
	<input type="hidden" name="idea_file" value="NULL" />

	<input type="submit" name="submitIdeaReview" class="button green" id="submitIdeaReview" value="Submit &amp; Upload Visual">

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

			url: 'idea-submited.php',
			type: 'POST',
			data: data,

			success: function(html){


				$('#editIdeaSubmission').hide();
				$('#cancelNewIdea').hide();

				//$('#success').fadeIn();
				$('#ideaMediaUpload').html('loading...').load('ajax/ajax-idea-media-upload.php?ideaid='+html);

				console.log('load upload media '+html);
				$.jnotify("Your idea has been submit. Now upload your related picture.", 5000);
			}


		});


		//alert('submited');
		console.log('clicked');
		return false;

	});

</script>