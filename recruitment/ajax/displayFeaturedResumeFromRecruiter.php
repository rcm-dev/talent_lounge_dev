<?php  




?>
<?php require_once('../Connections/conJobsPerak.php') ?>
<?php  


$rp_id = mysql_real_escape_string(intval($_GET['rp_id']));
$role = mysql_real_escape_string($_GET['role']);
$location = mysql_real_escape_string(intval($_GET['location']));
$pid = mysql_real_escape_string(intval($_GET['pid']));


/****************************
 *
 * Record Set for FeaturedResumeLists 
 * MySQL Info 
 * Table Used FeaturedResumeLists
 *
 ***************************/

$query_rsFeaturedResumeLists = "SELECT * FROM recruit_js_lists
									INNER JOIN jp_jobseeker
									ON recruit_js_lists.js_id_fk = jp_jobseeker.users_id_fk
									INNER JOIN mj_users
									ON recruit_js_lists.js_id_fk = mj_users.usr_id
									WHERE rjs_project_id_fk = $pid AND js_id_shortlisted = 1";
$result_rsFeaturedResumeLists = mysql_query($query_rsFeaturedResumeLists);
$total_rows_rsFeaturedResumeLists = mysql_num_rows($result_rsFeaturedResumeLists);


?>

<?php if ($total_rows_rsFeaturedResumeLists == 0): ?>
	<p>No featured recommendation lists</p>
<?php endif ?>


<?php if ($total_rows_rsFeaturedResumeLists != 0): ?>

	<div>
		Lists for Job Role: <strong><?php echo $role ?></strong>
	</div>
	<ul id="featuredListsResume">
	<?php while ($row_rsFeaturedResumeLists = mysql_fetch_object($result_rsFeaturedResumeLists)) { ?>
		<li>
			<div class="left">
				<img src="<?php echo $row_rsFeaturedResumeLists->jobseeker_pic ?>" style="max-width:60px;">
			</div>
			<div class="right" style="width:540px; margin-right:20px; height:60px; line-height:50px;">
				<strong><?php echo $row_rsFeaturedResumeLists->users_fname ?> <?php echo $row_rsFeaturedResumeLists->users_lname ?>s</strong>
				<a href="jobSeekerResume.php?js_id=<?php echo $row_rsFeaturedResumeLists->js_id_fk ?>">View Resume</a>
			</div>
			<div style="clear:both"></div>
		</li>
	<?php } ?>
	</ul>

<?php endif ?>