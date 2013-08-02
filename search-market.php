<?php  


include 'header.php';
include 'db/db-connect.php';


# sqlinjection
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

# require pagination class
require_once 'class/paginator.class.php';

# get parameter
$string					=	sqlInjectString(@$_GET['prod_search']);
$market_category		=	(int) sqlInjectString(@$_GET['market_category']);
$market_area			=	(int) sqlInjectString(@$_GET['market_area']);
$sort_price				=   (int) sqlInjectString(@$_GET['sp']);
//$sort_date				=   @$_GET['sd'];

?>

<!-- <div id="content" class="<?php //if(!isset($_SESSION['usr_id'])) { echo "topfix"; } ?>"> -->
<div id="content">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" class="">
<div id="mojo-container">

	<div class="container_24">
		<div class="home_container">
			<div class="home_box">

				<div class="heading">
					<h1 class="heading_title bebasTitle">Talent Market</h1>
				</div>

				<div id="searchTradingHub" class="searchTradingHub" style="margin: 40px 0px;">
					<form class="inline center" method="get" action="search-market.php">
						<strong style="font-size:16px">Looking for :</strong> 
						<input type="text" name="prod_search" class="title" placeholder="keywords.."/>

						Category
						<select name="market_category" style="padding:4px">
							<?php  
							/**
							 * SHOW AREA
							 */
							$qCat 	= "SELECT
							  mj_market_category.mrket_cat_name As catName,
							  mj_market_category.mrket_cat_id As catId
							From
							  mj_market_category";
							$rqCat	= mysql_query($qCat);

							echo '<option value="0" style="background:#ddd;">All Categories</option>';
							while ($rowqCat = mysql_fetch_object($rqCat)) {
			
							?>
							<option value="<?php echo $rowqCat->catId; ?>"><?php echo $rowqCat->catName; ?>
							</option>
							<?php } ?>
						</select>

						Area
						<select name="market_area" style="padding:4px">
							<?php  
							/**
							 * SHOW AREA
							 */
							$qArea 	= "SELECT
							  mj_state.state_id As sId,
							  mj_state.state_name As sArea
							From
							  mj_state";
							$rqArea	= mysql_query($qArea);

							echo '<option value="0" style="background:#ddd;">All Area</option>';
							while ($rowqArea = mysql_fetch_object($rqArea)) {
			
							?>
							<option value="<?php echo $rowqArea->sId; ?>"><?php echo $rowqArea->sArea; ?>
							</option>
							<?php } ?>
						</select>
						<input type="hidden" name="sp" value="DESC">
						<input type="submit" name="submit_prod" id="submit_prod" value="SEARCH" style="padding:4px" />
					</form>
				</div><!-- /searchTradingHub -->
				
				<?php  

				// ==================================================================
				//
				// self URL
				//
				// ------------------------------------------------------------------
				
				# Live is $url
				# Loccal is $url
				/*$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];*/
				$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].":81".$_SERVER['REQUEST_URI'];
				?>

				<div id="priceFilter" style="padding:5px;margin-top:-20px; margin-bottom:10px; text-align:right">
					<strong>Filter by</strong> <a href="<?php echo $url; ?>&amp;sp=ASC" id="fFilter" title="Lowest first">Lowest first</a> &middot; <a href="<?php echo $url; ?>&amp;sp=DESC" title="High first">Most recent first</a>
				</div><!-- /priceFilter -->

				<!-- product view -->
				<div>
					<div class="market-item-container">
						<ul class="market-list">
							
						
							<?php 


							
							/**
							 * SEARCH MARKET
							 * 
							 */
							 // if all 0
							 if ($string == NULL && $market_category == 0 && $market_area == 0) {


							 	// sort price
							 	if ($sort_price == 'DESC') {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
												  mj_market_post.*,
												  mj_market_category.mrket_cat_name,
												  mj_users.*,
												  mj_users.usr_name AS Uploader,
												  mj_state.state_name As location,
												  mj_market_post.mrket_post_title As marketSlugTitle,
												  mj_market_post.mrket_post_body As mrket_desc,
												  mj_market_post.mrket_post_title As viewingTitle,
												  mj_market_post.mrket_price As viewPrice,
												  mj_market_post.mrket_post_id As pid
												FROM
												  mj_market_post INNER JOIN
												  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
												  mj_market_category On mj_market_post.mrket_cat_id_fk =
												    mj_market_category.mrket_cat_id INNER JOIN
												  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
												  WHERE mj_market_post.mrket_post_published = 1
												  ORDER BY mj_market_post.market_dateposted DESC";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################

							 		# SQL Display
							 		$qTopRate = "SELECT
								  mj_market_post.*,
								  mj_market_category.mrket_cat_name,
								  mj_users.*,
								  mj_users.usr_name AS Uploader,
								  mj_state.state_name As location,
								  mj_market_post.mrket_post_title As marketSlugTitle,
								  mj_market_post.mrket_post_body As mrket_desc,
								  mj_market_post.mrket_post_title As viewingTitle,
								  mj_market_post.mrket_price As viewPrice,
								  mj_market_post.mrket_post_id As pid
								FROM
								  mj_market_post INNER JOIN
								  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
								  mj_market_category On mj_market_post.mrket_cat_id_fk =
								    mj_market_category.mrket_cat_id INNER JOIN
								  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
								  WHERE mj_market_post.mrket_post_published = 1
								  ORDER BY mj_market_post.market_dateposted DESC
								  " .$pages->limit;

								  // LIMIT 0, 20

							 	}
							 	elseif ($sort_price == 'ASC') {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
												  mj_market_post.*,
												  mj_market_category.mrket_cat_name,
												  mj_users.*,
												  mj_users.usr_name AS Uploader,
												  mj_state.state_name As location,
												  mj_market_post.mrket_post_body As mrket_desc,
												  mj_market_post.mrket_post_title As viewingTitle,
												  mj_market_post.mrket_price As viewPrice,
												  mj_market_post.mrket_post_id As pid
												FROM
												  mj_market_post INNER JOIN
												  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
												  mj_market_category On mj_market_post.mrket_cat_id_fk =
												    mj_market_category.mrket_cat_id INNER JOIN
												  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
												  WHERE mj_market_post.mrket_post_published = 1
												  ORDER BY mj_market_post.mrket_price ASC";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################

							 		$qTopRate = "SELECT
								  mj_market_post.*,
								  mj_market_category.mrket_cat_name,
								  mj_users.*,
								  mj_users.usr_name AS Uploader,
								  mj_state.state_name As location,
								  mj_market_post.mrket_post_body As mrket_desc,
								  mj_market_post.mrket_post_title As viewingTitle,
								  mj_market_post.mrket_price As viewPrice,
								  mj_market_post.mrket_post_id As pid
								FROM
								  mj_market_post INNER JOIN
								  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
								  mj_market_category On mj_market_post.mrket_cat_id_fk =
								    mj_market_category.mrket_cat_id INNER JOIN
								  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
								  WHERE mj_market_post.mrket_post_published = 1
								  ORDER BY mj_market_post.mrket_price ASC
								  " .$pages->limit;

							 	}
							 	else {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
												  mj_market_post.*,
												  mj_market_category.mrket_cat_name,
												  mj_users.*,
												  mj_users.usr_name AS Uploader,
												  mj_state.state_name As location,
												  mj_market_post.mrket_post_body As mrket_desc,
												  mj_market_post.mrket_post_title As viewingTitle,
												  mj_market_post.mrket_price As viewPrice,
												  mj_market_post.mrket_post_id As pid
												FROM
												  mj_market_post INNER JOIN
												  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
												  mj_market_category On mj_market_post.mrket_cat_id_fk =
												    mj_market_category.mrket_cat_id INNER JOIN
												  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
												  WHERE mj_market_post.mrket_post_published = 1";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################

							 		$qTopRate = "SELECT
								  mj_market_post.*,
								  mj_market_category.mrket_cat_name,
								  mj_users.*,
								  mj_users.usr_name AS Uploader,
								  mj_state.state_name As location,
								  mj_market_post.mrket_post_body As mrket_desc,
								  mj_market_post.mrket_post_title As viewingTitle,
								  mj_market_post.mrket_price As viewPrice,
								  mj_market_post.mrket_post_id As pid
								FROM
								  mj_market_post INNER JOIN
								  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
								  mj_market_category On mj_market_post.mrket_cat_id_fk =
								    mj_market_category.mrket_cat_id INNER JOIN
								  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
								  WHERE mj_market_post.mrket_post_published = 1
								  " .$pages->limit;

							 	}
								

								@$rqTopRate = mysql_query($qTopRate);
								$rowqTopRate = mysql_num_rows($rqTopRate);

							 } else if ($market_category == 0 && $market_area == 0) {


							 	// sort price
							 	if ($sort_price == 'DESC') {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_post_published = 1
									ORDER BY mj_market_post.market_dateposted DESC";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################

							 		// if market 0 and arae 0
								 	$qTopRate = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_post_published = 1
									ORDER BY mj_market_post.market_dateposted DESC
									" .$pages->limit;
							 	}
							 	elseif ($sort_price == 'ASC') {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_post_published = 1
									ORDER BY mj_market_post.mrket_price ASC";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################

							 		// if market 0 and arae 0
								 	$qTopRate = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_post_published = 1
									ORDER BY mj_market_post.mrket_price ASC
									".$pages->limit;
							 	}
							 	else {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_post_published = 1";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################

							 		// if market 0 and arae 0
								 	$qTopRate = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_post_published = 1
									".$pages->limit;
							 	}
							 	
								

								$rqTopRate = mysql_query($qTopRate);
								@$rowqTopRate = mysql_num_rows($rqTopRate);
							 
							} else if ($market_category == 0) {

								// sort price
							 	if ($sort_price == 'DESC') {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_state_id_fk = '$market_area' And
									  mj_market_post.mrket_post_published = 1
									Order By mj_market_post.market_dateposted DESC";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################


							 		// if category 0
								 	$qTopRate = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_state_id_fk = '$market_area' And
									  mj_market_post.mrket_post_published = 1
									Order By mj_market_post.market_dateposted DESC
									".$pages->limit;
							 	}
							 	elseif ($sort_price == 'ASC') {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_state_id_fk = '$market_area' And
									  mj_market_post.mrket_post_published = 1
									Order By mj_market_post.mrket_price ASC";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################

							 		// if category 0
								 	$qTopRate = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_state_id_fk = '$market_area' And
									  mj_market_post.mrket_post_published = 1
									Order By mj_market_post.mrket_price ASC
									".$pages->limit;
							 		
							 	}
							 	else {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_state_id_fk = '$market_area' And
									  mj_market_post.mrket_post_published = 1";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################


							 		// if category 0
								 	$qTopRate = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_state_id_fk = '$market_area' And
									  mj_market_post.mrket_post_published = 1
									".$pages->limit;
							 	}
								
								

								$rqTopRate = mysql_query($qTopRate);
								$rowqTopRate = mysql_num_rows($rqTopRate);

							} else if($market_area == 0){

								// sort price
							 	if ($sort_price == 'DESC') {


							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_cat_id_fk = '$market_category' And
									  mj_market_post.mrket_post_published = 1
									Order By mj_market_post.market_dateposted DESC";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################


							 		// if market 0
								 	$qTopRate = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_cat_id_fk = '$market_category' And
									  mj_market_post.mrket_post_published = 1
									Order By mj_market_post.market_dateposted DESC
									".$pages->limit;
							 	}
							 	elseif ($sort_price == 'ASC') {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_cat_id_fk = '$market_category' And
									  mj_market_post.mrket_post_published = 1
									Order By mj_market_post.mrket_price ASC";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################


							 		// if market 0
								 	$qTopRate = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_cat_id_fk = '$market_category' And
									  mj_market_post.mrket_post_published = 1
									Order By mj_market_post.mrket_price ASC
									".$pages->limit;
							 	}
							 	else {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_cat_id_fk = '$market_category' And
									  mj_market_post.mrket_post_published = 1";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################

							 		// if market 0
								 	$qTopRate = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_users.*,
									  mj_users.usr_name AS Uploader,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_cat_id_fk = '$market_category' And
									  mj_market_post.mrket_post_published = 1
									".$pages->limit;
							 	}
								

								$rqTopRate = mysql_query($qTopRate);
								@$rowqTopRate = mysql_num_rows($rqTopRate);

							} else {

								// sort price
							 	if ($sort_price == 'DESC') {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_cat_id_fk = '$market_category' And
									  mj_market_post.mrket_state_id_fk = '$market_area' And
									  mj_market_post.mrket_post_published = 1
									Order By mj_market_post.market_dateposted DESC";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################

							 		// search all selected and input
									 $qTopRate = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_cat_id_fk = '$market_category' And
									  mj_market_post.mrket_state_id_fk = '$market_area' And
									  mj_market_post.mrket_post_published = 1
									Order By mj_market_post.market_dateposted DESC
									".$pages->limit;
							 	}
							 	elseif ($sort_price == 'ASC') {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_cat_id_fk = '$market_category' And
									  mj_market_post.mrket_state_id_fk = '$market_area' And
									  mj_market_post.mrket_post_published = 1
									Order By mj_market_post.mrket_price ASC";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################

							 		// search all selected and input
									 $qTopRate = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_cat_id_fk = '$market_category' And
									  mj_market_post.mrket_state_id_fk = '$market_area' And
									  mj_market_post.mrket_post_published = 1
									Order By mj_market_post.mrket_price ASC
									".$pages->limit;
							 	}
							 	else {

							 		####################################################################################
									# sql collect how many row
									$sql_total = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_cat_id_fk = '$market_category' And
									  mj_market_post.mrket_state_id_fk = '$market_area' And
									  mj_market_post.mrket_post_published = 1";
									$sql_result = mysql_query($sql_total);
									$total_availbale = mysql_num_rows($sql_result);

									# construct pagination
									$pages = new Paginator;
									$pages->items_total = $total_availbale;
									$pages->mid_range = 9;
									$pages->paginate();
									# end pagination
							 		####################################################################################


							 		// search all selected and input
									 $qTopRate = "SELECT
									  mj_market_post.*,
									  mj_market_category.mrket_cat_name,
									  mj_state.state_name As location,
									  mj_market_post.mrket_post_body As mrket_desc,
									  mj_market_post.mrket_post_title As viewingTitle,
									  mj_market_post.mrket_price As viewPrice,
									  mj_market_post.mrket_post_id As pid
									From
									  mj_market_post Inner Join
									  mj_market_category On mj_market_post.mrket_cat_id_fk =
									    mj_market_category.mrket_cat_id Inner Join
									  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
									Where
									  (mj_market_post.mrket_post_title Like '%$string%' OR
									  mj_market_post.mrket_post_body Like '%$string%') And
									  mj_market_post.mrket_cat_id_fk = '$market_category' And
									  mj_market_post.mrket_state_id_fk = '$market_area' And
									  mj_market_post.mrket_post_published = 1
									".$pages->limit;
							 	}


								$rqTopRate = mysql_query($qTopRate);
								@$rowqTopRate = mysql_num_rows($rqTopRate);

							}
						
							
							if ($rowqTopRate == NULL) {
								echo "<h1 style=\"font-weight:bold\">No Ads founded.</h1>";
							} else {


							while ($rowrqTop = mysql_fetch_object($rqTopRate)) {

							?>

							<li>
							<!-- <a href="product-details.php?slug=<?php //echo urlencode($rowrqTop->marketSlugTitle); ?>&amp;id=<?php //echo $rowrqTop->mrket_post_id; ?>" title="<?php //echo $rowrqTop->mrket_post_title; ?>"> -->
							<!-- <a href="<?php //echo urlencode($rowrqTop->marketSlugTitle); ?>-market-<?php //echo $rowrqTop->mrket_post_id; ?>.html" title="<?php //echo $rowrqTop->mrket_post_title; ?>"> -->
							<a href="product-details.php?id=<?php echo $rowrqTop->mrket_post_id; ?>" title="<?php echo $rowrqTop->mrket_post_title; ?>">
								<div class="white" style="width: 172px; height: 172px; overflow: hidden;">
									<div style="width: 172px; height: 172px; background-image: url('<?php echo $rowrqTop->mrket_post_picture; ?>'); background-size: auto 100%; background-repeat: no-repeat; background-position: center center"></div>
								</div>
								</a>
								<div id="vD01" class="viewDetail">
									<div class="titleWrap">
										<span><strong><?php echo ucfirst($rowrqTop->mrket_post_title); ?></strong></span>
									</div>
									<span><?php echo ucwords($rowrqTop->mrket_cat_name); ?></span><br/>
									<span class="viewprice ic_tag_grey">RM
									<?php 

									$dprice = $rowrqTop->mrket_price;
									
									if ($dprice < 1000) {
									 	
									 	echo $dprice;
									 } 

									if ($dprice >= 1000 && $dprice <= 999999) {
										
										$kprice = $dprice / 1000;
										echo $kprice."K";

									}

									if ($dprice >= 1000000 && $dprice <= 9999999) {
										
										$kprice = $dprice / 1000000;
										echo $kprice."M";

									}

									?>
									</span>
									<span class="ic_pin_grey" style="margin-left:5px;"><?php echo ucwords($rowrqTop->location); ?></span>
								</div><!-- /viewDetail -->
								</li>

							<?php } }?>
						</ul>
						<div class="clear"></div>

						<!-- /pagination -->
						<!-- /pagination -->

					</div>
				</div>

				<!-- /product view -->

				<?php if ($rowqTopRate != 0): ?>
					<div id="paginate" class="">
						<div id="paginate_num">
							<?php echo $pages->display_pages(); ?>
						</div><!-- /paginate_num -->
						<div id="paginate_filter">
							<?php echo "<span>". $pages->display_jump_menu(). $pages->display_items_per_page() . "</span>"; ?>
						</div><!-- /paginate_filter -->
						<div style="clear:both"></div>
					</div><!-- /paginate -->
				<?php endif ?>

			</div>
		</div>
	</div>
