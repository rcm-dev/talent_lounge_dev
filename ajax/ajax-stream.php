<strong>Status Update</strong>
<?php  


// include DB
include '../db/db-connect.php';

$usr_id 	= mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['id'])));



// get friend lists
$qFriend = "SELECT
  mj_users.usr_name As friendName,
  mj_status.status_body As statsBody,
  mj_status.status_date As statsDate,
  mj_users.usr_id As usrGetId,
  mj_users.user_pic As profilePic,
  mj_status.status_id As statsID
From
  mj_usr_network Inner Join
  mj_users On mj_users.usr_id = mj_usr_network.usr_network_friend_usr_id_fk
  Inner Join
  mj_status On mj_users.usr_id = mj_status.status_usr_id_fk
Where
  mj_usr_network.usr_network_usr_id_fk = '$usr_id' And
  mj_usr_network.usr_network_approved = 0
Order By
  mj_status.status_date Desc
LIMIT 0,20";

$rqFriend 		= mysql_query($qFriend);
$numrowqFriend 	= mysql_num_rows($rqFriend);


if ($numrowqFriend == 0) {
	echo "No network yet..";
} else {


while ($rowFriendList = mysql_fetch_object($rqFriend)) { ?>

<div id="<?php echo $rowFriendList->statsID; ?>" class="rowStatusUI" style="margin: 5px 0px; padding: 5px 0px; border-bottom:1px solid #e1e1e1;">
		
		<a href="users.php?uid=<?php echo $rowFriendList->usrGetId; ?>">
			<div class="profile-pic left" style="background-image: url('<?php echo $rowFriendList->profilePic; ?>')">
			
			</div>
		</a><!-- /profile-pic -->


		<div class="statusUpdateBody right" style="width:600px;">
			<p><a href="users.php?uid=<?php echo $rowFriendList->usrGetId; ?>" class="pname"><strong><?php echo ucwords($rowFriendList->friendName); ?></strong></a></p>
			<p class="statbodycloud pstatus" style="word-wrap: break-word;"><?php echo $rowFriendList->statsBody; ?></p>
			<div class="misc" style="margin-top:10px;">
				<div class="left">
					<strong class="commenticn none">No Comment</strong>
				</div><!-- /miscleft -->
				<div class="right">
					<?php echo $rowFriendList->statsDate; ?>
				</div><!-- /miscright -->
				<div class="clear"></div>
			</div><!-- /misc -->
		</div><!-- /body -->

		<div class="clear"></div>

</div><!-- /status -->	
	

<?php 
	} 

}

?>