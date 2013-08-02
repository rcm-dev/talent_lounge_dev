<?php  


include 'header.php';

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

/**
 * 
 * Get parameter id
 * 
 */

$pdID	=	(int) sqlInjectString($_GET['id']);

$qpd	=	"SELECT mj_market_post.*,
       mj_market_category.mrket_cat_name AS catName,
       mj_state.state_name AS marketArea,
       mj_users.*,
       mj_market_post.mrket_post_id AS mrket_post_id1,
       mj_market_post.mrket_post_title As marketSlugTitle,
       mj_market_post.mrket_cat_id_fk AS mrket_cat_id_fk1,
       mj_users.usr_name AS sellerName,
       mj_users.usr_tel AS usr_tel1,
       mj_users.user_pic AS user_pic1,
       mj_market_post.mrket_usr_id_fk AS mrket_usr_id_fk1
FROM mj_market_post
INNER JOIN mj_market_category ON mj_market_post.mrket_cat_id_fk = mj_market_category.mrket_cat_id
INNER JOIN mj_state ON mj_market_post.mrket_state_id_fk = mj_state.state_id
INNER JOIN mj_users ON mj_market_post.mrket_usr_id_fk = mj_users.usr_id
WHERE mj_market_post.mrket_post_id = '$pdID'";

$rqpd	=	mysql_query($qpd);

$rowrpqd=	mysql_fetch_object($rqpd);

$rowMarketIDFK = $rowrpqd->mrket_cat_id_fk;




// ==================================================================
//
// Market Track View
//
// ------------------------------------------------------------------
$isPublished = $rowrpqd->mrket_post_published;

//echo $isPublished;

if ($isPublished != 0) {
	// echo 'Run Counter';
	mysql_query("UPDATE mj_market_post SET market_view = market_view+1 WHERE mrket_post_id = '$pdID'");
}

?>

