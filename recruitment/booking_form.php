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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE jp_employer SET emp_name=%s, emp_desc=%s, emp_industry_id_fk=%s, emp_address=%s, emp_tel=%s, emp_email=%s, emp_web=%s, emp_featured=%s, users_id_fk=%s WHERE emp_id=%s",
                       GetSQLValueString($_POST['emp_name'], "text"),
                       GetSQLValueString($_POST['emp_desc'], "text"),
                       GetSQLValueString($_POST['emp_industry_id_fk'], "int"),
                       GetSQLValueString($_POST['emp_address'], "text"),
                       GetSQLValueString($_POST['emp_tel'], "text"),
                       GetSQLValueString($_POST['emp_email'], "text"),
                       GetSQLValueString($_POST['emp_web'], "text"),
                       GetSQLValueString($_POST['emp_featured'], "int"),
                       GetSQLValueString($_POST['users_id_fk'], "int"),
                       GetSQLValueString($_POST['emp_id'], "int"));

  mysql_select_db($database_conJobsPerak, $conJobsPerak);
  $Result1 = mysql_query($updateSQL, $conJobsPerak) or die(mysql_error());

  $updateGoTo = "employerDashboard.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE mj_users SET users_fname=%s, users_lname=%s WHERE users_id=%s",
                       GetSQLValueString($_POST['users_fname'], "text"),
                       GetSQLValueString($_POST['users_lname'], "text"),
                       GetSQLValueString($_POST['users_id'], "int"));

  mysql_select_db($database_conJobsPerak, $conJobsPerak);
  $Result1 = mysql_query($updateSQL, $conJobsPerak) or die(mysql_error());

  $updateGoTo = "employerDashboard.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsEmployerProfile = "-1";
