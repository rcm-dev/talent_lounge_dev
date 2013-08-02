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

$get_id_view = (int) sqlInjectString($_GET['mid']);

$queryIdeaEdit = "SELECT
  mj_market_post.*,
  mj_market_category.mrket_cat_name As catName,
  mj_state.state_name As marketArea,
  mj_users.*,
  mj_market_post.mrket_post_id As mrket_post_id1,
  mj_users.usr_name As sellerName,
  mj_users.usr_tel As usr_tel1
FROM
  mj_market_post INNER JOIN
  mj_market_category ON mj_market_post.mrket_cat_id_fk =
    mj_market_category.mrket_cat_id INNER JOIN
  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id INNER JOIN
  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id
WHERE
  mj_market_post.mrket_post_id = '$get_id_view'";

$result  = mysql_query($queryIdeaEdit);
$rowEdit = mysql_fetch_object($result);


?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" >

		<div class="heading">
			<h1>Edit Idea Submission</h1>
		</div>

	<div class="success none">
		<p>idea details edited
		</p>
	</div>



		<div id="adv1" class="usual cnscontainer left" style="margin:0px !important;"> 
		  <ul> 
		    <li><a href="#t1" class="selected">Description</a></li> 
		    <li><a href="#t2" id="<?php echo $_GET['id']; ?>" class="ePicture">Pictures</a></li> 
		    <li class="none">
		    	<a href="#t3" class="eVideo">Videos</a></li>
		  </ul> 

		  <div id="t1" style="display: none; ">
		  	
			<form id="submitMarket" enctype="multipart/form-data" method="post">
				<label>Heading</label>
				<input type="text" class="title" name="market_title" id="market_title" value="<?php echo $rowEdit->mrket_post_title; ?>" />

				<label>Category</label><br/>
				<select name="market_category" id="market_category">
					<?php

					include '../db/db-connect.php'; 

					$q_idea_cat = "SELECT * FROM mj_market_category";
					$rslt_idea = mysql_query($q_idea_cat);

					while ($rowIdCat = mysql_fetch_object($rslt_idea)) {
						
						echo '<option value="'.$rowIdCat->mrket_cat_id.'">'.ucwords($rowIdCat->mrket_cat_name).'</option>';
					}

					?>
				</select><br/>

				<label>Area / Region</label><br/>
				<select name="market_area" id="market_area">
					<?php


					$sState = "SELECT * FROM mj_state";
					$rState = mysql_query($sState);

					while ($rowState = mysql_fetch_object($rState)) {
						
						echo '<option value="'.$rowState->state_id.'">'.ucwords($rowState->state_name).'</option>';
					}

					?>
				</select><br/>

				<label>Description</label>
				<textarea name="market_desc" id="market_desc" class="market"><?php echo $rowEdit->mrket_post_body; ?></textarea>
				<br/>
				<label>Cost</label><br/>
				<input name="market_price" id="market_price" class="title" value="<?php echo $rowEdit->mrket_price; ?>" /><br>

				<label>Current Cover</label><br/>
				<img src="<?php echo $rowEdit->mrket_post_picture; ?>" width="120" /><br/><br>

				
				<?php  

				$sqlCheckStore = "SELECT * FROM mj_market_store WHERE mms_usr_id_fk = '$usr_id'";
				$rsCS		   = mysql_query($sqlCheckStore);
				$nrsCS		   = mysql_num_rows($rsCS);
				if ($nrsCS == 0) {
					echo "You dont have any store yet.";
				} else {

				?>
				<label>Market Store</label>
				<p>Which store you want to put this product.</p>
				<select name="market_store" id="market_store">
					<?php


					$sState = "SELECT * FROM mj_market_store WHERE mms_usr_id_fk = '$usr_id'";
					$rState = mysql_query($sState);

					while ($rowState = mysql_fetch_object($rState)) {
						
						echo '<option value="'.$rowState->mms_id.'">'.ucwords($rowState->mms_name).'</option>';
					}

					?>
				</select><br>
				<?php } ?>

				<input type="hidden" name="user_id" id="user_id" value="<?php echo $usr_id; ?>" />
				<input type="hidden" name="mid" id="mid" value="<?php echo $_GET['mid']; ?>" />
				<input type="submit" class="button green" name="market_submit" id="market_submit" />
			</form>

		  </div> 
		  <div id="t2" style="display: block; ">
		  	<div id="loadEditedPircture">
		  		
		  	</div><!-- /loadEditePircture -->
		  </div> 
		  <div id="t3" style="display: block; ">
		  	<div id="loadEditedVideo" class="">
		  		
		  	</div><!-- /loadEditedVideo -->
		  </div> 
		</div>

		<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
			<strong>Note</strong><br><br>
			<?php  

			$sqlMarketNotification = "SELECT * FROM mj_market_post WHERE mrket_post_id = '$get_id_view'";
			$sqlMarketNotiResult = mysql_query($sqlMarketNotification);
			$rowMarketObject = mysql_fetch_object($sqlMarketNotiResult);

			if ($rowMarketObject->mrket_post_published == 0) {
				echo '<p class="info">Please noted, your ads is currently pending. Our editor will review your ads</p>';
			}
			else {
				echo '<p class="success">Your Ads is Live! you can view it <a href="product-details.php?id='.$get_id_view.'" style="font-weight:bold; color:green">Here</a></p>';	
			}

			?>
		</div>

		<div class="clear"></div>


	</div><!-- /contentContainer -->

</div><!-- /content -->

<!-- get current email -->
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />
<!-- /get current email -->


<script type="text/javascript">
$(document).ready(function(){


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
	/* /current email */


	var curr_idea_edit_id = $('#mid').val();

	$('label').css('font-weight','bold');
	$('label').css('display','block');
	$('input, textarea, select').css('display','block');


	/* idTab */
  	//var settings = { start:1, change:false }; 
  	$("#adv1 ul").idTabs();


  	/* load picture */
  	$('.ePicture').click(function(){

  		$('#loadEditedPircture').html('loading').load('ajax/ajax-market-edited-picture.php?mid='+curr_idea_edit_id);
  		//console.log('loaded');
  		return false;
  		// loadEditedVideo

  	});


  	/* load video */
  	/*$('.eVideo').click(function(){

  		$('#loadEditedVideo').html('loading').load('ajax/ajax-edited-video.php?cid='+curr_idea_edit_id);
  		//console.log('loaded');
  		return false;


  	});*/


	$('#market_submit').click(function(){

		var dataString = $('#submitMarket').serialize();

		$.ajax({

			type: 'POST',
			url	: 'ajax/ajax-market-edited.php',
			data: dataString,
			

			success:function(html){

				if (html == 1) {
					//$('.success').fadeIn();
					console.log('Edited');
					$.jnotify("This is a notification with a 5 second delay.", 5000);
				}
				else {
					console.log('error');
					$.jnotify("This is an \"error\" notification.", "error");
				}

			}

		});

		console.log(dataString);
		return false;

	});

});

</script>
<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>