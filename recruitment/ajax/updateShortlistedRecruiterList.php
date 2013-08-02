<?php require_once('../Connections/conJobsPerak.php'); ?>
<?php  


$js_id_fk = mysql_real_escape_string(($_GET['js_id_fk']));
$rjs_id = mysql_real_escape_string(intval($_GET['rjs_id']));
$rjs_project_id_fk = mysql_real_escape_string(intval($_GET['rjs_project_id_fk']));
$rjs_recruit_id_fk = mysql_real_escape_string(intval($_GET['rjs_recruit_id_fk']));

/****************************
 *
 * Record Set for UpdateShortlisted 
 * MySQL Info 
 * Table Used UpdateShortlisted
 *
 ***************************/

$query_rsUpdateShortlisted = "UPDATE recruit_js_lists 
								SET js_id_shortlisted = 1 
								WHERE rjs_id = $rjs_id
								AND rjs_project_id_fk = $rjs_project_id_fk
								AND js_id_fk = $js_id_fk
								AND rjs_recruit_id_fk = $rjs_recruit_id_fk";
$result_rsUpdateShortlisted = mysql_query($query_rsUpdateShortlisted);

if ($query_rsUpdateShortlisted) {
	echo $js_id_fk . $rjs_id . $rjs_project_id_fk . $rjs_recruit_id_fk;
} else {
	echo mysql_error();
}




?>