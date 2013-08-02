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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_list_companies = 10;
$pageNum_list_companies = 0;
if (isset($_GET['pageNum_list_companies'])) {
  $pageNum_list_companies = $_GET['pageNum_list_companies'];
}
$startRow_list_companies = $pageNum_list_companies * $maxRows_list_companies;

$query_list_companies = "SELECT   mj_users.*,   jp_employer.*,   jp_industry.*,   mj_state.* From   mj_users Inner Join   jp_employer On jp_employer.users_id_fk = mj_users.users_id Inner Join   jp_industry On jp_employer.emp_industry_id_fk = jp_industry.indus_id   Inner Join   mj_state On mj_users.mj_state_fk = mj_state.state_id    Where   mj_users.users_type = 2";
$query_limit_list_companies = sprintf("%s LIMIT %d, %d", $query_list_companies, $startRow_list_companies, $maxRows_list_companies);
$list_companies = mysql_query($query_limit_list_companies, $db) or die(mysql_error());
$row_list_companies = mysql_fetch_assoc($list_companies);

if (isset($_GET['totalRows_list_companies'])) {
  $totalRows_list_companies = $_GET['totalRows_list_companies'];
} else {
  $all_list_companies = mysql_query($query_list_companies);
  $totalRows_list_companies = mysql_num_rows($all_list_companies);
}
$totalPages_list_companies = ceil($totalRows_list_companies/$maxRows_list_companies)-1;

$queryString_list_companies = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_list_companies") == false && 
        stristr($param, "totalRows_list_companies") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_list_companies = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_list_companies = sprintf("&totalRows_list_companies=%d%s", $totalRows_list_companies, $queryString_list_companies);
?>
<div id="filterSection">
	<div class="center" style="padding:2px 0px">
		<div style="padding-left: 8px;">
			<form action="companies.php" method="get">
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
		<h1>Explore Oppurtunities</h1>
		<div>
			
		<ul>
		  <?php do { ?>
		    <li>
		      <div><?php echo $row_list_companies['usr_id']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['users_id']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['usr_name']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['users_fname']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['users_lname']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['usr_pwd']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['usr_email']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['users_email']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['users_type']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['users_register']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['users_last_login']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['users_ic']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['user_pic']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['usr_lvl']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['usr_acct_status']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['user_active']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['usr_cnfm_key']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['usr_cnfrm_datetime']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['usr_last_login']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['usr_workat']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['usr_tel']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['usr_general_info']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['usr_core_activity']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['usr_rating']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['mj_sector_fk']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['mj_services_fk']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['mj_state_fk']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['mj_country_id_fk']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['emp_id']; ?>&nbsp; </div>
		      <div><a href="ed.php?recordID=<?php echo $row_list_companies['emp_id']; ?>"> <?php echo $row_list_companies['emp_name']; ?>&nbsp; </a></div>
		      <div><?php echo $row_list_companies['emp_desc']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['emp_industry_id_fk']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['emp_address']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['emp_tel']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['emp_email']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['emp_web']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['emp_pic']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['emp_featured']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['emp_package']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['users_id_fk']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['indus_id']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['indus_name']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['industry_parent']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['industry_icon']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['state_id']; ?>&nbsp; </div>
		      <div><?php echo $row_list_companies['state_name']; ?>&nbsp; </div>
		    </li>
		    <?php } while ($row_list_companies = mysql_fetch_assoc($list_companies)); ?>
		</ul>
		<br />
		<table border="0">
		  <tr>
		    <td><?php if ($pageNum_list_companies > 0) { // Show if not first page ?>
		        <a href="<?php printf("%s?pageNum_list_companies=%d%s", $currentPage, 0, $queryString_list_companies); ?>">First</a>
		        <?php } // Show if not first page ?></td>
		    <td><?php if ($pageNum_list_companies > 0) { // Show if not first page ?>
		        <a href="<?php printf("%s?pageNum_list_companies=%d%s", $currentPage, max(0, $pageNum_list_companies - 1), $queryString_list_companies); ?>">Previous</a>
		        <?php } // Show if not first page ?></td>
		    <td><?php if ($pageNum_list_companies < $totalPages_list_companies) { // Show if not last page ?>
		        <a href="<?php printf("%s?pageNum_list_companies=%d%s", $currentPage, min($totalPages_list_companies, $pageNum_list_companies + 1), $queryString_list_companies); ?>">Next</a>
		        <?php } // Show if not last page ?></td>
		    <td><?php if ($pageNum_list_companies < $totalPages_list_companies) { // Show if not last page ?>
		        <a href="<?php printf("%s?pageNum_list_companies=%d%s", $currentPage, $totalPages_list_companies, $queryString_list_companies); ?>">Last</a>
		        <?php } // Show if not last page ?></td>
		  </tr>
		</table>
		Records <?php echo ($startRow_list_companies + 1) ?> to <?php echo min($startRow_list_companies + $maxRows_list_companies, $totalRows_list_companies) ?> of <?php echo $totalRows_list_companies ?>

		</div>
	</div>
</div>

<input type="hidden" name="page_title" value="Companies" id="page_title" />

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