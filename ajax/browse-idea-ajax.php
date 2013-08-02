<ul>
<?php  



/**
 * 
 * 
 * Browse idea AJAX LOAD
 */


require 'db/db-connect.php';
include 'class/short.php';

$qIdea 		= "SELECT
  mj_idea_post.*,
  mj_users.usr_name,
  mj_idea_post.id_rat_up As toprates
FROM
  mj_idea_post INNER JOIN
  mj_users On mj_idea_post.id_usr_id_fk = mj_users.usr_id
ORDER BY
  mj_idea_post.id_rat_up DESC
LIMIT 0,10";
$qiResuult	= mysql_query($qIdea);

while ($rowI = mysql_fetch_object($qiResuult)) {

?>


<li>
	<div class="idea-image">
		<img src="<?php echo $rowI->id_pictures; ?>" width="110"></div>
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