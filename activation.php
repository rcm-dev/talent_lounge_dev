<?php include 'header-plain.php'; ?>
	<div id="mojo-showcase" class="front">
		<div id="mojo-showcase-subcontainer" class="container_24">
			<div id="mojo-showcase-container" class="grid_24">


				<div>
					<h1>Activation</h1>

					<?php  

					/**
					 * 
					 * Activation
					 */

					 include 'db/db-connect.php';

					 $user_id 	= $_GET['uid'];
					 $cnfrm_key	= $_GET['confirmkey'];

					 $activeSQL = "UPDATE  mj_users SET usr_acct_status = '1' WHERE usr_id = '$user_id' AND usr_cnfm_key = '$cnfrm_key'";
					 
					 $resultActive = mysql_query($activeSQL);
					 $numrowActive = mysql_affected_rows();

					 if ($numrowActive == 1) {
					 	
					 	echo "Activation Succesfull. Login <a href=\"index.php\">Here</a>";

					 } else {
					 	
					 	echo "There have an error to activate your account.";
					 }


					?>

				</div>

			</div>
			<div class="clear"></div>
		</div>
	</div><!-- /showcase -->
<?php include 'footer-plain.php'; ?>