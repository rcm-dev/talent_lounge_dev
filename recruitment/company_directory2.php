<?php require_once 'Connections/conJobsPerak.php'; ?>


<?php
//initialize the session
// if ( !isset( $_SESSION ) ) {
//   session_start();
// }

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ( ( isset( $_SERVER['QUERY_STRING'] ) ) && ( $_SERVER['QUERY_STRING'] != "" ) ) {
  $logoutAction .="&". htmlentities( $_SERVER['QUERY_STRING'] );
}

if ( ( isset( $_GET['doLogout'] ) ) &&( $_GET['doLogout']=="true" ) ) {
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  $_SESSION['MM_UserID'] = NULL;
  unset( $_SESSION['MM_Username'] );
  unset( $_SESSION['MM_UserGroup'] );
  unset( $_SESSION['PrevUrl'] );
  unset( $_SESSION['MM_UserID'] );

  $logoutGoTo = "index.php";
  if ( $logoutGoTo ) {
    header( "Location: $logoutGoTo" );
    exit;
  }
}
?>
<?php
//initialize the session
if ( !isset( $_SESSION ) ) {
  //session_start();
}
?>
<?php
if ( !function_exists( "GetSQLValueString" ) ) {
  function GetSQLValueString( $theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "" ) {
    if ( PHP_VERSION < 6 ) {
      $theValue = get_magic_quotes_gpc() ? stripslashes( $theValue ) : $theValue;
    }

    $theValue = function_exists( "mysql_real_escape_string" ) ? mysql_real_escape_string( $theValue ) : mysql_escape_string( $theValue );

    switch ( $theType ) {
    case "text":
      $theValue = ( $theValue != "" ) ? "'" . $theValue . "'" : "NULL";
      break;
    case "long":
    case "int":
      $theValue = ( $theValue != "" ) ? intval( $theValue ) : "NULL";
      break;
    case "double":
      $theValue = ( $theValue != "" ) ? doubleval( $theValue ) : "NULL";
      break;
    case "date":
      $theValue = ( $theValue != "" ) ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ( $theValue != "" ) ? $theDefinedValue : $theNotDefinedValue;
      break;
    }
    return $theValue;
  }
}

$currentPage = $_SERVER["PHP_SELF"];
//*********connect query*************
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
  mysql_real_escape_string(trim(htmlentities(htmlspecialchars($seoname))));

  return $seoname;
}

$get_user_id  = (int) sqlInjectString($_GET['uid']);

$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_last_login As setLastlogin,
  mj_users.usr_email As setemail,
  mj_users.usr_id,
  mj_users.usr_name As currName,
  mj_users.usr_workat As WorkAt,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo,
  mj_users.usr_rating,
  mj_users.usr_core_activity,
  mj_users.mj_sector_fk,
  mj_users.mj_services_fk,
  mj_sector.sec_name,
  mj_services.services_name,
  mj_state.state_name,
  mj_country.country_name
From
  mj_users Inner Join
  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id Inner Join
  mj_country On mj_users.mj_country_id_fk = mj_country.country_id
Where
  mj_users.usr_id = '$get_user_id'";

$rusrSQL = mysql_query($usrSQL);
$rowviewusrSQL = mysql_fetch_object($rusrSQL);

// ==================================================================
//
// HTML Goes here
//
// ---------------------------------------------------------

//*********

mysql_select_db( $database_conJobsPerak, $conJobsPerak );
$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_last_login As setLastlogin,
  mj_users.usr_email As setemail,
  mj_users.usr_id,
  mj_users.usr_name As currName,
  mj_users.usr_workat As WorkAt,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo,
  mj_users.usr_rating,
  mj_users.usr_core_activity,
  mj_users.mj_sector_fk,
  mj_users.mj_services_fk,
  mj_sector.sec_name,
  mj_services.services_name,
  mj_state.state_name,
  mj_country.country_name
