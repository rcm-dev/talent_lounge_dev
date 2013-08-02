<?php  

/* Include header */
include 'header.php';


// Set page title
$page_name = "Jobs";

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



/**
 * GET ID FROM BROWSER
 */
$jobid = mysql_real_escape_string(intval($_GET['jid']));

/****************************
 *
 * Record Set for viewJob 
 * MySQL Info 
 * Table Used viewJob
 *
 ***************************/

$query_rsviewJob = "SELECT * FROM f_lists WHERE fl_id = ". $jobid;
$result_rsviewJob = mysql_query($query_rsviewJob);
$total_rows_rsviewJob = mysql_num_rows($result_rsviewJob);
$row_rsviewJob = mysql_fetch_object($result_rsviewJob);




?>
<?php include 'quickpost.php'; ?>
<div id="contentContainer" style="padding:30px">
	
	<div class="left">
		
	</div>
	<div class="left" style="">
		<h1 class="heading_title bebasTitle" style="margin-top:20px !important;">
		<?php echo $page_name; ?> &middot; <?php echo $row_rsviewJob->fl_jobtitle ?></h1>
	</div>
	<div class="clear"></div>
	
	<div>
		<strong>Description</strong>
		<p>
			<?php echo $row_rsviewJob->fl_desc ?>
		</p><br>

		<strong>Skills Requried</strong>
		<p>
			<?php echo $row_rsviewJob->fl_skills ?>
		</p><br>

		<strong>Category</strong>
		<p>
			<?php  

			/****************************
			 *
			 * Record Set for CategoriesTitle 
			 * MySQL Info 
			 * Table Used CategoriesTitle
			 *
			 ***************************/
			
			$query_rsCategoriesTitle = "SELECT * FROM f_categories WHERE fc_id = " . $row_rsviewJob->f_categories_id_fk;
			$result_rsCategoriesTitle = mysql_query($query_rsCategoriesTitle);
			$row_rsCategoriesTitle = mysql_fetch_object($result_rsCategoriesTitle);

			echo $row_rsCategoriesTitle->fc_name;

			?>
		</p><br>

		<strong>Budget</strong>
		<p>
			<?php  

			/****************************
			 *
			 * Record Set for BudgetTitle 
			 * MySQL Info 
			 * Table Used BudgetTitle
			 *
			 ***************************/
			
			$query_rsBudgetTitle = "SELECT * FROM f_budget WHERE fb_id = " . $row_rsviewJob->budget_id_fk;
			$result_rsBudgetTitle = mysql_query($query_rsBudgetTitle);
			$row_rsBudgetTitle = mysql_fetch_object($result_rsBudgetTitle);

			echo $row_rsBudgetTitle->fb_range;

			?>
		</p><br>
	</div>

	<br>
	<br>
	<br>
	<div>
		<h3>Bidder</h3>
		<div>
			<form action="#" method="post" id="postBidPrice">
				<table>
					<tr>
						<td>
							Want a owned this project? bid some range
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" style="padding:4px;" placeholder="RM200" id="priceRange">
						</td>
					</tr>
					<tr>
						<td>
							<input type="hidden" value="<?php echo $_GET['cuid']; ?>" id="users_id_fk">
							<input type="hidden" value="<?php echo $jobid; ?>" id="job_id_fk">
							<input type="submit" class="button green" id="btnBidPrice">
						</td>
					</tr>
				</table>
			</form>
			<br>
			<?php  


			/****************************
			 *
			 * Record Set for BidderLists 
			 * MySQL Info 
			 * Table Used BidderLists
			 *
			 ***************************/
			
			$query_rsBidderLists = "SELECT * FROM f_bid WHERE fbid_job_id_fk = " . $jobid;
			$result_rsBidderLists = mysql_query($query_rsBidderLists);
			$total_rows_rsBidderLists = mysql_num_rows($result_rsBidderLists);
			
			
			if ($total_rows_rsBidderLists == 0) {
				echo "No Bidder, Be the first";
			} else { ?>

				<br><br>
				<h2>Current Bidder Lists</h2><br>
				<table border="0" width="100%" class="freelancerTable">
					<tr>
						<th>
							Bidder
						</th>
						<th>
							Range (RM)
						</th>
					</tr>

				<?php while ($row_rsBidderLists = mysql_fetch_object($result_rsBidderLists)) { ?>
	

				<tr>
					<td>
						<?php  

						/****************************
						 *
						 * Record Set for UsersLists 
						 * MySQL Info 
						 * Table Used UsersLists
						 *
						 ***************************/
						
						$query_rsUsersLists = "SELECT * FROM mj_users WHERE usr_id = " . $row_rsBidderLists->fbid_user_id_fk;
						$result_rsUsersLists = mysql_query($query_rsUsersLists);
						$row_rsUsersLists = mysql_fetch_object($result_rsUsersLists);

						?>
						<h2><a href="users.php?uid=<?php echo $row_rsUsersLists->usr_id ?>"><?php echo $row_rsUsersLists->users_fname ?> <?php echo $row_rsUsersLists->users_lname ?></a></h2>
					</td>
					<td align="right">
						<h2>RM <?php echo $row_rsBidderLists->fbid_price ?></h2>
					</td>
				</tr>


				<?php } ?>


				</table>
				<br>
				<br>
				<br>
			
			<?php 


			}

			?>
		</div>
	</div>
	
</div>


<!-- Page Title -->
<input type="hidden" name="page_title" value="<?php echo $curr_page_title; ?> &middot; <?php echo $row_rsviewJob->fl_jobtitle ?>" id="page_title" />

<script>
	$(document).ready(function() {
		$('#btnBidPrice').click(function(){

			var price = $('input#priceRange').val()
			var users_id_fk = $('input#users_id_fk').val()
			var job_id_fk = $('input#job_id_fk').val()
			

			if (price == '') {
				alert('Please fill your price!');
			} else {

				$.ajax({
					data: price,
					url: 'ajax/submitPriceFreelance.php?priceRange='+price+'&cuid='+users_id_fk+'&jid='+job_id_fk,
					method: "GET",

					success:function(html){
						console.log(html);
					}

				});

			}
			

			return false;
		});
	});
</script>

<?php  

/* Include header */
include 'footer.php';

?>