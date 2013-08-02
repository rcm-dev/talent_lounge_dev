<?php  


include '../db/db-connect.php';


$time 			= 	time();


$file_upload	=	'uploads/project/'.$_POST['name'];
$mfd_id_fk      =	$_POST['ideaId'];
$mfm_type       =	1; // 1: image , 2: video




$query = "INSERT INTO mj_fund_media (mfm_id, mfm_path, mfm_id_fk, mfm_type) VALUES ('','$file_upload', '$mfd_id_fk', '$mfm_type')";
$result = mysql_query($query);
$inserted_id = mysql_insert_id();



if($result) { // if success
	echo "uploaded file: " . $file_upload;
}




?>

