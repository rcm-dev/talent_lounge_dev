<?php  

/**
 * User preview
 * get by user id
 * select statement
 * display as user view
 */
include 'header.php';
include 'db/db-connect.php';

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
	mysql_real_escape_string(trim(htmlentities(htmlspecialchars($seoname))));

	return $seoname;
}

$get_user_id	=	(int) sqlInjectString($_GET['uid']);

$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_last_login As setLastlogin,
  mj_users.usr_email As setemail,
  mj_users.usr_id,
  mj_users.usr_name As currName,
  mj_users.usr_workat As WorkAt,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo,
  mj_users.usr_rating,
  mj_users.usr_core_activity,
  mj_users.mj_sector_fk,
  mj_users.mj_services_fk,
  mj_sector.sec_name,
  mj_services.services_name,
  mj_state.state_name,
  mj_country.country_name
From
  mj_users Inner Join
  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id Inner Join
  mj_country On mj_users.mj_country_id_fk = mj_country.country_id
Where
  mj_users.usr_id = '$get_user_id'";

$rusrSQL = mysql_query($usrSQL);
$rowviewusrSQL = mysql_fetch_object($rusrSQL);

// ==================================================================
//
// HTML Goes here
//
// ------------------------------------------------------------------

?>


<!-- <div id="content" class="<?php //if(!isset($_SESSION['usr_id'])) { echo "topfix"; } ?>"> -->
<div id="content">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" style="border:0px solid red;">

		<div class="heading">
			<h1 class="heading_title bebasTitle">User Profile</h1>
		</div>

		<div style="border:1px solid #ddd;">

			<?php if(isset($usr_email)) { ?>

			<?php if ($usr_id == $get_user_id) { ?>
			<div style="padding:10px; !important; background-color:#f4f4f4; text-align:right; display:none">	
			<?php } else { ?>
			<div style="padding:10px; !important; background-color:#f4f4f4; text-align:right;">
			<?php } ?>
				<a href="#" title="Rate Up" id="ratUp">
					<input type="hidden" name="currViewUsrID" id="currViewUsrID" value="<?php echo $get_user_id; ?>">
					<span id="rateuptext">Rate Up</span></a><span id="rateupresult"></span> &middot;
				<a href="#message-send" id="send-msg-btn" class="mail_arrow_color"><input type="hidden" name="currUsrId1" id="currUsrId1" value="<?php echo $usr_id; ?>">Send Message</a> &middot; 
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
							  mj_usr_network.usr_network_friend_usr_id_fk As isFriend,
							  mj_usr_network.usr_network_approved As isFriendStatus
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
									
									<?php if ($rowAlreadyFriend->isFriendStatus == 0) { ?>

										Followed
										
									<?php } else { ?>

										Waiting for Approved

									<?php } ?>
									
								<?php } ?>


							<?php } else { ?>


								
									
									<a href="#" id="send-request-friend">
									Follow <?php echo $rowviewusrSQL->currName; ?>
									</a>
									<input type="hidden" name="getviewuserid" id="getviewuserid" value="<?php echo $get_user_id; ?>">

									<input type="hidden" name="currUsrId" id="currUsrId" value="<?php echo $usr_id; ?>">
									
							
							<?php } ?>
					</div>
					<?php } ?>
			</div><!-- / -->
			<div style="border:1px solid #f1f1f1; background-color:#fff;">

				<div class="user-misc-view" style="border:0px solid green">
				
					<div style="border-right:0px solid #e1e1e1; width: 340px; padding-bottom: 30px; margin-bottom: 20px;" class="left left-arrow">
						
						<div class="left-profile" style="padding:10px;">
						<!-- <h3 style="font-weight: bold; color:#312F53">Profile</h3> -->

						<div class="user-profile-view">
							<div class="mj-profile">
								<div class="leftprofile">
									<div>
										<div style="background-image:url('<?php echo $rowviewusrSQL->usrPicture; ?>'); width:100px; height:100px; background-repeat:no-repeat; background-position: top center; background-size: 100%; background-color:#f1f1f1">
										
										<!-- <img src="<?php echo $rowviewusrSQL->usrPicture; ?>" width="64" /> -->

										</div>
									</div>
								</div>
								<div class="name">
								<strong><?php //echo ucfirst($rowviewusrSQL->currName); ?></strong><br/>
								<?php //echo $rowviewusrSQL->WorkAt; ?><br/>
								</div>

								<div class="clear"></div>

								<div style="border:0px solid red; margin-top: 20px;" class="none">
									<!-- <a href="#message-send" id="send-msg-btn" title="Send Message to <?php //echo $rowviewusrSQL->currName; ?>"><img src="images/sm.png" /></a> --><br/>
								</div>

							</div>
						</div><!-- / center profile -->

						<table border="0" cellpadding="3" cellspacing="3">
						  <tr>
						    <td colspan="3"><h2><?php echo ucwords($rowviewusrSQL->currName); ?></h2></td>
						  </tr>
						  <tr>
						  	<td colspan="3"><span class="card_address_color">Profile</span></td>
						  </tr>
						  <tr>
						    <td>Email</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowviewusrSQL->setemail; ?></td>
						  </tr>
						  <tr>
						    <td>Last Login</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowviewusrSQL->setLastlogin; ?></td>
						  </tr>
						  <tr>
						    <td>Phone No</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowviewusrSQL->currPhoneNo; ?></td>
						  </tr>
						  <tr>
						    <td>General Info</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowviewusrSQL->CurGenInfo; ?></td>
						  </tr>
						  <tr>
						    <td>Work at</td>
						    <td>&nbsp;
						    <td><?php echo $rowviewusrSQL->WorkAt; ?></td>
						  </tr>
						</table>
						</div>

						<div id="groupMemberOf" class="" style="padding:10px">
							<h3 style="font-weight: bold; color:#312F53" class="network-hub_color">Group members of</h3>

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


						<div style="border:0px solid red; padding:10px;" class="right-profile">
						<h3 style="font-weight: bold; color:#312F53" class="users_color">Network</h3>
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
						  mj_usr_network.usr_network_friend_usr_id_fk != '$get_user_id' And
						  mj_usr_network.usr_network_approved = 0";

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


					<div id="rightProfileView" class="right" style="padding:10px; width: 630px; border-left:1px solid #f1f1f1">
						<h3 style="font-weight: bold; color:#312F53">Reputation</h3>
						<p><?php echo $rowviewusrSQL->usr_rating; ?> people recommend this person.
						</p><br/>

						<h3 style="font-weight: bold; color:#312F53">Core Activities</h3>
						<p><?php echo $rowviewusrSQL->usr_core_activity; ?></p><br>

						<h3 style="font-weight: bold; color:#312F53" class="user-black">Major</h3>
						<p>Sector <?php echo ucwords($rowviewusrSQL->sec_name); ?> in <?php echo ucwords($rowviewusrSQL->services_name); ?>, Based in <?php echo ucwords($rowviewusrSQL->state_name); ?>.</p><br>

						<h3 style="font-weight: bold; color:#312F53"class="zone_money_color">Voting</h3>
						<p>
							<?php  

							$totalSpend = mysql_query("SELECT
													  Sum(mj_fund_pledged.fund_money) as TotalSum
													From
													  mj_fund_pledged
													Where
													  mj_fund_pledged.fund_usr_id_fk = '$get_user_id'
													Group By
													  mj_fund_pledged.fund_usr_id_fk");
							$rowTotalSpend = mysql_fetch_object($totalSpend);
							$nmTotalSpend = mysql_num_rows($totalSpend);

							if ($nmTotalSpend == NULL) {
								echo '0';
							}
							else {
								echo '<strong style="color:green">'.number_format($rowTotalSpend->TotalSum).'</strong>';
							}
							?>
							 voted in this site.
						</p><br>

						<h3 style="font-weight: bold; color:#312F53" class="sort-number-column">Activities</h3><br>
						<div>
							<?php 

							$sqlStoreByUser = "SELECT * FROM mj_market_store WHERE mms_usr_id_fk = '$get_user_id'";
							$resultStoreByUser = mysql_query($sqlStoreByUser);
							$numrowStoreByUser = mysql_num_rows($resultStoreByUser);

							if ($numrowStoreByUser != NULL) {
								
								echo "<strong>This user have open their own store</strong><br>";
								while ($rowobjectStore = mysql_fetch_object($resultStoreByUser)) {
									echo "<a href=\"store.php?sid=$rowobjectStore->mms_id\" title=\"Visit $rowobjectStore->mms_name\">$rowobjectStore->mms_name</a><br/>";
								}
							}

							?>
						</div><br><br>
						<div>
							<strong>Other Contibution</strong><br>
							<div class="left" style="margin-right: 40px;">
								<?php  

						  		// ==================================================================
						  		//
						  		// Total Upload
						  		//
						  		// ------------------------------------------------------------------
						  		$sqlTotalUpload = mysql_query("SELECT COUNT(*) As totalMarketUpload FROM mj_market_post WHERE mrket_usr_id_fk = '$get_user_id'");
						  		$rowTotalUpload = mysql_fetch_object($sqlTotalUpload);
						  		?>
						  		<span style="display:none">
						  			<h1><strong><?php echo $rowTotalUpload->totalMarketUpload ?></strong></h1>
						  		<small>submission in market</small>
						  		</span>
							</div><!-- /Market -->
							<div class="left" style="margin-right: 40px;">
								<?php  

						  		// ==================================================================
						  		//
						  		// Total Upload
						  		//
						  		// ------------------------------------------------------------------
						  		$sqlTotalUpload = mysql_query("SELECT COUNT(*) As totalSubmission FROM mj_idea_post WHERE id_usr_id_fk = '$get_user_id'");
						  		$rowTotalUpload = mysql_fetch_object($sqlTotalUpload);
						  		?>
						  		<h1><strong><?php echo $rowTotalUpload->totalSubmission ?></strong></h1>
						  		<small>contibution in invention</small>
							</div><!-- /invention -->
							<div class="left">
								<?php  

						  		// ==================================================================
						  		//
						  		// Total Upload
						  		//
						  		// ------------------------------------------------------------------
						  		$sqlTotalUpload = mysql_query("SELECT COUNT(*) As totalProject FROM mj_fund_post WHERE fund_usr_id_fk = '$get_user_id'");
						  		$rowTotalUpload = mysql_fetch_object($sqlTotalUpload);
						  		?>
						  		<h1><strong><?php echo $rowTotalUpload->totalProject ?></strong></h1>
						  		<small>contribution in showcase</small>
							</div><!-- /project -->
							<div class="clear"></div>
						</div>
						<br><br>

						<h3 style="font-weight: bold; color:#312F53" class="balloon-white_color">Latest update</h3>
						<?php  

						$latestUpdateUser = mysql_query("SELECT
											  mj_status.status_body As userStatus,
											  mj_status.status_date As StatusDate,
											  mj_status.status_usr_id_fk
											From
											  mj_status
											Where
											  mj_status.status_usr_id_fk = '$get_user_id'
											ORDER BY status_date DESC
											");
						$nmrow = mysql_num_rows($latestUpdateUser);
						if ($nmrow == 0) {
							echo 'No latest status yet';
						}
						else {

							echo '<ul class="lastUpdateUser">';
							while ($rowLatesUpdate = mysql_fetch_object($latestUpdateUser)) { ?>
							
							<li>
								<span class="pstatus" style="width:580px; word-wrap: break-word;"><?php echo $rowLatesUpdate->userStatus; ?></span><br>
								<span><?php echo $rowLatesUpdate->StatusDate; ?></span>
							</li>
						
						<?php 
							}
							echo '</ul>';
						} 
						?>
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
			<label>To: </label><strong><?php echo ucfirst($rowviewusrSQL->currName); ?></strong><br/><br/>
			<label>Message</label><br/>
			<textarea name="sendmessagebody" id="sendmessagebody" style="height:90px;"></textarea><br/>
			<input type="submit" value="Send Message" id="sm-button" class="button green" />
			<input type="hidden" name="messageto" id="messageto" value="<?php echo $get_user_id; ?>" />
			<input type="hidden" name="messageby" id="messageby" value="<?php echo $usr_id; ?>" />
		</form>
		<div id="messagesent" class="success none">Message Sent</div>
	</div>
</div>

<!-- /send message -->


<input type="hidden" name="page_title" value="<?php echo $rowviewusrSQL->currName; ?>" id="page_title" />


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


	/*rateup*/
	$('#ratUp').click(function(){

		var id = $('#currViewUsrID').val();

		$.ajax({

			url: "ajax/ajax-rate-up-user.php",
			type: "POST",
			data: "curruseridview="+id,

			success: function(html) {
				$('span#rateuptext').hide();
				$('span#rateupresult').fadeIn().append(html);
				//console.log(id);
			}

		});

		return false;

	});


});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>