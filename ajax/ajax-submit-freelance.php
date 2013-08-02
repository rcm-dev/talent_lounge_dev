<?php 

$usr_id = mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['id'])));

include '../db/db-connect.php';



?>


<div id="headingContainer" class="">
	
	<div class="left">
		<strong class="light_bulb_color">Freelance Section</strong>
	</div>

	<div class="right">
		<a href="#" title="Submit New Idea" id="submitNewIdea" class="light-bulb--plus_color">New Job</a>
		<a href="#" id="editIdeaSubmission" title="Edit" class="none">
			<img src="images/icon_grey/ic_edit.png" original-title="Edit">
		</a>
		<a href="#" title="Cancel" id="cancelNewIdea" class="none">
			<img src="images/icon_grey/ic_cancel.png" original-title="Cancel">
		</a>
	</div>

	<div class="clear"></div>

</div><!-- /headingContainer -->	


<div id="ideaError" class="ui-state-error ui-corner-all none" style="padding: 4px;">
	Fill up the form
</div><!-- / -->

<div id="newIdea" class="none">
	<h3>New Idea</h3><br/>
	<p>
		<form action="idea-submited-preview.php" enctype="multipart/form-data" id="ideaForm" method="post">

		<label>Job Title</label>
		<input type="text" name="idea_title" id="idea_title" class="title" />

		<label>Job Description</label>
		<textarea name="idea_desc" id="idea_desc"></textarea>

		<label>Skills</label>
		<textarea name="idea_skills" id="" cols="30" rows="10"></textarea>


		<label for="Categories">Categories</label>
		<select name="job_categories" id="job_categories">
			<?php  

			/****************************
			 *
			 * Record Set for FCategories 
			 * MySQL Info 
			 * Table Used FCategories
			 *
			 ***************************/
			
			$query_rsFCategories = "SELECT * FROM f_categories";
			$result_rsFCategories = mysql_query($query_rsFCategories);
			$total_rows_rsFCategories = mysql_num_rows($result_rsFCategories);
			

			?>
			<option value="">Select Job Category</option>
			<?php while ($row_rsFLCategories = mysql_fetch_object($result_rsFCategories)) { ?>
				<option value="<?php echo $row_rsFLCategories->fc_id ?>"><?php echo $row_rsFLCategories->fc_name ?></option>
			<?php } ?>
		</select>

		<label for="Categories">Budget</label>
		<select name="job_budget" id="job_budget">
			<?php  

			/****************************
			 *
			 * Record Set for FCategories 
			 * MySQL Info 
			 * Table Used FCategories
			 *
			 ***************************/
			
			$query_rsFBudget = "SELECT * FROM f_budget";
			$result_rsFBudget = mysql_query($query_rsFBudget);
			$total_rows_rsFBudget = mysql_num_rows($result_rsFBudget);
			

			?>
			<option value="">Select Budget</option>
			<?php while ($row_rsFBudget = mysql_fetch_object($result_rsFBudget)) { ?>
				<option value="<?php echo $row_rsFBudget->fb_id ?>"><?php echo $row_rsFBudget->fb_range ?></option>
			<?php } ?>
		</select>

		<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
		<!-- <label for="">Get Visuals</label>
		<span>The picture that can impress the audience.</span>
		<br/>
		<input type="file" name="idea_file" id="idea_file" class= />
		<br><br>


		<label for="">More picture</label>
		<span>Upload multiple picture here</span><br>
		<input type="file" name="idea_m_picture" id="idea_m_picture" />
		<br><br>

		<label for="">More Video</label>
		<span>Upload multiple video here</span><br>
		<input type="file" name="idea_m_video" id="idea_m_video" />
		<br><br> -->


		<div clear></div>

		<input type="hidden" name="user_id" value="<?php echo $usr_id; ?>" />
		<input type="submit" name="idea_sub" class="button green" value="Preview" id="idea_sub" />

		<div clear></div>
		
		</form>

	</p>
</div><!-- /newIdea -->










<!--  display data for conformation -->


<div id="ideapreview" class="none">

	
</div><!-- /ideapreview -->


<!--  /display data for conformation -->









<div id="newIdeaList" class="">
	

<?php  


//echo "<strong>Submit Idea</strong><br/><br/>";






$qMarket = "SELECT
  f_lists.*,
  f_categories.fc_name As mCatName,
  f_budget.fb_range As mBudgetName,
  f_lists.fl_jobtitle As mTitle,
  f_lists.fl_id As mId
From
  f_lists Inner Join
  f_categories On f_lists.f_categories_id_fk = f_categories.fc_id
  Inner Join 
  f_budget On f_lists.f_categories_id_fk = f_budget.fb_id 
Where
  f_lists.users_id_fk = '$usr_id'";


$resultQMarket     = mysql_query($qMarket);
$numrowQMarket	   = mysql_num_rows($resultQMarket);


