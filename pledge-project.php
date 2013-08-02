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

// Get project id by parameter
$pro_id_view	= (int) sqlInjectString($_GET['id']);

$qProDetails = "SELECT
  mj_fund_category.fund_cat_name As projCatName,
  mj_users.usr_name As proBy,
  mj_users.*,
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
  mj_fund_post.fund_post_date As projDate,
  mj_fund_post.fund_cat_id_fk As projCatId,
  mj_fund_post.fund_post_ratup As projRatUp,
  mj_fund_post.fund_usr_id_fk As proByID,
  mj_fund_post.fund_post_published,
  mj_fund_post.fund_view
From
  mj_fund_post Inner Join
  mj_users On mj_fund_post.fund_usr_id_fk = mj_users.usr_id Inner Join
  mj_fund_category On mj_fund_post.fund_cat_id_fk = mj_fund_category.fund_cat_id
Where
  mj_fund_post.fund_post_id = '$pro_id_view'";

$rqProDetails   = mysql_query($qProDetails);
$rowqProDetails = mysql_fetch_object($rqProDetails);

$minimumPledge = (25 / 100) * $rowqProDetails->proBudget;

?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer">

		<div class="heading none">
			<h1 class="title bottom-gap" style="text-align:left"><?php echo $rowqProDetails->proTitle; ?></h1>
			<h4>Project / Proposal submited by <?php echo $rowqProDetails->proBy; ?></h4>
		</div>

			<div style="border:0px solid red; margin:30px 0px 0px 0px;">
			
			<div class="left">
			<a href="users.php?uid=<?php echo $rowqProDetails->proByID; ?>" title="<?php echo ucfirst($rowqProDetails->usr_name); ?>">
			<div class="profile-pic48" style="background-image: url('<?php echo $rowqProDetails->user_pic; ?>'); float: left; margin-right: 10px;">

			</div>
			</a>
			</div>

			<div class="left">
				<a href="funding-details.php?id=<?php echo $rowqProDetails->fund_post_id; ?>" title=""><h1 class="markettitle" style="text-align:left">Project : <?php echo ucwords($rowqProDetails->proTitle); ?></h1></a>
				by <a href="users.php?uid=<?php echo $rowqProDetails->proByID; ?>" title="<?php echo ucfirst($rowqProDetails->usr_name); ?>"><strong><?php echo ucfirst($rowqProDetails->usr_name); ?></strong></a> &middot; <?php echo $rowqProDetails->projDate; ?> &middot; in <a href="funding-category.php?id=<?php echo $rowqProDetails->projCatId; ?>" title=""><strong><?php echo ucwords($rowqProDetails->projCatName); ?></strong></a>
			</div>

			<div class="right">
				<table border="0" cellpadding="5" cellspacing="5">
					<tr>
						<td><h2><strong><?php echo number_format($rowqProDetails->fund_view); ?></strong></h2>
							<span style="color:#999">view</span></td>
						<td><h2><strong><?php echo number_format($rowqProDetails->projRatUp); ?></strong></h2>
							<span style="color:#999">likes</span></td>
						<td><h2><strong>
							<?php  
							$totalRespond     = "SELECT
							  Count(mj_fund_comment.fund_comment_id) As TotalComment
							From
							  mj_fund_comment
							Where
							  mj_fund_comment.fund_post_id_fk = '$pro_id_view'";
							$resultRepond     = mysql_query($totalRespond);
							$rowResultRespond = mysql_fetch_object($resultRepond);
							echo number_format($rowResultRespond->TotalComment);
							?>
							</strong></h2>
							<span style="color:#999">comments</span></td>
					</tr>
				</table>
			</div><!-- / -->
			<div class="clear"></div>
		</div><!-- /author info -->

			<div class="home_box" style="padding:50px 0px 20px 0px;">

				<!-- View -->

				<div class="details-container">
					
					<div class="left-side">

						<div>
						<div style="width:550px">

						<h3>You're a few short steps from being a beloved backer.</h3><br>

						<div class="success none" id="Thank">
							Thanks You. View project <a href="funding-details.php?id=<?php echo $pro_id_view; ?>">here</a>
						</div>
						<form method="post" id="formpledge">

						<h3>Enter your pledge amount</h3><br><br>

						<div class="blue-box">
							<strong>RM </strong><input type="text" class="title" id="amountPledge" placeholder="25% (RM<?php echo $minimumPledge; ?>) of RM<?php echo $rowqProDetails->proBudget; ?>" maxlength="100" />
							<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount should 25% of budget.
							<input type="hidden" name="minP" id="minP" value="<?php echo $minimumPledge; ?>" />
							<input type="hidden" name="fullAmount" id="fullAmount" value="<?php echo $rowqProDetails->proBudget; ?>" />
						</div><br><br>

						<input type="submit" name="pledge" class="button green" value="Submit Pledge" id="submitPledge" />

						<input type="hidden" name="pledgedBy" id="pledgedBy" value="<?php echo $usr_id; ?>" />
						<input type="hidden" name="projectId" id="projectId" value="<?php echo $pro_id_view; ?>" />
						</form>

						</div>
						</div>
					</div>


					<div class="right-side" style="background: rgba(255,255,255,0.5);">
						<div style="float:left">
							<div class="imgFunding" style="overflow:hidden; width:90px; height: 70px; border:0px solid red; background-image: url('<?php echo $rowqProDetails->proImg; ?>'); background-position:center center; background-size: auto 100%; background-repeat: no-repeat;">
								<!-- <img src="<?php echo $rowrandProject->proImg; ?>" width="190"> -->
							</div><!-- /imgFunding -->
						</div>
						<div style="float:right;width: 180px; line-height: 15px;">
							<strong style="color:#1F4864"><?php echo $rowqProDetails->proTitle; ?></strong><br/>
							by <?php echo $rowqProDetails->proBy; ?><br/>
							RM <?php echo $rowqProDetails->proBudget; ?>
							<br/>
							Funding ends <?php echo date("Y-m-d", strtotime($rowqProDetails->fund_post_ended1)); ?>
						</div>
						<div class="clear"></div>
					</div>

					<div class="clear"></div>
				</div>

				<!-- /view -->

			</div>
		</div>
	</div><!-- /contentContainer -->

