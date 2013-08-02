<?php  


include 'header.php';


?>


<div id="mojo-container">

	<div class="container_24">
		<div><h1 class="title">Insert new ads</h1></div>
		<div class="home_container">
			<div class="home_box mj-full">
				


				<div id="#mojo-market" style="border:0px solid #ddd; padding:10px;">

					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</p>

					<form action="ads-submited.php" enctype="multipart/form-data" method="post">
						<label>Heading</label>
						<input type="text" class="title" name="market_title" />

						<label>Category</label><br/>
						<select name="market_category">
							<?php

							include 'db/db-connect.php'; 

							$q_idea_cat = "SELECT * FROM mj_market_category";
							$rslt_idea = mysql_query($q_idea_cat);

							while ($rowIdCat = mysql_fetch_object($rslt_idea)) {
								
								echo '<option value="'.$rowIdCat->mrket_cat_id.'">'.ucwords($rowIdCat->mrket_cat_name).'</option>';
							}

							?>
						</select><br/><br/>

						<label>Area / Region</label><br/>
						<select name="market_area">
							<?php


							$sState = "SELECT * FROM mj_state";
							$rState = mysql_query($sState);

							while ($rowState = mysql_fetch_object($rState)) {
								
								echo '<option value="'.$rowState->state_id.'">'.ucwords($rowState->state_name).'</option>';
							}

							?>
						</select><br/><br/>

						<label>Description</label>
						<textarea name="market_desc" id="market_desc" class="market"></textarea>
						<br/><br/>

						<label>Cost</label><br/>
						<input name="market_price" id="market_price" class="title" /><br><br>

						<label>Add Picture</label>
						<input type="file" name="market_pricture" /><br><br/>
						<a href="#" title="Multiple Upload - [onGoing]">Multiple Upload</a><br/><br/>

						<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
						<input type="hidden" name="user_id" value="<?php echo $usr_id; ?>" />
						<input type="submit" name="market_submit" />
					</form>

				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>


<div id="mojo-copyright">
		<div class="mojo-footer-subcontainer container_24">
			<div class="grid_4">
				<p>Mojo &copy; <?php echo date('Y'); ?></p>
			</div>
			<div class="mj-footer-link grid_20 omega">
				<p><a href="#">Privacy</a> &middot; <a href="#">Term</a> &middot; <a href="#">Help</a></p>
			</div>
			<div class="clear"></div>
		</div>
</div><!-- /copyright -->


<script type="text/javascript">
$(document).ready(function(){
	
	$('label').css('display', 'block');

});
</script>
<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>