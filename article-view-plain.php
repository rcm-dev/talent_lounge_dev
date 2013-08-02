<?php  

include 'header-plain.php';
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

/*----------------------------------------------------------------------------------------*/
/**
 * Article View by id
 */

$getArticleId = (int) sqlInjectiString($_GET['aid']);

$sqlViewQuery = "SELECT
  mj_learn_article.la_id,
  mj_learn_article.la_title,
  mj_learn_article.la_body,
  mj_learn_article.la_visual,
  mj_learn_article.la_dateposted,
  mj_learn_article.la_article_by,
  mj_learn_article_category.la_cat_name,
  mj_learn_article.la_cat_id_fk
FROM
  mj_learn_article INNER JOIN
  mj_learn_article_category ON mj_learn_article.la_cat_id_fk =
    mj_learn_article_category.la_cat_id
WHERE
  mj_learn_article.la_id = '$getArticleId'";

$sqlViewResult	=	mysql_query($sqlViewQuery);
$rowViewArticle	=	mysql_fetch_object($sqlViewResult);

?>

<div>
	<div>

	<h1><?php echo $rowViewArticle->la_title; ?></h1>
			

	<?php echo $rowViewArticle->la_body; ?>

				<!-- Article View-->

				<div class="article-view top-grid"><br><br>
					<p><strong>Was this post useful to you?</strong>
					<form id="ratingForm" method="post">

					<div class="left">
						<input type="submit" class="button green" id="ratYes" name="ratYes" value="Yes" />
					</div>
					<div class="left" style="margin-left: 10px;">
						<input type="submit" class="button green" name="ratNo" id="ratNo" value="No" />
					</div>
					<div class="clear"></div>

					<input type="hidden" value="<?php echo $getArticleId; ?>" id="articleId" />
					</form>
					</p>
					<div id="thanksinfo" class="info" style="display:none">Thanks You.</div>
				</div><!-- Article View-->

				<div class="article-view top-grid">
					<p><strong>Related Article</strong></p>
					<ul>
						<?php

						/*----------------------------------------------------*/
						/**
						 * Related Article of page viewing
						 */

						 $sqlRelatedArticle = "SELECT
							  mj_learn_article.la_id,
							  mj_learn_article.la_title,
							  mj_learn_article.la_cat_id_fk,
							  mj_learn_article.la_rat_up
							FROM
							  mj_learn_article
							WHERE
							  mj_learn_article.la_cat_id_fk = '$rowViewArticle->la_cat_id_fk'
							ORDER BY
							  mj_learn_article.la_rat_up DESC
							LIMIT 5";

						 $sqlRelatedResult	= mysql_query($sqlRelatedArticle);

						 while ($rowRelArticle = mysql_fetch_object($sqlRelatedResult)) {
					 		echo '<li><a href="article-view-plain.php?aid='.$rowRelArticle->la_id.'">'.ucwords($rowRelArticle->la_title).'</a></li>';
						 }

						?>
					</ul>
				</div><!-- Article View-->

				<!-- COmment -->
				<div class="article-view top-grid">

				<div>
					<ul id="comment-list-plain">
					<?php  
					/**
					 * Comment List
					 */
					 $sComment = "SELECT
					  mj_learn_comment.la_comment_id,
					  mj_learn_comment.la_usr_id_fk,
					  mj_learn_comment.la_comment_body As comBody,
					  mj_learn_comment.la_comment_date As comDate,
					  mj_learn_comment.la_id_fk,
					  mj_users.usr_name As comName,
					  mj_learn_comment.la_id_fk As la_id_fk1,
					  mj_users.user_pic As usrPix
					From
					  mj_learn_comment Inner Join
					  mj_users On mj_learn_comment.la_usr_id_fk = mj_users.usr_id
					Where
					  mj_learn_comment.la_id_fk = '$getArticleId'";
					 $rsComment = mysql_query($sComment);
					 $numrowsComment = mysql_num_rows($rsComment);

					 if ($numrowsComment == 0) {
					 	
					 	echo "<h3><strong>Be the 1st to comment</strong></h3>";

					 } else {

					 	echo '<h3><strong>'.$numrowsComment . ' Respondses on '. $rowViewArticle->la_title . '</strong></h3><br/><br/>';

					 	while ($rowsComment = mysql_fetch_object($rsComment)) {
					?>

						<li class="comment-box">
						<div class="com-container">
							<div class="usrPix">
							<div class="profile-pic48">
								<img src="<?php echo $rowsComment->usrPix; ?>" width="48">
							</div>
							</div>
							<div style="float: left; margin-left:10px">
								<?php echo ucwords($rowsComment->comName); ?>,
								on <?php echo $rowsComment->comDate; ?> said:
								<br/>
								<p style="margin-top:10px;"><?php echo $rowsComment->comBody; ?></p>
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

				<div>
					<form method="post">
					<label><strong>Leave a Comment</strong></label><br/>
					<textarea id="commentbody" name="commentbody" style="width:450px; height: 80px;"></textarea><br/>
					<input type="submit" name="submitComment" id="submitComment" value="submit" class="button green" />
					<input type="hidden" name="usr_id" id="usr_id" value="<?php echo $usr_id; ?>" />
					<input type="hidden" name="la_id_fk" id="la_id_fk" value="<?php echo $getArticleId; ?>" />
					<div class="clear"></div>
					</form>
				</div>

				</div>
				<!-- /COmment -->

			</div>

			<div class="clear"></div>

</div>

<!-- get current email -->
<input type="hidden" name="aid" id="aid" value="<?php echo $getArticleId; ?>" />
<!-- /get current email -->


<script type="text/javascript">
$(document).ready(function(){

	/* get current email */
	var aid = $('input#aid').val();

	if (aid == '') {
		$('body').css('display', 'none');
		document.location.href = "index.php";
		console.log('Not Login');
	}
	else {
		console.log("Current Email => "+current_email);
	}
	/* /current email */
	

	var ratYes = $('#ratYes');
	var ratNo  = $('#ratNo');

	$('ratingform')
	$('#thanksinfo')


	// rating yes
	ratYes.click(function(){

		var articleId = $('#articleId').val();
		var ratTrue   = 1;
		
		//alert('clicked Yes');
		var dataString = 'articleId=' + articleId + '&ratYes=' + ratTrue;

		//alert(dataString);

		$.ajax({
			
				type: 	"POST",
				url: 	"ajax/ajax-rate-article.php",
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
		
		var articleId = $('#articleId').val();
		var ratTrue   = 0;
		
		//alert('clicked Yes');
		var dataString = 'articleId=' + articleId + '&ratYes=' + ratTrue;

		//alert(dataString);

		$.ajax({
			
				type: 	"POST",
				url: 	"ajax/ajax-rate-article.php",
				data: 	dataString,

				success: function(){
					
					//alert('Success');
					$('#thanksinfo').fadeIn('slow');
					$('form#ratingForm').hide();

				}

			});

		return false;

	});




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
			
			$('div.flash.error').fadeOut(200).show();
			$('div.flash.error').delay(3000).fadeOut('slow');
		
		} else {
			
			$('#loadcom').show();
			$('#loadcom').fadeIn(400);


			$.ajax({
				
				type: "POST",
				url: "ajax/ajax-submitcomment.php",
				data: dataCom,
				cache: false,

				success: function(html){
					$('div.flash.success').fadeOut(200).show();
					$('div.flash.success').delay(3000).fadeOut('slow');
					
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


	/* min-body */
	$('body').addClass('maxBody');

});


</script>

<?php  

/**
 * Include Footer
 */

include 'footer-plain.php';


?>