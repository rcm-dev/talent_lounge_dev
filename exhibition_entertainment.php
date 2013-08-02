<?php  


include 'header.php';
include 'db/db-connect.php';
include 'class/short.php';

// display rand project by category

$randProject	=	"SELECT 
mj_users.usr_name AS proBy, 
jp_exhibition.ex_id AS proId, 
jp_exhibition.ex_name AS proTitle, 
jp_exhibition.ex_desc proDesc, 
jp_ex_category.ex_cat_name AS catName, 
jp_exhibition.ex_poster AS proImg, 
jp_exhibition.publish
FROM jp_exhibition
INNER JOIN jp_ex_category ON jp_exhibition.ex_cat_id_fk = jp_ex_category.ex_cat_id
INNER JOIN mj_users ON jp_exhibition.ex_usr_id_fk = mj_users.usr_id
WHERE jp_exhibition.publish = 1 
  -- jp_exhibition.fund_post_success = 0 And
  -- jp_exhibition.fund_post_failed = 0
ORDER BY RAND()
LIMIT 0, 10";

$rrandProject	= mysql_query($randProject);

?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer">
<br/>
<br/>
<br/>
		<div class="heading">
			<h1 class="heading_title bebasTitle">Exhibitions &amp; Displays</h1>
		</div>
<div class="left cnscontainer1">
		  <strong style="font-size:20px; color:#004080; font-family:bebas">Entertainment </strong> 

		
		<br><br>

			
		


				<?php  


				$norandProject = mysql_num_rows($rrandProject);

				 if ($norandProject == 0) {
				 	
				 	echo "No project.";

				 } else { 

				 ?>
				 	<div id="projectListed" class="pro-containerEx">
				 		
				 	<ul>
                        

				 		<?php while ($rowrandProject = mysql_fetch_object($rrandProject)) { ?>
				 			
				 			<li>
								<div class="project-item1">
									<div class="project-visual">

										<div class="project-visual-container">
										<div class="project-visual-top">
										<!-- <a href="<?php //echo urlencode($rowrandProject->proTitle); ?>-project-<?php //echo $rowrandProject->proId; ?>.html"> -->
										<a href="ExhibitionDetail.php?id=<?php echo $rowrandProject->proId; ?>">
											<div class="imgFunding" style="overflow:hidden; width:190px; height:130px; border:0px solid red; background-image: url('<?php echo $rowrandProject->proImg; ?>'); background-position:center center; background-size: auto 100%; background-repeat: no-repeat;">
												<!-- <img src="<?php echo $rowrandProject->proImg; ?>" width="190"> -->
											</div><!-- /imgFunding -->
										</a>
										<br/>
										<a href="funding-details.php?id=<?php echo $rowrandProject->proId; ?>">
										<strong style="color:#1F4864"><?php echo ucwords($rowrandProject->proTitle); ?></strong>
										</a>
										<br/>
										<small style="color:#999;">by <?php echo ucwords($rowrandProject->proBy); ?></small>
										<br/>
										<p style="color:#999; font-size: 12px; line-height: 15px; margin-top:10px">
											<?php echo shortBrief(ucfirst($rowrandProject->proDesc)); ?>
										</p>
										</div>



										<div class="project-pledge-info">
										<?php  

										/**
										 * 
										 * 
										 * Pledge Information
										 * 
										 */

										 $projectId = $rowrandProject->proId;

										 $sPledge = "SELECT
										  SUM(mj_fund_pledged.fund_money) As TotalPledge,
										  mj_fund_post.fund_post_title,
										  mj_fund_post.fund_post_project_budget As Budget,
										  mj_fund_pledged.fund_post_id_fk
										From
										  mj_fund_post Inner Join
										  mj_fund_pledged On mj_fund_pledged.fund_post_id_fk = mj_fund_post.fund_post_id
										Where
										  mj_fund_pledged.fund_post_id_fk = '$projectId'
										Group By
										  mj_fund_post.fund_post_title, mj_fund_post.fund_post_project_budget,
										  mj_fund_pledged.fund_post_id_fk";

										  $rsPledge = mysql_query($sPledge);
										  $rowsPledge = mysql_fetch_object($rsPledge);
										  $numrowrsPledge = mysql_num_rows($rsPledge);



										?>
										<?php  
										/**
										 * 
										 * If nothing pledge display 0
										 * 
										 */
										if ($numrowrsPledge == 0) { ?>

										<div class="pledge-bar">
												<div class="pledge-bar-value" style="width:0%"></div>
											</div>

										<?php  } else {

										$projectBudget 	= $rowsPledge->Budget;
										$totalGet	   	= $rowsPledge->TotalPledge;
										$projectPercent	= ($totalGet/$projectBudget)*100; 

										?>


											<div class="pledge-bar">
												<div class="pledge-bar-value" style="width:<?php echo $projectPercent; ?>%"></div>
											</div>
										<?php } ?>

											<div id="projectDetailsInfo" style="color:#999">
												<div class="pledge-item">
												<?php  
												/**
												 * 
												 * If nothing pledge display 0
												 * 
												 */
												if ($numrowrsPledge == 0) { ?>

												<small><strong style="color:#666">0%</strong>
												<br/>OF VOTED</small>

												<?php  } else {

												$projectBudget 	= $rowsPledge->Budget;
												$totalGet	   	= $rowsPledge->TotalPledge;
												$projectPercent	= ($totalGet/$projectBudget)*100; 

												?>
												<small>
												<strong style="color:#666">
												<?php echo $projectPercent ?>%</strong>
												<br/>OF VOTED</small>
												<?php } ?>
												</div>

												<div class="pledge-item">
												<?php  
												/**
												 * 
												 * If nothing pledge display 0
												 * 
												 */
												if ($numrowrsPledge == 0) { ?>

												<small><strong style="color:#666">0</strong>
												<br/>VOTED</small>

												<?php  } else { ?>

												<small>
												<strong style="color:#666">RM<?php echo number_format($rowsPledge->TotalPledge); ?></strong>
												<br/>VOTED</small>

												<?php } ?>

												</div>

												<div class="pledge-item">
												<?php  
												/**
												 * 
												 * Calculate DAYLEFT
												 *
												 */
												 $qDayLeft = "SELECT DATEDIFF( fund_post_ended, NOW( ) ) AS DAYLEFT FROM mj_fund_post WHERE fund_post_id = '$projectId'";
												 $rqDayLeft = mysql_query($qDayLeft);
												 $rowqDayLeft = mysql_fetch_object($rqDayLeft);

												?>
												<small>
												<strong style="color:#666"><?php echo $rowqDayLeft->DAYLEFT; ?></strong><br/>
												DAYS LEFT</small></div>

												<div class="clear"></div>
											</div>
										</div>
										</div>

									</div>
									
									<div class="clear"></div>
								</div>
							</li>

				 		<?php } ?>
						
					<div class="clear"></div>
					</ul>
					</div>

				 <?php } ?>

				<!-- /view -->
				
						
				
						
						<div class="clear"></div>
						</ul>
					</div>
					
			<?php include 'sidebar_exhibition.php'; ?>

		<!-- /sidebar-connect n share -->

		<div class="clear"></div>


	</div><!-- /contentContainer -->
	</div><!-- /contentContainer -->	

