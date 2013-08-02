<?php  


include '../db/db-connect.php';


$userstorename = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['userstorename'])));
$storeCreatedBy = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['storeCreatedBy'])));

$sqlinsert = "INSERT INTO mj_market_store (mms_id, mms_name, mms_usr_id_fk) VALUES ('','$userstorename', '$storeCreatedBy')";
$result = mysql_query($sqlinsert);

if ($result) {
	echo 1;
}
else {
	echo 0;
}



?>