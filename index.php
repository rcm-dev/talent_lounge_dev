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
<div id="landingMain" class="frontLanding" style="display:none">
	<div id="landingContainer" class="" style="display:none">

		<ul class="cb-slideshow">
            <li><span>Image 01</span><div><h3>Personal Branding</h3></div></li>
            <li><span>Image 02</span><div><h3>Strengths</h3></div></li>
            <li><span>Image 03</span><div><h3>Talent</h3></div></li>
            <li><span>Image 04</span><div><h3>Personalization</h3></div></li>
            <li><span>Image 05</span><div><h3>Passion</h3></div></li>
            <li><span>Image 06</span><div><h3>Skill Training</h3></div></li>
        </ul>

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


		<div id="content" style="margin-top:0px !important; display: none">

			
			<div id="contentContainer" class="">

				<div class="ui-window left" style="width:450px; display:none">
					<h3 class="heading_title_two bebasTitle">Interview Session</h3>

					<?php  

					/****************************
					 *
					 * Record Set for DisplayInterview 
					 * MySQL Info 
					 * Table Used DisplayInterview
					 *
					 ***************************/
					
					$query_rsDisplayInterview = "SELECT status_booking.*, jp_employer.*, room.*, time_detail.*
													FROM status_booking 
													INNER JOIN jp_employer
													ON status_booking.employer_id_fk = jp_employer.users_id_fk 
													INNER JOIN room
													ON status_booking.booking_room_type = room.room_id
													INNER JOIN time_detail
													ON status_booking.time_booking = time_detail.time_id
													WHERE status_booking.status = 1";
					$result_rsDisplayInterview = mysql_query($query_rsDisplayInterview);
					$total_rows_rsDisplayInterview = mysql_num_rows($result_rsDisplayInterview);
					
					?>
					<?php while ($row_rsDisplayInterview = mysql_fetch_object($result_rsDisplayInterview)) { ?>
						
						<table>
							<tr>
								<td width="60px">
									<img src="recruitment/media/employer/img/<?php echo $row_rsDisplayInterview->emp_pic ?>" alt="<?php echo $row_rsDisplayInterview->emp_pic ?>" style="max-width:60px; margin-right:10px;">
								</td>
								<td>
									<strong><?php echo $row_rsDisplayInterview->emp_name; ?></strong><br>
									<strong>Room:</strong> <?php echo $row_rsDisplayInterview->room_type_name; ?><br>
									<strong>Time:</strong> <?php echo $row_rsDisplayInterview->time_name; ?> &middot; <strong>No of Participant:</strong> <?php echo $row_rsDisplayInterview->no_of_part; ?>
								</td>
							</tr>
						</table>

					<?php } ?>
				</div>

				<div class="right ui-window" style="width:450px; display:none">
					<h3 class="heading_title_two bebasTitle">Events</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, aliquam sequi tenetur ducimus accusamus placeat reiciendis excepturi in. Unde ullam officiis ab ex rem sit error consectetur sed distinctio! Eaque.</p>
				</div>
				<div class="clear"></div>


				<!-- Slider -->
				<br>
				<br>
				<br>
				<br>
				<br>
				<div style="display:none">
					<iframe src="landingSlider/index.php" frameborder="0" width="1000px" height="600px"></iframe>
				</div>
				<!-- Slider -->


				<div style="padding-bottom:50px; display: none">
					<div style="float:left; width: 450px;">
						<h2 class="bebasTitle">Testimonial</h2>
					</div>

					<div style="float:right; width: 500px;">
						<h2 class="bebasTitle">Featured Employer</h2>
					</div>

					<div style="clear:both"></div>
	
					<div>
						<br><br>
						<h2 class="bebasTitle">Featured Jobseeker</h2>
					</div>
				</div>


				<div id="cnshare" style="padding-top: 30px; margin-bottom:30px; display:none">
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

				<div id="relatedhub" style="margin-top: 150px; display:none">

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



				<div id="happening" style="margin-top: 60px; padding-top: 100px; border-top:0px dotted #d1d1d1; display:none">
					
					<div>

					<h3 style="margin-left: 20px;" class="ic_favorite-black32 heading_title_two bebasTitle">FREELANCER</h3>

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


				

			</div><!-- /contentContainer -->

		</div><!-- /content -->


<div id="bgSliderFront" style="display:none">
	<div class="center">
		<div class="flexslider">
		  <ul class="slides">
		    <li>
		      <a href="funding.php"><img src="images/1.png" /></a>
		    </li>
		    <li>
		      <a href="entrepreneur-library.php"><img src="images/2.png" /></a>
		    </li>
		    <li>
		      <a href="search-market.php?sp=DESC"><img src="images/3.png" /></a>
		    </li>
		    <li>
		      <a href="login.php" class="public"><img src="images/5.png" /></a>
		    </li>
		  </ul>
		</div>
	</div>
</div>