</div>
</div>

<?php 

// var tours
$section = 4;
include 'check_tours.php'; 

?>

<!-- js start here -->
<script type="text/javascript">
$(document).ready(function(){

	// run joyride
	var current_email = $('#current_email').val();
	if (current_email != '') {

		// get tour status
		var tour_status = $('input#tour_status').val();

		// if status run start tours
		if (tour_status == 'run') {
			// $('#tallChart').visualize();
			/*start joyride*/
			$(window).load(function() {
				$(this).joyride({
					'tipLocation': 'bottom',
			      		'scrollSpeed': 300,
			      		'nextButton': true,
			      		'tipAnimation': 'fade',
			      		'tipAnimationFadeSpeed': 500,
			      		'cookieMonster': false,
			      		'inline': true,
			      		'tipContent': '#joyRideTipContent',
			      		'postRideCallback': function(){
			      			disableTour();
			      			$("html, body").animate({ scrollTop: 0 }, "slow");
			      		}      
				});
			});
		};
		console.log(tour_status);

		// function disable tour
		function disableTour() {
			var disableTour = '<?php include 'disable_tours.php'; ?>';
			return disableTour;
		}	
	}
	// run joyride


	/* Change services */
	$('#searchsector').change(function(){

		var sectorID = $(this).val();
	

		$('#searchProduct').load('ajax/ajax-selectsector.php?sectorid='+sectorID);
		console.log(sectorID);
		

	});

});
</script>
<!-- /end js -->
<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>