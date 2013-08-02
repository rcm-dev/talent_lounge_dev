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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO jp_jobseeker (users_id_fk, jobseeker_tel, jobseeker_mobile, jobseeker_address, jobseeker_address_poscode, jobseeker_address_state, jobseeker_address_district, jobseeker_address_subdistrict, jobseeker_dob_y, jobseeker_dob_m, jobseeker_dob_d, jobseeker_gender, marital_status, jobseeker_nationality, jobseeker_moreinfo, employment_status, jobseeker_pic, jobseeker_last_edited) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['users_id_fk'], "int"),
                       GetSQLValueString($_POST['jobseeker_tel'], "text"),
                       GetSQLValueString($_POST['jobseeker_mobile'], "text"),
                       GetSQLValueString($_POST['jobseeker_address'], "text"),
                       GetSQLValueString($_POST['poscode'], "text"),
                       GetSQLValueString($_POST['main_state'], "int"),
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
                       GetSQLValueString("media/jobseeker/default_jobseeker.png", "text"),
                       GetSQLValueString($_POST['jobseeker_last_edited'], "date"));

  mysql_select_db($database_conJobsPerak, $conJobsPerak);
  $Result1 = mysql_query($insertSQL, $conJobsPerak) or die(mysql_error());

  $insertGoTo = "jobSeekerDashboard.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsNationality = "SELECT * FROM jp_nationality";
$rsNationality = mysql_query($query_rsNationality, $conJobsPerak) or die(mysql_error());
$row_rsNationality = mysql_fetch_assoc($rsNationality);
$totalRows_rsNationality = mysql_num_rows($rsNationality);
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
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
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
            <img src="file:///Macintosh HD/Applications/XAMPP/xamppfiles/htdocs/tl_baru/beta/images/logo.png" alt="logo.png" border="0">
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
<h2>Update</h2>
<div class="master_details">
  <p>Welcome <?php echo $_SESSION['MM_Username']; ?> <?php echo $_SESSION['MM_UserID']; ?> | <a href="<?php echo $logoutAction ?>">Log Out</a></p>
  
  <div class="master_details"><h3>Edit Particular Profile</h3></div>
  <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <table width="600" align="center">
      <tr valign="baseline">
        <td nowrap align="right">Telephone:</td>
        <td><span id="sprytextfield1">
          <input type="text" name="jobseeker_tel" value="" size="32">
          <span class="textfieldRequiredMsg">A Telephone is required.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Mobile Phone</td>
        <td><span id="sprytextfield2">
        <input type="text" name="jobseeker_mobile" value="" size="32">
        <span class="textfieldRequiredMsg">A Mobile is required.</span><span class="textfieldInvalidFormatMsg">Mobile format.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="middle" nowrap>Address</td>
        <td><span id="sprytextarea1">
          <textarea name="jobseeker_address" cols="50" rows="5"></textarea>
          <span class="textareaRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Poscode</td>
        <td><span id="sprytextfield3">
        <input name="poscode" type="text" id="poscode" size="32" value="">
        <span class="textfieldRequiredMsg">A poscode is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">State</td>
        <td><span id="spryselect5">
          <select name="main_state" id="main_state" class="date">
            <option>State</option>
            <?php  

            /**
             *
             * Record Set for state
             * Retrieve via object 
             * 
             */
            $query_state     = "SELECT * FROM jp_location WHERE location_parent = 0";
            $rs_state        = mysql_query($query_state) or die(mysql_error());
            $totalRows_state = mysql_num_rows($rs_state);
            
            while ($row_state= mysql_fetch_object($rs_state)) {
              echo "<option ";
              echo 'value="'.$row_state->location_id.'"';
              echo ">";
              echo ucwords(strtolower($row_state->location_name));
              echo "</option>";
            }

            ?>
          </select>
          <span class="selectRequiredMsg">Please select the state.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">District</td>
        <td>
          <select name="district" id="district" class="date">
            <option>District</option>
          </select>
        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">SubDistrict</td>
        <td>
          <select name="subdistrict" id="subdistrict" class="date">
            <option>SubDistrict</option>
          </select>
        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Date Of Birth</td>
        <td><span id="spryselect6">
          <select name="jobseeker_dob_d" class="date">
            <option value="">Day</option>
            <?php 
    for($i = 1; $i <= 31; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
          </select>
          <span class="selectRequiredMsg">Please select the Day.</span></span><span id="spryselect7">
          <select name="jobseeker_dob_m" class="date">
            <option value="">Month</option>
            <?php 
    for($i = 1; $i <= 12; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
          </select>
          <span class="selectRequiredMsg">Please select the Month.</span></span><span id="spryselect8">
          <select name="jobseeker_dob_y" class="date">
            <option value="">Year</option>
            <?php 
    for($i = 1960; $i <= date('Y'); $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
          </select>
          <span class="selectRequiredMsg">Please select the Year.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Gender</td>
        <td><span id="spryselect3">
          <select name="jobseeker_gender" class="date">
            <option value="">Gender</option>
            <option value="2">Male</option>
            <option value="1">Female</option>
          </select>
          <span class="selectRequiredMsg">Please select a Gender.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Marital Status</td>
        <td><span id="spryselect1">
          <select name="marital_status" class="date">
            <option value="">Status</option>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Separated">Separated</option>
            <option value="Divorced">Divorced</option>
            <option value="Widowed">Widowed</option>
            <option value="Prefer not to answer">Prefer not to answer</option>
          </select>
          <span class="selectRequiredMsg">Please select the Marital.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Nationality</td>
        <td><span id="spryselect2">
          <select name="jobseeker_nationality" class="date">
            <option value="">Nationality</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsNationality['national_id']?>"><?php echo $row_rsNationality['national_name']?></option>
            <?php
} while ($row_rsNationality = mysql_fetch_assoc($rsNationality));
  $rows = mysql_num_rows($rsNationality);
  if($rows > 0) {
      mysql_data_seek($rsNationality, 0);
    $row_rsNationality = mysql_fetch_assoc($rsNationality);
  }
?>
          </select>
<span class="selectRequiredMsg">Please select the Nationality.</span></span></td>
      </tr>
      <tr valign="baseline">
       <td nowrap align="right" valign="middle">Interpersonal Skills</td>
        <td><span id="sprytextarea2">
          <textarea name="jobseeker_moreinfo" cols="80" id="postContent" rows="11" style="width:440px"></textarea>
          <span class="textareaRequiredMsg">A Interpersonal skill is required.</span></span></td>
      </tr>
      <tr>
        <td nowrap align="right" valign="middle">Employment Status</td>
        <td><span id="spryselect4">
          <select name="employment_status" class="date">
            <option value="">Employment Status</option>
            <option value="unemployed">Unemployed</option>
            <option value="employed">Employed</option>
            <option value="studies">Studies</option>
          </select>
          <span class="selectRequiredMsg">Please select the Employment.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td><input type="submit" value="Add Profile Info"></td>
      </tr>
    </table>
    <input type="hidden" name="users_id_fk" value="<?php echo $_SESSION['MM_UserID']; ?>">
    <input type="hidden" name="jobseeker_last_edited" value="">
    <input type="hidden" name="MM_insert" value="form1">
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "zip_code");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2");
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4");
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5");
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6");
var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7");
var spryselect8 = new Spry.Widget.ValidationSelect("spryselect8");
</script>
</body>
</html>
<?php
mysql_free_result($rsNationality);
?>