From
  mj_users Inner Join
  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id Inner Join
  mj_country On mj_users.mj_country_id_fk = mj_country.country_id
Where
  mj_users.usr_id = '$get_user_id'";

$rusrSQL = mysql_query( $usrSQL );
$rowviewusrSQL = mysql_fetch_object( $rusrSQL );



$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_id,
  mj_users.usr_name As currName,
  mj_users.usr_workat,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo
From
  mj_users
Where
  mj_users.usr_id = '$usr_id'";

$rusrSQL = mysql_query( $usrSQL );
$rowusrSQL = mysql_fetch_object( $rusrSQL );




mysql_select_db( $database_conJobsPerak, $conJobsPerak );
$randProject  = "SELECT
  mj_users.*,
  jp_employer.*,
  jp_industry.*,
  mj_state.*
From
  mj_users Inner Join
  jp_employer On jp_employer.users_id_fk = mj_users.users_id Inner Join
  jp_industry On jp_employer.emp_industry_id_fk = jp_industry.indus_id
  Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id
   Where
  mj_users.usr_lvl = 1 AND jp_employer.emp_featured = 1";

$rrandProject = mysql_query( $randProject );
$row_rrandProject = mysql_fetch_assoc( $rrandProject );
$totalRows_rrandProject = mysql_num_rows( $rrandProject );

mysql_select_db( $database_conJobsPerak, $conJobsPerak );
$query_rsIndustry = "SELECT * FROM jp_industry WHERE industry_parent = 0";
$rsIndustry = mysql_query( $query_rsIndustry, $conJobsPerak ) or die( mysql_error() );
$row_rsIndustry = mysql_fetch_assoc( $rsIndustry );
$totalRows_rsIndustry = mysql_num_rows( $rsIndustry );

mysql_select_db( $database_conJobsPerak, $conJobsPerak );
$query_rsstate = "SELECT * FROM mj_state";
$rsstate = mysql_query( $query_rsstate, $conJobsPerak ) or die( mysql_error() );
$row_rsstate = mysql_fetch_assoc( $rsstate );
$totalRows_rsstate = mysql_num_rows( $rsstate );
//*********




mysql_select_db( $database_conJobsPerak, $conJobsPerak );
$query_rsTenLatestJob = "SELECT ads_id, ads_title FROM jp_ads WHERE ads_enable_view = 1 ORDER BY ads_date_posted DESC";
$rsTenLatestJob = mysql_query( $query_rsTenLatestJob, $conJobsPerak ) or die( mysql_error() );
$row_rsTenLatestJob = mysql_fetch_assoc( $rsTenLatestJob );
$totalRows_rsTenLatestJob = mysql_num_rows( $rsTenLatestJob );

$maxRows_rrandProject = 10;
$pageNum_rrandProject = 0;
if ( isset( $_GET['pageNum_rrandProject'] ) ) {
  $pageNum_rrandProject = $_GET['pageNum_rrandProject'];
}
$startRow_rrandProject = $pageNum_rrandProject * $maxRows_rrandProject;

