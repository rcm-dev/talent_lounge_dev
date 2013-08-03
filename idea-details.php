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
$pro_id_view	=	(int) sqlInjectString($_GET['id']);


$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_last_login As setLastlogin,
  mj_users.usr_email As setemail,
  mj_users.usr_id As currID,
  mj_users.usr_name As currName,
  mj_users.usr_workat As WorkAt,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo,
  mj_users.usr_rating,
  mj_users.usr_core_activity,
  mj_users.mj_sector_fk,
  mj_users.mj_services_fk,
  mj_sector.sec_name,
  mj_services.services_name,
  mj_state.state_name,
  mj_country.country_name
From
  mj_users Inner Join
  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id Inner Join
  mj_country On mj_users.mj_country_id_fk = mj_country.country_id
Where
  mj_users.usr_id = '$get_user_id'";

$rusrSQL = mysql_query($usrSQL);
$rowviewusrSQL = mysql_fetch_object($rusrSQL);



$qProDetails = "SELECT
  mj_fund_category.fund_cat_name As projCatName,
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

$ownerProjectID = $rowqProDetails->proByID;


if ($rowqProDetails->fund_post_published != 0) {
	
	$plusOneView = mysql_query("UPDATE mj_fund_post SET fund_view = fund_view+1 WHERE fund_post_id = '$pro_id_view'");

}

?>
<div id="filterSection">
	<div class="center" style="padding:2px 0px">
		<div style="padding-left: 8px;">
			<form action="ajaxshowcase.php" method="get" name="groupFiltering">
				
    					Filter by Industry
						<select name="industry" class="query_company" id="query_company">
							<?php  
							/**
							 * SHOW AREA
							 */
							$qSec 	= "SELECT
							  mj_sector.sec_name As secName,
							  mj_sector.sec_id As secId
							From
							  mj_sector";
							$rqSec	= mysql_query($qSec);

							echo '<option value="0" style="background:#ddd;">All Industry</option>';
							while ($rowqSec = mysql_fetch_object($rqSec)) {
			
							?>
							<option value="<?php echo $rowqSec->secId; ?>"><?php echo $rowqSec->secName; ?>
							</option>
							<?php } ?>
						</select>

						Location
						<select name="location" class="query_area" id="query_area">
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

							echo '<option value="0" style="background:#ddd;">All Location</option>';
							while ($rowqArea = mysql_fetch_object($rqArea)) {
			
							?>
							<option value="<?php echo $rowqArea->sId; ?>"><?php echo $rowqArea->sArea; ?>
							</option>
							<?php } ?>
						</select>
						
						<!-- Status
						<select name="status" class="query_status" id="query_status">
						<!-- 	<?php  
							/**
							 * SHOW AREA
							 */
							$qArea 	= "SELECT
							  mj_state.state_id As sId,
							  mj_state.state_name As sArea
							From
							  mj_state";
							$rqArea	= mysql_query($qArea);

							echo '<option value="0" style="background:#ddd;">All Location</option>';
							while ($rowqArea = mysql_fetch_object($rqArea)) {
			
							?>
							<option value="<?php echo $rowqArea->sId; ?>"><?php echo $rowqArea->sArea; ?>
							</option>
							<?php } ?> 
						</select>-->



						Profession
						<select name="profession" class="query_service" id="query_service">
							<?php  
							/**
							 * SHOW AREA
							 */
							$qService 	= "SELECT
							  mj_services.services_id As serviceId,
							  mj_services.services_name As serviceName
							From
							  mj_services";
							$rqService	= mysql_query($qService);

							echo '<option value="0" style="background:#ddd;">All Profession</option>';
							while ($rowqService = mysql_fetch_object($rqService)) {
			
							?>
							<option value="<?php echo $rowqService->serviceId; ?>"><?php echo $rowqService->serviceName; ?>
							</option>
							<?php } ?>
						</select>
						<!-- <input type="hidden" name="sp" value="DESC"> -->

						
						<!-- <input type="text" name="prod_search" class="title" placeholder="keywords.."/> -->


						<input name="submitGeneral" type="submit" id="Check" value="Search">
					</form>
		</div>
	</div>
</div>