</div>
	</div><!-- /contentContainer -->

</div><!-- /content -->
<input type="hidden" name="page_title" value="Search Market" id="page_title" />
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />


<!-- Tip Content -->
<ol id="joyRideTipContent">
  <li data-id="submit_prod" data-text="Next" class="custom">
    <h4>Search Ads / Product</h4>
    <p>Browse ads / product that available in market</p>
  </li>
  <li data-id="vD01" data-text="Next">
    <h4>Ads / Product Card</h4>
    <p>Picture preview, title of ads, price and location of the ads</p>
  </li>
  <li data-id="fFilter" data-text="Close">
    <h4>Market Filter</h4>
    <p>Your can filter your search view</p>
  </li>
</ol>

<?php 

// var tours
$section = 1;
include 'check_tours.php'; 

?>

<script type="text/javascript">
$(document).ready(function(){


	// run joyride
	var current_email = $('#current_email').val();
	if (current_email != '') {

		// get tour status
		var tour_status = $('input#tour_status').val();

		// if status run start tours
		if (tour_status == 'run') {
			// $('#tallChart').visualize();
			/*start joyride*/
			$(window).load(function() {
				$(this).joyride({
					'tipLocation': 'bottom',
			      		'scrollSpeed': 300,
			      		'nextButton': true,
			      		'tipAnimation': 'fade',
			      		'tipAnimationFadeSpeed': 500,
			      		'cookieMonster': false,
			      		'inline': true,
			      		'tipContent': '#joyRideTipContent',
			      		'postRideCallback': function(){
			      			disableTour();
			      			$("html, body").animate({ scrollTop: 0 }, "slow");
			      		}      
				});
			});
		};
		console.log(tour_status);

		// function disable tour
		function disableTour() {
			var disableTour = '<?php include 'disable_tours.php'; ?>';
			return disableTour;
		}	
	}
	// run joyride


	
	$('ul.market-list li').hover(function(){
		
		$(this).find('.market-image-list').slideUp();

	},function(){
		
		$(this).find('.market-image-list').slideDown();

	});

});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>