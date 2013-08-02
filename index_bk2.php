<?php  

/* Include header */
include 'header.php';
include 'class/short.php';

function shortUpdate($text) { 

    // Change to the number of characters you want to display 
    $chars = 90; 

    $text = $text." "; 
    $text = substr($text,0,$chars); 
    $text = substr($text,0,strrpos($text,' '));

    if ($chars > 90) {
    	$text = $text."...";
    }
    else {
    	$text = $text."";
    }

     

    return $text; 

}

// Function seo friendly
function seo_url($string) 
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

	echo $seoname;
}

?>
<div id="landingMain" class="frontLanding">
	<div id="landingContainer" class="">
		<!-- <div class="landingTitle"></div> -->
		
		<div id="landing-welcome">
			<table cellpadding="2">
				<tr>
					<td colspan="2"><img src="images/landing-text.png" alt="landing-text" /></td>
				</tr>
				<tr>
					<td><img src="images/landing-text-bl.png" alt="landing-text" /></td>
					<td>
						<a href="takethetour.php" title="Take a Tour">
							<img src="images/landing-text-br.png" border="0" alt="landing-text" />
						</a>
					</td>
				</tr>
			</table>
		</div>

		<div style="display:none">
			<div class="takeAtour">
				<div class="tourBtn">
					<a href="takethetour.php" title="Take a Tour" class="button large yellow left"><strong>TAKE THE TOUR</strong></a>
					<div class="clear"></div>
				</div><!-- / --><br>			
				<div class="clear"></div>
			</div><!-- / -->
			<div style="text-align:center; color:#E1E2DE">
				or <a href="register.php" title="or Join Now! It's Free" style="margin:10px 0px; color:#00deff; text-decoration:underline; font-weight:bold" class="public">Join Now! It's Free</a>
			</div><!-- / -->
		</div>

	</div><!-- /landingContainer -->
