<?php require_once('Connections/conJobsPerak.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  $_SESSION['MM_UserID'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
  unset($_SESSION['MM_UserID']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}



$colname_rsEmployed = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsEmployed = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsEmployed = sprintf("SELECT * FROM jp_employer WHERE users_id_fk = %s", GetSQLValueString($colname_rsEmployed, "int"));
$rsEmployed = mysql_query($query_rsEmployed, $conJobsPerak) or die(mysql_error());
$row_rsEmployed = mysql_fetch_assoc($rsEmployed);
$totalRows_rsEmployed = mysql_num_rows($rsEmployed);

$colname_rsComDetail = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsComDetail = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsComDetail = sprintf("SELECT * FROM jp_employer WHERE users_id_fk = %s", GetSQLValueString($colname_rsComDetail, "int"));
$rsComDetail = mysql_query($query_rsComDetail, $conJobsPerak) or die(mysql_error());
$row_rsComDetail = mysql_fetch_assoc($rsComDetail);
$totalRows_rsComDetail = mysql_num_rows($rsComDetail);

$maxRows_rsJobAds = 30;
$pageNum_rsJobAds = 0;
if (isset($_GET['pageNum_rsJobAds'])) {
  $pageNum_rsJobAds = $_GET['pageNum_rsJobAds'];
}
$startRow_rsJobAds = $pageNum_rsJobAds * $maxRows_rsJobAds;

$colname_rsJobAds = $row_rsEmployed['emp_id'];
if (isset($row_rsEmployed['emp_id'])) {
  $colname_rsJobAds = $row_rsEmployed['emp_id'];
}

$colname_rsJobAds = $row_rsEmployed['emp_id'];

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsJobAds = sprintf("SELECT * FROM jp_ads WHERE emp_id_fk = %s", GetSQLValueString($colname_rsJobAds, "int"));
$rsJobAds = mysql_query($query_rsJobAds, $conJobsPerak) or die(mysql_error());
$row_rsJobAds = mysql_fetch_assoc($rsJobAds);
$totalRows_rsJobAds = mysql_num_rows($rsJobAds);

$currentJobAdsId = 7;
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsCandidateApplied = "Select   Count(jp_application.ads_id_fk) From   jp_application Where   jp_application.ads_id_fk = $currentJobAdsId";
$rsCandidateApplied = mysql_query($query_rsCandidateApplied, $conJobsPerak) or die(mysql_error());
$row_rsCandidateApplied = mysql_fetch_assoc($rsCandidateApplied);
$totalRows_rsCandidateApplied = mysql_num_rows($rsCandidateApplied);

$colname_rsIsActive = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsIsActive = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsIsActive = sprintf("SELECT user_active, usr_lvl FROM mj_users WHERE users_id = %s", GetSQLValueString($colname_rsIsActive, "int"));
$rsIsActive = mysql_query($query_rsIsActive, $conJobsPerak) or die(mysql_error());
$row_rsIsActive = mysql_fetch_assoc($rsIsActive);
$totalRows_rsIsActive = mysql_num_rows($rsIsActive);
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "3";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "sessionGateway.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title>Welcome to Jobsperak Portal</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection" />
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../uploadify/jquery.uploadify-3.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../uploadify/uploadify.css" />
</head>

<body>



	<header id="header">

		<div class="center">
       <div id="logo" class="left" style="margin:10px 0px 0px 0px;">
          <a href="index.php" title="Home">
            <img src="../images/logo.png" alt="logo.png" border="0">
          </a>
          
        </div><!-- /left -->

      <div class="right">
            <?php include 'session_checking_panel.php'; ?>
        </div>
      <div class="clear"></div>
    </div><!-- .center -->
		
		<?php include("main_menu.php"); ?>
	</header><!-- #header-->


	<div id="wrapper">
	
	<section id="middle">

		  <div id="content_full">
<h2>Recruiter Profile</h2>
<div class="master_details_full">
  <br>
  
  <?php if ($row_rsIsActive['user_active'] != 0){ ?>

  <?php include("recruiter_menu.php"); ?>

  <?php } else { ?>
  <span style="color:#FF0000">Please Activate your account. Check your mail or <a href="resent-activation.php?mail=<?php echo urlencode($_SESSION['MM_Username']); ?>">resend activation link</a>.</span>
  <?php } ?>
  
  <?php if ($row_rsIsActive['user_active'] != 0){ ?>
  <br/>

    <?php  

    /****************************
     *
     * Record Set for RecruiterProfile 
     * MySQL Info 
     * Table Used RecruiterProfile
     *
     ***************************/
    
    $query_rsRecruiterProfile = "SELECT * FROM recruit_profile WHERE user_id_fk = " . $_SESSION['MM_UserID'];
    $result_rsRecruiterProfile = mysql_query($query_rsRecruiterProfile);
    $total_rows_rsRecruiterProfile = mysql_num_rows($result_rsRecruiterProfile);
    

    /****************************
     *
     * Record Set for Industry 
     * MySQL Info 
     * Table Used Industry
     *
     ***************************/
    
    $query_rsIndustry = "SELECT * FROM jp_industry LIMIT 0, 60";
    $result_rsIndustry = mysql_query($query_rsIndustry);
    $total_rows_rsIndustry = mysql_num_rows($result_rsIndustry);
    

    ?>
    <strong>My Profile</strong>

    <?php if ($total_rows_rsRecruiterProfile == 0): ?>
      <p>Update your profile &amp; upload your profile picture</p>
      <p>
        <form action="ajax/add_recruiter_profile.php" method="GET" id="new_recruit_profile" name="new_recruit_profile">
          <table>
            <tr>
              <td>Full Name</td>
              <td>:</td>
              <td><input type="text" name="full_name" id="full_name" size="60"></td>
            </tr>
            <tr>
              <td>About Your Profile</td>
              <td>:</td>
              <td><textarea name="about_profile" id="about_profile" cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
              <td>Special In</td>
              <td>:</td>
              <td>
                <select name="special_in" id="special_in">
                  <?php while ($rows_rsIndustry = mysql_fetch_object($result_rsIndustry)) { ?>
                    <option value="<?php echo $rows_rsIndustry->indus_id ?>"><?php echo $rows_rsIndustry->indus_name ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Location</td>
              <td>:</td>
              <td>
                <?php  

                /****************************
                 *
                 * Record Set for State 
                 * MySQL Info 
                 * Table Used State
                 *
                 ***************************/
                
                $query_rsState = "SELECT * FROM mj_state";
                $result_rsState = mysql_query($query_rsState);
                $total_rows_rsState = mysql_num_rows($result_rsState);
                
                ?>
                <select name="rp_location" id="rp_location">
                  <option value="1">Location</option>
                  <?php while ($row_rsState = mysql_fetch_object($result_rsState)) { ?>
                    <option value="<?php echo $row_rsState->state_id ?>"><?php echo $row_rsState->state_name ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Rates</td>
              <td>:</td>
              <td>
                RM <input type="text" name="rp_rates" id="rp_rates"> / Hour
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>
                <input type="hidden" id="user_id_fk" name="user_id_fk" value="<?php echo $_SESSION['MM_UserID'] ?>">
                <button type="submit" name="submit" id="submitNewRecruitProfile" class="button green">Update Profile</button>
              </td>
            </tr>
          </table>
        </form>
      </p>
    <?php endif ?>


    <?php if ($total_rows_rsRecruiterProfile != 0): ?>

      <?php $rows_rsRecruiterProfile = mysql_fetch_object($result_rsRecruiterProfile); ?>
      <p>Your recruiter profile</p>
      <p>
        <input type="file" id="upload_pic_recuiter" name="upload_pic_recuiter">
        <input type="hidden" id="current_emp" name="current_emp" value="<?php echo $_SESSION['MM_UserID'] ?>">
      </p>
      <p>
        <form action="ajax/update_recruiter_profile.php" method="GET" id="update_recruit_profile" name="update_recruit_profile">
          <table>
            <tr>
              <td>Picture</td>
              <td>:</td>
              <td>
                <?php if ($rows_rsRecruiterProfile->rp_profile_pic_thumb != '') { ?>
                  <img src="../../uploads/<?php echo $rows_rsRecruiterProfile->rp_profile_pic_thumb ?>" alt="<?php echo $rows_rsRecruiterProfile->rp_full_name ?>" width="80px" height="80px" class="">
                <?php } else { ?>
                  <img src="../../uploads/default_agent.png" alt="agent">
                <?php } ?>
                
              </td>
            </tr>
            <tr>
              <td>Full Name</td>
              <td>:</td>
              <td><input type="text" name="full_name" id="full_name" size="60" value="<?php echo $rows_rsRecruiterProfile->rp_full_name ?>"></td>
            </tr>
            <tr>
              <td>About Your Profile</td>
              <td>:</td>
              <td><textarea name="about_profile" id="about_profile" cols="30" rows="10"><?php echo $rows_rsRecruiterProfile->rp_about ?>
              </textarea></td>
            </tr>
            <tr>
              <td>Special In</td>
              <td>:</td>
              <td>
                <select name="special_in" id="special_in">
                  <?php while ($rows_rsIndustry = mysql_fetch_object($result_rsIndustry)) { ?>
                    <option value="<?php echo $rows_rsIndustry->indus_id ?>" <?php if ($rows_rsRecruiterProfile->rp_special_industry == $rows_rsIndustry->indus_id) { echo 'selected="selected"'; } ?>>
                      <?php echo $rows_rsIndustry->indus_name ?>
                    </option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Location</td>
              <td>:</td>
              <td>
                <?php  

                /****************************
                 *
                 * Record Set for State 
                 * MySQL Info 
                 * Table Used State
                 *
                 ***************************/
                
                $query_rsState = "SELECT * FROM mj_state";
                $result_rsState = mysql_query($query_rsState);
                $total_rows_rsState = mysql_num_rows($result_rsState);
                
                ?>
                <select name="rp_location" id="rp_location">
                  <option value="1">Location</option>
                  <?php while ($row_rsState = mysql_fetch_object($result_rsState)) { ?>
                    <option value="<?php echo $row_rsState->state_id ?>" <?php if($row_rsState->state_id == $rows_rsRecruiterProfile->rp_location) { echo 'selected="selected"'; } ?>><?php echo $row_rsState->state_name ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Rates</td>
              <td>:</td>
              <td>
                RM <input type="text" name="rp_rates" id="rp_rates" value="<?php echo $rows_rsRecruiterProfile->rp_rates ?>"> / Hour
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>
                <input type="hidden" id="user_id_fk" name="user_id_fk" value="<?php echo $_SESSION['MM_UserID'] ?>">
                <button type="submit" name="submit" id="submitUpdateRecruitProfile" class="button green">Update Profile</button>
              </td>
            </tr>
          </table>
        </form>
      </p>
    <?php endif ?>

  <?php } // Show if recordset not empty ?>
</div>

          </div><!-- #content-->
	
			<!-- #sideRight -->


	</section><!-- #middle-->

	</div><!-- #wrapper-->

	<footer id="footer">
		<div class="center">
			<?php include("footer-upload.php"); ?>
		</div><!-- .center -->
	</footer><!-- #footer -->


<script>
  $(document).ready(function() {

    // NEW
    $('button#submitNewRecruitProfile').click(function(){

      var new_recruit_profile = $('form#new_recruit_profile');
      var serializeData = new_recruit_profile.serialize();
      var url_to_register = new_recruit_profile.attr('action');


      $.ajax({
        url: url_to_register+"?"+serializeData,

        success:function(data){
          if (data == "Saved") {
            window.location = "recruiterProfile.php?action=saved";
          } else {
            window.location = "recruiterProfile.php?action=error";
          }
        }
      });

      return false;
    });


    // UPDATE
    $('button#submitUpdateRecruitProfile').click(function(){

      var new_recruit_profile = $('form#update_recruit_profile');
      var serializeData = new_recruit_profile.serialize();
      var url_to_register = new_recruit_profile.attr('action');


      $.ajax({
        url: url_to_register+"?"+serializeData,

        success:function(data){
          if (data == "Saved") {
            window.location = "recruiterProfile.php?action=saved";
          } else {
            window.location = "recruiterProfile.php?action=error";
          }
        }
      });

      return false;
    })


    // upload recruiter picture
    var current_emp = $('input#current_emp').val();

    $('#upload_pic_recuiter').uploadify({
        'swf'      : '../uploadify/uploadify.swf',
        'uploader' : '../uploadify/recuiter_upload_photo.php?current_emp='+current_emp,
        // Put your options here
        'onUploadSuccess' : function(file, data, response) {
            window.location = "recruiterProfile.php";
            // console.log("Respone: " + data);
        }
    });

    console.log('OK');
  });
</script>
</body>
</html>
<?php
mysql_free_result($rsJobAds);

mysql_free_result($rsCandidateApplied);

mysql_free_result($rsIsActive);

mysql_free_result($rsEmployed);

mysql_free_result($rsComDetail);
?>
