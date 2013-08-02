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
$query_rsLocation = "SELECT * FROM jp_location WHERE location_parent = 0 ORDER BY location_name ASC LIMIT 0,8";
$rsLocation = mysql_query($query_rsLocation, $conJobsPerak) or die(mysql_error());
$row_rsLocation = mysql_fetch_assoc($rsLocation);
$totalRows_rsLocation = mysql_num_rows($rsLocation);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsIndustry = "SELECT * FROM jp_industry WHERE industry_parent = 0 LIMIT 0,8"; // limit to 60
$rsIndustry = mysql_query($query_rsIndustry, $conJobsPerak) or die(mysql_error());
$row_rsIndustry = mysql_fetch_assoc($rsIndustry);
$totalRows_rsIndustry = mysql_num_rows($rsIndustry);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsIndustryAll = "SELECT * FROM jp_industry WHERE industry_parent = 0 LIMIT 0,60"; // limit to 60
$rsIndustryAll = mysql_query($query_rsIndustryAll, $conJobsPerak) or die(mysql_error());
$row_rsIndustryAll = mysql_fetch_assoc($rsIndustryAll);
$totalRows_rsIndustryAll = mysql_num_rows($rsIndustryAll);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsTenLatestJob = "SELECT ads_id, ads_title FROM jp_ads WHERE ads_enable_view = 1 ORDER BY ads_date_posted DESC";
$rsTenLatestJob = mysql_query($query_rsTenLatestJob, $conJobsPerak) or die(mysql_error());
$row_rsTenLatestJob = mysql_fetch_assoc($rsTenLatestJob);
$totalRows_rsTenLatestJob = mysql_num_rows($rsTenLatestJob);

$maxRows_rs14FeaturedEmployed = 14;
$pageNum_rs14FeaturedEmployed = 0;
if (isset($_GET['pageNum_rs14FeaturedEmployed'])) {
  $pageNum_rs14FeaturedEmployed = $_GET['pageNum_rs14FeaturedEmployed'];
}
$startRow_rs14FeaturedEmployed = $pageNum_rs14FeaturedEmployed * $maxRows_rs14FeaturedEmployed;

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rs14FeaturedEmployed = "SELECT emp_id, emp_name, emp_featured FROM jp_employer WHERE emp_featured = 1";
$query_limit_rs14FeaturedEmployed = sprintf("%s LIMIT %d, %d", $query_rs14FeaturedEmployed, $startRow_rs14FeaturedEmployed, $maxRows_rs14FeaturedEmployed);
$rs14FeaturedEmployed = mysql_query($query_limit_rs14FeaturedEmployed, $conJobsPerak) or die(mysql_error());
$row_rs14FeaturedEmployed = mysql_fetch_assoc($rs14FeaturedEmployed);

if (isset($_GET['totalRows_rs14FeaturedEmployed'])) {
  $totalRows_rs14FeaturedEmployed = $_GET['totalRows_rs14FeaturedEmployed'];
} else {
  $all_rs14FeaturedEmployed = mysql_query($query_rs14FeaturedEmployed);
  $totalRows_rs14FeaturedEmployed = mysql_num_rows($all_rs14FeaturedEmployed);
}
$totalPages_rs14FeaturedEmployed = ceil($totalRows_rs14FeaturedEmployed/$maxRows_rs14FeaturedEmployed)-1;

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rs10FeaturedCandidate = "Select   jp_resume.users_id_fk,   jp_resume.resume_featured,   mj_users.users_fname,   mj_users.users_lname From   jp_resume Inner Join   mj_users On jp_resume.users_id_fk = mj_users.users_id Where   jp_resume.resume_featured = 1";
$rs10FeaturedCandidate = mysql_query($query_rs10FeaturedCandidate, $conJobsPerak) or die(mysql_error());
$row_rs10FeaturedCandidate = mysql_fetch_assoc($rs10FeaturedCandidate);
$totalRows_rs10FeaturedCandidate = mysql_num_rows($rs10FeaturedCandidate);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsAllindustries = "SELECT * FROM jp_industry LIMIT 0 , 60";
$rsAllindustries = mysql_query($query_rsAllindustries, $conJobsPerak) or die(mysql_error());
$row_rsAllindustries = mysql_fetch_assoc($rsAllindustries);
$totalRows_rsAllindustries = mysql_num_rows($rsAllindustries);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsTotalJobsOnline = "Select   Count(*) As totalOnline From   jp_ads Where   jp_ads.ads_enable_view = 1";
$rsTotalJobsOnline = mysql_query($query_rsTotalJobsOnline, $conJobsPerak) or die(mysql_error());
$row_rsTotalJobsOnline = mysql_fetch_assoc($rsTotalJobsOnline);
$totalRows_rsTotalJobsOnline = mysql_num_rows($rsTotalJobsOnline);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title>Welcome to Talent Lounge Portal</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="css/reveal.css">
	<script language="javascript" src="js/jquery-1.7.1.min.js"></script>
    <!-- Jquery modal -->
  <script src="js/jquery.reveal.js" type="text/javascript"></script>

  <link href="http://vjs.zencdn.net/4.1/video-js.css" rel="stylesheet">
  <script src="http://vjs.zencdn.net/4.1/video.js"></script>

