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
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
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

$currentPage = $_SERVER["PHP_SELF"];

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsTenLatestJob = "SELECT ads_id, ads_title FROM jp_ads WHERE ads_enable_view = 1 ORDER BY ads_date_posted DESC";
$rsTenLatestJob = mysql_query($query_rsTenLatestJob, $conJobsPerak) or die(mysql_error());
$row_rsTenLatestJob = mysql_fetch_assoc($rsTenLatestJob);
$totalRows_rsTenLatestJob = mysql_num_rows($rsTenLatestJob);

$maxRows_rsJobByLocation = 10;
$pageNum_rsJobByLocation = 0;
if (isset($_GET['pageNum_rsJobByLocation'])) {
  $pageNum_rsJobByLocation = $_GET['pageNum_rsJobByLocation'];
}
$startRow_rsJobByLocation = $pageNum_rsJobByLocation * $maxRows_rsJobByLocation;

$colname_rsJobByLocation = "-1";
if (isset($_GET['ads_type'])) {
  $colname_rsJobByLocation = $_GET['ads_type'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsJobByLocation = sprintf("Select   jp_industry.indus_name,   jp_employer.*,   jp_ads.*,   jp_location.location_name From   jp_ads Inner Join   jp_industry On jp_ads.ads_industry_id_fk = jp_industry.indus_id Inner Join   jp_employer On jp_ads.emp_id_fk = jp_employer.emp_id Inner Join   jp_location On jp_ads.ads_location = jp_location.location_id Where   jp_ads.ads_type = %s And   jp_ads.ads_enable_view = 1", GetSQLValueString($colname_rsJobByLocation, "int"));
$query_limit_rsJobByLocation = sprintf("%s LIMIT %d, %d", $query_rsJobByLocation, $startRow_rsJobByLocation, $maxRows_rsJobByLocation);
$rsJobByLocation = mysql_query($query_limit_rsJobByLocation, $conJobsPerak) or die(mysql_error());
$row_rsJobByLocation = mysql_fetch_assoc($rsJobByLocation);

if (isset($_GET['totalRows_rsJobByLocation'])) {
  $totalRows_rsJobByLocation = $_GET['totalRows_rsJobByLocation'];
} else {
  $all_rsJobByLocation = mysql_query($query_rsJobByLocation);
  $totalRows_rsJobByLocation = mysql_num_rows($all_rsJobByLocation);
}
$totalPages_rsJobByLocation = ceil($totalRows_rsJobByLocation/$maxRows_rsJobByLocation)-1;

$queryString_rsJobByLocation = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsJobByLocation") == false && 
        stristr($param, "totalRows_rsJobByLocation") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsJobByLocation = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsJobByLocation = sprintf("&totalRows_rsJobByLocation=%d%s", $totalRows_rsJobByLocation, $queryString_rsJobByLocation);
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
    <script language="javascript" src="js/jquery-1.7.1.min.js"></script>
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
<div class="retiressSection">
	<div id="wrapper" style="padding:30px 0px;">
  
  <section id="middle">

      <div id="content_full" style="margin:0px;">


          	  <h2>Professional Jobs Listing / Retirees Career</h2>

              <div class="topTableCaption"><?php echo $totalRows_rsJobByLocation ?> Job(s) Posted in <?php echo ucfirst($_GET['location']); ?></div><br/>
              <?php if ($totalRows_rsJobByLocation > 0) { // Show if recordset not empty ?>
  <ul id="job-cards">
    <?php do { ?>
      <li>
        <div>
          <div>
            <div class="glossy-pic"></div>
            <img src="media/ads/<?php echo $row_rsJobByLocation['ads_pic']; ?>" alt="<?php echo ucfirst($row_rsJobByLocation['ads_title']) ?>">
          </div>
          <div class="jobs-close">
            Close Date: <strong><?php echo date('d-m-Y', strtotime($row_rsJobByLocation['ads_date_expired'])); ?></strong>
          </div>
        </div>
        <div class="job-title">
          <h2><strong><?php echo ucfirst($row_rsJobByLocation['ads_title']) ?></strong></h2>
          <p>
            MYR <?php echo $row_rsJobByLocation['ads_salary'] ?> &middot; <?php echo $row_rsJobByLocation['location_name'] ?>
          </p>
        </div>
        <div class="job-title" style="border-top:1px solid #eaeaea">
          <table style="color:#7d7d7d; font-size:11px;" width="100%">
            <tr>
              <td><?php echo $row_rsJobByLocation['emp_name'] ?></td>
              <td align="right"><?php echo $row_rsJobByLocation['ads_view'] ?> Viewed</td>
            </tr>
            <tr>
              <td colspan="2" align="center">
                <br>
                <a href="jobsAdsDetails.php?jobAdsId=<?php echo $row_rsJobByLocation['ads_id'] ?>" class="tl-btn-blue">Apply Now!</a>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div>
      </li>
      <?php } while ($row_rsJobByLocation = mysql_fetch_assoc($rsJobByLocation)); ?>
  </ul>
              <div class="paginate"><a href="<?php printf("%s?pageNum_rsJobByLocation=%d%s", $currentPage, 0, $queryString_rsJobByLocation); ?>">First</a> | <a href="<?php printf("%s?pageNum_rsJobByLocation=%d%s", $currentPage, max(0, $pageNum_rsJobByLocation - 1), $queryString_rsJobByLocation); ?>">Previous</a> | <a href="<?php printf("%s?pageNum_rsJobByLocation=%d%s", $currentPage, min($totalPages_rsJobByLocation, $pageNum_rsJobByLocation + 1), $queryString_rsJobByLocation); ?>">Next</a> | <a href="<?php printf("%s?pageNum_rsJobByLocation=%d%s", $currentPage, $totalPages_rsJobByLocation, $queryString_rsJobByLocation); ?>">Last</a></div>
                <?php } // Show if recordset not empty ?>
          </div><!-- #content-->
	
		  <!-- <aside id="sideRight"> -->
          	  <?php //include('full_content_sidebar.php'); ?>
          <!-- </aside> -->
			<!-- aside -->
			<!-- #sideRight -->
		

	</section><!-- #middle-->

	</div><!-- #wrapper-->
</div>
	<footer id="footer">
		<div class="center">
			<?php include("footer.php"); ?>
		</div><!-- .center -->
	</footer><!-- #footer -->



</body>
</html>
<?php
mysql_free_result($rsTenLatestJob);

mysql_free_result($rsJobByLocation);
?>
