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

$get_id_view = (int) sqlInjectString($_GET['pid']);

$queryIdeaEdit = "SELECT
  mj_fund_category.fund_cat_name,
  mj_users.usr_name As proBy,
  mj_fund_post.fund_post_ended As fund_post_ended1,
  mj_fund_post.fund_post_project_budget As proBudget,
  mj_fund_post.fund_post_title As proTitle,
  mj_fund_post.fund_post_short_brief As BriefIdea,
  mj_fund_post.fund_post_business_model As bModel,
  mj_fund_post.fund_post_customer_market As cMarket,
  mj_fund_post.fund_post_accesstiming As aTiming,
  mj_fund_post.fund_post_economic_trends As eTrend,
  mj_fund_post.fund_post_tech_dev_inno As tInno,
  mj_fund_post.fund_post_ip_regulation As ipRegular,
  mj_fund_post.fund_post_industry_future As fPlan,
  mj_fund_post.fund_post_idea_development As IdeaDev,
  mj_fund_post.fund_post_funding_miles As Milles,
  mj_fund_post.fund_post_image As proImg,
  mj_fund_post.fund_post_video As proVid,
  mj_fund_post.fund_post_id,
  mj_fund_post.fund_post_published As proIsPublished
From
  mj_fund_post Inner Join
  mj_users On mj_fund_post.fund_usr_id_fk = mj_users.usr_id Inner Join
  mj_fund_category On mj_fund_post.fund_cat_id_fk = mj_fund_category.fund_cat_id
Where
  mj_fund_post.fund_post_id = '$get_id_view'";

$result  = mysql_query($queryIdeaEdit);
$rowEdit = mysql_fetch_object($result);


?>