<!-- <div id="content" class="<?php //if(!isset($_SESSION['usr_id'])) { echo "topfix"; } ?>"> -->
<div id="content">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" class="">
<div id="mojo-container">

	<div id="searchTradingHub" class="searchTradingHub" style="margin: 40px 0px;">
					<form class="inline center" method="get" action="search-market.php">
						Looking for : 
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

			<div>

				<div class="ui-window">

					<div class="sellerinfo" style="border:0px solid #f1f1f1;">
										
						<div class="sellerphone none">
							<?php echo ucfirst($rowrpqd->usr_tel1); ?>
						</div>
						<a href="users.php?uid=<?php echo $rowrpqd->mrket_usr_id_fk1; ?>" title="<?php echo ucfirst($rowrpqd->sellerName); ?>">
						<div class="profile-pic48" style="background-image: url('<?php echo $rowrpqd->user_pic1; ?>'); float: left; margin-right: 10px;">

						</div>
						</a>

						<div>
							<h1 class="markettitle bebasTitle" style="text-align:left"><?php echo ucwords($rowrpqd->mrket_post_title); ?></h1>
							by <a href="users.php?uid=<?php echo $rowrpqd->mrket_usr_id_fk1; ?>" title="<?php echo ucfirst($rowrpqd->sellerName); ?>" id="quickuser" data-hovercard="<?php echo $rowrpqd->mrket_usr_id_fk1; ?>"><strong><?php echo ucfirst($rowrpqd->sellerName); ?></strong></a> &middot; <span class="clock_color"><?php echo date("g:i a F j, Y ", strtotime($rowrpqd->market_dateposted)); ?></span> &middot; <span class="category_color"><?php echo ucwords($rowrpqd->catName); ?></span> &middot; <span class="marker_color"><?php echo ucwords($rowrpqd->marketArea); ?></span>
							
							<?php  

							// check product in store
							$storeIdFK = $rowrpqd->market_mms_id_fk;

							if ($storeIdFK != null && $storeIdFK != 0) {
								
								// display store name and id
								$sqlStoreName = "SELECT * FROM mj_market_store WHERE mms_id = '$storeIdFK'";
								$resultStoreName = mysql_query($sqlStoreName);

								$rowObject = mysql_fetch_object($resultStoreName);

								echo "&middot; <strong>This Product in store <a href=\"store.php?sid=$storeIdFK\" class=\"store_label_color\" title=\"$rowObject->mms_name\" style=\"margin-left:10px;\">$rowObject->mms_name</a></strong>";
							}

							?>
						</div>
						<div class="clear"></div>
					</div><!-- /seller info -->

							<br/>

							<!-- details -->

							<div class="pd-container" style="border:0px solid red; width: 700px; float: left;">

								<div class="pd-picture left" style="border:0px solid red; width: 500px; overflow: hidden">
									<a href="<?php echo $rowrpqd->mrket_post_picture; ?>" id="example1">
									<img src="<?php echo $rowrpqd->mrket_post_picture; ?>" width="490" />
									</a>
								</div>

								<div class="price-tag right" style="border:0px solid red; width: 190px;">
									<div class="price-container">

									<div class="pd-misc none">
										
										<br><br>
									</div><!-- /breadcrumb category -->

									<div class="price-details" style="margin:30px 0px; text-align:center">
										<p><br><strong style="color:darkred; font-size: 30px;">
										RM 
										<?php 

										$dprice = $rowrpqd->mrket_price;
										
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

										?>
										</strong>
										</div>
										<div style="margin:30px 0px; text-align:center">
											<h2><?php echo $rowrpqd->usr_tel1; ?></h2>
											<a href="users.php?uid=<?php echo $rowrpqd->mrket_usr_id_fk1; ?>" title="<?php echo ucfirst($rowrpqd->sellerName); ?>"><strong><?php echo ucfirst($rowrpqd->sellerName); ?></strong></a>
										</div>
									</div><!-- /price -->

								</div>

								<div class="clear"></div><!-- /clear -->


								<div id="adv1" class="usual"> 
								  <ul> 
								    <li><a href="#t1" class="selected"><span class="blue_document_text_color">Description</span></a>
								    </li> 
								    <li>
								    	<a href="#t4" class="mPicture"><span class="pictures_stack_color">More Picture</span>
								    		<span class="miniCircle">
								    		<?php  

								    		$mID = (int) sqlInjectString($_GET['id']);

								    		$qTotalPicture = "SELECT
											  Count(mj_market_media.mmm_id) As totalPictures
											From
											  mj_market_media
											Where
											  mj_market_media.mmm_mp_id_fk = '$mID'";

											 $rqTotalPicture = mysql_query($qTotalPicture);
											 $rowTotalPicture = mysql_fetch_object($rqTotalPicture);

											 echo '&nbsp;'.$rowTotalPicture->totalPictures;

								    		?>
								    		</span></a></li>
								    <li><a href="#t2" id="<?php echo sqlInjectString($_GET['id']); ?>" class="dreview"><span class="balloon_color">Reviews</span><span class="miniCircle">
								    	<?php  

								    	$curViewID = (int) sqlInjectString($_GET['id']);

								    	$qTotalRev = "SELECT
										  Count(mj_market_review.mr_id) As TotalRev
										From
										  mj_market_review
										Where
										  mj_market_review.mr_mpost_id_fk = '$curViewID'";

										$rqTR = mysql_query($qTotalRev);
										$rowrqTR = mysql_fetch_object($rqTR);

										echo $rowrqTR->TotalRev;
								    	?> </span>
								    	</a>
								    	</li> 
								    <li>
								    	<a href="#t3" class="sreview"><span class="document_pencil_color">Submit Review</span></a></li>
								  </ul> 
								  <div id="t1" style="display: none; ">
								  <?php echo $rowrpqd->mrket_post_body; ?></div> 
								  <div id="t2" style="display: block; ">
								  	<div id="displayReview" market-id="<?php echo sqlInjectString($_GET['id']); ?>">
								  		<div id="displayLoading">
								  			<p>Loading...</p>
								  		</div><!-- /displayLoading -->
								  	</div><!-- /displayReview -->
								  	<div class="qres">
								  		Respones
								  	</div><!-- /qres -->
								  </div> 
								  <div id="t3" style="display: block; ">
								  	<div id="submitReview" rel="<?php echo $usr_id; ?>" name="<?php echo $usr_name; ?>" market-id="<?php echo sqlInjectString($_GET['id']); ?>">
								  		
								  	</div><!-- /submitReview -->
								  </div>
								  <div id="t4" style="display: block; ">
								  	<div id="displaymPicture" market-id="<?php echo sqlInjectString($_GET['id']); ?>">
								  		<?php  


										// ==================================================================
										//
										// Load More Picture
										//
										// ------------------------------------------------------------------
										
										$mid        = (int) sqlInjectString($_GET['id']);

										$querymedia = "SELECT * FROM mj_market_media WHERE mmm_mp_id_fk = '$mid'";
										$result     = mysql_query($querymedia);
										$totalRow   = mysql_num_rows($result);


										if ($totalRow ==0) {
											echo "There has no picture in this ads.";
										}
										else {


											while ($row = mysql_fetch_object($result)) { ?>
												
												<a href="<?php echo $row->mmm_path; ?>" rel="morepicture_group">
													<img src="<?php echo $row->mmm_path; ?>" width="100" height="100" style="background-color: #fff; padding:5px; border:1px solid #f1f1f1; margin:5px;" />
												</a>
										<?php

											}

										}


										?>
								  	</div><!-- /displayReview -->
								  </div> 
								</div>

							</div><!-- /left-details -->


							<div class="recommended right" style="border:1px solid #F1F1F1; width: 220px; padding: 10px">
								<strong class="heading_title_two bebasTitle">Recommendations</strong>
								<ul class="market-list">
								<?php  

								// ==================================================================
								//
								// recommended
								//
								// ------------------------------------------------------------------
								
								$recommended = "SELECT
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
								WHERE mj_market_post.mrket_post_id != $pdID 
								And mrket_cat_id_fk = $rowMarketIDFK
								ORDER BY RAND()
								LIMIT 2";
								

								$rrecommended    = mysql_query($recommended);
								while ($rowrecommended = mysql_fetch_object($rrecommended)) {

								?>

								<li><!-- <a href="<?php //echo urlencode($rowrecommended->marketSlugTitle); ?>-market-<?php //echo $rowrecommended->pid; ?>.html" title="<?php //echo $rowrecommended->CatNameView; ?>"> -->
									<a href="product-details.php?id=<?php echo $rowrecommended->pid; ?>" title="<?php echo $rowrecommended->CatNameView; ?>">

									<div class="white" style="width: 172px; height: 172px; overflow: hidden;">
										<div style="width: 172px; height: 172px; background-image: url('<?php echo $rowrecommended->mrket_post_picture; ?>'); background-size: auto 100%; background-repeat: no-repeat; background-position: center center"></div>
									</div>
									</a>

									<div class="viewDetail">
									<div class="titleWrap">
										<span><strong><?php echo ucwords($rowrecommended->viewingTitle); ?></strong></span>
									</div>
									
									<span><?php echo ucwords($rowrecommended->CatNameView); ?></span><br/>
									<span class="viewprice ic_tag_grey">RM
									<?php 

									$dprice = $rowrecommended->viewPrice;
									
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

									?>
									</span>
									<span class="ic_pin_grey" style="margin-left:10px;"><?php echo ucwords($rowrecommended->location); ?></span>
								</div><!-- /viewDetail -->
								</li>

								<?php } ?>
								</ul><!-- /ul recommendation -->
							</div><!-- /recommended -->

							<div class="clear"></div>
							<!-- /details -->
				

							<div id="relatedhub" style="margin-top: 50px; padding-top: 30px; border-top:1px dotted #d1d1d1;">
					<h3 class="bebasTitle heading_title_two">WHAT OTHER ARE VIEWING NOW</h3>

					<div id="otherViewing">
						<ul id="otherViewing" class="market-list">
						
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
						WHERE
						mj_market_post.mrket_post_published = 1 And
						mj_market_post.mrket_post_id != $pdID
						ORDER BY RAND()
						LIMIT 4";
						

						$rotherView = mysql_query($otherView);
						while ($rowotherView = mysql_fetch_object($rotherView)) {

						?>
						
							<li>
								<!-- <a href="<?php //echo urlencode($rowotherView->marketSlugTitle); ?>-market-<?php //echo $rowotherView->pid; ?>.html" title="<?php //echo $rowotherView->viewingTitle; ?>"> -->
								<a href="product-details.php?id=<?php echo $rowotherView->pid; ?>" title="<?php echo $rowotherView->viewingTitle; ?>">
								<div class="white" style="width: 172px; height: 172px; overflow: hidden;">
									<div style="width: 172px; height: 172px; background-image: url(<?php echo $rowotherView->mrket_post_picture; ?>); background-size: auto 100%; background-repeat: no-repeat; background-position: center center"></div>
								</div>
								</a>
								<div class="viewDetail">
									<div class="titleWrap">
										<span><strong><?php echo ucwords($rowotherView->viewingTitle); ?></strong></span>
									</div>
									<span><?php echo ucwords($rowotherView->CatNameView); ?></span><br/>
									<span class="viewprice ic_tag_grey"><?php echo convertPrice($rowotherView->viewPrice); ?>
									</span>
									<span class="ic_pin_grey" style="margin-left:10px;"><?php echo ucwords($rowotherView->location); ?></span>
								</div><!-- /viewDetail -->
							</li>

						<?php } ?>

							<div class="clear"></div>

						</ul><!-- /otherViewing -->

					</div><!-- /otherViewing -->

				</div><!-- /relatedhub -->

				</div>

			</div>


			</div>
		</div>
