<?php  



/**
 * IDEA SUBMITED
 */



// DB CONNECT
include 'db/db-connect.php';
include 'class/api.php';



// GET POST
$user_id				=	$_POST['user_id'];
$idea_title				=	$_POST['idea_title'];
$idea_desc				=	$_POST['idea_desc'];
$idea_cat				=	$_POST['idea_cat'];
$idea_prob				=	$_POST['idea_prob'];
$idea_solu				=	$_POST['idea_solu'];
$idea_features			=	$_POST['idea_features'];
$idea_trget_market		=	$_POST['idea_trget_market'];
$idea_smlr_prod			=	$_POST['idea_smlr_prod'];
//$idea_picture			=	$_FILES['idea_file']['name'];
//$idea_picture			=	$_POST['idea_file'];
$idea_picture			=	'images/default-idea.png';



// INSERT SQL
$sql = "INSERT INTO mj_idea_post
		(id_post_id,
		id_title,
		id_usr_id_fk,
		
		id_pictures,
		id_cat_id_fk,
		id_cur_problem,
		id_cur_solution,
		id_desc,
		id_trget_cust,
		id_features,
		id_smlar_product,
		id_rat_up,
		id_rat_down,
		idea_view,
		id_post_published,
		id_featured) 
		VALUES 
		('',
		'$idea_title',
		'$user_id',

		'$idea_picture',
		'$idea_cat',
		'$idea_prob',
		'$idea_solu',
		'$idea_desc',
		'$idea_trget_market',
		'$idea_features',
		'$idea_smlr_prod',
		'0',
		'0',
		'0',
		'0',
		'0')";


$idea_result			=	mysql_query($sql);
$idea_new_id			=	mysql_insert_id();

echo $idea_new_id;


// REDIRECT
/*if (!$idea_result) {
	echo "Error";
} else {
	echo "inserted";

	
	$uplaod_dir			=	'uploads/ideas/';
	chmod($uplaod_dir, 0777);
	$idea_pic_temp		=	$_FILES['idea_file']['tmp_name'];

	move_uploaded_file($idea_pic_temp, "$uplaod_dir$user_id-$getTimeStamp-$idea_picture");

	$resultPictureUpdate = mysql_query("UPDATE mj_idea_post SET id_pictures =  '$uplaod_dir$user_id-$getTimeStamp-$idea_picture'
				WHERE id_post_id = '$idea_new_id' ");

	if (!$resultPictureUpdate) {
		echo "Cannot UPdate";
	} else {
		echo "Updated";
	}
}*/




?>