<?php  

/* Include header */
include 'header.php';

// get param
$page_id    = @$_GET['page_id'];
$page_title = @$_GET['page_title'];

// SQL Page
$q_page    = "SELECT * FROM mj_pages WHERE page_id = '$page_id'";
$exec_page = mysql_query($q_page);
$obj_page = mysql_fetch_object($exec_page);

// assign object
$curr_page_title = $obj_page->page_title;
$curr_page_content = $obj_page->page_content;


?>
<div id="contentContainer">
	
	<div class="left">
	
	</div>
	<div class="left" style="margin-top:50px;">
		<h1 class="heading_title bebasTitle" style="margin-top:20px !important;"><?php echo $curr_page_title; ?></h1>
	</div>
	<div class="clear"></div>

	<br>
	<?php echo $curr_page_content; ?>
	
</div>


<!-- Page Title -->
<input type="hidden" name="page_title" value="<?php echo $curr_page_title; ?>" id="page_title" />

<?php  

/* Include header */
include 'footer.php';

?>