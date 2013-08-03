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

$maxRows_rsJobsOpening = 30;
$pageNum_rsJobsOpening = 0;
if (isset($_GET['pageNum_rsJobsOpening'])) {
  $pageNum_rsJobsOpening = $_GET['pageNum_rsJobsOpening'];
}
$startRow_rsJobsOpening = $pageNum_rsJobsOpening * $maxRows_rsJobsOpening;

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsJobsOpening = "SELECT jp_ads.*, jp_location.*, jp_employer.* FROM jp_ads INNER JOIN jp_location ON jp_ads.ads_location = jp_location.location_id INNER JOIN jp_employer ON jp_ads.emp_id_fk = jp_employer.emp_id WHERE jp_ads.ads_enable_view = 1 ORDER BY ads_date_posted DESC";
$query_limit_rsJobsOpening = sprintf("%s LIMIT %d, %d", $query_rsJobsOpening, $startRow_rsJobsOpening, $maxRows_rsJobsOpening);
$rsJobsOpening = mysql_query($query_limit_rsJobsOpening, $conJobsPerak) or die(mysql_error());
$row_rsJobsOpening = mysql_fetch_assoc($rsJobsOpening);

if (isset($_GET['totalRows_rsJobsOpening'])) {
  $totalRows_rsJobsOpening = $_GET['totalRows_rsJobsOpening'];
} else {
  $all_rsJobsOpening = mysql_query($query_rsJobsOpening);
  $totalRows_rsJobsOpening = mysql_num_rows($all_rsJobsOpening);
}
$totalPages_rsJobsOpening = ceil($totalRows_rsJobsOpening/$maxRows_rsJobsOpening)-1;

$queryString_rsJobsOpening = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsJobsOpening") == false && 
        stristr($param, "totalRows_rsJobsOpening") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsJobsOpening = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsJobsOpening = sprintf("&totalRows_rsJobsOpening=%d%s", $totalRows_rsJobsOpening, $queryString_rsJobsOpening);
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
          	  <h1 class="title">Browse Jobs Opening</h1>
              <p>There are <?php echo $totalRows_rsJobsOpening ?> Job(s) opening.</p>
              <?php if ($totalRows_rsJobsOpening > 0) { // Show if recordset not empty ?>



  <ul id="job-cards">
    <?php while ($row_rsJobsOpening = mysql_fetch_object($rsJobsOpening)) { ?>
      <li>

        <div>
          
          <div class="profile left" style="border:0px solid orange; width: 90px;height:115px; padding:5px; margin:10px">
            
              <h2 class="titleImg"><?php echo ucwords($rowviewusrSQL->currName); ?></h2>
              <div style="background-image:url('<?php echo $row_rsJobsOpening->emp_pic; ?>'); width:110px; height:105px; background-repeat:no-repeat; background-position: top center; background-repeat:no-repeat; background-position: top center;  background-color:#f1f1f1">
                    
                    <!-- <img src="<?php echo $rowviewusrSQL->usrPicture; ?>" width="64" /> -->

                    </div>

          </div>
          <div class="profile right" style="border:0px solid purple;  width: 750px; margin:10px; padding:5px; ">
        <div class="profile22 left" style="border:0px solid #4c4c4c;  width: 560px; hight: margin:10px; padding:5px; ">
                <table>
                  <tr>
                    <th>JOB POST</th>
                    <td>:</td>
                     <td width ="215"><?php echo $row_rsJobsOpening->ads_title ?></td>
                     <th >DAY EXPIRED</th>
                     <td>:</td>
                     <td><?php echo date('d-m-Y', strtotime($row_rsJobsOpening->ads_date_expired)); ?></td>

                  </tr>
                  <tr>
                    <th>LOCATION</th>
                     <td>:</td>
                     <td width ="215"><?php echo $row_rsJobsOpening->location_name ?></td>
                     <th >SALARY SCALE</th>
                     <td>:</td>
                     <td>RM<?php echo $row_rsJobsOpening->ads_salary ?></td>
                  </tr>
                <tr>
                    <th>REQUIREMENT</th>
                     <td>:</td>
                     <td><?php echo $row_rsJobsOpening->ads_details ?></td>
                  </tr>

               </table>
          </div>  
        <div class="profile right" style="border:0px solid yellow;  width: 130px; margin:10px; padding:5px; ">
               <div style="float:center" class="button green"><h3 align="center"><a href="jobsAdsDetails.php?jobAdsId=<?php echo $row_rsJobsOpening->ads_id; ?>">APPLY</a></h3></div>
          </div> 
  <div class="clear"></div>
        </div>



  <div class="clear"></div>
        </div>
        
     
           
      </li>
      <?php } ?>

  </ul>
              <div class="paginate"><a href="<?php printf("%s?pageNum_rsJobsOpening=%d%s", $currentPage, 0, $queryString_rsJobsOpening); ?>">First</a> | <a href="<?php printf("%s?pageNum_rsJobsOpening=%d%s", $currentPage, max(0, $pageNum_rsJobsOpening - 1), $queryString_rsJobsOpening); ?>">Previous</a> | <a href="<?php printf("%s?pageNum_rsJobsOpening=%d%s", $currentPage, min($totalPages_rsJobsOpening, $pageNum_rsJobsOpening + 1), $queryString_rsJobsOpening); ?>">Next</a> | <a href="<?php printf("%s?pageNum_rsJobsOpening=%d%s", $currentPage, $totalPages_rsJobsOpening, $queryString_rsJobsOpening); ?>">Last</a> | 
Records <?php echo ($startRow_rsJobsOpening + 1) ?> to <?php echo min($startRow_rsJobsOpening + $maxRows_rsJobsOpening, $totalRows_rsJobsOpening) ?> of <?php echo $totalRows_rsJobsOpening ?></div>
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

mysql_free_result($rsJobsOpening);
?>