if (isset($_GET['cuid'])) {
  $colname_rsEmployerProfile = $_GET['cuid'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsEmployerProfile = sprintf("SELECT * FROM mj_users WHERE users_id = %s", GetSQLValueString($colname_rsEmployerProfile, "int"));
$rsEmployerProfile = mysql_query($query_rsEmployerProfile, $conJobsPerak) or die(mysql_error());
$row_rsEmployerProfile = mysql_fetch_assoc($rsEmployerProfile);
$totalRows_rsEmployerProfile = mysql_num_rows($rsEmployerProfile);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsIndustry = "SELECT * FROM jp_industry WHERE industry_parent = 0";
$rsIndustry = mysql_query($query_rsIndustry, $conJobsPerak) or die(mysql_error());
$row_rsIndustry = mysql_fetch_assoc($rsIndustry);
$totalRows_rsIndustry = mysql_num_rows($rsIndustry);

$colname_rsCompanyInfoDetail = "-1";
if (isset($_GET['cuid'])) {
  $colname_rsCompanyInfoDetail = $_GET['cuid'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsCompanyInfoDetail = sprintf("SELECT * FROM jp_employer WHERE users_id_fk = %s", GetSQLValueString($colname_rsCompanyInfoDetail, "int"));
$rsCompanyInfoDetail = mysql_query($query_rsCompanyInfoDetail, $conJobsPerak) or die(mysql_error());
$row_rsCompanyInfoDetail = mysql_fetch_assoc($rsCompanyInfoDetail);
$totalRows_rsCompanyInfoDetail = mysql_num_rows($rsCompanyInfoDetail);


$colname_rsUserDetail = "-1";
if (isset($_GET['uid'])) {
  $colname_rsUserDetail = $_GET['uid'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserDetail = sprintf("SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_last_login As setLastlogin,
  mj_users.usr_email As setemail,
  mj_users.usr_id As currID,
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
  WHERE mj_users.usr_id = %s", GetSQLValueString($colname_rsUserDetail, "int"));
$rsUserDetail = mysql_query($query_rsUserDetail, $conJobsPerak) or die(mysql_error());
$row_rsUserDetail = mysql_fetch_object($rsUserDetail);
$totalRows_rsUserDetail = mysql_num_rows($rsUserDetail);




$query_rsbooking = "SELECT time_detail.time_name As currTime,
 room.room_type_name As currRoom, 
 jp_employer.emp_name As currName,
 status_booking. * ,
jp_employer . * 
FROM status_booking
INNER JOIN room ON status_booking.booking_room_type = room.room_id
INNER JOIN time_detail ON status_booking.time_booking = time_detail.time_id
INNER JOIN jp_employer ON status_booking.employer_id_fk = jp_employer.emp_id
  Where
  -- jp_users.users_type = 1 And
    status_booking.date_booking = '$date' And
    status_booking.booking_room_type ='$room' And
    status_booking.time_booking = '$time'";

 
$rsbooking             = mysql_query($query_rsbooking) or die(mysql_error());
$row_rsbooking         = mysql_fetch_object($rsbooking);
$totalRows_rsbooking   = mysql_num_rows($rsbooking);



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
  mysql_real_escape_string(trim(htmlentities(htmlspecialchars($seoname))));

  return $seoname;



}
 // $dateIn = $_POST['dateIn'];



  $dateIn                    = mysql_real_escape_string(@$_GET['dateIn']);       
  $dbook = $_GET['dbook'];   
  $rbook = $_GET['rbook'];



 ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <title>Welcome to talent lounge</title>
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
 <h1 class="heading_title bebasTitle">Interview Room Booking Form</h1>
<div class="master_details_full">
  <p>Welcome <?php echo $_SESSION['MM_Username']; ?> <?php //echo $_SESSION['MM_UserID']; ?> | <a href="<?php echo $logoutAction ?>">Log Out</a></p>
  <?php include("employer_menu.php"); ?><br/>
  
          <br/>
            <!-- <h1 class="heading_title bebasTitle">Booking Form</h1> -->
      

        <div class="cnscontainer">
         
        

                
              <FIELDSET>
            <LEGEND><b>Time and Room</b></LEGEND>
            <div id ="room1">
           
         
         <label for="curr_username"><br />
         </label>
         <table width="355" border="0">
           <tr>
             <td width="129">Date</td>
             <td width="14">:</td>
             <td width="198">
               <?php echo $dbook; ?>
             </td>
           </tr>
           <tr>
             <td>Time</td>
             <td>:</td>
             <td>
              <?php 
              $get_time  = (int) sqlInjectString($_GET['tbook']);

                $qsec  = "SELECT
                        time_detail.time_id As timeID,
                        time_detail.time_name As timeName
                      From
                        time_detail
                      Where
                      time_detail.time_id = '$get_time'";

              $resultsec      = mysql_query($qsec);
              $rowsec  = mysql_fetch_object($resultsec);

 ?>
          <?php echo $rowsec->timeName; ?></td>
           </tr>
           <tr>
             <td>Room Name</td>
             <td>:</td>
             <td>  <?php 
              $get_room  = (int) sqlInjectString($_GET['rbook']);

                $qroom  = "SELECT
                        room.room_id As roomID,
                        room.room_type_name As roomName
                      From
                        room
                      Where
                      room.room_id = '$get_room'";

              $resultroom      = mysql_query($qroom);
              $rowroom  = mysql_fetch_object($resultroom);

 ?>
          <?php echo $rowroom->roomName; ?></td>
           </tr>
           <tr>
             <td>
               No of Participant
             </td>
             <td>:</td>
             <td>
               <?php echo htmlentities($_GET['no_of_part']); ?>
             </td>
           </tr>
         </table>
         <br/><br/>
             </div>
             </FIELDSET>
              
                <br/><br/><FIELDSET>
            <LEGEND><b>Organization Detail</b></LEGEND>
                 <div id = "room1">

                <table width="357" border="0">
                  <tr>
                    <td width="129">Organization Name</td>
                    <td width="15">:</td>
                    <td width="199"><?php echo $row_rsUserDetail->WorkAt; ?></td>
                  </tr>
                  <tr>
                    <td>Description of the organization</td>
                    <td>:</td>
                    <td><?php echo $row_rsUserDetail->CurGenInfo; ?></td>
                  </tr>
                </table></div></FIELDSET>
                 <br/><br/>
<FIELDSET>
            <LEGEND><b>Contact Detail</b> </LEGEND>
         
           <div id = "room1">

          <table width="358" border="0">
            <tr>
              <td width="129"><label for="curr_username3">Name</label></td>
              <td width="15">:</td>
              <td width="200"><?php echo $row_rsUserDetail->currName; ?></td>
            </tr>
            <tr>
              <td>Address</td>
              <td>:</td>
              <td><?php echo $row_rsUserDetail->currCountry; ?></td>
            </tr>
            <tr>
              <td>Telephone No</td>
              <td>:</td>
              <td><?php echo $row_rsUserDetail->currPhoneNo; ?></td>
            </tr>
            <tr>
              <td>Mobile</td>
              <td>:</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>:</td>
              <td><?php echo $row_rsUserDetail->setemail; ?></td>
            </tr>
          </table>
        </div>
</FIELDSET>
           <br/>
           <div align ="center">
            <form action="booking.php" method="POST" id="storeDataBooking">
              <input type="hidden" name="dbook" value="<?php echo $_GET['dbook'] ?>">
              <input type="hidden" name="tbook" value="<?php echo $_GET['tbook'] ?>">
              <input type="hidden" name="rbook" value="<?php echo $_GET['rbook'] ?>">
              <input type="hidden" name="uid" value="<?php echo $_GET['uid'] ?>">
              <input type="hidden" name="no_of_part" value="<?php echo $_GET['no_of_part'] ?>">
              <strong>Some Notes:</strong>
              <textarea name="note" id="note" cols="10" rows="5"></textarea>
             <div class ="center1">
              <input name="bookingInfo" id="bookingInfo" type="submit" value="Book My Interview" class="button green" />
          </div>
            </form>
           <br/>
         </div>
     
        </div><!-- /span9 -->

        </div><!-- /orange left -->

          </div><!-- /contentContainer -->

  </section><!-- #middle-->
       

        <div class="clear"></div>


   

<!-- get current email -->
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />
<!-- /get current email -->


</section><!-- #middle-->

  </div><!-- #wrapper-->

  <footer id="footer">
    <div class="center">
      <?php include("footer.php"); ?>
    </div><!-- .center -->
  </footer><!-- #footer -->



</body>
<script type="text/javascript">

    $(document).ready(function(){
       



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

  $('select#room').change(function(){

    var roomName = $(this).val();

    $('span#roomBook').text(roomName);
    $('input#roomBookForm').val(roomName);
    // console.log('change ' + roomName);    

  });


    });


</script>
</html>