<div id="content">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer">
		<div class="heading none">
			<h1 class="title" style="text-align:left"><?php echo $rowqProDetails->fund_post_title; ?></h1>
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
				<h1 class="markettitle bebasTitle" style="text-align:left">Showcase : <?php echo ucwords($rowqProDetails->proTitle); ?></h1>
				by <a href="users.php?uid=<?php echo $rowqProDetails->proByID; ?>" title="<?php echo ucfirst($rowqProDetails->usr_name); ?>" id="quickuser" data-hovercard="<?php echo $rowqProDetails->proByID; ?>"><strong><?php echo ucfirst($rowqProDetails->usr_name); ?></strong></a> &middot; <?php echo $rowqProDetails->projDate; ?> &middot; in <a href="browse-idea-category.php?id=<?php echo $rowqProDetails->projCatId; ?>" title=""><strong><?php echo ucwords($rowqProDetails->projCatName); ?></strong></a>
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

			<div class="home_box">

				<!-- View -->

				<div class="details-container" style="border:0px solid #eee; margin:30px 0px 0px 0px;">
					
					<div class="left-side" style="border:1px solid #eee; width:620px">

						<div>
							<div id="usual1" class="usual" style="margin:0px !important;"> 
							  <ul> 
							    <li><a href="#tab1" class="selected"><span class="image_color">Showcase Cover</span></a></li> 
							    <li><a href="#tab2"><span class="pictures_stack_color">More pictures</span></a></li> 
							    <li><a href="#tab3"><span class="film_color">Video</span></a></li> 
							  </ul> 
							  <div id="tab1" style="display: block; ">
							  	<a href="<?php echo $rowqProDetails->proImg; ?>" id="projCoverImg">
							  		<img src="<?php echo $rowqProDetails->proImg; ?>" width="600" />
							  	</a>
							  </div><!-- /tab1 -->
							  <div id="tab2" style="display: none; ">
							  	<?php  

							  	$queryMoreProjPicture = "SELECT
								  mj_fund_media.mfm_path,
								  mj_fund_media.mfm_id_fk,
								  mj_fund_media.mfm_type
								From
								  mj_fund_media
								Where
								  mj_fund_media.mfm_id_fk = '$pro_id_view' And
								  mj_fund_media.mfm_type = 1";
								$rQMPP = mysql_query($queryMoreProjPicture);
								$numrowQMPP = mysql_num_rows($rQMPP);

							
							  	?>
							  	<ul class="morePicture">
							  		<?php  

							  		// if no picture
							  		if ($numrowQMPP == 0) {
										echo "No more picture.";
									}
									else {

										while($rowQMPP = mysql_fetch_object($rQMPP)){
							  		?>
									  		<li>
									  			<a href="<?php echo $rowQMPP->mfm_path; ?>" rel="groupProjPictures">
									  				<div style="background-image: url('<?php echo $rowQMPP->mfm_path; ?>'); background-size: auto 100%; background-position: center center; background-repeat: no-repeat; width:100px; height:100px;">
					  								</div>
									  			</a>
									  		</li>

							  		<?php 	} 

							  			}
							  		?>
							  		<div class="clear"></div>
							  	</ul><!-- / -->
							  </div><!-- /tab2 -->
							  <div id="tab3" style="display: none; ">
							  	<?php  

							  	// load video
							  	$queryMoreProjVid = "SELECT
								  mj_fund_media.mfm_path,
								  mj_fund_media.mfm_id_fk,
								  mj_fund_media.mfm_type
								From
								  mj_fund_media
								Where
								  mj_fund_media.mfm_id_fk = '$pro_id_view' And
								  mj_fund_media.mfm_type = 2";
								$rQMPV = mysql_query($queryMoreProjVid);
								$numrowQMPV = mysql_num_rows($rQMPV);

							
							  	?>
							  	<ul class="morePicture">
							  		<?php  

							  		// if no picture
							  		if ($numrowQMPV == 0) {
										echo "No Video has been submited.";
									}
									else {

										while($rowQMPV = mysql_fetch_object($rQMPV)){
							  		?>
									  		<li>
									  			<video id="my_video_1" class="video-js vjs-default-skin" controls
												  preload="auto" width="580" height="325" poster=""
												  data-setup="{}">
												  <source src="<?php echo $rowQMPV->mfm_path; ?>" type='video/mp4'>
												</video>
									  		</li>

							  		<?php 	} 

							  			}
							  		?>
							  		<div class="clear"></div>
							  	</ul><!-- / -->
							  </div><!-- /tab3 -->
							  <p>
							  	<!-- AddThis Button BEGIN -->
