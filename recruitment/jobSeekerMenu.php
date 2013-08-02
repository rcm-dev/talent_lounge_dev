<div class="menu_container">
    <ul id="default_inline_menu_2">
        <li>
        	<img src="../images/icon_black/ic_documents.png" alt="dashboard" />
        	<a href="jobSeekerDashboard.php">My Dashboard</a></li>
        <li>
        	<img src="../images/icon_black/ic_documents.png" alt="My Resume" />
        	<a href="jobSeekerMyResume.php?email=<?php echo $_SESSION['usr_email']; ?>">My Resume</a></li>
        <li>
        	<img src="../images/icon_black/ic_text_document.png" alt="My Application" />
        	<a href="jobSeekerMyApplication.php">My Job Application(s)</a></li>
        <li>
            <img src="../images/icon_black/ic_empty_document.png" alt="My Assesment" />
            <a href="jobSeekerMyAssesment.php?email=<?php echo $_SESSION['usr_email']; ?>">My Assesment</a></li>
        <li>
        	<img src="../images/icon_black/ic_settings.png" alt="profile" />
        	<a href="jobSeekerEditProfile.php?email=<?php echo $_SESSION['usr_email']; ?>">Edit Profile</a></li>
        <li style="display:none">
        	<img src="img/App-password-icon.png" alt="password" />
        	<a href="jobSeekerChangePassword.php?email=<?php echo $_SESSION['usr_email']; ?>">Change Password</a></li>
    </ul>
</div>

<?php  

/****************************
 *
 * Record Set for Particular 
 * MySQL Info 
 * Table Used Particular
 *
 ***************************/

$query_rsParticular = "SELECT * FROM jp_jobseeker WHERE users_id_fk = " . $_SESSION['MM_UserID'];
$result_rsParticular = mysql_query($query_rsParticular);
$total_rows_rsParticular = mysql_num_rows($result_rsParticular);

/****************************
 *
 * Record Set for License 
 * MySQL Info 
 * Table Used License
 *
 ***************************/

$query_rsLicense = "SELECT * FROM jp_licenses WHERE user_id_fk = " . $_SESSION['MM_UserID'];
$result_rsLicense = mysql_query($query_rsLicense);
$total_rows_rsLicense = mysql_num_rows($result_rsLicense);



/****************************
 *
 * Record Set for Experience 
 * MySQL Info 
 * Table Used Experience
 *
 ***************************/

$query_rsExperience = "SELECT * FROM jp_experience WHERE users_id_fk = " . $_SESSION['MM_UserID'];
$result_rsExperience = mysql_query($query_rsExperience);
$total_rows_rsExperience = mysql_num_rows($result_rsExperience);


/****************************
 *
 * Record Set for Qualification 
 * MySQL Info 
 * Table Used Qualification
 *
 ***************************/

$query_rsQualification = "SELECT * FROM jp_education WHERE user_id_fk = " . $_SESSION['MM_UserID'];
$result_rsQualification = mysql_query($query_rsQualification);
$total_rows_rsQualification = mysql_num_rows($result_rsQualification);


/****************************
 *
 * Record Set for SPM 
 * MySQL Info 
 * Table Used SPM
 *
 ***************************/

$query_rsSPM = "SELECT * FROM jp_spm WHERE user_id_fk = " . $_SESSION['MM_UserID'];
$result_rsSPM = mysql_query($query_rsSPM);
$total_rows_rsSPM = mysql_num_rows($result_rsSPM);



/****************************
 *
 * Record Set for Skills 
 * MySQL Info 
 * Table Used Skills
 *
 ***************************/

$query_rsSkills = "SELECT * FROM jp_skills WHERE user_id_fk = " . $_SESSION['MM_UserID'];
$result_rsSkills = mysql_query($query_rsSkills);
$total_rows_rsSkills = mysql_num_rows($result_rsSkills);


/****************************
 *
 * Record Set for Language 
 * MySQL Info 
 * Table Used Language
 *
 ***************************/

$query_rsLanguage = "SELECT * FROM jp_language WHERE user_id_fk = " . $_SESSION['MM_UserID'];
$result_rsLanguage = mysql_query($query_rsLanguage);
$total_rows_rsLanguage = mysql_num_rows($result_rsLanguage);



