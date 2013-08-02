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

$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_id,
  mj_users.usr_name As currName,
  mj_users.usr_workat,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo
From
  mj_users
Where
  mj_users.usr_id = '$usr_id'";

$rusrSQL = mysql_query($usrSQL);
$rowusrSQL = mysql_fetch_object($rusrSQL);

?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>

	<div id="contentContainer" >

		<div class="heading">
			<h1>Your Contribute</h1>
		</div>

		<div class="left cnscontainer">

			
			<div style="border:0px solid green;">
				
				<div>
						
					<input type="hidden" name="currID" id="currID" value="<?php echo $usr_id; ?>" />
					
				</div><!-- /.post-status -->

			</div>

			<div class="white" style="border-top:0px solid #cccccc; padding:10px">
				
				<!-- CHange Action -->

				<div id="connect-container">
					<div id="loadContainer">
						<?php  

						$storeId = sqlInjectString($_GET['sid']);

						$sqlinsert = "SELECT * FROM mj_market_store WHERE mms_id = '$storeId'";
						$rStore = mysql_query($sqlinsert);
						$storeObject = mysql_fetch_object($rStore);


						?>
						<strong class="store_label_color"><?php echo $storeObject->mms_name; ?></strong><br><br>
						<div style="border-top:1px solid #D7D8D1; padding-top: 10px;">
							<?php

							$sqlTotalProduct = "SELECT
								  mj_market_post.mrket_post_title As mTitle,
								  mj_market_post.mrket_post_id As mId,
								  mj_market_post.market_dateposted,
								  mj_market_post.mrket_post_picture As mPic,
								  mj_market_post.mrket_post_published As isPublished,
								  mj_market_category.mrket_cat_name As mCatName
								From
								  mj_market_post Inner Join
								  mj_market_category On mj_market_post.mrket_cat_id_fk =
								    mj_market_category.mrket_cat_id
								Where
								  mj_market_post.market_mms_id_fk = '$storeObject->mms_id'
								Order By
								  mj_market_post.market_dateposted Desc";
							$rtProduct = mysql_query($sqlTotalProduct);

							$numrowtProduct = mysql_num_rows($rtProduct);

							if ($numrowtProduct == 0) {
								echo "No product in this store yet. Pick one of your product and start organize it.";
							} else {

								while($rowQMarket = mysql_fetch_object($rtProduct)) {
							?>

								<div id="<?php echo $rowQMarket->mId; ?>" class="marketrow">
								<div class="mPicLeft left">
									<a href="product-details.php?id=<?php echo $rowQMarket->mId; ?>">
									<div class="profile-pic48 border" style="background-image: url('<?php echo $rowQMarket->mPic; ?>'); background-size:auto 100% !important;">
										
									</div><!-- /profile-pic48 -->
									</a>
								</div><!-- /left -->

								<div id="" class="mPicRight left">
									<div class="">
										<a href="product-details.php?id=<?php echo $rowQMarket->mId; ?>"><strong><?php echo ucwords($rowQMarket->mTitle); ?></strong></a> in category <?php echo $rowQMarket->mCatName; ?>
										<br/><br/>
										<?php  

										$totalReview = "SELECT
										  COUNT(*) As reviewTotal
										From
										  mj_market_review
										Where
										  mj_market_review.mr_mpost_id_fk = '$rowQMarket->mId'";

										 $resultTotal = mysql_query($totalReview);
										 $rowTotalReview = mysql_fetch_object($resultTotal);

										?>
										<div class="balloon-white_color"><?php echo $rowTotalReview->reviewTotal ?> review(s)</div>
									</div><!-- / -->
								</div><!-- /right -->

								<div class="right">
									
									<div style="margin-top:20px;">
										<div class="editDeleted left" style="margin-right:10px;">
											<a href="edit-market.php?mid=<?php echo $rowQMarket->mId; ?>" title="Edit">
												<img src="images/icon_grey/ic_edit.png" original-title="Edit">
											</a>
											<a href="#" title="Delete">
												<img src="images/icon_grey/ic_delete.png" original-title="Delete">
											</a>
										</div>

										<div class="right">
											<?php 

											if($rowQMarket->isPublished == 1){

												echo "<img src=\"images/icon_color/monitor.png\" original-title=\"Published\" />";

											}
											else {

												echo "<img src=\"images/icon_color/monitor-off.png\" original-title=\"UnPublished\" />";

											} ?>
										</div>
									</div>
									<div class="clear"></div>

								</div>

								<div class="clear"></div>

							</div><!-- / -->
							<?php
								}
							}

							?>
						</div>
					</div>
				</div>

				<!-- /CHange Action -->
			</div>


		</div><!-- /orange left -->

		<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
			<strong>Your Action</strong>
			<div class="recomAction">
				<a href="contribute.php" title="Dashboard" class="dashboard_color">Dashboard</a>
				<a href="#" title="Idea Section" class="light_bulb_color" id="s-idea" rel="<?php echo $usr_id; ?>">Idea Section</a>
				<a href="#" title="Project Section" class="zone_money_color" id="s-project" rel="<?php echo $usr_id; ?>" data-name="<?php echo $usr_name; ?>">Project Section</a>
				<a href="#" title="Insert Free Ads" class="store_market_stall_color" id="insert-free-ads" rel="<?php echo $usr_id; ?>">Buy &amp; Sell Goods</a>
				<div id="listStoreName">
					<?php  

						$listStore = "SELECT * FROM mj_market_store WHERE mms_usr_id_fk = '$usr_id'";
						$resultStore = mysql_query($listStore);
						$numrow = mysql_num_rows($resultStore);
						//$rowObject = mysql_fetch_object($resultStore);

						if ($numrow != 0) {

					?>
					<br><strong class="store_label_color">My Store</strong>
					<ul id="listedStore">
							<?php while($rowObject = mysql_fetch_object($resultStore)){ ?>
								<li><a href="store-details.php?sid=<?php echo $rowObject->mms_id; ?>" title="">
									<?php echo $rowObject->mms_name; ?>
								</a></li>
							<?php } ?>

						<?php }
						?>
					</ul><!-- /listedStore -->
				</div><!-- /listStoreName -->
			</div><!-- / -->
			<br><br>
			<div class="none">
				<strong id="mojoProcess">Clear Step</strong><br><br>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div><!-- / -->
		</div><!-- /orange right -->

		<div class="clear"></div>


	</div><!-- /contentContainer -->

