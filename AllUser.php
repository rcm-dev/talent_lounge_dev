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
  
  mj_users.usr_general_info As CurGenInfo,
  mj_users.usr_rating,
  mj_users.usr_core_activity,
  mj_users.mj_sector_fk,
  mj_users.mj_services_fk,
  mj_sector.sec_name,
  mj_services.services_name As Profession,
  mj_state.state_name As Location,
  mj_country.country_name,
  jp_skills.skills_name As Skills,
  jp_edu_lists.edu_name As Education

From
  mj_users Inner Join
  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id Inner Join
  mj_country On mj_users.mj_country_id_fk = mj_country.country_id Inner Join
  jp_skills On jp_skills.user_id_fk = mj_users.users_id Inner Join
  jp_education On jp_education.user_id_fk = mj_users.users_id Inner Join
  jp_edu_lists On jp_education.edu_qualification = jp_edu_lists.edu_id 
  ";


$rusrSQL = mysql_query($usrSQL);
$rowviewusrSQL = mysql_fetch_object($rusrSQL);

// ==================================================================
//
// HTML Goes here
//
// ------------------------------------------------------------------

?>
<div id="filterSection">
	<div class="center" style="padding:2px 0px">
		<div style="padding-left: 8px;">
			<form action="showcase.php" method="get">
				<table>
					<tr>
						<td>Filter by Industry</td>
						<td>
							<select name="industry" id="industry">
								<option value="0">All Indstries</option>
							</select>
						</td>
						<td>Profession</td>
						<td>
							<select name="profession" id="profession">
								<option value="0">All Professions</option>
							</select>
						</td>
						<td>Location</td>
						<td>
							<select name="location" id="locatio">
								<option value="0">All Locations</option>
							</select>
						</td>
						<td>Categories</td>
						<td>
							<select name="Categories" id="Categories">
								<option value="0">All Categories</option>
							</select>
						</td>
						<td>Keyword</td>
						<td>
							<input type="text" name="q">
						</td>
						<td>
							<input type="submit">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>

<!-- <div id="content" class="<?php //if(!isset($_SESSION['usr_id'])) { echo "topfix"; } ?>"> -->
<div id="content">

	<?php //include 'quickpost.php'; ?>
	
	<div id="contentContainer" style="border:0px solid red;">

		<div class="heading">
			<h1 class="heading_title bebasTitle">Connect With Talents</h1>
		</div>
			<div style="border:1px solid #f1f1f1; background-color:#fff;">

				<div class="user-misc-view" style="border:0px solid green">
				
					<div style="border-right:0px solid #e1e1e1; width: 100px; padding-bottom: 30px; margin-bottom: 20px;" class="left left-arrow">
						
						<div class="left-profile" style="padding:10px;">
						<!-- <h3 style="font-weight: bold; color:#312F53">Profile</h3> -->

						<div class="user-profile-view">

							<div class="mj-profile">
								
								<div class="leftprofile">
											<?php 
		
		/***
		 *  show no data rsFLists
		 **/
		
		if($rowviewusrSQL == 0) { ?>
		
			<p>No Data</p>
		
		<?php } else { // End If no data for rsFLists ?>
		
		
		<ul id="freelancer-list">
			<?php 
		
			/***
			 *  show data rsFLists
			 **/
		
			while($rowviewusrSQL = mysql_fetch_object($rusrSQL)) { ?>
				
				<li>

										<div style="background-image:url('<?php echo $rowviewusrSQL->usrPicture; ?>'); width:100px; height:100px; background-repeat:no-repeat; background-position: top center; background-size: 100%; background-color:#f1f1f1">
										
										<!-- <img src="<?php echo $rowviewusrSQL->usrPicture; ?>" width="64" /> -->
								
										</div>
											<div><a href="connect_share_view.php?uid=<?php echo $rowviewusrSQL->usr_id; ?>" class="tl-btn-blue">View Profle!</a></div>


 <div style="padding:10px; !important; background-color:#f4f4f4; text-align:right;">
      
     
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


                
                  
                  <a href="#" id="send-request-friend" >
                  Follow <?php echo $rowviewusrSQL->currName; ?>
                  </a>
                  <input type="hidden" name="getviewuserid" id="getviewuserid" value="<?php echo $get_user_id; ?>">

                  <input type="hidden" name="currUsrId" id="currUsrId" value="<?php echo $usr_id; ?>">
                  
              
              <?php } ?>
          </div>
          
      </div><!-- / -->

								</div>
								<div class="name">
															
								</div>

								<div class="clear"></div>

								<div style="border:0px solid red; margin-top: 20px;" class="none">
									<!-- <a href="#message-send" id="send-msg-btn" title="Send Message to <?php //echo $rowviewusrSQL->currName; ?>"><img src="images/sm.png" /></a> --><br/>
								</div>

							</div>
						</div><!-- / center profile -->

						
						</div>

			
					</div><!-- / my profile -->


					<div id="ProfileView" class="right" style="padding:5px; width: 300px; border-left:1px solid #f1f1f1">

						<table border="0" cellpadding="3" cellspacing="3">
						  <tr>
						    <td colspan="3"><h2><?php echo ucwords($rowviewusrSQL->currName); ?></h2></td>
						  </tr>
						  <tr>
						  	<td colspan="3"><span class="card_address_color">Profile</span></td>
						  </tr>
						  <tr>
						    <td>Name</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowviewusrSQL->currName; ?></td>
						  </tr>
						  <tr>
						    <td> Profession</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowviewusrSQL->Profession; ?></td>
						  </tr>
						  <tr>
						    <td>Skills </td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowviewusrSQL->Skills; ?></td>
						  </tr>
						  <tr>
						    <td>Education </td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowviewusrSQL->Education; ?></td>
						  </tr>
						  <tr>
						    <td>Location</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowviewusrSQL->WorkAt; ?></td>
						  </tr>
						</table>
					


					</div><!-- /rightProfileView -->
					
				<div id="ProfileView2" class="right" style="padding:10px; width: 300px; border-left:1px solid #f1f1f1">

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
	
						





						
				</div>

				<div id="rightProfileView" class="right" style="padding:3px; width: 90px; border-left:1px solid #f1f1f1">

				</div>	

					<div class="clear"></div>


					<div class="clear"></div>
				
				</div><!-- / user-misc-view -->

				<div class="clear"></div>

			</div>

		</div>
</li>
		
			<?php } // End IF data rsFLists ?>
		
		</ul>

		<?php } // End List of Freelance Job Posts ?>
		
	</div>


	<br><br>
			
	<!-- /contentContainer -->
<!-- /content

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



/* request friends */
  $('#send-request-friend').click(function(){
    
    var getuserviewid = $('#getviewuserid').val();
    var currUsrId   = $('#currUsrId').val();

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