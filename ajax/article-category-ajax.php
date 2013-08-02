<ul>

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