<?php  


include '../db/db-connect.php';


$time 			= 	time();


$file_upload	=	'uploads/ideas/'.$_POST['name'];
$mid_id_fk      =	$_POST['ideaId'];
$m_type       	=	2; // 1: image , 2: video




$query = "INSERT INTO mj_idea_media (mim_id, mim_path, mi_id_fk, mim_type) VALUES ('','$file_upload', '$mid_id_fk', '$m_type')";
$result = mysql_query($query);
$inserted_id = mysql_insert_id();



if($result) { // if success
	echo "uploaded file: " . $file_upload;
}




?>

