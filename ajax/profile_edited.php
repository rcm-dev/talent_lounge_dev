<?php  


include '../db/db-connect.php';

$curr_username   = $_POST['curr_username'];
$currPhone       = $_POST['currPhone'];
$currGeneralInfo = $_POST['currGeneralInfo'];
$coreActivity    = $_POST['coreActivity'];
$currWorking     = $_POST['currWorking'];
$currSector      = $_POST['currSector'];
$currServices    = $_POST['currServices'];
$currState       = $_POST['currState'];
$currID          = $_POST['currID'];


$updateProfile = "UPDATE mj_users 
					SET usr_name = '$curr_username',
					usr_tel = '$currPhone',
					usr_general_info = '$currGeneralInfo',
					usr_core_activity = '$coreActivity',
					usr_workat = '$currWorking',
					mj_sector_fk = '$currSector',
					mj_services_fk = '$currServices',
					mj_state_fk = '$currState'
					WHERE usr_id = '$currID'";

$result = mysql_query($updateProfile);

if ($result) {
	echo 1;
}

?>