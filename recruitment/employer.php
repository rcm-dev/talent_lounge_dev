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

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsTenLatestJob = "SELECT ads_id, ads_title FROM jp_ads WHERE ads_enable_view = 1 ORDER BY ads_date_posted DESC";
$rsTenLatestJob = mysql_query($query_rsTenLatestJob, $conJobsPerak) or die(mysql_error());
$row_rsTenLatestJob = mysql_fetch_assoc($rsTenLatestJob);
$totalRows_rsTenLatestJob = mysql_num_rows($rsTenLatestJob);

$colname_rsEmployerDetails = "-1";
if (isset($_GET['emp_id'])) {
  $colname_rsEmployerDetails = (int) stripslashes($_GET['emp_id']);
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsEmployerDetails = sprintf("Select   jp_employer.*, mj_users.*,  jp_industry.indus_name From   jp_employer Inner Join   jp_industry On jp_employer.emp_industry_id_fk = jp_industry.indus_id 
  Inner Join mj_users On mj_users.users_id = jp_employer.users_id_fk Where   jp_employer.emp_id = %s", GetSQLValueString($colname_rsEmployerDetails, "int"));
$rsEmployerDetails = mysql_query($query_rsEmployerDetails, $conJobsPerak) or die(mysql_error());
$row_rsEmployerDetails = mysql_fetch_assoc($rsEmployerDetails);
$totalRows_rsEmployerDetails = mysql_num_rows($rsEmployerDetails);

$maxRows_rsEmployerJobLists = 5;
$pageNum_rsEmployerJobLists = 0;
if (isset($_GET['pageNum_rsEmployerJobLists'])) {
  $pageNum_rsEmployerJobLists = $_GET['pageNum_rsEmployerJobLists'];
}
$startRow_rsEmployerJobLists = $pageNum_rsEmployerJobLists * $maxRows_rsEmployerJobLists;

$colname_rsEmployerJobLists = "-1";
if (isset($_GET['emp_id'])) {
  $colname_rsEmployerJobLists = $_GET['emp_id'] ;
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsEmployerJobLists = sprintf("Select   jp_ads.ads_id,   jp_ads.ads_title,   jp_ads.emp_id_fk,   jp_ads.ads_enable_view,   jp_ads.ads_date_published From   jp_ads Where   jp_ads.emp_id_fk = %s And   jp_ads.ads_enable_view = 1 Order By   jp_ads.ads_date_published Desc", GetSQLValueString($colname_rsEmployerJobLists, "int"));
$query_limit_rsEmployerJobLists = sprintf("%s LIMIT %d, %d", $query_rsEmployerJobLists, $startRow_rsEmployerJobLists, $maxRows_rsEmployerJobLists);
$rsEmployerJobLists = mysql_query($query_limit_rsEmployerJobLists, $conJobsPerak) or die(mysql_error());
$row_rsEmployerJobLists = mysql_fetch_assoc($rsEmployerJobLists);

if (isset($_GET['totalRows_rsEmployerJobLists'])) {
  $totalRows_rsEmployerJobLists = $_GET['totalRows_rsEmployerJobLists'];
} else {
  $all_rsEmployerJobLists = mysql_query($query_rsEmployerJobLists);
  $totalRows_rsEmployerJobLists = mysql_num_rows($all_rsEmployerJobLists);
}
$totalPages_rsEmployerJobLists = ceil($totalRows_rsEmployerJobLists/$maxRows_rsEmployerJobLists)-1;
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

    <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>

<script src="../js/ui/min/jquery.ui.map.full.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){

        $(function() {
                // Also works with: var yourStartLatLng = '59.3426606750, 18.0736160278';
                // var yourStartLatLng = new google.maps.LatLng(59.3426606750, 18.0736160278);
                // $('#map_canvas').gmap({'center': yourStartLatLng});

                $('#map_canvas').gmap().bind('init', function(ev, map) {
                $('#map_canvas').gmap('addMarker', {'position': '<?php echo $row_rsEmployerDetails['latitud']; ?>,<?php echo $row_rsEmployerDetails['magnitud']; ?>', 'bounds': true}).click(function() {
                  $('#map_canvas').gmap('openInfoWindow', {'content': 'Hello World!'}, this);
                });
              });
        });


      });
</script>

<style>
  .section{
    font color:#80ff00;
    align:"center";
  }

  .social{
    align:"center";
  }

 </style>

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

		  <div id="content" class="search_container" style="width:610px; padding-top:10px;margin-top:30px;">
          	 <!--  Viewing : <strong><?php echo ucfirst($_GET['employer']); ?></strong> -->
              <?php if ($totalRows_rsEmployerDetails > 0) { // Show if recordset not empty ?>
  <div class="master_details">
    <table>
      <tr>
        <td><img src="media/employer/img/<?php echo $row_rsEmployerDetails['user_pic']; ?>" alt="<?php echo $row_rsEmployerDetails['emp_pic']; ?>" style="max-width:130px;"></td>
        <td>  <p><br>
      <strong>Descriptions</strong><br> 
      <?php echo $row_rsEmployerDetails['emp_desc']; ?></p>
         </td>
      </tr>
    </table>
     <h2><?php echo $row_rsEmployerDetails['emp_name']; ?></h2>

 <div><br><br><br><h3 class="section"> 
...................................................
  Meet Us
...................................................</h3> <br>
        <div>


      <h3>Media</h3>
      
        <?php  

          /****************************
           *
           * Record Set for GetUserIDForEmployer 
           * MySQL Info 
           * Table Used GetUserIDForEmployer
           *
           ***************************/
          
          $query_rsGetUserIDForEmployer = "SELECT * FROM jp_employer WHERE emp_id = " . mysql_real_escape_string($_GET['emp_id']);
          $result_rsGetUserIDForEmployer = mysql_query($query_rsGetUserIDForEmployer);
          $row_rsGetUserIDForEmployer = mysql_fetch_object($result_rsGetUserIDForEmployer);
                  
                  


          /****************************
           *
           * Record Set for PublicDisplayMedia 
           * MySQL Info 
           * Table Used PublicDisplayMedia
           *
           ***************************/
          
          $query_rsPublicDisplayMedia = "SELECT * FROM emp_media 
                                          WHERE emp_m_type = 'photo' AND emp_usr_id_fk = " . $row_rsGetUserIDForEmployer->users_id_fk ;
          $result_rsPublicDisplayMedia = mysql_query($query_rsPublicDisplayMedia);
          $total_rsPublicDisplayMedia = mysql_num_rows($result_rsPublicDisplayMedia);
          ?>

          <?php if ($total_rsPublicDisplayMedia == 0): ?>
            <p>No Media</p>
          <?php endif ?>

          <?php if ($total_rsPublicDisplayMedia != 0): ?>
          
          <ul id="photo_media_public">
            <?php while ($row_rsPublicDisplayMedia = mysql_fetch_object($result_rsPublicDisplayMedia)) { ?>
              <li>
                <img src="../../uploads/<?php echo $row_rsPublicDisplayMedia->media_thumb ?>" alt="<?php echo $row_rsPublicDisplayMedia->media_thumb ?>">
              </li>
            <?php } ?>
          </ul>

          <?php endif ?>

      </div>
</div> <br><br><br> <div><h3 class="section">
...................................................
  Why Us
...................................................</h3> <br>


      <br>
      <strong>Jobs Advertisement</strong>
        <?php  

        /****************************
         *
         * Record Set for JobEmployer 
         * MySQL Info 
         * Table Used JobEmployer
         *
         ***************************/
        
        $query_rsJobEmployer = "SELECT * FROM jp_ads WHERE emp_id_fk = " . mysql_real_escape_string($_GET['emp_id']) . " AND ads_enable_view = 1";
        $result_rsJobEmployer = mysql_query($query_rsJobEmployer);
        $total_rows_rsJobEmployer = mysql_num_rows($result_rsJobEmployer);

        ?>
        <?php if ($total_rows_rsJobEmployer == 0): ?>
          <p>No Jobs</p>
        <?php endif ?>
        <?php if ($total_rows_rsJobEmployer != 0): ?>
          <ol style="margin-left:30px;">
            <?php while ($row_rsJobEmployer = mysql_fetch_object($result_rsJobEmployer)) { ?>
              <li>
                <a href="jobsAdsDetails.php?jobAdsId=<?php echo $row_rsJobEmployer->ads_id ?>">
                  <strong><?php echo strtoupper($row_rsJobEmployer->ads_title) ?></strong>
                </a>
              </li>
            <?php } ?>
          </ol>
        <?php endif ?>
      <br><br>
    <p><strong>Industry<br>
    </strong><?php echo $row_rsEmployerDetails['indus_name']; ?></p>
    <p><?php echo $row_rsEmployerDetails['emp_address']; ?><br>
      <?php echo $row_rsEmployerDetails['emp_tel']; ?><br>
      <?php echo $row_rsEmployerDetails['emp_email']; ?><br>
      <a href="http://<?php echo $row_rsEmployerDetails['emp_web']; ?>" title="<?php echo $row_rsEmployerDetails['emp_web']; ?>"><?php echo $row_rsEmployerDetails['emp_web']; ?></a></p>
<p><?php 
        if($row_rsEmployerDetails['emp_featured'] == 1)
        {
          echo "<strong>Premium Subscription</strong>";
        } else 
        {
          echo "Basic Subcription";
        } ?></p>
 <div><br><br><br><h3 class="section"> 
...................................................
  Info
...................................................</h3>   <br>

   <div id="map_canvas" style="width:600px;height:250px"></div>


 </div> 



  <div><br><br><br> <h3 class="section">
...................................................
  Social
...................................................</h3> <br>

   <div class="social">

    <table align="center"><tr>
    <td><a href="http://<?php echo $row_rsEmployerDetails['facebook']; ?>"><img src="../images/facebook-icon.png" width="64" height="64" alt="facebook"></a></td>
  <td><a href="http://<?php echo $row_rsEmployerDetails['twitter']; ?>"><img src="../images/twitter-icon.png" width="64" height="64" alt="twitter"></a></td></tr>
</table>

</div>


    
  </div>


  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_rsEmployerDetails == 0) { // Show if recordset empty ?>
  	<div class="master_details"><p>No list in our Database.</p></div>
  <?php } // Show if recordset empty ?>
          </div><!-- #content-->
	
		 <!--  <aside id="sideRight">
          	  <?php //include('full_content_sidebar.php'); ?>
          </aside>
 -->			<!-- aside -->
			<!-- #sideRight -->
		
</div>
	</section><!-- #middle-->


</div>
	</div><!-- #wrapper-->


	<!-- <footer id="footer">
		<div class="center">
			<?php //include("footer.php"); ?>
		</div> 
	<!-- </footer> --><!-- -->


</body>
</html>

<?php
mysql_free_result($rsTenLatestJob);

mysql_free_result($rsEmployerDetails);

mysql_free_result($rsEmployerJobLists);
?>
