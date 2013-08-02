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
	mysql_real_escape_string(trim(htmlentities($seoname)));

	return $seoname;
}

$idea_cat_id = (int) sqlInjectString($_GET['id']);

$qRandIdea		=	"SELECT
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
					  mj_fund_post.fund_post_published = 1 And
  					  mj_fund_post.fund_cat_id_fk = '$idea_cat_id'";

$rqRandIdea	   =	mysql_query($qRandIdea);
$numrowIdeaCat = 	mysql_num_rows($rqRandIdea);



// ==================================================================
//
// idea category
//
// ------------------------------------------------------------------

$ideaCat = "SELECT
  mj_fund_category.fund_cat_name As catIdeaName,
  mj_fund_category.fund_cat_id
From
  mj_fund_category
Where
  mj_fund_category.fund_cat_id = '$idea_cat_id'";

$rIdeaCat   = mysql_query($ideaCat);
$staticname = mysql_fetch_object($rIdeaCat);
//$rowqRandIdea = mysql_fetch_object($rqRandIdea);


?>

<div id="filterSection">
	<div class="center" style="padding:2px 0px">
		<div style="padding-left: 8px;">
			Filter content by:
		</div>
	</div>
</div>

<div id="content">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer">

		<div class="heading">
			<h1 class="heading_title bebasTitle">TALENT DISCOVER SHOWCASE</h1>
		</div>
<div id="searchTradingHub" class="searchTradingHub" style="margin: 40px 0px;">

					 <form action="creative-idea.php" method="get" name="groupFiltering">
				
    					Industry
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
						<input name="submitGeneral" type="submit" id="Check" value="Search">
					</form>
				</div><!-- /searchTradingHub -->
		<div class="cnscontainerPlain left">
     <div id="searchResult3" class="">

			<div id="inventcontent">



				
				<div style="padding: 10px 0px">
					<h3 id="cs01">Submission(s)</h3>
				</div>

				<?php  

				// ==================================================================
				//
				// if no result
				//
				// ------------------------------------------------------------------
				
				if ($numrowIdeaCat == 0) {
					echo '<span>No submission in this category.</span>';
				} else {

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
				
				<?php  

				// display
				}

				?>

				<div>
					<div class="idea-video none">
						<div class="idea-video-container">
						<a href="idea-details.php?id=<?php //echo $rowqRandIdea->picId; ?>"><img src="<?php //echo $rowqRandIdea->Picture; ?>"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div><!-- /cnscontainer -->

		<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">

			<div id="BrowseIdeaMore" style="margin-top:30px">
				<strong class="bebasTitle heading_title_two">Browse More</strong>
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
					<ul id="loc-landing">
						<?php while($rowrcom = mysql_fetch_object($rrecom)){ ?>
						<li>
							<div>
								<div class="featured_emplyed_lists">
									<div>
										<a href="idea-details.php?id=<?php echo $rowrcom->picId; ?>" title="View this idea">
										<img src="<?php echo $rowrcom->Picture; ?>" width="60px" />
										</a>
									</div>
								</div><!-- /leftPic -->
								<div class="left" style="width:160px">
									<a href="idea-details.php?id=<?php echo $rowrcom->picId; ?>" title="View this idea">
									<strong style="color:#3F3FA0"><?php echo $rowrcom->ideaTitle; ?></strong>
									</a><br><br>
									<span class="ic_favorite_grey" style="color:#aaa; margin-right:10px;"><?php echo number_format($rowrcom->ideaLove); ?></span>
									<span class="ic_chats_grey" style="color:#aaa">
										<?php  

										$qComment   = "SELECT
													  Count(mj_fund_comment.fund_usr_id_fk) As totalComment
													From
													  mj_fund_comment
													Where
													  mj_fund_comment.fund_post_id_fk = '$rowrcom->picId'";
										$rqComment  =mysql_query($qComment);
										$rowqComment=mysql_fetch_object($rqComment);

										echo number_format($rowqComment->totalComment);

										?>
									</span>
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