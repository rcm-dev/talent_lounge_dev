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
$pro_id_view	=	(int) sqlInjectString($_GET['id']);
// Get project id by parameter
$qProDetails = "SELECT
  jp_ex_category.ex_cat_name As projCatName,
  mj_users.*,
 
  jp_exhibition.ex_name As proTitle,
  jp_exhibition.ex_desc As BriefIdea,
 
  
  
  jp_exhibition.ex_poster As proImg,
  -- jp_exhibition.ex_video As proVid,
  jp_exhibition.ex_id,
  jp_exhibition.ex_date As projDate,
  jp_exhibition.ex_cat_id_fk As projCatId,
  jp_exhibition.remark as remark,
  jp_exhibition.ex_usr_id_fk As proByID,
  jp_exhibition.publish
  
From
  jp_exhibition Inner Join
  mj_users On jp_exhibition.ex_usr_id_fk = mj_users.usr_id Inner Join
  jp_ex_category On jp_exhibition.ex_cat_id_fk = jp_ex_category.ex_cat_id
Where
  jp_exhibition.ex_id = '$pro_id_view'";

$rqProDetails   = mysql_query($qProDetails);
$rowqProDetails = mysql_fetch_object($rqProDetails);

$ownerProjectID = $rowqProDetails->proByID;


if ($rowqProDetails->fund_post_published != 0) {
	
	$plusOneView = mysql_query("UPDATE mj_fund_post SET fund_view = fund_view+1 WHERE fund_post_id = '$pro_id_view'");

}

?>


