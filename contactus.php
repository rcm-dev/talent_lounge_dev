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
			<h1 style="color: #fff; font-weight:normal">The best way to growth with your current bussiness. Meet your network around the world and get connected.</h1>
			<h3 style="margin-top:20px; color:#CECFC7">Evolutionary new media avenues integrated in a single fluid technology platform for entrepreneurs and start-ups</h3>
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
	<div class="left" style="">
		<h1 class="heading_title" style="margin-top:20px !important;">Contact Us</h1>
	</div>
	<div class="clear"></div><br><br>

	<!-- Contact Us content begin here -->
	
	<p>Innovatis Sdn Bhd</p>
	<p>B201, Block B, Level 2</p>
	<p>Phileo Damansara II, 15, Jalan 16/11</p>
	<p>46350, Petaling Jaya, Selangor, Malaysia.</p>
	<p>Tel  : +6.03.7665.0607  Fax  : +6.03.7665.0610</p></br>
	<p>www.innovatis.com.my</p>

	<!-- Contact Us content end here -->
</div>

<!-- page title -->
<input type="hidden" name="page_title" value="Contact Us" id="page_title" />

<?php  

/* Include header */
include 'footer.php';

?>