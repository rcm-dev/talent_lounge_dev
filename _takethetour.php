<?php  

/* Include header */
include 'header.php';
include 'class/short.php';

function shortUpdate($text) { 

        // Change to the number of characters you want to display 
        $chars = 90; 

        $text = $text." "; 
        $text = substr($text,0,$chars); 
        $text = substr($text,0,strrpos($text,' '));

        if ($chars > 90) {
        	$text = $text."...";
        }
        else {
        	$text = $text."";
        }

         

        return $text; 

    }

?>
<div id="landingMain" style="border-top:1px solid rgba(0,0,0,.5);">
	<div id="landingContainer" style="margin-top:20px;">
		
		<div class="left" style="border:0px solid red; width: 450px; padding:20px;">
			<h1 style="color: #fff; font-weight:normal">The best way to growth with your current bussiness. Meet your network around the world and get connected.</h1>
			<h3 style="margin-top:20px; color:#CECFC7">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. <br>Ut enim ad minim veniam,
			quis nostrud exercitation ullamco <br>laboris nisi ut aliquip ex ea commodo
			consequat.</h3>
		</div><!-- / -->

		<div class="right" style="border:0px solid green; width:480px;">
			<video id="my_video_1" class="video-js vjs-default-skin" controls
			  preload="auto" width="430" height="248" poster="images/datacover.jpg"
			  data-setup="{}">
			  <source src="vid/The-Value-of-Data-Visualization.mp4" type='video/mp4'>
			</video>
		</div>
		<div class="clear"></div>
	</div>
</div><!-- /landingMain -->

<div id="contentContainer" style="padding:10px">
	<div class="left" style="width:280px; padding:20px;">
		<div class="left">
			<img src="images/cart2.png" />
		</div>
		<div class="right" style="width:220px;">
			<h3>Buy &amp; Sell goods</h3>
			<p style="margin:10px 0px 30px 0px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. <a href="#" title="more" style="color:#164FAD">more</a></p>
		</div>
		<div class="clear"></div>

		<div class="left">
			<img src="images/world.png" />
		</div>
		<div class="right" style="width:220px;">
			<h3>Connect &amp; Share</h3>
			<p style="margin:10px 0px 30px 0px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. <a href="#" title="more" style="color:#164FAD">more</a></p>
		</div>
		<div class="clear"></div>
	</div><!-- /1 -->

	<div class="left" style="width:280px; padding:20px;">
		<div class="left">
			<img src="images/invent.png" />
		</div>
		<div class="right" style="width:220px;">
			<h3>Invent &amp; Influence</h3>
			<p style="margin:10px 0px 30px 0px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. <a href="#" title="more" style="color:#164FAD">more</a></p>
		</div>
		<div class="clear"></div>

		<div class="left">
			<img src="images/folder-search-icon.png" />
		</div>
		<div class="right" style="width:220px;">
			<h3>Identify &amp; Secure Funding</h3>
			<p style="margin:10px 0px 30px 0px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. <a href="#" title="more" style="color:#164FAD">more</a></p>
		</div>
		<div class="clear"></div>
	</div><!-- /2 -->

	<div class="left" style="width:300px; padding:20px;">
		<p style="font-style:italic; font-family: Georgia; line-height:20px">
			"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua."<br><br>~Mahfudz
		</p>
	</div><!-- /3 -->

	<div class="clear"></div>

	<div style="margin-top:20px; padding-top: 20px; border-top:1px dotted #ddd;">

		<div id="moreFeatures" style="margin:10px 0px 60px 0px; text-align:center">
			<h1><strong>More Features</strong></h1>	
		</div><!-- /moreFeatures -->
		
		<!-- Buy & Sell Good -->
		<div class="left" style="width: 270px; height: 190px; margin: 10px; border:1px solid #e1e1e1">
			<div>
				<img src="images/ownstore.png" width="250" style="background: #fff; width: 250px; height: 190px; padding:10px; overflow: hidden" />
			</div>
		</div>

		<div class="left" style="width: 650px; margin-left: 10px; padding: 20px;">
			<h1><strong style="color:#63A334">Buy &amp; Sell goods &middot; Personal Store, Tracking and more..</strong></h1><br>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>
		</div>
		<div class="clear"></div>
		<div style="height: 80px;"></div>
		<!-- /Buy & Sell Good -->



		<!-- Buy & Sell Good -->
		<div class="right" style="width: 270px; height: 190px; margin: 10px; border:1px solid #e1e1e1">
			<div>
				<img src="images/ownstore.png" width="250" style="background: #fff; width: 250px; height: 190px; padding:10px; overflow: hidden" />
			</div>
		</div>

		<div class="right" style="width: 650px; margin-left: 10px; padding: 20px;">
			<h1><strong style="color:#63A334">Buy &amp; Sell goods &middot; Personal Store, Tracking and more..</strong></h1><br>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>
		</div>
		<div class="clear"></div>
		<!-- /Buy & Sell Good -->



	</div><!-- / -->
</div>

<!-- page title -->
<input type="hidden" name="page_title" value="Take the tour" id="page_title" />

<?php  

/* Include header */
include 'footer.php';

?>