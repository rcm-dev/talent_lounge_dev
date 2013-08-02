<?php  

require_once('connection/conProApp.php');

// change to APSC
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



/**
 * STEP 1 : Store into DB
 */

// DISC
// INSERT DISC
// =========================================================
$query_rsDISC = "INSERT INTO disc_result (disc_result_id, disc_type, disc_score, user_id_fk, disc_time) VALUES ('', 'A', '$disc_D', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsDISC = mysql_query($query_rsDISC) or die(mysql_error());

$query_rsDISC = "INSERT INTO disc_result (disc_result_id, disc_type, disc_score, user_id_fk, disc_time) VALUES ('', 'P', '$disc_I', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsDISC = mysql_query($query_rsDISC) or die(mysql_error());

$query_rsDISC = "INSERT INTO disc_result (disc_result_id, disc_type, disc_score, user_id_fk, disc_time) VALUES ('', 'S', '$disc_S', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsDISC = mysql_query($query_rsDISC) or die(mysql_error());

$query_rsDISC = "INSERT INTO disc_result (disc_result_id, disc_type, disc_score, user_id_fk, disc_time) VALUES ('', 'C', '$disc_C', '$user_id_tester', CURRENT_TIMESTAMP)";
$rsDISC = mysql_query($query_rsDISC) or die(mysql_error());

// END DISC ==================================================


// get two value to DISC
// ===========================================================
$query_rsTopTwoDISC = "Select
  disc_result.disc_result_id,
  disc_result.disc_type,
  Max(disc_result.disc_score),
  disc_result.user_id_fk,
  disc_result.disc_time
From
  disc_result
Where user_id_fk = $user_id_tester
Group By
  disc_result.disc_result_id, disc_result.disc_type, disc_result.user_id_fk,
  disc_result.disc_time
Order By
  disc_result.disc_time Desc,
  Max(disc_result.disc_score) Desc
Limit 0, 2";
$rsTopTwoDISC = mysql_query($query_rsTopTwoDISC) or die(mysql_error());
$totalRows_rsTopTwoDISC = mysql_num_rows($rsTopTwoDISC);

while ($row_rsTopTwoDISC = mysql_fetch_assoc($rsTopTwoDISC)) {
	echo $row_rsTopTwoDISC['disc_type'];
  echo ",";
}

// ===========================================================


?>
