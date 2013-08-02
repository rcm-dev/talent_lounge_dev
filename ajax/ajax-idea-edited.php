<?php  


include '../db/db-connect.php';

if ($_POST) {
	// GET POST
	$user_id				=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['user_id'])));
	$idea_title				=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['idea_title'])));
	$idea_desc				=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['idea_desc'])));
	$idea_cat				=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['idea_category'])));
	$idea_prob				=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['idea_prob'])));
	$idea_solu				=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['idea_sol'])));
	$idea_features			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['idea_fea'])));
	$idea_trget_market		=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['idea_target'])));
	$idea_smlr_prod			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['idea_sp'])));
	$curr_idea_edit_id		=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['curr_idea_edit_id'])));
	//$ideastatus				=	$_POST['ideastatus'];



	// INSERT SQL
	$sql = "UPDATE mj_idea_post 
			SET id_title = '$idea_title',
			id_cat_id_fk = '$idea_cat',
			id_cur_problem = '$idea_prob',
			id_cur_solution = '$idea_solu',
			id_desc = '$idea_desc',
			id_trget_cust = '$idea_trget_market',
			id_features = '$idea_features',
			id_smlar_product = '$idea_smlr_prod'
			WHERE id_usr_id_fk = '$user_id' 
			AND id_post_id = '$curr_idea_edit_id'";


	$idea_result			=	mysql_query($sql);
	//$idea_new_id			=	mysql_insert_id();

	//echo $idea_new_id;

	if ($idea_result) {
		echo 1;
	}
	else {
		echo 0;
	}
}


?>