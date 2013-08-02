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

$maxRows_listShowcase = 5;
$pageNum_listShowcase = 0;
if (isset($_GET['pageNum_listShowcase'])) {
  $pageNum_listShowcase = $_GET['pageNum_listShowcase'];
}
$startRow_listShowcase = $pageNum_listShowcase * $maxRows_listShowcase;

$query_listShowcase = "SELECT   mj_users.usr_name As proBy,   mj_fund_post.fund_post_id As proId,   mj_fund_post.fund_post_title As proTitle,   mj_fund_post.fund_post_business_model proDesc,   mj_fund_category.fund_cat_name As catName,   mj_fund_post.fund_post_image As proImg,   mj_fund_post.fund_post_short_brief As shortBrief,   mj_fund_post.fund_post_published, mj_users.* From   mj_fund_post Inner Join   mj_fund_category On mj_fund_post.fund_cat_id_fk = mj_fund_category.fund_cat_id   Inner Join   mj_users On mj_fund_post.fund_usr_id_fk = mj_users.usr_id Where   mj_fund_post.fund_post_published = 1 And   mj_fund_post.fund_post_success = 0 And   mj_fund_post.fund_post_failed = 0 ORDER BY RAND()";
$query_limit_listShowcase = sprintf("%s LIMIT %d, %d", $query_listShowcase, $startRow_listShowcase, $maxRows_listShowcase);
$listShowcase = mysql_query($query_limit_listShowcase, $db) or die(mysql_error());
$row_listShowcase = mysql_fetch_assoc($listShowcase);

if (isset($_GET['totalRows_listShowcase'])) {
  $totalRows_listShowcase = $_GET['totalRows_listShowcase'];
} else {
  $all_listShowcase = mysql_query($query_listShowcase);
  $totalRows_listShowcase = mysql_num_rows($all_listShowcase);
}
$totalPages_listShowcase = ceil($totalRows_listShowcase/$maxRows_listShowcase)-1;

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

<div>
	<div id="contentContainer">
		<h1>Discover Showcase</h1>

		<div>
			<ul id="showcase-new-ui">
			  <?php do { ?>
			    <li>
			    	<div style="height: 194px; overflow: hidden;"><img src="<?php echo $row_listShowcase['proImg']; ?>" alt="<?php echo $row_listShowcase['proTitle']; ?>" width="190px"></div>
			      <div><strong><?php echo $row_listShowcase['proBy']; ?></strong></div>
			      <div><a href="funding-details.php?id=<?php echo $row_listShowcase['proId']; ?>"> <?php echo $row_listShowcase['proTitle']; ?></a></div>
			    </li>
			    <?php } while ($row_listShowcase = mysql_fetch_assoc($listShowcase)); ?>
			</ul>
			<br />
			<table border="0">
			  <tr>
			    <td><?php if ($pageNum_listShowcase > 0) { // Show if not first page ?>
			        <a href="<?php printf("%s?pageNum_listShowcase=%d%s", $currentPage, 0, $queryString_listShowcase); ?>">First</a>
			        <?php } // Show if not first page ?></td>
			    <td><?php if ($pageNum_listShowcase > 0) { // Show if not first page ?>
			        <a href="<?php printf("%s?pageNum_listShowcase=%d%s", $currentPage, max(0, $pageNum_listShowcase - 1), $queryString_listShowcase); ?>">Previous</a>
			        <?php } // Show if not first page ?></td>
			    <td><?php if ($pageNum_listShowcase < $totalPages_listShowcase) { // Show if not last page ?>
			        <a href="<?php printf("%s?pageNum_listShowcase=%d%s", $currentPage, min($totalPages_listShowcase, $pageNum_listShowcase + 1), $queryString_listShowcase); ?>">Next</a>
			        <?php } // Show if not last page ?></td>
			    <td><?php if ($pageNum_listShowcase < $totalPages_listShowcase) { // Show if not last page ?>
			        <a href="<?php printf("%s?pageNum_listShowcase=%d%s", $currentPage, $totalPages_listShowcase, $queryString_listShowcase); ?>">Last</a>
			        <?php } // Show if not last page ?></td>
			  </tr>
			</table>
			</p>
			<p>
			  <?php echo $totalRows_listShowcase ?> Records Total
			</p>
		</div>

	</div>
</div>

<input type="hidden" name="page_title" value="Showcases" id="page_title" />

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