</div><!-- / -->
		<div id="content" class="">
			
			<div id="contentContainer" class="">

				<div id="cnshare" style="padding-top: 30px; margin-bottom:30px;">
					<div id="latestupdatecns" class="left ui-window" style="width: 450px;">
						<h3 style="margin-bottom:30px;" class="ui-users-black32 heading_title_two bebasTitle">
							CONNECT &amp; SHARE</h3>

						<div id="intervalStream">
							<ul>
							<?php  

							// Get second
							function realtime($timestap) {
							        
							    $realtime = strtotime($timestap);

							    return $realtime;
							}

							// 12 min ago..
							function time_since($time) {


							    $original = realtime($time);

							    // array of time period chunks
							    $chunks = array(
							    array(60 * 60 * 24 * 365 , 'year'),
							    array(60 * 60 * 24 * 30 , 'month'),
							    array(60 * 60 * 24 * 7, 'week'),
							    array(60 * 60 * 24 , 'day'),
							    array(60 * 60 , 'hour'),
							    array(60 , 'min'),
							    array(1 , 'sec'),
							    );
							 
							    $today = time(); /* Current unix time  */
							    $since = $today - $original;
							 
							    // $j saves performing the count function each time around the loop
							    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
							 
							    $seconds = $chunks[$i][0];
							    $name = $chunks[$i][1];
							 
							    // finding the biggest chunk (if the chunk fits, break)
							    if (($count = floor($since / $seconds)) != 0) {
							        break;
							    }
							    }
							 
							    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
							 
							    if ($i + 1 < $j) {
							    // now getting the second item
							    $seconds2 = $chunks[$i + 1][0];
							    $name2 = $chunks[$i + 1][1];
							 
							    // add second item if its greater than 0
							    if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
							        $print .= ($count2 == 1) ? ', 1 '.$name2 : " $count2 {$name2}s ago";
							    }
							    }
							    return $print;
							}
							//include '../db/db-connect.php';

							$cns = "SELECT mj_users.usr_name As pName,
							status_usr_id_fk,
							status_body AS pStatus,
							status_date AS pStatTime,
							mj_users.usr_id AS uid,
							  mj_users.usr_workat As pwAt,
							  mj_users.user_pic As ppic 
							  FROM 
							  mj_status Inner Join
								  mj_users On mj_status.status_usr_id_fk = mj_users.usr_id
								  where status_date 
								  in(select max(status_date) from mj_status group by `status_usr_id_fk` ) order by status_date desc limit 12";


							$rcns = mysql_query($cns);

							while ($rowcns = mysql_fetch_object($rcns)) { ?>

							<li>
							<div id="<?php echo $rowcns->uid; ?>" style="border-top:1px dotted #f1f1f1; width:450px; padding: 10px 0px;">
								
								<div class="left" style="margin-right: 20px">
									<a href="users.php?uid=<?php echo $rowcns->uid; ?>">
									<div class="profile-pic" style="background-image:url('<?php echo $rowcns->ppic; ?>');">
										
									</div><!-- /profile-pic48 -->
									</a>

								</div><!-- /profile-pic48 -->

								<div class="personame left" style="width:300px;">
										<strong><a href="users.php?uid=<?php echo $rowcns->uid; ?>" class="pname"><?php echo htmlentities($rowcns->pName); ?></a></strong> &middot; <?php echo $rowcns->pwAt; ?><br>
										<p class="pstatus"><?php echo shortUpdate($rowcns->pStatus); ?>
											<br><?php echo time_since($rowcns->pStatTime); ?></p>
								</div><!-- /personame -->

								<div class="clear"></div>
							</div><!-- /uid -->
							</li>


							<?php 

							}

							?>
							<div class="clear"></div>
							</ul>
						</div><!-- /intervalStream -->

						<div class="none">
						<?php  

						$cns = "SELECT mj_users.usr_name As pName,status_usr_id_fk,status_body AS pStatus,mj_users.usr_id AS uid,
						  mj_users.usr_workat As pwAt,
						  mj_users.user_pic As ppic 
						  FROM 
						  mj_status Inner Join
 						  mj_users On mj_status.status_usr_id_fk = mj_users.usr_id
 						  where status_date 
 						  in(select max(status_date) from mj_status group by `status_usr_id_fk` ) order by `status_date` desc limit 5";


						$rcns = mysql_query($cns);

						while ($rowcns = mysql_fetch_object($rcns)) { ?>
						
						<div id="<?php echo $rowcns->uid; ?>" style="border-top:1px dotted #f1f1f1; width:450px; padding: 10px 0px;">
							
							<div class="left" style="margin-right: 20px">
								<a href="users.php?uid=<?php echo $rowcns->uid; ?>">
								<div class="profile-pic" style="background-image:url('<?php echo $rowcns->ppic; ?>');">
									
								</div><!-- /profile-pic48 -->
								</a>

							</div><!-- /profile-pic48 -->

							<div class="personame left" style="width:300px;">
									<strong><a href="users.php?uid=<?php echo $rowcns->uid; ?>" class="pname"><?php echo $rowcns->pName; ?></a></strong> &middot; <?php echo $rowcns->pwAt; ?><br>
									<p class="pstatus"><?php echo shortUpdate($rowcns->pStatus); ?></p>
							</div><!-- /personame -->

							<div class="clear"></div>
						</div><!-- /uid -->
						


						<?php 

						}

						?>
						</div><!-- /none -->

						<?php  

						// tracking session
						if (!isset($usr_email)) {

						?>
						<div style="margin-top: 30px;">
							<a href="public.php" title="Join Network Now" style="float:right" class="public button green">Join Network Now</a>
						</div><!-- /join network -->

						<?php } ?>


					</div><!-- /latestupdatecns -->

					<div id="lastestupdatearticle" class="right ui-window" style="width:440px; height:540px">
						<h3 style="margin-bottom:30px;" class="ic_bookmark-black32 heading_title_two bebasTitle"><?php echo strtoupper("Interesting Resources"); ?></h3>

						<h3>Recent Articles</h3>
						<ul class="book-ui" original-title="Testing">

							<?php

							/*----------------------------------------------------*/
							/**
							 * Recent Article
							 */

							 $sqlRecentArticle = "SELECT
								  mj_learn_article.*,
								  mj_learn_article_category.la_cat_name,
								  mj_learn_article.la_id,
								  mj_learn_article.la_visual As ArticleCover,
								  mj_learn_article.la_title As la_title1
								FROM
								  mj_learn_article INNER JOIN
								  mj_learn_article_category ON mj_learn_article.la_cat_id_fk =
								    mj_learn_article_category.la_cat_id
								WHERE mj_learn_article_category.la_cat_id = 4
								ORDER BY
								  mj_learn_article.la_id DESC LIMIT 15";
							 $sqlRecentResult	 = mysql_query($sqlRecentArticle);

							 while ($rowRecentArticle = mysql_fetch_object($sqlRecentResult)) {
						 		//echo '<li><a href="article-view-plain.php?aid='.$rowRecentArticle->la_id.'" class="viewOver">'.ucwords($rowRecentArticle->la_title).'</a> ('.$rowRecentArticle->la_dateposted.')<p>'
						 		//.short($rowRecentArticle->la_body).'</p></li>';
						 		echo '<li>';
						 		echo '<div style="width:75px; height:100px; overflow:hidden;">';
						 		//echo '<a class="viewOver" href="article-view-plain.php?aid='.$rowRecentArticle->la_id.'">';
						 		echo '<img src="'.$rowRecentArticle->ArticleCover.'" width="75" original-title="'.$rowRecentArticle->la_title1.'" />';
						 		//echo '</a>';
						 		echo '</div>';
						 		echo '</li>';
							 }

							?>
							<div class="clear"></div>
						</ul>
						<br/>
						<?php  

						// tracking session
						//if (!isset($usr_email)) {

						?>
						<div id="" style="text-align:right; padding: 10px 0px; margin-top:15px;">
							<!-- <a href="public.php" title="Entrepreneur Library" style="float:right" class="public button green">Entrepreneur Library</a> -->
							<a href="entrepreneur-library.php" title="Browse More" style="float:right" class="button green">Browse More</a>
						</div><!-- /join network -->
						<?php //} ?>


					</div><!-- /lastestupdatearticle -->

					<div class="clear"></div>
				</div><!-- /cnshare -->

				<div id="relatedhub" style="margin-top: 150px;">

					<div id="otherViewing">

						<h3 style="margin-bottom:30px; margin-left: 20px;" class="ic_tag-black32 heading_title_two bebasTitle">BUY &amp; SELL GOODS</h3>

						<ul class="market-list">
						
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
						  mj_state.state_name As location,
						  mj_market_post.mrket_post_title As marketSlugTitle,
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
						WHERE mrket_post_published = 1
						ORDER BY mj_market_post.market_dateposted DESC
						LIMIT 10";
						

						$rotherView = mysql_query($otherView);
						while ($rowotherView = mysql_fetch_object($rotherView)) {

						?>
						
							<li style="border:0px solid red; margin:10px; border:1px solid #e1e1e1;">
								<!-- <a href="<?php //echo urlencode($rowotherView->marketSlugTitle); ?>-market-<?php //echo $rowotherView->pid; ?>.html" title="<?php //echo $rowotherView->viewingTitle; ?>"> -->
								<!-- <a href="<?php seo_url($rowotherView->marketSlugTitle); ?>-market-<?php //echo $rowotherView->pid; ?>.html" title="<?php //echo $rowotherView->viewingTitle; ?>"> -->
								<a href="product-details.php?id=<?php echo $rowotherView->pid; ?>" title="<?php //echo $rowotherView->viewingTitle; ?>">
								<div class="white" style="width: 172px; height: 172px; overflow: hidden;">
									<div style="width: 172px; height: 172px; background-image: url(<?php echo $rowotherView->mrket_post_picture; ?>); background-size: auto 100%; background-repeat: no-repeat; background-position: center center"></div>
								</div>
								</a>
								<div class="viewDetail">
									<div class="titleWrap">
										<span><strong><?php echo ucfirst($rowotherView->mrket_post_title); ?></strong></span>
									</div>
									<span><?php echo ucwords($rowotherView->CatNameView); ?></span><br/>
									<span class="viewprice ic_tag_grey"><?php echo convertPrice($rowotherView->viewPrice); ?>
									</span>
									<span class="ic_pin_grey" style="margin-left:5px;"><?php echo ucwords($rowotherView->location); ?></span>
								</div><!-- /viewDetail -->
							</li>

						<?php } ?>

							<div class="clear"></div>

						</ul><!-- /otherViewing -->

					</div><!-- /otherViewing -->

				</div><!-- /relatedhub -->



				<div id="happening" style="margin-top: 60px; padding-top: 100px; border-top:0px dotted #d1d1d1;">
					
					<div>

					<h3 style="margin-left: 20px;" class="ic_favorite-black32 heading_title_two bebasTitle">IDEAS &amp; PRODUCT SUBMISSION</h3>

					<?php  


					$qRandIdea		=	"SELECT
					  mj_idea_post.id_pictures As Picture,
					  mj_idea_post.id_post_id As picId,
					  mj_idea_post.id_title As ideaTitle,
					  mj_idea_post.id_desc,
					  mj_idea_post.id_usr_id_fk As usrIdFK,
					  mj_users.usr_name As usrName,
					  mj_users.user_pic As usrPic,
					  mj_idea_post.id_rat_up As ideaLove
					From
					  mj_idea_post Inner Join
					  mj_users On mj_idea_post.id_usr_id_fk = mj_users.usr_id
					Where
					  mj_idea_post.id_post_published = 1
					Order By
					  RAND()
					Limit 8";

					$rqRandIdea	=	mysql_query($qRandIdea);

					?>

					<div style="padding: 30px 0px;">
						<ul class="idea-new-ui">
						<?php while ($rowqRandIdea = mysql_fetch_object($rqRandIdea)) { ?>
							
							<li>
								<div class="ideaContainer">
									<div class="ideaFrame">
										<div class="ideaFrameImage">
										<a class="call-inventcat" href="idea-details.php?id=<?php echo $rowqRandIdea->picId; ?>" rel="<?php echo $rowqRandIdea->picId; ?>">
											<img src="<?php echo $rowqRandIdea->Picture; ?>" width="100%" original-title="<?php echo $rowqRandIdea->ideaTitle; ?>">
										</a>
										</div>
										<div class="ideaMisc">
											<div class="left multimedia">
												<img src="images/icon_grey/ic_attachment.png" original-title="Multimedia Included" alt="Multimedia"  height="14" width="14">
											</div><!-- /attach -->
											<div class="right comment">
												<span class="ic_chats_grey">
													<?php  

													$qComment = "SELECT
																  Count(mj_idea_comment.id_usr_id_fk) As totalComment
																From
																  mj_idea_comment
																Where
																  mj_idea_comment.id_post_id_fk = '$rowqRandIdea->picId'";
													$rqComment=mysql_query($qComment);
													$rowqComment=mysql_fetch_object($rqComment);

													echo number_format($rowqComment->totalComment);

													?>
												</span>
											</div><!-- /comment -->
											<div class="right like">
												<span class="ic_favorite_grey"><?php echo number_format($rowqRandIdea->ideaLove); ?></span>
											</div><!-- /like -->
											<div class="clear"></div>
										</div><!-- /ideaMisc -->
										<div class="clear"></div>
									</div>
								</div><!-- /ideaContainer -->
								<div class="ideaByUser">
									<a href="users.php?uid=<?php echo $rowqRandIdea->usrIdFK; ?>" title="<?php echo $rowqRandIdea->usrName; ?>">
										<div class="pradius" style="background-image: url('<?php echo $rowqRandIdea->usrPic; ?>');">
										</div>
										<strong><?php echo $rowqRandIdea->usrName; ?></strong>
									</a>
								</div>
							</li>
							
						<?php } ?>
							<div class="clear"></div>
						</ul>
					</div>

					</div>

				</div><!-- /happening -->


				<div id="happening" style="margin-top: 50px; padding-top: 100px; border-top:0px dotted #d1d1d1;">

				   <div>

					<h3 class="ic_archive-black32 heading_title_two bebasTitle" style="margin-left: 20px; margin-bottom:20px;">SHOWCASE</h3>


					<div id="searchFounderHub" class="searchTradingHub none">
						<form action="search-founders.php" accept-charset="utf-8" >
	
						Find Founders in 
						
						<select name="searchsector" id="searchsector">
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

						<select name="searchProduct" id="searchProduct">
							<option value="0">All Product / Services</option>
						</select>

						<select name="searchnetworkarea" id="searchnetworkarea">
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
									<?php echo $rowstat->stateName; ?></option>
						
							<?php } ?>
						</select>

						<?php  

						// tracking session
						if (!isset($usr_email)) {

						?>
						
						Register to explore

						<?php } else { ?>

						<input type="submit" name="searchNetwork" id="searchNetwork" value="Search Network" />

						<?php } ?>

					</form>
					</div><!-- /searchTradingHub -->


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
					  mj_fund_post.fund_post_published = 1 And
					  mj_fund_post.fund_post_success = 0 And
					  mj_fund_post.fund_post_failed = 0
					ORDER BY RAND()
					LIMIT 0, 4";

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
				 	<ul>


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

				 </div>

				<!-- /view -->
				</div>

			</div><!-- /contentContainer -->

		</div><!-- /content -->
<input type="hidden" name="page_title" value="Home" id="page_title" />

<script>
$(document).ready(function(){

	/*$('#intervalStream').load('ajax/ajax-landing-stream.php');
    
   function test () {
   		console.log('RUN');
   		$('#intervalStream').load('ajax/ajax-landing-stream.php');
   		//$('#ImgOne').fadeOut(4000).fadeIn(4000);
   }

   var refreshId = setInterval(test, 5000);*/


   /* vertical ticker */
	$('#intervalStream').totemticker({
		row_height	:	'85px',
	});
   /*-------------------------------------------------------------------*/



   /* tipsy */
	$('.idea-new-ui').find('li img').tipsy({gravity: 's'});

	$('.book-ui').find('li img').tipsy({gravity: 's'});

	$('.ideaMisc').find('div .ic_attachment_grey').tipsy({gravity: 's'});




	/* Change services */
	$('#searchsector').change(function(){

		var sectorID = $(this).val();
	

		$('#searchProduct').load('ajax/ajax-selectsector.php?sectorid='+sectorID);
		console.log(sectorID);
		

	});


});
</script>
<?php  

/* Include header */
include 'footer.php';

?>