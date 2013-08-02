<a href="submit-idea.php" class="large button green">Submit Idea Now</a>

<h4>Recent submited</h4>
<ul>
<?php  


/**
 * 
 * 
 * 
 * Browse idea sidebar
 * Recent Submited
 * Browse more
 */

require 'db/db-connect.php';

$qrsbmited = "SELECT * FROM mj_idea_post ORDER BY id_post_id DESC LIMIT 0, 5";
$qrsResult = mysql_query($qrsbmited);

while ($rowqrs = mysql_fetch_object($qrsResult)) {
	
	echo '<li><a href="idea-details.php?id='.$rowqrs->id_post_id.'">'.$rowqrs->id_title.'</a></li>';

}

?>
</ul>


<h4>Browse More</h4>
<ul>
<?php  


/**
 * 
 * 
 * 
 * Browse idea sidebar
 * Recent Submited
 * Browse more
 */

require 'db/db-connect.php';

$rcatIdea = "SELECT * FROM mj_idea_category ORDER BY id_cat_name ASC";
$qrIResult = mysql_query($rcatIdea);

while ($rowqrI = mysql_fetch_object($qrIResult)) {
	
	echo '<li><a href="browse-idea-category.php?id='.$rowqrI->id_cat_id.'">'.$rowqrI->id_cat_name.'</a></li>';

}

?>
</ul>