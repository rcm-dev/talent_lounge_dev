<?php require_once('../Connections/conJobsPerak.php'); ?>
<?php  


$test_id = mysql_real_escape_string($_GET['assign_test']);
$to_jobseeker = mysql_real_escape_string($_GET['to_jobseeker']);
$emp_user_id_fk = mysql_real_escape_string($_GET['emp_user_id_fk']);




if ($test_id == 0) {
	echo 0;
} else {

	/****************************
	 *
	 * Record Set for InsertTestToJobseeker 
	 * MySQL Info 
	 * Table Used InsertTestToJobseeker
	 *
	 ***************************/

	$query_rsInsertTestToJobseeker = "INSERT INTO test_to_jobseeker (ttj_id, test_id_fk, js_id_fk, emp_user_id_fk)
										VALUES ('', $test_id, $to_jobseeker, $emp_user_id_fk)";
	$result_rsInsertTestToJobseeker = mysql_query($query_rsInsertTestToJobseeker);
	

	if ($result_rsAssessmentTest) {
		echo "Assigned";
	}



}

?>