<?php  


/**
 * User friends View
 */



include '../db/db-connect.php';
//include '../session_checking.php';

$usr_id = $_GET['id'];

echo "<strong class=\"title\">My Network</strong>";



echo '<div class="white">';

$qFriend = "SELECT
  mj_users.usr_name As friendName,
  mj_users.usr_id As usrGetId,
  mj_users.user_pic As usrPicture,
  mj_users.usr_workat As WorkAt
From
  mj_usr_network Inner Join
  mj_users On mj_users.usr_id = mj_usr_network.usr_network_friend_usr_id_fk
Where
  mj_usr_network.usr_network_usr_id_fk = '$usr_id' And
  mj_usr_network.usr_network_friend_usr_id_fk != '$usr_id'";

$rqFriend 		= mysql_query($qFriend);
$numrowqFriend 	= mysql_num_rows($rqFriend);

if ($numrowqFriend == 0) {
	
	echo "You dont have any friends yet.";

} else {
		

	echo '<ul class="friendsView">';

	while ($rowqFriend = mysql_fetch_object($rqFriend)) { 

		// disable own profile
		
		/*if ($rowqFriend->usrGetId == $usr_id) {

		} else {*/
			
		
	?>
		
	<li>
		<a href="users.php?uid=<?php echo $rowqFriend->usrGetId; ?>">
		<div>
			<div class="profile-pic" style="background-image: url(<?php echo $rowqFriend->usrPicture; ?>); background-repeat: no-repeat; background-size: 100%; margin:0 auto;">
				<!-- <img src="" width="64" /> -->
			</div>
		</div>
		</a>
		<div class="nameDesc" style="margin-top:15px;"><strong><?php echo ucwords($rowqFriend->friendName); ?></strong>
		<br/>
		<span style="color:#50021B; font-size:11px;"><?php echo ucwords($rowqFriend->WorkAt); ?></span>
		<div style="border:1px solid red;">
			<input type="hidden" name="currUsrId1" id="currUsrId<?php echo $rowqFriend->usrGetId; ?>" value="<?php echo $rowqFriend->usrGetId; ?>"/>
			<a href="#" title="Send Message" class="send-msg-btn">Send Message</a>
		</div>
		</div>
		<div class="clear"></div>
	</li>

<?php
	//} // else
		

	}

	echo '</ul>';
	echo '<div class="clear"></div>';
	echo '</div>';
	
}

?>