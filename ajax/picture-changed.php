<?php  


include '../db/db-connect.php';





$file_upload	=	"/uploads/".mysql_real_escape_string(htmlspecialchars($_POST['name']));
$currUserID      =	(int) mysql_real_escape_string(htmlspecialchars($_POST['currUserID']));
$m_type       	=	1;




$query = "UPDATE mj_users SET user_pic = '$file_upload' WHERE usr_id = '$currUserID'";
$result = mysql_query($query);
$inserted_id = mysql_insert_id();



if($result) { // if success
	echo "uploaded file: " . $file_upload;
}




?>