<div id="content" class="">
	
	<?php include 'quickpost.php'; ?>

	<div id="contentContainer">

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
		    <li><a href="#t2" id="<?php echo $_GET['pid']; ?>" class="ePicture">Pictures</a></li> 
		    <li>
		    	<a href="#t3" class="eVideo">Videos</a></li>
		    <li>
		    	<a href="#t4" class="eVideo">Voters</a></li>
		  </ul> 

		  	<div id="t1">
		  	<form method="post" id="formProject" enctype="multipart/form-data">

				<h3><a href="#">Showcase Details</a></h3>
				<div>
					<p>Showcase Details, you can update the details.</p><br>
					<p>
					<label>Project / Business Idea</label><br/>
					<input type="text" class="tfull" name="projectIdea" id="projectIdea" value="<?php echo $rowEdit->proTitle; ?>" /><br/>

					<label>Short Brief</label><br/>
					<textarea name="shortBrief" id="shortBrief" class="tfull"><?php echo $rowEdit->BriefIdea; ?></textarea><br/>

					<label>Category</label>
					<small>Which category is suitable with your project</small>
					<select name="pro_cat" id="pro_cat">
						<?php


						$q_idea_cat = "SELECT * FROM mj_fund_category";
						$rslt_idea = mysql_query($q_idea_cat);

						while ($rowIdCat = mysql_fetch_object($rslt_idea)) {
							
							echo '<option value="'.$rowIdCat->fund_cat_id.'">'.ucwords($rowIdCat->fund_cat_name).'</option>';
						}

						?>
					</select><br/>

					<textarea name="businessModel" id="businessModel" class="full"><?php echo $rowEdit->bModel; ?></textarea>
					</p>
				</div><!-- section1 -->

				<div style="display:none">
				<h3><a href="#">Section 02 :: Customer & Market</a></h3>
				<div>
					<p>(Please detail out the value proposition to the customer, target industry, marketing strategy, the benefit relative to the price, estimated size of customer market, current customer base (if any) and/or examples of ready customers for the idea)</p>
					<p>
					<textarea name="customerMarket" id="customerMarket" class="full"><?php echo $rowEdit->cMarket; ?></textarea>
					</p>
				</div><!-- section2 -->

				<h3><a href="#">Section 03 :: Market Access & Timing</a></h3>
				<div>
					<p>(Please detail out the estimated market acceptance and access, current customer practice, potential or existing competitors and analysis, current or potential substitutes to the product/services, competing or emerging technologies, and why you think that this is the correct time to launch the idea.)</p>
					<p>
					<textarea name="accessTiming" id="accessTiming" class="full"><?php echo $rowEdit->aTiming; ?></textarea>
					</p>

				</div><!-- section3 -->

				<h3><a href="#">Section 04 :: Economic trends</a></h3>
				<div>
					<p>(Please detail out the relevant economic trends that would affect the commercial viability of the idea locally, regionally and internationally, i.e consumer market trends, economic growth, disposable income of customers, spending patterns of the customer base, etc.)</p>
					<p>
					<textarea name="economicTrends" id="economicTrends" class="full"><?php echo $rowEdit->eTrend; ?></textarea>
					</p>
				</div><!-- /section4 -->

				<h3><a href="#">Section 05 :: Technology Development & Innovation</a></h3>
				<div>
					<p>(Please detail out and highlight what technology you will be creating / adapting / innovating / inventing with the funding, and list out all the technical modules/sections/parts for your product / service that will be developed/delivered as well as the relevant technology trends that would affect the viability of the idea, i.e new competing technology, new research findings, technology investment focus, etc.)</p>
					<p>
					<textarea name="techDevinnovation" id="techDevinnovation" class="full"><?php echo $rowEdit->tInno; ?></textarea>
					</p>
				</div><!-- /section5 -->

				<h3><a href="#">Section 06 :: Intellectual Property & Regulation</a></h3>
				<div>
					<p>(Please detail out, as far as you know, any rules, regulations, licensing, incentives, monopolies, governing bodies and laws that impact the idea. Specify if there's any Intellectual Property advantage or barriers, patents, copyright, trademarks, standards, certifications that can be applied to your idea.)</p>
					<p>
					<textarea name="ipRegulation" class="full" id="ipRegulation"><?php echo $rowEdit->ipRegular; ?></textarea>
					</p>
				</div><!-- /section6 -->

				<h3><a href="#">Section 07 :: Stage of the Industry & Future Plans</a></h3>
				<div>
					<p>(Please detail out the stage of the Industry, i.e. whether it is still growing or shrinking, estimated acceptance of industry and market to the idea within the next 3-5 years (with reasons to support your belief), and suitability of timing for exploitation of opportunity.)
					</p>
					<p>
					<textarea name="industryFuture" id="industryFuture" class="full"><?php echo $rowEdit->fPlan; ?></textarea>
					</p>
				</div><!-- /section7 -->

				<h3><a href="#">Section 08 :: Deliverables for Idea Development</a></h3>
				<div>
					<p>(Please specify what the deliverables are for the development of the idea (i.e. Proof of Concept, Business Plan) in relation to the size of the funding requested and within a duration of 3 to 6 months, and then set out the milestones (not more than 3) involved, together with KPIs)
					</p>
					<p>
					<textarea name="ideaDevelopment" id="ideaDevelopment" class="full"><?php echo $rowEdit->IdeaDev; ?></textarea>
					</p>
				</div><!-- section8 -->

				<h3><a href="#">Section 09 :: Size of Funding and Milestones</a></h3>
				<div>
					<p>(Please detail out size of funding required and a simple cash flow breakdown for the utilization of funding.)</p>
					<p>
					<label>Project Budget</label><br/>
					<input type="text" class="title" name="project_budget" id="project_budget" value="<?php echo $rowEdit->proBudget; ?>" /><br/>
					<label>Cash Flow Breakdown</label><br/>
					<textarea name="FundingMilestones" class="full" id="FundingMilestones"><?php echo $rowEdit->Milles; ?></textarea>
					</p>
				</div><!-- section9 -->
				</div>

				<p>
					<label><strong>Current Cover</strong></label><br/>
					<img src="<?php echo $rowEdit->proImg; ?>" width="500" />
				</p><br/><br/>


				<p>
					<input type="hidden" name="user_id" value="<?php echo $usr_id; ?>" />
					<input type="hidden" name="curr_proj_id" id="curr_proj_id" value="<?php echo $get_id_view; ?>" />
					<input type="submit" name="submitProposal" id="submitProposal" class="button green" value="Update Project" />
				</p>

			</form><!-- formProPreview -->

		  </div> <!-- /t1 -->

		  <div id="t2" style="display: block; ">
		  	<div id="loadEditedPircture">
		  		
		  	</div><!-- /loadEditePircture -->
		  </div> <!-- t2 -->



		  <div id="t3" style="display: block; ">
		  	<div id="loadEditedVideo" class="">
		  		
		  	</div><!-- /loadEditedVideo -->
		  </div> <!-- t3 -->

		  <div id="t4" style="display: block; ">
		  	<div id="bakerTotal" class="">
		  		<strong>List of Baker for this project</strong>
		  		<?php 

		  		// ==================================================================
		  		//
		  		// Checking is user have pledge
		  		//
		  		// ------------------------------------------------------------------
		  		$sqlUserPledge = "SELECT * FROM mj_fund_pledged WHERE fund_post_id_fk = '$get_id_view'";
		  		$resultUserPledge = mysql_query($sqlUserPledge);
		  		$numrowsUserPledge = mysql_num_rows($resultUserPledge);

		  		if ($numrowsUserPledge == 0) {
		  			echo "<br/><br/>There no any user pledge yet.";
		  		}
		  		else {


	  			// ==================================================================
	  			//
	  			// Display total spending
	  			//
	  			// ------------------------------------------------------------------
	  			

	  			$sqlProject = "SELECT
				  mj_fund_pledged.fund_money As fMoney,
				  mj_fund_pledged.fund_usr_id_fk As fIDFK,
				  mj_fund_pledged.fund_post_id_fk,
				  mj_users.usr_name As fName
				From
				  mj_fund_pledged Inner Join
				  mj_users On mj_fund_pledged.fund_usr_id_fk = mj_users.usr_id
				Where
				  mj_fund_pledged.fund_post_id_fk = '$get_id_view'";
	  			$resultProject = mysql_query($sqlProject);
	  			

	  			// fetch data
	  			echo '<br/><br/><table style="text-align:left;" width="580px">';
	  			while ($rowProject = mysql_fetch_object($resultProject)) {
	  			?>
	  			
	  			<tr>
	  			<td><a href="users.php?uid=<?php echo $rowProject->fIDFK;?>" title="View Funder <?php echo $rowProject->fName;?>" target="_blank"><?php echo $rowProject->fName;?></a></td>
	  			<td align="right"><strong style="color:green"><?php echo number_format($rowProject->fMoney);?></strong></td>
	  			</tr>

	  			<?php 
	  			}
	  			?>
	  			<tr>
	  				<td colspan="3">&nbsp;</td>
	  			</tr>
	  			<tr>
	  				<td><h2><strong>Total</strong></h2></td>
	  				<td align="right"><?php 

	  					$sqlTotalProjectFunding = "SELECT
						  Sum(mj_fund_pledged.fund_money) As TotalFundingMoney,
						  mj_fund_pledged.fund_post_id_fk
						From
						  mj_fund_pledged
						Where
						  mj_fund_pledged.fund_post_id_fk = '$get_id_view'";

	  					$resultTotalProjectFunding = mysql_query($sqlTotalProjectFunding);
	  					$rowobjecttotalfunding = mysql_fetch_object($resultTotalProjectFunding);
	  					?>
	  					<h2><strong><?php echo $rowobjecttotalfunding->TotalFundingMoney; ?></strong></h2>
	  				</td>
	  			</tr>
	  			</table>

	  			<?php 

	  			} // end display row
	  			
	  			?>
		  	</div><!-- /bakerTotal -->
		  </div> <!-- t3 -->

		  
		</div><!-- /advTab1 -->

		<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
			<strong>Note</strong><br><br>
			<?php  

			if ($rowEdit->proIsPublished == 1) {
				echo '<p class="success">Your Project is Live! you can view it <a href="'.urlencode($rowEdit->proTitle).'-project-'.$get_id_view.'.html" style="font-weight:bold; color:green">Here</a></p>';
			}
			else {
				echo '<p class="info">Please noted, your project is currently pending. Our editor will review your ideaa,</p>';
			}

			?>
		</div><!-- right -->

		<div class="clear"></div><!-- /clear -->


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


	var curr_proj_id = $('#curr_proj_id').val();

	// $('label').css('font-weight','bold');
	// $('label').css('display','block');
	// $('input, textarea, select').css('display','block');


	/* idTab */
  	//var settings = { start:1, change:false }; 
  	$("#adv1 ul").idTabs();


  	/* load picture */
  	$('.ePicture').click(function(){

  		$('#loadEditedPircture').html('loading').load('ajax/ajax-edited-project-picture.php?pid='+curr_proj_id);
  		//console.log('loaded');
  		return false;
  		// loadEditedVideo

  	});


  	/* load video */
  	$('.eVideo').click(function(){

  		$('#loadEditedVideo').html('loading').load('ajax/ajax-edited-project-video.php?pid='+curr_proj_id);
  		//console.log('loaded');
  		return false;


  	});



  	/* submit edited project */
	$('#submitProposal').click(function(){

		var dataString = $('#formProject').serialize();

		$.ajax({

			type: "POST",
			url	: "ajax/ajax-project-edited.php",
			data: dataString,
			

			success:function(html){

				if (html == 1) {
					//$('.success').fadeIn();
					console.log('Edited');
					$.jnotify("Saved!", 5000);
				}
				else {
					console.log('error');
					$.jnotify("Error!", "error");
				}

			}

		});

		console.log(dataString);
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