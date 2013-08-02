<?php  

$usr_id = mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['id'])));
include '../db/db-connect.php';

?>

<div id="headingContainer" class="">
	
	<div class="left">
		<strong class="zone_money_color">Showcase</strong>
	</div>

	<div class="right">
		<a href="#" title="Submit New Project" id="submitNewIdea" class="money--plus_color">Submit Showcase</a>
		<a href="#" id="editIdeaSubmission" title="Edit" class="none">
			<img src="images/icon_grey/ic_edit.png" original-title="Edit">
		</a>
		<a href="#" title="Cancel" id="cancelNewIdea" class="none">
			<img src="images/icon_grey/ic_cancel.png" original-title="Cancel">
		</a>
	</div>

	<div class="clear"></div>

</div><!-- /headingContainer -->

<div id="newProject" class="none">
	<h3>New Showcase</h3><br><br>
	<div>

		<form method="post" id="formProject" action="project-submited.php" enctype="multipart/form-data">

		<div id="accordion">
			<h3>Showcase Details</h3>
			<div>
				<p>Showcase Details must be fill in to show your talent.</p>
				<p><br>
				<label>Project / Business Idea</label><br/>
				<input type="text" class="tfull" name="projectIdea" id="projectIdea" /><br/>

				<label>Short Brief</label><br/>
				<textarea name="shortBrief" id="shortBrief" class="tfull"></textarea><br/>

				<label>Category</label>
				<small>Which category is suitable with your showcase</small>
				<select name="pro_cat" id="pro_cat">
					<?php


					$q_idea_cat = "SELECT * FROM mj_fund_category";
					$rslt_idea = mysql_query($q_idea_cat);

					while ($rowIdCat = mysql_fetch_object($rslt_idea)) {
						
						echo '<option value="'.$rowIdCat->fund_cat_id.'">'.ucwords($rowIdCat->fund_cat_name).'</option>';
					}

					?>
				</select><br/><br/>

				<label>Showcase about? tell us what is this.</label>
				<textarea name="businessModel" id="businessModel" class="full"></textarea>
				</p>
			</div><br><br>


			<!-- hide from display -->
			<div style="display:none">
			<h3>Section 02 :: Customer &amp; Market</h3>
			<div>
				<p>(Please detail out the value proposition to the customer, target industry, marketing strategy, the benefit relative to the price, estimated size of customer market, current customer base (if any) and/or examples of ready customers for the idea)</p>
				<p>
				<textarea name="customerMarket" id="customerMarket" class="full">NULL</textarea>
				</p>
			</div><br><br>

			<h3>Section 03 :: Market Access &amp; Timing</h3>
			<div>
				<p>(Please detail out the estimated market acceptance and access, current customer practice, potential or existing competitors and analysis, current or potential substitutes to the product/services, competing or emerging technologies, and why you think that this is the correct time to launch the idea.)</p>
				<p>
				<textarea name="accessTiming" id="accessTiming" class="full">NULL</textarea>
				</p>

			</div><br><br>

			<h3>Section 04 :: Economic trends</h3>
			<div>
				<p>(Please detail out the relevant economic trends that would affect the commercial viability of the idea locally, regionally and internationally, i.e consumer market trends, economic growth, disposable income of customers, spending patterns of the customer base, etc.)</p>
				<p>
				<textarea name="economicTrends" id="economicTrends" class="full">NULL</textarea>
				</p>
			</div><br><br>

			<h3>Section 05 :: Technology Development &amp; Innovation</h3>
			<div>
				<p>(Please detail out and highlight what technology you will be creating / adapting / innovating / inventing with the funding, and list out all the technical modules/sections/parts for your product / service that will be developed/delivered as well as the relevant technology trends that would affect the viability of the idea, i.e new competing technology, new research findings, technology investment focus, etc.)</p>
				<p>
				<textarea name="techDevinnovation" id="techDevinnovation" class="full">NULL</textarea>
				</p>
			</div><br><br>

			<h3>Section 06 :: Intellectual Property &amp; Regulation</h3>
			<div>
				<p>(Please detail out, as far as you know, any rules, regulations, licensing, incentives, monopolies, governing bodies and laws that impact the idea. Specify if there's any Intellectual Property advantage or barriers, patents, copyright, trademarks, standards, certifications that can be applied to your idea.)</p>
				<p>
				<textarea name="ipRegulation" class="full" id="ipRegulation">NULL</textarea>
				</p>
			</div><br><br>

			<h3>Section 07 :: Stage of the Industry &amp; Future Plans</h3>
			<div>
				<p>(Please detail out the stage of the Industry, i.e. whether it is still growing or shrinking, estimated acceptance of industry and market to the idea within the next 3-5 years (with reasons to support your belief), and suitability of timing for exploitation of opportunity.)
				</p>
				<p>
				<textarea name="industryFuture" id="industryFuture" class="full">NULL</textarea>
				</p>
			</div><br><br>

			<h3>Section 08 :: Deliverables for Idea Development</h3>
			<div>
				<p>(Please specify what the deliverables are for the development of the idea (i.e. Proof of Concept, Business Plan) in relation to the size of the funding requested and within a duration of 3 to 6 months, and then set out the milestones (not more than 3) involved, together with KPIs)
				</p>
				<p>
				<textarea name="ideaDevelopment" id="ideaDevelopment" class="full">NULL</textarea>
				</p>
			</div><br><br>

			<h3>Section 09 :: Size of Funding and Milestones</h3>
			<div>
				<p>(Please detail out size of funding required and a simple cash flow breakdown for the utilization of funding.)</p>
				<p>
				<label>Project Budget</label><br/>RM
				<input type="text" class="title" name="project_budget" id="project_budget" value="9999" /><br/>
				<label>Cash Flow Breakdown</label><br/>
				<textarea name="FundingMilestones" class="full" id="FundingMilestones">NULL</textarea>
				</p>
			</div>

			</div>


			<p>
				<input type="hidden" name="user_id" value="<?php echo $usr_id; ?>" />
				</div>
			</div><br><br>

			<p>
			<!-- <h2>Have everything clear?</h2> -->
			<input type="submit" name="submitProposal" id="submitProposal" class="button green" value="Review your details" />
		</p>

		</form>
	</div>
</div><!-- /newProject -->







<!--  display data for conformation -->


<div id="ideapreview" class="none">

	
</div><!-- /ideapreview -->


<!--  /display data for conformation -->








<div id="newIdeaList" class="">
<?php  


//echo "<strong>Submit Project</strong><br/><br/>";


/*$usr_id = $_GET['id'];

include '../db/db-connect.php';*/


function convertPrice($price)
{
	if ($price < 1000) {
									 	
	 	return "RM".$price;
	 } 

	if ($price >= 1000 && $price <= 999999) {
		
		$kprice = $price / 1000;
		return "RM".$kprice."K";

	}

	if ($price >= 1000000 && $price <= 9999999) {
		
		$kprice = $price / 1000000;
		return "RM".$kprice."M";

	}
}




$qMarket = "SELECT
  mj_idea_category.id_cat_name As mCatName,
  mj_fund_post.fund_post_title As mTitle,
  mj_fund_post.fund_post_ratup As reviewTotal,
  mj_fund_post.fund_post_ended As projEnd,
  mj_fund_post.fund_post_project_budget As mBudget,
  mj_fund_post.fund_post_image As mPic,
  mj_fund_post.fund_post_id As mId,
  mj_fund_post.fund_post_published
From
  mj_fund_post Inner Join
  mj_idea_category On mj_fund_post.fund_cat_id_fk = mj_idea_category.id_cat_id
Where
  mj_fund_post.fund_usr_id_fk = '$usr_id' And
  mj_fund_post.fund_post_success = 0 And
  mj_fund_post.fund_post_failed = 0
Order By mj_fund_post.fund_post_id DESC";


$resultQMarket = mysql_query($qMarket);
$numrowQMarket	   = mysql_num_rows($resultQMarket);


if ($numrowQMarket == 0) {
	
	echo "You dont have any submission yet.";

}
else {


	echo "<strong style=\"color:orange\">Current Showcase submission</strong><br/><br/>";
	while ($rowQMarket = mysql_fetch_object($resultQMarket)) {
		if ($rowQMarket->fund_post_published == 1) {
			$link = urlencode($rowQMarket->mTitle).'-project-'.$rowQMarket->mId;
		} else {
			$link = '#';
		}

?>

	<div id="<?php echo $rowQMarket->mId; ?>" class="marketrow">
		<div class="mPicLeft left">
			<a href="<?php echo $link; ?>">
			<div class="profile-pic48 border" style="background-image: url('<?php echo $rowQMarket->mPic; ?>'); background-size:auto 100% !important;">
				
			</div><!-- /profile-pic48 -->
			</a>
		</div><!-- /left -->

		<div id="" class="mPicRight left">
			<div class="">
				<h4>
					<?php  

					$totalPlege = "SELECT
					  SUM(mj_fund_pledged.fund_money) As TotalPledging
					From
					  mj_fund_pledged
					Where
					  mj_fund_pledged.fund_post_id_fk = '$rowQMarket->mId'";
					$resultPledge = mysql_query($totalPlege);
					$rowPledge = mysql_fetch_object($resultPledge);

					if ($rowPledge->TotalPledging == NULL) {
						$pledgeValue = 0;
					} else {
						$pledgeValue = $rowPledge->TotalPledging;
					}


					/* baker */
					$totalBaker = "SELECT
					  Count(mj_fund_pledged.fund_usr_id_fk) As totalCount
					From
					  mj_fund_pledged
					Where
					  mj_fund_pledged.fund_post_id_fk = '$rowQMarket->mId'";
					$resultBaker = mysql_query($totalBaker);
					$rowBaker = mysql_fetch_object($resultBaker);

					?>
					<?php echo $pledgeValue; ?> already vote of <?php echo $rowQMarket->mBudget; ?>
				</h4>
				<a href="<?php echo $link; ?>"><strong><?php echo ucwords($rowQMarket->mTitle); ?></strong></a> in category <?php echo ucwords($rowQMarket->mCatName); ?><br><br>
				<div><span class="money--arrow_color"><?php echo $rowBaker->totalCount; ?></span> Voters <span style="margin-left:10px" class="thumb-up_color"><?php echo $rowQMarket->reviewTotal; ?></span> Like(s)</div>
			</div><!-- / -->
		</div><!-- /right -->

		<div class="ideaEdit right" style="margin-top:20px;">
			<a href="edit-project.php?pid=<?php echo $rowQMarket->mId; ?>" title="Edit">
				<img src="images/icon_grey/ic_edit.png" original-title="Edit">
			</a>
			<a href="#" title="Delete">
				<img src="images/icon_grey/ic_delete.png" original-title="Delete">
			</a>
			<img src="images/icon_color/calendar-day.png" original-title="End at <?php echo $rowQMarket->projEnd; ?>">
			<?php  

			if ($rowQMarket->fund_post_published == 1) {
				echo '<img src="images/icon_color/monitor.png" original-title="Published">';
			}
			else {
				echo '<img src="images/icon_color/monitor-off.png" original-title="UnPublished">';
			}

			?>
		</div>

		<div class="clear"></div>

	</div><!-- / -->


<?php

	} // while

?>

<div style="border:1px solid red; display:none">

<br><br>
<strong style="color:green">Successful Project</strong><br><br>

<?php  

$qSuccessMarket = "SELECT
  mj_idea_category.id_cat_name As mCatName,
  mj_fund_post.fund_post_title As mTitle,
  mj_fund_post.fund_post_ratup As reviewTotal,
  mj_fund_post.fund_post_ended As projEnd,
  mj_fund_post.fund_post_project_budget As mBudget,
  mj_fund_post.fund_post_image As mPic,
  mj_fund_post.fund_post_id As mId
From
  mj_fund_post Inner Join
  mj_idea_category On mj_fund_post.fund_cat_id_fk = mj_idea_category.id_cat_id
Where
  mj_fund_post.fund_usr_id_fk = '$usr_id' And
  mj_fund_post.fund_post_success = 1 And
  mj_fund_post.fund_post_failed = 0";


$resultSuccessQMarket = mysql_query($qSuccessMarket);
$numrowSuccessQMarket = mysql_num_rows($resultSuccessQMarket);

	if ($numrowSuccessQMarket == 0) {
		# code...
		echo 'You dont have any successful project';
	}
	else {

		// else display
		while ($rowSuccessQMarket = mysql_fetch_object($resultSuccessQMarket)) {
	
?>


	<div id="<?php echo $rowSuccessQMarket->mId; ?>" class="marketrow">
		<div class="mPicLeft left">
			<div class="profile-pic48 border" style="background-image: url('<?php echo $rowSuccessQMarket->mPic; ?>'); background-size:auto 100% !important;">
				
			</div><!-- /profile-pic48 -->
		</div><!-- /left -->

		<div id="" class="mPicRight left">
			<div class="">
				<h4>
					<?php  

					$totalPlege = "SELECT
					  SUM(mj_fund_pledged.fund_money) As TotalPledging
					From
					  mj_fund_pledged
					Where
					  mj_fund_pledged.fund_post_id_fk = '$rowSuccessQMarket->mId'";
					$resultPledge = mysql_query($totalPlege);
					$rowPledge = mysql_fetch_object($resultPledge);

					if ($rowPledge->TotalPledging == NULL) {
						$pledgeValue = 0;
					} else {
						$pledgeValue = $rowPledge->TotalPledging;
					}


					/* baker */
					$totalBaker = "SELECT
					  Count(mj_fund_pledged.fund_usr_id_fk) As totalCount
					From
					  mj_fund_pledged
					Where
					  mj_fund_pledged.fund_post_id_fk = '$rowSuccessQMarket->mId'";
					$resultBaker = mysql_query($totalBaker);
					$rowBaker = mysql_fetch_object($resultBaker);

					?>
					<?php echo $pledgeValue; ?> already vote of <?php echo $rowSuccessQMarket->mBudget; ?>
				</h4>
				<strong><?php echo ucwords($rowSuccessQMarket->mTitle); ?></strong> in category <?php echo ucwords($rowSuccessQMarket->mCatName); ?><br><br>
				<div><span class="money--arrow_color"><?php echo $rowBaker->totalCount; ?></span> Voters <span style="margin-left:10px" class="thumb-up_color"><?php echo $rowSuccessQMarket->reviewTotal; ?></span> Like(s)</div>
			</div><!-- / -->
		</div><!-- /right -->

		<div class="ideaEdit right" style="margin-top:20px;">
			<a href="<?php echo urlencode($rowSuccessQMarket->mTitle); ?>-success-project-<?php echo $rowSuccessQMarket->mId; ?>.html" title="Edit">
				<img src="images/icon_grey/ic_ok.png" original-title="View Details">
			</a>
			<img src="images/icon_color/calendar-day.png" original-title="End at <?php echo $rowSuccessQMarket->projEnd; ?>">
		</div>

		<div class="clear"></div>

	</div><!-- / -->


<?php
	
		} // while

	} // else


// end success
?>

<br><br>
<strong style="color:red">Failed Project</strong><br><br>

<?php  

$qFailedMarket = "SELECT
  mj_idea_category.id_cat_name As mCatName,
  mj_fund_post.fund_post_title As mTitle,
  mj_fund_post.fund_post_ratup As reviewTotal,
  mj_fund_post.fund_post_ended As projEnd,
  mj_fund_post.fund_post_project_budget As mBudget,
  mj_fund_post.fund_post_image As mPic,
  mj_fund_post.fund_post_id As mId
From
  mj_fund_post Inner Join
  mj_idea_category On mj_fund_post.fund_cat_id_fk = mj_idea_category.id_cat_id
Where
  mj_fund_post.fund_usr_id_fk = '$usr_id' And
  mj_fund_post.fund_post_success = 0 And
  mj_fund_post.fund_post_failed = 1";


$resultFailedQMarket = mysql_query($qFailedMarket);
$numrowFailedQMarket = mysql_num_rows($resultFailedQMarket);

	if ($numrowFailedQMarket == 0) {
		# code...
		echo 'You dont have any Failed project';
	}
	else {

		// if nothing display
		while($rowFailedQMarket = mysql_fetch_object($resultFailedQMarket)){
?>

	<div id="<?php echo $rowFailedQMarket->mId; ?>" class="marketrow">
		<div class="mPicLeft left">
			<div class="profile-pic48 border" style="background-image: url('<?php echo $rowFailedQMarket->mPic; ?>'); background-size:auto 100% !important;">
				
			</div><!-- /profile-pic48 -->		
		</div><!-- /left -->

		<div id="" class="mPicRight left">
			<div class="">
				<h4>
					<?php  

					$totalPlege = "SELECT
					  SUM(mj_fund_pledged.fund_money) As TotalPledging
					From
					  mj_fund_pledged
					Where
					  mj_fund_pledged.fund_post_id_fk = '$rowFailedQMarket->mId'";
					$resultPledge = mysql_query($totalPlege);
					$rowPledge = mysql_fetch_object($resultPledge);

					if ($rowPledge->TotalPledging == NULL) {
						$pledgeValue = 0;
					} else {
						$pledgeValue = $rowPledge->TotalPledging;
					}


					/* baker */
					$totalBaker = "SELECT
					  Count(mj_fund_pledged.fund_usr_id_fk) As totalCount
					From
					  mj_fund_pledged
					Where
					  mj_fund_pledged.fund_post_id_fk = '$rowFailedQMarket->mId'";
					$resultBaker = mysql_query($totalBaker);
					$rowBaker = mysql_fetch_object($resultBaker);

					?>
					<?php echo convertPrice($pledgeValue); ?> already vote of <?php echo convertPrice($rowFailedQMarket->mBudget); ?>
				</h4>
				<strong><?php echo ucwords($rowFailedQMarket->mTitle); ?></strong> in category <?php echo ucwords($rowFailedQMarket->mCatName); ?><br><br>
				<div><span class="money--arrow_color"><?php echo $rowBaker->totalCount; ?></span> Voters <span style="margin-left:10px" class="thumb-up_color"><?php echo $rowFailedQMarket->reviewTotal; ?></span> Like(s)</div>
			</div><!-- / -->
		</div><!-- /right -->

		<div class="ideaEdit right" style="margin-top:20px;">
			<a href="<?php echo urlencode($rowFailedQMarket->mTitle); ?>-failed-project-<?php echo $rowFailedQMarket->mId; ?>.html" title="Edit">
				<img src="images/icon_grey/ic_documents.png" original-title="View Details">
			</a>
			<img src="images/icon_color/calendar-day.png" original-title="End at <?php echo $rowFailedQMarket->projEnd; ?>">
		</div>

		<div class="clear"></div>

	</div><!-- / -->



<?php 

		} // end while

	} // else




	// end failed

} // else main


?>

</div>

</div><!-- project list -->



<script type="text/javascript">	

$(document).ready(function(){


	/* tipsy */
	$('#editIdeaSubmission').find('img').tipsy({gravity: 's'});
	$('#cancelNewIdea').find('img').tipsy({gravity: 's'});
	/*--------------------------------------------------------------------------*/


	/* tipsy misc */
	$('.marketrow').find('div > img').tipsy({gravity: 's'});
	$('.marketrow').find('div > a img').tipsy({gravity: 's'});
	/*--------------------------------------------------------------------------*/


	$('#accordion input, #accordion select, #accordion textarea').css('display','block');
	$('#accordion input, #accordion select, #accordion textarea').css('padding','4px');
	$('#accordion h3').css('font-weight','bold');
	$('#accordion h3').css('color','#2D2E27');


	$('#submitNewIdea').click(function(){


		$('#newProject').fadeIn();
		$('#newIdeaList').fadeOut();

		$(this).hide();
		$('#cancelNewIdea').fadeIn();

		return false;

	});


	$('#cancelNewIdea').click(function(){

		$('#newProject').fadeOut();
		$('#newIdeaList').fadeIn();

		$(this).hide();
		$('#submitNewIdea').fadeIn();

	});

	$('#editIdeaSubmission').click(function(){

		//alert('clicked edit');

		$(this).fadeOut();

		$('#ideapreview').fadeOut();
		$('#newProject').fadeIn();

		return false;
	});

	$('#accordion input, #newIdea select, #newIdea textarea').css('margin-bottom', '10px');

	$('#accordion input, #newIdea select, #newIdea textarea').css('padding', '4px');

	$('#accordion textarea').css('width', '500px');
	$('#accordion textarea').css('height', '190px');

	$('#accordion input[type="text"]').css('width', '500px');

	$('#accordion label').css('font-weight', 'bold');



	/* validate all details */
	$('#submitProposal').click(function(){
		
		var section01 = $('#projectIdea').val();
		var section02 = $('#shortBrief').val();
		var section03 = $('#pro_cat').val();
		var section04 = $('#businessModel').val();
		var section05 = $('#customerMarket').val();
		var section06 = $('#accessTiming').val();
		var section07 = $('#economicTrends').val();
		var section08 = $('#techDevinnovation').val();
		var section09 = $('#ipRegulation').val();
		var section10 = $('#industryFuture').val();
		var section11 = $('#ideaDevelopment').val();
		var section12 = $('#project_budget').val();
		var section13 = $('#FundingMilestones').val();

			

		if (section01 == '' || section02 == '' || section03 == '' || section04 == '' || section05 == '' || section06 == '' || section07 == '' || section08 == '' || section09 == '' || section10 == '' || section11 == '' || section12 == '' || section13 == '') {

			$.jnotify("Fill up the form.", "error");

		} else {

			var dataString = $('#formProject').serialize();

			$('#ideapreview').fadeIn().load('ajax/ajax-submited-project-preview.php?'+dataString);

			$('#newProject').hide();

			$('#editIdeaSubmission').fadeIn();

			console.log(dataString);
		}


		return false;
	});







	/* form accordian */
	/*$( "#accordion" ).accordion({

			collapsible: false

	});*/

});

</script>