if ($numrowQMarket == 0) {
	
	echo "You dont have any submission yet.";

}
else {


	echo "Status of products / submissions of ideas<br/><br/>";
	while ($rowQMarket = mysql_fetch_object($resultQMarket)) {

		if ($rowQMarket->isPublished == 1) {
			$ideaLink = 'idea-details.php?id='.$rowQMarket->mId;
		}
		else {
			$ideaLink = '#';
		}

?>

	<div id="<?php echo $rowQMarket->mId; ?>" class="marketrow">

		<div id="" class="mPicRight left" style="margin-left:0 !important;">
			<div class="">
				<strong style="color:#424784;"><?php echo ucwords($rowQMarket->mTitle); ?></strong> in category <?php echo ucwords($rowQMarket->mCatName); ?> &middot; Posted at <?php echo $rowQMarket->f_date_posted; ?>
				<br/><br/>
				<?php  

				$totalComment = "SELECT
				  Count(mj_idea_comment.id_usr_id_fk) AS commentTotal
				From
				  mj_idea_comment
				Where
				  mj_idea_comment.id_post_id_fk = '$rowQMarket->mId'";
				 $resultTotalCom = mysql_query($totalComment);
				 $rowTotalCom	 = mysql_fetch_object($resultTotalCom);

				?>
				<div>
					<strong>Skills: </strong> <span><?php echo $rowQMarket->fl_skills; ?></span> <br>
					<strong>Budget: </strong> <span><?php echo $rowQMarket->mBudgetName; ?></span>
				</div>
			</div><!-- / -->
		</div><!-- /right -->

		<div class="right" style="text-align:center">
			
			
			<div class="ideaEdit" style="margin-top:20px;">
				
				<div class="editDeleted left" style="margin-right:10px;">
					<a href="edit-idea.php?cid=<?php echo $rowQMarket->mId; ?>" title="Edit">
						<img src="images/icon_grey/ic_edit.png" original-title="Edit">
					</a>
					<a href="#" title="Delete">
						<img src="images/icon_grey/ic_delete.png" original-title="Delete">
					</a>
				</div>

				<div class="right">
				<?php 

				if($rowQMarket->isPublished == 1){

					echo "<img src=\"images/icon_color/monitor.png\" original-title=\"Published\" />";

				}
				else {

					echo "<img src=\"images/icon_color/monitor-off.png\" original-title=\"UnPublished\" />";

				} ?>
				</div>

				<div class="clear"></div>
			</div><!-- /ideaEdit -->
		</div>

		<div class="clear"></div>

	</div><!-- / -->


<?php

	}

}


?>

</div><!-- /newIdeaList -->

<script type="text/javascript">	

$(document).ready(function(){





	/* tipsy */
	$('.marketrow').find('div > img').tipsy({gravity: 's'});
	$('.marketrow').find('div > a img').tipsy({gravity: 's'});

	


	$('#editIdeaSubmission').find('img').tipsy({gravity: 's'});
	$('#cancelNewIdea').find('img').tipsy({gravity: 's'});
	/*-----------------------------------------------------------------------------*/


	/*$('.editDeleted').hide();

	$('.marketrow').hover(function(){

		$(this).find('.editDeleted').show();

	}, function(){

		$(this).find('.editDeleted').hide();

	});*/


	$('#newIdea input, #newIdea select, #newIdea textarea').css('display','block');


	$('#submitNewIdea').click(function(){


		$('#newIdea').fadeIn();
		$('#newIdeaList').fadeOut();

		$(this).hide();

		//$('#editIdeaSubmission').fadeIn();
		$('#cancelNewIdea').fadeIn();

		return false;

	});


	$('#cancelNewIdea').click(function(){

		$('#newIdea').fadeOut();
		$('#newIdeaList').fadeIn();

		$(this).hide();
		$('#submitNewIdea').fadeIn();
		$('#ideapreview').hide();

	});

	$('#newIdea input, #newIdea select, #newIdea textarea').css('margin-bottom', '10px');

	$('#newIdea input, #newIdea select, #newIdea textarea').css('padding', '4px');

	$('#newIdea textarea').css('width', '500px');
	$('#newIdea textarea').css('height', '190px');

	$('#newIdea input[type="text"]').css('width', '500px');

	$('#newIdea label').css('font-weight', 'bold');




	/* submit then preview */
	$('#idea_sub').click(function(){

		var idea_title        = $('#idea_title').val();
		var idea_desc         = $('#idea_desc').val();
		var idea_skills       = $('#idea_skills').val();
		var job_categories    = $('#job_categories').val();
		var job_budget     	  = $('#job_budget').val();

		
		if (idea_title == '' ||
			idea_desc == '' ||
			idea_skills == '' ||
			job_categories == '' ||
			job_budget == '') {

			//$('#ideaError').fadeIn();
			$.jnotify("Fill up the form to submit your Jobs.", "error");
		}
		else {

			var data = $('#ideaForm').serialize();

			$('#ideapreview').fadeIn().load('ajax/ajax-submited-freelance-job.php?'+data);

			$('#newIdea').hide();

			$('#editIdeaSubmission').fadeIn();

			console.log('clicked and preview.' + data);

		}


		return false;

	});



	$('#ideapreview #label').css('display','block');
	$('#ideapreview p').css('margin-bottom','10px');

	$('#editIdeaSubmission').click(function(){

		//alert('clicked edit');

		$(this).fadeOut();

		$('#ideapreview').fadeOut();
		$('#newIdea').fadeIn();

		return false;
	});


	$('#ideapreview label').css('font-weight', 'bold');
	$('#ideapreview p').css('margin-bottom', '10px;');





});

</script>