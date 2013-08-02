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

//$searchsector			=	$_GET['prod_search'];
$searchsector			=	sqlInjectString($_GET['searchsector']);
$searchProduct			=	sqlInjectString($_GET['searchProduct']);
$searchnetworkarea		=	sqlInjectString($_GET['searchnetworkarea']);


function shortBrief($text) { 

        // Change to the number of characters you want to display 
        $chars = 110; 

        $text = $text." "; 
        $text = substr($text,0,$chars); 
        $text = substr($text,0,strrpos($text,' ')); 
        $text = $text."..."; 

        return $text; 

    }


?>

<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" class="">
<div id="mojo-container">

	<div class="container_24">
		<div class="home_container">
			<div class="home_box">

				<div id="searchFounderHub" class="searchTradingHub">
			<form action="search-founders.php" accept-charset="utf-8" >

			<strong style="font-size:16px; color:#fff">Find funders in : </strong> 
			
			<select name="searchsector" id="searchsector" style="padding:4px">
				<option value="0">All Sector</option>
				<?php  

				$qsec          	= "SELECT
								  mj_sector.sec_id As secID,
								  mj_sector.sec_name As secName
								From
								  mj_sector";
				$resultsec     	= mysql_query($qsec);

				while ($rowsec 	= mysql_fetch_object($resultsec)) { ?>
					
					<option value="<?php echo $rowsec->secID; ?>">
						<?php echo ucwords($rowsec->secName); ?></option>
			
				<?php } ?>
			</select>

			<select name="searchProduct" id="searchProduct" style="padding:4px">
				<option value="0">All Product / Services</option>
			</select>

			<select name="searchnetworkarea" id="searchnetworkarea" style="padding:4px">
				<option value="0">All Area</option>
				<?php  

				$qstat           = "SELECT
								  mj_state.state_id as stateID,
								  mj_state.state_name As stateName
								From
								  mj_state";
				$resultqstat     = mysql_query($qstat);

				while ($rowstat   = mysql_fetch_object($resultqstat)) { ?>
					
					<option value="<?php echo $rowstat->stateID; ?>">
						<?php echo ucwords($rowstat->stateName); ?></option>
			
				<?php } ?>
			</select>

			<?php  

			// tracking session
			if (!isset($usr_email)) {

			?>
			
			<strong style="font-size:16px; color: orange">Register to explore</strong>

			<?php } else { ?>

			<input type="submit" name="searchNetwork" id="searchNetwork" value="Search Network" style="padding:4px" />

			<?php } ?>

		</form>
		</div><!-- /searchTradingHub -->
				

				<!-- product view -->
				<div class="left cnscontainer">

					<strong class="heading_title_two">Your Result(s):</strong>

					<div class="market-item-container" style="background-color:#fff; padding: 10px;">
						<ul>
							
						
							<?php  
							
							/**
							 * SEARCH ALL
							 * 
							 */
							 // if all 0
							 if ($searchsector == 0 && $searchProduct == 0 && $searchnetworkarea == 0) {
							 	
							 	// Display ALL
							 	$qTopRate = "SELECT
								  _company.comp_name As mrket_post_title,
								  mj_state.state_name As fArea,
								  mj_sector.sec_name As fSec,
								  mj_services.services_name As fService,
								  _company.isfeatured As fFeatured,
								  _company.comp_pic As fPic,
  								  _company.comp_desc As fDesc,
  								  _company.comp_id As fPid
								From
								  _company Inner Join
								  mj_state On _company.mj_state_fk = mj_state.state_id Inner Join
								  mj_sector On _company.mj_sector_fk = mj_sector.sec_id Inner Join
								  mj_services On _company.mj_services_fk = mj_services.services_id
								Where
								  _company.ispublished = 1
								Order By
								  _company.comp_name";
								

								$rqTopRate = mysql_query($qTopRate);
								$rowqTopRate = mysql_num_rows($rqTopRate);

							 } else if ($searchsector == 0 && $searchProduct == 0 && $searchnetworkarea != '$searchnetworkarea') {
							 	
							 	// Search FOUNDER IN ALL AREA
							 	$qTopRate = "SELECT
								  _company.comp_name As mrket_post_title,
								  mj_state.state_name As fArea,
								  mj_sector.sec_name As fSec,
								  mj_services.services_name As fService,
								  _company.isfeatured As fFeatured,
								  _company.comp_pic As fPic,
  								  _company.comp_desc As fDesc,
  								  _company.comp_id As fPid
								From
								  _company Inner Join
								  mj_state On _company.mj_state_fk = mj_state.state_id Inner Join
								  mj_sector On _company.mj_sector_fk = mj_sector.sec_id Inner Join
								  mj_services On _company.mj_services_fk = mj_services.services_id
								Where
								  _company.mj_state_fk = '$searchnetworkarea'
								Order By
								  _company.comp_name";
																

								$rqTopRate = mysql_query($qTopRate);
								$rowqTopRate = mysql_num_rows($rqTopRate);
							 
							} else if ($searchsector != 0 && $searchProduct == 0 && $searchnetworkarea == 0) {
								
								// Display by Sector
							 	$qTopRate = "SELECT
								  _company.comp_name As mrket_post_title,
								  mj_state.state_name As fArea,
								  mj_sector.sec_name As fSec,
								  mj_services.services_name As fService,
								  _company.isfeatured As fFeatured,
								  _company.comp_pic As fPic,
  								  _company.comp_desc As fDesc,
  								  _company.comp_id As fPid
								From
								  _company Inner Join
								  mj_state On _company.mj_state_fk = mj_state.state_id Inner Join
								  mj_sector On _company.mj_sector_fk = mj_sector.sec_id Inner Join
								  mj_services On _company.mj_services_fk = mj_services.services_id
								Where
								  _company.ispublished = 1 And
								  _company.mj_sector_fk = '$searchsector'";
								

								$rqTopRate = mysql_query($qTopRate);
								$rowqTopRate = mysql_num_rows($rqTopRate);

							} else if($searchsector != 0 && $searchProduct != 0 && $searchnetworkarea == 0){
								
								// Display by Sector & by Product/Services
							 	$qTopRate = "SELECT
								  _company.comp_name As mrket_post_title,
								  mj_state.state_name As fArea,
								  mj_sector.sec_name As fSec,
								  mj_services.services_name As fService,
								  _company.isfeatured As fFeatured,
								  _company.comp_pic As fPic,
  								  _company.comp_desc As fDesc,
  								  _company.comp_id As fPid
								From
								  _company Inner Join
								  mj_state On _company.mj_state_fk = mj_state.state_id Inner Join
								  mj_sector On _company.mj_sector_fk = mj_sector.sec_id Inner Join
								  mj_services On _company.mj_services_fk = mj_services.services_id
								Where
								  _company.ispublished = 1 And
								  _company.mj_sector_fk = '$searchsector' And
								  _company.mj_services_fk = '$searchProduct'";
								

								$rqTopRate = mysql_query($qTopRate);
								$rowqTopRate = mysql_num_rows($rqTopRate);

							} else if($searchsector != 0 && $searchProduct != 0 && $searchnetworkarea != 0){

							 
							 	 // search all selected
								 $qTopRate = "SELECT
								  _company.comp_name As mrket_post_title,
								  mj_state.state_name As fArea,
								  mj_sector.sec_name As fSec,
								  mj_services.services_name As fService,
								  _company.isfeatured As fFeatured,
								  _company.comp_pic As fPic,
  								  _company.comp_desc As fDesc,
  								  _company.comp_id As fPid
								From
								  _company Inner Join
								  mj_state On _company.mj_state_fk = mj_state.state_id Inner Join
								  mj_sector On _company.mj_sector_fk = mj_sector.sec_id Inner Join
								  mj_services On _company.mj_services_fk = mj_services.services_id
								Where
								  _company.ispublished = 1 And
								  _company.mj_sector_fk = '$searchsector' And
								  _company.mj_services_fk = '$searchProduct' And
								  _company.mj_state_fk = '$searchnetworkarea'";

								$rqTopRate = mysql_query($qTopRate);
								$rowqTopRate = mysql_num_rows($rqTopRate);

							}

							else if($searchsector != 0 && $searchProduct == 0 && $searchnetworkarea != 0){

							 
							 	 // search all selected
								 $qTopRate = "SELECT
								  _company.comp_name As mrket_post_title,
								  mj_state.state_name As fArea,
								  mj_sector.sec_name As fSec,
								  mj_services.services_name As fService,
								  _company.isfeatured As fFeatured,
								  _company.comp_pic As fPic,
  								  _company.comp_desc As fDesc,
  								  _company.comp_id As fPid
								From
								  _company Inner Join
								  mj_state On _company.mj_state_fk = mj_state.state_id Inner Join
								  mj_sector On _company.mj_sector_fk = mj_sector.sec_id Inner Join
								  mj_services On _company.mj_services_fk = mj_services.services_id
								Where
								  _company.ispublished = 1 And
								  _company.mj_sector_fk = '$searchsector' And
								  _company.mj_state_fk = '$searchnetworkarea'";

								$rqTopRate = mysql_query($qTopRate);
								$rowqTopRate = mysql_num_rows($rqTopRate);

							}
						
							
							if ($rowqTopRate == 0) {
								echo "No Founder founded.";
							} else {


							echo '<table>';
							while ($rowrqTop = mysql_fetch_object($rqTopRate)) {


							?>

							<tr>
								<td>
								<div style="padding: 10px 0px;">
								<div class="left" style="margin-right:20px;">
									<a href="profiles.php?pid=<?php echo $rowrqTop->fPid; ?>" title="">
									<div class="profile-pic48" style="background-image: url('<?php echo $rowrqTop->fPic; ?>');">
										
									</div><!-- /profile-pic48 -->
									</a>
								</div>
								<div class="right" style="width: 620px border:0px solid red;">
										<span>
											<a href="profiles.php?pid=<?php echo $rowrqTop->fPid; ?>" title="">
											<strong><?php echo ucwords($rowrqTop->mrket_post_title); ?></strong>
											</a>
										<?php

										/* is featured */
										if ($rowrqTop->fFeatured == 1) {
											echo "Featured Founder";
										}

										?>
										</span>
										<br/>

									<span><?php echo shortBrief($rowrqTop->fDesc); ?></span><br/>
									<span><?php echo ucwords($rowrqTop->fSec); ?> / <?php echo ucwords($rowrqTop->fService); ?> &middot; <?php echo ucwords($rowrqTop->fArea); ?></span><br/>
								</div><!-- /viewDetail -->
								<div class="clear"></div>
								</div>
								</td>
							</tr>

							<?php } }?>
						</table>
						<div class="clear"></div>

						<!-- /pagination -->
						<!-- /pagination -->

					</div>
				</div>

				<!-- /product view -->

				<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
					<strong class="none">Recommended for you</strong>
				</div><!-- /orange right -->

				<div class="clear"></div>


			</div>
		</div>
	</div>
</div>
	</div><!-- /contentContainer -->

</div><!-- /content -->

<!-- get current email -->
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />
<!-- /get current email -->

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
	/* /current email */
	
	
	$('ul.market-list li').hover(function(){
		
		$(this).find('.market-image-list').slideUp();

	},function(){
		
		$(this).find('.market-image-list').slideDown();

	});


	/* Change services */
	$('#searchsector').change(function(){

		var sectorID = $(this).val();
	

		$('#searchProduct').load('ajax/ajax-selectsector.php?sectorid='+sectorID);
		console.log(sectorID);
		

	});


});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>