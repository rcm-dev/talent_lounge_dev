<?php  


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

$get_user_id	=	sqlInjectString($_GET['uid']);


$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_last_login As setLastlogin,
  mj_users.usr_email As setemail,
  mj_users.usr_id,
  _company.comp_name As WorkAt,
  mj_users.usr_name As currName,
  mj_users.usr_workat,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo
From
  mj_users Inner Join
  _company On mj_users.usr_workat = _company.comp_co_num
Where
  mj_users.usr_id = '$get_user_id'";

$rusrSQL = mysql_query($usrSQL);
$rowusrSQL = mysql_fetch_object($rusrSQL);

?>


<div id="mojo-container">
	
	<div class="container_24">
		<div class="home_container">

		<div class="">

			<div style="padding: 13px 0px 0px 13px; border:0px solid red; padding">

				<div class="user-misc-view" style="border:0px solid green">
				
					<div style="border:1px solid #edf4fa; width: 340px; float:left; margin-right: 20px;" class="left-arrow">
						
						<div style="padding-top:100px; display: none" class="left-profile">
						<h2>My Profile</h2>
						<table border="0" cellpadding="3" cellspacing="3">
						  <tr>
						    <td>Username</td>
						    <td>&nbsp;</td>
						    <td><?php echo ucwords($rowusrSQL->currName); ?></td>
						  </tr>
						  <tr>
						    <td>Email</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowusrSQL->setemail; ?></td>
						  </tr>
						  <tr>
						    <td>Last Login</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowusrSQL->setLastlogin; ?></td>
						  </tr>
						  <tr>
						    <td>Phone No</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowusrSQL->currPhoneNo; ?></td>
						  </tr>
						  <tr>
						    <td>General Info</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowusrSQL->CurGenInfo; ?></td>
						  </tr>
						  <tr>
						    <td>Work at</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowusrSQL->WorkAt; ?></td>
						  </tr>
						</table>
						</div>

					</div><!-- / my profile -->

					<div class="user-profile-view" style="border:0px solid red; width:200px; margin: 0 auto; float:left">
						<div class="mj-profile">
							<div class="leftprofile">
								<div class="circleView2">
								
								<img src="<?php echo $rowusrSQL->usrPicture; ?>" style="height: auto; width:100;" width="64" />

								</div>
							</div>
							<div class="name">
							<strong><?php echo ucfirst($rowusrSQL->currName); ?></strong><br/>
							<?php echo $rowusrSQL->WorkAt; ?><br/>
							</div>

							<div class="clear"></div>

							<div style="border:0px solid red; margin-top: 20px;">
								<a href="#message-send" id="send-msg-btn" title="Send Message to <?php echo $rowusrSQL->currName; ?>"><img src="images/sm.png" /></a><br/>
							<?php  

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
									echo "sama";
								<?php } else { ?>
									
									<img src="images/alf.png" title="You already friend with <?php echo $rowusrSQL->currName; ?>" />

								<?php } ?>


							<?php } else { ?>


								
									
									<a href="#" id="send-request-friend">
									<img src="images/af.png" title="Add <?php echo $rowusrSQL->currName; ?> as friend" />
									</a>

								

							
							<?php } ?>
							</div>

						</div>
					</div><!-- / center profile -->

					<div style="border:1px solid #e8eff3; width: 340px; float:left; margin-left: 20px;" class="right-arrow">
						
						<div style="border:0px solid #edf4fa; padding-top:100px; display: none" class="right-profile">
						<h2>My Friends</h2>
						<?php

						$qFriend = "SELECT
						  mj_users.usr_name As friendName,
						  mj_users.usr_id As usrGetId,
						  mj_users.user_pic As usrPicture,
						  mj_users.usr_workat As WorkAt,
						  mj_usr_network.usr_network_approved,
						  _company.comp_name As CompanyName
						From
						  mj_users Inner Join
						  mj_usr_network On mj_usr_network.usr_network_friend_usr_id_fk =
						    mj_users.usr_id Inner Join
						  _company On mj_users.usr_workat = _company.comp_co_num
						Where
						  mj_usr_network.usr_network_approved = 0 And
						  mj_usr_network.usr_network_usr_id_fk = '$get_user_id'";

						$rqFriend = mysql_query($qFriend);
						$numrowqFriend = mysql_num_rows($rqFriend);

						if ($numrowqFriend == 0) {
							
							echo "This user does not have any friends yet.";

						} else {

							echo '<ul class="friendsUserView">';

							while ($rowqFriend = mysql_fetch_object($rqFriend)) { ?>

						<li>
							<a href="users.php?uid=<?php echo $rowqFriend->usrGetId; ?>">
							<div class="namePic">
								<div class="circleView2">
									<img src="<?php echo $rowqFriend->usrPicture; ?>" class="height: auto; width: 100%;" width="64" />
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

					</div><!-- / my friends -->

					<div class="clear"></div>
				
				</div><!-- / user-misc-view -->

				<div class="clear"></div>

			</div>

		</div>

			
		</div>
	</div>

</div>



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

<div id="mojo-copyright">
		<div class="mojo-footer-subcontainer container_24">
			<div class="grid_4">
				<p>Mojo &copy; <?php echo date('Y'); ?></p>
			</div>
			<div class="mj-footer-link grid_20 omega">
				<p><a href="#">Privacy</a> &middot; <a href="#">Term</a> &middot; <a href="#">Help</a></p>
			</div>
			<div class="clear"></div>
		</div>
</div><!-- /copyright -->

<script type="text/javascript">
$(document).ready(function(){
	
	$('.user-misc-view').hover(function(){
		
		$('.user-misc-view .left-arrow .left-profile').fadeIn();
		$('.user-misc-view .right-arrow .right-profile').fadeIn();

	},function(){
		
		$('.user-misc-view .left-arrow .left-profile').fadeOut();
		$('.user-misc-view .right-arrow .right-profile').fadeOut();

	});

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
			var messageby   	= $('#messageby').val();

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


});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>