<!-- <div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f71fdd861498289"></script> -->
<!-- AddThis Button END -->
							  </p>
							</div>
						</div>

						<div class="proj-details">

							<p><strong>ABOUT THIS SHOWCASE</strong></p>
							<p class="margin-bottom:10px"><?php echo $rowqProDetails->BriefIdea; ?><br>

								<br>
								<strong>Showcase Description</strong>
								<br>
								<p><?php echo $rowqProDetails->bModel; ?></p>

								<br></p>
							<div id="accordion" style="display:none">
							<h3><a href="#">Business Model & Commercial Viability</a></h3>
							<div>
								<p><?php echo $rowqProDetails->bModel; ?></p>
							</div>
							<h3><a href="#">Customer & Market</a></h3>
							<div>
								<p><?php echo $rowqProDetails->cMarket; ?></p>
							</div>
							<h3><a href="#">Market Access & Timing</a></h3>
							<div>
								<p><?php echo $rowqProDetails->aTiming; ?></p>
								

							</div>
							<h3><a href="#">Economic trends</a></h3>
							<div>
								<p><?php echo $rowqProDetails->eTrend; ?></p>
								
							</div>
							<h3><a href="#">Technology Development & Innovation</a></h3>
							<div>
								<p><?php echo $rowqProDetails->tInno; ?></p>
								
							</div>
							<h3><a href="#">Intellectual Property & Regulation</a></h3>
							<div>
								<p><?php echo $rowqProDetails->ipRegular; ?></p>
								
							</div>
							<h3><a href="#">Stage of the Industry & Future Plans</a></h3>
							<div>
								<p><?php echo $rowqProDetails->fPlan; ?></p>
								
							</div>
							<h3><a href="#">Deliverables for Idea Development</a></h3>
							<div>
								<p><?php echo $rowqProDetails->IdeaDev; ?>
								</p>
								
							</div>
							<h3><a href="#">Size of Funding and Milestones</a></h3>
							<div>
								<p><?php echo $rowqProDetails->Milles; ?></p>
								
							</div>
							</div>
						</div>

						<br>
						<div class="proj-help" style="display:none">
							<div style="float:left; width:400px;"><strong>Need more information?</strong> If the info above doesn't help, you can ask the project creator directly.</div>
							<div id="askQ" style="float:right"><a href="#sendDirectMessageContainer" id="sendDirectMessage" class="large button blue">More Information</a></div>
							<div class="clear"></div>
						</div>

						<div class="ratingSys" style="margin-bottom: 20px;">
							<div>
								
								<form id="ratingForm" method="post">

								<input type="submit" class="button grey left" id="ratYes" name="ratYes" value="Like" /> &nbsp;&nbsp; 
								<input type="submit" style="margin-left:10px;" class="button grey left" name="ratNo" id="ratNo" value="Dislike" />
								<div class="clear"></div>

								<input type="hidden" value="<?php echo $pro_id_view; ?>" id="pro_id_view" />
								</form>
								</p>
								<div id="thanksinfo" class="info" style="display:none">Thanks You.</div>
							</div>
						</div>


						<div class="top-grid" style="border:0px solid red">

						
						<div>
							<ul id="comment-list" style="padding:0px; margin:0px;">
							<?php  
							/**
							 * Comment List
							 */
							 $sComment = "SELECT
							  mj_users.usr_name As comName,
							  mj_users.user_pic As usrPix,
							  mj_users.usr_id As usrGetId,
							  mj_fund_comment.fund_post_id_fk,
							  mj_fund_comment.fund_comment_body As comBody,
							  mj_fund_comment.fund_comment_date As comDate,
							  mj_fund_comment.fund_post_id_fk As fund_post_id_fk1
							From
							  mj_fund_comment Inner Join
							  mj_users On mj_fund_comment.fund_usr_id_fk = mj_users.usr_id
							Where
							  mj_fund_comment.fund_post_id_fk = '$pro_id_view'";

							 $rFComment = mysql_query($sComment);
							 $numrowFComment = mysql_num_rows($rFComment);

							 if ($numrowFComment == 0) {
							 	
							 	echo "<h3 style=display:none><strong>Be the 1st to comment</strong></h3>";

							 } else {

							 	echo '<h3><strong>'.$numrowFComment . ' Responses on '. $rowqProDetails->proTitle . '</strong></h3><br/><br/>';

							 	while ($rowFComment = mysql_fetch_object($rFComment)) {
							?>

								<li class="comment-box">
								<div class="com-container">
									<div class="usrPix">
										<a href="users.php?uid=<?php echo $rowFComment->usrGetId; ?>">
										<div class="profile-pic48">
										<img src="<?php echo $rowFComment->usrPix; ?>" width="48">
										</div>
										</a>
									</div>
									<div class="comtext" style="border:0px solid red; width:520px">
										<?php echo ucwords($rowFComment->comName); ?>,
										on <?php echo $rowFComment->comDate; ?> said:
										<br/>
										<p style="margin-top:10px;"><?php echo $rowFComment->comBody; ?></p>
									</div>
									<div class="clear"></div>
								</div>
								</li>

							<?php 

								} 
							}

							?>
							</ul>
							<div id="loadcom" style="display:none"><img src="images/ajax-loader.gif" /></div>
							<div class="flash error" style="display:none">Fill up the comment</div>
							<div class="flash success" style="display:none">Thank you!</div>
						</div>

						<?php if (isset($usr_email)): ?>
								
							
						<div id="commentContribute">
							<form method="post">
							<label><strong>Leave your comment</strong></label><br/>
							<textarea id="commentbody" name="commentbody" style="width:450px; height: 80px;"></textarea><br/>
							<input type="submit" name="submitComment" id="submitComment" value="Submit" class="button blue" />
							<input type="hidden" name="usr_id" id="usr_id" value="<?php echo $usr_id; ?>" />
							<input type="hidden" name="la_id_fk" id="la_id_fk" value="<?php echo $pro_id_view; ?>" />
							<div class="clear"></div>
							</form>
						</div>

						<?php endif ?>

						<div id="registerAlert" style="padding:10px 0px;">
							
						</div><!-- /registerAlert -->





						</div>
					</div>


			<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">

			<div id="BrowseIdeaMore" style="margin-top:10px">




 <?php $detail_view = $rowqProDetails->fund_post_id; ?>


