<?php  

/**
 * User preview
 * get by user id
 * select statement
 * display as user view
 */
include 'header.php';
include 'db/db-connect.php';

# sqlinjection
function sqlInjectString($string) 
{

	$seoname = preg_replace('/\%/',' percentage',$string); 
	$seoname = preg_replace('/\@/',' at ',$seoname); 
	$seoname = preg_replace('/\&/',' and ',$seoname);
	$seoname = preg_replace('/\s[\s]+/','-',$seoname);    // Strip off multiple spaces 
	$seoname = preg_replace('/[\s\W]+/','-',$seoname);    // Strip off spaces and non-alpha-numeric 
	$seoname = preg_replace('/^[\-]+/','',$seoname); // Strip off the starting hyphens 
	$seoname = preg_replace('/[\-]+$/','',$seoname); // // Strip off the ending hyphens  
	//$seoname = trim(str_replace(range(0,9),'',$seoname));
	$seoname = strtolower($seoname);
	mysql_real_escape_string(trim(htmlentities($seoname)));

	return $seoname;
}

$get_user_id	=	sqlInjectString($_GET['pid']);

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
// HTML Goes here
//
// ------------------------------------------------------------------

$usrSQL = "SELECT
  _company.comp_id,
  _company.comp_pic As fundPic,
  _company.comp_name As fundName,
  _company.comp_desc As funDesc,
  mj_sector.sec_name As fsName,
  _company.comp_co_num As fCoNo,
  mj_state.state_name As fstateName,
  mj_services.services_name As fServisName
From
  _company Inner Join
  mj_sector On _company.mj_sector_fk = mj_sector.sec_id Inner Join
  mj_state On _company.mj_state_fk = mj_state.state_id Inner Join
  mj_services On _company.mj_services_fk = mj_services.services_id
Where
  _company.comp_id = '$get_user_id'";

$rusrSQL = mysql_query($usrSQL);
$rowcousrSQL = mysql_fetch_object($rusrSQL);



