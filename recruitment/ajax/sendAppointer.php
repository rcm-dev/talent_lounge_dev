<?php require_once('../Connections/conJobsPerak.php') ?>
<?php



$ra_title = mysql_real_escape_string($_GET['ra_title']);
$ra_location = mysql_real_escape_string($_GET['ra_location']);
$about_the_role = mysql_real_escape_string($_GET['about_the_role']);
$ra_salary_range_1 = mysql_real_escape_string($_GET['ra_salary_range_1']);
$ra_salary_range_2 = mysql_real_escape_string($_GET['ra_salary_range_2']);
$ra_recruit_id_fk = mysql_real_escape_string($_GET['ra_recruit_id_fk']);
$ra_emp_id_fk = mysql_real_escape_string($_GET['ra_emp_id_fk']);


/****************************
 *
 * Record Set for SendAppointerSQL 
 * MySQL Info 
 * Table Used SendAppointerSQL
 *
 ***************************/

$query_rsSendAppointerSQL = "INSERT INTO recruit_apointed (ra_id,
															ra_emp_id_fk,
															ra_recruit_id_fk,
															ra_title,
															ra_location,
															ra_about_the_role,
															ra_salary_range_1,
															ra_salary_range_2,
															ra_datetime_made)
								VALUES ('', '$ra_emp_id_fk', '$ra_recruit_id_fk', '$ra_title', '$ra_location', '$about_the_role', '$ra_salary_range_1', '$ra_salary_range_2', NOW())";
$result_rsSendAppointerSQL = mysql_query($query_rsSendAppointerSQL);
$total_rows_rsSendAppointerSQL = mysql_num_rows($result_rsSendAppointerSQL);

if ($result_rsSendAppointerSQL) {
	echo 1;
}


?>