<div id="topUsers" style="margin-top:20px;" class="ui-window">
			<strong class="heading_title_two bebasTitle">Detail</strong>

			<div id="listTopUsers" class="">
				<?php 

					$sDetailUser = "SELECT
					 mj_fund_post.*,
					 mj_users.usr_name As userName,
 					 mj_fund_post.fund_post_id,
					 mj_users.mj_sector_fk,
					 mj_users.mj_state_fk,
					
					 mj_users.usr_workat As workat,
					 mj_services.services_name As service,
					 mj_sector.sec_name As sector,
					 mj_state.state_name As state
					  
					From
					  mj_users Inner Join
					  mj_fund_post On mj_users.users_id = mj_fund_post.fund_usr_id_fk
					  Inner Join mj_services On mj_users.mj_services_fk = mj_services.services_id
					  Inner Join mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id
					  Inner Join mj_state On mj_users.mj_state_fk = mj_state.state_id
					Where
					  mj_fund_post.fund_usr_id_fk = '$ownerProjectID'";

					 $rIDetailUser = mysql_query($sDetailUser);
					 $rowIDetailUser = mysql_fetch_object($rIDetailUser);
					 $numrowIDetailUser = mysql_num_rows($rIDetailUser);




					 ?>

<table width="208">
						
						<tr>
							<td width="96">Name</td>
							<td width="12">:</td>
							<td width="84"><?php echo $rowIDetailUser->userName;?></td>

						</tr>
						<tr>
							<td>Career Status</td>
							<td>:</td>
							<!-- <td><?php echo $rowIDetailUser->status;?></td> -->
						 </tr>
							<tr><td>Industry</td>
								<td>:</td>
								<td><?php echo $rowIDetailUser->sector;?></td>
							</tr>
							<tr><td>Profession</td>
								<td>:</td>
								<td><?php echo $rowIDetailUser->service;?></td>

							</tr>
							<tr><td>Location</td>
								<td>:</td>
								<td><?php echo $rowIDetailUser->state;?></td>
						</tr>
					</table>

					<div id="" style="text-align:right; padding: 10px 0px; margin-top:15px;">
							<!-- <a href="public.php" title="Entrepreneur Library" style="float:right" class="public button green">Entrepreneur Library</a> -->
							<!-- <a href="#" title="associate" style="float:right" class="button green">ASSOCIATE</a> -->
							<div id="followFriendBtn" style="border:0px solid red; float: right;">
				<?php  

							// ==================================================================
							//
							// Displayuser profile
							//
							// ------------------------------------------------------------------
							
							$qAlreadyFriend = "SELECT
							  mj_usr_network.usr_network_friend_usr_id_fk,
							  mj_usr_network.usr_network_usr_id_fk,
							  mj_usr_network.usr_network_friend_usr_id_fk As isFriend,
							  mj_usr_network.usr_network_approved As isFriendStatus
							From
							  mj_usr_network
							Where
							  mj_usr_network.usr_network_usr_id_fk = '$usr_id' And
							  mj_usr_network.usr_network_friend_usr_id_fk = '$ownerProjectID'";
							
							$resultAlreadyFriend = mysql_query($qAlreadyFriend);
							$rowAlreadyFriend = mysql_fetch_object($resultAlreadyFriend);

							$numrowAlreadyFriend = mysql_num_rows($resultAlreadyFriend);
							

							if ($numrowAlreadyFriend == 1) { ?>
							
								<?php 

								$isFriend = $rowAlreadyFriend->isFriend; 

								if ($isFriend == $usr_id) { ?>

									

								<?php } else { ?>
									
									<?php if ($rowAlreadyFriend->isFriendStatus == 0) { ?>

										<div style="float:right" class="button green">Followed</div>
									   

									<?php } else { ?>

										<div style="float:right" class="button green">Waiting for Approved</div>

									<?php } ?>
									
								<?php } ?>


							<?php } else { ?>


								
									
									<?php if (!isset($usr_email)): ?>
										<a href="login.php" class="button green public">ASSOCIATE</a>
									<?php endif ?>

									<?php if (isset($usr_email)): ?>
									<a href="#" id="send-request-friend">
									<div style="float:right" class="button green">ASSOCIATE<?php echo $rowviewusrSQL->currName; ?></div>
									</a>
									<?php endif ?>

									<input type="hidden" name="getviewuserid" id="getviewuserid" value="<?php echo $ownerProjectID; ?>">

									<input type="hidden" name="currUsrId" id="currUsrId" value="<?php echo $usr_id; ?>">
									
							
							<?php } ?>
					</div>
				    </div><!-- /join network -->
				    <br/>



			</div><!-- /listTopUsers -->
		</div><!-- /topUsers -->

