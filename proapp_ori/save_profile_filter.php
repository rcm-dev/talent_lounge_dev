<?php  


require_once('connection/conProApp.php');


/**
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */


// get value
$disc = rtrim(mysql_real_escape_string($_POST['disc']), ',');
$pls = mysql_real_escape_string($_POST['pls']);
$xyz = mysql_real_escape_string($_POST['xyz']);
$lepj = rtrim(mysql_real_escape_string($_POST['lepj']), ',');
$user_id_tester = mysql_real_escape_string($_POST['user_id_tester']);


// get value of each test
// DISC / APSC
$disc_D = mysql_real_escape_string($_POST['disc_D']);
$disc_I = mysql_real_escape_string($_POST['disc_I']);
$disc_S = mysql_real_escape_string($_POST['disc_S']);
$disc_C = mysql_real_escape_string($_POST['disc_C']);

// LITE
$lite_L = mysql_real_escape_string($_POST['lite_L']);
$lite_I = mysql_real_escape_string($_POST['lite_I']);
$lite_T = mysql_real_escape_string($_POST['lite_T']);
$lite_E = mysql_real_escape_string($_POST['lite_E']);

// XYZ / CLS
$lse_X = mysql_real_escape_string($_POST['lse_X']);
$lse_Y = mysql_real_escape_string($_POST['lse_Y']);
$lse_Z = mysql_real_escape_string($_POST['lse_Z']);

// LEPJ
$lepj_L = mysql_real_escape_string($_POST['lepj_L']);
$lepj_E = mysql_real_escape_string($_POST['lepj_E']);
$lepj_P = mysql_real_escape_string($_POST['lepj_P']);
$lepj_J = mysql_real_escape_string($_POST['lepj_J']);


/**
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */






// check is exist
$query_exist     = "SELECT * FROM profile_filter WHERE user_id_fk = " . $user_id_tester;
$result_exist    = mysql_query($query_exist);
$totalRows_exist = mysql_num_rows($result_exist);


// if exist updae current data
if ($totalRows_exist == 1) {
	
	// do update current user
	$query_rsUpdateProfileFilter = "UPDATE profile_filter 
	SET DISC = '$disc', 
		LITE = '$pls', 
		XYZ = '$xyz', 
		LEPJ = '$lepj',
		disc_d = '$disc_D',
		disc_i = '$disc_I',
		disc_s = '$disc_S',
		disc_c = '$disc_C',
		lite_l = '$lite_L',
		lite_i = '$lite_I',
		lite_t = '$lite_T',
		lite_e = '$lite_E',
		xyz_X  = '$lse_X',
		xyz_Y  = '$lse_Y',
		xyz_Z  = '$lse_Z',
		lepj_L = '$lepj_L',
		lepj_E = '$lepj_E',
		lepj_P = '$lepj_P',
		lepj_J = '$lepj_J'
	WHERE user_id_fk = '$user_id_tester'";
	$rsUpdateProfileFilter = mysql_query($query_rsUpdateProfileFilter) or die(mysql_error());



// else insert new
} else {


	// insert new record
	$query_rsSaveProfileFilter = "INSERT INTO profile_filter (pf_id, DISC, LITE, XYZ, LEPJ, user_id_fk, disc_d, disc_i, disc_s, disc_c, lite_l, lite_i, lite_t, lite_e, xyz_X, xyz_Y, xyz_Z, lepj_L, lepj_E, lepj_P, lepj_J) 
	VALUES ('', 
			'$disc', 
			'$pls', 
			'$xyz', 
			'$lepj', 
			'$user_id_tester', 
			'$disc_D', 
			'$disc_I', 
			'$disc_S', 
			'$disc_C', 
			'$lite_L', 
			'$lite_I', 
			'$lite_T', 
			'$lite_E', 
			'$lse_X', 
			'$lse_Y', 
			'$lse_Z', 
			'$lepj_L', 
			'$lepj_E', 
			'$lepj_P', 
			'$lepj_J')";
	$rsSaveProfileFilter = mysql_query($query_rsSaveProfileFilter) or die(mysql_error());


}



?>