<?php require_once('../Connections/conJobsPerak.php'); ?>
<?php  

$test_id = mysql_real_escape_string($_GET['test_id']);
$js_id = mysql_real_escape_string($_GET['js_id']);
$emp_id = mysql_real_escape_string($_GET['emp_id']);


/****************************
 *
 * Record Set for DeleteTest 
 * MySQL Info 
 * Table Used DeleteTest
 *
 ***************************/

$query_rsDeleteTest = "DELETE FROM test_to_jobseeker WHERE test_id_fk = '$test_id' AND js_id_fk = '$js_id' AND emp_user_id_fk = '$emp_id'";
$result_rsDeleteTest = mysql_query($query_rsDeleteTest);

if ($result_rsDeleteTest) {
	echo "Deleted!";
} else {
	echo mysql_error();
}




?>