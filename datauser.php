<?php  


#
include 'db/db-connect.php';

#
$id	       = $_GET['id'];

#
$user      = "SELECT mj_services.services_name,
       mj_state.state_name,
       mj_sector.sec_name,
       mj_users.usr_name,
       mj_users.user_pic,
       mj_users.usr_workat
FROM mj_users
INNER JOIN mj_services ON mj_users.mj_services_fk = mj_services.services_id
INNER JOIN mj_state ON mj_users.mj_state_fk = mj_state.state_id
INNER JOIN mj_sector ON mj_users.mj_sector_fk = mj_sector.sec_id
WHERE mj_users.usr_id = '$id'";
$result    = mysql_query($user);
$rowobject = mysql_fetch_object($result);

?>
<div>
	<div class="profile-user left" style="margin-right:10px;">
		<img src="<?php echo $rowobject->user_pic; ?>" width="48" />
	</div>
	<div class="left">
		<strong><?php echo $rowobject->usr_name; ?></strong><br>
		<p><?php echo $rowobject->usr_workat; ?></p>
		<p>
			<?php echo $rowobject->sec_name; ?> &middot; <?php echo $rowobject->services_name; ?>
		</p>
	</div>
	<div class="clear"></div>
</div>