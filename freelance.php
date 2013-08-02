<?php  

/* Include header */
include 'header.php';


// Set page title
$page_name = "Freelance";

// assign object
$curr_page_title = $page_name;



/****************************
 *
 * Record Set for FLCategories 
 * MySQL Info 
 * Table Used FLCategories
 *
 ***************************/

$query_rsFLCategories = "SELECT * FROM f_categories";
$result_rsFLCategories = mysql_query($query_rsFLCategories);
$total_rows_rsFLCategories = mysql_num_rows($result_rsFLCategories);



/****************************
 *
 * Record Set for FLists 
 * MySQL Info 
 * Table Used FLists
 *
 ***************************/

$query_rsFLists = "SELECT * FROM f_lists INNER JOIN f_categories ON f_lists.f_categories_id_fk = f_categories.fc_id";
$result_rsFLists = mysql_query($query_rsFLists);
$total_rows_rsFLists = mysql_num_rows($result_rsFLists);






?>
<?php include 'quickpost.php'; ?>
<div id="contentContainer" style="padding:30px">
	
	<div class="left">
		
	</div>
	<div class="left" style="">
		<h1 class="heading_title bebasTitle" style="margin-top:20px !important;">
		<?php echo $page_name; ?></h1>
	</div>
	<div class="clear"></div>
	<p>
		Hire online for a fraction of the cost! Malaysians outsourcing marketplace, employer, entrepreneurs, &amp; small business around malaysia.
	</p>

	<br><br>
	<p>
		<h3>Recents Jobs</h3>
	</p>
	<div>
		<br>
		<?php 
		
		/***
		 *  show no data rsFLists
		 **/
		
		if($total_rows_rsFLists == 0) { ?>
		
			<p>No Data</p>
		
		<?php } else { // End If no data for rsFLists ?>
		
		
		<ul id="freelancer-list">
			<?php 
		
			/***
			 *  show data rsFLists
			 **/
		
			while($row_rsFLists = mysql_fetch_object($result_rsFLists)) { ?>
				
				<li>
					<div style="padding: 20px; background: #F1C40F; height: 100px;">
						<a href="freelance-viewjob.php?jid=<?php echo $row_rsFLists->fl_id; ?>&cuid=<?php echo $_SESSION['MM_UserID']; ?>">
							<h2><?php echo $row_rsFLists->fl_jobtitle; ?></h2>
						</a>
						<p>
							<?php echo $row_rsFLists->fl_desc; ?>
						</p>
					</div>
					<div style="background: #F39C12; padding: 20px; height: 40px;">
						<?php  

						/****************************
						 *
						 * Record Set for PriceRange 
						 * MySQL Info 
						 * Table Used PriceRange
						 *
						 ***************************/
						
						$query_rsPriceRange = "SELECT * FROM f_budget WHERE fb_id = " . $row_rsFLists->budget_id_fk;
						$result_rsPriceRange = mysql_query($query_rsPriceRange);
						$row_rsPriceRange = mysql_fetch_object($result_rsPriceRange);
						
						echo $row_rsPriceRange->fb_range;
						

						?>
					</div>
				</li>
		
			<?php } // End IF data rsFLists ?>
		
		</ul>

		<?php } // End List of Freelance Job Posts ?>
		
	</div>


	<br><br>
	<p>
		<h3>Top Categories</h3>
	</p>
	<div>
		<br>
		<?php 
		
		/***
		 *  show no data rsFLcategories
		 **/
		
		if($total_rows_rsFLCategories == 0) { ?>
		
			<p>No Data</p>
		
		<?php } else { // End If no data for rsFLCategories ?>
		
		
		<ul class="FLCategories" style="list-style:none">
		
			<?php 
		
			/***
			 *  show data rsFLCategories
			 **/
		
			while($row_rsFLCategories = mysql_fetch_object($result_rsFLCategories)) { ?>
				
				<li>
					<?php echo $row_rsFLCategories->fc_name; ?>
					
				</li>
		
			<?php } // End IF data rsFLCategories ?>
		
		</ul>

		<?php } // End of Display data ?>
		

	</div>
	
</div>


<!-- Page Title -->
<input type="hidden" name="page_title" value="<?php echo $curr_page_title; ?>" id="page_title" />

<?php  

/* Include header */
include 'footer.php';

?>