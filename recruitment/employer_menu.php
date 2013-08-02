<?php  

$currUserIDSession = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $currUserIDSession = $_SESSION['MM_UserID'];
}


/**************************************************
 * ************************************************
 * 
 * FREE PACKAGE     featured = 0 package = 0
 * BASIC PACKAGE    featured = 1 package = 1
 * PREMIUM PACKAGE  featured = 1 package = 2
 * PLATINUM PACKAGE featured = 1 package = 3
 *
 * ***********************************************
 *************************************************/

?>




<?php


/****************************************************************************************************
 * ************************************** FREE ******************************************************
 * **************************************************************************************************



/********************************************************
 *
 * Record Set for PremiumCheck 
 * MySQL Info 
 * Table Used PremiumCheck
 *
 ********************************************************/

$query_rsFreePackageCheck = "SELECT * FROM jp_employer 
                                WHERE emp_featured = 0 
                                  AND emp_package = 0 
                                    AND users_id_fk = '$currUserIDSession'";
$result_rsFreePackageCheck = mysql_query($query_rsFreePackageCheck);
$total_rows_rsFreePackageCheck = mysql_num_rows($result_rsFreePackageCheck);



// Basic menu
if ($total_rows_rsFreePackageCheck != 0) { ?>

<div id="submenu">
  <div class="menu_container center">
    <ul id="default_inline_menu">
      <li>
        <img src="img/Monitor-icon.png" alt="dashboard" />
        <a href="employerDashboard.php">My Dashboard</a></li>
      <li>
        <img src="../images/icon_color/user-detective.png" alt="dashboard" />
        <a href="#">Find a Recruiter</a> <strong class="upgrade_premium">[PREMIUM]</strong></li>
        <li>
          <img src="../images//icon_color/table--arrow.png" alt="My Appointer">
          <a href="#">My Appointer</a> <strong class="upgrade_premium">[PREMIUM]</strong>
        </li>
        <li>
          <img src="img/Clients-icon.png" alt="Applicant" />
          <a href="employerBrowseResume.php">Browse Resume(s)</a></li>
        <li>
          <img src="../images/icon_color/star.png" alt="shortlisted" />
          <a href="employerApplicationShorlistedList.php">Shortlisted</a></li>
        <li>
          <img src="../images/icon_color/document-list.png" alt="Applicant" />
          <a href="#">Assesment</a> <strong class="upgrade_premium">[PREMIUM]</strong>
        </li>
        <li>
          <img src="../images/icon_color/megaphone.png" alt="Applicant" />
          <a href="#">Interview Booking</a> <strong class="upgrade_premium">[PREMIUM]</strong>
        </li>
      <li>
        <img src="../images/icon_color/user--pencil.png" alt="admin" />
        <a href="employerProfileEdit.php?cuid=<?php echo $_SESSION['MM_UserID']; ?>">Edit Profile</a></li>
    </ul>
</div>
</div>

<?php } ?>




<?php


/****************************************************************************************************
 * ************************************** BASIC ******************************************************
 * **************************************************************************************************



/********************************************************
 *
 * Record Set for PremiumCheck 
 * MySQL Info 
 * Table Used PremiumCheck
 *
 ********************************************************/

$query_rsBasicPremiumCheck = "SELECT * FROM jp_employer 
                                WHERE emp_featured = 1 
                                  AND emp_package = 1 
                                    AND users_id_fk = '$currUserIDSession'";
$result_rsBasicPremiumCheck = mysql_query($query_rsBasicPremiumCheck);
$total_rows_rsBasicPremiumCheck = mysql_num_rows($result_rsBasicPremiumCheck);



// Basic menu
if ($total_rows_rsBasicPremiumCheck != 0) { ?>

<div id="submenu">
  <div class="menu_container">
    <ul id="default_inline_premium_menu">
      <li>
        <img src="img/Monitor-icon.png" alt="dashboard" style="margin-left:10px;" />
        <a href="employerDashboard.php" style="margin-left:10px;">My Dashboard</a></li>
      <li>
        <img src="../images/icon_color/user-detective.png" alt="dashboard" />
        <a href="#">Find a Recruiter</a> <strong class="upgrade_premium">[PREMIUM]</strong></li>
        <li>
          <img src="../images//icon_color/table--arrow.png" alt="My Appointer">
          <a href="#">My Appointer</a> <strong class="upgrade_premium">[PREMIUM]</strong>
        </li>
        <li>
          <img src="img/Clients-icon.png" alt="Applicant" />
          <a href="employerBrowseResume.php">Browse Resume(s)</a></li>
        <li>
          <img src="../images/icon_color/star.png" alt="shortlisted" />
          <a href="employerApplicationShorlistedList.php">Shortlisted</a></li>
        <li>
          <img src="../images/icon_color/document-list.png" alt="Applicant" />
          <a href="#">Assesment</a> <strong class="upgrade_premium">[PREMIUM]</strong>
        </li>
        <li>
          <img src="../images/icon_color/megaphone.png" alt="Applicant" />
          <a href="#">Interview Booking</a> <strong class="upgrade_premium">[PREMIUM]</strong>
        </li>
      <li>
        <img src="../images/icon_color/user--pencil.png" alt="admin" />
        <a href="employerProfileEdit.php?cuid=<?php echo $_SESSION['MM_UserID']; ?>">Edit Profile</a></li>
    </ul>
</div>
</div>

<?php } ?>






