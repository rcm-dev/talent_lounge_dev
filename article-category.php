<?php  


include 'header.php';
include 'class/short.php';


$article_cat_id = mysql_escape_string(trim($_GET['id']));

$article_cat 	= "SELECT * FROM mj_learn_article_category WHERE la_cat_id = '$article_cat_id'";
$article_catR   = mysql_query($article_cat);
$rowarticleCat  = mysql_fetch_object($article_catR);


?>

		<div id="content" class="">
			
			<div id="contentContainer" class="">

<div id="mojo-container">

	<div class="heading">
			<h1 class="title">One Stop Business Startup Library</h1>
	</div>
	
	<div class="cnscontainer left">

		<div class="post-status">

			<h3>Recents</h3>
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
					WHERE
						mj_learn_article.la_cat_id_fk = '$article_cat_id'
					ORDER BY
					  mj_learn_article.la_id DESC LIMIT 16";
				 $sqlRecentResult	 = mysql_query($sqlRecentArticle);
				 $catnumrows         = mysql_num_rows($sqlRecentResult);

				 if ($catnumrows == 0) {
				 	echo 'No Article in this '.$rowarticleCat->la_cat_name. ' category.';
				 } else {



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

				}

				?>
				<div class="clear"></div>
			</ul>

		</div><!-- Article View-->

	</div>

	<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
		<div id="Recommendation">
			<strong>Recommended for you</strong>
		</div><!-- /Recommendation -->

		<div id="BrowseCategory">
			<strong>Browse by Category</strong>
			<ul class="book-ui-category">

			<?php

			/*----------------------------------------------------*/
			/**
			* Article Category
			*/

			$sqlCatArticle = "SELECT * FROM mj_learn_article_category";
			$sqlCatResult	 = mysql_query($sqlCatArticle);

			while ($rowCatArticle = mysql_fetch_object($sqlCatResult)) {
			echo '<li><a href="article-category.php?id='.$rowCatArticle->la_cat_id.'">'.ucwords($rowCatArticle->la_cat_name).'</a></li>';
			}

			?>

			</ul>
		</div><!-- /BrowseCategory -->
	</div><!-- /orange right -->

	<div class="clear"></div>

	</div>

</div>

			</div><!-- /contentContainer -->

		</div><!-- /content -->

<script type="text/javascript">

$(document).ready(function(){
	
	$(".viewOver").fancybox({

				'width'				: '70%',

				'height'			: '100%',

				'autoScale'			: false,

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