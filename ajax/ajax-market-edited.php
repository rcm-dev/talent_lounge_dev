<?php  


include '../db/db-connect.php';


// GET POST
$user_id				=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['user_id'])));
$market_title			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['market_title'])));
$market_category		=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['market_category'])));
$market_area			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['market_area'])));
$market_desc			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['market_desc'])));
$market_price			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['market_price'])));
$mid					=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['mid'])));
$market_store			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['market_store'])));



// INSERT SQL
$sql = "UPDATE mj_market_post 
		SET mrket_post_title = '$market_title',
		mrket_post_body = '$market_desc',
		mrket_cat_id_fk = '$market_category',
		mrket_state_id_fk = '$market_area',
		mrket_price = '$market_price',
		market_mms_id_fk = '$market_store'
		WHERE mrket_post_id = '$mid' 
		AND mrket_usr_id_fk = '$user_id'";


$idea_result			=	mysql_query($sql);
//$idea_new_id			=	mysql_insert_id();

//echo $idea_new_id;

if ($idea_result) {
	echo 1;
}
else {
	echo 0;
}


?>