<?php  

// section parameter
// $section = 5; // dashboard
// $section = 4; // funding
// $section = 3; // invent
// $section = 2; // connect
// $section = 1; // market

// section status 1=run, 0=disable
// $status = 1; // run
// $status = 0; // disable


// check if done or not
$SQL_CHECK = "SELECT * FROM mj_tours WHERE tours_usr_id_fk = '$usr_id' ";
$RESULT_CHECK = mysql_query($SQL_CHECK);
$RESULT_AVAILABLE = mysql_num_rows($RESULT_CHECK);

// if xde data
if ($RESULT_AVAILABLE == NULL) {

	//echo 'RUN';
	echo '<input type="hidden" name="tour_status" id="tour_status" value="run" />';

}
else {

	// if ada data check status of each section
	$SQL = "SELECT * FROM mj_tours WHERE tours_usr_id_fk = '$usr_id' AND tours_section = '$section'";

	$result = mysql_query($SQL);
	$resultTotal = mysql_num_rows($result);

	//$object = mysql_fetch_object($result);

	if ($resultTotal == 0) {
		//echo 'DISABLED';
		echo '<input type="hidden" name="tour_status" id="tour_status" value="run" />';
	}
	else {
		echo '<input type="hidden" name="tour_status" id="tour_status" value="disabled" />';
	}

}



?>