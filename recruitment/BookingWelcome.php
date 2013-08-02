<?php require_once('Connections/conJobsPerak.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

$userID = $_SESSION['MM_UserID'];

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


mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_bookingResult = "SELECT time_detail.time_name As currTime,
status_booking.booking_room_type as roomType,

 status_booking. * ,
mj_users . * 
FROM status_booking
INNER JOIN time_detail ON status_booking.time_booking = time_detail.time_id
INNER JOIN mj_users ON status_booking.employer_id_fk = mj_users.usr_id
  Where
  -- jp_users.users_type = 1 And
    status_booking.date_booking = '$date' And
    
    status_booking.booking_room_type ='$room' AND
    status_booking.time_booking = '$time'";

$colname_rsStatus = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsStatus = $_SESSION['MM_UserID'];
}

$resultbookingResult= mysql_query($query_bookingResult);
$rowbookingResult= mysql_fetch_object($resultbookingResult);

$query_rsStatus = sprintf("SELECT time_detail.time_name AS currTime,
       room.room_type_name AS roomType,
       status_booking. * ,
                       mj_users . * ,
                                  room.*,
                                  jp_employer.*
FROM status_booking
INNER JOIN time_detail ON status_booking.time_booking = time_detail.time_id
INNER JOIN room ON status_booking.booking_room_type =room.room_id
INNER JOIN mj_users ON status_booking.employer_id_fk = mj_users.usr_id
INNER JOIN jp_employer ON users_id_fk = mj_users.usr_id
WHERE status_booking.employer_id_fk = %s", GetSQLValueString($colname_rsStatus, "int"));
$rsStatus = mysql_query($query_rsStatus, $conJobsPerak) or die(mysql_error());
$row_rsStatus = mysql_fetch_assoc($rsStatus);
$totalRows_rsStatus = mysql_num_rows($rsStatus);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <title>Welcome to talent lounge</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <script language="javascript" src="js/jquery-1.7.1.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
  <!-- <link rel="stylesheet" href="/resources/demos/style.css" /> -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection" />
<style type="text/css">
#wrapper #middle #content .master_details h1 {
  color: #F00;
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

      <div id="content_full" style="margin:30px 0px;">
    <h2>Employer Dashboard</h2>

    <div class="master_details_full">
      <p>Welcome <?php echo $_SESSION['MM_Username']; ?> <?php //echo $_SESSION['MM_UserID']; ?> | <a href="<?php echo $logoutAction ?>">Log Out</a></p>

    <?php if ($row_rsIsActive['user_active'] != 0){ ?>

<?php include("employer_menu.php"); ?>

<?php } else { ?>
<span style="color:#FF0000">Please Activate your account. Check your mail or <a href="resent-activation.php?mail=<?php echo $_SESSION['MM_Username']; ?>">resend activation link</a>.</span>
      <?php } ?>

    <br>
    <h2>Current Booking</h2>
<?php if ($totalRows_rsStatus > 0) { // Show if recordset not empty ?>
  <table width="100%" border="0" cellpadding="2" cellspacing="2" class="csstable2">
    <tr>
      <th>Company</th>
      <th>Date</th>
      <th>Time</th>
      <th>Room</th>
      <th>No of Participant</th>
      <th>Status</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rsStatus['emp_name']; ?></td>
        <td align="center" valign="middle"><?php echo date('l, F d, Y',strtotime($row_rsStatus['date_booking'])); ?></td>
        <td align="center" valign="middle"><?php echo $row_rsStatus['currTime']; ?></td>
        <td align="center" valign="middle"><?php echo $row_rsStatus['roomType']; ?></td>
        <td align="center" valign="middle"><?php echo $row_rsStatus['no_of_part']; ?></td>
        <td align="center" valign="middle"><?php if ($row_rsStatus['status']==0){echo '<span style="color:#d1d1d1;">Pending</span>';}else{echo '<span style="color:green; font-weight:bold">Booked</span>';}?></td>
      </tr>
      <?php } while ($row_rsStatus = mysql_fetch_assoc($rsStatus)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
  <br/>
  <hr>
  <br>

    <h2>Check Availability</h2>

       

                        <!-- <div class="control-group">
                <p>Date: <input type="text" id="datepicker" /></p> -->

                       <div class="control-group">
                 <label class="control-label" name="dateCheck" id="dateCheck">Date:</label>
                             <div class="controls">
               <input type="text" id="datepicker" />
                             </div>
                        </div>

                        <div>
                          <label for="No of Participant">No of Participant:</label>
                          <div>
                            <select name="no_of_part" id="no_of_part" style="width:200px">
                              <?php for ($i=1; $i < 16; $i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>

                        <div class="control-group">
                             <label class="control-label">Time:</label>
                             <div class="controls">
                               
                                <label for="time"></label>
                                  <select name="timeCheck" id="timeCheck" style="width:200px">
              <option value="0">Select time</option>
              <?php  

              $qsec           = "SELECT
                        time_detail.time_id As timeID,
                        time_detail.time_name As timeName
                      From
                        time_detail";
              $resultsec      = mysql_query($qsec);

              while ($rowsec  = mysql_fetch_object($resultsec)) { ?>
                


                <option value="<?php echo $rowsec->timeID; ?>"<? if($rowbookingResult->currTime == $rowsec->timeName){ 
                  echo "selected=\"selected\"";
                    } ?>>
                     <?php echo ucwords($rowsec->timeName); ?></option>; ?>
                    
              <?php } ?>
            </select> </div>
        </div>
                        <div class="control-group">
<label class="control-label">Room:</label>
                             <div class="controls">
                              
                                <label for="time"></label>
                                  <select name="room" id="room" style="width:200px">
              <option value="0">Select room</option>
              <?php  

              $qroom           = "SELECT
                        room.room_id As roomID,
                        room.room_type_name As roomName
                      From
                        room";
              $resultroom      = mysql_query($qroom);

              while ($rowroom  = mysql_fetch_object($resultroom)) { ?>
                


                <option value="<?php echo $rowroom->roomID; ?>"<? if($rowbookingResult->roomType == $rowroom->roomName){ 
                  echo "selected=\"selected\"";
                    } ?>>
                     <?php echo ucwords($rowroom->roomName); ?></option>; ?>
                    
              <?php } ?>
            </select>
          </div>
        </div>
                                 <div class="control-group">
                            <label class="control-label"></label>
                             <div class="controls">
                              <br>
                               <button type="submit" id="Check" class="button green" name="Check">Check Availability</button>
                               
                               <input type="hidden" name="uid" id="uid" value="<?php echo $usr_id ?>">
                             </div>
                        </div>
            <!-- </form> -->
            <div id="searchResult" class="">
          
        </div><!-- /searchResult -->




    </div>
  </div>
</section>
</div>

<footer id="footer">
  <div class="center">
    <?php include("footer-booking.php"); ?>
  </div><!-- .center -->
</footer><!-- #footer -->

<script>
   $(document).ready(function(){
        $('#datepicker').datepicker({ 
                        minDate: 0, 
                        dateFormat: "yy-mm-dd",
                        showOn: "button",
                        buttonImage: "../images/calendar.gif",
                        buttonImageOnly: true
                });

        var DatePicked = function() {
                        var date = $("#datepicker");
                        var time = $("#time");
                        var room =$("#room");
                        // var nights = $("#nights");

                        var triggeringElement = $(this);

                        var dateDate = date.datepicker("getDate");
                        

                       

                       

                }

        $(function() {
                $("#date, #arrival").datepicker({
                        onSelect: DatePicked,
                        dateFormat: "yy-mm-dd", 
                        showOn: "button",
                        buttonImage: "../images/calendar.gif",
                        buttonImageOnly: true
                });
                $("#nights").change(DatePicked);
                DatePicked();
        });  
        /* get current email */
  var current_email = $('input#current_email').val();

  if (current_email == '') {
    $('body').css('display', 'none');
    document.location.href = "index.php";
    console.log('Not Login');
  }
  else {
    console.log("Current Email => "+current_email);
  }
  /* /current email */

  // Search date
  $('#Check').click(function(){
    
    //alert('click');

    // get val()
    var dateIn        = $('#datepicker').val();
    var timeCheck     = $('#timeCheck').val();
    var room          = $('#room').val();
    var uid           = $('input#uid').val();
    var no_of_part    = $('#no_of_part').val();
    


    if (dateIn == '') {
      
      // alert
      $.jnotify("Select your date.", "error");

    } else {
    

      // dataString
      var dataString = 'dateIn='+dateIn+'&timeCheck=' + timeCheck + '&uid=' + uid+ '&room=' + room + '&no_of_part=' + no_of_part;
      
      console.log(dataString);


      $('#searchResult').html('loading....').fadeIn().load('../ajax/ajax-check-available.php?'+dataString);
      
      return false;


    }
    
    //console.log(searchsector+' - '+searchProduct+' - '+searchnetworkarea);
   

    return false;

  });    
    });
  </script>

</body>
</html>