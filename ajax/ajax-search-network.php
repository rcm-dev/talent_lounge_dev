<?php include '../db/db-connect.php'; ?>

<strong>Find Networks</strong>
<div id="findNetwork" style="padding: 20px 0px;">
	<form action="" accept-charset="utf-8">
	

		<input type="text" name="networkstring" id="networkstring" placeholder="keyword...">
		
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
		</select>

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
		</select>

		<input type="hidden" name="currname" id="currname" value="<?php echo $_GET['currname']; ?>" />

		<input type="submit" name="searchNetwork" id="searchNetwork" value="Search Network" />

	</form>
</div><!-- /findNetwork -->



<div id="searchResult" class="">
	
</div><!-- /searchResult -->


<!-- Search AJAX -->
<script type="text/javascript">

$(document).ready(function(){
	
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
			alert('enter keyword...');

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