?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" style="border:0px solid red;">

		<div class="heading">
			<h1 class="heading_title">Funder Profile</h1>
		</div>

		<div class="">

			<div style="padding:10px; !important; background-color:#f4f4f4; text-align:right; border:1px solid #ddd; display: none;">
				<a href="#message-send" id="send-msg-btn" title="Send Message to <?php echo $rowusrSQL->currName; ?>"><input type="hidden" name="currUsrId1" id="currUsrId1" value="<?php echo $usr_id; ?>">Send Message</a> &middot; 
				<div id="followFriendBtn" style="border:0px solid red; float: right;">
				<?php  

							// ==================================================================
							//
							// Displayuser profile
							//
							// ------------------------------------------------------------------
							
							$qAlreadyFriend = "SELECT
							  mj_usr_network.usr_network_friend_usr_id_fk,
							  mj_usr_network.usr_network_usr_id_fk,
							  mj_usr_network.usr_network_friend_usr_id_fk As isFriend
							From
							  mj_usr_network
							Where
							  mj_usr_network.usr_network_usr_id_fk = '$usr_id' And
							  mj_usr_network.usr_network_friend_usr_id_fk = '$get_user_id'";
							
							$resultAlreadyFriend = mysql_query($qAlreadyFriend);
							$rowAlreadyFriend = mysql_fetch_object($resultAlreadyFriend);

							$numrowAlreadyFriend = mysql_num_rows($resultAlreadyFriend);
							

							if ($numrowAlreadyFriend == 1) { ?>
							
								<?php 

								$isFriend = $rowAlreadyFriend->isFriend; 

								if ($isFriend == $usr_id) { ?>

									

								<?php } else { ?>
									
									Followed
									
								<?php } ?>


							<?php } else { ?>


								
									
									<a href="#" id="send-request-friend">
									Follow
									</a>
									<input type="hidden" name="getviewuserid" id="getviewuserid" value="<?php echo $get_user_id; ?>">

									<input type="hidden" name="currUsrId" id="currUsrId" value="<?php echo $usr_id; ?>">
									
							
							<?php } ?>
					</div>
			</div><!-- / -->
			<div style="border:1px solid #f1f1f1; background-color:#fff;">

				<div class="user-misc-view" style="border:0px solid green">
				
					<div style="border-right:1px solid #e1e1e1; width: 340px; padding-bottom: 30px; margin-bottom: 20px;" class="left left-arrow">
						
						<div class="left-profile" style="padding:10px;">
						<h2>Details</h2>

						<div class="user-profile-view">
							<div class="mj-profile">
								<div class="leftprofile">
									<div style="background-image:url('<?php echo $rowcousrSQL->fundPic; ?>'); width:100px; height:100px; background-repeat:no-repeat; background-position: top center; background-size: 100%; background-color:#f1f1f1">
									
									<!-- <img src="<?php echo $rowusrSQL->usrPicture; ?>" width="64" /> -->

									</div>
								</div>
								<div class="name">
								<strong><?php //echo ucfirst($rowusrSQL->currName); ?></strong><br/>
								<?php //echo $rowusrSQL->WorkAt; ?><br/>
								</div>

								<div class="clear"></div>

								<div style="border:0px solid red; margin-top: 20px;" class="none">
									<!-- <a href="#message-send" id="send-msg-btn" title="Send Message to <?php //echo $rowusrSQL->currName; ?>"><img src="images/sm.png" /></a> --><br/>
								</div>

							</div>
						</div><!-- / center profile -->

						<table border="0" cellpadding="3" cellspacing="3">
						  <tr>
						    <td colspan="3"><h2><?php echo ucwords($rowcousrSQL->fundName); ?></h2></td>
						  </tr>
						  <tr>
						    <td>Co No.</td>
						    <td>&nbsp;
						    <td><?php echo $rowcousrSQL->fCoNo; ?></td>
						  </tr>
						  <tr>
						    <td>Sector</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowcousrSQL->fsName; ?></td>
						  </tr>
						  <tr>
						    <td>Services</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowcousrSQL->fServisName; ?></td>
						  </tr>
						  <tr>
						    <td>State</td>
						    <td>&nbsp;</td>
						    <td><?php echo ucwords($rowcousrSQL->fstateName); ?></td>
						  </tr>
						</table>
						</div>

						<div id="groupMemberOf" class="" style="padding:10px; display:none">
							<h2>Group members of</h2>

							<?php  


							$usr_id = $_GET['uid'];

							//echo "<h2 class=\"title\">Group</h2>";

							$selectGroupJoin = "SELECT
							  mj_network.mn_name As NetworkJoinName,
							  mj_network_relation.mn_id_fk As NetID
							From
							  mj_network Inner Join
							  mj_network_relation On mj_network_relation.mn_id_fk = mj_network.mn_id
							  Inner Join
							  mj_users On mj_network_relation.usr_id_fk = mj_users.usr_id
							Where
							  mj_network_relation.usr_id_fk = '$usr_id' And
							  mj_network_relation.mnr_status = 1";

							$resultSelectGroup = mysql_query($selectGroupJoin);
							$numrowsSelectGroup= mysql_num_rows($resultSelectGroup);

							if ($numrowsSelectGroup == 0) {
								echo "Does not contribute any groups";
							} else {

							?>

							<div id="GroupListUI" class="">
								<ul id="GroupListUIList">
									<?php while($rowGroupJoin = mysql_fetch_object($resultSelectGroup)) { ?>
									<li>
									<?php echo $rowGroupJoin->NetworkJoinName; ?>
									</li>
									<?php } ?>
								</ul>
							</div><!-- /GroupListUI -->

							<?php } ?>	
						</div><!-- /groupMemberOf -->


						<div style="border:0px solid red; padding:10px; display:none" class="right-profile">
						<h2>Network</h2>
						<?php

						// ==================================================================
						//
						// display friends
						//
						// ------------------------------------------------------------------
						
						$qFriend = "SELECT
						  mj_users.usr_name As friendName,
						  mj_users.usr_id As usrGetId,
						  mj_users.user_pic As usrPicture,
						  mj_users.usr_workat As WorkAt
						From
						  mj_usr_network Inner Join
						  mj_users On mj_users.usr_id = mj_usr_network.usr_network_friend_usr_id_fk
						Where
						  mj_usr_network.usr_network_usr_id_fk = '$get_user_id' And
						  mj_usr_network.usr_network_friend_usr_id_fk != '$get_user_id'";

						$rqFriend = mysql_query($qFriend);
						$numrowqFriend = mysql_num_rows($rqFriend);

						if ($numrowqFriend == 0) {
							
							echo "This user does not have any friends yet.";

						} else {

							echo '<ul class="friendsUserView">';

							while ($rowqFriend = mysql_fetch_object($rqFriend)) { ?>

						<li>
							<a href="users.php?uid=<?php echo $rowqFriend->usrGetId; ?>">
							<div class="namePic" original-title="<?php echo $rowqFriend->friendName; ?>">
								<div class="profile-pic48">
									<div style="width:48px; height:48px; background-position: top center; background-size: 100%; background-image:url('<?php echo $rowqFriend->usrPicture; ?>'); background-repeat: no-repeat;">
										
									</div>
									<!-- <img src="<?php echo $rowqFriend->usrPicture; ?>" width="48" /> -->
								</div>
							</div>
							</a>
							<div class="clear"></div>
						</li>

						<?php

							}

							echo '</ul>';
							
						}

						?>
						</div>


					</div><!-- / my profile -->


					<div id="rightProfileView" class="right" style="padding:10px; width: 630px; border:0px solid red">
						<h3>Descriptions</h3><br>
						<p><?php echo $rowcousrSQL->funDesc; ?></p><br/>
					</div><!-- /rightProfileView -->
					

					

					<div class="clear"></div>


					<div class="clear"></div>
				
				</div><!-- / user-misc-view -->

				<div class="clear"></div>

			</div>

		</div>

			
	</div><!-- /contentContainer -->

