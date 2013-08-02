<?php  

require_once('connection/conProApp.php');


$disc_D         = mysql_real_escape_string($_POST['disc_D']);
$disc_I         = mysql_real_escape_string($_POST['disc_I']);
$disc_S         = mysql_real_escape_string($_POST['disc_S']);
$disc_C         = mysql_real_escape_string($_POST['disc_C']);

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



$query_rsLSE = "INSERT INTO lse_result (lse_result_id, lse_type, lse_score, user_id_fk, lse_time) VALUES ('', 'X', '$lse_X', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsLSE = mysql_query($query_rsLSE) or die(mysql_error());


$query_rsLSE = "INSERT INTO lse_result (lse_result_id, lse_type, lse_score, user_id_fk, lse_time) VALUES ('', 'Y', '$lse_Y', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsLSE = mysql_query($query_rsLSE) or die(mysql_error());


$query_rsLSE = "INSERT INTO lse_result (lse_result_id, lse_type, lse_score, user_id_fk, lse_time) VALUES ('', 'Z', '$lse_Z', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsLSE = mysql_query($query_rsLSE) or die(mysql_error());


// get One value to DISC
// ===========================================================
$query_rsTopOneDISC = "Select
  lse_result.lse_result_id,
  lse_result.lse_type,
  Max(lse_result.lse_score),
  lse_result.user_id_fk,
  lse_result.lse_time
From
  lse_result
Where user_id_fk = $user_id_tester
Group By
  lse_result.lse_result_id, lse_result.lse_type, lse_result.user_id_fk,
  lse_result.lse_time
Order By
  lse_result.lse_time Desc,
  Max(lse_result.lse_score) Desc
Limit 0, 1";
$rsTopOneDISC = mysql_query($query_rsTopOneDISC) or die(mysql_error());
$totalRows_rsTopOneDISC = mysql_num_rows($rsTopOneDISC);

while ($row_rsTopOneDISC = mysql_fetch_assoc($rsTopOneDISC)) {
	echo $row_rsTopOneDISC['lse_type'];
}

// ===========================================================


?>
