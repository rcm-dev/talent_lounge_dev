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
			<h1 class="heading_title bebasTitle">Edit Profile</h1>
		</div>

		<div class="left cnscontainer" style="height:800px">

			<div class="white" style="border-top:0px solid #cccccc; padding:10px">
				
				<!-- CHange Action -->

				<div id="connect-container">
					<div>
						<?php  

						$usr_id = sqlInjectString($_GET['id']);

						$editProfile = "SELECT
						  mj_users.usr_name As currName,
						  mj_users.user_pic As currPicture,
						  mj_users.usr_tel As currPhoneNo,
						  mj_users.usr_general_info As CurGenInfo,
						  mj_users.usr_core_activity As coreActivity,
						  mj_users.usr_workat As currWorkAt,
						  mj_users.mj_sector_fk,
						  mj_users.mj_services_fk,
						  mj_users.mj_state_fk,
						  mj_sector.sec_name As currSector,
						  mj_state.state_name As currState,
						  mj_services.services_name As currServices,
						  mj_country.country_name As currCountry
						From
						  mj_users Inner Join
						  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
						  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
						  mj_sector mj_sector1 On mj_services.sector_id_fk = mj_sector1.sec_id
						  Inner Join
						  mj_state On mj_users.mj_state_fk = mj_state.state_id Inner Join
						  mj_country On mj_users.mj_country_id_fk = mj_country.country_id
						Where
						  mj_users.usr_id ='$usr_id'";
						$resultEditProfile = mysql_query($editProfile);

						$rowEditProfile	= mysql_fetch_object($resultEditProfile);


						?>
						<div id="edit-profile-container" style="height: 540px; width: 500px;">
							<div id="headingContainer">
								<div class="l"><strong class="uiedit">Edit Entrepreneur Profile</strong></div>
								<div class="clear"></div>
							</div><!-- /hedingLeft -->


						<div id="profileEdit">
							<form id="formUpdate" name="formUpdate" method="post" action="update_profile.php">
							  <label for="curr_username">Username</label>
							  <input type="text" name="curr_username" id="curr_username" class="title" value="<?php echo $rowEditProfile->currName; ?>" />
							  <label for="currPhone">Phone No.</label>
							  <input type="text" name="currPhone" id="currPhone" class="title" value="<?php echo $rowEditProfile->currPhoneNo; ?>" />
							  <label for="currGeneralInfo">General Information</label>
							  <textarea name="currGeneralInfo" id="currGeneralInfo" cols="45" rows="5"><?php echo $rowEditProfile->CurGenInfo; ?></textarea><br/>

							  <label for="currGeneralInfo">Core Activity</label>
							  <textarea name="coreActivity" id="cols" coreActivity="45" rows="5"><?php echo $rowEditProfile->coreActivity; ?></textarea><br/>
							  
							  <label for="currPhone">Working At</label>
							  <input type="text" name="currWorking" id="currWorking" class="title" value="<?php echo $rowEditProfile->currWorkAt; ?>" /><br/><br/>

							  <strong>Major in</strong><br/>

							  <select name="currSector" id="currSector" class = "date">
								<?php  

								$qsec          	= "SELECT
												  mj_sector.sec_id As secID,
												  mj_sector.sec_name As secName
												From
												  mj_sector";
								$resultsec     	= mysql_query($qsec);

								while ($rowsec 	= mysql_fetch_object($resultsec)) { ?>
									
									<option value="<?php echo $rowsec->secID; ?>" <?php if ($rowEditProfile->currSector== $rowsec->secName) {
                      echo "selected=\"selected\"";
                    } ?>>
                    <?php echo ucwords($rowsec->secName); ?></option>
							
								<?php } ?>
							</select>
							
							<select name="currServices" id="currServices">
							<?php	$qser          	= "SELECT
 							 	mj_services.services_name As ServisName,
  								mj_services.services_id As servisID,
  								mj_services.sector_id_fk
							From
  								mj_services
							Where
  								mj_services.sector_id_fk = '$servisID'";


						$resultser     	= mysql_query($qser);
						//$numrowSecto	= mysql_num_rows($resultser);
						while ($rowser 	= mysql_fetch_object($resultser)) { ?>
		
			<option >
                    <?php echo ucwords($rowser->servisID); ?></option>




	<?php } ?>

							</select><br/>

							<label>Area</label>
							<select name="currState" id="currState" class ="date">
								<?php  

								$qstat           = "SELECT
												  mj_state.state_id as stateID,
												  mj_state.state_name As stateName
												From
												  mj_state";
								$resultqstat     = mysql_query($qstat);

								while ($rowstat   = mysql_fetch_object($resultqstat)) { ?>
									
									<option value="<?php echo $rowstat->stateID; ?>" <?php if ($rowEditProfile->currState== $rowstat->stateName) {
                      echo "selected=\"selected\"";
                    } ?>>
										<?php echo $rowstat->stateName; ?></option>
							
								<?php } ?>
							</select><br/><br/>

							  <input name="updateCurrInfo" id="updateCurrInfo" type="submit" value="Update Info" class="button green" /><br/>
							  <input type="hidden" name="currID" id="currID" value="<?php echo $usr_id; ?>" />
							</form>
						</div><!-- /profileEdit -->

						<div id="changePicture" class=""><br/><br/><br/>
							<strong>Change picture</strong>
							<div>
								<div class="profile-pic">
									<img src="<?php echo $rowEditProfile->currPicture; ?>" width="64" />
								</div>
								<input type="hidden" name="currUserID" id="currUserID" value="<?php echo $usr_id; ?>" />
								<a href="cpicture.php?id=<?php echo $usr_id; ?>" id="changePicture" title="">Change Picture</a>
							</div><!-- / -->
						</div><!-- /changePicture -->

						<div class="clear"></div>
						</div>
					</div><!-- /div.none -->
				</div>
				<div class="clear"></div>
				<!-- /CHange Action -->
			</div>


		</div><!-- /orange left -->

		<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
			<strong class="heading_title_two bebasTitle">Information</strong><br><br>
			<p>Your can view your profile <a href="users.php?uid=<?php echo $usr_id; ?>" title="View Profile">Here.</a></p>
			<p>For uploading your picture please make sure you picture is actual size like example 600px width and 600px height.</p>
		</div><!-- /orange right -->

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

	/*console.log($(this).val());
    $('select#currState').html('<option value="">currState</option>');

    $.ajax({
      type : 'GET',
      url : 'update_profile.php?area_id='+$(this).val(),

      success:function(html){
        $('select#currState').html(html);
        console.log(html);
      }
    });*/

	
	$("a#example1").fancybox({
		'overlayColor'		: '#000',
		'overlayOpacity'	: 0.9

	});


	$('#editProfile').fancybox({
		'titlePosition'		: 'inside',

		'transitionIn'		: 'none',

		'transitionOut'		: 'none'
	});

	$('label').css('display', 'block');


	/*$('.network-left').hover(function(){
		
		$('#user-settings').fadeIn();

	}, function(){
		
		$('#user-settings').fadeOut();

	});*/

	/* Change services */
	$('#currSector').change(function(){

		var sectorID = $(this).val();
	

		$('#currServices').load('ajax/ajax-selectsector.php?sectorid='+sectorID);
		console.log(sectorID);
		

	});



  

	$('#updateCurrInfo').click(function(){

		var dataString = $('form#formUpdate').serialize();

		$.ajax({

			url: "ajax/profile_edited.php",
			type: "POST",
			data: dataString,

			success:function(html){

				if (html == 1) {
					$.jnotify("This is a default notification.");
				}
				else {
					$.jnotify("This is an \"error\" notification.", "error");
				}

			}

		});

		console.log(dataString);
		return false;

	});



	$('#formUpdate label').css('font-weight', 'bold');
	$('#formUpdate label').css('margin-top', '10px');
	$('#formUpdate textarea').css('font-family', 'Arial');



});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>