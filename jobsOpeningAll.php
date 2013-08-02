<?php require_once('Connections/conJobsPerak.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsTenLatestJob = "SELECT ads_id, ads_title FROM jp_ads WHERE ads_enable_view = 1 ORDER BY ads_date_posted DESC";
$rsTenLatestJob = mysql_query($query_rsTenLatestJob, $conJobsPerak) or die(mysql_error());
$row_rsTenLatestJob = mysql_fetch_assoc($rsTenLatestJob);
$totalRows_rsTenLatestJob = mysql_num_rows($rsTenLatestJob);

$maxRows_rsAllTalent = 30;
$pageNum_rsAllTalent = 0;
if (isset($_GET['pageNum_rsAllTalent'])) {
  $pageNum_rsAllTalent = $_GET['pageNum_rsAllTalent'];
}
$startRow_rsAllTalent = $pageNum_rsAllTalent * $maxRows_rsAllTalent;

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsAllTalent = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_last_login As setLastlogin,
  mj_users.usr_email As setemail,
  mj_users.usr_id,
  mj_users.usr_name As currName,
  mj_users.usr_workat As WorkAt,
  
  mj_users.usr_general_info As CurGenInfo,
  mj_users.usr_rating,
  mj_users.usr_core_activity,
  mj_users.mj_sector_fk,
  mj_users.mj_services_fk,
  mj_sector.sec_name,
  mj_services.services_name As Profession,
  mj_state.state_name As Location,
  mj_country.country_name,
  jp_skills.skills_name As Skills,
  jp_edu_lists.edu_name As Education

From
  mj_users Inner Join
  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id Inner Join
  mj_country On mj_users.mj_country_id_fk = mj_country.country_id Inner Join
  jp_skills On jp_skills.user_id_fk = mj_users.users_id Inner Join
  jp_education On jp_education.user_id_fk = mj_users.users_id Inner Join
  jp_edu_lists On jp_education.edu_qualification = jp_edu_lists.edu_id ";
$query_limit_rsAllTalent = sprintf("%s LIMIT %d, %d", $query_rsAllTalent, $startRow_rsAllTalent, $maxRows_rsAllTalent);
$rsAllTalent = mysql_query($query_limit_rsAllTalent, $conJobsPerak) or die(mysql_error());
$row_rsAllTalent = mysql_fetch_assoc($rsAllTalent);

if (isset($_GET['totalRows_rsAllTalent'])) {
  $totalRows_rsAllTalent = $_GET['totalRows_rsAllTalent'];
} else {
  $all_rsAllTalent = mysql_query($query_rsAllTalent);
  $totalRows_rsAllTalent = mysql_num_rows($all_rsAllTalent);
}
$totalPages_rsAllTalent = ceil($totalRows_rsAllTalent/$maxRows_rsAllTalent)-1;

$queryString_rsAllTalent = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsAllTalent") == false && 
        stristr($param, "totalRows_rsAllTalent") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsAllTalent = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsAllTalent = sprintf("&totalRows_rsAllTalent=%d%s", $totalRows_rsAllTalent, $queryString_rsAllTalent);
?>
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

// if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
//   //to fully log out a visitor we need to clear the session varialbles
//   $_SESSION['MM_Username'] = NULL;
//   $_SESSION['MM_UserGroup'] = NULL;
//   $_SESSION['PrevUrl'] = NULL;
//   $_SESSION['MM_UserID'] = NULL;
//   unset($_SESSION['MM_Username']);
//   unset($_SESSION['MM_UserGroup']);
//   unset($_SESSION['PrevUrl']);
//   unset($_SESSION['MM_UserID']);
  
//   $logoutGoTo = "login.php";
//   if ($logoutGoTo) {
//     header("Location: $logoutGoTo");
//     exit;
//   }
// }
?>
<?php
// if (!isset($_SESSION)) {
//   session_start();
// }
// $MM_authorizedUsers = "2";
// $MM_donotCheckaccess = "false";

// // *** Restrict Access To Page: Grant or deny access to this page
// function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
//   // For security, start by assuming the visitor is NOT authorized. 
//   $isValid = False; 

//   // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
//   // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
//   if (!empty($UserName)) { 
//     // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
//     // Parse the strings into arrays. 
//     $arrUsers = Explode(",", $strUsers); 
//     $arrGroups = Explode(",", $strGroups); 
//     if (in_array($UserName, $arrUsers)) { 
//       $isValid = true; 
//     } 
//     // Or, you may restrict access to only certain users based on their username. 
//     if (in_array($UserGroup, $arrGroups)) { 
//       $isValid = true; 
//     } 
//     if (($strUsers == "") && false) { 
//       $isValid = true; 
//     } 
//   } 
//   return $isValid; 
// }

// $MM_restrictGoTo = "sessionGateway.php";
// if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
//   $MM_qsChar = "?";
//   $MM_referrer = $_SERVER['PHP_SELF'];
//   if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
//   if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
//   $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
//   $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
//   header("Location: ". $MM_restrictGoTo); 
//   exit;
// }
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

      <div id="content_full" style="padding-top:10px;margin-top:30px;">
              <h1 class="title">Browse the Talent</h1>
              <p>There are <?php echo $totalRows_rsAllTalent ?> Talent(s).</p>
              <?php if ($totalRows_rsAllTalent > 0) { // Show if recordset not empty ?>



  <ul id="job-cards">
    <?php while ($row_rsAllTalent = mysql_fetch_object($rsAllTalent)) { ?>
      <li>

        <div>
          
          <div class="profile left" style="border:1px solid orange; width: 90px;height:115px; padding:5px; margin:10px">
            
              <h2 class="titleImg"><?php echo ucwords($rowviewusrSQL->currName); ?></h2>
              <div style="background-image:url('<?php echo $row_rsAllTalent->emp_pic; ?>'); width:110px; height:105px; background-repeat:no-repeat; background-position: top center; background-repeat:no-repeat; background-position: top center;  background-color:#f1f1f1">
                    
                    <!-- <img src="<?php echo $rowviewusrSQL->usrPicture; ?>" width="64" /> -->

                    </div>

          </div>
          <div class="profile right" style="border:px solid purple;  width: 730px; margin:10px; padding:5px; ">
        <div class="profile22 left" style="border:1px solid #4c4c4c;  width: 700px; height:180px; margin:10px; padding:5px; ">
                <div class="talent"style="border:1px solid ;  width: 500px; height:150px; margin:10px; padding:5px;">
                             </div>
              

          
        <div class="profile right" style="border:1px solid yellow;  width: 130px; margin:5px;">
               <div style="float:center" class="button green"><h3 align="center"><a href="jobsAdsDetails.php?jobAdsId=<?php echo $row_rsAllTalent->ads_id; ?>">APPLY</a></h3></div>
          </div> 
  <div class="clear"></div>
        </div>



  <div class="clear"></div>
        </div>
        
     
           
      </li>
      <?php } ?>

  </ul>
              <div class="paginate"><a href="<?php printf("%s?pageNum_rsAllTalent=%d%s", $currentPage, 0, $queryString_rsAllTalent); ?>">First</a> | <a href="<?php printf("%s?pageNum_rsAllTalent=%d%s", $currentPage, max(0, $pageNum_rsAllTalent - 1), $queryString_rsAllTalent); ?>">Previous</a> | <a href="<?php printf("%s?pageNum_rsAllTalent=%d%s", $currentPage, min($totalPages_rsAllTalent, $pageNum_rsAllTalent + 1), $queryString_rsAllTalent); ?>">Next</a> | <a href="<?php printf("%s?pageNum_rsAllTalent=%d%s", $currentPage, $totalPages_rsAllTalent, $queryString_rsAllTalent); ?>">Last</a> | 
Records <?php echo ($startRow_rsAllTalent + 1) ?> to <?php echo min($startRow_rsAllTalent + $maxRows_rsAllTalent, $totalRows_rsAllTalent) ?> of <?php echo $totalRows_rsAllTalent ?></div>
                <?php } // Show if recordset not empty ?>
          </div><!-- #content-->
  
      <!-- <aside id="sideRight"> -->
              <?php //include('full_content_sidebar.php'); ?>
          <!-- </aside> -->
      <!-- aside -->
      <!-- #sideRight -->

    

  </section><!-- #middle-->

  </div><!-- #wrapper-->

  <footer id="footer">
    <div class="center">
      <?php include("footer.php"); ?>
    </div><!-- .center -->
  </footer><!-- #footer -->



</body>
</html>
<?php
mysql_free_result($rsTenLatestJob);

mysql_free_result($rsAllTalent);
?>