<div id="content" class="<?php if(!isset($_SESSION['usr_id'])) { echo "topfix"; } ?>">

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
				by <a href="users.php?uid=<?php echo $rowqProDetails->proByID; ?>" title="<?php echo ucfirst($rowqProDetails->usr_name); ?>" id="quickuser" data-hovercard="<?php echo $rowqProDetails->proByID; ?>"><strong><?php echo ucfirst($rowqProDetails->usr_name); ?></strong></a> &middot; <?php echo $rowqProDetails->projDate; ?> &middot; in <a href="funding-category.php?id=<?php echo $rowqProDetails->projCatId; ?>" title=""><strong><?php echo ucwords($rowqProDetails->projCatName); ?></strong></a>
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

				<div class="details-container" style="border:0px solid red; margin:30px 0px 0px 0px;">
					
					<div class="left-side" style="border:0px solid red; width:620px">

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
								  jp_ex_media.jx_path,
								  jp_ex_media.jx_id_fk,
								  jp_ex_media.jx_type
								From
								  jp_ex_media
								Where
								  jp_ex_media.jx_id_fk = '$pro_id_view' And
								  jp_ex_media.jx_type = 1";
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
									  			<a href="<?php echo $rowQMPP->jx_path; ?>" rel="groupProjPictures">
									  				<div style="background-image: url('<?php echo $rowQMPP->jx_path; ?>'); background-size: auto 100%; background-position: center center; background-repeat: no-repeat; width:100px; height:100px;">
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
								  jp_ex_media.jx_path,
								  jp_ex_media.jx_id_fk,
								  jp_ex_media.jx_type
								From
								  jp_ex_media
								Where
								  jp_ex_media.jx_id_fk = '$pro_id_view' And
								  jp_ex_media.jx_type = 2";
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
												  <source src="<?php echo $rowQMPV->jx_path; ?>" type='video/mp4'>
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
							<p><strong>ABOUT THIS BAND</strong></p>
							<p class="margin-bottom:10px"><?php echo $rowqProDetails->remark; ?><br>

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

						<div id="registerAlert" style="padding:10px 0px;">
							
						</div><!-- /registerAlert -->

						</div>
					</div>


					<div class="right-side bottomshadow">
						<div class="top-right">
							<?php  
							/**
							 * 
							 * Total Baker Pledged
							 */
							$totalBaker = "SELECT
							  mj_fund_pledged.*,
							  mj_fund_post.fund_post_title,
							  COUNT(mj_fund_pledged.fund_post_id_fk) As totalBaker,
							  mj_fund_pledged.fund_post_id_fk As fund_post_id_fk1
							From
							  mj_fund_pledged Inner Join
							  mj_fund_post On mj_fund_pledged.fund_post_id_fk = mj_fund_post.fund_post_id
							Where
							  mj_fund_pledged.fund_post_id_fk = '$pro_id_view'";
							 
							 $rtotalBaker = mysql_query($totalBaker);
							 $rowtotalBaker = mysql_fetch_object($rtotalBaker);

							?>
							<?php if ($rowtotalBaker->totalBaker == NULL){ ?>
								<h1 class="pnum">0</h1>
							<?php } else { ?>
								<h1 class="pnum"><?php echo $rowtotalBaker->totalBaker; ?></h1>
							<?php } ?>
							<strong>VOTER(S)</strong><br/><br/>

							<?php  
							/**
							 * 
							 * PLEDGED
							 */
							$totalPledged = "SELECT
							  mj_fund_pledged.*,
							  mj_fund_post.fund_post_title,
							  Sum(mj_fund_pledged.fund_money) As totalFunded,
							  mj_fund_pledged.fund_post_id_fk As fund_post_id_fk1
							From
							  mj_fund_pledged Inner Join
							  mj_fund_post On mj_fund_pledged.fund_post_id_fk = mj_fund_post.fund_post_id
							Where
							  mj_fund_pledged.fund_post_id_fk = '$pro_id_view'";
							 $rtotalPledged = mysql_query($totalPledged);
							 $rowtotalPledged = mysql_fetch_object($rtotalPledged);

							?>
							<h1 class="pnum"><?php echo number_format($rowtotalPledged->totalFunded); ?></h1>
							<strong>Target Voted (<?php echo number_format($rowqProDetails->proBudget); ?>)</strong><br/><br/>

							<?php  
							/**
							 * Days left
							 */
							 $qDayLeft = "SELECT DATEDIFF( fund_post_ended, NOW( ) ) AS DAYLEFT FROM mj_fund_post WHERE fund_post_id = '$pro_id_view' LIMIT 0 , 1";
							 $rqDayLeft = mysql_query($qDayLeft);
							 $rowqDayLeft = mysql_fetch_object($rqDayLeft);
							?>
							<h1 class="pnum"><?php echo $rowqDayLeft->DAYLEFT; ?></h1>
							<strong>DAYS TO GO</strong><br/><br/>
						</div>

						<div class="fundingmention">
						<p>THIS SHOWCASE WILL ONLY BE FEATURED IF AT 
						LEAST <strong><?php echo number_format($rowqProDetails->proBudget); ?></strong> IS VOTED BY <strong><?php echo date("d/m/Y", strtotime($rowqProDetails->fund_post_ended1)); ?></strong>.</p>
						</div>


						<?php  

						// ==================================================================
						//
						// Checking if curr user equal to owner of the project
						//
						// ------------------------------------------------------------------
						if ($ownerProjectID == $usr_id) { ?>
						
						<div style="text-align:center" id="pledgeThis">
							<a href="#" class="large button grey" onClick="return false">You is the owner of this project<br/>
							</a>
						</div>
						
						<?php 

						}
						else {
							// display pledge button
						?>

						<div style="text-align:center" id="pledgeThis">
							<a href="pledge-project.php?id=<?php echo $pro_id_view; ?>" class="large button green">PLEDGE THIS PROJECT<br/>
							<small>MINIMUM 25% OF AMOUNT PLEDGED</small></a>
						</div>
<div style="text-align:center; text-decoration:underline; font-size:11px;"><a href="#">Rules &amp; Regulations</a></div>

						<?php

						}

						?>

						<div id="pledgeAlert">
							
						</div><!-- /registerAlert -->
					</div>
					<div class="clear"></div>
				</div>

				<!-- /view -->

	</div><!-- /contentContainer -->

</div><!-- /content -->


