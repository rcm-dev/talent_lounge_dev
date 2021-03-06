<?php  


include 'header.php';
include 'db/db-connect.php';

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
					Limit 15";

$rqRandIdea	=	mysql_query($qRandIdea);

//$rowqRandIdea = mysql_fetch_object($rqRandIdea);



$query_rsCategoryArticle = "SELECT * FROM mj_learn_article_category";
$rsCategoryArticle = mysql_query($query_rsCategoryArticle) or die(mysql_error());
$row_rsCategoryArticle = mysql_fetch_assoc($rsCategoryArticle);
$totalRows_rsCategoryArticle = mysql_num_rows($rsCategoryArticle);




?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer">

		<div class="heading">
			<h1 class="heading_title"><?php echo strtoupper("POST NEW RESOURCE"); ?></h1>
		</div>

		<div class="cnscontainerfull">

		<?php if (isset($_SESSION['usr_name'])){ ?>
			<div id="success" style="display:none">
				
			</div>
			<div id="hideAlso">
				<a href="entrepreneur-library.php" title="Cancel">Cancel</a> post aritle and back to main resources library.
			</div>
		<?php } ?>

			<div id="inventcontent">

				<div style="padding: 30px 0px; border:0px solid red; width:100%;">
					<h3>Fill up your article details to post at our portal.</h3>
					<br/>
					<form action="#" method="post" id="articleData" enctype="multipart/form-data">
						<table>
						<tbody>
							<tr>
								<td>Title</td>
							</tr>
							<tr>
								<td><input type="text" name="title" value="" placeholder="" id="title" size="100"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>Content</td>
							</tr>
							<tr>
								<td><textarea name="body" id="body" rows="15" cols="76"></textarea></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr style="display:none">
								<td>Cover (110px w and 140px height)</td>
							</tr>
							<tr style="display:none">
								<td><input type="file" name="cover_article" id="cover_article"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>Categories</td>
							</tr>
							<tr>
								<td><select name="category_article">
									<?php while ($row_rsCategoryArticle = mysql_fetch_object($rsCategoryArticle)) { ?>
										<option value="<?php echo $row_rsCategoryArticle->la_cat_id; ?>"><?php echo $row_rsCategoryArticle->la_cat_name; ?></option>
									<?php } ?>
								</select></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>
									<input type="hidden" name="byuser" value="<?php echo $_GET['byuser']; ?>">
									<input type="submit" name="submit" class="button green" id="postarticle" value="Post article"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</tbody>
					</table>
					</form>
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

		<div class="clear"></div>
	</div><!-- /contentContainer -->

</div><!-- /content -->

<!-- Page Title -->
<input type="hidden" name="page_title" value="Browse Entrepreneur Library" id="page_title" />
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
	$('.book-ui').find('li img').tipsy({gravity: 's'});


	// Post Article
	$('#postarticle').live('click', function(){
		

		var ar_title = $('input#article').val();
		var ar_body = $('textarea#body').val();

		if (ar_title == "" || ar_body == "") {
			alert('Both fill are required!');
		} else {

			var articleData = $('form#articleData').serialize();

			console.log('clicked | ' + articleData);

			$.ajax({
				type: "POST",
				url: 'upload-article.php',
				data: articleData,

				success:function(html){
					$('form#articleData').hide();
					$('div#success').text(html);
					
				}
			});
				
		}

		
		return false;
	});

	// live upload
	$('#cover_article').live('change', function(){

		var imageURL = $(this).val();

		$.ajax({
			type: "GET",
			url: 'uploadImage.php',
			data: imageURL,
			

			success: function(html){

				console.log(html);
			}

		});

		//console.log($(this).val());
	});


});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>