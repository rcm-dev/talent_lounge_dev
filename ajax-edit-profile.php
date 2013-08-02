<div>
			<?php  

			include '../db/db-connect.php';

			$usr_id = $_GET['id'];

			$editProfile = "SELECT
			  mj_users.usr_name As currName,
			  mj_users.usr_tel As currPhoneNo,
			  mj_users.usr_general_info As CurGenInfo,
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
				<div id="headingContainer" class="">
					<div class="l"><h2>Edit Profile</h2></div>
					<div class="r"><a href="#" class="btn" title="Edit"><span class="mi ui-icon ui-icon-pencil"></span>Edit</a></div>
					<div class="clear"></div>
				</div><!-- /hedingLeft -->


			<div id="profileView">
				<form id="formUpdate" name="formUpdate" method="post" action="update_profile.php">
				  <strong>Username</strong><br/>
				  <?php echo $rowEditProfile->currName; ?><br/><br/>

				  <strong>Phone No.</strong><br/>
				  <?php echo $rowEditProfile->currPhoneNo; ?><br/><br/>

				  <strong>General Information</strong><br/>
				  <?php echo $rowEditProfile->CurGenInfo; ?><br/><br/>
				  
				  <strong>Working At</strong><br/>
				  <?php echo $rowEditProfile->currWorkAt; ?><br/><br/>

				  <h3>Major in</h3><br/>

				  <strong>Sector</strong><br/>
				  <?php echo $rowEditProfile->currSector; ?><br/><br/>

				  <strong>Services</strong><br/>
				  <?php echo $rowEditProfile->currServices; ?><br/><br/>

				  <strong>Location</strong><br/>
				  <?php echo $rowEditProfile->currState; ?>, <?php echo $rowEditProfile->currCountry; ?><br/><br/>
				

				</form>
			</div><!-- /profileView -->

			<div id="profileEdit" class="none">
				<form id="formUpdate" name="formUpdate" method="post" action="update_profile.php">
				  <label for="curr_username">Username</label>
				  <input type="text" name="curr_username" id="curr_username" class="title" value="<?php echo $rowEditProfile->currName; ?>" />
				  <label for="currPhone">Phone No.</label>
				  <input type="text" name="currPhone" id="currPhone" class="title" value="<?php echo $rowEditProfile->currPhoneNo; ?>" />
				  <label for="currGeneralInfo">General Information</label>
				  <textarea name="currGeneralInfo" id="currGeneralInfo" cols="45" rows="5"><?php echo $rowEditProfile->CurGenInfo; ?></textarea><br/>
				  
				  <label for="currPhone">Working At</label>
				  <input type="text" name="currPhone" id="currPhone" class="title" value="<?php echo $rowEditProfile->currWorkAt; ?>" /><br/>

				  <strong>Major in</strong>
				  <label for="currPhone">Sector</label>
				  <input type="text" name="currSector" id="currSector" class="title" value="<?php echo $rowEditProfile->currSector; ?>" /><br/>

				  <label for="currPhone">Services</label>
				  <input type="text" name="currServices" id="currServices" class="title" value="<?php echo $rowEditProfile->currServices; ?>" /><br/>

				  <label for="currPhone">State</label>
				  <input type="text" name="currState" id="currState" class="title" value="<?php echo $rowEditProfile->currState; ?>" /><br/>

				  <input name="updateCurrInfo" type="submit" value="Update Info" class="button green" style="border:0px solid red;" /><br/>
				  <input type="hidden" name="currID" value="<?php echo $usr_id; ?>" />
				</form>
			</div><!-- /profileEdit -->

			</div>
		</div><!-- /div.none -->