<?php 

/**
 * Database
 */

include '../db/db-connect.php';

if ($_POST) {


	$comUsr 	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['commentbody'])));
	$usr_id 	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['usr_id'])));
	$la_id_fk 	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['la_id_fk'])));

	mysql_query("INSERT INTO mj_learn_comment (la_comment_id, la_usr_id_fk, la_comment_body, la_id_fk) VALUES ('', '$usr_id', '$comUsr', '$la_id_fk')");


}


?>

<li class="comment-box">
	<span><?php echo $comUsr; ?></span>
</li>