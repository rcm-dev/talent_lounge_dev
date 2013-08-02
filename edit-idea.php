<?php  


include 'header.php';
include 'db/db-connect.php';

# sqlinjection
function sqlInjectString($string) 
{

	$seoname = preg_replace('/\%/',' percentage',$string); 
	$seoname = preg_replace('/\@/',' at ',$seoname); 
	$seoname = preg_replace('/\&/',' and ',$seoname);
	$seoname = preg_replace('/\s[\s]+/','-',$seoname);    // Strip off multiple spaces 
	$seoname = preg_replace('/[\s\W]+/','-',$seoname);    // Strip off spaces and non-alpha-numeric 
	$seoname = preg_replace('/^[\-]+/','',$seoname); // Strip off the starting hyphens 
	$seoname = preg_replace('/[\-]+$/','',$seoname); // // Strip off the ending hyphens  
	//$seoname = trim(str_replace(range(0,9),'',$seoname));
	$seoname = strtolower($seoname);
	mysql_real_escape_string(trim(htmlentities(htmlspecialchars($seoname))));

	return $seoname;
}


$get_id_view = (int) sqlInjectString($_GET['cid']);

$queryIdeaEdit = "SELECT
  mj_idea_post.id_title As ideaTitle,
  mj_idea_post.id_cur_problem As ideaProblem,
  mj_idea_post.id_cur_solution As ideaSolution,
  mj_idea_post.id_desc As ideaDesc,
  mj_idea_post.id_trget_cust As targetCust,
  mj_idea_post.id_features As ideaFeatures,
  mj_idea_post.id_smlar_product As ideaSmlarProduct,
  mj_idea_post.id_post_published As ideaPublished,
  mj_idea_post.id_post_id As ideaID,
  mj_idea_post.id_pictures
From
  mj_idea_post Inner Join
  mj_idea_category On mj_idea_post.id_cat_id_fk = mj_idea_category.id_cat_id
Where
  mj_idea_post.id_post_id = '$get_id_view'";

$result  = mysql_query($queryIdeaEdit);
$rowEdit = mysql_fetch_object($result);