</div><!-- /content -->



<!-- send message -->

<div id="send-msg-container" class="none">
	<div id="message-send" style="height: 200px;">
		<form id="form-message" method="post">
			<label>To: </label><strong><?php echo ucfirst($rowusrSQL->currName); ?></strong><br/><br/>
			<label>Message</label><br/>
			<textarea name="sendmessagebody" id="sendmessagebody" style="height:90px;"></textarea><br/>
			<input type="submit" value="Send Message" id="sm-button" class="button green" style="border:0px solid #fff;" />
			<input type="hidden" name="messageto" id="messageto" value="<?php echo $get_user_id; ?>" />
			<input type="hidden" name="messageby" id="messageby" value="<?php echo $usr_id; ?>" />
		</form>
		<div id="messagesent" class="success none">Message Sent</div>
	</div>
</div>

<!-- /send message -->

<script type="text/javascript">
$(document).ready(function(){
	
	/*$('.user-misc-view').hover(function(){
		
		$('.user-misc-view .left-arrow .left-profile').fadeIn();
		$('.user-misc-view .right-arrow .right-profile').fadeIn();

	},function(){
		
		$('.user-misc-view .left-arrow .left-profile').fadeOut();
		$('.user-misc-view .right-arrow .right-profile').fadeOut();

	});*/

	$('#send-msg-btn').fancybox({
		'opacity'		: true,
		'overlayShow'	: true,
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'none'

	});


	$('#sm-button').click(function(){
		
		var sendmessagebody = $('#sendmessagebody').val();

		if (sendmessagebody == '') {
			alert('Enter your message');
		} else {

			var sendmessagebody = $('#sendmessagebody').val();
			var messageto   	= $('#messageto').val();
			var messageby   	= $('#currUsrId1').val();

			console.log('messageto=' + messageto + '&sendmessagebody=' + sendmessagebody + '&messageby=' + messageby);
			
			$.ajax({
				
				type: "POST",
				url: "ajax/send-message.php",
				data: 'messageto=' + messageto + '&sendmessagebody=' + sendmessagebody + '&messageby=' + messageby,
				cache: false,

				success: function(response){

					if (response == 1) {

						$('form#form-message').hide();
						//console.log('send');

						$('#messagesent').fadeIn();
						$('#message-send').css('height', '60px');

					} else {

						console.log('not send');						
					}
					
				}

			});

		}
		return false;
	});


	/* request friends */
	$('#send-request-friend').click(function(){
		
		var getuserviewid = $('#getviewuserid').val();
		var currUsrId	  = $('#currUsrId').val();

		$.ajax({
				
			type: "POST",
			url: "ajax/friend-requested.php",
			data: 'getuserviewid=' + getuserviewid + '&currUsrId=' + currUsrId,
			cache: false,

			success: function(html){

				var url_to_load = 'users.php?uid=';
				//$('#followFriendBtn').load(url_to_load+getuserviewid+ ' #followFriendBtn');
				$('#send-request-friend').hide();
				$('#followFriendBtn').fadeIn('slow').append(html);
				//console.log(url_to_load + 'DONE');
				
			}

		});

	});



	/* tipsy */
	$('.friendsUserView').find('li div.namePic').tipsy({gravity: 's'});


});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>