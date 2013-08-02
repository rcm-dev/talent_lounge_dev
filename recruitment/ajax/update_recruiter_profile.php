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

$query_rsInsertProfile = "UPDATE recruit_profile 
							SET 
								rp_full_name = '$full_name',
								rp_about = '$about_profile',
								rp_location = '$rp_location',
								rp_special_industry = '$special_in',
								rp_rates = '$rp_rates'
							WHERE user_id_fk = $user_id_fk";
$result_rsInsertProfile = mysql_query($query_rsInsertProfile);

if ($result_rsInsertProfile) {
	echo "Saved";
}





?>