<div id="topUsers" style="margin-top:20px;" class="ui-window">
			<strong class="heading_title_two bebasTitle">Other Works</strong>

			<div id="listTopUsers" class="">
				<ul id="ULlistTopUsers" style="margin-top:10px;">
				<?php  

				$sqlTopUser = "SELECT * FROM mj_fund_post WHERE fund_usr_id_fk ='$ownerProjectID' And fund_post_id !='$detail_view' ORDER BY fund_post_id DESC LIMIT 5";

				$resultTopUser = mysql_query($sqlTopUser);

				while ($rowTopUser = mysql_fetch_object($resultTopUser)) { ?>
				
				<li>
					  <a href="idea-details.php?id=<?php echo $rowTopUser->fund_post_id; ?>" class="topListUserLI">
						<div class="profile-pic2" original-title="<?php echo $rowTopUser->fund_post_title; ?>" style="background-image:url('<?php echo $rowTopUser->fund_post_image; ?>');">
						</div><!-- /profile-pic48 -->
					</a>
					
				</li>

				<?php 

				}

				?>
				<div class="clear"></div>
				</ul><!-- /ULlistTopUsers -->
			</div><!-- /listTopUsers -->
		</div><!-- /topUsers -->


	<?php 

	$sec =$rowIDetailUser->mj_sector_fk;


	 ?>