<?php


/****************************************************************************************************
 * ************************************** PREMIUM ******************************************************
 * **************************************************************************************************



/********************************************************
 *
 * Record Set for PremiumCheck 
 * MySQL Info 
 * Table Used PremiumCheck
 *
 ********************************************************/

$query_rsPremiumPackageCheck = "SELECT * FROM jp_employer 
                                WHERE emp_featured = 1 
                                  AND emp_package = 2 
                                    AND users_id_fk = '$currUserIDSession'";
$result_rsPremiumPackageCheck = mysql_query($query_rsPremiumPackageCheck);
$total_rows_rsPremiumPackageCheck = mysql_num_rows($result_rsPremiumPackageCheck);



// Basic menu
if ($total_rows_rsPremiumPackageCheck != 0) { ?>

<div id="submenu">
  <div class="menu_container">
    <ul id="default_inline_premium_menu">
      <li>
        <img src="img/Monitor-icon.png" alt="dashboard" style="margin-left:10px;" />
        <a href="employerDashboard.php" style="margin-left:10px;">My Dashboard</a></li>
      <li>
        <img src="../images/icon_color/user-detective.png" alt="dashboard" />
        <a href="#">Find a Recruiter</a></li>
        <li>
          <img src="../images//icon_color/table--arrow.png" alt="My Appointer">
          <a href="#">My Appointer</a>
        </li>
        <li>
          <img src="img/Clients-icon.png" alt="Applicant" />
          <a href="employerBrowseResume.php">Browse Resume(s)</a></li>
        <li>
          <img src="../images/icon_color/star.png" alt="shortlisted" />
          <a href="employerApplicationShorlistedList.php">Shortlisted</a></li>
        <li>
          <img src="../images/icon_color/document-list.png" alt="Applicant" />
          <a href="asses-landing.php">Assesment</a>
        </li>
        <li>
          <img src="../images/icon_color/megaphone.png" alt="Applicant" />
          <a href="#">Interview Booking</a>
        </li>
      <li>
        <img src="../images/icon_color/user--pencil.png" alt="admin" />
        <a href="employerProfileEdit.php?cuid=<?php echo $_SESSION['MM_UserID']; ?>">Edit Profile</a></li>
    </ul>
</div>
</div>

<?php } ?>




<?php


/****************************************************************************************************
 * ************************************** PLATINUM ******************************************************
 * **************************************************************************************************



/********************************************************
 *
 * Record Set for PremiumCheck 
 * MySQL Info 
 * Table Used PremiumCheck
 *
 ********************************************************/

$query_rsPremiumPackageCheck = "SELECT * FROM jp_employer 
                                WHERE emp_featured = 1 
                                  AND emp_package = 3 
                                    AND users_id_fk = '$currUserIDSession'";
$result_rsPremiumPackageCheck = mysql_query($query_rsPremiumPackageCheck);
$total_rows_rsPremiumPackageCheck = mysql_num_rows($result_rsPremiumPackageCheck);



// Basic menu
if ($total_rows_rsPremiumPackageCheck != 0) { ?>

<div id="submenu">
  <div class="menu_container">
    <ul id="default_inline_premium_menu">
      <li>
        <img src="img/Monitor-icon.png" alt="dashboard" style="margin-left:10px;" />
        <a href="employerDashboard.php" style="margin-left:10px;">My Dashboard</a></li>
      <li>
        <img src="../images/icon_color/user-detective.png" alt="dashboard" />
        <a href="findRecruiter.php">Find a Recruiter</a></li>
        <li>
          <img src="../images//icon_color/table--arrow.png" alt="My Appointer">
          <a href="recruiterAppointer.php">My Appointer</a>
        </li>
        <li>
          <img src="img/Clients-icon.png" alt="Applicant" />
          <a href="employerBrowseResume.php">Browse Resume(s)</a></li>
        <li>
          <img src="../images/icon_color/star.png" alt="shortlisted" />
          <a href="employerApplicationShorlistedList.php">Shortlisted</a></li>
        <li>
          <img src="../images/icon_color/document-list.png" alt="Applicant" />
          <a href="asses-landing.php">Assesment</a>
        </li>
        <li>
          <img src="../images/icon_color/megaphone.png" alt="Applicant" />
          <a href="BookingWelcome.php">Interview Booking</a>
        </li>
      <li>
        <img src="../images/icon_color/user--pencil.png" alt="admin" />
        <a href="employerProfileEdit.php?cuid=<?php echo $_SESSION['MM_UserID']; ?>">Edit Profile</a></li>
    </ul>
</div>
</div>

<?php } ?>