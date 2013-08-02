<?php  


include 'header.php';
include 'db/db-connect.php';


?>


<div id="mojo-container">

	<div class="container_24">
		<div class="home_container">
			<div class="home_box">

				<div>
					<form class="inline center" method="get" action="search-market.php">
						Looking for : 
						<input type="text" name="prod_search" class="title" placeholder="keywords.."/>

						Category
						<select name="market_category">
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

							echo '<option value="0" style="background:#ddd;">All Category</option>';
							while ($rowqCat = mysql_fetch_object($rqCat)) {
			
							?>
							<option value="<?php echo $rowqCat->catId; ?>"><?php echo $rowqCat->catName; ?>
							</option>
							<?php } ?>
						</select>

						Area
						<select name="market_area">
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

						<input type="submit" name="submit_prod" class="medium button green" style="border:0px solid #ddd;" value="SEARCH" />
					</form>
				</div>
				
				<br/><br/>

				<!-- product view -->
				<div>
					<div class="market-item-container">
						<ul class="market-list">
							
						
							<?php  
							
							/**
							 * Loop Top Rate Market
							 * 
							 */

							 include 'db/db-connect.php';

							 $qTopRate = "SELECT
							  mj_market_post.*,
							  mj_market_category.mrket_cat_name,
							  mj_users.*,
							  mj_users.usr_name AS Uploader,
							  mj_state.state_name
							FROM
							  mj_market_post INNER JOIN
							  mj_users On mj_market_post.mrket_usr_id_fk = mj_users.usr_id INNER JOIN
							  mj_market_category On mj_market_post.mrket_cat_id_fk =
							    mj_market_category.mrket_cat_id INNER JOIN
							  mj_state On mj_market_post.mrket_state_id_fk = mj_state.state_id
							  ORDER BY mj_market_post.mrket_post_id DESC
							  LIMIT 0, 10";
							

							$rqTopRate = mysql_query($qTopRate);
							
							while ($rowrqTop = mysql_fetch_object($rqTopRate)) {

							?>

							<li>
							<a href="product-details.php?id=<?php echo $rowrqTop->mrket_post_id; ?>">
							<div class="market-dis-container">

									<div style="border:0px solid red; height: 130px; overflow: hidden">
									
									<div class="market-image-list">
									<img src="<?php echo $rowrqTop->mrket_post_picture; ?>" height="130px" width="150px" />
									</div>

									<!-- Description -->
									<div class="mrket-slide" style="width: 140px; height:130px; border: 0px solid #ddd; background: #eee; padding: 5px;">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
										tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
										<small><?php echo date("g:i a F j, Y ", strtotime($rowrqTop->market_dateposted)); ?></small>
									</div>
									<!-- /Description -->

									</div>


									<h3 class="price"><sup>RM</sup> <?php echo number_format($rowrqTop->mrket_price); ?></h3>
									<div class="market_misc"><?php echo $rowrqTop->mrket_post_title; ?></div>
								</div>
								</a>
								</li>

							<?php } ?>
						</ul>
						<div class="clear"></div>

						<!-- Pagination -->
						<!-- /Pagination -->

					</div>
				</div>

				<!-- /product view -->


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