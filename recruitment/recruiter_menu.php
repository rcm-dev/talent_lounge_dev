<?php  

$currUserIDSession = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $currUserIDSession = $_SESSION['MM_UserID'];
}


/****************************
 *
 * Record Set for PremiumCheck 
 * MySQL Info 
 * Table Used PremiumCheck
 *
 ***************************/

$query_rsPremiumCheck = "SELECT * FROM mj_users WHERE usr_id = '$currUserIDSession'";
$result_rsPremiumCheck = mysql_query($query_rsPremiumCheck);
$total_rows_rsPremiumCheck = mysql_num_rows($result_rsPremiumCheck);
$row_rsPremiumCheck = mysql_fetch_assoc($result_rsPremiumCheck);


?>

<?php 

// basic menu
if ($row_rsPremiumCheck['usr_lvl'] == 0) { ?>
<div id="submenu">
  <div class="menu_container center">
    <ul id="default_inline_menu_recruiter">
      <li>
        <img src="img/Monitor-icon.png" alt="dashboard" />
        <a href="recruiterDashboard.php">My Dashboard</a></li>
        <li>
          <img src="../images/icon_color/application-wave.png" alt="Applicant" />
          <a href="recruiterMyProject.php">My Project</a></li>
        <li>
          <img src="../images/icon_color/application-task.png" alt="Applicant" />
          <a href="#">Questions Bank</a></li>
        <li>
          <img src="../images/icon_color/application-search-result.png" alt="Applicant" />
          <a href="recruiteBrowseResume.php">Find Talent Lounge Jobseeker(s)</a></li>
      <li>
        <img src="img/Administrator-icon.png" alt="admin" />
        <a href="recruiterProfile.php">Edit Profile</a></li>
    </ul>
</div>
</div>
<?php } ?>


<?php 

// basic menu
if ($row_rsPremiumCheck['usr_lvl'] != 0) { ?>
<div id="submenu">
  <div class="menu_container center">
    <ul id="default_inline_menu_recruiter">
      <li>
        <img src="img/Monitor-icon.png" alt="dashboard" />
        <a href="recruiterDashboard.php">My Dashboard</a></li>
        <li>
          <img src="../images/icon_color/application-wave.png" alt="Applicant" />
          <a href="recruiterMyProject.php">My Project</a></li>
        <li>
          <img src="../images/icon_color/application-task.png" alt="Applicant" />
          <a href="#">Questions Bank</a></li>
        <li>
          <img src="../images/icon_color/application-search-result.png" alt="Applicant" />
          <a href="recruiteBrowseResume.php">Find Talent Lounge Jobseeker(s)</a></li>
      <li>
        <img src="img/Administrator-icon.png" alt="admin" />
        <a href="recruiterProfile.php">Edit Profile</a></li>
    </ul>
</div>
</div>
<?php } ?>