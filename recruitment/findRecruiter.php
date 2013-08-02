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
$MM_authorizedUsers = "2";
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

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title>Welcome to Talent Lounge</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection" />
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
<h2>Employer Dashboard</h2>
<div class="master_details_full">
  <p>Welcome <?php echo $_SESSION['MM_Username']; ?> <?php //echo $_SESSION['MM_UserID']; ?> | <a href="<?php echo $logoutAction ?>">Log Out</a></p>
  
  <?php if ($row_rsIsActive['user_active'] != 0){ ?>

  <?php include("employer_menu.php"); ?>

  <?php } else { ?>
  <span style="color:#FF0000">Please Activate your account. Check your mail or <a href="resent-activation.php?mail=<?php echo $_SESSION['MM_Username']; ?>">resend activation link</a>.</span>
  <?php } ?>
  
  <?php if ($row_rsIsActive['user_active'] != 0){ ?>
  <br/>
  <h3>Find a Recruiter</h3>
  Filter recruiter by special in industry and location. <br><br>
  <table>
    <tr>
      <td><strong>Special In Industry</strong></td>
      <td>:</td>
      <td>
        <?php  

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
        <select name="in_industry" id="in_industry">
          <option value="0">All Industry</option>
          <?php while ($row_rsIndustry = mysql_fetch_object($result_rsIndustry)) { ?>
            <option value="<?php echo $row_rsIndustry->indus_id ?>"><?php echo $row_rsIndustry->indus_name ?></option>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td><strong>Location</strong></td>
      <td>:</td>
      <td>
        <select name="in_location" class="in_location" id="in_location">
          <option value="0">All location</option>
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
      </td>
    </tr>
    <tr>
      <td><strong>Rates</strong></td>
      <td>:</td>
      <td>
        <select name="rates" id="rates">
          <option value="0">All Rates</option>
          <option value="100">below RM 100 / Hour</option>
          <option value="200">above RM 200 / Hour</option>
        </select>
      </td>
    </tr>
  </table>
  <form>
<button type="submit" id="Check" class="button green" name="Check">Filter</button></form>
<div id="searchResult" class="">

  <?php 

 

  /****************************
   *
   * Record Set for AllRecruiter 
   * MySQL Info 
   * Table Used AllRecruiter
   *
   ***************************/
  
  $query_rsAllRecruiter = "SELECT recruit_profile.*, mj_users.*, jp_industry.*, mj_state.* FROM recruit_profile
                            INNER JOIN mj_users
                            ON recruit_profile.user_id_fk = mj_users.usr_id
                            INNER JOIN jp_industry
                            ON recruit_profile.rp_special_industry = jp_industry.indus_id
                            INNER JOIN mj_state
                            ON recruit_profile.rp_location = mj_state.state_id";
                            
  $result_rsAllRecruiter = mysql_query($query_rsAllRecruiter);
  $total_rows_rsAllRecruiter = mysql_num_rows($result_rsAllRecruiter);

  
  ?>
<!--   
<?php  
// if ($in_industry == 0 && $in_location == 0 && $rates == 0) {
   if ($in_location == 0) {
    $query_rsAllLocation = "SELECT recruit_profile.*, mj_users.*, jp_industry.*, mj_state.* FROM recruit_profile
                            INNER JOIN mj_users
                            ON recruit_profile.user_id_fk = mj_users.usr_id
                            INNER JOIN jp_industry
                            ON recruit_profile.rp_special_industry = jp_industry.indus_id
                            INNER JOIN mj_state
                            ON recruit_profile.rp_location = mj_state.state_id
                            WHERE state_id ='$in_location'";
  $result_rsAllLocation = mysql_query($query_rsAllLocation);
  $total_rows_rsAllRecruiter = mysql_num_rows($result_rsAllLocation);
}

?> -->
<br>
  <table class="csstable2" width="100%">
    <tr>
      <th>Recruiter</th>
      <th>Special in</th>
      <th>Rate</th>
      <th>Action</th>
    </tr>
    <?php while ($row_AllRecruiter = mysql_fetch_object($result_rsAllRecruiter)) { ?>
      <tr>
        <td width="600px">
          <div class="left" style="width:100px">
            <img src="../../uploads/<?php echo $row_AllRecruiter->rp_profile_pic_thumb ?>" alt="<?php echo $row_AllRecruiter->rp_profile_pic_thumb ?>" width="80px">
          </div>
          <div class="right" style="width:500px;">
            <h3><?php echo $row_AllRecruiter->rp_full_name ?></h3>
            <?php echo $row_AllRecruiter->rp_about ?><br>
            <span><img src="../images/icon_color/marker.png" alt="Marker"> <?php echo $row_AllRecruiter->state_name ?></span>
          </div>
          <div class="clear"></div>
        </td>
        <td align="center" valign="middle">
          <?php echo $row_AllRecruiter->indus_name ?>
        </td>
        <td align="center" valign="middle">
          <?php echo $row_AllRecruiter->rp_rates ?>
        </td>
        <td align="center" valign="middle">
          <a href="contactRecruiter.php?rid=<?php echo mysql_real_escape_string(base64_encode($row_AllRecruiter->rp_id)) ?>&rname=<?php echo mysql_real_escape_string(urlencode($row_AllRecruiter->rp_full_name)) ?>" class="fancybox contactRecruitClass" id="contactRecruitId<?php echo mysql_real_escape_string($row_AllRecruiter->rp_id) ?>" data-id="<?php echo mysql_real_escape_string($row_AllRecruiter->rp_id) ?>">Contact</a>
        </td>
      </tr>
    <?php } ?>

  </table> 
  
   <?php } // if not active?>

</div>

          </div><!-- #content-->
	
			<!-- #sideRight -->


	</section><!-- #middle-->

	</div><!-- #wrapper-->

	<footer id="footer">
		<div class="center">
			<?php include("footer.php"); ?>
		</div><!-- .center -->
	</footer><!-- #footer -->


  <script>
  $(document).ready(function() {
    
    $('a.contactRecruitClass').fancybox();

 





$('#Check').click(function(){
    
    //alert('click');

    // get val()
    var in_location        = $('#in_location').val();
   
 // });
 var dataString = 'in_location='+in_location;
      
      console.log(dataString);


      $('#searchResult').html('loading....').fadeIn().load('ajaxrecuitList.php?'+dataString);
      
      return false;


    }

    });    
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
