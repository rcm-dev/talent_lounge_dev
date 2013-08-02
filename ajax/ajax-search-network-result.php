<?php  


// DB
include '../db/db-connect.php';


// ==================================================================
//
// Get string
//
// ------------------------------------------------------------------
$networkstring     = $_GET['networkstring'];
$searchsector      = $_GET['searchsector'];
$searchProduct     = $_GET['searchProduct'];
$searchnetworkarea = $_GET['searchnetworkarea'];
$currname		   = $_GET['currname'];



// ==================================================================
//
// Debuging
//	
// ------------------------------------------------------------------

if (($searchsector == 0) && ($searchProduct == 0) && ($searchnetworkarea == 0)) {
	
	
	// ==================================================================
	//
	// search query by name %s%
	//
	// ------------------------------------------------------------------

	$queryString	     =	"SELECT
						  mj_users.usr_id As usrGetId,
						  mj_users.usr_name As friendName,
						  mj_users.usr_workat As CompanyName,
						  mj_users.user_pic As usrPicture
						From
						  mj_users
						Where
						  mj_users.usr_name Like '%$networkstring%'
						AND 
						  mj_users.usr_name NOT Like '%$currname%'";
	$resultQString	     =	mysql_query($queryString);
	$qStringNumRow		 =	mysql_num_rows($resultQString);


	/* if return 0 */
	if ($qStringNumRow == 0) {
		
		echo 'No results.';

	} else {

		echo mysql_affected_rows().' <strong>people(s) found.</strong>';
		echo "<ul class=\"friendsView\">";
		while ($rowQString = mysql_fetch_object($resultQString)) { ?>

			<li>
				<a href="users.php?uid=<?php echo $rowQString->usrGetId; ?>">
				<div class="namePic left">
					<div class="profile-pic">
						<img src="<?php echo $rowQString->usrPicture; ?>" class="height: auto; width: 100%;" width="64" />
					</div>
				</div>
				</a>
				<div class="nameDesc right" style="margin-top:15px; width:180px;">
					<strong><?php echo ucwords($rowQString->friendName); ?></strong>
					<br/>
					<div class="usermisc" style="color:#50021B; font-size:11px;">
						<span class="briefcase_color"><?php echo ucwords($rowQString->CompanyName); ?></span><br>
						<span class="mail_color" style="margin-top:90px !important;"><a href="send-message.php?fid=<?php echo $rowQString->usrGetId; ?>&messageby=<?php echo $usr_id; ?>" id="<?php echo $rowQString->usrGetId; ?>" class="sendFriendMessage">Send Message</a></span>
					</div>
				</div>
				<div class="clear"></div>
			</li>

	<?php 

		} /* while */

	} /* else if */

	?>
	</ul>


<?php 

} elseif (($searchsector > 0) && ($searchProduct > 0) && ($searchnetworkarea > 0)) {

	
	// if select by sectorn services n area
	// ==================================================================
	//
	// search query by name, sector, product, area %s%
	//
	// ------------------------------------------------------------------

	$queryString	     =	"SELECT
							  mj_users.usr_id As usrGetId,
							  mj_users.usr_name As friendName,
							  mj_users.usr_workat As CompanyName,
							  mj_users.user_pic As usrPicture,
							  mj_users.mj_sector_fk,
							  mj_users.mj_state_fk,
							  mj_users.mj_services_fk
							From
							  mj_users
							Where
							  mj_users.usr_name Like '%$networkstring%' And
							  mj_users.mj_sector_fk = '$searchsector' And
  							  mj_users.mj_state_fk = '$searchnetworkarea' And
  							  mj_users.mj_services_fk = '$searchProduct' And
							  mj_users.usr_name Not Like '%$currname%'";
	$resultQString	     =	mysql_query($queryString);
	$qStringNumRow		 =	mysql_num_rows($resultQString);


	/* if return 0 */
	if ($qStringNumRow == 0) {
		
		echo 'No results.';

	} else {

		echo mysql_affected_rows().' <strong>people(s) found.</strong>';
		echo "<ul>";
		while ($rowQString = mysql_fetch_object($resultQString)) { ?>

			<li>
				<a href="users.php?uid=<?php echo $rowQString->usrGetId; ?>">
				<div class="namePic">
					<div style="width: 64px; height: 64px; overflow: hidden; background-image: url(<?php echo $rowQString->usrPicture; ?>); background-repeat: no-repeat; background-size: 100%; background-position: center top">
						<!-- <img src="" width="64" /> -->
					</div>
				</div>
				</a>
				<div class="nameDesc" style="margin-top:15px;"><strong><?php echo ucwords($rowQString->friendName); ?></strong>
				<br/>
				<span style="color:#50021B"><?php echo ucwords($rowQString->CompanyName); ?></span>
				</div>
				<div class="clear"></div>
			</li>

	<?php 

		} /* while */


	} /* else */

} /* else sector not 0 */

 elseif (($searchsector > 0) && ($searchProduct > 0)) {


 	// if select by sector n product
	// ==================================================================
	//
	// search query by name, sector n product %s%
	//
	// ------------------------------------------------------------------

	$queryString	     =	"SELECT
							  mj_users.usr_id As usrGetId,
							  mj_users.usr_name As friendName,
							  mj_users.usr_workat As CompanyName,
							  mj_users.user_pic As usrPicture,
							  mj_users.mj_sector_fk,
							  mj_users.mj_state_fk,
							  mj_users.mj_services_fk
							From
							  mj_users
							Where
							  mj_users.usr_name Like '%$networkstring%' And
							  mj_users.mj_sector_fk = '$searchsector' And
  							  mj_users.mj_services_fk = '$searchProduct' And
							  mj_users.usr_name Not Like '%$currname%'";
	$resultQString	     =	mysql_query($queryString);
	$qStringNumRow		 =	mysql_num_rows($resultQString);


	/* if return 0 */
	if ($qStringNumRow == 0) {
		
		echo 'No results.';

	} else {

		echo mysql_affected_rows().' <strong>people(s) found.</strong>';
		echo "<ul>";
		while ($rowQString = mysql_fetch_object($resultQString)) { ?>

			<li>
				<a href="users.php?uid=<?php echo $rowQString->usrGetId; ?>">
				<div class="namePic">
					<div style="width: 64px; height: 64px; overflow: hidden; background-image: url(<?php echo $rowQString->usrPicture; ?>); background-repeat: no-repeat; background-size: 100%; background-position: center top">
						<!-- <img src="" width="64" /> -->
					</div>
				</div>
				</a>
				<div class="nameDesc" style="margin-top:15px;"><strong><?php echo ucwords($rowQString->friendName); ?></strong>
				<br/>
				<span style="color:#50021B"><?php echo ucwords($rowQString->CompanyName); ?></span>
				</div>
				<div class="clear"></div>
			</li>

	<?php 

		} /* while */


	} /* else */



} elseif ($searchsector >0) {
	
	// if select by sector
	// ==================================================================
	//
	// search query by name n sector %s%
	//
	// ------------------------------------------------------------------

	$queryString	     =	"SELECT
							  mj_users.usr_id As usrGetId,
							  mj_users.usr_name As friendName,
							  mj_users.usr_workat As CompanyName,
							  mj_users.user_pic As usrPicture,
							  mj_users.mj_sector_fk,
							  mj_users.mj_state_fk,
							  mj_users.mj_services_fk
							From
							  mj_users
							Where
							  mj_users.usr_name Like '%$networkstring%' And
							  mj_users.mj_sector_fk = '$searchsector' And  							  
							  mj_users.usr_name Not Like '%$currname%'";
	$resultQString	     =	mysql_query($queryString);
	$qStringNumRow		 =	mysql_num_rows($resultQString);


	/* if return 0 */
	if ($qStringNumRow == 0) {
		
		echo 'No results.';

	} else {

		echo mysql_affected_rows().' <strong>people(s) found.</strong>';
		echo "<ul>";
		while ($rowQString = mysql_fetch_object($resultQString)) { ?>

			<li>
				<a href="users.php?uid=<?php echo $rowQString->usrGetId; ?>">
				<div class="namePic">
					<div style="width: 64px; height: 64px; overflow: hidden; background-image: url(<?php echo $rowQString->usrPicture; ?>); background-repeat: no-repeat; background-size: 100%; background-position: center top">
						<!-- <img src="" width="64" /> -->
					</div>
				</div>
				</a>
				<div class="nameDesc" style="margin-top:15px;"><strong><?php echo ucwords($rowQString->friendName); ?></strong>
				<br/>
				<span style="color:#50021B"><?php echo ucwords($rowQString->CompanyName); ?></span>
				</div>
				<div class="clear"></div>
			</li>

	<?php 

		} /* while */


	} /* else */


} elseif ($searchProduct > 0) {
	
	// if select by product
	// ==================================================================
	//
	// search query by name product %s%
	//
	// ------------------------------------------------------------------

	$queryString	     =	"SELECT
							  mj_users.usr_id As usrGetId,
							  mj_users.usr_name As friendName,
							  mj_users.usr_workat As CompanyName,
							  mj_users.user_pic As usrPicture,
							  mj_users.mj_sector_fk,
							  mj_users.mj_state_fk,
							  mj_users.mj_services_fk
							From
							  mj_users
							Where
							  mj_users.usr_name Like '%$networkstring%' And
  							  mj_users.mj_services_fk = '$searchProduct' And
							  mj_users.usr_name Not Like '%$currname%'";
	$resultQString	     =	mysql_query($queryString);
	$qStringNumRow		 =	mysql_num_rows($resultQString);


	/* if return 0 */
	if ($qStringNumRow == 0) {
		
		echo 'No results.';

	} else {

		echo mysql_affected_rows().' <strong>people(s) found.</strong>';
		echo "<ul>";
		while ($rowQString = mysql_fetch_object($resultQString)) { ?>

			<li>
				<a href="users.php?uid=<?php echo $rowQString->usrGetId; ?>">
				<div class="namePic">
					<div style="width: 64px; height: 64px; overflow: hidden; background-image: url(<?php echo $rowQString->usrPicture; ?>); background-repeat: no-repeat; background-size: 100%; background-position: center top">
						<!-- <img src="" width="64" /> -->
					</div>
				</div>
				</a>
				<div class="nameDesc" style="margin-top:15px;"><strong><?php echo ucwords($rowQString->friendName); ?></strong>
				<br/>
				<span style="color:#50021B"><?php echo ucwords($rowQString->CompanyName); ?></span>
				</div>
				<div class="clear"></div>
			</li>

	<?php 

		} /* while */


	} /* else */

} elseif ($searchnetworkarea > 0) {
	
	// if select by area
	// ==================================================================
	//
	// search query by name n area %s%
	//
	// ------------------------------------------------------------------

	$queryString	     =	"SELECT
							  mj_users.usr_id As usrGetId,
							  mj_users.usr_name As friendName,
							  mj_users.usr_workat As CompanyName,
							  mj_users.user_pic As usrPicture,
							  mj_users.mj_sector_fk,
							  mj_users.mj_state_fk,
							  mj_users.mj_services_fk
							From
							  mj_users
							Where
							  mj_users.usr_name Like '%$networkstring%' And
							  mj_users.mj_state_fk = '$searchnetworkarea' And
							  mj_users.usr_name Not Like '%$currname%'";
	$resultQString	     =	mysql_query($queryString);
	$qStringNumRow		 =	mysql_num_rows($resultQString);


	/* if return 0 */
	if ($qStringNumRow == 0) {
		
		echo 'No results.';

	} else {

		echo mysql_affected_rows().' <strong>people(s) found.</strong>';
		echo "<ul>";
		while ($rowQString = mysql_fetch_object($resultQString)) { ?>

			<li>
				<a href="users.php?uid=<?php echo $rowQString->usrGetId; ?>">
				<div class="namePic">
					<div style="width: 64px; height: 64px; overflow: hidden; background-image: url(<?php echo $rowQString->usrPicture; ?>); background-repeat: no-repeat; background-size: 100%; background-position: center top">
						<!-- <img src="" width="64" /> -->
					</div>
				</div>
				</a>
				<div class="nameDesc" style="margin-top:15px;"><strong><?php echo ucwords($rowQString->friendName); ?></strong>
				<br/>
				<span style="color:#50021B"><?php echo ucwords($rowQString->CompanyName); ?></span>
				</div>
				<div class="clear"></div>
			</li>

	<?php 

		} /* while */


	} /* else */

}


?>