<div class="none">
	<div id="sendDirectMessageContainer" style="width: 400px; height: 300px;">
		<form action="#" method="POST" accept-charset="utf-8">
			<table>
					<tr>
						<td>To</td>
						<td>:</td>
						<td><strong><?php echo ucfirst($rowqProDetails->usr_name); ?></strong></td>
					</tr>
					<tr>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td>Message</td>
						<td>:</td>
						<td>
							<textarea id="directMessageBody" name="directMessageBody" cols="30" rows="10"></textarea>
							<input type="hidden" name="toUserID" id="toUserID" value="<?php echo $rowqProDetails->proByID; ?>">
							<input type="hidden" name="bySenderID" id="bySenderID" value="<?php echo $usr_id; ?>">
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="submit" class="green button" id="directMessageSend" name="directMessageSend" value="Send Message" /></td>
					</tr>			
			</table>
		</form>
	</div>
</div><!-- / -->

<!-- Page Title -->
<input type="hidden" name="page_title" value="<?php echo $rowqProDetails->proTitle; ?>" id="page_title" />


<script type="text/javascript">
$(document).ready(function(){

	$('#sendDirectMessage').fancybox();

	$('#directMessageSend').click(function(){

		var msgBody = $('#directMessageBody').val();
		var msgTo   = $('#toUserID').val();
		var msgBy   = $('#bySenderID').val();

		if (msgBody == '') {
			$.jnotify("Enter your message!", "error");
		}
		else {

			var dataStringMsg = 'messageto='+msgTo+'&messageby='+msgBy+'&sendmessagebody='+msgBody;

			$.ajax({
				url: "ajax/send-message.php",
				type: "POST",
				data: dataStringMsg,

				success:function(html){

					if (html == 1) {
						$.jnotify("Message Has been Send");	
						var msgBody = $('#directMessageBody').val("");					
					}
					else {
						$.jnotify("SQL Error", "error");
					}
					
				}

			});
			console.log(dataStringMsg);
		}

		return false;
	});

	

	// Accordian
	$( "#accordion" ).accordion({

			collapsible: true

	});



	// --------------------------------------------------------------------------

	var ratYes = $('#ratYes');
	var ratNo  = $('#ratNo');

	$('ratingform')
	$('#thanksinfo')


	// rating yes
	ratYes.click(function(){

		var pro_id_view = $('#pro_id_view').val();
		var ratTrue   = 1;
		
		//alert('clicked Yes');
		var dataString = 'articleId=' + pro_id_view + '&ratYes=' + ratTrue;

		//alert(dataString);

		$.ajax({
			
				type: 	"POST",
				url: 	"ajax/ajax-rate-funding.php",
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
		
		var pro_id_view = $('#pro_id_view').val();
		var ratTrue   = 0;
		
		//alert('clicked Yes');
		var dataString = 'articleId=' + pro_id_view + '&ratYes=' + ratTrue;

		//alert(dataString);

		$.ajax({
			
				type: 	"POST",
				url: 	"ajax/ajax-rate-funding.php",
				data: 	dataString,

				success: function(){
					
					//alert('Success');
					$('#thanksinfo').fadeIn('slow');
					$('form#ratingForm').hide();

				}

			});

		return false;

	});


	// --------------------------------------------------------------------------




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
			$.jnotify("Enter Your comment.", "error");
		
		} else {
			
			$('#loadcom').show();
			$('#loadcom').fadeIn(400);


			$.ajax({
				
				type: "POST",
				url: "ajax/ajax-projectsubmitcomment.php",
				data: dataCom,
				cache: false,

				success: function(html){
					//$('div.flash.success').fadeOut(200).show();
					//$('div.flash.success').delay(3000).fadeOut('slow');
					$.jnotify("Successful submitted");

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



	/* Tracking email session */
	var currEmailSession = $('#currEmailSession').val();
	console.log('Current Email : '+currEmailSession);

	if (currEmailSession == '') {

		$('#askQ a').addClass('none');
		$('.ratingSys').addClass('none');
		$('#commentContribute').addClass('none');
		$('#pledgeThis').addClass('none');

		$('#askQ').html('Register or login');
		$('#registerAlert, #pledgeAlert').html('Register or Login to vote this showcase.');
	}




	/* fundind media tab */
	$("#usual1 ul").idTabs(); 


	/* fancybox */
	$('#projCoverImg').fancybox();

	$("a[rel=groupProjPictures]").fancybox({

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition' 	: 'over',

		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

			return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

		}

	});


});
</script>
<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>