<?php  

// check if exist
$sql_check = "SELECT * FROM mj_tours WHERE tours_usr_id_fk = '$usr_id' AND tours_section = '$section'";
$sql_check_result = mysql_query($sql_check);
$total_check_ = mysql_num_rows($sql_check_result);

if ($total_check_ != 1) {
	
	// update sql tours
	$INSERT_SQL = "INSERT INTO mj_tours VALUES ('', '$usr_id', '$section', '0')";
	$INSERT_RESULT = mysql_query($INSERT_SQL);

	if ($INSERT_RESULT) {
		echo 'Disabled';
	}
}



?>