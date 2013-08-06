<?php  


/* Include header */
include 'header.php';
include 'class/short.php';

function shortUpdate($text) { 

    // Change to the number of characters you want to display 
    $chars = 90; 

    $text = $text." "; 
    $text = substr($text,0,$chars); 
    $text = substr($text,0,strrpos($text,' '));

    if ($chars > 90) {
    	$text = $text."...";
    }
    else {
    	$text = $text."";
    }


    return $text; 

}

// Function seo friendly
function seo_url($string) 
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

	echo $seoname;
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

$maxRows_list_Talent = 10;
$pageNum_list_Talent = 0;
if (isset($_GET['pageNum_list_Talent'])) {
  $pageNum_list_Talent = $_GET['pageNum_list_Talent'];
}
$startRow_list_Talent = $pageNum_list_Talent * $maxRows_list_Talent;

$query_list_Talent = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_last_login As setLastlogin,
  mj_users.usr_email As setemail,
  mj_users.usr_id,
  mj_users.usr_name As currName,
  mj_users.usr_workat As WorkAt,
  
  mj_users.usr_general_info As CurGenInfo,
  mj_users.usr_rating,
  mj_users.usr_core_activity,
  mj_users.mj_sector_fk,
  mj_users.mj_services_fk,
  mj_sector.sec_name,
  mj_services.services_name As Profession,
  mj_state.state_name As Location,
  mj_country.country_name,
  jp_skills.skills_name As Skills,
  jp_edu_lists.edu_name As Education

From
  mj_users Inner Join
  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id Inner Join
  mj_country On mj_users.mj_country_id_fk = mj_country.country_id Inner Join
  jp_skills On jp_skills.user_id_fk = mj_users.users_id Inner Join
  jp_education On jp_education.user_id_fk = mj_users.users_id Inner Join
  jp_edu_lists On jp_education.edu_qualification = jp_edu_lists.edu_id ";
  $query_limit_list_Talent = sprintf("%s LIMIT %d, %d", $query_list_Talent, $startRow_list_Talent, $maxRows_list_Talent);
$list_Talent = mysql_query($query_limit_list_Talent, $db) or die(mysql_error());
$row_list_Talent = mysql_fetch_assoc($list_Talent);

if (isset($_GET['totalRows_list_Talent'])) {
  $totalRows_list_Talent = $_GET['totalRows_list_Talent'];
} else {
  $all_list_Talent = mysql_query($query_list_Talent);
  $totalRows_list_Talent = mysql_num_rows($all_list_Talent);
}
$totalPages_list_Talent = ceil($totalRows_list_Talent/$maxRows_list_Talent)-1;

$queryString_list_Talent = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_list_Talent") == false && 
        stristr($param, "totalRows_list_Talent") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_list_Talent = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_list_Talent = sprintf("&totalRows_list_Talent=%d%s", $totalRows_list_Talent, $queryString_list_Talent);

$currentPage = $_SERVER["PHP_SELF"];

$queryString_listShowcase = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_listShowcase") == false && 
        stristr($param, "totalRows_listShowcase") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_listShowcase = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_listShowcase = sprintf("&totalRows_listShowcase=%d%s", $totalRows_listShowcase, $queryString_listShowcase);
?>
<div id="filterSection">
	<div class="center" style="padding:2px 0px">
		<div style="padding-left: 8px;">
			<form action="talent.php" method="get">
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
						<td>Status</td>
						<td>
							<select name="Status" id="Status">
								<option value="0">All Status</option>
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

