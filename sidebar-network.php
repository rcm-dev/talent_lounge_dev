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
         

          <div class="sidebar" style="border:1px solid purple;  width: 300px;  margin:10px; padding:5px; ">
                
	
<strong id="yaction01" class="heading_title_two bebasTitle">Network</strong>
	<div>Associate   112</div>
	<div>Monitored Company</div>
	<div>VIEWS</div>
	<div>LIKES</div>


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



<script type="text/javascript">
$(document).ready(function(){


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



  //
  });
</script>
