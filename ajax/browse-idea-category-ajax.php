
<?php  



/**
 * 
 * 
 * Browse Category idea AJAX LOAD
 */


require 'db/db-connect.php';
include 'class/short.php';

$qIdea 		= "SELECT
  mj_idea_post.*,
  mj_users.usr_name,
  mj_idea_category.id_cat_name,
  mj_idea_post.id_cat_id_fk As id_cat_id_fk1
FROM
  mj_idea_post INNER JOIN
  mj_users ON mj_idea_post.id_usr_id_fk = mj_users.usr_id INNER JOIN
  mj_idea_category ON mj_idea_post.id_cat_id_fk = mj_idea_category.id_cat_id
WHERE
  mj_idea_post.id_cat_id_fk = '$idea_cat_id'";
$qiResuult	= mysql_query($qIdea);

$catNo = mysql_num_rows($qiResuult);

if ($catNo != 0) {
	
echo '<ul>';
while ($rowI = mysql_fetch_object($qiResuult)) {

?>


<li>
	<div class="idea-image">
		<img src="<?php echo $rowI->id_pictures; ?>" width="110" height="110"></div>
	<div class="idea-info">
		<h3 style="text-align:left"><?php echo $rowI->id_title; ?></h3>
		<p><?php echo shortBrief($rowI->id_desc); ?></p>
		<div class="idea-by">
			<div class="idea-by-name">Submited by <?php echo $rowI->usr_name; ?></div>
			<div class="idea-details"><a href="idea-details.php?id=<?php echo $rowI->id_post_id; ?>"><em>View details</em></a></span></div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
	</li>
<?php } ?>
</ul>

<?php } else { ?>

<p>
No idea in this category.
</p>

<?php } ?>