<?php  


include 'header.php';

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

/**
 * 
 * Get parameter id
 * 
 */

$sID	=	(int) sqlInjectString($_GET['sid']);


// ==================================================================
//
// Get product based on store id
//
// ------------------------------------------------------------------

$qpd	=	"SELECT
  mj_users.usr_name,
  mj_market_store.mms_name,
  mj_users.usr_id
From
  mj_market_store Inner Join
  mj_users On mj_market_store.mms_usr_id_fk = mj_users.usr_id
Where
  mj_market_store.mms_id = '$sID'";

$rqpd	=	mysql_query($qpd);

$rowrpqd=	mysql_fetch_object($rqpd);

$numrowstore = mysql_num_rows($rqpd);



// ==================================================================
//
// store Track View
//
// ------------------------------------------------------------------
//$isPublished = $rowrpqd->mrket_post_published;

//echo $isPublished;

if ($numrowstore != 0) {
	// echo 'Run Counter';
	mysql_query("UPDATE mj_market_store SET mms_view = mms_view+1 WHERE mms_id = '$sID'");
}

?>

<div id="content" class="">

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
							$qCat 	= "SELECT mj_market_category.mrket_cat_name AS catName,
										       mj_market_category.mrket_cat_id AS catId
										FROM mj_market_category";
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
						<a href="users.php?uid=<?php echo $rowrpqd->usr_id; ?>" title="<?php echo ucfirst($rowrpqd->usr_name); ?>">
						<div class="profile-pic48 none" style="background-image: url('<?php //echo $rowrpqd->user_pic1; ?>'); float: left; margin-right: 10px;">

						</div>
						</a>

						<div>
							<h1 class="markettitle" style="text-align:left"><?php echo ucwords($rowrpqd->mms_name); ?></h1>
							owned by <a href="users.php?uid=<?php echo $rowrpqd->usr_id; ?>" title="<?php echo ucfirst($rowrpqd->usr_name); ?>"><strong><?php echo ucfirst($rowrpqd->usr_name); ?></strong></a>
						</div>
						<div class="clear"></div>
					</div><!-- /seller info -->

							<br/>
				

					<div id="relatedhub">

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
						mj_market_post.market_mms_id_fk = $sID
						ORDER BY RAND()
						";
						

						$rotherView = mysql_query($otherView);
						$totalRow   = mysql_num_rows($rotherView);

						echo "<strong>There have $totalRow products in this store.</strong><br>";
						while ($rowotherView = mysql_fetch_object($rotherView)) {

						?>
						
							<li>
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