$colname_rrandProject = "-1";
if ( isset( $_GET['usr_id'] ) ) {
  $colname_rrandProject = $_GET['usr_id'];
}
mysql_select_db( $database_conJobsPerak, $conJobsPerak );
$query_rrandProject = sprintf( "SELECT
  mj_users.*,
  jp_employer.*,
  jp_industry.*,
  mj_state.*

From
  mj_users Inner Join
  jp_employer On jp_employer.users_id_fk = mj_users.users_id Inner Join
  jp_industry On jp_employer.emp_industry_id_fk = jp_industry.indus_id
  Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id

   Where
  mj_users.usr_lvl = 1 AND jp_employer.emp_featured = 1", GetSQLValueString( $colname_rrandProject, "int" ) );
$query_limit_rrandProject = sprintf( "%s LIMIT %d, %d", $query_rrandProject, $startRow_rrandProject, $maxRows_rrandProject );
$rrandProject = mysql_query( $query_limit_rrandProject, $conJobsPerak ) or die( mysql_error() );
$row_rrandProject = mysql_fetch_assoc( $rrandProject );

if ( isset( $_GET['totalRows_rrandProject'] ) ) {
  $totalRows_rrandProject = $_GET['totalRows_rrandProject'];
} else {
  $all_rrandProject = mysql_query( $query_rrandProject );
  $totalRows_rrandProject = mysql_num_rows( $all_rrandProject );
}
$totalPages_rrandProject = ceil( $totalRows_rrandProject/$maxRows_rrandProject )-1;

$queryString_rrandProject = "";
if ( !empty( $_SERVER['QUERY_STRING'] ) ) {
  $params = explode( "&", $_SERVER['QUERY_STRING'] );
  $newParams = array();
  foreach ( $params as $param ) {
    if ( stristr( $param, "pageNum_rrandProject" ) == false &&
      stristr( $param, "totalRows_rrandProject" ) == false ) {
      array_push( $newParams, $param );
    }
  }
  if ( count( $newParams ) != 0 ) {
    $queryString_rrandProject = "&" . htmlentities( implode( "&", $newParams ) );
  }
}
$queryString_rrandProject = sprintf( "&totalRows_rrandProject=%d%s", $totalRows_rrandProject, $queryString_rrandProject );
?>



<style>
.pic{
width:200px;
height:220px;
  }
   </style>


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


    <?php include "main_menu.php"; ?>
  </header><!-- #header-->
  <div id="filterSection">
  <div class="center" style="padding:2px 0px">
    <div style="padding-left: 8px;">
      <form action="showcase.php" method="get">
        <table>
          <tr>
            <td>Filter by Industry</td>
            <td>
              <select name="industry" id="industry">
                <option value="0">All Indstries</option>
              </select>
            </td>
            <td>Profession</td>
            <td>
              <select name="profession" id="profession">
                <option value="0">All Professions</option>
              </select>
            </td>
            <td>Location</td>
            <td>
              <select name="location" id="locatio">
                <option value="0">All Locations</option>
              </select>
            </td>
            <td>Categories</td>
            <td>
              <select name="Categories" id="Categories">
                <option value="0">All Categories</option>
              </select>
            </td>
            <td>Keyword</td>
            <td>
              <input type="text" name="q">
            </td>
            <td>
              <input type="submit">
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>

<div class="companySection">
  <div id="wrapper" style="padding:30px 0px;">

  <section id="middle">

      <div id="content_full" style="margin:0px;">




              <h2>where you would like to develop your career?</h2>

              <div id="searchTradingHub">
                                    <form action="employerBrowseResumeResult.php" method="get" name="groupFiltering">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                            <tr>
                                                <td align="center">
                                                    <strong>Industry :</strong>
                                                </td>
                                                <td width="370px">
                                                    <select name="industry" class="query_company" id="query_company">
                                                        <option value="0">
                                                            Category
                                                        </option><?php
                                                            do {  
                                                              ?>
                                                        <option value="<?php echo $row_rsIndustry['indus_id']?>">
                                                            <?php echo $row_rsIndustry['indus_name']?>
                                                        </option><?php
                                                              } while ($row_rsIndustry = mysql_fetch_assoc($rsIndustry));
                                                              $rows = mysql_num_rows($rsIndustry);
                                                              if($rows > 0) {
                                                              mysql_data_seek($rsIndustry, 0);
                                                              $row_rsIndustry = mysql_fetch_assoc($rsIndustry);
                                                              }
                                                              ?>
                                                    </select>
                                                </td>
                                                <td align="center" width="80px">
                                                    <strong>State :</strong>
                                                </td>
                                                <td width="150px">
                                                    <select name="state" class="query_stat" id="query_stat">
                                                        <option value="0">
                                                            State
                                                        </option><?php
                                                            do {  
                                                             ?>
                                                        <option value="<?php echo $row_rsstate['state_id']?>">
                                                            <?php echo $row_rsstate['state_name']?>
                                                        </option><?php
                                                             } while ($row_rsstate = mysql_fetch_assoc($rsstate));
                                                          $rows = mysql_num_rows($rsstate);
                                                          if($rows > 0) {
                                                              mysql_data_seek($rsstate, 0);
                                                            $row_rsstate = mysql_fetch_assoc($rsstate);
                                                          }
                                                             ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input name="submitGeneral" type="submit" id="Check" value="Search">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                  </div>

              <div class="topTableCaption1"></div>
              <div class="topTableCaption">
                <?php  $norandProject = mysql_num_rows($rrandProject);

                                if ($norandProject == 0) {

                                echo "No project.";

                                } else { 

                                ?>
    <ul id="job-cards">
    <?php do { ?>
      <li>
        <div>
          <div class="pic">
            <div class="glossy-pic"></div>
            <img src="media/employer/img/<?php echo $row_rrandProject['user_pic']; ?>" alt="<?php echo ucfirst( $row_rrandProject['usr_name'] ) ?>">
          </div>
          <div class="jobs-close">
            <strong><?php echo ucfirst( $row_rrandProject['emp_web'] ); ?></strong>
          </div>
        </div>
        <div class="job-title">
          <h3><strong><?php echo ucfirst( $row_rrandProject['emp_name'] ) ?></strong></h3>
                  </div>
        <div class="job-title" style="border-top:1px solid #eaeaea">
          <table style="color:#7d7d7d; font-size:11px;" width="100%">
            <tr>
              <td><?php echo ucfirst( $row_rrandProject['indus_name'] ) ?></td>
              <td align="right"><?php echo $row_rrandProject['state_name'] ?></td>
            </tr>
            <tr>
              <td colspan="0" align="">
                <br>
                <a href="employer.php?emp_id=<?php echo $row_rrandProject['emp_id'] ?>" class="tl-btn-blue">View Profle!</a>
              </td>
               <td colspan="0" align="">
                <br>
<!-- 
                <a href="#" id="send-request-friend" class="tl-btn-red">
                 Connect <?php echo $rowviewusrSQL->currName; ?>
                  </a>
                  <input type="hidden" name="getviewuserid" id="getviewuserid" value="<?php echo $get_user_id; ?>">

                  <input type="hidden" name="currUsrId" id="currUsrId" value="<?php echo $usr_id; ?>">
 -->
      <div style="padding:10px; !important; background-color:#f4f4f4; text-align:right;">
      
     
        <div id="followFriendBtn" style="border:0px solid red; float: right;">
        <?php  

              // ==================================================================
              //
              // Displayuser profile
              //
              // ------------------------------------------------------------------
              
              $qAlreadyFriend = "SELECT
                mj_usr_network.usr_network_friend_usr_id_fk,
                mj_usr_network.usr_network_usr_id_fk,
                mj_usr_network.usr_network_friend_usr_id_fk As isFriend,
                mj_usr_network.usr_network_approved As isFriendStatus
              From
                mj_usr_network
              Where
                mj_usr_network.usr_network_usr_id_fk = '$usr_id' And
                mj_usr_network.usr_network_friend_usr_id_fk = '$get_user_id'";
              
              $resultAlreadyFriend = mysql_query($qAlreadyFriend);
              $rowAlreadyFriend = mysql_fetch_object($resultAlreadyFriend);

              $numrowAlreadyFriend = mysql_num_rows($resultAlreadyFriend);
              

              if ($numrowAlreadyFriend == 1) { ?>
              
                <?php 

                $isFriend = $rowAlreadyFriend->isFriend; 

                if ($isFriend == $usr_id) { ?>

                  

                <?php } else { ?>
                  
                  <?php if ($rowAlreadyFriend->isFriendStatus == 0) { ?>

                    Followed
                    
                  <?php } else { ?>

                    Waiting for Approved

                  <?php } ?>
                  
                <?php } ?>


              <?php } else { ?>


                
                  
                  <a href="#" id="send-request-friend" >
                  Follow <?php echo $rowviewusrSQL->currName; ?>
                  </a>
                  <input type="hidden" name="getviewuserid" id="getviewuserid" value="<?php echo $get_user_id; ?>">

                  <input type="hidden" name="currUsrId" id="currUsrId" value="<?php echo $usr_id; ?>">
                  
              
              <?php } ?>
          </div>
          
      </div><!-- / -->

              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div>
      </li>
      <?php } while ( $row_rrandProject = mysql_fetch_assoc( $rrandProject ) ); ?>
  </ul>
              <div class="paginate"><a href="<?php printf( "%s?pageNum_rrandProject=%d%s", $currentPage, 0, $queryString_rrandProject ); ?>">First</a> | <a href="<?php printf( "%s?pageNum_rrandProject=%d%s", $currentPage, max( 0, $pageNum_rrandProject - 1 ), $queryString_rrandProject ); ?>">Previous</a> | <a href="<?php printf( "%s?pageNum_rrandProject=%d%s", $currentPage, min( $totalPages_rrandProject, $pageNum_rrandProject + 1 ), $queryString_rrandProject ); ?>">Next</a> | <a href="<?php printf( "%s?pageNum_rrandProject=%d%s", $currentPage, $totalPages_rrandProject, $queryString_rrandProject ); ?>">Last</a></div>
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
      <?php include "footer.php"; ?>
    </div>
  </footer>


<script type="text/javascript">
$(document).ready(function(){


    $('#Check').click(function(){
    $('#topTableCaption').hide();    

    var catID = $('#query_company').val();
    var stateID = $('#query_stat').val();


    var dataString = 'catID='+catID+'&stateID=' + stateID;

    console.log(dataString);


    $('#topTableCaption1').html('loading....').fadeIn().load('ajaxDirList.php?'+dataString);

    return false;




    }); 



  /* request friends */
  $('#send-request-friend').click(function(){
    
    var getuserviewid = $('#getviewuserid').val();
    var currUsrId   = $('#currUsrId').val();

    $.ajax({
        
      type: "POST",
      url: "ajax/friend-requested.php",
      data: 'getuserviewid=' + getuserviewid + '&currUsrId=' + currUsrId,
      cache: false,

      success: function(html){

        var url_to_load = 'users.php?uid=';
        //$('#followFriendBtn').load(url_to_load+getuserviewid+ ' #followFriendBtn');
        $('#send-request-friend').hide();
        $('#followFriendBtn').fadeIn('slow').append(html);
        //console.log(url_to_load + 'DONE');
        
      }

    });

  });
   

/* Edit profile fancy box */
    $('#editProfile').fancybox({
        'titlePosition'   : 'inside',

        'transitionIn'    : 'none',

        'transitionOut'   : 'none',

        'type'              : 'iframe'
      });



    /* Register */
    $("#iregister").fancybox({


        'autoScale'         : false,

        'height'            : '70%',

        'transitionIn'      : 'none',

        'transitionOut'     : 'none',

        'titlePosition'   : 'none',

        'type'              : 'iframe'

    });


    /* login */
    $("#ilogin").fancybox({

        'height'            : '70%',

        'autoScale'         : true,

        'transitionIn'      : 'none',

        'transitionOut'     : 'none',

        'titlePosition'   : 'none',

        'type'              : 'iframe'

    });


    /* public figure */
    $('.public').fancybox({

        'height'            : '70%',

        'autoScale'         : true,

        'transitionIn'      : 'none',

        'transitionOut'     : 'none',

        'titlePosition'   : 'none',

        'type'              : 'iframe'

    });


});
</script>

</body>
</html>
<?php
mysql_free_result( $rsTenLatestJob );

mysql_free_result( $rrandProject );
?>


