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
$idea_skills			=	$_POST['idea_skills'];
$job_categories			=	$_POST['job_categories'];
$job_budget				=	$_POST['job_budget'];

// $idea_features			=	$_POST['idea_features'];
// $idea_trget_market		=	$_POST['idea_trget_market'];
// $idea_smlr_prod			=	$_POST['idea_smlr_prod'];
//$idea_picture			=	$_FILES['idea_file']['name'];
//$idea_picture			=	$_POST['idea_file'];
// $idea_picture			=	'images/default-idea.png';



// INSERT SQL
$sql = "INSERT INTO f_lists (fl_id, users_id_fk, fl_jobtitle, fl_desc, fl_skills, f_categories_id_fk, budget_id_fk) 
VALUES ('', '$user_id', '$idea_title', '$idea_desc', '$idea_skills', '$job_categories', '$job_budget')";


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