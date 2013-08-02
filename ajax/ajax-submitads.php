<?php  

$usr_id = mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['id'])));

include '../db/db-connect.php';

?>

<div id="headingContainer" class="">
	
	<div class="left">
		<strong class="store_market_stall_color">Market Section</strong>
	</div>

	<div class="right">
		<a href="#" title="Create Your Own Store" class="store_label_color" id="submitNewStore"><strong>Create Your Own Store</strong></a>
		<a href="#" title="Insert Free Ads" class="box--plus_color" id="submitNewIdea" style="margin-left:10px;">Insert Free Ads</a>
		<a href="#" title="Cancel" id="cancelNewIdea" class="none">
			<img src="images/icon_grey/ic_cancel.png" original-title="Cancel">
		</a>
	</div>

	<div class="clear"></div>

</div><!-- /headingContainer -->


<div id="newStoreName" class="none">
	<form action="#" method="post" id="formNewSTore" accept-charset="utf-8">
		<label><strong class="store_label_color">Store Name</strong></label><br/><br/>
		<input type="text" name="userstorename" id="userstorename" placeholder="My Fruit Shop" style="padding:4px; display: block; 
		width:400px;" /><br/><br/>
		<input type="hidden" name="storeCreatedBy" id="storeCreatedBy" value="<?php echo $usr_id; ?>">
		<input type="submit" name="submitNewStoreName" id="submitNewStoreName" class="button green" value="Create Store" />
	</form>
</div><!-- /newStoreName -->

<div id="newIdea" class="none">

	<h3>Advertisement Form</h3><br><br>
	<form id="submitMarket" enctype="multipart/form-data" method="post">
		<label>Heading</label>
		<input type="text" class="title" name="market_title" id="market_title" />

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
		<textarea name="market_desc" id="market_desc" class="market"></textarea>
		<br/>
		<label>Cost</label><br/>
		<input name="market_price" id="market_price" class="title" /><br>

		<input type="hidden" name="user_id" value="<?php echo $usr_id; ?>" />
		<input type="submit" class="button green" name="market_submit" id="market_submit" />
	</form>
</div>




<div id="loadUploadPictureMarket">
	
</div><!-- /loadUploadPictureMarket -->








<div id="newIdeaList" class="">
<?php  


// echo "<strong>Submit ads</strong><br/><br/>";





$qMarket = "SELECT
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
  mj_market_post.mrket_usr_id_fk = '$usr_id'
Order By
  mj_market_post.market_dateposted Desc";


$resultQMarket = mysql_query($qMarket);
$numrowQMarket	   = mysql_num_rows($resultQMarket);


if ($numrowQMarket == 0) {
	
	echo "You dont have any submission yet.";

}
else {


	echo "Your submission<br/><br/>";
	while ($rowQMarket = mysql_fetch_object($resultQMarket)) {

	if ($rowQMarket->isPublished == 1) {
		$adsLink = 'product-details.php?id='.$rowQMarket->mId;
	}
	else {
		$adsLink = '#';
	}

?>

	<div id="<?php echo $rowQMarket->mId; ?>" class="marketrow">
		<div class="mPicLeft left">
			<a href="<?php echo $adsLink; ?>">
			<div class="profile-pic48 border" style="background-image: url('<?php echo $rowQMarket->mPic; ?>'); background-size:auto 100% !important;">
				
			</div><!-- /profile-pic48 -->
			</a>
		</div><!-- /left -->

		<div id="" class="mPicRight left">
			<div class="">
				<a href="<?php echo $adsLink; ?>"><strong><?php echo ucwords($rowQMarket->mTitle); ?></strong></a> in category <?php echo $rowQMarket->mCatName; ?>
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



<script type="text/javascript">	

$(document).ready(function(){


	/* tipsy */
	$('.marketrow').find('div > img').tipsy({gravity: 's'});
	$('.marketrow').find('div > a img').tipsy({gravity: 's'});

	


	$('#editIdeaSubmission').find('img').tipsy({gravity: 's'});
	$('#cancelNewIdea').find('img').tipsy({gravity: 's'});
	/*-----------------------------------------------------------------------------*/






	$('#newIdea input, #newIdea select, #newIdea textarea').css('display','block');



	/*submit new store*/
	$('#submitNewStoreName').click(function(){

		var storename = $('#userstorename').val();

		if (storename == '') {
			$.jnotify("Enter your store name", "error");
		}
		else {

			var dataString = $('#formNewSTore').serialize();

			$.ajax({

				url: "ajax/new-store.php",
				type: "POST",
				data: dataString,

				success:function(html){

					if (html == 1) {
						$('#userstorename').val("");
						$.jnotify("Store Created!");
					} else {
						$.jnotify("SQL error", "error");
					}

				}

			});

		}
		console.log(dataString);
		return false;
	});


	$('#submitNewStore').click(function(){

		$('#submitNewIdea').hide();
		$('#newIdeaList').fadeOut();
		$(this).hide();

		$('#cancelNewIdea').fadeIn();

		$('#newStoreName').fadeIn();

	});


	$('#submitNewIdea').click(function(){


		$('#newIdea').fadeIn();
		$('#newIdeaList').fadeOut();

		$(this).hide();
		$('#cancelNewIdea').fadeIn();
		$('#submitNewStore').hide();

		return false;

	});


	$('#cancelNewIdea').click(function(){

		$('#newIdea').fadeOut();
		$('#newIdeaList').fadeIn();

		$(this).hide();
		$('#newStoreName').hide();
		$('#submitNewIdea').fadeIn();

		$('#submitNewStore').fadeIn();

	});

	$('#newIdea input, #newIdea select, #newIdea textarea').css('margin-bottom', '10px');

	$('#newIdea input, #newIdea select, #newIdea textarea').css('padding', '4px');

	$('#newIdea textarea').css('width', '500px');
	$('#newIdea textarea').css('height', '190px');

	$('#newIdea input[type="text"]').css('width', '500px');

	$('#newIdea label').css('font-weight', 'bold');






	/* submit market preview */
	$('#market_submit').click(function(){


		/* validation */
		var market_title = $('#market_title').val();
		var market_desc = $('#market_desc').val();
		var market_price = $('#market_desc').val();

		if (market_title == '' || market_desc == '' || market_price == '') {

			$.jnotify("Enter fill data", "error");

		} else {

			var submitMarketData = $('form#submitMarket').serialize();


			$.ajax({

				url: "ajax/ajax-ads-submited.php",
				type: "POST",
				data: submitMarketData,

				success:function(html){

					$('#newIdea').fadeOut();
					$('#loadUploadPictureMarket').load('ajax/ajax-market-media-upload.php?ideaid='+html);
					console.log('Success new id '+html);
					$.jnotify("Your ads has been submitted.");
					$('#cancelNewIdea').hide();
				}

			});

			console.log(submitMarketData);

		}

		return false;

	});

});

</script>