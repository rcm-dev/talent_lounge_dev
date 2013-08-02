<?php  


include 'header.php';
include 'db/db-connect.php';

$qRandIdea		=	"SELECT
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
LIMIT 0, 18";

$rqRandIdea	=	mysql_query($qRandIdea);

//$rowqRandIdea = mysql_fetch_object($rqRandIdea);




?>

<div id="filterSection">
	<div class="center" style="padding:2px 0px">
		<div style="padding-left: 8px;">
			<form action="creative-idea.php" method="get" name="groupFiltering">
				
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
						<!-- <input type="text" name="prod_search" class="title" placeholder="keywords.."/> -->
						<input name="submitGeneral" type="submit" id="Check" value="Search">
					</form>
		</div>
	</div>
</div>

<div id="content">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer">

		<div class="heading">
			<h1 class="heading_title bebasTitle">TALENT DISCOVER SHOWCASE</h1>
		</div>

		<div class="cnscontainerPlain left">
   <div id="searchResult3" class="">

			<div id="inventcontent">

				<div style="padding: 30px 0px;">
						<ul class="idea-new-ui">
						<?php while ($rowqRandIdea = mysql_fetch_object($rqRandIdea)) { ?>
							
							<li>
								<div class="ideaContainer">
									<div class="ideaFrame">
										<div class="ideaFrameImage">
										<!-- <a class="call-inventcat" href="<?php //echo urlencode($rowqRandIdea->ideaTitle); ?>-idea-<?php// echo $rowqRandIdea->picId; ?>.html" rel="<?php //echo $rowqRandIdea->picId; ?>"> -->
										<a class="call-inventcat" href="idea-details.php?id=<?php echo $rowqRandIdea->proId; ?>" rel="<?php echo $rowqRandIdea->proImg; ?>">

											<img src="<?php echo $rowqRandIdea->proImg; ?>" width="100%" original-title="<?php echo $rowqRandIdea->proTitle; ?>">
										</a>
										</div>
										<div id="idMis" class="ideaMisc">
											<div class="left multimedia">
												<img src="images/icon_grey/ic_attachment.png" original-title="Multimedia Included" alt="Multimedia"  height="14" width="14">
											</div><!-- /attach -->
											<div class="right comment">
												<span>
													<img src="images/icon_grey/ic_chats.png" style="margin-top:2px; margin-left:-20px; position:absolute"  original-title="Comments"/>
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
											<div class="right like" style="margin-right:20px">
												<span>
													<img src="images/icon_grey/ic_favorite.png" style="margin-top:2px; margin-left:-20px; position:absolute"  original-title="Likes"/>
													<?php echo number_format($rowqRandIdea->ideaLove); ?></span>
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
				
				<div>
					<div class="idea-video none">
						<div class="idea-video-container">
						<a href="idea-details.php?id=<?php //echo $rowqRandIdea->picId; ?>"><img src="<?php //echo $rowqRandIdea->Picture; ?>"></a>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /cnscontainer -->
</div>
		<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">

			<div id="BrowseIdeaMore" style="margin-top:30px">
				<strong id="browseMore01" class="heading_title_two bebasTitle">Browse More</strong>
					<ul class="browseIdeaList" style="margin-top:20px;">
					<?php  


					/**
					 * 
					 * 
					 * 
					 * Browse idea sidebar
					 * Recent Submited
					 * Browse more
					 */

   

			$rcatIdea = "SELECT * FROM mj_fund_category ORDER BY fund_cat_name ASC";
						$qrIResult = mysql_query($rcatIdea);


					while ($rowqrI = mysql_fetch_object($qrIResult)) {
						
						$totalIdeainCat = "SELECT
						  Count(mj_fund_post.fund_post_id) As TotalIdea
						From
						  mj_fund_post
						Where
						  mj_fund_post.fund_cat_id_fk= '$rowqrI->fund_cat_id'";

						$resultTotalIdeainCat = mysql_query($totalIdeainCat);
						$rowTotalIdeainCat = mysql_fetch_object($resultTotalIdeainCat);

						$valueIdea = $rowTotalIdeainCat->TotalIdea;

						echo '<li><span class="miniCircle2">&nbsp;'.$valueIdea.'</span>
							<a href="browse-idea-category.php?id='.$rowqrI->fund_cat_id.'">'.ucwords($rowqrI->fund_cat_name).'</a>
						</li>';

					}

					?>
					</ul>
			</div><!-- /BrowseIdeaMore -->	

			<div style="margin-top:30px">
				<strong id="recomForYou" class="heading_title_two bebasTitle">Recommended for you</strong>

				<div style="margin-top:20px;">
					<?php  

					$recom		=	"SELECT
					  mj_fund_post.fund_post_image As Picture,
					  mj_fund_post.fund_post_id As picId,
					  mj_fund_post.fund_post_title As ideaTitle,
					  mj_fund_post.fund_post_short_brief,
					  mj_fund_post.fund_usr_id_fk As usrIdFK,
					  mj_users.usr_name As usrName,
					  mj_users.user_pic As usrPic,
					  mj_fund_post.fund_post_ratup As ideaLove
					From
					  mj_fund_post Inner Join
					  mj_users On mj_fund_post.fund_usr_id_fk = mj_users.usr_id
					Where
					  mj_fund_post.fund_post_published = 1
					Order By
					  RAND()
					Limit 3";

					$rrecom	=	mysql_query($recom);

					?>
					<ul id="side-creative">
						<?php while($rowrcom = mysql_fetch_object($rrecom)){ ?>
						<li>
							<div>
								<div class="featured_emplyed_lists left">
									<div>
										<a href="idea-details.php?id=<?php echo $rowrcom->picId; ?>" title="View this idea">
										<img src="<?php echo $rowrcom->Picture; ?>" width="60px" />
										</a>
									</div>
								</div><!-- /leftPic -->
								<div class="right" style="width:150px">
									
									<a href="idea-details.php?id=<?php echo $rowrcom->picId; ?>" title="View this idea">
									<strong style="color:#3F3FA0"><?php echo $rowrcom->ideaTitle; ?></strong>
								</div><!-- /left -->
								<div class="clear"></div><!-- /clear -->
							</div><!-- /container -->

							</li>
							<br/>
						<?php } ?>
					</ul><!-- /browseIdeaList -->
				</div><!-- /recommend -->
			</div><!-- recommend for you -->
		</div><!-- /orange right -->

		<div class="clear"></div>
	</div><!-- /contentContainer -->

</div><!-- /content -->

<!-- Page Title -->
<input type="hidden" name="page_title" value="Browse Creative Idea" id="page_title" />
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />


<!-- Tip Content -->
<ol id="joyRideTipContent">
  <li data-id="cs01" data-text="Next" class="custom">
    <h4>Current Submission</h4>
    <p>Browse current submission</p>
  </li>
  <li data-id="idMis" data-text="Next">
    <h4>Idea submission misc</h4>
    <p>Multimedia attachment, Like and comment total</p>
  </li>
  <li data-id="browseMore01" data-text="Next">
    <h4>Browse</h4>
    <p>Browse submission by category</p>
  </li>
  <li data-id="recomForYou" data-text="Close">
    <h4>Submission suitable for you</h4>
    <p>Random listed that suitable for you</p>
  </li>
</ol>

<?php 

// var tours
$section = 3;
include 'check_tours.php'; 

?>

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

	
	$('#star').raty({
	  click: function(score, evt) {
	    alert('ID: ' + $(this).attr('id') + '\nscore: ' + score + '\nevent: ' + evt);
	  }
	});


	/*-------------------------------------------------------------------*/
	/* Ajax Load */

	// Message Ajax Call
	$.ajaxSetup ({
		cache: false
	});

	var ajax_load = "<img src='images/ajax-loader.gif' alt='loading..' />";

	// Load invent cat function
	var inventcat_url	  = "ajax/ajax-inventcategory.php";
	$('#call-inventcat').click(function(){
		$('#inventcontent').html(ajax_load).load(inventcat_url);
	});

	// Load invent vote function
	var invote_url	  = "ajax/ajax-inventvote.php";
	$('#call-inventvote').click(function(){
		$('#inventcontent').html(ajax_load).load(invote_url);
	});

	// Load invent sub function
	var invsub_url	  = "ajax/ajax-inventsubmit.php";
	$('#call-inventsubmit').click(function(){
		$('#inventcontent').html(ajax_load).load(invsub_url);
	});


	/*-------------------------------------------------------------------*/




	/* tipsy */
	$('.idea-new-ui').find('li img').tipsy({gravity: 's'});

});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>