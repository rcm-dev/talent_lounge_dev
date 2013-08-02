<?php  



// INCLUDE EVERYTHING NEEDED
include 'header.php';
include 'class/api.php';
include 'db/db-connect.php';
include 'class/short.php';


//-----------------------------------------------
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
  mj_fund_post.fund_post_published = 1
ORDER BY RAND()
LIMIT 0, 2";

$rrandProject	= mysql_query($randProject);

//------------------------------------------------

?>


<div id="mojo-container">
	
	<div class="container_24">

		<div class="home_container">
			<div class="home_box">
			<h2>Featured Idea</h2>
			<ul id="homeIdea" style="margin-bottom: 100px;">
			<?php  

			$qIdea 		= "SELECT
			  mj_idea_post.*,
			  mj_users.usr_name,
			  mj_idea_post.id_rat_up As toprates
			FROM
			  mj_idea_post INNER JOIN
			  mj_users On mj_idea_post.id_usr_id_fk = mj_users.usr_id
			ORDER By
			  mj_idea_post.id_rat_up DESC
			LIMIT 0,2";
			$qiResuult	= mysql_query($qIdea);

			while ($rowI = mysql_fetch_object($qiResuult)) {

			?>

			<li>
						<a href="idea-details.php?id=<?php echo $rowI->id_post_id; ?>">
						<div class="idea-img-container">
							<div style="position:absolute"><img src="images/idea-frame.png" width="269" height="196"></div>
							<div style="border:0px solid red; overflow: hidden; width: 240px; height:180px; margin: 50px 0px 0px 12px;">
							<img src="<?php echo $rowI->id_pictures; ?>" width="269">
							</div>
						</div>
						
						<div class="new-title-ui">
							<p><?php echo $rowI->id_title; ?></p>
						</div>

						</a>	
			</li>
			
			<?php } ?>
			<div class="clear"></div>
			</ul>
			
			<div class="clear" style="margin-bottom: 190px;"></div>
			
			<h2>Featured Project</h2>
			<div>
			<!-- View -->

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
				 	
				 	<div class="pro-container" style="margin-bottom:100px;">
				 	<ul>


				 		<?php while ($rowrandProject = mysql_fetch_object($rrandProject)) { ?>
				 			
				 			<li>
								<div class="project-item">
									<div class="project-visual">

										<div class="project-visual-container">
										<div class="project-visual-top">
										<a href="funding-details.php?id=<?php echo $rowrandProject->proId; ?>">
										<img src="<?php echo $rowrandProject->proImg; ?>" height="150" width="190">
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

											<div style="color:#999">
												<div class="pledge-item">
												<?php  
												/**
												 * 
												 * If nothing pledge display 0
												 * 
												 */
												if ($numrowrsPledge == 0) { ?>

												<small><strong style="color:#666">0%</strong>
												FUNDED</small>

												<?php  } else {

												$projectBudget 	= $rowsPledge->Budget;
												$totalGet	   	= $rowsPledge->TotalPledge;
												$projectPercent	= ($totalGet/$projectBudget)*100; 

												?>
												<small>
												<strong style="color:#666">
												<?php echo $projectPercent ?>%</strong>
												FUNDED</small>
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

												<small><strong style="color:#666">RM 0</strong>
												PLEDGED</small>

												<?php  } else { ?>

												<small>
												<strong style="color:#666">RM<?php echo number_format($rowsPledge->TotalPledge); ?></strong>
												PLEDGED</small>

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
									<div class="project-details">
										<p><h4><strong><?php echo strtoupper($rowrandProject->proTitle); ?></strong></h4></p>
										<p style="font-size: 13px; color: #666;"><?php echo short($rowrandProject->proDesc); ?></p>
									</div>
									<div class="clear">S</div>
								</div>
							</li>

				 		<?php } ?>
						
					<div class="clear"></div>
					</ul>
					</div>

				 <?php } ?>

				<!-- /view -->
			</div>

			<h2>Recent Market</h2>
			<div class="market-item-container">
				<ul class="market-list">
					<?php  
					
					/**
					 * Loop Top Rate Market
					 * 
					 */

					 include 'db/db-connect.php';

					 $qTopRate = "SELECT
					  mj_market_post.*,
					  mj_market_category.mrket_cat_name,
					  mj_users.*,
					  mj_users.usr_name AS Uploader,
					  mj_state.state_name
					FROM
					  mj_market_post INNER JOIN
					  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
					  mj_market_category On mj_market_post.mrket_cat_id_fk =
					    mj_market_category.mrket_cat_id INNER JOIN
					  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
					  LIMIT 0, 4";
					

					$rqTopRate = mysql_query($qTopRate);
					
					while ($rowrqTop = mysql_fetch_object($rqTopRate)) {

					?>

					<li>
						<a href="product-details.php?id=<?php echo $rowrqTop->mrket_post_id; ?>">
						<div class="market-dis-container">

							<div style="border:0px solid red; height: 130px; overflow: hidden">
							
							
							<div class="market-image-list">
							<img src="<?php echo $rowrqTop->mrket_post_picture; ?>" height="130px" width="150px" />
							</div>

							<!-- Description -->
							<div class="mrket-slide" style="width: 140px; height:130px; border: 0px solid #ddd; background: #eee; padding: 5px;">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
								<small><?php echo date("g:i a F j, Y ", strtotime($rowrqTop->market_dateposted)); ?></small>
							</div>
							<!-- /Description -->

							</div>


							<h3 class="price"><sup>RM</sup> <?php 

									$dprice = $rowrqTop->mrket_price;
									
									if ($dprice < 1000) {
									 	
									 	echo $dprice;
									 } 

									if ($dprice >= 1000 && $dprice <= 999999) {
										
										$kprice = $dprice / 1000;
										echo $kprice."K";

									}

									if ($dprice >= 1000000 && $dprice <= 9999999) {
										
										$kprice = $dprice / 1000000;
										echo $kprice."M";

									}

									?></h3>
							<div class="market_misc"><?php echo $rowrqTop->mrket_post_title; ?></div>
						</div>
						</a>
						</li>

					<?php } ?>
				</ul>
				<div class="clear"></div>

			</div>
			</div>
		</div>


	</div>

	<!-- <div class="container_24"><a href="logout.php">Logout</a></div> -->
</div>


<div id="mojo-copyright">
		<div class="mojo-footer-subcontainer container_24">
			<div class="grid_4">
				<p>Mojo &copy; <?php echo date('Y'); ?></p>
			</div>
			<div class="mj-footer-link grid_20 omega">
				<p><a href="#">Privacy</a> &middot; <a href="#">Term</a> &middot; <a href="#">Help</a></p>
			</div>
			<div class="clear"></div>
		</div>
</div><!-- /copyright -->


<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>