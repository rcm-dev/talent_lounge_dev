<!-- Discussion -->

<?php 

//require '../db/db-connect.php';
//require '../class/time.php';


//$viewnetwork = $_GET['viewnetwork'];

// Wall
/**
 * display network post
 * by network id
 * at network view
 */


$wallGroup = "SELECT
  mj_network_wall.nw_id As CurrentWallIDPost,
  mj_network_wall.nw_post_title As NetworkTitle,
  mj_network_wall.nw_date_posted As PostDate,
  mj_users.usr_name As postByName,
  mj_network_wall.nw_ntwrk_group_id_fk,
  mj_users.user_pic As posterImage,
  mj_users.usr_id As postUsrID
From
  mj_network_wall Inner Join
  mj_users On mj_network_wall.nw_posted_by = mj_users.usr_id
Where
  mj_network_wall.nw_ntwrk_group_id_fk = '$viewnetwork'
Order By nw_date_posted DESC";

$resultwallGroup = mysql_query($wallGroup);
$rowWallGroup	 = mysql_num_rows($resultwallGroup);

if ($rowWallGroup == 0) {
	
	echo "No Network post yet.";

} else {

echo '<ul class="nw-wall">';

/* grab object table */
while ($grabRowWallGroup = mysql_fetch_object($resultwallGroup)) {

?>

	<li class="gap">
		<div class="nw-users">
		<a href="users.php?uid=<?php echo $grabRowWallGroup->postUsrID; ?>">
		<div class="profile-pic48" style="background-image:url('<?php echo $grabRowWallGroup->posterImage; ?>')">
		
		</div>
		</a>
		</div>
		<div class="nw-details">
		<a href="users.php?uid=<?php echo $grabRowWallGroup->postUsrID; ?>"><strong><?php echo $grabRowWallGroup->postByName; ?></strong></a><br/>
		<?php echo $grabRowWallGroup->NetworkTitle; ?>
			<div class="nw-misc">
				<?php echo time_since($grabRowWallGroup->PostDate); ?>
				<?php //echo realtime($grabRowWallGroup->PostDate); ?>
				| <a href="#" id="<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contribute">Contibute</a>
			</div>
			<div class="nw-contribbute-<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>">
				<ul class="nw-ui-new">
					<?php  
						$currentwallpostid = $grabRowWallGroup->CurrentWallIDPost;

						$displayCommentWallPost = "SELECT
						  mj_network_comment.nc_body As commentBody,
						  mj_users.usr_name As commentByName,
						  mj_network_comment.nc_wall_id_fk,
						  mj_network_comment.nc_date_posted As commentDate,
						  mj_users.usr_id As commentByNameID
						From
						  mj_network_comment Inner Join
						  mj_users On mj_network_comment.nc_comment_by = mj_users.usr_id
						Where
						  mj_network_comment.nc_wall_id_fk = '$currentwallpostid'";

						$resultDisplayWallPost  = mysql_query($displayCommentWallPost);

						$numrowcommentpost		= mysql_num_rows($resultDisplayWallPost);

						if ($numrowcommentpost == 0) {
							//echo '<p style="padding:4px;">No Comment yet.</p>';
						} else {
							
							while ($commentwallpostobject = mysql_fetch_object($resultDisplayWallPost)) {
								
								echo '<li>';
								echo '<div>';
								echo '<a href="users.php?uid='.$commentwallpostobject->commentByNameID.'">';
								echo '<strong>'.$commentwallpostobject->commentByName.'</strong>';
								echo '</a>';
								echo '&nbsp;';
								echo $commentwallpostobject->commentBody;
								echo '<br/>';
								echo '<span class="nw-misc">'.time_since($commentwallpostobject->commentDate).'</span>';
								echo '</div>';
								echo '</li>';

								//echo $commentwallpostobject->commentDate;

							}

						}
					?>
				</ul>
				<div id="contributeMsg<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contributeMsg">
					<form method="post">
					<!-- <input type="text" name="contributepost" id="contributepost<?php //echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contributepost" style="width:350px;" /> -->

					<textarea name="contributepost" id="contributepost<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contributepost" style="width:400px; height:20px;" placeholder="Write your idea..."></textarea>
					<br/>
					<input type="submit" name="submitcomment" id="<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="submitcomment" />

					<input type="hidden" name="currentUserComment" id="currentUserComment<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="currentUserComment" value="<?php echo $usr_id; ?>" />
					<input type="hidden" name="currentWallID" id="currentWallID<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" value="<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" />
					</form>	
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</li>	
	
<?php 

		}
?>
		
	
<?php
	
	echo '</ul>';


	} 


?>

<!-- /Discussion -->