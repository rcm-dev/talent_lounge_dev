<?php 

/**
 * Database
 */

include '../db/db-connect.php';

if ($_POST) {


	$networkWall 	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['networkWall'])));
	$viewnetwork	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['viewnetwork'])));
	$currUserID		= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['currUserID'])));


	$sqlEmail = "INSERT INTO mj_network_wall (nw_id, nw_ntwrk_group_id_fk, nw_post_title, nw_posted_by) VALUES ('', '$viewnetwork', '$networkWall', '$currUserID')";

	$result = mysql_query($sqlEmail);
	//$numrow = mysql_num_rows($result);

	$newID = mysql_insert_id();

	//echo $newID;

	?>


	<?php  

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
	Order By nw_date_posted DESC 
	LIMIT 1";

	$resultwallGroup = mysql_query($wallGroup);
	$rowWallGroup	 = mysql_num_rows($resultwallGroup);

	if ($rowWallGroup == 0) {
		
		echo "No Network post yet.";

	} else {

	//echo '<div class="nw-wall" id="wallUI">';

		/* grab object table */
		while ($grabRowWallGroup = mysql_fetch_object($resultwallGroup)) {



	?>

	<div id="gap<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="gap">
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
				<?php echo $grabRowWallGroup->PostDate; ?>
				<?php //echo realtime($grabRowWallGroup->PostDate); ?>
				| <a href="#" id="<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contribute">Contibute</a>
			</div>
			<div id="nwcontribbute<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="nw-contribbute">
				<ul id="nw-ui-new<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="nw-ui-new">
					<?php  
						$currentwallpostid = $grabRowWallGroup->CurrentWallIDPost;

						$displayCommentWallPost = "SELECT
						  mj_network_comment.nc_body As commentBody,
						  mj_users.usr_name As commentByName,
						  mj_users.user_pic As usrPic,
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
								echo '<div class="left">';
								echo '<div class="profile-pic32">';
								echo '<img src="'.$commentwallpostobject->usrPic.'" width="34" />';
								echo '</div>';
								echo '</div>';
								echo '<div class="left commentFixed" style="margin:0px 0px 0px 10px;">';
								echo '<a href="users.php?uid='.$commentwallpostobject->commentByNameID.'">';
								echo '<strong>'.$commentwallpostobject->commentByName.'</strong>';
								echo '</a>';
								echo '&nbsp;';
								echo ' <span>'.$commentwallpostobject->commentBody.'</span>';
								echo '<br/>';
								echo '<span class="nw-misc">'.$commentwallpostobject->commentDate.'</span>';
								echo '</div>';
								echo '<div class="clear"></div>';
								echo '</li>';

								//echo $commentwallpostobject->commentDate;

							}

						}
					?>
				</ul>
				<div id="contributeMsg<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contributeMsg" style="background-color: #f1f1f1; padding:2px;">
					<form method="post">

					<div class="profile-pic32 left" style="margin:2px;">
						<?php  

						$sqlPicUsr = "SELECT mj_users.user_pic As usrPicture FROM mj_users WHERE usr_id = '$currUserID'";
						$resultPicUsr = mysql_query($sqlPicUsr);
						$rowusrSQL = mysql_fetch_object($resultPicUsr);

						?>
						<img src="<?php echo $rowusrSQL->usrPicture; ?>" width="32" />
					</div>
					<!-- <input type="text" name="contributepost" id="contributepost<?php //echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contributepost" style="width:350px;" /> -->

					<div class="left" style="margin:2px 0px 0px 4px;">
						<textarea name="contributepost" id="contributepost<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contributepost" style="width:400px; height:20px; padding:4px; font-family: Arial;" placeholder="Write your idea..."></textarea>
						<br/>
						<input type="submit" name="submitcomment" id="<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="submitcomment" />

						<input type="hidden" name="currentUserComment" id="currentUserComment<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="currentUserComment" value="<?php echo $currUserID; ?>" />
						<input type="hidden" name="currentWallID" id="currentWallID<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" value="<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" />
					</div>
					<div class="clear"></div>
					</form>	
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>


	<?php

		}

	}


}


?>