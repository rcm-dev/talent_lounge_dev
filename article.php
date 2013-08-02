<?php  


include 'header.php';
include 'class/short.php';


?>

<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" class="">

	<div class="heading">
			<h1 class="heading_title">One Stop Business Startup</h1>
	</div>
	
			<div class="left cnscontainer">

				<div id="category" class="none">
					<strong>Filter by Category</strong>
					<select name="catid">
						<option value="1">Select One</option>
						<option value="1">Select One</option>
					</select>
				</div><!-- /category --><br><br>


				<h3>How-to Guides</h3>
				<ul class="book-ui" original-title="Testing">

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
						  mj_learn_article.la_id DESC LIMIT 16";
					 $sqlRecentResult	 = mysql_query($sqlRecentArticle);

					 while ($rowRecentArticle = mysql_fetch_object($sqlRecentResult)) {
				 		//echo '<li><a href="article-view-plain.php?aid='.$rowRecentArticle->la_id.'" class="viewOver">'.ucwords($rowRecentArticle->la_title).'</a> ('.$rowRecentArticle->la_dateposted.')<p>'
				 		//.short($rowRecentArticle->la_body).'</p></li>';
				 		echo '<li>';
				 		echo '<div style="width:75px; height:100px; overflow:hidden;">';
				 		echo '<a class="viewOver" href="article-view-plain.php?aid='.$rowRecentArticle->la_id.'">';
				 		echo '<img src="'.$rowRecentArticle->ArticleCover.'" width="75" original-title="'.$rowRecentArticle->la_title1.'" />';
				 		echo '</a>';
				 		echo '</div>';
				 		echo '</li>';
					 }

					?>
					<div class="clear"></div>
				</ul><br/>

				<h3>Recent Articles</h3>
				<ul class="book-ui" original-title="Testing">

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
						ORDER BY
						  mj_learn_article.la_id DESC LIMIT 16";
					 $sqlRecentResult	 = mysql_query($sqlRecentArticle);

					 while ($rowRecentArticle = mysql_fetch_object($sqlRecentResult)) {
				 		//echo '<li><a href="article-view-plain.php?aid='.$rowRecentArticle->la_id.'" class="viewOver">'.ucwords($rowRecentArticle->la_title).'</a> ('.$rowRecentArticle->la_dateposted.')<p>'
				 		//.short($rowRecentArticle->la_body).'</p></li>';
				 		echo '<li>';
				 		echo '<div style="width:75px; height:100px; overflow:hidden;">';
				 		echo '<a class="viewOver" href="article-view-plain.php?aid='.$rowRecentArticle->la_id.'">';
				 		echo '<img src="'.$rowRecentArticle->ArticleCover.'" width="75" original-title="'.$rowRecentArticle->la_title1.'" />';
				 		echo '</a>';
				 		echo '</div>';
				 		echo '</li>';
					 }

					?>
					<div class="clear"></div>
				</ul>


				<br/><br/>
				<h3>Most viewed</h3>
				<ul class="book-ui">

				<?php

				/*----------------------------------------------------*/
				/**
				 * Hot Article  Overall Category limit 5
				 */

				 $sqlRndmArticle = "SELECT * FROM mj_learn_article ORDER BY la_rat_up DESC LIMIT 5";
				 $sqlRndmResult	 = mysql_query($sqlRndmArticle);

				 while ($rowRndmArticle = mysql_fetch_object($sqlRndmResult)) {
			 		//echo '<li><a href="article-view.php?aid='.$rowRndmArticle->la_id.'">'.$rowRndmArticle->la_title.'</a></li>';
			 		echo '<li>';
			 		echo '<div style="width:75px; height:100px; overflow:hidden;">';
			 		echo '<a class="viewOver" href="article-view-plain.php?aid='.$rowRndmArticle->la_id.'">';
			 		echo '<img src="'.$rowRndmArticle->la_visual.'" width="75" original-title="'.$rowRndmArticle->la_title.'" />';
			 		echo '</a>';
			 		echo '</div>';
			 		echo '</li>';
				 }

				?>
				<div class="clear"></div>
				</ul>



			</div><!-- /orange right -->

			<!-- sidebar-connect n share -->

			<?php include 'sidebar-social.php'; ?>

			<div id="articleCat" class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
				<strong>Article Category</strong>
				<div>
					<ul id="listCatArticle" class="">
						<?php  
							$sqlArticleCat = "SELECT
								  mj_learn_article_category.*
								From
								  mj_learn_article_category";
							$resultArticleCat = mysql_query($sqlArticleCat);

							while ($rowArticleCat = mysql_fetch_object($resultArticleCat)) { ?>
							
							<li><a href="articlecategory.php?categoryid=<?php echo $rowArticleCat->la_cat_id; ?>" title="View By Category <?php echo ucwords($rowArticleCat->la_cat_name); ?>">
								<?php echo ucwords($rowArticleCat->la_cat_name); ?>
							</a></li>
						<?php
							}
						?>
					</ul><!-- /listCatArticle -->
				</div>
			</div><!-- /articleCat -->

			<!-- /sidebar-connect n share -->

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
	
	
	$(".viewOver").fancybox({

				'width'				: '100%',

				'height'			: '100%',

				'autoScale'			: true,

				'transitionIn'		: 'elastic',

				'transitionOut'		: 'elastic',

				'type'				: 'iframe'

	});


	$('.book-ui').find('li img').tipsy({gravity: 's'});
});

</script>


<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>