/****************************
 *
 * Record Set for Preferences 
 * MySQL Info 
 * Table Used Preferences
 *
 ***************************/

$query_rsPreferences = "SELECT * FROM jp_jobpreferences WHERE user_id_fk = " . $_SESSION['MM_UserID'];
$result_rsPreferences = mysql_query($query_rsPreferences);
$total_rows_rsPreferences = mysql_num_rows($result_rsPreferences);


/****************************
 *
 * Record Set for References 
 * MySQL Info 
 * Table Used References
 *
 ***************************/

$query_rsReferences = "SELECT * FROM jp_references WHERE user_id_fk = " . $_SESSION['MM_UserID'];
$result_rsReferences = mysql_query($query_rsReferences);
$total_rows_rsReferences = mysql_num_rows($result_rsReferences);



/****************************
 *
 * Record Set for Resume 
 * MySQL Info 
 * Table Used Resume
 *
 ***************************/

$query_rsResume = "SELECT * FROM jp_resume WHERE users_id_fk = " . $_SESSION['MM_UserID'];
$result_rsResume = mysql_query($query_rsResume);
$total_rows_rsResume = mysql_num_rows($result_rsResume);



if (($total_rows_rsParticular != 0) &&
    ($total_rows_rsLicense != 0) &&
    ($total_rows_rsExperience != 0) &&
    ($total_rows_rsQualification != 0) &&
    ($total_rows_rsSPM != 0) &&
    ($total_rows_rsSkills != 0) &&
    ($total_rows_rsLanguage != 0) &&
    ($total_rows_rsPreferences != 0) &&
    ($total_rows_rsReferences != 0) &&
    ($total_rows_rsResume != 0)) 
{
    $meter = "100";
} 

if (($total_rows_rsParticular != 0) &&
    ($total_rows_rsLicense != 0) &&
    ($total_rows_rsExperience != 0) &&
    ($total_rows_rsQualification != 0) &&
    ($total_rows_rsSPM != 0) &&
    ($total_rows_rsSkills != 0) &&
    ($total_rows_rsLanguage != 0) &&
    ($total_rows_rsPreferences != 0) &&
    ($total_rows_rsReferences != 0) &&
    ($total_rows_rsResume == 0)) 
{
    $meter = "90";
}

if (($total_rows_rsParticular != 0) &&
    ($total_rows_rsLicense != 0) &&
    ($total_rows_rsExperience != 0) &&
    ($total_rows_rsQualification != 0) &&
    ($total_rows_rsSPM != 0) &&
    ($total_rows_rsSkills != 0) &&
    ($total_rows_rsLanguage != 0) &&
    ($total_rows_rsPreferences != 0) &&
    ($total_rows_rsReferences == 0) &&
    ($total_rows_rsResume == 0)) 
{
    $meter = "80";
}

if (($total_rows_rsParticular != 0) &&
    ($total_rows_rsLicense != 0) &&
    ($total_rows_rsExperience != 0) &&
    ($total_rows_rsQualification != 0) &&
    ($total_rows_rsSPM != 0) &&
    ($total_rows_rsSkills != 0) &&
    ($total_rows_rsLanguage != 0) &&
    ($total_rows_rsPreferences == 0) &&
    ($total_rows_rsReferences == 0) &&
    ($total_rows_rsResume == 0)) 
{
    $meter = "70";
}

if (($total_rows_rsParticular != 0) &&
    ($total_rows_rsLicense != 0) &&
    ($total_rows_rsExperience != 0) &&
    ($total_rows_rsQualification != 0) &&
    ($total_rows_rsSPM != 0) &&
    ($total_rows_rsSkills != 0) &&
    ($total_rows_rsLanguage == 0) &&
    ($total_rows_rsPreferences == 0) &&
    ($total_rows_rsReferences == 0) &&
    ($total_rows_rsResume == 0)) 
{
    $meter = "60";
}