<div>
	<div id="contentContainer">
		<h1>Discover Talent</h1>

		<div>
			
			<ul>
			  <?php do { ?>
			    <li>
			      <div><?php echo $row_list_Talent['usrPicture']; ?>&nbsp; </div>
			      <div><?php echo $row_list_Talent['setLastlogin']; ?>&nbsp; </div>
			      <div><?php echo $row_list_Talent['setemail']; ?>&nbsp; </div>
			      <div><?php echo $row_list_Talent['usr_id']; ?>&nbsp; </div>
			      <div><a href="div.php?recordID=<?php echo $row_list_Talent['usr_id']; ?>"> <?php echo $row_list_Talent['currName']; ?>&nbsp; </a></div>
			      <div><?php echo $row_list_Talent['WorkAt']; ?>&nbsp; </div>
			      <div><?php echo $row_list_Talent['currPhoneNo']; ?>&nbsp; </div>
			      <div><?php echo $row_list_Talent['CurGenInfo']; ?>&nbsp; </div>
			      <div><?php echo $row_list_Talent['usr_rating']; ?>&nbsp; </div>
			      <div><?php echo $row_list_Talent['usr_core_activity']; ?>&nbsp; </div>
			      <div><?php echo $row_list_Talent['mj_sector_fk']; ?>&nbsp; </div>
			      <div><?php echo $row_list_Talent['mj_services_fk']; ?>&nbsp; </div>
			      <div><?php echo $row_list_Talent['sec_name']; ?>&nbsp; </div>
			      <div><?php echo $row_list_Talent['services_name']; ?>&nbsp; </div>
			      <div><?php echo $row_list_Talent['state_name']; ?>&nbsp; </div>
			      <div><?php echo $row_list_Talent['counliy_name']; ?>&nbsp; </div>
			    </tr>
			    <?php } while ($row_list_Talent = mysql_fetch_assoc($list_Talent)); ?>
			</ul>
			<br />
			<table border="0">
			  <tr>
			    <td><?php if ($pageNum_list_Talent > 0) { // Show if not first page ?>
			        <a href="<?php printf("%s?pageNum_list_Talent=%d%s", $currentPage, 0, $queryString_list_Talent); ?>">First</a>
			        <?php } // Show if not first page ?></td>
			    <td><?php if ($pageNum_list_Talent > 0) { // Show if not first page ?>
			        <a href="<?php printf("%s?pageNum_list_Talent=%d%s", $currentPage, max(0, $pageNum_list_Talent - 1), $queryString_list_Talent); ?>">Previous</a>
			        <?php } // Show if not first page ?></td>
			    <td><?php if ($pageNum_list_Talent < $totalPages_list_Talent) { // Show if not last page ?>
			        <a href="<?php printf("%s?pageNum_list_Talent=%d%s", $currentPage, min($totalPages_list_Talent, $pageNum_list_Talent + 1), $queryString_list_Talent); ?>">Next</a>
			        <?php } // Show if not last page ?></td>
			    <td><?php if ($pageNum_list_Talent < $totalPages_list_Talent) { // Show if not last page ?>
			        <a href="<?php printf("%s?pageNum_list_Talent=%d%s", $currentPage, $totalPages_list_Talent, $queryString_list_Talent); ?>">Last</a>
			        <?php } // Show if not last page ?></td>
			  </tr>
			</table>
			Records <?php echo ($startRow_list_Talent + 1) ?> to <?php echo min($startRow_list_Talent + $maxRows_list_Talent, $totalRows_list_Talent) ?> of <?php echo $totalRows_list_Talent ?>
	
		</div>

	</div>
</div>

<input type="hidden" name="page_title" value="Showcases" id="page_title" />

<div class="profile right" style="border:1px solid purple;  width: 730px; margin:10px; padding:5px; ">
        <div class="profile22 left" style="border:1px solid #4c4c4c;  width: 700px; height:180px; margin:10px; padding:5px; ">
</div>      


<script>
$(document).ready(function(){

	/*$('#intervalStream').load('ajax/ajax-landing-stream.php');
    
   function test () {
   		console.log('RUN');
   		$('#intervalStream').load('ajax/ajax-landing-stream.php');
   		//$('#ImgOne').fadeOut(4000).fadeIn(4000);
   }

   var refreshId = setInterval(test, 5000);*/


   /* vertical ticker */
	$('#intervalStream').totemticker({
		row_height	:	'85px',
	});
   /*-------------------------------------------------------------------*/



   /* tipsy */
	$('.idea-new-ui').find('li img').tipsy({gravity: 's'});

	$('.book-ui').find('li img').tipsy({gravity: 's'});

	$('.ideaMisc').find('div .ic_attachment_grey').tipsy({gravity: 's'});




	/* Change services */
	$('#searchsector').change(function(){

		var sectorID = $(this).val();
	

		$('#searchProduct').load('ajax/ajax-selectsector.php?sectorid='+sectorID);
		console.log(sectorID);
		

	});


	$('.flexslider').flexslider({
	    animation: "fade"
	  });


});
</script>
<?php  

/* Include header */
include 'footer.php';

?>