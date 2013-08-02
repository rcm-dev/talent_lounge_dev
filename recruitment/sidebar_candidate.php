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

$maxRows_rsRecentJobs = 10;
$pageNum_rsRecentJobs = 0;
if (isset($_GET['pageNum_rsRecentJobs'])) {
  $pageNum_rsRecentJobs = $_GET['pageNum_rsRecentJobs'];
}
$startRow_rsRecentJobs = $pageNum_rsRecentJobs * $maxRows_rsRecentJobs;

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsRecentJobs = "SELECT * FROM jp_ads WHERE ads_enable_view = 1 ORDER BY ads_id DESC";
$query_limit_rsRecentJobs = sprintf("%s LIMIT %d, %d", $query_rsRecentJobs, $startRow_rsRecentJobs, $maxRows_rsRecentJobs);
$rsRecentJobs = mysql_query($query_limit_rsRecentJobs, $conJobsPerak) or die(mysql_error());
$row_rsRecentJobs = mysql_fetch_assoc($rsRecentJobs);

if (isset($_GET['totalRows_rsRecentJobs'])) {
  $totalRows_rsRecentJobs = $_GET['totalRows_rsRecentJobs'];
} else {
  $all_rsRecentJobs = mysql_query($query_rsRecentJobs);
  $totalRows_rsRecentJobs = mysql_num_rows($all_rsRecentJobs);
}
$totalPages_rsRecentJobs = ceil($totalRows_rsRecentJobs/$maxRows_rsRecentJobs)-1;

$maxRows_rsHiringThisWeek = 10;
$pageNum_rsHiringThisWeek = 0;
if (isset($_GET['pageNum_rsHiringThisWeek'])) {
  $pageNum_rsHiringThisWeek = $_GET['pageNum_rsHiringThisWeek'];
}
$startRow_rsHiringThisWeek = $pageNum_rsHiringThisWeek * $maxRows_rsHiringThisWeek;

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsHiringThisWeek = "SELECT * FROM jp_employer ORDER BY emp_id DESC";
$query_limit_rsHiringThisWeek = sprintf("%s LIMIT %d, %d", $query_rsHiringThisWeek, $startRow_rsHiringThisWeek, $maxRows_rsHiringThisWeek);
$rsHiringThisWeek = mysql_query($query_limit_rsHiringThisWeek, $conJobsPerak) or die(mysql_error());
$row_rsHiringThisWeek = mysql_fetch_assoc($rsHiringThisWeek);

if (isset($_GET['totalRows_rsHiringThisWeek'])) {
  $totalRows_rsHiringThisWeek = $_GET['totalRows_rsHiringThisWeek'];
} else {
  $all_rsHiringThisWeek = mysql_query($query_rsHiringThisWeek);
  $totalRows_rsHiringThisWeek = mysql_num_rows($all_rsHiringThisWeek);
}
$totalPages_rsHiringThisWeek = ceil($totalRows_rsHiringThisWeek/$maxRows_rsHiringThisWeek)-1;

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsArticleCat = "Select   jp_article.*,   jp_article.art_id As art_id1 From   jp_article Where   arc_published = 1  Order By   RAND() LIMIT 0,5";
$rsArticleCat = mysql_query($query_rsArticleCat, $conJobsPerak) or die(mysql_error());
$row_rsArticleCat = mysql_fetch_assoc($rsArticleCat);
$totalRows_rsArticleCat = mysql_num_rows($rsArticleCat);

$maxRows_rsRoadshowList = 1;
$pageNum_rsRoadshowList = 0;
if (isset($_GET['pageNum_rsRoadshowList'])) {
  $pageNum_rsRoadshowList = $_GET['pageNum_rsRoadshowList'];
}
$startRow_rsRoadshowList = $pageNum_rsRoadshowList * $maxRows_rsRoadshowList;

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsRoadshowList = "SELECT * FROM jp_roadshow WHERE status = 1 ORDER BY rs_date DESC";
$query_limit_rsRoadshowList = sprintf("%s LIMIT %d, %d", $query_rsRoadshowList, $startRow_rsRoadshowList, $maxRows_rsRoadshowList);
$rsRoadshowList = mysql_query($query_limit_rsRoadshowList, $conJobsPerak) or die(mysql_error());
$row_rsRoadshowList = mysql_fetch_assoc($rsRoadshowList);

if (isset($_GET['totalRows_rsRoadshowList'])) {
  $totalRows_rsRoadshowList = $_GET['totalRows_rsRoadshowList'];
} else {
  $all_rsRoadshowList = mysql_query($query_rsRoadshowList);
  $totalRows_rsRoadshowList = mysql_num_rows($all_rsRoadshowList);
}
$totalPages_rsRoadshowList = ceil($totalRows_rsRoadshowList/$maxRows_rsRoadshowList)-1;
?>
<div class="sidebarBox" style="margin-bottom: 20px; border-bottom:1px dotted #ccc; padding-bottom: 20px;">
<div style="text-align:center">
  <img src="../images/Folders-Videos-icon.png" alt="Gallery Video"><br><br>
  <strong class="rTitle">Learn how-to use Talent Lounge!</strong>
  <p>Collection how-to video channel</p>
</div><!-- .sidebar_recentjob -->
</div><!-- .sidebarFullBox -->
            

<div class="sidebarBox" style="margin-bottom: 20px; border-bottom:1px dotted #ccc; padding-bottom: 20px;">
<div style="text-align:center">
  <img src="../images/groups-icon.png" alt="Group"><br><br>
  <strong class="rTitle">Find jobs at your friend's companies</strong> <br>
  <a href="#">Connect with Facebook</a>
</div>
</div><!-- .sidebarBox -->


<div class="sidebarBox" style="margin-bottom: 20px; border-bottom:1px dotted #ccc; padding-bottom: 20px;">
<div style="text-align:center">
  <a href="resumeUpload.php"><img src="../images/profile-arrow-up-icon.png" alt="Group"></a><br><br>
  <strong class="rTitle">Upload your resume!</strong>
  <p>Upload your resume, and start apply the job!</p>
</div>
</div><!-- .sidebarBox -->

<div class="sidebarBox">
<div style="text-align:center">
  <a href="videoUpload.php"><img src="../images/movie-icon.png" alt="Group"></a><br><br>
  <strong class="rTitle">Upload your video resume!</strong>
  <p>Check it out video resume! or upload your's</p>
</div>
</div><!-- .sidebarBox -->


<?php
mysql_free_result($rsRecentJobs);

mysql_free_result($rsHiringThisWeek);

mysql_free_result($rsArticleCat);

mysql_free_result($rsRoadshowList);
?>
