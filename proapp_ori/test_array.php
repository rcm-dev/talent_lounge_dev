<?php  

$user_id_tester = 1;

require_once('connection/conProApp.php');

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
}



?>