<?php  


include 'header.php';
include 'db/db-connect.php';


$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_id,
  mj_users.usr_name As currName,
  mj_users.usr_workat,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo
From
  mj_users
Where
  mj_users.usr_id = '$usr_id'";

$rusrSQL = mysql_query($usrSQL);
$rowusrSQL = mysql_fetch_object($rusrSQL);

// ==================================================================
//
// Set notification 0
//
// ------------------------------------------------------------------

$sqlSetNotification = "UPDATE mj_notification SET noti_status = 0 WHERE noti_to_usr_id = '$usr_id'";
$resultNoti = mysql_query($sqlSetNotification);

?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" >

		<div class="heading">
			<h1>Friend Requested</h1>
		</div>

		<div class="left cnscontainer">

			
			<div style="border:0px solid green;">
				
				<div>
						
					<input type="hidden" name="currID" id="currID" value="<?php echo $usr_id; ?>" />
					
				</div><!-- /.post-status -->

					
				<div class="connectTab none" style="text-align: left; border:0px solid red">
					<div id="tabmenu">
						<a href="#">
						Notification<span></span>
						</a>

						<a href="#">
						Idea Section<span></span>
						</a>

						<a href="#">
						Project Section<span></span>
						</a>

						<a href="#">
						Insert Free Ads<span></span>
						</a>

					</div>
				</div>

				

			</div>

			<div class="white" style="border-top:0px solid #cccccc; padding:10px">
				
				<!-- CHange Action -->

				<div id="connect-container">
					<div id="loadContainer">
						<?php  

						$urlnotiID = mysql_real_escape_string($_GET['notiID']);

						$notiDetail = "SELECT
						  mj_notification_type.noti_type_name,
						  mj_notification.noti_status,
						  mj_notification.noti_request_usr_id_fk,
						  mj_users.usr_name,
						  mj_users.user_pic
						From
						  mj_notification Inner Join
						  mj_notification_type On mj_notification.noti_type_id_fk =
						    mj_notification_type.noti_type_id Inner Join
						  mj_users On mj_notification.noti_request_usr_id_fk = mj_users.usr_id
						Where
						  mj_notification.noti_id = '$urlnotiID'";
						$resultNotiDetails = mysql_query($notiDetail);
						$rowNoTiDetails = mysql_fetch_object($resultNotiDetails);


						?>
						<strong>Friend Requested</strong><br><br>
						<div class="left">
							<a href="users.php?uid=<?php echo $rowNoTiDetails->noti_request_usr_id_fk; ?>" title="">
							<div class="profile-pic48">
								<img src="<?php echo $rowNoTiDetails->user_pic; ?>" width="48px" />
							</div>
							</a>
						</div>
						<div class="left" style="margin-left: 15px;">
							<a href="users.php?uid=<?php echo $rowNoTiDetails->noti_request_usr_id_fk; ?>" title="">
							<strong><?php echo $rowNoTiDetails->usr_name; ?></strong></a> want to follow with you.<br>
							<div id="action">
								<?php  

								/* Check status friend */
								$cFriend  = "SELECT * FROM mj_usr_network 
											WHERE usr_network_friend_usr_id_fk = '$rowNoTiDetails->noti_request_usr_id_fk'
											 AND usr_network_usr_id_fk = '$usr_id'";
								$rcFriend = mysql_query($cFriend);
								$rowrc    = mysql_fetch_object($rcFriend);

								if ($rowrc->usr_network_approved == 1) { ?>
									<a href="#" 
										title="Approve" 
										id="approvedStatus" 
										data-fk="<?php echo $rowNoTiDetails->noti_request_usr_id_fk; ?>" 
										data-usr="<?php echo $usr_id; ?>"
										style="color:green; font-weight: bold;">
										Approve
									</a>
								<?php 
								}
								else {
									echo '<strong style="color:blue">
									<img src="images/icon_color/xfn-friend-met.png" style="margin-top:10px;" /> Is Friend Now</strong>';
								}

								?>
							</div><!-- / -->
							<div id="actionResult" style="color:blue; font-weight:bold"></div>
						</div>
						<div class="clear"></div>
					</div>
				</div>

				<!-- /CHange Action -->
			</div>


		</div><!-- /orange left -->

		<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
			<strong>Clear Step</strong><br><br>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div><!-- /orange right -->

		<div class="clear"></div>


	</div><!-- /contentContainer -->

</div><!-- /content -->

<script type="text/javascript">
$(document).ready(function(){


	/*friend approved*/
	$('#approvedStatus').live('click', function(){

		var friendID   = $(this).attr('data-fk');
		var approvedBy = $(this).attr('data-usr');

		$.ajax({

			url: "ajax/friend_approved.php",
			data: 'approveUsrID='+friendID+'&approvedBy='+approvedBy,
			type: "POST",

			success:function(html){

				$('#action').hide();
				$('#actionResult').fadeIn().text(html);
				$.jnotify("Friend Approved");

			}

		});

		console.log('friendID = '+friendID+' &approvedBy = '+approvedBy);

	});


});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>