?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" >

		<div class="heading">
			<h1>Edit Idea Submission</h1>
		</div>

	<div class="success none">
		<p>idea details edited
		</p>
	</div>



		<div id="adv1" class="usual cnscontainer left" style="margin:0px !important;"> 
		  <ul> 
		    <li><a href="#t1" class="selected">Description</a></li> 
		    <li><a href="#t2" id="<?php echo $_GET['id']; ?>" class="ePicture">Pictures</a></li> 
		    <li>
		    	<a href="#t3" class="eVideo">Videos</a></li>
		  </ul> 

		  <div id="t1" style="display: none; ">
		  	
		  	<form action="#" method="post" id="idea_preview_form" accept-charset="utf-8">
				

				<label>Title</label>
				<small>Description of the title</small>
				<input type="text" name="idea_title" id="idea_title" value="<?php echo $rowEdit->ideaTitle; ?>" class="title" />

				<label>Description</label>
				<small>Description of the title</small>
				<textarea name="idea_desc" id="idea_desc"><?php echo $rowEdit->ideaDesc; ?></textarea>

				<label>Choose a Category</label>
				<small>Description of the title</small>
				<select name="idea_category">
					<?php

					//include '../db/db-connect.php'; 

					$q_idea_cat = "SELECT * FROM mj_idea_category";
					$rslt_idea = mysql_query($q_idea_cat);

					while ($rowIdCat = mysql_fetch_object($rslt_idea)) {
						
						echo '<option value="'.$rowIdCat->id_cat_id.'">'.ucwords($rowIdCat->id_cat_name).'</option>';
					}

					?>
				</select>

				<label>The Problem</label>
				<small>Description of the title</small>
				<textarea name="idea_prob" id="idea_prob"><?php echo $rowEdit->ideaProblem; ?></textarea>

				<label>The Solution</label>
				<small>Description of the title</small>
				<textarea name="idea_sol" id="idea_sol"><?php echo $rowEdit->ideaSolution; ?></textarea>

				<label>Features</label>
				<small>Description of the title</small>
				<textarea name="idea_fea" id="idea_fea"><?php echo $rowEdit->ideaFeatures; ?></textarea>

				<label>Target Market / Customer / End User</label>
				<small>Description of the title</small>
				<textarea name="idea_target" id="idea_target"><?php echo $rowEdit->targetCust; ?></textarea>


				<label>Similar Product</label>
				<small>Description of the title</small>
				<textarea name="idea_sp" id="idea_sp"><?php echo $rowEdit->ideaSmlarProduct; ?></textarea><br><br>

				<label>Current Cover</label>
				<img src="<?php echo $rowEdit->id_pictures; ?>" width="120px" /><br><br>

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

				<input type="hidden" name="user_id" id="user_id" value="<?php echo $usr_id; ?>" />
				<input type="hidden" name="curr_idea_edit_id" id="curr_idea_edit_id" value="<?php echo $get_id_view; ?>" />
				<input type="submit" name="idea_update" class="button green" value="Update Idea" id="idea_update" />

				<div clear></div>

			</form>	

		  </div> 
		  <div id="t2" style="display: block; ">
		  	<div id="loadEditedPircture">
		  		
		  	</div><!-- /loadEditePircture -->
		  </div> 
		  <div id="t3" style="display: block; ">
		  	<div id="loadEditedVideo" class="">
		  		
		  	</div><!-- /loadEditedVideo -->
		  </div> 
		</div>

		<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
			<strong>Note</strong><br><br>
			<?php  

			$sqlMarketNotification = "SELECT * FROM mj_idea_post WHERE id_post_id = '$get_id_view'";
			$sqlMarketNotiResult = mysql_query($sqlMarketNotification);
			$rowMarketObject = mysql_fetch_object($sqlMarketNotiResult);

			if ($rowMarketObject->id_post_published == 0) {
				echo '<p class="info">Please noted, your Idea is currently pending. Our editor will review your ideaa,</p>';
			}
			else {
				echo '<p class="success">Your Idea is Live! you can view it <a href="idea-details.php?id='.$get_id_view.'" style="font-weight:bold; color:green">Here</a></p>';	
			}

			?>
		</div>

		<div class="clear"></div>


	</div><!-- /contentContainer -->

</div><!-- /content -->

<!-- get current email -->
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />
<!-- /get current email -->


<script type="text/javascript">
$(document).ready(function(){

	/* get current email */
	var current_email = $('input#current_email').val();

	if (current_email == '') {
		$('body').css('display', 'none');
		document.location.href = "index.php";
		console.log('Not Login');
	}
	else {
		console.log("Current Email => "+current_email);
	}
	/* /current email */


	var curr_idea_edit_id = $('#curr_idea_edit_id').val();

	$('label').css('font-weight','bold');
	$('label').css('display','block');
	$('input, textarea, select').css('display','block');


	/* idTab */
  	//var settings = { start:1, change:false }; 
  	$("#adv1 ul").idTabs();


  	/* load picture */
  	$('.ePicture').click(function(){

  		$('#loadEditedPircture').html('loading').load('ajax/ajax-edited-picture.php?cid='+curr_idea_edit_id);
  		//console.log('loaded');
  		return false;
  		// loadEditedVideo

  	});


  	/* load video */
  	$('.eVideo').click(function(){

  		$('#loadEditedVideo').html('loading').load('ajax/ajax-edited-video.php?cid='+curr_idea_edit_id);
  		//console.log('loaded');
  		return false;


  	});


	$('#idea_update').click(function(){

		var dataString = $('#idea_preview_form').serialize();

		$.ajax({

			type: 'POST',
			url	: 'ajax/ajax-idea-edited.php',
			data: dataString,
			

			success:function(html){

				if (html == 1) {
					//$('.success').fadeIn();
					console.log('Edited');
					$.jnotify("This is a notification with a 5 second delay.", 5000);
				}
				else {
					console.log('error');
					$.jnotify("This is an \"error\" notification.", "error");
				}

			}

		});

		//console.log(dataString);
		return false;

	});

});

</script>
<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>