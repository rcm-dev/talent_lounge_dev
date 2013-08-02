<?php  



/**
 * IDEA SUBMITED
 */



// DB CONNECT
include '../db/db-connect.php';
//include 'class/api.php';



// GET POST
$user_id				=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['user_id'])));
$market_title			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['market_title'])));
$market_category		=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['market_category'])));
$market_area			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['market_area'])));
$market_desc			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['market_desc'])));
$market_price			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['market_price'])));
//$market_pricture		=	$_FILES['market_pricture']['name'];

$market_pricture		=	'images/default-market.jpg';


// INSERT SQL
$sql = "INSERT INTO mj_market_post
		(mrket_post_id,
		mrket_usr_id_fk,		
		mrket_post_title,
		mrket_post_body,
		mrket_post_picture,
		mrket_cat_id_fk,
		mrket_state_id_fk,
		mrket_post_published,
		mrket_rat_up,
		mrket_rat_down,
		mrket_price) 
		VALUES 
		('',
		'$user_id',
		'$market_title',
		'$market_desc',
		'$market_pricture',
		'$market_category',
		'$market_area',
		'0',
		'0',
		'0',
		'$market_price'
		)";


$market_result			=	mysql_query($sql);
$market_new_id			=	mysql_insert_id();



echo $market_new_id;


// REDIRECT
/*if (!$market_result) {
	echo "Error";
} else {
	echo "inserted";

	
	$uplaod_dir			=	'uploads/market/';
	chmod($uplaod_dir, 0777);
	$market_pic_temp		=	$_FILES['market_pricture']['tmp_name'];

	move_uploaded_file($market_pic_temp, "$uplaod_dir$user_id-$getTimeStamp-$market_pricture");

	$resultPictureUpdate = mysql_query("UPDATE mj_market_post SET mrket_post_picture =  '$uplaod_dir$user_id-$getTimeStamp-$market_pricture'
				WHERE mrket_post_id = '$market_new_id' ");

	if (!$resultPictureUpdate) {
		echo "Cannot UPdate";
	} else {
		echo "Picture Updated <a href=\"new-ads.php\">New</a>";
	}
}*/




?>