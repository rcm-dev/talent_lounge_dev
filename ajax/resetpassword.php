<?php 

/**
 * Database
 */

include '../db/db-connect.php';

function generate_random_string($name_length = 8) {
        $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle($alpha_numeric), 0, $name_length);
}

$userTemPassword = generate_random_string();

$temp_password = md5($userTemPassword);

if ($_POST) {


	$email 	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['email'])));
	$sqlEmail = "SELECT
	  mj_users.usr_email
	From
	  mj_users
	Where
	  mj_users.usr_email = '$email'";

	$result = mysql_query($sqlEmail);
	$numrow = mysql_num_rows($result);

	if ($numrow == 1) {
		
		echo $numrow;

		//-----------------------------------------------------

		$updatePass				= "UPDATE mj_users SET usr_pwd = '$temp_password' WHERE usr_email = '$email'";
		$resultUpdatePassw		= mysql_query($updatePass);
		$passwordAffected		= mysql_affected_rows();

		if ($passwordAffected == 1) {
			
			//-----------------------------------------------------

			$to 		= $email;
			$subject 	= 'MOJO - Temporary Password';
			$message 	= 'Your temporary password is '.$userTemPassword;
			$message	.= ' you can login using this password and change to your password at profile setting';

			mail($to, $subject, $message);



			// ----------------------------------------------------

		}
		

	} else {
		
		echo 0;

	}


}


?>