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
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE jp_jobseeker SET jobseeker_tel=%s, jobseeker_mobile=%s, jobseeker_address=%s, jobseeker_address_poscode=%s, jobseeker_address_state=%s, jobseeker_address_district=%s, jobseeker_address_subdistrict=%s, jobseeker_dob_y=%s, jobseeker_dob_m=%s, jobseeker_dob_d=%s, jobseeker_gender=%s, marital_status=%s, jobseeker_nationality=%s, jobseeker_moreinfo=%s, employment_status=%s, jobseeker_last_edited=%s WHERE users_id_fk=%s",
                       GetSQLValueString($_POST['jobseeker_tel'], "text"),
                       GetSQLValueString($_POST['jobseeker_mobile'], "text"),
                       GetSQLValueString($_POST['jobseeker_address'], "text"),
                       GetSQLValueString($_POST['poscode'], "text"),
                       GetSQLValueString($_POST['main_state'], "text"),
                       GetSQLValueString($_POST['district'], "int"),
                       GetSQLValueString($_POST['subdistrict'], "int"),
                       GetSQLValueString($_POST['jobseeker_dob_y'], "int"),
                       GetSQLValueString($_POST['jobseeker_dob_m'], "int"),
                       GetSQLValueString($_POST['jobseeker_dob_d'], "int"),
                       GetSQLValueString($_POST['jobseeker_gender'], "int"),
                       GetSQLValueString($_POST['marital_status'], "text"),
                       GetSQLValueString($_POST['jobseeker_nationality'], "int"),
                       GetSQLValueString($_POST['jobseeker_moreinfo'], "text"),
                       GetSQLValueString($_POST['employment_status'], "text"),
                       GetSQLValueString($_POST['jobseeker_last_edited'], "date"),
                       GetSQLValueString($_POST['users_id_fk'], "int"));

  mysql_select_db($database_conJobsPerak, $conJobsPerak);
  $Result1 = mysql_query($updateSQL, $conJobsPerak) or die(mysql_error());

  $updateGoTo = "jobSeekerDashboard.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsNationality = "SELECT * FROM jp_nationality";
$rsNationality = mysql_query($query_rsNationality, $conJobsPerak) or die(mysql_error());
$row_rsNationality = mysql_fetch_assoc($rsNationality);
$totalRows_rsNationality = mysql_num_rows($rsNationality);

$colname_rsUpdateJobSeeker = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsUpdateJobSeeker = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUpdateJobSeeker = sprintf("SELECT * FROM jp_jobseeker WHERE users_id_fk = %s", GetSQLValueString($colname_rsUpdateJobSeeker, "int"));
$rsUpdateJobSeeker = mysql_query($query_rsUpdateJobSeeker, $conJobsPerak) or die(mysql_error());
$row_rsUpdateJobSeeker = mysql_fetch_assoc($rsUpdateJobSeeker);
$totalRows_rsUpdateJobSeeker = mysql_num_rows($rsUpdateJobSeeker);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsStatelist = "SELECT * FROM jp_location WHERE location_parent = 0";
$rsStatelist = mysql_query($query_rsStatelist, $conJobsPerak) or die(mysql_error());
$row_rsStatelist = mysql_fetch_assoc($rsStatelist);
$totalRows_rsStatelist = mysql_num_rows($rsStatelist);
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
  <script src="scripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
</head>