<!-- new footer addon -->
<div id="footer-features" style="display:none">
	<div class="center" style="padding: 20px 0px; text-align: center">
		<h1 style="color: black"><strong>How do we match you with the right job?</strong></h1><br>
		<p>Technology + Knowledge = Matching</p>
		<br><br>
		<ul id="featured_lists">
			<li>
				<img src="images/talent.png" alt="Talent">
				<div>
					<table>
						<tr>
							<td width="70" height="80" valign="middle" align="center">
								<img src="images/done.png" alt="OK">
							</td>
							<td align="left" valign="middle">
								<h2><strong>Talent</strong></h2>
								<p>Discover your strenght</p>
							</td>
						</tr>
					</table>
				</div>
			</li>
			<li>
				<img src="images/job.png" alt="job">
				<div>
					<table>
						<tr>
							<td width="70" height="80" valign="middle" align="center">
								<img src="images/done.png" alt="OK">
							</td>
							<td align="left" valign="middle">
								<h2><strong>Job</strong></h2>
								<p>Our technology matches your <br/>strength to the suitable job roles</p>
							</td>
						</tr>
					</table>
				</div>
			</li>
			<li>
				<img src="images/time.png" alt="time">
				<div>
					<table>
						<tr>
							<td width="70" height="80" valign="middle" align="center">
								<img src="images/done.png" alt="OK">
							</td>
							<td align="left" valign="middle">
								<h2><strong>Time</strong></h2>
								<p>See your network @friends <br/>help your career path</p>
							</td>
						</tr>
					</table>
				</div>
			</li>
		</ul>
		<br><br><br><br>

			<h1 style="color: black"><strong>Jobseeker, jobs you may apply</strong></h1><br>
			<p>Most job picked by editor</p>
			<br><br>
			<?php  

			/****************************
			 *
			 * Record Set for JobLists 
			 * MySQL Info 
			 * Table Used JobLists
			 *
			 ***************************/
			
			$query_rsJobLists = "SELECT jp_ads.*, jp_location.*, jp_employer.* FROM jp_ads INNER JOIN jp_location ON jp_ads.ads_location = jp_location.location_id INNER JOIN jp_employer ON jp_ads.emp_id_fk = jp_employer.emp_id WHERE jp_ads.ads_enable_view = 1 ORDER BY ads_date_posted DESC LIMIT 0, 4";
			$result_rsJobLists = mysql_query($query_rsJobLists);
			$total_rows_rsJobLists = mysql_num_rows($result_rsJobLists);

			?>
			<ul id="job-cards">
				<?php while ($row_rsJobLists = mysql_fetch_object($result_rsJobLists)) { ?>
					<li>
						<div>
							<div>
								<div class="glossy-pic"></div>
								<img src="recruitment/media/ads/<?php echo $row_rsJobLists->ads_pic; ?>" alt="<?php echo ucfirst($row_rsJobLists->ads_title) ?>">
							</div>
							<div class="jobs-close">
								Close Date: <strong><?php echo date('d-m-Y', strtotime($row_rsJobLists->ads_date_expired)); ?></strong>
							</div>
						</div>
						<div class="job-title">
							<h2><strong><?php echo ucfirst($row_rsJobLists->ads_title) ?></strong></h2>
							<p>
								MYR <?php echo $row_rsJobLists->ads_salary ?> &middot; <?php echo $row_rsJobLists->location_name ?>
							</p>
						</div>
						<div class="job-title" style="border-top:1px solid #eaeaea">
							<table style="color:#7d7d7d; font-size:11px;" width="100%">
								<tr>
									<td><?php echo $row_rsJobLists->emp_name ?></td>
									<td align="right"><?php echo $row_rsJobLists->ads_view ?> Viewed</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2" align="center">
										<a href="recruitment/jobsAdsDetails.php?jobAdsId=<?php echo $row_rsJobLists->ads_id ?>" class="tl-btn-blue">Apply Now!</a>
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
							</table>
						</div>
					</li>
				<?php } ?>
			</ul>
	</div>
</div>
<!-- /new footer addon -->



<!-- new footer addon -->
<div id="footer-search" style="display:none">
	<div class="center" style="text-align: center">
		<h1 style="font-size: 28px; color: white; font-weight: normal;">Find the job you've been looking for</h1>
		<div style="width: 240px; margin: 0 auto; padding: 10px 0px; text-align: center">
			<form action="recruitment/jobAdsSearchResult.php">
				<table>
					<tr>
						<td>
							<input type="text" placeholder="Enter your dream job" name="q" style="width:200px; padding: 6px; font-size: 16px;">
						</td>
						<td>
							<input type="submit" value="Search Jobs" class="btn btn-info">
						</td>
					</tr>
				</table>
			</form>
			<!-- <a href="recruitment/browseByindustry.php">By Industry</a> &middot;  -->
			<!-- <a href="recruitment/browseBylocation.php">By Location</a> -->
		</div>
	</div>
</div>
<!-- /new footer addon -->



<!-- new footer addon -->
<div id="footer-employer" style="display:none">
	<div class="center" style="text-align: center">
		Don't miss these opportunities
		<h1 style="font-size: 28px; color: white;">Employers recruiting right now</h1>
		<ul id="list-companies-hired">
			<?php  

			/****************************
			 *
			 * Record Set for EmpLogo 
			 * MySQL Info 
			 * Table Used EmpLogo
			 *
			 ***************************/
			
			$query_rsEmpLogo = "SELECT * FROM jp_employer WHERE emp_pic != 'default_employ.png' ORDER BY RAND() LIMIT 10";
			$result_rsEmpLogo = mysql_query($query_rsEmpLogo);
			$total_rows_rsEmpLogo = mysql_num_rows($result_rsEmpLogo);
			
			if ($total_rows_rsEmpLogo != 0) {
				
				while ($row_rsEmpLogo = mysql_fetch_object($result_rsEmpLogo)) {
					
					echo "<li><img src='http://talentlounge.my/beta/recruitment/media/employer/img/".$row_rsEmpLogo->emp_pic."' alt='".$row_rsEmpLogo->emp_name."' width='80px'></li>";

				}

			}
			

			?>
		</ul>
	</div>
</div>
<!-- /new footer addon -->


<div id="filterSection">
	<div class="center" style="padding:2px 0px">
		<div style="padding-left: 8px;">
			Filter content by:
		</div>
	</div>
</div>

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


	$('.flexslider').flexslider({
	    animation: "fade"
	  });


});
</script>
<?php  

/* Include header */
include 'footer.php';

?>