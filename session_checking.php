<?php  


//session_start();
$usr_email = @$_SESSION['usr_email'];
$usr_id    = @$_SESSION['usr_id'];
$usr_name  = @$_SESSION['usr_name'];

if (!isset($usr_email)) { ?>

<div class="left">
	<div>
		<img src="images/logo-talent.png" alt="Logo">
	</div>
</div>


<div id="user-panel" class="right" style="height:120px; line-height: 60px; padding: 0px 10px; padding-top: 10px; background:none;">
	<a href="register.php" title="Free to register" id="iregister" class="fancybox ui-user" style="margin-right: 30px;">
		Join Now!</a>
	
	<a href="login.php" title="Login" id="ilogin" class="ui-edit">
		Sign In</a>
</div><!-- /right -->
	

<?php } else { ?>

<div class="left">
	<div>
		<img src="images/logo-talent.png" alt="Logo">
	</div>
</div>

<div id="user-panel" class="right" style="border:0px solid orange; width: 180px; padding: 0px 10px;">
	
	<div class="left" style="border:0px solid blue;">

		<?php  

		// ==================================================================
		//
		// Get user info after login
		//
		// ------------------------------------------------------------------
		
		$usrSQL = "SELECT
		  user_pic As usrPicture,
		  usr_id
		From
		  mj_users
		Where
		  usr_id = '$usr_id'";

		$rusrSQL = mysql_query($usrSQL);
		$rowusrSQL = mysql_fetch_object($rusrSQL);
		?>

		<div class="4rad" style="width:18px height:18px; margin-top:0px; margin-right:5px; width:190px; text-align:right;">
			<div style="border-radius: 5px; overflow: hidden; height:50px; width:50px; text-align: center; float:left; margin-top:10px; margin-right: 10px;">
				<img src="<?php echo $rowusrSQL->usrPicture; ?>" widt="50px" height="50px" />
			</div>
			<div style="float:right; text-align:left; margin-top:10px; border:0px solid red; width: 120px;">
				Welcome <br><span id="userNamePanel"><?php echo $usr_name; ?></span>
				<br><span style="color:orange">My Profile</span>
			</div>
			<div style="clear:both"></div>
		</div><!-- /imgthumb -->
		
	</div><!-- /img -->
	

	<div class="" style="border:0px solid red; width: 100px; border:0px solid red; margin-left: 70px; padding-top:60px;">
		<div class="left">
			<a href="notification.php?id=<?php echo $usr_id; ?>" id="notification" style="margin-right:10px;">
			<div class="left">
				<img src="images/icons/ic_list.png" alt="setting" border="0" height="12" width="12" title="Notification" />
			</div>
			<?php 

			/*-------------------------------------------------------------*/
			/**
			 * Notification
			 */
			/*-------------------------------------------------------------*/

			$sqlNotification = "SELECT COUNT(*) AS ttlNoti FROM mj_notification WHERE noti_to_usr_id = '$usr_id' AND noti_status = '1'";

			$resultNoti	=	mysql_query($sqlNotification);
			$totalNoti	=	mysql_fetch_object($resultNoti);

			if (!$resultNoti) {
				echo 'Error';
			} else {
				$totalNotiView = $totalNoti->ttlNoti;


			if ($totalNotiView >= 1) { ?>
				
				<div class="left notificationIcon">
					<?php echo $totalNotiView; ?>
				</div>
			<?php } else { ?>
				
				<div class="left notificationDefault">
					<?php echo $totalNotiView; ?>
				</div>

			<?php } } ?>
				<div class="clear"></div>
			</a>
		</div>
		<div class="left">
			<a href="myinbox.php?id=<?php echo $usr_id; ?>">
			<div class="left">
				<img src="images/icons/ic_mail.png" alt="setting" border="0" height="12" width="12" title="Message" />
			</div>
			<?php  

			// ==================================================================
			//
			// notification message
			//
			// ------------------------------------------------------------------
			$sqlMsg = "SELECT
						  Count(mj_message.msg_id) AS TotalUnread
						From
						  mj_message
						Where
						  mj_message.msg_to = '$usr_id' And
						  mj_message.msg_status = 1";
			$resultMsg = mysql_query($sqlMsg);
			$rowObject = mysql_fetch_object($resultMsg);

			$NewTotalUnread = $rowObject->TotalUnread;

			if ($NewTotalUnread >= 1) {
				echo '<div class="left notificationIcon">';
				echo $NewTotalUnread;
				echo '</div>';
			}
			else {
				echo '<div class="left notificationDefault">';
				echo $NewTotalUnread;
				echo '</div>';	
			}

			?>
			<div class="clear"></div>
			</a>
		</div>
		<div class="left">
			<a href="editprofile.php?id=<?php echo $usr_id; ?>" style="margin:0px 10px;">
			<img src="images/icons/ic_settings.png" alt="setting" border="0" height="12" width="12" title="Edit Profile" />
		</a>
		</div>
		<div class="left">
			<a href="logout.php" title="Logout">
				<img src="images/icons/ic_power.png" alt="setting" border="0" height="12" width="12" title="Logout" />
			</a>
		</div>
		<div class="clear"></div>
	</div><!-- /details -->

	<div class="clear"></div>

</div><!-- /right -->




<?php } ?>