if (($total_rows_rsParticular != 0) &&
    ($total_rows_rsLicense != 0) &&
    ($total_rows_rsExperience != 0) &&
    ($total_rows_rsQualification != 0) &&
    ($total_rows_rsSPM != 0) &&
    ($total_rows_rsSkills == 0) &&
    ($total_rows_rsLanguage == 0) &&
    ($total_rows_rsPreferences == 0) &&
    ($total_rows_rsReferences == 0) &&
    ($total_rows_rsResume == 0)) 
{
    $meter = "50";
}

if (($total_rows_rsParticular != 0) &&
    ($total_rows_rsLicense != 0) &&
    ($total_rows_rsExperience != 0) &&
    ($total_rows_rsQualification != 0) &&
    ($total_rows_rsSPM == 0) &&
    ($total_rows_rsSkills == 0) &&
    ($total_rows_rsLanguage == 0) &&
    ($total_rows_rsPreferences == 0) &&
    ($total_rows_rsReferences == 0) &&
    ($total_rows_rsResume == 0)) 
{
    $meter = "40";
}

if (($total_rows_rsParticular != 0) &&
    ($total_rows_rsLicense != 0) &&
    ($total_rows_rsExperience != 0) &&
    ($total_rows_rsQualification == 0) &&
    ($total_rows_rsSPM == 0) &&
    ($total_rows_rsSkills == 0) &&
    ($total_rows_rsLanguage == 0) &&
    ($total_rows_rsPreferences == 0) &&
    ($total_rows_rsReferences == 0) &&
    ($total_rows_rsResume == 0)) 
{
    $meter = "30";
}

if (($total_rows_rsParticular != 0) &&
    ($total_rows_rsLicense != 0) &&
    ($total_rows_rsExperience == 0) &&
    ($total_rows_rsQualification == 0) &&
    ($total_rows_rsSPM == 0) &&
    ($total_rows_rsSkills == 0) &&
    ($total_rows_rsLanguage == 0) &&
    ($total_rows_rsPreferences == 0) &&
    ($total_rows_rsReferences == 0) &&
    ($total_rows_rsResume == 0)) 
{
    $meter = "20";
}

if (($total_rows_rsParticular != 0) &&
    ($total_rows_rsLicense == 0) &&
    ($total_rows_rsExperience == 0) &&
    ($total_rows_rsQualification == 0) &&
    ($total_rows_rsSPM == 0) &&
    ($total_rows_rsSkills == 0) &&
    ($total_rows_rsLanguage == 0) &&
    ($total_rows_rsPreferences == 0) &&
    ($total_rows_rsReferences == 0) &&
    ($total_rows_rsResume == 0)) 
{
    $meter = "10";
}

if (($total_rows_rsParticular == 0) &&
    ($total_rows_rsLicense == 0) &&
    ($total_rows_rsExperience == 0) &&
    ($total_rows_rsQualification == 0) &&
    ($total_rows_rsSPM == 0) &&
    ($total_rows_rsSkills == 0) &&
    ($total_rows_rsLanguage == 0) &&
    ($total_rows_rsPreferences == 0) &&
    ($total_rows_rsReferences == 0) &&
    ($total_rows_rsResume == 0)) 
{
    $meter = "0";
}


$css = "background: #9dd53a; /* Old browsers */
background: -moz-linear-gradient(top,  #9dd53a 0%, #a1d54f 50%, #80c217 51%, #7cbc0a 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#9dd53a), color-stop(50%,#a1d54f), color-stop(51%,#80c217), color-stop(100%,#7cbc0a)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* IE10+ */
background: linear-gradient(to bottom,  #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#9dd53a', endColorstr='#7cbc0a',GradientType=0 ); /* IE6-9 */
";

?>

<div style="margin:20px 0px; display:none">
    <strong>Stage performance of your applications: (SPA)</strong> <i>Reachable of resume for employer</i>
    <div style="width:100%; background: #f3f3f3; height:20px; border-radius:5px; overflow:hidden; border:1px solid #5AA509">
        <div style="height:20px; width:<?php echo $meter; ?>; text-align:center; line-height:20px; <?php echo $css; ?>">
            <?php echo $meter; ?>%
        </div>
    </div>
</div>