<?php  

/* Include header */
include 'header.php';


// Set page title
$page_name = "Pricing & Charge";

// assign object
$curr_page_title = $page_name;


?>
<div id="contentContainer" style="padding:30px">
	
	<div class="left">
		
	</div>
	<div class="left" style="">
		<h1 class="heading_title bebasTitle" style="margin-top:20px !important;">
		<?php echo $page_name; ?></h1>
	</div>
	<div class="clear"></div>

	<br>
	<p>
		Pricing base on package and other services.
	</p>

	<br><br>

	<div class="ui-window">
		
		<img src="images/pricing.png" alt="pricing">

		<br><br>

	</div>
	
</div>


<!-- Page Title -->
<input type="hidden" name="page_title" value="<?php echo $curr_page_title; ?>" id="page_title" />

<?php  

/* Include header */
include 'footer.php';

?>