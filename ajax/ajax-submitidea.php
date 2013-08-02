<?php 

$usr_id = mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['id'])));

include '../db/db-connect.php';



?>


<div id="headingContainer" class="">
	
	<div class="left">
		<strong class="light_bulb_color">Idea Section</strong>
	</div>

	<div class="right">
		<a href="#" title="Submit New Idea" id="submitNewIdea" class="light-bulb--plus_color">New Idea</a>
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

		<label>Title</label>
		<small>Your project title</small>
		<input type="text" name="idea_title" id="idea_title" class="title" />

		<label>Description</label>
		<small>Brief description of your project</small>
		<textarea name="idea_desc" id="idea_desc"></textarea>

		<label>Choose a Category</label>
		<small>Your project category</small>
		<select name="idea_category">
			<?php

			include '../db/db-connect.php'; 

			$q_idea_cat = "SELECT * FROM mj_idea_category";
			$rslt_idea = mysql_query($q_idea_cat);

			while ($rowIdCat = mysql_fetch_object($rslt_idea)) {
				
				echo '<option value="'.$rowIdCat->id_cat_id.'">'.ucwords($rowIdCat->id_cat_name).'</option>';
			}

			?>
		</select>

		<label>The Problem</label>
		<small>Problems of similar product</small>
		<textarea name="idea_prob" id="idea_prob"></textarea>

		<label>The Solution</label>
		<small>Solution that your project has solve from the above problems</small>
		<textarea name="idea_sol" id="idea_sol"></textarea>

		<label>Features</label>
		<small>Special features of your project from other similar product</small>
		<textarea name="idea_fea" id="idea_fea"></textarea>

		<label>Target Market / Customer / End User</label>
		<small>Your target market</small>
		<textarea name="idea_target" id="idea_target"></textarea>


		<label>Similar Product</label>
		<small>List of similar product like your project</small>
		<textarea name="idea_sp" id="idea_sp"></textarea>

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
  mj_idea_category.id_cat_name As mCatName,
  mj_idea_post.id_title As mTitle,
  mj_idea_post.id_post_published As isPublished,
  mj_idea_post.id_rat_up As reviewTotal,
  mj_idea_post.id_pictures AS mPic,
  mj_idea_post.id_post_id As mId
From
  mj_idea_post Inner Join
  mj_idea_category On mj_idea_post.id_cat_id_fk = mj_idea_category.id_cat_id
Where
  mj_idea_post.id_usr_id_fk = '$usr_id'";


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
		<div class="mPicLeft left">
			<a href="<?php echo $ideaLink; ?>">
			<div class="profile-pic48 border" style="background-image: url('<?php echo $rowQMarket->mPic; ?>'); background-size: auto 100% !important;">
				
			</div><!-- /profile-pic48 -->
			</a>
		</div><!-- /left -->

		<div id="" class="mPicRight left">
			<div class="">
				<a href="<?php echo $ideaLink; ?>"><strong style="color:#424784;"><?php echo ucwords($rowQMarket->mTitle); ?></strong></a> in category <?php echo ucwords($rowQMarket->mCatName); ?>
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
				<div><span class="balloon-white_color"><?php echo ucwords($rowTotalCom->commentTotal); ?></span> <span>Comment(s)</span> <span class="thumb-up_color" style="margin-left:10px;"><?php echo $rowQMarket->reviewTotal; ?></span> Like(s)</div>
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
		var idea_prob         = $('#idea_prob').val();
		var idea_sol          = $('#idea_sol').val();
		var idea_fea     	  = $('#idea_fea').val();
		var idea_target 	  = $('#idea_target').val();
		var idea_sp    		  = $('#idea_sp').val();

		
		if (idea_title == '' ||
			idea_desc == '' ||
			idea_prob == '' ||
			idea_sol == '' ||
			idea_fea == '' ||
			idea_target == '' ||
			idea_sp == '') {

			//$('#ideaError').fadeIn();
			$.jnotify("Fill up the form to submit your idea.", "error");
		}
		else {

			var data = $('#ideaForm').serialize();

			$('#ideapreview').fadeIn().load('ajax/ajax-submited-preview.php?'+data);

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