</head>

<body>



	<header id="header">

		<div class="center">
			 <div id="logo" class="left" style="margin:0px 0px 0px 0px;">
          <a href="index.php" title="Home">
            <img src="../images/tl-logo.png" alt="logo.png" border="0">
          </a>
          
        </div><!-- /left -->

			<div class="right">
            <?php include 'session_checking_panel.php'; ?>
    		</div>
			<div class="clear"></div>
		</div><!-- .center -->
		
		<?php include("main_menu.php"); ?>
	</header><!-- #header-->
  <div id="search_help" style="margin-top:0px" class="recuit-landing">
    <div style="text-align:center; padding: 20px 0px;">
    </div>
    <div class="center">
      <div style="margin-bottom:40px;">
        <iframe src="../recruitSlider/index.php" frameborder="0" width="1000px" height="380px" scrolling="no"></iframe>
      </div>

      <div>
        <div class="search_container_index">
                  <h1 class="title">Search Jobs</h1>
                  <form action="jobAdsSearchResult.php" method="get" name="front_search">
                    <table width="100%" border="0" cellspacing="6" cellpadding="2">
  <tr>
    <td colspan="4"><input name="q" type="text" class="main_q" id="main_q" placeholder="Search by Job Title / Job Description " dir="ltr" /></td>
  </tr>
  <tr>
    <td><select name="industries">
      <option value="0">All Industries</option>
      <?php
do {  
?>
      <option value="<?php echo $row_rsAllindustries['indus_id']?>"><?php echo $row_rsAllindustries['indus_name']?></option>
      <?php
} while ($row_rsAllindustries = mysql_fetch_assoc($rsAllindustries));
  $rows = mysql_num_rows($rsAllindustries);
  if($rows > 0) {
      mysql_data_seek($rsAllindustries, 0);
    $row_rsAllindustries = mysql_fetch_assoc($rsAllindustries);
  }
?>
    </select></td>
    <td><select name="locations">
      <option value="0">All Locations</option>
      <?php
do {  
?>
      <option value="<?php echo $row_rsLocation['location_id']?>"><?php echo $row_rsLocation['location_name']?></option>
      <?php
} while ($row_rsLocation = mysql_fetch_assoc($rsLocation));
  $rows = mysql_num_rows($rsLocation);
  if($rows > 0) {
      mysql_data_seek($rsLocation, 0);
    $row_rsLocation = mysql_fetch_assoc($rsLocation);
  }
?>
    </select></td>
    <td><select name="salary">
      <option value="0">All Salaries</option>
      <option value="1000">Below RM1,000</option>
      <option value="2000">Below RM2,000</option>
      <option value="3000">Below RM3,000</option>
      <option value="10000">RM10,000 and Below</option>
    </select></td>
    <td><select name="year_exp">
      <option value="0">No Experience</option>
      <option value="1">1 Year</option>
      <option value="2">2 Years</option>
      <option value="3">3 Years</option>
      <option value="4">4 Years</option>
      <option value="5">5 Years and above</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="2">There are currently (<?php echo $row_rsTotalJobsOnline['totalOnline']; ?>) jobs available for you to choose. 
    <a href="jobsOpeningAll.php" class="tl-btn-blue"> Browse all jobs opening in our portal &raquo;</a> 
    <input name="search_job" type="submit" class="tl-btn-green" id="search_job" value="Search Job">
    </td>
    <td>&nbsp;</td>
    <td><a href="#" class="hide">Advanced Search</a></td>
  </tr>
