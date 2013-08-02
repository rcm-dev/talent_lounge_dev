<?php  


include 'header.php';
include 'class/short.php';


?>


<div id="mojo-container">

	<div class="container_24">
		<div class="home_container">
			<div class="home_box">

				<div class="bottom-gap">
				<div class="title-left left">
					<img src="images/cart-icon.png">
				</div>

				<div class="title-right right">
				<h1 class="title">To Get what you think is suitable for you. <a href="browse-market.php">Browse</a></h1>
				<p style="text-align:left" class="bottom-gap">Featured ads post by community. Something to sell? <a href="new-ads.php" class="button green">New Ads now</a> 
				<a href="#" title="Create Store - onGoing">Create Store</a></p>
				</div>
				<div class="clear"></div>
				</div>

				

				<br/>
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

							 $qTopRate = "SELECT mj_market_post.*,
							       mj_market_category.mrket_cat_name,
							       mj_users.*,
							       mj_users.usr_name AS Uploader,
							       mj_state.state_name,
							       mj_market_post.mrket_post_body AS mrket_desc
							FROM mj_market_post
							INNER JOIN mj_users ON mj_market_post.mrket_usr_id_fk = mj_users.usr_id
							INNER JOIN mj_market_category ON mj_market_post.mrket_cat_id_fk = mj_market_category.mrket_cat_id
							INNER JOIN mj_state ON mj_market_post.mrket_state_id_fk = mj_state.state_id LIMIT 0,
							                                                                                  10";
							

							$rqTopRate = mysql_query($qTopRate);
							
							while ($rowrqTop = mysql_fetch_object($rqTopRate)) {

							?>

							<li>
								<a href="product-details.php?id=<?php echo $rowrqTop->mrket_post_id; ?>">
								<div class="market-dis-container">

									<div style="border:0px solid red; height: 130px; overflow: hidden">
									
									<div class="market-image-list">
									<img src="<?php echo $rowrqTop->mrket_post_picture; ?>" width="150px" />
									</div>

									<!-- Description -->
									<div class="mrket-slide" style="width: 140px; height:130px; border: 0px solid #ddd; background: #eee; padding: 5px;">
										<p><?php echo shortBrief($rowrqTop->mrket_desc); ?></p>
										<small><?php echo date("g:i a F j, Y ", strtotime($rowrqTop->market_dateposted)); ?></small>
									</div>
									<!-- /Description -->

									</div>


									<h3 class="price"><sup>RM</sup> 
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

									?></h3>
									<div class="market_misc"><?php echo $rowrqTop->mrket_post_title; ?></div>
								</div>
								</a>
								</li>

							<?php } ?>
						</ul>
						<div class="clear"></div>

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