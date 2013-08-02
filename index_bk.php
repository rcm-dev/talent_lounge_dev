<?php  

/* Include header */
include 'header.php';
include 'class/short.php';

?>
		<div id="content" class="">
			
			<div id="contentContainer" class="">

				<div id="searchTradingHub" class="searchTradingHub">
					<form class="inline center" method="get" action="search-market.php">
						Mojo Market. What are you looking for : 
						<input type="text" name="prod_search" class="title" placeholder="keywords.."/>

						Category
						<select name="market_category">
							<?php  
							/**
							 * SHOW AREA
							 */
							$qCat 	= "SELECT
							  mj_market_category.mrket_cat_name As catName,
							  mj_market_category.mrket_cat_id As catId
							From
							  mj_market_category";
							$rqCat	= mysql_query($qCat);

							echo '<option value="0" style="background:#ddd;">All Category</option>';
							while ($rowqCat = mysql_fetch_object($rqCat)) {
			
							?>
							<option value="<?php echo $rowqCat->catId; ?>"><?php echo $rowqCat->catName; ?>
							</option>
							<?php } ?>
						</select>

						Area
						<select name="market_area">
							<?php  
							/**
							 * SHOW AREA
							 */
							$qArea 	= "SELECT
							  mj_state.state_id As sId,
							  mj_state.state_name As sArea
							From
							  mj_state";
							$rqArea	= mysql_query($qArea);

							echo '<option value="0" style="background:#ddd;">All Area</option>';
							while ($rowqArea = mysql_fetch_object($rqArea)) {
			
							?>
							<option value="<?php echo $rowqArea->sId; ?>"><?php echo $rowqArea->sArea; ?>
							</option>
							<?php } ?>
						</select>

						<input type="submit" name="submit_prod" value="SEARCH" />
					</form>
				</div><!-- /searchTradingHub -->
				
				<div id="tradinghub" class="tradinghub">
					<?php  
							
					/**
					 * Loop Top Rate Market
					 * 
					 */

					 include 'db/db-connect.php';

					// ==================================================================
					//
					// product random 1
					//
					// ------------------------------------------------------------------
					
					$qTopRate1 = "SELECT
					  mj_market_post.*,
					  mj_market_category.mrket_cat_name,
					  mj_users.*,
					  mj_users.usr_name AS Uploader,
					  mj_state.state_name,
					  mj_market_post.mrket_post_body As mrket_desc,
					  mj_market_post.mrket_post_id As pid1
					FROM
					  mj_market_post INNER JOIN
					  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
					  mj_market_category On mj_market_post.mrket_cat_id_fk =
					    mj_market_category.mrket_cat_id INNER JOIN
					  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
					WHERE mrket_cat_id_fk = 1
					ORDER BY RAND()
					LIMIT 1";
					

					$rqTopRate1 = mysql_query($qTopRate1);
					$rowrqTop1 = mysql_fetch_object($rqTopRate1);


					// ==================================================================
					//
					// product random 2
					//
					// ------------------------------------------------------------------

					$qTopRate2 = "SELECT
					  mj_market_post.*,
					  mj_market_category.mrket_cat_name,
					  mj_users.*,
					  mj_users.usr_name AS Uploader,
					  mj_state.state_name,
					  mj_market_post.mrket_post_body As mrket_desc,
					  mj_market_post.mrket_post_id As pid2
					FROM
					  mj_market_post INNER JOIN
					  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
					  mj_market_category On mj_market_post.mrket_cat_id_fk =
					    mj_market_category.mrket_cat_id INNER JOIN
					  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
					WHERE mrket_cat_id_fk = 1
					ORDER BY RAND()
					LIMIT 1";
					

					$rqTopRate2 = mysql_query($qTopRate2);
					$rowrqTop2 = mysql_fetch_object($rqTopRate2);
					

					// ==================================================================
					//
					// product random 3
					//
					// ------------------------------------------------------------------

					$qTopRate3 = "SELECT
					  mj_market_post.*,
					  mj_market_category.mrket_cat_name,
					  mj_users.*,
					  mj_users.usr_name AS Uploader,
					  mj_state.state_name,
					  mj_market_post.mrket_post_body As mrket_desc,
					  mj_market_post.mrket_post_id As pid3
					FROM
					  mj_market_post INNER JOIN
					  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
					  mj_market_category On mj_market_post.mrket_cat_id_fk =
					    mj_market_category.mrket_cat_id INNER JOIN
					  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
					WHERE mrket_cat_id_fk = 1
					ORDER BY RAND()
					LIMIT 1";
					

					$rqTopRate3 = mysql_query($qTopRate3);
					$rowrqTop3 = mysql_fetch_object($rqTopRate3);

					// ==================================================================
					//
					// product random 4
					//
					// ------------------------------------------------------------------

					$qTopRate4 = "SELECT
					  mj_market_post.*,
					  mj_market_category.mrket_cat_name,
					  mj_users.*,
					  mj_users.usr_name AS Uploader,
					  mj_state.state_name,
					  mj_market_post.mrket_post_body As mrket_desc,
					  mj_market_post.mrket_post_id As pid4
					FROM
					  mj_market_post INNER JOIN
					  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
					  mj_market_category On mj_market_post.mrket_cat_id_fk =
					    mj_market_category.mrket_cat_id INNER JOIN
					  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
					WHERE mrket_cat_id_fk = 1
					ORDER BY RAND()
					LIMIT 1";
					

					$rqTopRate4 = mysql_query($qTopRate4);
					$rowrqTop4 = mysql_fetch_object($rqTopRate4);

					// ==================================================================
					//
					// product random 5
					//
					// ------------------------------------------------------------------

					$qTopRate5 = "SELECT
					  mj_market_post.*,
					  mj_market_category.mrket_cat_name,
					  mj_users.*,
					  mj_users.usr_name AS Uploader,
					  mj_state.state_name,
					  mj_market_post.mrket_post_body As mrket_desc,
					  mj_market_post.mrket_post_id As pid5
					FROM
					  mj_market_post INNER JOIN
					  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
					  mj_market_category On mj_market_post.mrket_cat_id_fk =
					    mj_market_category.mrket_cat_id INNER JOIN
					  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
					WHERE mrket_cat_id_fk = 1
					ORDER BY RAND()
					LIMIT 1";
					

					$rqTopRate5 = mysql_query($qTopRate5);
					$rowrqTop5 = mysql_fetch_object($rqTopRate5);

					// ==================================================================
					//
					// product random 6
					//
					// ------------------------------------------------------------------

					$qTopRate6 = "SELECT
					  mj_market_post.*,
					  mj_market_category.mrket_cat_name,
					  mj_users.*,
					  mj_users.usr_name AS Uploader,
					  mj_state.state_name,
					  mj_market_post.mrket_post_body As mrket_desc,
					  mj_market_post.mrket_post_id As pid6
					FROM
					  mj_market_post INNER JOIN
					  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
					  mj_market_category On mj_market_post.mrket_cat_id_fk =
					    mj_market_category.mrket_cat_id INNER JOIN
					  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
					WHERE mrket_cat_id_fk = 1
					ORDER BY RAND()
					LIMIT 1";
					

					$rqTopRate6 = mysql_query($qTopRate6);
					$rowrqTop6 = mysql_fetch_object($rqTopRate6);

					?>
					<div id="ImgOne" class="left" style="border:0px solid red; height: 240px; width: 240px; margin-right: 10px;">
						
						<a href="product-details.php?id=<?php echo $rowrqTop1->pid1; ?>">
						<div class="white" style="border:1px solid #eaeaea; height: 255px; margin-bottom:10px; background-image: url('<?php echo $rowrqTop1->mrket_post_picture; ?>'); background-position: center center; background-size: auto 100%; background-repeat: no-repeat;">
						
						<div class="caption">
							<?php echo $rowrqTop1->mrket_post_title; ?>
							<strong class="price"><?php echo convertPrice($rowrqTop1->mrket_price); ?></strong>
						</div><!-- /caption -->
						</div>
						</a>

						<a href="product-details.php?id=<?php echo $rowrqTop2->pid2; ?>">
						<div class="white" style="border:1px solid #eaeaea; height: 183px; background-image: url(<?php echo $rowrqTop2->mrket_post_picture; ?>); background-position: center center; background-size: auto 100%; background-repeat: no-repeat;">
						
						<div class="caption">
							<?php echo $rowrqTop2->mrket_post_title; ?>
							<strong class="price"><?php echo convertPrice($rowrqTop2->mrket_price); ?></strong>
						</div><!-- /caption -->
						</div>
						</a>

					</div><!-- /ImgOne -->

					<a href="product-details.php?id=<?php echo $rowrqTop3->pid3; ?>">
					<div id="ImgTwo" class="white left" style="border:1px solid #eaeaea; height: 450px; width: 450px; margin-right: 10px; background-image: url(<?php echo $rowrqTop3->mrket_post_picture; ?>); background-position: center center; background-size: auto 100%; background-repeat: no-repeat;">
					
					<div class="caption">
							<?php echo $rowrqTop3->mrket_post_title; ?>
							<strong class="price"><?php echo convertPrice($rowrqTop3->mrket_price); ?></strong>
						</div><!-- /caption -->
					</div>
					</a>
					<!-- /ImgTwo -->

					<div id="imgThree" class="left" style="border:0px solid red; height:280px; width: 280px;">
						
						<a href="product-details.php?id=<?php echo $rowrqTop4->pid4; ?>">
						<div class="white" style="border:1px solid #eaeaea; height: 330px; margin-bottom:10px; background-image: url(<?php echo $rowrqTop4->mrket_post_picture; ?>); background-position: center center; background-size: auto 100%; background-repeat: no-repeat;">
						
						<div class="caption">
							<?php echo $rowrqTop4->mrket_post_title; ?>
							<strong class="price"><?php echo convertPrice($rowrqTop4->mrket_price); ?></strong>
						</div><!-- /caption -->
						</div>
						</a>

						<a href="product-details.php?id=<?php echo $rowrqTop5->pid5; ?>">
						<div class="white left" style="border:1px solid #eaeaea; height: 110px; width: 130px; margin-right:15px; background-image: url(<?php echo $rowrqTop5->mrket_post_picture; ?>); background-position: center center; background-size: auto 100%; background-repeat: no-repeat;">
						
						<div class="caption">
							<?php echo $rowrqTop5->mrket_post_title; ?>
							<strong class="price"><?php echo convertPrice($rowrqTop5->mrket_price); ?></strong>
						</div><!-- /caption -->
						</div>
						</a>

						<a href="product-details.php?id=<?php echo $rowrqTop6->pid6; ?>">
						<div class="white left" style="border:1px solid #eaeaea; height: 110px; width: 130px; background-image: url(<?php echo $rowrqTop6->mrket_post_picture; ?>); background-position: center center; background-size: auto 100%; background-repeat: no-repeat;">
						
						<div class="caption">
							<?php echo $rowrqTop6->mrket_post_title; ?>
							<strong class="price"><?php echo convertPrice($rowrqTop6->mrket_price); ?></strong>
						</div><!-- /caption -->
						</div>
						</a>

						<div class="clear"></div>

					</div><!-- /imgThree -->

					<div class="clear"></div>

				</div><!-- /tradinghub -->


				<div id="relatedhub" style="margin-top: 50px; padding-top: 30px; border-top:1px dotted #d1d1d1;" class="none">
					<h3>WHAT OTHER ARE VIEWING NOW</h3>

					<div id="otherViewing">
						<ul id="otherViewing">
						
						<?php  

						// ==================================================================
						//
						// product random 2
						//
						// ------------------------------------------------------------------

						$otherView = "SELECT
						  mj_market_post.*,
						  mj_market_category.mrket_cat_name As CatNameView,
						  mj_users.*,
						  mj_users.usr_name AS Uploader,
						  mj_state.state_name,
						  mj_market_post.mrket_post_body As mrket_desc,
						  mj_market_post.mrket_post_title As viewingTitle,
						  mj_market_post.mrket_price As viewPrice,
						  mj_market_post.mrket_post_id As pid
						FROM
						  mj_market_post INNER JOIN
						  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
						  mj_market_category On mj_market_post.mrket_cat_id_fk =
						    mj_market_category.mrket_cat_id INNER JOIN
						  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
						WHERE mrket_cat_id_fk = 1
						ORDER BY RAND()
						LIMIT 5";
						

						$rotherView = mysql_query($otherView);
						while ($rowotherView = mysql_fetch_object($rotherView)) {

						?>
						
							<li>
								<a href="product-details.php?id=<?php echo $rowotherView->pid; ?>" title="<?php echo $rowotherView->viewingTitle; ?>">
								<div class="white" style="width: 172px; height: 172px; overflow: hidden;">
									<div style="width: 172px; height: 172px; background-image: url(<?php echo $rowotherView->mrket_post_picture; ?>); background-size: 100%; background-repeat: no-repeat; background-position: center center"></div>
								</div>
								</a>
								<div class="viewDetail">
									<span><?php echo ucwords($rowotherView->viewingTitle); ?></span><br/>
									<span><?php echo $rowotherView->CatNameView; ?></span><br/>
									<span class="viewprice"><?php echo convertPrice($rowotherView->viewPrice); ?>
									</span>
								</div><!-- /viewDetail -->
							</li>

						<?php } ?>

							<div class="clear"></div>

						</ul><!-- /otherViewing -->

					</div><!-- /otherViewing -->

				</div><!-- /relatedhub -->


				<div id="happening" style="margin-top: 50px; padding-top: 30px; border-top:1px dotted #d1d1d1;">
					<h3>IDEA / PRODUCT SUBMISSION</h3>

					<?php  


					$qRandIdea		=	"SELECT
					  mj_idea_post.id_pictures As Picture,
					  mj_idea_post.id_post_id As picId,
					   mj_idea_post.id_title As ideaTitle,
					  mj_idea_post.id_desc
					From
					  mj_idea_post
					Order By RAND()
					LIMIT 5";

					$rqRandIdea	=	mysql_query($qRandIdea);

					?>

					<div style="padding: 30px 0px;">
						<ul class="idea-new-ui">
						<?php while ($rowqRandIdea = mysql_fetch_object($rqRandIdea)) { ?>
							<li style="margin-right: 40px;">
							<a class="call-inventcat" href="idea-details.php?id=<?php echo $rowqRandIdea->picId; ?>" rel="<?php echo $rowqRandIdea->picId; ?>">

								<div style="border:0px solid red; overflow: hidden; width: 150px; height:120px;">

									<img src="<?php echo $rowqRandIdea->Picture; ?>" width="150" original-title="<?php echo $rowqRandIdea->ideaTitle; ?>">
								</div>

							</a>

							</li>
						<?php } ?>
							<div class="clear"></div>
						</ul>
					</div>

				</div><!-- /happening -->


				<div id="happening" style="margin-top: 50px; padding-top: 30px; border-top:1px dotted #d1d1d1;">
					<h3>FUNDING INNOVATION PROJECT</h3>


					<?php  

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


					?>


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
				 	
				 	<div class="pro-container">
				 	<ul style="margin-top:30px;">


				 		<?php while ($rowrandProject = mysql_fetch_object($rrandProject)) { ?>
				 			
				 			<li>
								<div class="project-item">
									<div class="project-visual">

										<div class="project-visual-container">
										<div class="project-visual-top">
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
									<div class="clear"></div>
								</div>
							</li>

				 		<?php } ?>
						
					<div class="clear"></div>
					</ul>
					</div>

				 <?php } ?>

				<!-- /view -->
				</div>

			</div><!-- /contentContainer -->

		</div><!-- /content -->


<script>
$(document).ready(function(){
    
   function test () {
   		//console.log('RUN');
   		$('#tradinghub').load('index.php #tradinghub');
   		//$('#ImgOne').fadeOut(4000).fadeIn(4000);
   }

   //var refreshId = setInterval(test, 5000);

   /* tipsy */
	$('.idea-new-ui').find('li img').tipsy({gravity: 's'});

});
</script>
<?php  

/* Include header */
include 'footer.php';

?>