</table>
                  </form>
                </div>
      </div>

      <div class="right" style="width:338px; display:none">
        <div class="search_container" style="height:147px;">
          <h3 class="icon_help rTitle">How-to</h3>
          <table>
            <tbody>
              <tr>
                <td><img src="img/Files-Download-File-icon-emp.png" title="Download how-to register as employer" /></td>
                <td><strong style="color:#2951ED">Employers</strong><br/>Download how-to register as employer</td>
              </tr>
              <tr>
                <td><img src="img/Files-Download-File-icon.png" title="Download how-to register as Jobseekers" /></td>
                <td><strong>Jobseekers</strong><br/>Download how-to register as Jobseekers</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div style="clear:both"></div>

    </div><!-- ./center -->
  </div><!-- /#search_help -->

	<div id="wrapper">

  <div style="margin-top:30px;">

  <div class="resumebox">
    <h2 class="title">Video Resumes</h2>
    <ul id="video-resume-list">
      <li>
        <video id="example_video_1" class="video-js vjs-default-skin"
          controls preload="auto" width="320" height="240"
          poster="http://beta.talentlounge.my/recruitment/media/video_candidate/1.png">
         <source src="http://beta.talentlounge.my/recruitment/media/video_candidate/WAN NOOR FARIHAN.mp4" type='video/mp4' />
        </video>
      </li>
      <li>
        <video id="example_video_1" class="video-js vjs-default-skin"
          controls preload="auto" width="320" height="240"
          poster="http://beta.talentlounge.my/recruitment/media/video_candidate/2.png">
         <source src="http://beta.talentlounge.my/recruitment/media/video_candidate/SABARINA MANAN.mp4" type='video/mp4' />
        </video>
      </li>
      <li>
        <video id="example_video_1" class="video-js vjs-default-skin"
          controls preload="auto" width="320" height="240"
          poster="http://beta.talentlounge.my/recruitment/media/video_candidate/3.png">
         <source src="http://beta.talentlounge.my/recruitment/media/video_candidate/NURUL HAZIQAH SAMSUL BAHRIN.mp4" type='video/mp4' />
        </video>
      </li>
      <li>
        <video id="example_video_1" class="video-js vjs-default-skin"
          controls preload="auto" width="320" height="240"
          poster="http://beta.talentlounge.my/recruitment/media/video_candidate/4.png">
         <source src="http://beta.talentlounge.my/recruitment/media/video_candidate/NURUL DANIELA BT AZMAN.mp4" type='video/mp4' />
        </video>
      </li>
      <li>
        <video id="example_video_1" class="video-js vjs-default-skin"
          controls preload="auto" width="320" height="240"
          poster="http://beta.talentlounge.my/recruitment/media/video_candidate/5.png">
         <source src="http://beta.talentlounge.my/recruitment/media/video_candidate/NURAIN.mp4" type='video/mp4' />
        </video>
      </li>
      <li>
        <video id="example_video_1" class="video-js vjs-default-skin"
          controls preload="auto" width="320" height="240"
          poster="http://beta.talentlounge.my/recruitment/media/video_candidate/6.png">
         <source src="http://beta.talentlounge.my/recruitment/media/video_candidate/NURSYAHIRAH NADZARI.mp4" type='video/mp4' />
        </video>
      </li>
    </ul>
    <p style="text-align:center">
      <br>
      <a href="browseVidResume.php" class="tl-btn-green">Browse more videos</a>
    </p>
    <p style="text-align:center; font-size: 20px;">
      <br>
      Get inspired? Join us and get hire! easy step just like 1 2 3.
    </p>
    <p style="text-align:center;">
      1. Join Us! 2. Upload your resume! 3. Get Hire!
    </p>
  </div>

  <div>
    <h2 class="title">Top Locations</h2>
        <ul id="loc-landing">
            <?php do { ?>
              <li class="resumebox"><a href="jobsByLocation.php?ads_location=<?php echo $row_rsLocation['location_id']; ?>&location=<?php echo $row_rsLocation['location_name']; ?>">
                <div class="glossy-pic-photo"></div>
                <div>
                  <img src="../<?php echo $row_rsLocation['location_image']; ?>" alt="<?php echo $row_rsLocation['location_name']; ?>" height="128px">
                </div>
                <h3><strong><?php echo ucfirst($row_rsLocation['location_name']); ?></strong></h3>
                <p style="color:grey">
                  <?php  

                  /****************************
                   *
                   * Record Set for TotalJosLists 
                   * MySQL Info 
                   * Table Used TotalJosLists
                   *
                   ***************************/
                  
                  $query_rsTotalJosLists = "SELECT * FROM jp_ads WHERE ads_location = " . $row_rsLocation['location_id'] . " AND ads_enable_view = 1";
                  $result_rsTotalJosLists = mysql_query($query_rsTotalJosLists);
                  $total_rows_rsTotalJosLists = mysql_num_rows($result_rsTotalJosLists);
                  
                  if ($result_rsTotalJosLists) {
                    echo $total_rows_rsTotalJosLists;
                  } else {
                    echo "0";
                  }

                  ?> Job(s) Available.
                </p>
              </a>
                <?php
    
      /*$parent = $row_rsLocation['location_id'];
      $sql_child = "SELECT * FROM jp_location WHERE location_parent = $parent";
      $sql_child_result = mysql_query($sql_child);
      $sql_child_result_row = mysql_num_rows($sql_child_result);
      
      
      if($sql_child_result_row > 0) {
        
      echo "<ul>";
        
        while($child_object_row = mysql_fetch_object($sql_child_result)){
          echo "<li>" . $child_object_row->location_name . "</li>";
        }
        
      echo "</ul>";
        
      }*/
      
      
    ?>
                </li>
              <?php } while ($row_rsLocation = mysql_fetch_assoc($rsLocation)); ?>
                <div class="clear"></div>
          </ul>
      <p style="text-align:center;">
        <a href="browseBylocation.php" class="tl-btn-green">Browse more location</a>
      </p>
  </div>


    <ul id="front-hero" class="hide">
      <li class="resumebox">
        <h2 class="title">Top Industries</h2>
        <ul>
          <?php do { ?>
            <li><a href="jobsByIndustry.php?ads_industry_id_fk=<?php echo $row_rsIndustry['indus_id']; ?>&industry=<?php echo $row_rsIndustry['indus_name']; ?>"><?php echo $row_rsIndustry['indus_name']; ?></a></li>
            <?php } while ($row_rsIndustry = mysql_fetch_assoc($rsIndustry)); ?>
              <div class="clear"></div>
        </ul>
        <br>
        <a href="browseByIndustry.php" class="btn btn-warning btn-mini">View More &rarr;</a>
      </li>
      <li class="resumebox">
        <h2 class="title">Top Locations</h2>
        <ul>
            <?php do { ?>
              <li><a href="jobsByLocation.php?ads_location=<?php echo $row_rsLocation['location_id']; ?>&location=<?php echo $row_rsLocation['location_name']; ?>"><?php echo $row_rsLocation['location_name']; ?></a>
                <?php
    
      /*$parent = $row_rsLocation['location_id'];
      $sql_child = "SELECT * FROM jp_location WHERE location_parent = $parent";
      $sql_child_result = mysql_query($sql_child);
      $sql_child_result_row = mysql_num_rows($sql_child_result);
      
      
      if($sql_child_result_row > 0) {
        
      echo "<ul>";
        
        while($child_object_row = mysql_fetch_object($sql_child_result)){
          echo "<li>" . $child_object_row->location_name . "</li>";
        }
        
      echo "</ul>";
        
      }*/
      
      
    ?>
                </li>
              <?php } while ($row_rsLocation = mysql_fetch_assoc($rsLocation)); ?>
                <div class="clear"></div>
          </ul>
          <br>
        <a href="browseBylocation.php" class="btn btn-warning btn-mini">View More &rarr;</a>
      </li>
      <li class="resumebox" class="hide">
        <h2 class="title">Hand Pick Job</h2>
        <ul>
          <?php while ($row_rsTenLatestJobView = mysql_fetch_object($rsTenLatestJob)) { ?>
            <li>
              <a href="jobsAdsDetails.php?jobAdsId=<?php echo $row_rsTenLatestJobView->ads_id ?>"><?php echo $row_rsTenLatestJobView->ads_title ?></a>
            </li>
          <?php } ?>
        </ul>
      </li>
    </ul>
  </div>
	
	<section id="middle" style="margin-top:30px; display:none;">

		  <div style="float:none; width:100%">              

        <div>
          <h2 class="title rTitle">30 Featured Companies</h2>
          <div class="sidebar_recentjob">
              <?php  

              mysql_select_db($database_conJobsPerak);
              $query_rsHiringThisWeek = "SELECT * FROM jp_employer ORDER BY emp_id DESC LIMIT 0, 36";
              $rsHiringThisWeek = mysql_query($query_rsHiringThisWeek) or die(mysql_error());
              $row_rsHiringThisWeek = mysql_fetch_assoc($rsHiringThisWeek);

              ?>
                  <ul id="emp_pic_front">
                      <?php do { ?>
                        <li>
                        <a href="employer.php?emp_id=<?php echo $row_rsHiringThisWeek['emp_id']; ?>&employer=<?php echo $row_rsHiringThisWeek['emp_name']; ?>"><img src="media/employer/img/<?php echo $row_rsHiringThisWeek['emp_pic']; ?>" width="50px" border="0" class="tipFade" title="<?php echo $row_rsHiringThisWeek['emp_name']; ?>" /></a>
                        </li>
                        <?php } while ($row_rsHiringThisWeek = mysql_fetch_assoc($rsHiringThisWeek)); ?>
                        <div style="clear:both"></div>
                </ul>
          </div><!-- .sidebar_recentjob -->
        </div>

            <div class="browse_jobopening box hide">
            	<a href="jobsOpeningAll.php"> Browse all jobs opening in our portal &raquo;</a></div>
            
				
			  <div class="search_container browse_industry box hide">
			    <h2 class="title icon_archive rTitle">Browse by Industry</h2>
			    <div class="industry_lists">
                	<ul>
                    	<?php do { ?>
                    	  <li><a href="jobsByIndustry.php?ads_industry_id_fk=<?php echo $row_rsIndustry['indus_id']; ?>&industry=<?php echo $row_rsIndustry['indus_name']; ?>"><?php echo $row_rsIndustry['indus_name']; ?></a></li>
                    	  <?php } while ($row_rsIndustry = mysql_fetch_assoc($rsIndustry)); ?>
                          <div class="clear"></div>
                    </ul>
                </div>
                <div style="text-align:right; display:none">
                  <a href="#" data-reveal-id="myModal" id="myButton" title="View All Industries" class="tipFade">View All Industries</a>
                </div>
              </div>
              
              <div class="search_container browse_location box hide">
	      		<h2 class="title icon_pin rTitle">Browse by Location</h2>
			    <div class="location_lists">
                	<ul>
                    	<?php do { ?>
                   	    <li><a href="jobsByLocation.php?ads_location=<?php echo $row_rsLocation['location_id']; ?>&location=<?php echo $row_rsLocation['location_name']; ?>"><?php echo $row_rsLocation['location_name']; ?></a>
                        	<?php
						  
							  /*$parent = $row_rsLocation['location_id'];
							  $sql_child = "SELECT * FROM jp_location WHERE location_parent = $parent";
							  $sql_child_result = mysql_query($sql_child);
							  $sql_child_result_row = mysql_num_rows($sql_child_result);
							  
							  
							  if($sql_child_result_row > 0) {
									
								echo "<ul>";
									
									while($child_object_row = mysql_fetch_object($sql_child_result)){
										echo "<li>" . $child_object_row->location_name . "</li>";
									}
									
								echo "</ul>";
									
							  }*/
							  
							  
							?>
                        	</li>
                    	  <?php } while ($row_rsLocation = mysql_fetch_assoc($rsLocation)); ?>
                          <div class="clear"></div>
                    </ul>
                </div>
              </div>
              
			  <div class="freatured_employer box hide">
			    <h2 class="title">Featured Employer</h2>
			    <div class="featured_emplyed_lists">
                	<ul>
                    	<?php do { ?>
                   	    <li><a href="employer.php?emp_id=<?php echo $row_rs14FeaturedEmployed['emp_id']; ?>&employer=<?php echo $row_rs14FeaturedEmployed['emp_name']; ?>"><?php echo $row_rs14FeaturedEmployed['emp_name']; ?></a></li>
                    	  <?php } while ($row_rs14FeaturedEmployed = mysql_fetch_assoc($rs14FeaturedEmployed)); ?>
                    </ul>
                </div>
              </div>
		    <div class="featured_candidate box hide">
		      <h2 class="title">Featured Candidate</h2>
		      <div class="featured_candidate_list">
               	  <ul>
                   	  <?php do { ?>
                   	    <li><?php echo $row_rs10FeaturedCandidate['users_fname']; ?> <?php echo $row_rs10FeaturedCandidate['users_lname']; ?></li>
                   	    <?php } while ($row_rs10FeaturedCandidate = mysql_fetch_assoc($rs10FeaturedCandidate)); ?>
                  </ul>
              </div>
            </div>
            </div><!-- #content-->
	
		  <aside id="sideRight" class="hide">
          	  <?php include('full_content_sidebar.php'); ?>
          </aside>
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
<script>
$(document).ready(function(){
	$('#search_job').live('click', function(){
		var q = $('#main_q').val();
		
		if(q == ''){
			alert('Fill Job Title / Job Description');
			return false;
		}

	});

  /* modal */
  $('#myButton').click(function(e) {
    e.preventDefault();
    $('#myModal').reveal();
  });


});
</script>
<?php
mysql_free_result($rsLocation);

mysql_free_result($rsIndustry);

mysql_free_result($rsTenLatestJob);

mysql_free_result($rs14FeaturedEmployed);

mysql_free_result($rs10FeaturedCandidate);

mysql_free_result($rsAllindustries);

mysql_free_result($rsTotalJobsOnline);
?>
