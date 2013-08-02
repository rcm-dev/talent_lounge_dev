<?php require_once('../Connections/conJobsPerak.php') ?>
<?php



$full_name = mysql_real_escape_string($_GET['full_name']);
$about_profile = mysql_real_escape_string($_GET['about_profile']);
$special_in = mysql_real_escape_string($_GET['special_in']);
$user_id_fk = mysql_real_escape_string($_GET['user_id_fk']);
$rp_location = mysql_real_escape_string($_GET['rp_location']);
$rp_rates = mysql_real_escape_string($_GET['rp_rates']);

/****************************
 *
 * Record Set for InsertProfile 
 * MySQL Info 
 * Table Used InsertProfile
 *
 ***************************/

$query_rsInsertProfile = "INSERT INTO recruit_profile (rp_id, user_id_fk, rp_full_name, rp_about, rp_location, rp_special_industry, rp_rates) 
							VALUES ('', '$user_id_fk', '$full_name', '$about_profile', '$rp_location', '$special_in', '$rp_rates')";
$result_rsInsertProfile = mysql_query($query_rsInsertProfile);

if ($result_rsInsertProfile) {
	echo "Saved";
}





?>