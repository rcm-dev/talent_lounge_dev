<?php  


/**
 * 
 * 
 * Get row idea details
 * by id from url
 * 
 * 
 */
include 'header.php';

$idea_id 		= $_GET['id'];
$idea_idTrimSeq	= mysql_escape_string(trim($idea_id));

$qIdeaDetails = "SELECT
  mj_idea_post.*,
  mj_users.usr_name,
  mj_idea_category.id_cat_name,
  mj_idea_post.id_cat_id_fk As id_cat_id_fk1
FROM
  mj_idea_post INNER JOIN
  mj_users On mj_idea_post.id_usr_id_fk = mj_users.usr_id INNER JOIN
  mj_idea_category ON mj_idea_post.id_cat_id_fk = mj_idea_category.id_cat_id
WHERE
  mj_idea_post.id_cat_id_fk = '$idea_id'";

$resultIdeaDetail = mysql_query($qIdeaDetails);
$rowIdeaDetails	  = mysql_fetch_object($resultIdeaDetail);




?>


<div id="mojo-container">


	<div class="container_24">
		<div><h1><?php echo $rowIdeaDetails->id_title; ?></h1></div>
		<div>
			<div id="mojo-sidebar" class="grid_7 alpha">

				<?php include 'ajax/browse-idea-sidebar.php'; ?>

			</div>

			<div class="mojo-content grid_16 alpha right">
				<div class="idea-body">
					<h2>Concept</h2>
					<div class="idea-image-details">
						<img src="<?php echo $rowIdeaDetails->id_pictures; ?>">
					</div>

					<h2>Idea Details</h2>
					<div class="idea-body-text">
						<?php echo $rowIdeaDetails->id_desc; ?>
					</div>

					<h2>Problem Situation</h2>
					<div class="idea-body-text">
						<?php echo $rowIdeaDetails->id_cur_problem; ?>
					</div>

					<h2>Enhancement / Solution</h2>
					<div class="idea-body-text">
						<?php echo $rowIdeaDetails->id_cur_solution; ?>
					</div>


					<h2>Target Customer / End User</h2>
					<div class="idea-body-text">
						<?php echo $rowIdeaDetails->id_trget_cust; ?>
					</div>

					<h2>Features</h2>
					<div class="idea-body-text">
						<?php echo $rowIdeaDetails->id_features; ?>
					</div>

					<h2>Similar Product</h2>
					<div class="idea-body-text">
						<?php echo $rowIdeaDetails->id_smlar_product; ?>
					</div>

				</div>
				
			</div>


			<div class="clear"></div>
		</div>
	</div>


	<div class="container_24"><a href="logout.php">Logout</a></div>
</div>


<div id="mojo-copyright">
		<div class="mojo-footer-subcontainer container_24">
			<div class="grid_4">
				<p>Mojo &copy; <?php echo date('Y'); ?></p>
			</div>
			<div class="mj-footer-link grid_20 omega">
				<p><a href="#">Privacy</a> &middot; <a href="#">Term</a> &middot; <a href="#">Help</a></p>
			</div>
			<div class="clear"></div>
		</div>
</div><!-- /copyright -->


<!-- Ajax Browse -->
<script type="text/javascript">

$(document).ready(function(){


});

</script>
<!-- /Ajax Browse -->
<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>