</div>
	</div>
</div>


	</div><!-- /contentContainer -->

</div><!-- /content -->
<input type="hidden" name="page_title" value="<?php echo ucwords($rowrpqd->marketSlugTitle); ?>" id="page_title" />

<script type="text/javascript">
$(document).ready(function(){
	
	$('ul.market-list li').hover(function(){
		
		$(this).find('.market-image-list').slideUp();

	},function(){
		
		$(this).find('.market-image-list').slideDown();

	});

	/* idTab */
  	var settings = { start:1, change:false }; 
  	$("#adv1 ul").idTabs(settings,true); 




  	/* display review */
  	var mid = $('#displayReview').attr('market-id');
  	//$('#displayReview').html('loading...').load('ajax/ajax-displayreview.php?mid='+mid);


  	/* click view review */
  	$('.dreview').live('click', function(){

  		var midvalue = $(this).attr('id');
  		console.log('clicked mid='+midvalue);

  		/*$.ajax({

  			type: "GET",
				url: "ajax/ajax-displayreview.php",
				data: 'mid='+midvalue,
				cache: false,

				beforeSend: function() {
				    $('#displayLoading').fadeIn();
				    //console.log('display loading..');
				},


				complete: function(){
				    $('#displayLoading').fadeOut();
				    //console.log('hide loading..');
				},

				success: function(html){

					$('#displayReview').append(html);
					//console.log('run..');
					
				}

  		});*/
		$('#displayReview').html('loading...').load('ajax/ajax-displayreview.php?mid='+midvalue);


  	});


  	/* display more picture */
  	/*$('.mPicture').live('click', function(){

  		var mid = $('#displaymPicture').attr('market-id');
  		$('#displaymPicture').html('loading...').load('ajax/ajax-morePicture.php?mid='+mid);
  		console.log('clicked and load with id='+mid);

  	});*/




  	/* submit review ajax */
  	/* click view review */
  	$('.sreview').live('click', function(){

  		//var midvalue = $(this).attr('id');
  		//console.log('clicked sreview');

  		/*$.ajax({

  			type: "GET",
				url: "ajax/ajax-displayreview.php",
				data: 'mid='+midvalue,
				cache: false,

				beforeSend: function() {
				    $('#displayLoading').fadeIn();
				    //console.log('display loading..');
				},


				complete: function(){
				    $('#displayLoading').fadeOut();
				    //console.log('hide loading..');
				},

				success: function(html){

					$('#displayReview').append(html);
					//console.log('run..');
					
				}

  		});*/
		/* submit review */
		var currEmailSession = $('#currEmailSession').val();
		console.log('Current Email : '+currEmailSession);

		if (currEmailSession == '') {
			$('#submitReview').html('Register or Login to submit.');
		} else {
  			$('#submitReview').html('loading...').load('ajax/ajax-submit-review.php');
  		}

  	});



  	/* quick respone */
  	$('.qres').hide();




  	/* fancy related picture */
  	$("a[rel=morepicture_group]").fancybox({

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition' 	: 'over',

		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

			return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

		}

	});

	$("a#example1").fancybox();


});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>