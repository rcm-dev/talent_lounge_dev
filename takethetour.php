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
<div id="landingMain" style="border-top:1px solid rgba(0,0,0,.5); display:none">
	<div id="landingContainer" style="margin-top:20px;">
		
		<div class="left" style="border:0px solid red; width: 450px; padding:20px;">
			<h1 style="color: #fff; font-weight:normal">Meet your network, get connected, share, and grow your current business</h1>
			<h3 style="margin-top:20px; color:#CECFC7">Evolutionary new media avenues integrated in a single fluid technology platform for entrepreneurs and start-ups</h3>
		</div><!-- / -->

		<div class="right" style="border:0px solid green; width:480px;">
			<img src="images/social-tree.jpg" width="300px" />
		</div>
		<div class="clear"></div>
	</div>
</div><!-- /landingMain -->

<div id="contentContainer" style="padding:10px;">
	<div class="left" style="width:280px; padding:20px; display:none">
		<div class="left">
			<img src="images/cart2.png" />
		</div>
		<div class="right" style="width:220px;">
			<h3 class="bebasTitle">Buy &amp; Sell goods</h3>
			<p style="margin:10px 0px 30px 0px">A market place to identify and secure funding for ideas and projects among entrepreneurs, universities, funders and the private sector.</p>
		</div>
		<div class="clear"></div>

		<div class="left">
			<img src="images/world.png" />
		</div>
		<div class="right" style="width:220px;">
			<h3 class="bebasTitle">Connect &amp; Share</h3>
			<p style="margin:10px 0px 30px 0px">A community to connect, share, learn and collaborate   
        with other entrepreneurs. This also provides a tracking mechanism for entrepreneurs.
</p>
		</div>
		<div class="clear"></div>
	</div><!-- /1 -->

	<div class="left" style="width:280px; padding:20px; display:none">
		<div class="left">
			<img src="images/invent.png" />
		</div>
		<div class="right" style="width:220px;">
			<h3 class="bebasTitle">Invent &amp; Influence</h3>
			<p style="margin:10px 0px 30px 0px">A co-creation platform to invent, improve, influence and contribute in developing products and services among entrepreneurs</p>
		</div>
		<div class="clear"></div>

		<div class="left">
			<img src="images/folder-search-icon.png" />
		</div>
		<div class="right" style="width:220px;">
			<h3 class="bebasTitle">Identify Funding</h3>
			<p style="margin:10px 0px 30px 0px">A commercial trading hub to match-make on various technologies, tools and equipments for entrepreneurs.</p>
		</div>
		<div class="clear"></div>
	</div><!-- /2 -->

	<div class="left" style="width:300px; padding:20px; display:none">
		<p style="font-style:italic; font-family: Georgia; line-height:20px">
			"A good place for entrepreneurial growth with their current business and this platform also will expand business itself automatically.."<br><br>~Innovatis
		</p>
	</div><!-- /3 -->

	<div class="clear"></div>

	<div style="margin-top:0px; padding-top: 0px; border-top:1px dotted #ddd;">

		<div id="moreFeatures" style="margin:10px 0px 60px 0px; text-align:center">
			<h1><strong class="bebasTitle">Overview Talent Lounge</strong></h1>	
			<br>
			<div>
				<iframe id="ytplayer" type="text/html" width="640" height="390"
  src="http://www.youtube.com/embed/UvvkJrKKYF8"
  frameborder="0"></iframe>
			</div>
		</div><!-- /moreFeatures -->

		<div id="moreFeatures" style="margin:10px 0px 60px 0px; text-align:center">
			<h1><strong class="bebasTitle">More Features</strong></h1>	
		</div><!-- /moreFeatures -->
		
		<!-- Buy & Sell Good -->
		<div class="left" style="width: 255px; height: 185px; margin: 10px; border:1px solid #e1e1e1">
			<div>
				<img src="images/ownstore.png" width="236" height="178" style="background: #fff; width: 236px; height: 178px; padding:10px; overflow: hidden" />
			</div>
		</div>

		<div class="left" style="width: 650px; margin-left: 10px; padding: 20px;">
			<h1><strong style="color:#63A334">Buy &amp; Sell goods &middot; Personal Store, Tracking and more..</strong></h1><br>
			<p>
				You can sell anything to expand your current business to the world. Perfect dashboard to manage all the things you posted.
			</p>
		</div>
		<div class="clear"></div>
		<div style="height: 80px;"></div>
		<!-- /Buy & Sell Good -->



		<!-- Buy & Sell Good -->
		<div class="right" style="width: 255px; height: 185px; margin: 10px; border:1px solid #e1e1e1">
			<div>
				<img src="images/social.jpg" width="236" height="178" style="background: #fff; width: 236px; height: 178px; padding:10px; overflow: hidden" />
			</div>
		</div>

		<div class="right" style="width: 650px; margin-left: 10px; padding: 20px;">
			<h1><strong style="color:#63A334">A commercial trading hub to match-make on various technologies, tools and equipments</strong></h1><br>
			<p>
				A small network will become a big network when you get connected with this platform.
			</p>
		</div>
		<div class="clear"></div>
		<div style="height: 80px;"></div>
		<!-- /Buy & Sell Good -->


		<!-- Buy & Sell Good -->
		<div class="left" style="width: 255px; height: 185px; margin: 10px; border:1px solid #e1e1e1">
			<div>
				<img src="images/product.jpg" width="236" height="178" style="background: #fff; width: 236px; height: 178px; padding:10px; overflow: hidden" />
			</div>
		</div>

		<div class="left" style="width: 650px; margin-left: 10px; padding: 20px;">
			<h1><strong style="color:#63A334">Co-creation platform to invent, improve, influence and contribute</strong></h1><br>
			<p>
				Share resources and cross market products and services on new projects and business models.
			</p>
		</div>
		<div class="clear"></div>
		<div style="height: 80px;"></div>
		<!-- /Buy & Sell Good -->


		<!-- Buy & Sell Good -->
		<div class="right" style="width: 255px; height: 185px; margin: 10px; border:1px solid #e1e1e1">
			<div>
				<img src="images/project.jpg" width="236" height="178" style="background: #fff; width: 236px; height: 178px; padding:10px; overflow: hidden" />
			</div>
		</div>

		<div class="right" style="width: 650px; margin-left: 10px; padding: 20px;">
			<h1><strong style="color:#63A334">A market place to identify and secure funding for ideas and projects</strong></h1><br>
			<p>
				Entrepreneurs trade online for the technology, tools and equipment
			</p>
		</div>
		<div class="clear"></div>
		<div style="height: 80px;"></div>
		<!-- /Buy & Sell Good -->


	</div><!-- / -->
</div>

<!-- page title -->
<input type="hidden" name="page_title" value="Take the tour" id="page_title" />

<?php  

/* Include header */
include 'footer.php';

?>