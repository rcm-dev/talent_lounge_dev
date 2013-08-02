<?php require_once('../Connections/conJobsPerak.php'); ?>

<?php  



$assign_to_project = mysql_real_escape_string($_GET['assign_to_project']);
$js_id = mysql_real_escape_string($_GET['js_id']);
$agent_id = mysql_real_escape_string($_GET['agent_id']);


/****************************
 *
 * Record Set for InsertIntoJSLists 
 * MySQL Info 
 * Table Used InsertIntoJSLists
 *
 ***************************/

$query_rsInsertIntoJSLists = "INSERT INTO recruit_js_lists (rjs_id, rjs_recruit_id_fk, rjs_project_id_fk, js_id_fk, rjs_datemade)
								VALUES ('', '$agent_id', '$assign_to_project', '$js_id', NOW())";
$result_rsInsertIntoJSLists = mysql_query($query_rsInsertIntoJSLists);


if ($result_rsInsertIntoJSLists) {
	echo 1;
}





?>