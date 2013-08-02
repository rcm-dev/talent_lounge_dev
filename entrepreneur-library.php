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


?>


<!-- <div id="content" class="<?php //if(!isset($_SESSION['usr_id'])) { echo "topfix"; } ?>"> -->
<div id="content">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer">

		<div class="heading">
			<h1 class="heading_title bebasTitle"><?php echo strtoupper("RESOURCES LIBRARY"); ?></h1>
		</div>

		<div class="cnscontainerPlain left">

		<?php if (isset($_SESSION['usr_name'])){ ?>
			<div>
				Post and sharing your articles. <a href="entrepreneur-library-post.php?method=new&byuser=<?php echo $usr_id; ?>" title="Post Article">Post Article</a>
			</div>
		<?php } ?>

			<div id="inventcontent">

				<div style="padding: 30px 0px;">
						<h3>Recent Articles</h3>
						<ul class="book-ui">

							<?php

							/*----------------------------------------------------*/
							/**
							 * Recent Article
							 */

							 $sqlRecentArticle = "SELECT
								  mj_learn_article.*,
								  mj_learn_article_category.la_cat_name,
								  mj_learn_article.la_id,
								  mj_learn_article.la_visual As ArticleCover,
								  mj_learn_article.la_title As la_title1
								FROM
								  mj_learn_article INNER JOIN
								  mj_learn_article_category ON mj_learn_article.la_cat_id_fk =
								    mj_learn_article_category.la_cat_id
								WHERE mj_learn_article_category.la_cat_id = 4
								ORDER BY
								  mj_learn_article.la_id DESC LIMIT 48";
							 $sqlRecentResult	 = mysql_query($sqlRecentArticle);

							 while ($rowRecentArticle = mysql_fetch_object($sqlRecentResult)) {
						 		//echo '<li><a href="article-view-plain.php?aid='.$rowRecentArticle->la_id.'" class="viewOver">'.ucwords($rowRecentArticle->la_title).'</a> ('.$rowRecentArticle->la_dateposted.')<p>'
						 		//.short($rowRecentArticle->la_body).'</p></li>';
						 		echo '<li>';
						 		echo '<div style="width:75px; height:100px; overflow:hidden;">';
						 		echo '<a class="viewOver" href="full-article.php?articleId='.$rowRecentArticle->la_id.'">';
						 		echo '<img src="'.$rowRecentArticle->ArticleCover.'" width="75" original-title="'.$rowRecentArticle->la_title1.'" />';
						 		echo '</a>';
						 		echo '</div>';
						 		echo '</li>';
							 }

							?>
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

		<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">

			<div id="BrowseIdeaMore" style="margin-top:30px">
				<strong id="browseMore01" class="heading_title_two bebasTitle">Categories</strong>
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

					$rcatIdea = "SELECT
						  mj_learn_article_category.la_cat_id,
						  mj_learn_article_category.la_cat_name
						From
						  mj_learn_article_category
						Order By
						  mj_learn_article_category.la_cat_name";
					$qrIResult = mysql_query($rcatIdea);

					while ($rpwqrIResult = mysql_fetch_object($qrIResult)) {
						# code...

						$sqlTotalArticle = "SELECT
						  Count(mj_learn_article.la_id) As totalArticle
						From
						  mj_learn_article
						Where
						  mj_learn_article.la_cat_id_fk = '$rpwqrIResult->la_cat_id'";

						$sqlResultTotalArticle = mysql_query($sqlTotalArticle);
						$objectTotalCount = mysql_fetch_object($sqlResultTotalArticle);

						echo "<li>";
						echo "<span class='miniCircle2' style=width:15px;text-align:center;>".$objectTotalCount->totalArticle."</span>";
							echo "<a href='entrepreneur-library-category.php?librarycat=".$rpwqrIResult->la_cat_id."'>".$rpwqrIResult->la_cat_name."</a>";
						echo "</li>";
					}

					?>
					</ul>
			</div><!-- /BrowseIdeaMore -->	

			<div style="margin-top:30px; display:none">
				<strong id="recomForYou" class="thumb-up_color heading_title_two">Recommended for you</strong>
				<div style="margin-top:20px;">
					<?php  

					$recom		=	"SELECT
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
					Limit 3";

					$rrecom	=	mysql_query($recom);

					?>
					<ul class="recomList">
						<?php while($rowrcom = mysql_fetch_object($rrecom)){ ?>
						<li>
							<div>
								<div class="idea_small_pic left">
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
													  Count(mj_idea_comment.id_usr_id_fk) As totalComment
													From
													  mj_idea_comment
													Where
													  mj_idea_comment.id_post_id_fk = '$rowrcom->picId'";
										$rqComment  =mysql_query($qComment);
										$rowqComment=mysql_fetch_object($rqComment);

										echo number_format($rowqComment->totalComment);

										?>
									</span>
								</div><!-- /left -->
								<div class="clear"></div><!-- /clear -->
							</div><!-- /container -->
							</li>
						<?php } ?>
					</ul><!-- /browseIdeaList -->
				</div><!-- /recommend -->
			</div><!-- recommend for you -->
		</div><!-- /orange right -->

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


});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>