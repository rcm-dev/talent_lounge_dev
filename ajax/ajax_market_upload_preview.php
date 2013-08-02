<?php  


include '../db/db-connect.php';


$time 			= 	time();


$file_upload	=	'uploads/market/'.$_POST['name'];
$mid_id_fk      =	$_POST['ideaId'];
//$m_type       	=	1; // 1: image , 2: video




$query = "INSERT INTO mj_market_media (mmm_id, mmm_path, mmm_mp_id_fk) VALUES ('','$file_upload', '$mid_id_fk')";
$result = mysql_query($query);
$inserted_id = mysql_insert_id();



if($result) { // if success
	echo "uploaded file: " . $file_upload;
}




?>