<div id="topUsers" style="margin-top:20px;" class="ui-window">
			<strong class="heading_title_two bebasTitle">Related Works</strong>

			<div id="listTopUsers" class="">
				<ul id="ULlistTopUsers" style="margin-top:10px;">
				<?php  

				$sSectorUser = "SELECT
					 mj_fund_post.*,
					 mj_users.usr_name As userName,
					 mj_users.mj_sector_fk,
					 mj_users.mj_state_fk,
					 mj_fund_post.fund_post_image As pic,
					 mj_fund_post.fund_post_id
					  
					From
					  mj_users Inner Join
					  mj_fund_post On mj_users.users_id = mj_fund_post.fund_usr_id_fk
					  Inner Join mj_services On mj_users.mj_services_fk = mj_services.services_id
					  Inner Join mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id
					  Inner Join mj_state On mj_users.mj_state_fk = mj_state.state_id
					Where
					  mj_users.mj_sector_fk = '$sec' AND
					  mj_fund_post.fund_post_id !='$detail_view'";

					 $rISectorUser = mysql_query($sSectorUser);
					 
					 $numrowISectorUser = mysql_num_rows($rISectorUser);

				while ($rowISectorUser = mysql_fetch_object($rISectorUser)){ ?>
				
				<li>
					  <a href="idea-details.php?id=<?php echo $rowISectorUser->fund_post_id; ?>" class="topListUserLI">
						<div class="profile-pic2" original-title="<?php echo $rowISectorUser->fund_post_title; ?>" style="background-image:url('<?php echo $rowISectorUser->fund_post_image; ?>');">
						</div><!-- /profile-pic48 -->
					</a>
					
				</li>

				<?php 

				}

				?>
				<div class="clear"></div>
				</ul><!-- /ULlistTopUsers -->
			</div><!-- /listTopUsers -->
		</div><!-- /topUsers -->	




</div>



				
			</div>

			<div class="clear"></div>
		</div>
	</div>

	</div><!-- /contentContainer -->

</div><!-- /content -->
<input type="hidden" name="page_title" value="<?php echo ucwords($rowIdeaDetails->id_title); ?>" id="page_title" />

<!-- Ajax Browse -->
<script type="text/javascript">

