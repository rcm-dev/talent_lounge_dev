<?php  

/* Include header */
include 'header.php';


// Set page title
$page_name = "Page Name Title";

// assign object
$curr_page_title = $page_name;


?>
<div id="contentContainer" style="padding:30px">
	
	<div class="left">
		
	</div>
	<div class="left" style="">
		<h1 class="heading_title" style="margin-top:20px !important;">
		<?php echo $page_name; ?></h1>
	</div>
	<div class="clear"></div>

	<br>
	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia quos deleniti impedit sequi minus aperiam aliquid earum delectus incidunt numquam voluptas debitis quibusdam. Molestias maxime pariatur ipsam dignissimos expedita quam.
	</p>
	<br><br>

	<div class="ui-window">
		<p>
			use css class <strong>.ui-window</strong> to any div to make div have some box rounded styling
		</p>
	</div>
	
</div>


<!-- Page Title -->
<input type="hidden" name="page_title" value="<?php echo $curr_page_title; ?>" id="page_title" />

<?php  

/* Include header */
include 'footer.php';

?>