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
		<img src="images/icon-life-saver.png" />
	</div>
	<div class="left" style="margin-left: 20px;">
		<h1 class="heading_title" style="margin-top:20px !important;">Why Advertise on MOJO?</h1>
	</div>
	<div class="clear"></div>

	<br>
	<p>
		<strong>Get a started</strong><br>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</p><br>
</div>


<!-- Page Title -->
<input type="hidden" name="page_title" value="Advertise with us" id="page_title" />

<?php  

/* Include header */
include 'footer.php';

?>