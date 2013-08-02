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

// change to FSIR
$lepj_L         = mysql_real_escape_string($_POST['lepj_L']);
$lepj_E         = mysql_real_escape_string($_POST['lepj_E']);
$lepj_P         = mysql_real_escape_string($_POST['lepj_P']);
$lepj_J         = mysql_real_escape_string($_POST['lepj_J']);

$user_id_tester = mysql_real_escape_string($_POST['user_id_tester']);


$query_rsLSE = "INSERT INTO lepj_result (lepj_result_id, lepj_type, lepj_score, user_id_fk, lepj_time) VALUES ('', 'F', '$lepj_L', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsLSE = mysql_query($query_rsLSE) or die(mysql_error());


$query_rsLSE = "INSERT INTO lepj_result (lepj_result_id, lepj_type, lepj_score, user_id_fk, lepj_time) VALUES ('', 'S', '$lepj_E', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsLSE = mysql_query($query_rsLSE) or die(mysql_error());


$query_rsLSE = "INSERT INTO lepj_result (lepj_result_id, lepj_type, lepj_score, user_id_fk, lepj_time) VALUES ('', 'I', '$lepj_P', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsLSE = mysql_query($query_rsLSE) or die(mysql_error());

$query_rsLSE = "INSERT INTO lepj_result (lepj_result_id, lepj_type, lepj_score, user_id_fk, lepj_time) VALUES ('', 'R', '$lepj_J', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsLSE = mysql_query($query_rsLSE) or die(mysql_error());


// get One value to DISC
// ===========================================================
$query_rsTopOneDISC = "Select
  lepj_result.lepj_result_id,
  lepj_result.lepj_type,
  Max(lepj_result.lepj_score),
  lepj_result.user_id_fk,
  lepj_result.lepj_time
From
  lepj_result
Where user_id_fk = $user_id_tester
Group By
  lepj_result.lepj_result_id, lepj_result.lepj_type, lepj_result.user_id_fk,
  lepj_result.lepj_time
Order By
  lepj_result.lepj_time Desc,
  Max(lepj_result.lepj_score) Desc
Limit 0, 2";
$rsTopOneDISC = mysql_query($query_rsTopOneDISC) or die(mysql_error());
$totalRows_rsTopOneDISC = mysql_num_rows($rsTopOneDISC);

while ($row_rsTopOneDISC = mysql_fetch_assoc($rsTopOneDISC)) {
	echo $row_rsTopOneDISC['lepj_type'];
  echo ",";
}

// ===========================================================

?>
