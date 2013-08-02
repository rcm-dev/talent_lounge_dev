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

$maxRows_list_jobs = 10;
$pageNum_list_jobs = 0;
if (isset($_GET['pageNum_list_jobs'])) {
  $pageNum_list_jobs = $_GET['pageNum_list_jobs'];
}
$startRow_list_jobs = $pageNum_list_jobs * $maxRows_list_jobs;

$query_list_jobs = "SELECT jp_ads.*, jp_location.*, jp_employer.* FROM jp_ads INNER JOIN jp_location ON jp_ads.ads_location = jp_location.location_id INNER JOIN jp_employer ON jp_ads.emp_id_fk = jp_employer.emp_id WHERE jp_ads.ads_enable_view = 1 ORDER BY ads_date_posted DESC";
$query_limit_list_jobs = sprintf("%s LIMIT %d, %d", $query_list_jobs, $startRow_list_jobs, $maxRows_list_jobs);
$list_jobs = mysql_query($query_limit_list_jobs, $db) or die(mysql_error());
$row_list_jobs = mysql_fetch_assoc($list_jobs);

if (isset($_GET['totalRows_list_jobs'])) {
  $totalRows_list_jobs = $_GET['totalRows_list_jobs'];
} else {
  $all_list_jobs = mysql_query($query_list_jobs);
  $totalRows_list_jobs = mysql_num_rows($all_list_jobs);
}
$totalPages_list_jobs = ceil($totalRows_list_jobs/$maxRows_list_jobs)-1;

$queryString_list_jobs = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_list_jobs") == false && 
        stristr($param, "totalRows_list_jobs") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_list_jobs = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_list_jobs = sprintf("&totalRows_list_jobs=%d%s", $totalRows_list_jobs, $queryString_list_jobs);
?>
<div id="filterSection">
	<div class="center" style="padding:2px 0px">
		<div style="padding-left: 8px;">
			<form action="jobs.php" method="get">
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


<div id="contentContainer">
	<h1>Most handpicked jobs</h1>

	<div>
		
		<ul>
		  <?php do { ?>
		    <li>
		      <div><?php echo $row_list_jobs['ads_id']; ?>&nbsp; </div>
		      <div><a href="ad.php?recordID=<?php echo $row_list_jobs['ads_id']; ?>"> <?php echo $row_list_jobs['ads_title']; ?>&nbsp; </a></div>
		      <div><?php echo $row_list_jobs['ads_details']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['emp_id_fk']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_location']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_salary']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_y_exp']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_enable_view']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_featured']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_date_posted']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_date_published']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_date_last_edited']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_date_expired']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_industry_id_fk']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_minimum']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_view']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_type']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['ads_pic']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['location_id']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['location_name']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['location_parent']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['location_image']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['emp_id']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['emp_name']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['emp_desc']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['emp_industry_id_fk']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['emp_address']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['emp_tel']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['emp_email']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['emp_web']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['emp_pic']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['emp_featured']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['emp_package']; ?>&nbsp; </div>
		      <div><?php echo $row_list_jobs['users_id_fk']; ?>&nbsp; </div>
		    </li>
		    <?php } while ($row_list_jobs = mysql_fetch_assoc($list_jobs)); ?>
		</ul>
		<br />
		<table border="0">
		  <tr>
		    <td><?php if ($pageNum_list_jobs > 0) { // Show if not first page ?>
		        <a href="<?php printf("%s?pageNum_list_jobs=%d%s", $currentPage, 0, $queryString_list_jobs); ?>">First</a>
		        <?php } // Show if not first page ?></td>
		    <td><?php if ($pageNum_list_jobs > 0) { // Show if not first page ?>
		        <a href="<?php printf("%s?pageNum_list_jobs=%d%s", $currentPage, max(0, $pageNum_list_jobs - 1), $queryString_list_jobs); ?>">Previous</a>
		        <?php } // Show if not first page ?></td>
		    <td><?php if ($pageNum_list_jobs < $totalPages_list_jobs) { // Show if not last page ?>
		        <a href="<?php printf("%s?pageNum_list_jobs=%d%s", $currentPage, min($totalPages_list_jobs, $pageNum_list_jobs + 1), $queryString_list_jobs); ?>">Next</a>
		        <?php } // Show if not last page ?></td>
		    <td><?php if ($pageNum_list_jobs < $totalPages_list_jobs) { // Show if not last page ?>
		        <a href="<?php printf("%s?pageNum_list_jobs=%d%s", $currentPage, $totalPages_list_jobs, $queryString_list_jobs); ?>">Last</a>
		        <?php } // Show if not last page ?></td>
		  </tr>
		</table>
		Records <?php echo ($startRow_list_jobs + 1) ?> to <?php echo min($startRow_list_jobs + $maxRows_list_jobs, $totalRows_list_jobs) ?> of <?php echo $totalRows_list_jobs ?>

	</div>
</div>
<input type="hidden" name="page_title" value="Jobs" id="page_title" />

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