</div><!-- /content -->


<script type="text/javascript">
$(document).ready(function(){


	var minPledge = $('#minP').val();
	var fAmount   = $('#fullAmount').val();

	//$('#submitPledge').attr('disabled', 'disabled');

	// Accordian
	$('#submitPledge').click(function(){

		// form var
		var pledgeAmount 	= $('#amountPledge').val();
		var pledgedBy 		= $('#pledgedBy').val();
		var projectId		= $('#projectId').val();
		var dataString		= 'pledge=' + pledgeAmount + '&pledgedBy=' + pledgedBy + '&projectId=' + projectId;

		//console.log(dataString);


		if (pledgeAmount == '') {
			
			//alert('Fill it!');
			$.jnotify("Fill up your amount to pledge", "error");

		} else {


			// form var
			var pledgeAmount 	= $('#amountPledge').val();
			var pledgedBy 		= $('#pledgedBy').val();
			var projectId		= $('#projectId').val();
			var minPledge       = $('#minP').val();
			var fAmount         = $('#fullAmount').val();
			var dataString		= 'pledge=' + pledgeAmount + '&pledgedBy=' + pledgedBy + '&projectId=' + projectId +
									'&minPledge=' + minPledge + '&fAmount=' + fAmount;

			$.ajax({
	
				type: 	"POST",
				url: 	"ajax/pludge-insert.php",
				data: 	dataString,

				success: function(html){
					

					if (html == 1) {
						$('#amountPledge').val("");
						//alert('Success');
						//$('#formpledge').hide();

						//$('#Thank').fadeIn();
						$.jnotify("Thank you, we got your amount");
					}
					else {
						$.jnotify("Must be grater than 25% of project funding", "error");
					}

					
					console.log(dataString);

				}

			});

		}

		return false;

				

	});


	/*var minimumPledgeValue = $('#minP').val();
	//console.log(minimumPledgeValue+"hello");

	jQuery("#amountPledge").validate({
        expression: "if (VAL >= "+minimumPledgeValue+") return true; else return false;",
        message: "Should be greater than "+minimumPledgeValue
    });*/


});
</script>
<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>