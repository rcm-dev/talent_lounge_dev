<?php  


include 'header.php';
include 'db/db-connect.php';


$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_id,
  mj_users.usr_name As currName,
  mj_users.usr_workat,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo
From
  mj_users
Where
  mj_users.usr_id = '$usr_id'";

$rusrSQL = mysql_query($usrSQL);
$rowusrSQL = mysql_fetch_object($rusrSQL);

?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" >

		<div class="heading">
			<h1 class="heading_title bebasTitle">Search Network</h1>
		</div>

		<div class="left cnscontainer">

			
			<div style="border:0px solid green;">
				
				<div class="post-status none">
						
					<form action="#" method="get" accept-charset="utf-8">

						<div>
							<input type="hidden" name="currID" id="currID" value="<?php echo $usr_id; ?>" />
						</div>	

					</form><!-- post-status-form -->
					
				</div><!-- /.post-status -->

				

			</div>

			<div class="white" style="border-top:0px solid #cccccc; padding:10px">
				
				<!-- CHange Action -->

				<div id="connect-container">
					

					<strong>Find Network in malaysia</strong>

					<div id="findNetwork" style="padding: 20px 0px;">
					<form action="" accept-charset="utf-8">
					

						<input type="text" name="networkstring" id="networkstring" placeholder="keyword..."><br><br>
						
						<select name="searchsector" id="searchsector">
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

						<select name="searchProduct" id="searchProduct">
							<option value="0">All Product / Services</option>
						</select><br><br>

						<select name="searchnetworkarea" id="searchnetworkarea">
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
									<?php echo $rowstat->stateName; ?></option>
						
							<?php } ?>
						</select><br><br>
						<input type="hidden" name="currname" id="currname" value="<?php echo $_GET['currname']; ?>" />

						<input type="submit" name="searchNetwork" id="searchNetwork" class="button green" value="Search Network" />

					</form>
				</div><!-- /findNetwork -->



				<div id="searchResult" class="">
					
				</div><!-- /searchResult -->

				</div>

				<!-- /CHange Action -->

			</div>


		</div><!-- /orange left -->

		<!-- sidebar-connect n share -->

		<?php include 'sidebar-social.php'; ?>

		<!-- /sidebar-connect n share -->

		<div class="clear"></div>


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

	// Search Network
	$('#searchNetwork').click(function(){
		
		//alert('click');

		// get val()
		var searchsector      = $('#searchsector').val();
		var searchProduct     = $('#searchProduct').val();
		var searchnetworkarea = $('#searchnetworkarea').val();
		var networkstring	  = $('#networkstring').val();
		var currname	  	  = $('#currname').val();


		if (networkstring == '') {
			
			// alert
			$.jnotify("Enter your keyword such as friend name or sector or etc.", "error");

		} else {
		

			// dataString
			var dataString = 'networkstring='+networkstring+'&searchsector=' + searchsector + '&searchProduct=' + searchProduct + '&searchnetworkarea=' + searchnetworkarea + '&currname=' + currname;
			
			console.log(dataString);


			$('#searchResult').html('loading....').fadeIn().load('ajax/ajax-search-network-result.php?'+dataString);
			return false;

		}
		
		//console.log(searchsector+' - '+searchProduct+' - '+searchnetworkarea);

		return false;

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