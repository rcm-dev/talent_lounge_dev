<?php require_once('../Connections/conJobsPerak.php'); ?>
<?php  


$viewPID = mysql_real_escape_string(intval($_GET['viewPID']));

/****************************
 *
 * Record Set for ViewProjectAppointed 
 * MySQL Info 
 * Table Used ViewProjectAppointed
 *
 ***************************/

$query_rsViewProjectAppointed = "SELECT * FROM recruit_js_lists 
									INNER JOIN mj_users
									ON recruit_js_lists.js_id_fk = mj_users.usr_id
									INNER JOIN jp_jobseeker
									ON mj_users.usr_id = jp_jobseeker.users_id_fk
									WHERE (js_id_shortlisted = 0 OR js_id_shortlisted = 1) AND rjs_project_id_fk = " . $viewPID;
$result_rsViewProjectAppointed = mysql_query($query_rsViewProjectAppointed);
$total_rows_rsViewProjectAppointed = mysql_num_rows($result_rsViewProjectAppointed);


/****************************
 *
 * Record Set for NameOfProject 
 * MySQL Info 
 * Table Used NameOfProject
 *
 ***************************/

$query_rsNameOfProject = "SELECT * FROM recruit_apointed 
							INNER JOIN jp_employer
							ON recruit_apointed.ra_emp_id_fk = jp_employer.users_id_fk
							WHERE ra_id = " . $viewPID;
$result_rsNameOfProject = mysql_query($query_rsNameOfProject);
$rows_rsNameOfProject = mysql_fetch_object($result_rsNameOfProject);



?>
<html>
<head>
	<title>Jobseeker Lists based on Project</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen, projection" />
	<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
	<style>
		.fixFont {
			font-size: 12px;
		}
	</style>	
</head>
<body>

<?php if ($total_rows_rsViewProjectAppointed == 0): ?>
	<p>No lists of jobseeker yet</p>
<?php endif ?>

<?php if ($total_rows_rsViewProjectAppointed != 0): ?>
	

<h3><?php echo $rows_rsNameOfProject->ra_title ?> &middot; <strong>Employer:</strong> <?php echo $rows_rsNameOfProject->emp_name ?></h3>

<table width="100%" class="csstable2 fixFont">
	<tr>
		<th align="center" valign="middle">Jobseeker</th>
		<th align="center" valign="middle">Resume</th>
		<th align="center" valign="middle">Shortlisted</th>
	</tr>
	<?php while ($rows_rsViewProjectAppointed = mysql_fetch_object($result_rsViewProjectAppointed)) { ?>
	<tr>
		<td align="left" valign="middle">
			<div>
				<div class="left" style="margin-right:20px;">
					<img src="../<?php echo $rows_rsViewProjectAppointed->jobseeker_pic ?>" alt="<?php echo $rows_rsViewProjectAppointed->usr_name ?>" width="60px" style="max-width:60px; max-height:80px;">
				</div>
				<div class="left">
					<strong><?php echo $rows_rsViewProjectAppointed->users_fname ?> <?php echo $rows_rsViewProjectAppointed->users_lname ?></strong>
					<br><?php echo $rows_rsViewProjectAppointed->usr_email ?>
				</div>
				<div class="clear"></div>
			</div>
		</td>
		<td align="center" valign="middle">
			<a href="../recruiterViewJobSeekerResumeProject.php?js_id=<?php echo $rows_rsViewProjectAppointed->js_id_fk ?>&PID=<?php echo $rows_rsViewProjectAppointed->rjs_project_id_fk ?>" class="viewResume">View resume</a>
		</td>
		<td align="center" valign="middle">
			<?php if ($rows_rsViewProjectAppointed->js_id_shortlisted == 1): ?>
				<img src="../../images/icon_color/star.png" alt="shortlisted" />
			<?php endif ?>

			<?php if ($rows_rsViewProjectAppointed->js_id_shortlisted == 0): ?>
				<select name="move_to_shortlisted" class="move_to_shortlisted" style="width:160px" data-id="<?php echo $rows_rsViewProjectAppointed->users_id_fk ?>" data-project="<?php echo $rows_rsViewProjectAppointed->rjs_project_id_fk ?>" data-recruiter="<?php echo $rows_rsViewProjectAppointed->rjs_recruit_id_fk ?>" data-listid="<?php echo $rows_rsViewProjectAppointed->rjs_id ?>">
					<option value="0">Choose</option>
					<option value="1">Move to Shortlisted</option>
				</select>
			<?php endif ?>
		</td>
	</tr>
	<?php } ?>
</table>

<?php endif ?>

<script>
	$(document).ready(function() {

		$('select.move_to_shortlisted').change(function(){

			var ok = $(this).val();

			var js_id_fk = $(this).attr('data-id');
			var rjs_project_id_fk = $(this).attr('data-project');
			var rjs_recruit_id_fk = $(this).attr('data-recruiter');
			var rjs_id = $(this).attr('data-listid');

			var parameterShortlisted = 'js_id_fk='+js_id_fk+'&rjs_project_id_fk='+rjs_project_id_fk+'&rjs_recruit_id_fk='+rjs_recruit_id_fk+'&rjs_id='+rjs_id;

			if (ok == 1) {
				$.ajax({
					url: '../ajax/updateShortlistedRecruiterList.php?'+parameterShortlisted,

					success:function(data){
						//console.log('../ajax/updateShortlistedRecruiterList.php?'+parameterShortlisted);
						//console.log(data);
						window.location = 'requestJobSeekerProjectAgent.php?viewPID='+rjs_project_id_fk;
					}
				});
			};

			// console.log('move ' + js_id + ' ');
		});


		console.log('init() shortlisetd lists');
	});
</script>

</body>
</html>