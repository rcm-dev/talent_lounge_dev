<?php  


include 'dbconnect.php';





$file_upload	=	'media/'.$_POST['name'];
$mid_id_fk      =	1;
$m_type       =	1;




$query = "INSERT INTO media (mid, m_path, m_type) VALUES ('','$file_upload','$m_type')";
$result = mysql_query($query);
$inserted_id = mysql_insert_id();



if($result) { // if success
	echo "uploaded file: " . $file_upload;
}




?>

