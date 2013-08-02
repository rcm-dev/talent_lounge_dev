<?php  


include 'header.php';
include 'db/db-connect.php';


$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_id
From
  mj_users
Where
  mj_users.usr_id = '$usr_id'";

$rusrSQL = mysql_query($usrSQL);
$rowusrSQL = mysql_fetch_object($rusrSQL);

?>


<div id="mojo-container">
	
	<div class="container_24">
		<div class="home_container">
			<div class="mj-network-home grid_16 left alpha">
				
				<div class="network-left" style="border:1px solid #333; float:left; width:200px">
					
					<div class="mj-profile">
						<div class="leftprofile">
							<div style="overflow:hidden; width:64px; height:64px; text-align: center">
							<img src="<?php echo $rowusrSQL->usrPicture; ?>" class="height: auto; width: 100%;" width="64" />
							</div>
						</div>
						<div class="name">
						<strong><?php echo ucfirst($usr_name); ?></strong><br/>
						<a href="#" class="yhover" id="psetting">setting</a>
						</div>
						<div class="clear"></div>
					</div>

					<div class="network-menu-title">
						<div><strong>Favorites</strong></div>
					</div>
						
					<div>
						<ul>
							<li>
								<div class="icn msg"></div>
								<a href="#" id="call-message">Message</a></li>
							<li>
								<div class="icn frd"></div>
								<a href="#" id="call-friends">Friends</a></li>
							<li>
								<div class="icn ntwk"></div>
								<a href="#" id="call-network">Network</a></li>
							<li>
								<div class="icn learn"></div>
								<a href="article.php" id="call-learn">Learn</a></li>
						</ul>
					</div>

					<div class="network-menu-title">
						<div><strong>Quick Access</strong></div>
					</div>

					<div>
						<ul>
							<li>
								<div class="icn idea"></div>
								<a href="submit-idea.php">Submit Idea</a></li>
							<li>
								<div class="icn proj"></div>
								<a href="submit-project.php">Submit Project</a></li>
							<li>
								<div class="icn ntworkmarket"></div>
								<a href="market.php">Market</a></li>
						</ul>
					</div>

					

				</div>

				<div style="border:0px solid #333; float:right; width:410px; padding:5px;">
					
					<!-- CHange Action -->

					<div id="connect-container">
						Last Activity
						<a href="<?php echo $rowusrSQL->usrPicture; ?>" id="example1">
						<img src="<?php echo $rowusrSQL->usrPicture; ?>" class="height: auto; width: 100%;" width="64" />
						</a>
					</div>

					<!-- /CHange Action -->
				</div>

				<div class="clear"></div>

			</div>

			<div class="mj-network-home grid_8 right">
				
				<div class="random-article">

					<div>
					<h3>Business Ideas / Articles</h3>

					<ul>

					<?php

					/*----------------------------------------------------*/
					/**
					 * Random Article limit 5
					 */

					 $sqlRndmArticle = "SELECT * FROM mj_learn_article ORDER BY RAND() LIMIT 5";
					 $sqlRndmResult	 = mysql_query($sqlRndmArticle);

					 while ($rowRndmArticle = mysql_fetch_object($sqlRndmResult)) {
				 		echo '<li><a href="article-view.php?aid='.$rowRndmArticle->la_id.'">'.$rowRndmArticle->la_title.'</a></li>';
					 }

					?>

					</ul>
					</div>


					<div>
					<h3>Mojo Suggestion</h3>

					<ul>

					<?php

					/*----------------------------------------------------*/
					/**
					 * Mojo Suggestion article
					 */

					 /*$sqlRndmArticle = "SELECT * FROM mj_learn_article ORDER BY RAND() LIMIT 5";
					 $sqlRndmResult	 = mysql_query($sqlRndmArticle);

					 while ($rowRndmArticle = mysql_fetch_object($sqlRndmResult)) {
				 		echo '<li><a href="article-view.php?aid='.$rowRndmArticle->la_id.'">'.$rowRndmArticle->la_title.'</a></li>';
					 }*/

					?>
					<li>Get from user interest</li>
					</ul>
					</div>



					<div>
					<h3>Did you know?</h3>

					<ul>

					<?php

					/*----------------------------------------------------*/
					/**
					 * Did you know
					 */

					 /*$sqlRndmArticle = "SELECT * FROM mj_learn_article ORDER BY RAND() LIMIT 5";
					 $sqlRndmResult	 = mysql_query($sqlRndmArticle);

					 while ($rowRndmArticle = mysql_fetch_object($sqlRndmResult)) {
				 		echo '<li><a href="article-view.php?aid='.$rowRndmArticle->la_id.'">'.$rowRndmArticle->la_title.'</a></li>';
					 }*/

					?>
					<li>Help / tips to users</li>
					</ul>
					</div>

				</div>

			</div>

			<div class="clear"></div>
		</div>
	</div>

	<div class="container_24"><a href="logout.php">Logout</a></div>
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
	
	$("a#example1").fancybox({
		'overlayColor'		: '#000',
		'overlayOpacity'	: 0.9

	});

});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>