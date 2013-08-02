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
<div id="contentContainer" style="padding:30px">
	
	<div class="left">
		
	</div>
	<div class="left" style="">
		<h1 class="heading_title" style="margin-top:20px !important;">How-to New Post</h1>
	</div>
	<div class="clear"></div>

	<br>
	<p><span><h2>Mojo Idea How-to Section</h2></span></p>
	<p><br/></p>
	<p>
		<iframe width="640" height="360" src="http://www.youtube.com/embed/F2OpFG_RWaI?rel=0" frameborder="0" allowfullscreen></iframe>
	</p>
<p><strong><br /></strong></p>

<p>Step &nbsp1 &nbsp;&nbsp: <span><strong> Sign in to your account</strong></span><br />Step &nbsp2 &nbsp;&nbsp: <strong> Click on Idea Section</strong><br />Step &nbsp3 &nbsp;&nbsp: <strong> Click on New Idea</strong><br />Step &nbsp4 &nbsp;&nbsp:<strong> Fill up the form</strong><br />Step &nbsp5 &nbsp;&nbsp:<strong> Click on Preview button</strong><br />Step &nbsp6 &nbsp;&nbsp: <strong> Review your post</strong><br />Step &nbsp7 &nbsp;&nbsp: <strong> Click on Submit & Upload Visual button</strong><br />Step &nbsp8 &nbsp;&nbsp:<strong> Click on Select Files button</strong><br />Step &nbsp9 &nbsp;&nbsp: <strong> Choose your images</strong><br />Step 10 &nbsp;: <strong> Return to your Idea dashboard</strong><br />Step 11 &nbsp;: <strong> Look for your newly submitted Idea</strong><br />Step 12 &nbsp;: <strong> Click on Edit</strong><br />Step 13 &nbsp;: <strong> Click on Pictures</strong><br />Step 14 &nbsp;: <strong> Click on Set Default Image button</strong><br />Step 15 &nbsp;: <strong> Done!</strong><br /> </p>
<p>&nbsp;</p>
<p><span><h2>Mojo Funding How-to Section</h2></span></p>
<p><br/></p>
	<p>
		<iframe width="640" height="360" src="http://www.youtube.com/embed/nSkbRQ4GflI?rel=0" frameborder="0" allowfullscreen></iframe>
	</p>
<p><strong><br /></strong></p>
<p>Step &nbsp1 &nbsp;&nbsp:<strong> Sign in to your account</strong><br />Step &nbsp2 &nbsp;&nbsp;: <strong> Click on Project/Funding Section</strong><br />Step &nbsp3 &nbsp;&nbsp;:<strong> Click on Submit Project</strong><br />Step &nbsp4 &nbsp;&nbsp;: <strong> Fill up the form</strong><br />Step &nbsp5 &nbsp;&nbsp;: <strong> Click Review your details button</strong><br />Step &nbsp6 &nbsp;&nbsp;: <strong> Review your post</strong><br />Step &nbsp7 &nbsp;&nbsp;: <strong> Click on Submit Project Now</strong><br />Step &nbsp8 &nbsp;&nbsp;: <strong> Click on Pictures</strong><br />Step &nbsp9 &nbsp;&nbsp;: <strong> Click on Select Files button</strong><br />Step 10 &nbsp;: <strong> Choose your images</strong><br />Step 11 &nbsp;: <strong> Return to your Funding dashboard</strong><br />Step 12 &nbsp;: <strong> Look for your newly submitted Funding</strong><br />Step 13 &nbsp;: <strong> Click on Edit</strong><br />Step 14 &nbsp;: <strong> Click on Pictures</strong><br />Step 15 &nbsp;: <strong> Click on Set Default Image button</strong><br />Step 16 &nbsp;: <strong> Done!</strong></p>
<p>&nbsp;</p>
<p><span><h2>Mojo Market How-to Section</h2></span></p>
<p><br/></p>
	<p>
		
		<iframe width="640" height="360" src="http://www.youtube.com/embed/QEUMFQEOo0c?rel=0" frameborder="0" allowfullscreen></iframe>
	</p>
<p><strong><br /></strong></p>
<p>Step &nbsp1 &nbsp;:&nbsp;<strong> Sign in to your account</strong><br />Step &nbsp2 &nbsp;&nbsp: <strong> Click on Buy & Sell Goods</strong><br />Step &nbsp3 &nbsp;&nbsp: <strong> Click on Insert Free Ads</strong><br />Step &nbsp4 &nbsp;&nbsp:<strong> Fill up the form</strong><br />Step &nbsp5 &nbsp;&nbsp:<strong> Click on Submit button</strong><br />Step &nbsp6 &nbsp;&nbsp:<strong> Click on Select Files button</strong><br />Step &nbsp7 &nbsp;&nbsp:<strong> Choose your images</strong><br />Step &nbsp8 &nbsp;&nbsp:<strong> Return to your Market dashboard</strong><br />Step &nbsp9 &nbsp;&nbsp:<strong> Look for your newly submitted Item</strong><br />Step 10 &nbsp;:<strong> Click on Edit</strong><br />Step 11 &nbsp;:<strong> Click on Pictures</strong><br />Step 12 &nbsp;:<strong> Click on Select Default Image button</strong><br />Step 13 &nbsp;:<strong> Done!</strong></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><strong><br /></strong></p>
</div>


<!-- Page Title -->
<input type="hidden" name="page_title" value="How to new post" id="page_title" />

<?php  

/* Include header */
include 'footer.php';

?>