<?php  


include '../db/db-connect.php';

$getSectorId 	= $_GET['sectorid'];


$qser          	= "SELECT
  mj_services.services_name As ServisName,
  mj_services.services_id As servisID,
  mj_services.sector_id_fk
From
  mj_services
Where
  mj_services.sector_id_fk = '$getSectorId'";


$resultser     	= mysql_query($qser);
$numrowSecto	= mysql_num_rows($resultser);

	if ($numrowSecto != 0 ) {


		echo '<option value="0">All Product / Services</option>';
		while ($rowser 	= mysql_fetch_object($resultser)) { ?>
		
			<option value="<?php echo $rowser->servisID; ?>">
			<?php echo ucwords($rowser->ServisName); ?></option>

<?php 

		}

		} else { ?>


		<option value="0">All Product / Services</option>

<?php 
	
	}

?>