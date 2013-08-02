<?php  


include 'header.php';
include 'db/db-connect.php';
include 'class/short.php';

// display rand project by category
$randProject	=	"SELECT
  mj_users.usr_name As proBy,
  mj_fund_post.fund_post_id As proId,
  mj_fund_post.fund_post_title As proTitle,
  mj_fund_post.fund_post_business_model proDesc,
  mj_fund_category.fund_cat_name As catName,
  mj_fund_post.fund_post_image As proImg,
  mj_fund_post.fund_post_short_brief As shortBrief,
  mj_fund_post.fund_post_published
From
  mj_fund_post Inner Join
  mj_fund_category On mj_fund_post.fund_cat_id_fk = mj_fund_category.fund_cat_id
  Inner Join
  mj_users On mj_fund_post.fund_usr_id_fk = mj_users.usr_id
Where
  mj_fund_post.fund_post_published = 1 And
  mj_fund_post.fund_post_success = 0 And
  mj_fund_post.fund_post_failed = 0
ORDER BY RAND()
LIMIT 0, 10";

$rrandProject	= mysql_query($randProject);

?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer">

		<div class="heading">
			<h1 class="heading_title bebasTitle">Showcase</h1>
		</div>

		<div id="searchFounderHub" class="searchTradingHub" style="display:none">
			<form action="search-founders.php" accept-charset="utf-8">

			<strong style="font-size:16px; color:#fff">Find funders in : </strong> 
			
			<select name="searchsector" id="searchsector" style="padding:4px">
				<option value="0">All Sector</option>
				<?php  

				$qsec          	= "SELECT
								  mj_sector.sec_id As secID,
								  mj_sector.sec_name As secName
								From
								  mj_sector";
				$resultsec     	= mysql_query($qsec);

				while ($rowsec 	= mysql_fetch_object($resultsec)) { ?>
					
					<option value="<?php echo $rowsec->secID; ?>">
						<?php echo ucwords($rowsec->secName); ?></option>
			
				<?php } ?>
			</select>

			<select name="searchProduct" id="searchProduct" style="padding:4px">
				<option value="0">All Product / Services</option>
			</select>

			<select name="searchnetworkarea" id="searchnetworkarea" style="padding:4px">
				<option value="0">All Area</option>
				<?php  

				$qstat           = "SELECT
								  mj_state.state_id as stateID,
								  mj_state.state_name As stateName
								From
								  mj_state";
				$resultqstat     = mysql_query($qstat);

				while ($rowstat   = mysql_fetch_object($resultqstat)) { ?>
					
					<option value="<?php echo $rowstat->stateID; ?>">
						<?php echo ucwords($rowstat->stateName); ?></option>
			
				<?php } ?>
			</select>

			<?php  

			// tracking session
			if (!isset($usr_email)) {

			?>
			
			<strong style="font-size:16px; color: orange">Register to explore</strong>

			<?php } else { ?>

			<input type="submit" name="searchNetwork" id="searchNetwork" value="Search Network" style="padding:4px" />

			<?php } ?>

		</form>
		</div><!-- /searchTradingHub --><br><br>

		<div class="top-grid" id="projectByCat" style="margin-bottom:30px;">
			<h4><strong class="heading_title_two bebasTitle">Showcase Categories</strong></h4>
			
			<ul id="fundingCat">
				<?php  
				/**
				 * 
				 * View by category
				 */

				 $pCat = "SELECT
					  mj_fund_category.fund_cat_name As CatNameBottom,
					  mj_fund_category.fund_cat_id As catIdBottom
					From
					  mj_fund_category";

				 $rpCat = mysql_query($pCat);

				 while ($rowpCat = mysql_fetch_object($rpCat)) {
				 	

				?>

				<li>
				<a href="funding-category.php?id=<?php echo $rowpCat->catIdBottom; ?>">
				<?php echo ucwords($rowpCat->CatNameBottom); ?></a>
				</li>

				<?php } ?>
				<div class="clear"></div>
			</ul>
		</div><!-- /project category -->


				<?php  


				/**
				 * 
				 *
				 * If 0 return no project
				 */

				 $norandProject = mysql_num_rows($rrandProject);

				 if ($norandProject == 0) {
				 	
				 	echo "No project.";

				 } else { 

				 ?>
				 	
				 	<div id="projectListed" class="pro-container">
				 	<ul>


				 		<?php while ($rowrandProject = mysql_fetch_object($rrandProject)) { ?>
				 			
				 			<li>
								<div class="project-item">
									<div class="project-visual">

										<div class="project-visual-container">
										<div class="project-visual-top">
										<!-- <a href="<?php //echo urlencode($rowrandProject->proTitle); ?>-project-<?php //echo $rowrandProject->proId; ?>.html"> -->
										<a href="funding-details.php?id=<?php echo $rowrandProject->proId; ?>">
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
											<?php echo shortBrief(ucfirst($rowrandProject->shortBrief)); ?>
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
									<div id="projDesc" class="project-details">
										<p><h4><strong><?php echo strtoupper($rowrandProject->proTitle); ?></strong></h4></p>
										<p style="font-size: 13px; color: #666;"><?php echo short($rowrandProject->proDesc); ?></p>
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
				<br/><br/>
				<strong class="bebasTitle">Featured Showcase</strong><br><br>

				<div id="successfulList" class="">
					<div id="successprojectListed" class="pro-container">
						<?php  

						$randSuccessProject	=	"SELECT
						  mj_users.usr_name As proBy,
						  mj_fund_post.fund_post_id As proId,
						  mj_fund_post.fund_post_title As proTitle,
						  mj_fund_post.fund_post_business_model proDesc,
						  mj_fund_category.fund_cat_name As catName,
						  mj_fund_post.fund_post_image As proImg,
						  mj_fund_post.fund_post_short_brief As shortBrief,
						  mj_fund_post.fund_post_published,
						  mj_fund_post.fund_post_ended As proEnd
						From
						  mj_fund_post Inner Join
						  mj_fund_category On mj_fund_post.fund_cat_id_fk = mj_fund_category.fund_cat_id
						  Inner Join
						  mj_users On mj_fund_post.fund_usr_id_fk = mj_users.usr_id
						Where
						  mj_fund_post.fund_post_published = 1 And
						  mj_fund_post.fund_post_success = 1 And
						  mj_fund_post.fund_post_failed = 0
						ORDER BY RAND()
						LIMIT 0, 10";

						$rrandSuccessProject	= mysql_query($randSuccessProject);

						?>
				 		<ul>
				 		<?php while ($rowrandSuccessProject = mysql_fetch_object($rrandSuccessProject)) { ?>
				 			
				 			<li>
								<div class="project-item">
									<div class="project-visual">

										<div class="project-visual-container">
										<div class="project-visual-top">
										<!-- <a href="<?php //echo urlencode($rowrandSuccessProject->proTitle); ?>-success-project-<?php //echo $rowrandSuccessProject->proId; ?>.html"> -->
										<a href="success-funding-details.php?id=<?php echo $rowrandSuccessProject->proId; ?>">	
											<div class="imgFunding" style="overflow:hidden; width:190px; height:130px; border:0px solid red; background-image: url('<?php echo $rowrandSuccessProject->proImg; ?>'); background-position:center center; background-size: auto 100%; background-repeat: no-repeat;">
												<!-- <img src="<?php echo $rowrandSuccessProject->proImg; ?>" width="190"> -->
											</div><!-- /imgFunding -->
										</a>
										<br/>
										<a href="success-funding-details.php?id=<?php echo $rowrandSuccessProject->proId; ?>">
										<strong style="color:#1F4864"><?php echo ucwords($rowrandSuccessProject->proTitle); ?></strong>
										</a>
										<br/>
										<small style="color:#999;">by <?php echo ucwords($rowrandSuccessProject->proBy); ?></small>
										<br/>
										<p style="color:#999; font-size: 12px; line-height: 15px; margin-top:10px">
											<?php echo shortBrief(ucfirst($rowrandSuccessProject->shortBrief)); ?>
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

										 $projectId = $rowrandSuccessProject->proId;

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


											<div style="background-color:green; padding:4px;">
												<div style="font-weight:bold; color:#fff">
													SUCCESSFUL!
												</div>
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
												<strong style="color:#666"><br/>OF VOTED</strong><br/>
												<?php echo $rowrandSuccessProject->proEnd; ?></small></div>

												<div class="clear"></div>
											</div>
										</div>
										</div>

									</div>
									<div id="projDesc" class="project-details">
										<p><h4><strong><?php echo strtoupper($rowrandSuccessProject->proTitle); ?></strong></h4></p>
										<p style="font-size: 13px; color: #666;"><?php echo short($rowrandSuccessProject->proDesc); ?></p>
									</div>
									<div class="clear"></div>
								</div>
							</li>

				 		<?php } ?>
						
						<div class="clear"></div>
						</ul>
					</div>
					
				</div><!-- /successfulList -->



				<strong class="bebasTitle">Showcase need to be revamp</strong><br><br>

				<div id="failedfulList" class="">
					<div id="failedprojectListed" class="pro-container">
						<?php  

						$randFailedProject	=	"SELECT
						  mj_users.usr_name As proBy,
						  mj_fund_post.fund_post_id As proId,
						  mj_fund_post.fund_post_title As proTitle,
						  mj_fund_post.fund_post_business_model proDesc,
						  mj_fund_category.fund_cat_name As catName,
						  mj_fund_post.fund_post_image As proImg,
						  mj_fund_post.fund_post_short_brief As shortBrief,
						  mj_fund_post.fund_post_published,
						  mj_fund_post.fund_post_ended As proEnd
						From
						  mj_fund_post Inner Join
						  mj_fund_category On mj_fund_post.fund_cat_id_fk = mj_fund_category.fund_cat_id
						  Inner Join
						  mj_users On mj_fund_post.fund_usr_id_fk = mj_users.usr_id
						Where
						  mj_fund_post.fund_post_published = 1 And
						  mj_fund_post.fund_post_success = 0 And
						  mj_fund_post.fund_post_failed = 1
						ORDER BY RAND()
						LIMIT 0, 10";

						$rrandFailedProject	= mysql_query($randFailedProject);

						?>
				 		<ul>
				 		<?php while ($rowrandFailedProject = mysql_fetch_object($rrandFailedProject)) { ?>
				 			
				 			<li>
								<div class="project-item">
									<div class="project-visual">

										<div class="project-visual-container">
										<div class="project-visual-top">
										<!-- <a href="<?php //echo urlencode($rowrandFailedProject->proTitle); ?>-failed-project-<?php //echo $rowrandFailedProject->proId; ?>.html"> -->
										<a href="failed-funding-details.php?id=<?php echo $rowrandFailedProject->proId; ?>">
											<div class="imgFunding" style="overflow:hidden; width:190px; height:130px; border:0px solid red; background-image: url('<?php echo $rowrandFailedProject->proImg; ?>'); background-position:center center; background-size: auto 100%; background-repeat: no-repeat;">
												<!-- <img src="<?php echo $rowrandFailedProject->proImg; ?>" width="190"> -->
											</div><!-- /imgFunding -->
										</a>
										<br/>
										<a href="failed-funding-details.php?id=<?php echo $rowrandFailedProject->proId; ?>">
										<strong style="color:#1F4864"><?php echo ucwords($rowrandFailedProject->proTitle); ?></strong>
										</a>
										<br/>
										<small style="color:#999;">by <?php echo ucwords($rowrandFailedProject->proBy); ?></small>
										<br/>
										<p style="color:#999; font-size: 12px; line-height: 15px; margin-top:10px">
											<?php echo shortBrief(ucfirst($rowrandFailedProject->shortBrief)); ?>
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

										 $projectId = $rowrandFailedProject->proId;

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
												<div class="pledge-bar-value" style="width:<?php echo $projectPercent; ?>%; background-color:red!important;"></div>
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
												<strong style="color:#666">END</strong><br/>
												<?php echo $rowrandFailedProject->proEnd; ?></small></div>

												<div class="clear"></div>
											</div>
										</div>
										</div>

									</div>
									<div id="projDesc" class="project-details">
										<p><h4><strong><?php echo strtoupper($rowrandFailedProject->proTitle); ?></strong></h4></p>
										<p style="font-size: 13px; color: #666;"><?php echo short($rowrandFailedProject->proDesc); ?></p>
									</div>
									<div class="clear"></div>
								</div>
							</li>

				 		<?php } ?>
						
						<div class="clear"></div>
						</ul>
					</div>
					
				</div><!-- /failedfulList -->

	</div><!-- /contentContainer -->	

</div><!-- /content -->

<!-- Page Title -->
<input type="hidden" name="page_title" value="Browse Projects" id="page_title" />
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />


<!-- Tip Content -->
<ol id="joyRideTipContent">
  <li data-id="searchNetwork" data-text="Next" class="custom">
    <h4>Search Funders</h4>
    <p>You can search featured funder</p>
  </li>
  <li data-id="projectByCat" data-text="Next">
    <h4>Browse By Category</h4>
    <p>Browse project by category</p>
  </li>
  <li data-id="projDesc" data-text="Next">
    <h4>Listed Project</h4>
    <p>Browse preview project and short details</p>
  </li>
  <li data-id="projectDetailsInfo" data-text="Close">
    <h4>Short preview</h4>
    <p>% of total pledge and day left</p>
  </li>
</ol>

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