<body>
<script type="text/javascript">
// BeginOAWidget_Instance_2204022: #postContent

  tinyMCE.init({
    // General options
    mode : "exact",
    elements : "postContent",
    theme : "advanced",
    skin : "default",
    content_css : "css/custom_content.css",
theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
font_size_style_values : "10px,12px,13px,14px,16px,18px,20px",
    plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

    // Theme options
    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,|,link,unlink,anchor,",
    theme_advanced_buttons2 : "",
    theme_advanced_buttons3 : "",
    theme_advanced_buttons4 : "",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "none",
    theme_advanced_resizing : false,

    // Example content CSS (should be your site CSS)
    content_css : "/css/editor_styles.css",

    // Drop lists for link/image/media/template dialogs, You shouldn't need to touch this
    template_external_list_url : "/lists/template_list.js",
    external_link_list_url : "/lists/link_list.js",
    external_image_list_url : "/lists/image_list.js",
    media_external_list_url : "/lists/media_list.js",

    // Style formats: You must add here all the inline styles and css classes exposed to the end user in the styles menus
    style_formats : [
      {title : 'Bold text', inline : 'b'},
      {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
      {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
      {title : 'Example 1', inline : 'span', classes : 'example1'},
      {title : 'Example 2', inline : 'span', classes : 'example2'},
      {title : 'Table styles'},
      {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
    ]
  });
    
// EndOAWidget_Instance_2204022
</script>


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

    <div id="container" class="full">
      <div id="content_full">
<h2>Update Particular</h2>
<div class="master_details">
  
  <div class="master_details">
    <table>
      <tr>
        <td>
          <img src="../images/flat/64/document.png" alt="Gear">
        </td>
        <td>
          <h3>Edit Particular Profile</h3>
        </td>
      </tr>
    </table>
  </div>
  <form action="<?php echo $editFormAction; ?>" method="POST" name="form1">
    <table width="600" align="center">
      <tr valign="baseline">
        <td nowrap align="right">Telephone:</td>
        <td><input type="text" name="jobseeker_tel" value="<?php echo $row_rsUpdateJobSeeker['jobseeker_tel']; ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Mobile Phone</td>
        <td><input type="text" name="jobseeker_mobile" value="<?php echo $row_rsUpdateJobSeeker['jobseeker_mobile']; ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="middle" nowrap>Address</td>
        <td><textarea name="jobseeker_address" cols="50" rows="5"><?php echo $row_rsUpdateJobSeeker['jobseeker_address']; ?></textarea></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Poscode</td>
        <td><input name="poscode" type="text" id="poscode" size="32" value="<?php echo $row_rsUpdateJobSeeker['jobseeker_address_poscode']; ?>"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">State</td>
        <td><select name="main_state" id="main_state" class="date">
          <?php
do {  
?>
          <option value="<?php echo $row_rsStatelist['location_id']?>" <?php if ($row_rsUpdateJobSeeker['jobseeker_address_state'] == $row_rsStatelist['location_id']) {
                      echo "selected=\"selected\"";
                    } ?>><?php echo $row_rsStatelist['location_name']?></option>
          <?php
} while ($row_rsStatelist = mysql_fetch_assoc($rsStatelist));
  $rows = mysql_num_rows($rsStatelist);
  if($rows > 0) {
      mysql_data_seek($rsStatelist, 0);
    $row_rsStatelist = mysql_fetch_assoc($rsStatelist);
  }
?>
        </select></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">District</td>
        <td>
          <select name="district" id="district" class="date">
            <?php  

            if ($row_rsUpdateJobSeeker['jobseeker_address_district'] != NULL || $row_rsUpdateJobSeeker['jobseeker_address_district'] != 0) {

            /**
             *
             * Record Set for districlist
             * Retrieve via object 
             * 
             */
            $query_districlist     = "SELECT * FROM jp_district WHERE dist_parent_fk = " . $row_rsUpdateJobSeeker['jobseeker_address_state'];
            $rs_districlist        = mysql_query($query_districlist) or die(mysql_error());
            $totalRows_districlist = mysql_num_rows($rs_districlist);
            
            while ($row_districlist= mysql_fetch_object($rs_districlist)) {
                echo "<option ";

                if ($row_rsUpdateJobSeeker['jobseeker_address_district'] == $row_districlist->dist_id) {
                  echo "selected=\"selected\"";
                }
                echo 'value="'.$row_districlist->dist_id.'"';
                echo ">";
                echo ucwords(strtolower($row_districlist->dist_name));
                echo "</option>";

              }

            } else { 
              echo "<option value=\"NULL\">District</option>";
            }

            ?>
          </select>
        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">SubDistrict</td>
        <td>
          <select name="subdistrict" id="subdistrict" class="date">
            <?php  


            if ($row_rsUpdateJobSeeker['jobseeker_address_district'] != NULL || $row_rsUpdateJobSeeker['jobseeker_address_district'] != 0) {

            /**
             *
             * Record Set for subdist_list
             * Retrieve via object 
             * 
             */
            $query_subdist_list     = "SELECT * FROM jp_subdistrict WHERE district_id_fk = ".$row_rsUpdateJobSeeker['jobseeker_address_district'];
            $rs_subdist_list        = mysql_query($query_subdist_list) or die(mysql_error());
            $totalRows_subdist_list = mysql_num_rows($rs_subdist_list);
            
              while ($row_subdist_list = mysql_fetch_object($rs_subdist_list)) {
                echo "<option ";

                if ($row_rsUpdateJobSeeker['jobseeker_address_subdistrict'] == $row_subdist_list->subdis_id) {
                  echo "selected=\"selected\"";
                }

                echo 'value="'.$row_subdist_list->subdis_id.'"';
                echo ">";
                echo $row_subdist_list->subdist_name;
                echo "</option>";
              }

            } else {
              echo "<option value=\"NULL\">SubDistrict</option>";
            }

            ?>
          </select>
        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Date Of Birth</td>
        <td><select name="jobseeker_dob_d" class="date">
        <option value="<?php echo $row_rsUpdateJobSeeker['jobseeker_dob_d']; ?>"><?php echo $row_rsUpdateJobSeeker['jobseeker_dob_d']; ?></option>
        <?php 
    for($i = 1; $i <= 31; $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php } ?>
        </select> 
        <select name="jobseeker_dob_m" class="date">
        <option value="<?php echo $row_rsUpdateJobSeeker['jobseeker_dob_m']; ?>"><?php echo $row_rsUpdateJobSeeker['jobseeker_dob_m']; ?></option>
        <?php 
    for($i = 1; $i <= 12; $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php } ?>
        </select>
        <select name="jobseeker_dob_y" class="date">
        <option value="<?php echo $row_rsUpdateJobSeeker['jobseeker_dob_y']; ?>"><?php echo $row_rsUpdateJobSeeker['jobseeker_dob_y']; ?></option>
        <?php 
    for($i = 1960; $i <= date('Y'); $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php } ?>
        </select></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Gender</td>
        <td><select name="jobseeker_gender" class="date">
          <option value="2" <?php if($row_rsUpdateJobSeeker['jobseeker_gender'] == 2){echo "selected=\"selected\"";} ?>>Male</option>
          <option value="1" <?php if($row_rsUpdateJobSeeker['jobseeker_gender'] == 1){echo "selected=\"selected\"";} ?>>Female</option>
        </select></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Marital Status</td>
        <td><select name="marital_status" class="date">
          <option value="Single" <?php if($row_rsUpdateJobSeeker['marital_status'] == 'Single'){echo "selected=\"selected\"";} ?>>Single</option>
          <option value="Married" <?php if($row_rsUpdateJobSeeker['marital_status'] == 'Married'){echo "selected=\"selected\"";} ?>>Married</option>
          <option value="Separated" <?php if($row_rsUpdateJobSeeker['marital_status'] == 'Separated'){echo "selected=\"selected\"";} ?>>Separated</option>
          <option value="Divorced" <?php if($row_rsUpdateJobSeeker['marital_status'] == 'Divorced'){echo "selected=\"selected\"";} ?>>Divorced</option>
          <option value="Widowed" <?php if($row_rsUpdateJobSeeker['marital_status'] == 'Widowed'){echo "selected=\"selected\"";} ?>>Widowed</option>
          <option value="Prefer not to answer" <?php if($row_rsUpdateJobSeeker['marital_status'] == 'Prefer not to answer'){echo "selected=\"selected\"";} ?>>Prefer not to answer</option>
        </select></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Nationality</td>
        <td><select name="jobseeker_nationality" class="date">
          <?php
          do {  
          ?>
                    <option value="<?php echo $row_rsNationality['national_id']?>" <?php if ($row_rsUpdateJobSeeker['jobseeker_nationality'] == $row_rsNationality['national_id']) {
                      echo "selected=\"selected\"";
                    } ?>><?php echo $row_rsNationality['national_name']?></option>
                    <?php
          } while ($row_rsNationality = mysql_fetch_assoc($rsNationality));
            $rows = mysql_num_rows($rsNationality);
            if($rows > 0) {
                mysql_data_seek($rsNationality, 0);
              $row_rsNationality = mysql_fetch_assoc($rsNationality);
            }
          ?>
        </select></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" valign="middle">Interpersonal Skills</td>
        <td><textarea name="jobseeker_moreinfo" cols="80" id="postContent" rows="11" style="width:440px"><?php echo $row_rsUpdateJobSeeker['jobseeker_moreinfo']; ?></textarea></td>
      </tr>
      <tr>
        <td nowrap align="right" valign="middle">Employment Status</td>
        <td>
          <select name="employment_status" class="date">
            <option value="unemployed" <?php if($row_rsUpdateJobSeeker['employment_status'] == 'unemployed'){echo "selected=\"selected\"";} ?>>Unemployed</option>
            <option value="employed" <?php if($row_rsUpdateJobSeeker['employment_status'] == 'employed'){echo "selected=\"selected\"";} ?>>Employed</option>
            <option value="studies" <?php if($row_rsUpdateJobSeeker['employment_status'] == 'studies'){echo "selected=\"selected\"";} ?>>Studies</option>
          </select>
        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td><input type="submit" class="btn btn-success" value="Update Profile Info"></td>
      </tr>
    </table>
    <input type="hidden" name="users_id_fk" value="<?php echo $_SESSION['MM_UserID']; ?>">
    <input type="hidden" name="jobseeker_last_edited" value="">
    <input type="hidden" name="MM_update" value="form1">
  </form>
  <p>&nbsp;</p>
</div>

          </div><!-- #content-->
  
      <aside id="sideRight" class="hide">
              <div class="sidebarBox">
                <strong>How-to</strong>
              <div class="sidebar_howto">
                  <ul>
                      <li><a href="#">Register</a></li>
                        <li><a href="#">Post a Job</a></li>
                    </ul>
              </div><!-- .sidebar_recentjob -->
              </div><!-- .sidebarBox -->
              
        <div class="sidebarBox hide">
                <strong>Recent Jobs</strong>
              <div class="sidebar_recentjob">
                  <ul>
                      <li><a></a></li>
                    </ul>
              </div><!-- .sidebar_recentjob -->
              </div><!-- .sidebarBox -->
              
              <div class="sidebarBox hide">
              <strong>Jobs Posted under </strong>
                <ul>
                  <li><a></a></li>
                </ul>
              </div><!-- .sidebarBox -->
              
              <div class="sidebarBox hide">
              <strong>Get Connected</strong><br />
                Facebook | Twitter | RSS
              </div><!-- .sidebarBox -->
            </aside>
      <!-- aside -->
      <!-- #sideRight -->

    </div><!-- #container-->
    

  </section><!-- #middle-->

  </div><!-- #wrapper-->

  <footer id="footer">
    <div class="center">
      <?php include("footer.php"); ?>
    </div><!-- .center -->
  </footer><!-- #footer -->


<script type="text/javascript">

$(document).ready(function(){

  var state_id = $('select#main_state');
  var dist_id = $('select#district');

  state_id.live('change', function(){

    console.log($(this).val());
    $('select#subdistrict').html('<option value="">SubDistrict</option>');

    $.ajax({
      type : 'GET',
      url : 'getDistrict.php?state_id='+$(this).val(),

      success:function(html){
        $('select#district').html(html);
        console.log(html);
      }
    });

  });

  dist_id.live('change', function(){

    console.log($(this).val());

    $.ajax({
      type : 'GET',
      url : 'getSubDistrict.php?district_id='+$(this).val(),

      success:function(html){
        $('select#subdistrict').html(html);
        console.log(html);
      }
    });

  });

});

</script>


</body>
</html>
<?php
mysql_free_result($rsNationality);

mysql_free_result($rsUpdateJobSeeker);

mysql_free_result($rsStatelist);
?>
