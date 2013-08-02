<?php  

require_once('connection/conProApp.php');


$disc_D         = mysql_real_escape_string($_POST['disc_D']);
$disc_I         = mysql_real_escape_string($_POST['disc_I']);
$disc_S         = mysql_real_escape_string($_POST['disc_S']);
$disc_C         = mysql_real_escape_string($_POST['disc_C']);

// change to FICE
$lite_L         = mysql_real_escape_string($_POST['lite_L']);
$lite_I         = mysql_real_escape_string($_POST['lite_I']);
$lite_T         = mysql_real_escape_string($_POST['lite_T']);
$lite_E         = mysql_real_escape_string($_POST['lite_E']);

$lse_X          = mysql_real_escape_string($_POST['lse_X']);
$lse_Y          = mysql_real_escape_string($_POST['lse_Y']);
$lse_Z          = mysql_real_escape_string($_POST['lse_Z']);

$lepj_L         = mysql_real_escape_string($_POST['lepj_L']);
$lepj_E         = mysql_real_escape_string($_POST['lepj_E']);
$lepj_P         = mysql_real_escape_string($_POST['lepj_P']);
$lepj_J         = mysql_real_escape_string($_POST['lepj_J']);

$user_id_tester = mysql_real_escape_string($_POST['user_id_tester']);



$query_rsPLS = "INSERT INTO lite_result (lite_result_id, lite_type, lite_score, user_id_fk, lite_time) VALUES ('', 'F', '$lite_L', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsPLS = mysql_query($query_rsPLS) or die(mysql_error());


$query_rsPLS = "INSERT INTO lite_result (lite_result_id, lite_type, lite_score, user_id_fk, lite_time) VALUES ('', 'I', '$lite_I', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsPLS = mysql_query($query_rsPLS) or die(mysql_error());


$query_rsPLS = "INSERT INTO lite_result (lite_result_id, lite_type, lite_score, user_id_fk, lite_time) VALUES ('', 'C', '$lite_T', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsPLS = mysql_query($query_rsPLS) or die(mysql_error());


$query_rsPLS = "INSERT INTO lite_result (lite_result_id, lite_type, lite_score, user_id_fk, lite_time) VALUES ('', 'E', '$lite_E', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsPLS = mysql_query($query_rsPLS) or die(mysql_error());



// get One value to DISC
// ===========================================================
$query_rsTopOneDISC = "Select
  lite_result.lite_result_id,
  lite_result.lite_type,
  Max(lite_result.lite_score),
  lite_result.user_id_fk,
  lite_result.lite_time
From
  lite_result
Where user_id_fk = $user_id_tester
Group By
  lite_result.lite_result_id, lite_result.lite_type, lite_result.user_id_fk,
  lite_result.lite_time
Order By
  lite_result.lite_time Desc,
  Max(lite_result.lite_score) Desc
Limit 0, 1";
$rsTopOneDISC = mysql_query($query_rsTopOneDISC) or die(mysql_error());
$totalRows_rsTopOneDISC = mysql_num_rows($rsTopOneDISC);

while ($row_rsTopOneDISC = mysql_fetch_assoc($rsTopOneDISC)) {
	echo $row_rsTopOneDISC['lite_type'];
}

// ===========================================================

?>
