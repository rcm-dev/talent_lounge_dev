<?php require_once('../Connections/conJobsPerak.php'); ?>
<?php  



$ra_id = mysql_real_escape_string(intval($_GET['projectID']));

/****************************
 *
 * Record Set for UpdateProjectToAgent 
 * MySQL Info 
 * Table Used UpdateProjectToAgent
 *
 ***************************/

$query_rsUpdateProjectToAgent = "UPDATE recruit_apointed SET ra_status = 1 WHERE ra_id = $ra_id";
$result_rsUpdateProjectToAgent = mysql_query($query_rsUpdateProjectToAgent);


if ($result_rsUpdateProjectToAgent) {
	echo 1;
}




?>