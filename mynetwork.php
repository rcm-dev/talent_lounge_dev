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



?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" >

		<div class="heading">
			<h1 class="heading_title bebasTitle">Network Stream</h1>
		</div>

		<div class="left cnscontainer">

			
			<div style="border:0px solid green;">
				
				<div class="post-status none">
						
					<form action="#" method="get" accept-charset="utf-8">

						<div>
							<input type="hidden" name="currID" id="currID" value="<?php echo $usr_id; ?>" />
						</div>	

					</form><!-- post-status-form -->
					
				</div><!-- /.post-status -->

				

			</div>

			<div class="white" style="border-top:0px solid #cccccc; padding:10px">
				
				<!-- CHange Action -->

				<div id="connect-container">
					

					<strong>My Friends</strong><br><br>

					<!-- form -->

					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="get" accept-charset="utf-8" class="left">
						<strong>Filter Friends by</strong>
						<select name="searchsector" id="searchsector">
							<option value="0">All Sector</option>
							<?php  

							$qsec          	= "SELECT
											  mj_sector.sec_id As secID,
											  mj_sector.sec_name As secName
											From
											  mj_sector";
							$resultsec     	= mysql_query($qsec);

							while ($rowsec 	= mysql_fetch_object($resultsec)) { ?>
								
								<option value="<?php echo $rowsec->secID; ?>">
									<?php echo ucwords($rowsec->secName); ?></option>
						
							<?php } ?>
						</select>
										
						<select name="searchProduct" id="searchProduct">
							<option value="0">All Product / Services</option>
						</select>
						<input type="submit" name="submit" value="Filter" />
					</form>

					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="get" class="left">
					<strong>&nbsp;or by Area</strong>

						<select name="searchnetworkarea" id="searchnetworkarea">
							<option value="0">All Area</option>
							<?php  

							$qstat           = "SELECT
											  mj_state.state_id as stateID,
											  mj_state.state_name As stateName
											From
											  mj_state";
							$resultqstat     = mysql_query($qstat);

							while ($rowstat   = mysql_fetch_object($resultqstat)) { ?>
								
								<option value="<?php echo $rowstat->stateID; ?>">
									<?php echo $rowstat->stateName; ?></option>
						
							<?php } ?>
						</select>
						<input type="submit" name="submit" value="filter" />
					</form>
					<div class="clear"></div><br><br>
					<!-- /form -->
					<?php  


					$searchsector  = (int) sqlInjectString(@$_GET['searchsector']);
					$searchProduct = (int) sqlInjectString(@$_GET['searchProduct']);
					$searchnetworkarea = (int) sqlInjectString(@$_GET['searchnetworkarea']);

					if ($searchnetworkarea == 0) {

						// display friend all area
						$qFriend = "SELECT
						  mj_users.usr_name As friendName,
						  mj_users.usr_id As usrGetId,
						  mj_users.user_pic As usrPicture,
						  mj_users.usr_workat As CompanyName,
						  mj_services.services_name As serviceName,
						  mj_sector.sec_name As secName,
						  mj_state.state_name As stateName
						From
						  mj_usr_network Inner Join
						  mj_users On mj_users.usr_id = mj_usr_network.usr_network_friend_usr_id_fk
						  Inner Join
						  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
						  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
						  mj_state On mj_users.mj_state_fk = mj_state.state_id
						Where
						  mj_usr_network.usr_network_usr_id_fk = '$usr_id' And
						  mj_usr_network.usr_network_friend_usr_id_fk != '$usr_id' And
						  mj_usr_network.usr_network_approved = 0";

						$rqFriend 		= mysql_query($qFriend);
						$numrowqFriend 	= mysql_num_rows($rqFriend);
					}
					elseif ($searchnetworkarea != 0) {

						// display friend by area
						$qFriend = "SELECT
						  mj_users.usr_name As friendName,
						  mj_users.usr_id As usrGetId,
						  mj_users.user_pic As usrPicture,
						  mj_users.usr_workat As CompanyName,
						  mj_services.services_name As serviceName,
						  mj_sector.sec_name As secName,
						  mj_state.state_name As stateName
						From
						  mj_usr_network Inner Join
						  mj_users On mj_users.usr_id = mj_usr_network.usr_network_friend_usr_id_fk
						  Inner Join
						  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
						  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
						  mj_state On mj_users.mj_state_fk = mj_state.state_id
						Where
						  mj_usr_network.usr_network_usr_id_fk = '$usr_id' And
						  mj_usr_network.usr_network_friend_usr_id_fk != '$usr_id' And
						  mj_usr_network.usr_network_approved = 0 And
						  mj_users.mj_state_fk = '$searchnetworkarea'";

						$rqFriend 		= mysql_query($qFriend);
						$numrowqFriend 	= mysql_num_rows($rqFriend);
					}
					if ($searchsector == 0 && $searchProduct == 0) {
						$qFriend = "SELECT
						  mj_users.usr_name As friendName,
						  mj_users.usr_id As usrGetId,
						  mj_users.user_pic As usrPicture,
						  mj_users.usr_workat As CompanyName,
						  mj_services.services_name As serviceName,
						  mj_sector.sec_name As secName,
						  mj_state.state_name As stateName
						From
						  mj_usr_network Inner Join
						  mj_users On mj_users.usr_id = mj_usr_network.usr_network_friend_usr_id_fk
						  Inner Join
						  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
						  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
						  mj_state On mj_users.mj_state_fk = mj_state.state_id
						Where
						  mj_usr_network.usr_network_usr_id_fk = '$usr_id' And
						  mj_usr_network.usr_network_friend_usr_id_fk != '$usr_id' And
						  mj_usr_network.usr_network_approved = 0";

						$rqFriend 		= mysql_query($qFriend);
						$numrowqFriend 	= mysql_num_rows($rqFriend);
					}
					elseif ($searchsector != 0 && $searchProduct == 0) {


						$qFriend = "SELECT
						  mj_users.usr_name As friendName,
						  mj_users.usr_id As usrGetId,
						  mj_users.user_pic As usrPicture,
						  mj_users.usr_workat As CompanyName,
						  mj_services.services_name As serviceName,
						  mj_sector.sec_name As secName,
						  mj_state.state_name As stateName
						From
						  mj_usr_network Inner Join
						  mj_users On mj_users.usr_id = mj_usr_network.usr_network_friend_usr_id_fk
						  Inner Join
						  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
						  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
						  mj_state On mj_users.mj_state_fk = mj_state.state_id
						Where
						  mj_usr_network.usr_network_usr_id_fk = '$usr_id' And
						  mj_usr_network.usr_network_friend_usr_id_fk != '$usr_id' And
						  mj_usr_network.usr_network_approved = 0 And
						  mj_users.mj_sector_fk = '$searchsector'";

						$rqFriend 		= mysql_query($qFriend);
						$numrowqFriend 	= mysql_num_rows($rqFriend);
					}
					if ($searchsector != 0 && $searchProduct != 0) {
						$qFriend = "SELECT
						  mj_users.usr_name As friendName,
						  mj_users.usr_id As usrGetId,
						  mj_users.user_pic As usrPicture,
						  mj_users.usr_workat As CompanyName,
						  mj_services.services_name As serviceName,
						  mj_sector.sec_name As secName,
						  mj_state.state_name As stateName
						From
						  mj_usr_network Inner Join
						  mj_users On mj_users.usr_id = mj_usr_network.usr_network_friend_usr_id_fk
						  Inner Join
						  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
						  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
						  mj_state On mj_users.mj_state_fk = mj_state.state_id
						Where
						  mj_usr_network.usr_network_usr_id_fk = '$usr_id' And
						  mj_usr_network.usr_network_friend_usr_id_fk != '$usr_id' And
						  mj_usr_network.usr_network_approved = 0 And
						  mj_users.mj_sector_fk = '$searchsector' And
						  mj_users.mj_services_fk = '$searchProduct'";

						$rqFriend 		= mysql_query($qFriend);
						$numrowqFriend 	= mysql_num_rows($rqFriend);
					}



					if ($numrowqFriend == 0) {
						
						echo "You dont have any friends yet.";

					} else {
							

						echo '<ul class="friendsView">';

						while ($rowqFriend = mysql_fetch_object($rqFriend)) { 

							// disable own profile
							
							if ($rowqFriend->usrGetId == $usr_id) {

							} else {
								
							
						?>
							
						<li>
							<a href="users.php?uid=<?php echo $rowqFriend->usrGetId; ?>">
							<div class="namePic left">
								<div class="profile-pic">
									<img src="<?php echo $rowqFriend->usrPicture; ?>" class="height: auto; width: 100%;" width="64" />
								</div>
							</div>
							</a>
							<div class="nameDesc right" style="width:180px;">
								<strong><?php echo ucwords($rowqFriend->friendName); ?></strong>
								<br/><div style="font-size:11px;">
								<span><?php echo ucwords($rowqFriend->secName); ?></span> in <br/>
								<span><?php echo ucwords($rowqFriend->serviceName); ?></span><br/>
								<span><?php echo ucwords($rowqFriend->stateName); ?></span></div><br/>
								<div class="usermisc" style="color:#50021B; font-size:11px;">
									<span class="briefcase_color"><?php echo ucwords($rowqFriend->CompanyName); ?></span><br>
									<span class="mail_color" style="margin-top:90px !important;"><a href="send-message.php?fid=<?php echo $rowqFriend->usrGetId; ?>&messageby=<?php echo $usr_id; ?>" id="<?php echo $rowqFriend->usrGetId; ?>" class="sendFriendMessage">Send Message</a></span>
								</div>
							</div>
							<div class="clear"></div>
						</li>

					<?php
						} // else
							

						}

						echo '<div class="clear"></div>';
						echo '</ul>';
						
					}

					?>

					<div class="clear"></div>
				</div>

				<!-- /CHange Action -->

			</div>


		</div><!-- /orange left -->

		<!-- sidebar-connect n share -->

		<?php include 'sidebar-social.php'; ?>

		<!-- /sidebar-connect n share -->

		<div class="clear"></div>


	</div><!-- /contentContainer -->

</div><!-- /content -->


<!-- get current email -->
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />
<!-- /get current email -->


<script type="text/javascript">
$(document).ready(function(){

	/* get current email */
	var current_email = $('input#current_email').val();

	if (current_email == '') {
		$('body').css('display', 'none');
		document.location.href = "index.php";
		console.log('Not Login');
	}
	else {
		console.log("Current Email => "+current_email);
	}
	/* /current email */


	$('.sendFriendMessage').fancybox({

		'width'				: '50%',

		'height'			: '50%',

		'autoScale'			: false,

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'type'				: 'iframe'

	});


	/* Change services */
	$('#searchsector').change(function(){

		var sectorID = $(this).val();
	

		$('#searchProduct').load('ajax/ajax-selectsector.php?sectorid='+sectorID);
		console.log(sectorID);
		

	});

});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>