<?php  

include '../db/db-connect.php';

// ==================================================================
//
// get details
//
// ------------------------------------------------------------------


$projectIdea	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['projectIdea'])));
$shortBrief	        =	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['shortBrief'])));
$pro_cat	        =	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['pro_cat'])));
$businessModel	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['businessModel'])));
$customerMarket	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['customerMarket'])));
$accessTiming	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['accessTiming'])));
$economicTrends	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['economicTrends'])));
$techDevinnovation	=	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['techDevinnovation'])));
$ipRegulation	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['ipRegulation'])));
$industryFuture	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['industryFuture'])));
$ideaDevelopment	=	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['ideaDevelopment'])));
$project_budget	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['project_budget'])));
$FundingMilestones	=	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['FundingMilestones'])));
$user_id	        =	mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['user_id'])));


$qCat    = "SELECT
			  mj_fund_category.fund_cat_name As CatName
			From
			  mj_fund_category
			Where
			  mj_fund_category.fund_cat_id = '$pro_cat'";

$rqCat   = mysql_query($qCat);
$rowqCat = mysql_fetch_object($rqCat);

?>


<div id="proPreviewContainer">

<h3>Preview your submission</h3><br><br>
<h3>Section 01</h3>
<strong>Submission Idea</strong>
<p><?php echo $projectIdea; ?></p><br>

<strong>Submission Brief</strong>
<p><?php echo $shortBrief; ?></p><br>

<strong>Category</strong>
<?php echo $rowqCat->CatName; ?>

<strong>Submission Details</strong>
<p><?php echo $businessModel; ?></p><br><br>

<div style="display:none">
<h3>Section 02</h3>
<strong>Customer &amp; Market</strong>
<p><?php echo $customerMarket; ?></p><br><br>

<h3>Section 03</h3>
<strong>Market Access &amp; Timing</strong>
<p><?php echo $accessTiming; ?></p><br><br>

<h3>Section 04</h3>
<strong>Economic trends</strong>
<p><?php echo $economicTrends; ?></p><br><br>

<h3>Section 05</h3>
<strong>Technology Development &amp; Innovation</strong>
<p><?php echo $techDevinnovation; ?></p><br><br>

<h3>Section 06</h3>
<strong>Intellectual Property &amp; Regulation</strong>
<p><?php echo $ipRegulation; ?></p><br><br>

<h3>Section 07</h3>
<strong>Stage of the Industry &amp; Future Plans</strong>
<p><?php echo $industryFuture; ?></p><br><br>

<h3>Section 08</h3>
<strong>Deliverables for Idea Development</strong>
<p><?php echo $ideaDevelopment; ?></p><br><br>

<h3>Section 09</h3>
<strong>Project Budget</strong>
<p>RM<?php echo $project_budget; ?></p><br><br>

<strong>Cash Flow Breakdown</strong>
<p><?php echo $FundingMilestones; ?></p><br><br>
</div>



<!-- /hidden value -->
<form action="#" method="post" id="projectPreviewData" accept-charset="utf-8">
	
	<input type="hidden" name="projectIdea" value="<?php echo $projectIdea; ?>" />
	
	<input type="hidden" name="shortBrief" value="<?php echo $shortBrief; ?>" />

	<input type="hidden" name="pro_cat" value="<?php echo $pro_cat; ?>" />

	<input type="hidden" name="businessModel" value="<?php echo $businessModel; ?>" />

	<input type="hidden" name="customerMarket" value="<?php echo $customerMarket; ?>" />

	<input type="hidden" name="accessTiming" value="<?php echo $accessTiming; ?>" />

	<input type="hidden" name="economicTrends" value="<?php echo $economicTrends; ?>" />

	<input type="hidden" name="techDevinnovation" value="<?php echo $techDevinnovation; ?>" />

	<input type="hidden" name="ipRegulation" value="<?php echo $ipRegulation; ?>" />

	<input type="hidden" name="industryFuture" value="<?php echo $industryFuture; ?>" />

	<input type="hidden" name="ideaDevelopment" value="<?php echo $ideaDevelopment; ?>" />

	<input type="hidden" name="project_budget" value="<?php echo $project_budget; ?>" />

	<input type="hidden" name="FundingMilestones" value="<?php echo $FundingMilestones; ?>" />

	<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />

	<input type="submit" name="submitProjectPreview" id="submitProjectPreview" class="button green" value="Submit Submission Now">
</form>

</div><!-- /proPreviewContainer -->


<!-- upload video and picture -->
<div id="projectMediaUpload">
	
</div><!-- /ideaMediaUpload -->





<script type="text/javascript">
	$(document).ready(function(){

		$('h3').css('margin-top','10px;');
		$('h3').css('margin-bottom','5px;');
		$('p').css('margin-bottom','10px;');
		$('p').css('display','block');


		/* submit preview */
		$('#submitProjectPreview').click(function(){

			var projectPreviewData = $('form#projectPreviewData').serialize();

			$.ajax({

				url: "ajax/ajax-project-submited.php",
				type: "POST",
				data: projectPreviewData,

				success:function(html){


					$.jnotify("Project has been submited You can upload images add your listing.", 5000);
					alert('Your Project will review it by our editor.');

					window.location.href = 'edit-project.php?pid='+html;

					$('#proPreviewContainer').fadeOut();
					$('#projectMediaUpload').load('ajax/ajax-project-media-upload.php?projID='+html);

					$('#editIdeaSubmission').hide();
					$('#cancelNewIdea').hide();

				}

			});

			//console.log(projectPreviewData);
			return false;

		});

	});
</script>