$(document).ready(function(){
	$('#Check').click(function(){
    $('#searchResult3').hide();    

    var catID = $('#query_company').val();
    var stateID = $('#query_area').val();
    var serviceID = $('#query_service').val();


    var dataString = 'catID='+catID+'&stateID='+stateID+'&serviceID='+serviceID;

    console.log(dataString);


    $('#searchResult3').html('loading....').fadeIn().load('ajaxshowcaseList.php?'+dataString);
    // $("html, body").animate({ scrollTop: 0 }, "slow");

    return false;




    });    



	var ratYes = $('#ratYes');
	var ratNo  = $('#ratNo');

	$('ratingform')
	$('#thanksinfo')


	// rating yes
	ratYes.click(function(){

		var idea_id = $('#idea_id').val();
		var ratTrue   = 1;
		
		//alert('clicked Yes');
		var dataString = 'articleId=' + idea_id + '&ratYes=' + ratTrue;

		//alert(dataString);

		$.ajax({
			
				type: 	"POST",
				url: 	"ajax/ajax-rate-idea.php",
				data: 	dataString,

				success: function(){
					
					//alert('Success');
					$('#thanksinfo').fadeIn('slow');
					$('form#ratingForm').hide();

				}

			});

		return false;

	});


	// rating no
	ratNo.click(function(){
		
		var idea_id = $('#idea_id').val();
		var ratTrue   = 0;
		
		//alert('clicked Yes');
		var dataString = 'articleId=' + idea_id + '&ratYes=' + ratTrue;

		//alert(dataString);

		$.ajax({
			
				type: 	"POST",
				url: 	"ajax/ajax-rate-idea.php",
				data: 	dataString,

				success: function(){
					
					//alert('Success');
					$('#thanksinfo').fadeIn('slow');
					$('form#ratingForm').hide();

				}

			});

		return false;

	});

/* request friends */
	$('#send-request-friend').click(function(){
		
		var getuserviewid = $('#getviewuserid').val();
		var currUsrId	  = $('#currUsrId').val();

		$.ajax({
				
			type: "POST",
			url: "ajax/friend-requested.php",
			data: 'getuserviewid=' + getuserviewid + '&currUsrId=' + currUsrId,
			cache: false,

			success: function(html){

				var url_to_load = 'users.php?uid=';
				//$('#followFriendBtn').load(url_to_load+getuserviewid+ ' #followFriendBtn');
				$('#send-request-friend').hide();
				$('#followFriendBtn').fadeIn('slow').append(html);

				
				
			}

		});

	});


/* Unfriends */
	$('#unfriends').click(function(){
		
		var getuserviewid = $('#getviewuserid').val();
		var currUsrId	  = $('#currUsrId').val();

		$.ajax({
				
			type: "POST",
			url: "ajax/delete-friend.php",
			data: 'getuserviewid=' + getuserviewid + '&currUsrId=' + currUsrId,
			cache: false,

			success: function(html){

				var url_to_load = 'users.php?uid=';
				//$('#followFriendBtn').load(url_to_load+getuserviewid+ ' #followFriendBtn');
				$('#unfriends').hide();
				$('#followFriendBtn').fadeIn('slow').append(html);
				//console.log(url_to_load + 'DONE');
				
				console.log(url_to_load);
				
			}

		});

	});




	//--------------------------------------------------------------------------

	// Update comment ajax
	// submit comment
	$('input#submitComment').click(function(){
		

		var comUser = $('#commentbody').val();
		var usr_id  = $('#usr_id').val();
		var la_id_fk= $('#la_id_fk').val();
		var dataCom = 'commentbody=' + comUser + 
					  '&usr_id=' + usr_id +
					  '&la_id_fk=' + la_id_fk;

		
		if (comUser == '') {
			
			//$('div.flash.error').fadeOut(200).show();
			//$('div.flash.error').delay(3000).fadeOut('slow');
			$.jnotify("This is an \"error\" notification.", "error");
		} else {
			
			$('#loadcom').show();
			$('#loadcom').fadeIn(400);


			$.ajax({
				
				type: "POST",
				url: "ajax/ajax-ideasubmitcomment.php",
				data: dataCom,
				cache: false,

				success: function(html){
					$('div.flash.success').fadeOut(200).show();
					$('div.flash.success').delay(3000).fadeOut('slow');
					
					$('#commentbody').val("");

					$('ul#comment-list').append(html);
					$('ul#comment-list li:last').fadeIn("slow");
					$('#loadcom').hide();

					console.log(html);
				}

			});
		}

		//console.log(dataStringCom);
		return false;

	});

	$('#star').raty({
	  click: function(score, evt) {
	    alert('ID: ' + $(this).attr('id') + '\nscore: ' + score + '\nevent: ' + evt);
	  }
	});




	/* submit price */
	$('#ideapricesubmit').click(function(){


		var pricevalue = $('#ideaprice').val();

		if (pricevalue == '') {

			alert('Suggest your price!');

		} else {

			var datastring = $('form#priceform').serialize();
			var ideaid     = $('#ideaIdFK').val();

			$.ajax({

				url: 'ajax/ajax-submitprice.php',
				type: 'POST',
				data: datastring,

				success: function(html){

					$('#ideaprice').val("");
					$('#tblePrice').hide();
					$('#tblePrice2').append(html);


				}

			});
			console.log(datastring);

		}

		return false;

	});


	/* Tracking email session */
	var currEmailSession = $('#currEmailSession').val();
	console.log('Current Email : '+currEmailSession);

	if (currEmailSession == '') {
		$('#hmuwbi').addClass('none');
		$('#ideaContributeComment').addClass('none');
		$('#wybi').addClass('none');
		$('#registerAlert').html('Register or Login to contribute');
		$('#RecomIdea').addClass('none');
	}

	
});



	/* tab picture and video */
	$("#usual1 ul").idTabs();



	/* cover Fancy box */
	$('a#ideaCover').fancybox();

	/* Group fancybox */
	$("a[rel=groupIdeaPicture]").fancybox({

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition' 	: 'over',

		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

			return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

		}

	});


	$("a[rel=groupIdeaVideo]").fancybox({

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition' 	: 'over',

		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

			return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

		}

	});



</script>
<!-- /Ajax Browse -->
<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>