</div><!-- /content -->
<!-- get current email -->
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />
<!-- /get current email -->



<script type="text/javascript">
$(document).ready(function(){
	
	$("a#example1").fancybox({
		'overlayColor'		: '#000',
		'overlayOpacity'	: 0.9

	});


	$('#editProfile').fancybox({
		'titlePosition'		: 'inside',

		'transitionIn'		: 'none',

		'transitionOut'		: 'none'
	});

	$('label').css('display', 'block');


	/*$('.network-left').hover(function(){
		
		$('#user-settings').fadeIn();

	}, function(){
		
		$('#user-settings').fadeOut();

	});*/

	$('#tabmenu').find('> a#nstream').addClass('tabuiactive');

	$('#call-friends').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#call-network').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#call-network').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#psetting').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#call-network').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#nstream').click(function(){
		
		$('#call-network').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#call-message').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#call-network').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#s-network').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#call-network').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});


	/* Status update */
	$('#btnstatusupdate').click(function(){
		
		var value = $('#statusupdate').val();

		if (value == "") {
			
			alert('What\'s going on..?');

		} else {


			var statusupdate = $('#statusupdate').val();
			var currID 		 = $('#currID').val();
			var ajax_load    = "<img src='images/ajax-loader.gif' alt='loading..' />";

			dataString = 'statusupdate='+statusupdate+'&currID='+currID;

			
			/* post ajax */
			$.ajax({
			

				type: "POST",
				url: "ajax/ajax-statusupdate.php",
				data: dataString,
				cache: false,

				success: function(){


					// var url 		= 'network.php?nid='+viewnetwork;
					// var urlclass	= url+' .nw-contribbute-'+currentWallID;

					$('#statusupdate').val("");
					$('#connect-container #loadstream').html(ajax_load).load('ajax/ajax-stream.php?id='+currID);
					// $('.nw-contribbute-'+currentWallID).load(urlclass);
					// console.log(urlclass);
					console.log(dataString);
				}

			});

		}

		return false;

	});



	/*dashboard summary*/
	 $("#usual1 ul").idTabs();


	 /* tipsy */
	$('.marketrow').find('div > img').tipsy({gravity: 's'});
	$('.marketrow').find('div > a img').tipsy({gravity: 's'});

	


	$('#editIdeaSubmission').find('img').tipsy({gravity: 's'});
	$('#cancelNewIdea').find('img').tipsy({gravity: 's'});
	/*-----------------------------------------------------------------------------*/




	/* get current email */
	var current_email = $('input#current_email').val();

	if (current_email == '') {
		$('body').css('display', 'none');
		document.location.href = "index.php";
		console.log('Not Login');
	}
	else {
		console.log("Current Email => "+current_email);
	}

});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>