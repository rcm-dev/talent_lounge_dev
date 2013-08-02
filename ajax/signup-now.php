<?php 

/**
 * Database
 */

include '../db/db-connect.php';


function generate_random_string($name_length = 8) {
        $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle($alpha_numeric), 0, $name_length);
}


if ($_POST) {


	$email 			= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['email'])));
	$password 		= mysql_real_escape_string(md5($_POST['password']));
	//$conum 			= $_POST['conum'];
	$conum 			= 'Entreprenuer';
	$username 		= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['username'])));

	/**
	 * 
	 * 
	 * 
	 */

	// deafult value
	$user_pic			=	'images/users.png';
	$usr_lvl			=	0;
	$usr_acct_status	=	0;
	$usr_last_login		=	NULL;
	$usr_cnfm_key		=	generate_random_string();
	$usr_cnfrm_datetime	=	NULL;
	$usr_tel			=	0;
	$usr_general_info	=	0;

	$sqlDIrector = "INSERT INTO mj_users (usr_id,
										  usr_name,
										  usr_pwd,
										  usr_email,
										  users_email,
										  users_register,
										  user_pic,
										  usr_lvl,
										  usr_acct_status,
										  usr_cnfm_key,
										  usr_workat,
										  usr_tel,
										  usr_general_info,
										  usr_core_activity,
										  usr_rating,
										  mj_sector_fk,
										  mj_services_fk,
										  mj_state_fk,
										  mj_country_id_fk
										  ) VALUES
								('',
								'$username',
								'$password',
								'$email',
								'$email',
								NOW(),
								'$user_pic',
								'$usr_lvl',
								'$usr_acct_status',
								'$usr_cnfm_key',
								'$conum',
								'$usr_tel',
								'$usr_general_info',
								'Describe your core activity',
								'0',
								'1',
								'1',
								'1',
								'1')";


	 $resultsqlDirector = mysql_query($sqlDIrector);
	 $newIdUser			= mysql_insert_id();


	 // default insert same id in network
	 $sqlEmail3 = "INSERT INTO mj_usr_network (usr_network_id, usr_network_usr_id_fk, usr_network_friend_usr_id_fk, usr_network_approved) VALUES ('', '$newIdUser', '$newIdUser', '0')";
	$result3 = mysql_query($sqlEmail3);

	// sql update clone update user id
	$sqlUpdateUserIdRecruitment = "UPDATE mj_users SET users_id = $newIdUser WHERE usr_id = $newIdUser";
	$result4 = mysql_query($sqlUpdateUserIdRecruitment);


	if ($resultsqlDirector) {
		
		echo 1;


		$to 		= $email;
		$subject	= "PathFinder - Activation Link";
		$message	= 'Thank You for register at PathFinder. Click '.$server.'/activation.php?uid='.$newIdUser.'&confirmkey='.$usr_cnfm_key.' to activate your account';

		mail($to, $subject, $message);

	} else {
		
		echo 0;

	}


}


?>